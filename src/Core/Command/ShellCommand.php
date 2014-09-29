<?php

namespace FreightCostCalculator\Core\Command;

class ShellCommand implements ExecutableInterface
{
    /**
     * @var CommandInterface
     */
    protected $command;

    /**
     * @param CommandInterface $command
     */
    public function __construct(CommandInterface $command)
    {
        $this->command = $command;
    }

    public function execute()
    {
        return shell_exec($this->command->getToExecute());
    }
} 