<?php

/**
 * Put here the application's services
 */

/**
 * TWIG
 */
$app['twig'] = $app->share(
    $app->extend(
        'twig',
        function ($twig, $app) {
            $twig->addFunction(
                new \Twig_SimpleFunction('asset', function ($asset) use ($app) {
                    return sprintf('%s%s', $app['url_generator']->generate('baseUrl'), $asset);
                })
            );

            return $twig;
        }
    )
);

/**
 * TRANSLATOR
 */
$app['translator.domains'] = array(
    'messages' => array(
        'en' => array(
            'error.invalid.postcode' => 'Invalid postcode',
            'error.field.empty' => 'Field is empty',
            'title.freight.cost.calculator' => 'Freight Cost Calculator',
            'title.attention' => 'Attention',
            'submit' => 'Submit',
            'close' => 'Close',
        ),
        'pt-br' => array(
            'error.invalid.postcode' => 'CEP inválido',
            'error.field.empty' => 'Campo está vazio',
            'title.freight.cost.calculator' => 'Calculador de Frete',
            'title.attention' => 'Atenção',
            'submit' => 'Enviar',
            'close' => 'Fechar',
        ),
    )
);