<?php

namespace FreightCostCalculator\Core\Calculator;

use Silex\Application;
use FreightCostCalculator\Core\Command\Process;
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
		$params = '';
		$params .= sprintf("targetPostcode = \"%s\"\n", $this->postcode);

		file_put_contents($this->app['config.resources.scripts.dir'] . 'freightCostCalc-Params.pig', $params);

		$pigJob = new Pig();
		$pigJob->addParam('param_file', $this->app['config.resources.scripts.dir'] . 'freightCostCalc-Params.pig');
		$pigJob->setParamComplement($this->app['config.resources.scripts.dir'] . 'freightCostCalc.pig');

		$process = new Process($pigJob);
		$process->executeScript($this->app);

		return $process->getProcess();
	}
}