<?php

namespace FreightCostCalculator\Core\Command\Jobs;

use FreightCostCalculator\Core\Command\CommandInterface;

class Pig implements CommandInterface
{
    protected $command;
    protected $params = array();
    protected $paramDelimiter = '-';
    protected $paramComplement;

    public function setCommand($command)
    {
        $this->command = $command;
    }

    public function getCommand()
    {
        return $this->command;
    }

    public function addParam($name, $value)
    {
        $this->params[$name] = $value;
    }

    public function getParams($name = null)
    {
        return $name ? $this->params[$name] : $this->params;
    }

    public function setParamDelimiter($paramDelimiter)
    {
        $this->paramDelimiter = $paramDelimiter;
    }

    public function getParamDelimiter()
    {
        return $this->paramDelimiter;
    }

    public function getParamsAsString()
    {
        $params = null;

        foreach ($this->params as $key => $value) {
            $params .= $this->getParamDelimiter() . $key;
            $params .= $value ? ' ' . $value : null;
            $params .= ' ';
        }

        return $params;
    }

    public function setParamComplement($complement)
    {
        $this->paramComplement = $complement;
    }

    public function getParamComplement()
    {
        return $this->paramComplement;
    }

    public function getToExecute()
    {
        return sprintf('pig %s %s', $this->getParamsAsString(), $this->getParamComplement());
    }

    public function getScriptToExecute()
    {
        return sprintf('run_pig_job.sh %s %s', $this->getParamsAsString(), $this->getParamComplement());
    }
}