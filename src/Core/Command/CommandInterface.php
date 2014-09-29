<?php

namespace FreightCostCalculator\Core\Command;

interface CommandInterface
{
    function setCommand($command);

    function getCommand();

    function addParam($name, $value);

    function getParams($name = null);

    function getToExecute();
} 