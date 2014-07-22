<?php

require_once __DIR__.'/../vendor/autoload.php';

define('BASE_DIR', __DIR__.'/../');
define('BASE_NAMESPACE', 'FreightCostCalculator');

$app = new Silex\Application();
$app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => BASE_DIR.'src/Views'));
$app->register(new Silex\Provider\ServiceControllerServiceProvider());
$app->register(new Silex\Provider\FormServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider());

$app['debug'] = true;

$app['controllers.index'] = $app->share(function() use ($app){
	return new FreightCostCalculator\Controllers\IndexController();	
});

$app->get('/', 'controllers.index:indexAction');

$app->run();