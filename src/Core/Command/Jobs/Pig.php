<?php

namespace FreightCostCalculator\Core\Command\Jobs;

use FreightCostCalculator\Core\Command\CommandInterface;

class Pig implements CommandInterface
{
    protected $command;
    protected $params = array();
    protected $paramDelimiter = '-';

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

    function setParamDelimiter($paramDelimiter)
    {
        $this->paramDelimiter = $paramDelimiter;
    }

    function getParamDelimiter()
    {
        return $this->paramDelimiter;
    }

    function getToExecute()
    {
        return sprintf('pig');
    }
}