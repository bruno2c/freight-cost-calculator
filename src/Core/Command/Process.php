<?php

namespace FreightCostCalculator\Core\Command;

use Silex\Application;
use Symfony\Component\Process\Process as SymfonyProcess;

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
        $process = new SymfonyProcess($app['config.resources.scripts.dir'] . $this->command->getScriptToExecute());
        $process->start();

        while ($process->isRunning()) {
            $app['session']->set('process.output', $process->getIncrementalOutput());
            $app['session']->set('process.error.output', $process->getIncrementalErrorOutput());
        }

		$this->process = $process;
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