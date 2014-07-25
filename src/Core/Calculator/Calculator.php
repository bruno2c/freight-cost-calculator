<?php

namespace FreightCostCalculator\Core\Calculator;

class Calculator
{
	protected $postcode;
	protected $weight;
	protected $volume;
	protected $targetDate;

	public function __construct($params)
	{
		$this->fillConditions($params);
	}

	protected function fillConditions($data = array())
	{
		foreach ($data as $key => $value) {
			if(property_exists($this, $key)){
				$this->$key = $value;
			}
		}
	}

	public function calc()
	{
		$pigJob = new \FreightCostCalculator\Core\Command\Jobs\Pig();
		$pigJob->addParam('x', 'local');

		$command = new \FreightCostCalculator\Core\Command\ShellCommand($pigJob);
		$command->execute();

		return $command->getResult();
	}
}