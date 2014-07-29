<?php

namespace FreightCostCalculator\Core\Command;

use Silex\Application;

class ShellCommand implements ExecutableInterface
{
    /**
     * @var CommandInterface
     */
    protected $command;
    protected $output = array();
    protected $resultCode;
    protected $debug = false;

    /**
     * @param CommandInterface $command
     */
    public function __construct(CommandInterface $command)
    {
        $this->command = $command;
    }

    public function execute()
    {
        exec($this->command->getToExecute(), $this->output, $this->resultCode);
    }

    public function executeScript(Application $app)
    {
        exec($app['config.resources.scripts.dir'] . $this->command->getScriptToExecute(), $this->output, $this->resultCode);
    }

    public function getOutput()
    {
        return $this->output;
    }

    public function getResultCode()
    {
        return $this->resultCode;
    }

    public function getResult()
    {
        $result['output'] = $this->getOutput();
        $result['result_code'] = $this->getResultCode();

        if ($this->debug == true) {
            $result['command'] = $this->command->getToExecute();
            $result['script'] = $this->command->getScriptToExecute();
        }

        return $result;
    }

    public function setDebug($debug)
    {
        $this->debug = (bool) $debug;
    }
}