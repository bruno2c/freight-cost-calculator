<?php

namespace FreightCostCalculator\Core\Command\Jobs;

use FreightCostCalculator\Core\Command\CommandInterface;

class Pig implements CommandInterface
{
    protected $command;
    protected $params = array();

    function setCommand($command)
    {
        $this->command = $command;
    }

    function getCommand()
    {
        return $this->command;
    }

    function addParam($name, $value)
    {
        $this->params[$name] = $value;
    }

    function getParams($name = null)
    {
        return $name ? $this->params[$name] : $this->params;
    }

    function getToExecute()
    {
        return sprintf('pig');
    }
}