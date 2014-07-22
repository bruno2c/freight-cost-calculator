<?php

namespace FreightCostCalculator\Controllers;

use Silex\Application;
use Symfony\Component\HttpFoundation\Response;
use FreightCostCalculator\Forms\CalcFormType;

class IndexController
{
	public function indexAction(Application $app)
	{
		$form = $app['form.factory']->create(new CalcFormType());

		return $app['twig']->render('Index/index.html.twig', array(
			'form' => $form->createView()
		));
	}
}