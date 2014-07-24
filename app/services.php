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
            'error.field.invalid.value' => 'Invalid value',
            'error.field.empty' => 'Field is empty',
            'title.freight.cost.calculator' => 'Freight Cost Calculator',
            'title.attention' => 'Attention',
            'submit' => 'Submit',
            'close' => 'Close',
            'calc' => 'Calculate',
            'text.welcome' => 'Welcome to the Freight Cost Calculator v1.0',
            'text.description' => 'This tool was made to calc the best freight to your delivery. Using a fast and reliable technology we guarantee that you will be surprised by our efficiency!',
            'postcode' => 'Postcode',
            'postcode.description' => 'Destination postcode of your delivery',
            'weight' => 'Weight',
            'weight.description' => 'Total weight of your delivery',
            'volume' => 'Volume',
            'volume.description' => 'Total volume of your delivery',
            'target.date' => 'Target Date',
            'target.date.description' => 'If you inform this field only carriers that can deliver before or on date will be compared',
            'optional' => '[Optional]'
        ),
        'pt-br' => array(
            'error.field.invalid.value' => 'Valor inválido',
            'error.field.empty' => 'Campo está vazio',
            'title.freight.cost.calculator' => 'Calculador de Frete',
            'title.attention' => 'Atenção',
            'submit' => 'Enviar',
            'close' => 'Fechar',
            'calc' => 'Calcular',
            'text.welcome' => 'Bem-vindo ao Calculador de Frete v1.0',
            'text.description' => 'Esta ferramenta foi feita para calcular o melhor frete para sua entrega. Usando uma tecnologia rápida e confiável, nós garantimos que você irá se surpreender pela nossa eficiência!',
            'postcode' => 'CEP',
            'postcode.description' => 'CEP destino da entrega',
            'weight' => 'Peso',
            'weight.description' => 'Peso total da entrega',
            'volume' => 'Cubagem',
            'volume.description' => 'Cubagem da entrega',
            'target.date' => 'Data Alvo',
            'target.date.description' => 'Se você informar este campo somente transportadoras que conseguem entregar antes ou na data serão comparadas',
            'optional' => '[Opcional]'
        ),
    )
);