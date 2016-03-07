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
        ],
        'i18n' => [
            'translations' => [
                'frontend*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                    'fileMap' => [
                        'views.login' => 'views.login.php'
                    ]
                ],
                'backend*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                ],
            ],
        ],
        'tmdb' => [
            'class' => 'common\components\TMDB',
            'apiKey' => '2f74c8b0a2ae5d586eb56b4885c22cff',
            'language' => 'en'
        ],
    ],
];
