<?php

namespace FreightCostCalculator\Core\Calculator;

use Silex\Application;
use FreightCostCalculator\Core\Command\ShellCommand;
use FreightCostCalculator\Core\Command\Jobs\Pig;

class Calculator
{
	protected $postcode;
	protected $weight;
	protected $volume;
	protected $targetDate;
	protected $app;

	public function __construct(Application $app, $params)
	{
		$this->fillConditions($params);
		$this->app = $app;
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
		ini_set('max_execution_time', 0);

		$pigJob = new Pig();
		$pigJob->addParam('param_file', $this->app['config.resources.scripts.dir'] . 'freightCostCalc-Params.pig');
		$pigJob->setParamComplement($this->app['config.resources.scripts.dir'] . 'freightCostCalc.pig');

		$command = new ShellCommand($pigJob);
		$command->executeScript($this->app);

		return $command->getResult();
	}
}