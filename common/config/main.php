<?php
require(__DIR__ . '/facebook.php');
require(__DIR__ . '/twitter.php');
require(__DIR__ . '/google.php');
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
                    'clientId' => $FACEBOOK_APP_ID,
                    'clientSecret' => $FACEBOOK_APP_SECRET,
                ],
                'google' => [
                    'class' => 'yii\authclient\clients\GoogleOAuth',
                    'clientId' => $GOOGLE_APP_ID,
                    'clientSecret' => $GOOGLE_APP_SECRET,
                ],
                'twitter' => [
                    'class' => 'yii\authclient\clients\Twitter',
                    'consumerKey' => $TWITTER_APP_KEY,
                    'consumerSecret' => $TWITTER_APP_SECRET,
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
        'avatar' => [
            'class' => 'common\components\AVATAR',
        ],
    ],
    'modules' => [
        'social' => [
            // the module class
            'class' => 'kartik\social\Module',

            // the global settings for the Disqus widget
            'disqus' => [
                'settings' => ['shortname' => 'DISQUS_SHORTNAME'] // default settings
            ],

            // the global settings for the Facebook plugins widget
            'facebook' => [
                'appId' => $FACEBOOK_APP_ID,
                'secret' => $FACEBOOK_APP_SECRET,
            ],

            // the global settings for the Google+ Plugins widget
            'google' => [
                'clientId' => 'GOOGLE_API_CLIENT_ID',
                'pageId' => 'GOOGLE_PLUS_PAGE_ID',
                'profileId' => 'GOOGLE_PLUS_PROFILE_ID',
            ],

            // the global settings for the Google Analytics plugin widget
            'googleAnalytics' => [
                'id' => 'TRACKING_ID',
                'domain' => 'TRACKING_DOMAIN',
            ],

            // the global settings for the Twitter plugin widget
            'twitter' => [
                'screenName' => 'TWITTER_SCREEN_NAME'
            ],

            // the global settings for the GitHub plugin widget
            'github' => [
                'settings' => ['user' => 'GITHUB_USER', 'repo' => 'GITHUB_REPO']
            ],
        ],
        // your other modules
    ]

];
