<?php

namespace FreightCostCalculator\Core\Command;

interface ExecutableInterface
{
    function execute();

	function getOutput();

	function getResultCode();

    function getResult();
}