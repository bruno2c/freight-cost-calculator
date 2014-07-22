<?php

namespace FreightCostCalculator\Controllers;

use Silex\Application;
use Symfony\Component\HttpFoundation\Response;

class IndexController
{
	public function indexAction(Application $app)
	{
		$form = new Forms\CalcFormType();

		return $app['twig']->render('Index/index.html.twig');
	}
}