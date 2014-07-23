<?php

$app['twig'] = $app->share($app->extend('twig', function($twig, $app) {
    $twig->addFunction(new \Twig_SimpleFunction('asset', function ($asset) use ($app) {
        return sprintf('%s%s', $app['url_generator']->generate('baseUrl'), $asset);
    }));

    return $twig;
}));