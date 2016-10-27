<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'reCaptcha' => [
            'name' => 'reCaptcha',
            'class' => 'himiklab\yii2\recaptcha\ReCaptcha',
            'siteKey' => '6Ldr7hYTAAAAAGXXxhFy-kdbK2qNDx_2iu7A88Qo',
            'secret' => '6Ldr7hYTAAAAAP21WeuVWn-ewHYGkwJYmlcaCn1o',
        ],
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'facebook' => [
                    'class' => 'yii\authclient\clients\Facebook',
                    'clientId' => '217813325230003',
                    'clientSecret' => '0b9116da12d939744c22ceb9744d9c70',
                ],
            ],
        ]

    ],
];
