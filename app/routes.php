<?php

$app['controllers.index'] = $app->share(function() use ($app){
        return new FreightCostCalculator\Controllers\IndexController();
    });

$app->get('/','controllers.index:indexAction')->bind('baseUrl');
$app->post('/calc_freight_cost', 'controllers.index:calcFreightCostAjaxAction')->bind('IndexController:calcFreightCostAjaxAction');