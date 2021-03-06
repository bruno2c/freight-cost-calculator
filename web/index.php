<?php

require_once __DIR__.'/../vendor/autoload.php';

define('BASE_DIR', __DIR__.'/../');
define('BASE_NAMESPACE', 'FreightCostCalculator');

$app = new Silex\Application();
$app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => BASE_DIR.'src/Views'));
$app->register(new Silex\Provider\ServiceControllerServiceProvider());
$app->register(new Silex\Provider\FormServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider(), array(
    'locale_fallbacks' => array('pt-br'),
));
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\SessionServiceProvider());
$app->register(new Predis\Silex\PredisServiceProvider(), array(
    'predis.parameters' => 'tcp://127.0.0.1:6379',
    'predis.options'    => array('profile' => '2.2'),
));

include __DIR__.'/../app/config.php';
include __DIR__.'/../app/routes.php';
include __DIR__.'/../app/services.php';

$app->run();