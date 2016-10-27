<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author quynv
 * @since 2.0
 */
class AuthAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/style.css',
        'css/dark.css',
        'css/plugins/animate.css',
        'css/plugins/line-icons/line-icons.css',
        'css/plugins/font-awesome/css/font-awesome.css',
        'css/page_log_reg_v2.css',
        'css/teal.css',
        'css/plugins/brand-buttons-inversed.min.css'
    ];
    public $js = [
        'js/plugins/jquery/jquery-migrate.min.js',
        'js/plugins/back-to-top.js',
        'js/plugins/smoothScroll.js',
        'js/plugins/jquery.backstretch.min.js',
        'js/custom.js',
        'js/app.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
