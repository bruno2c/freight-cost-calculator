<?php

namespace FreightCostCalculator\Core\Command;

class ShellCommand implements ExecutableInterface
{
    /**
     * @var CommandInterface
     */
    protected $command;
    protected $output = array();
    protected $resultCode;

    /**
     * @param CommandInterface $command
     */
    public function __construct(CommandInterface $command)
    {
        $this->command = $command;
    }

    public function execute()
    {
        exec($this->command->getToExecute(), &$this->output);
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
        return array(
            'output' => $this->getOutput(),
            'result_code' => $this->getResultCode(),
        );
    }
} 