<?php

namespace FreightCostCalculator\Core\Command;

interface ExecutableInterface
{
    function execute();

	function getPid();

	function getOutput();

    function getErrorOutput();
}