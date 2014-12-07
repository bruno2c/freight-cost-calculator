<?php

namespace FreightCostCalculator\Controllers;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use FreightCostCalculator\Forms\CalcFormType;
use FreightCostCalculator\Core\Helper\TokenHelper;

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
        $app['predis']->set('job_id', TokenHelper::generate());
		$response = array('status' => 200);

		$postcode = $request->get('postcode');

		if(!$postcode){
			$response['status'] = 500;
			$response['error'] = $app['translator']->trans('error.invalid.postcode');
			return new JsonResponse($response);
		}

		$calculator = new \FreightCostCalculator\Core\Calculator\Calculator($app, array('postcode' => $postcode));
		$response['result'] = $calculator->calc();
		$response['job_id'] = $app['predis']->get('job_id');

		return new JsonResponse($response);
	}

	public function getRunTimeProcessOutputAjaxAction(Application $app, Request $request)
	{
		$response = array('status' => 200);
		$jobId = $app['predis']->get('job_id');

		$processOutput = $app['predis']->get(sprintf('%s:process:error:output', $jobId));
		preg_match_all('#INFO  org.apache.pig.backend.hadoop.executionengine.mapReduceLayer.MapReduceLauncher - (.* ?) complete#', $processOutput, $processOutput);

		if (count($processOutput) > 0) {
			$response['output'] = array_pop($processOutput);

			if (count($response['output']) > 0) {
				$response['output'] = array_pop($response['output']);
			}
		}

		$response['finished_at'] = $app['predis']->get(sprintf('%s:process:finished_at', $jobId));

		$processErrorOutput = $app['predis']->get(sprintf('%s:process:error:output', $jobId));
		preg_match('#ERROR org.apache.pig.tools.grunt.Grunt - (.* ?)#', $processErrorOutput, $processErrorOutput);

		if (count($processErrorOutput) > 0) {
			$response['status'] = 500;
			$response['error'] = $processErrorOutput[0];
		}

        return new JsonResponse($response);
	}
}