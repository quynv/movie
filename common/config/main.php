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
            'siteKey' => '6Lc8UwATAAAAANRvxCTTKhvAFhsByFfz7U_O3hNa',
            'secret' => '6Lc8UwATAAAAAKcrbywzpF_FShReAkW9RmGmTiqj',
        ],
    ],
];
