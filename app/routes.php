<?php

$app['controllers.index'] = $app->share(function() use ($app){
        return new FreightCostCalculator\Controllers\IndexController();
    });

$app->get('/','controllers.index:indexAction')->bind('baseUrl');
$app->get('/calc', 'controllers.index:indexAction')->bind('calc');