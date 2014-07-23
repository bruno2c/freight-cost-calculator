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
		$response = array('status' => 200);

		$postcode = $request->get('postcode');

		if(!$postcode){
			$response['status'] = 500;
			$response['error'] = $app['translator']->trans('error.invalid.postcode');
			return new JsonResponse($response);
		}

		return new JsonResponse($response);
	}
}