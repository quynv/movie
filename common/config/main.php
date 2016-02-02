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
    ],
];
