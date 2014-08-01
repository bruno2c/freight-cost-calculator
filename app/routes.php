<?php

/**
 * Put here the application's routes
 */

$app['controllers.index'] = $app->share(
    function () use ($app) {
        return new FreightCostCalculator\Controllers\IndexController();
    }
);

$app->get('/','controllers.index:indexAction')->bind('baseUrl');
$app->post('/calc_freight_cost', 'controllers.index:calcFreightCostAjaxAction')->bind('IndexController:calcFreightCostAjaxAction');
$app->get('/get_run_time_process_output', 'controllers.index:getRunTimeProcessOutputAjaxAction')->bind('IndexController:getRunTimeProcessOutputAjaxAction');