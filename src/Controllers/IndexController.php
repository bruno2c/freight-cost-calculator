<?php

namespace FreightCostCalculator\Controllers;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
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

	public function calcFreightCostAjaxAction(Application $app, Request $request)
	{
		$app['session']->set('process.output', null);
        $app['session']->set('process.error.output', null);

		$response = array('status' => 200);

		$postcode = $request->get('postcode');

		if(!$postcode){
			$response['status'] = 500;
			$response['error'] = $app['translator']->trans('error.invalid.postcode');
			return new JsonResponse($response);
		}

		$calculator = new \FreightCostCalculator\Core\Calculator\Calculator($app, array('postcode' => $postcode));
		$response['result'] = $calculator->calc();

		return new JsonResponse($response);
	}

	public function getRunTimeProcessOutputAjaxAction(Application $app, Request $request)
	{
		$response = array('status' => 200);

		$processOutput = $app['session']->get('process.output');
		preg_match('/org.apache.pig.backend.hadoop.executionengine.mapReduceLayer.MapReduceLauncher - [0-9]{1,}% complete/', $processOutput, $percent);

		$response['output'] = $percent;
       	$response['error'] = $app['session']->get('process.error.output');

        return new JsonResponse($response);
	}
}