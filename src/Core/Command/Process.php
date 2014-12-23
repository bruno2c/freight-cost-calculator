<?php

namespace FreightCostCalculator\Core\Command;

use Silex\Application;
use Symfony\Component\Process\Process as SymfonyProcess;
use Symfony\Component\Process\Exception\ProcessTimedOutException;

class Process implements ExecutableInterface
{
    const STATUS_STARTED = 'STARTED';
    const STATUS_RUNNING = 'RUNNING';
    const STATUS_FINISHED = 'FINISHED';

	/**
     * @var CommandInterface
     */
    protected $command;
    protected $process;

    /**
     * @param CommandInterface $command
     */
    public function __construct(CommandInterface $command)
    {
        $this->command = $command;
    }

    public function execute()
    {
        $process = new SymfonyProcess($this->command->getToExecute());
        $process->run();

		$this->process = $process;
    }

    public function executeScript(Application $app)
    {
        try {
            $process = new SymfonyProcess($app['config.resources.scripts.dir'] . $this->command->getScriptToExecute());
            $process->setTimeout(3600);
            $process->setIdleTimeout(30);
            $process->start();
            $jobId = $app['predis']->get('job_id');

            while ($process->isRunning()) {
                $app['predis']->set(sprintf('%s:process:output', $jobId), $process->getOutput());
                $app['predis']->set(sprintf('%s:process:error:output', $jobId), $process->getErrorOutput());
                $process->checkTimeout();
            }

            if ($process->isSuccessful()) {
                $app['predis']->set(sprintf('%s:process:finished_at', $jobId), date('Y-m-d H:i:s'));
            }

            $this->process = $process;
        } catch (ProcessTimedOutException $e) {
            $app['predis']->set(sprintf('%s:process:finished_at', $jobId), date('Y-m-d H:i:s'));
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getProcess()
    {
    	return $this->process;
    }

    public function getPid()
    {
        return $this->process->getPid();
    }

    public function getOutput()
    {
        return $this->process->getOutput();
    }

    public function getErrorOutput()
    {
        return $this->process->getErrorOutput();
    }
}