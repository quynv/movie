<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/style.css',
        'css/header-v6.css',
        'css/footer-v6.css',
        'css/dark.css',
        'css/teal.css',
        'css/plugins/animate.css',
        'css/plugins/line-icons/line-icons.css',
        'css/plugins/font-awesome/css/font-awesome.css',
        'js/plugins/masterslider/style/masterslider.css',
        'js/plugins/masterslider/skins/light-6/style.css'
    ];
    public $js = [
        'js/plugins/jquery/jquery-migrate.min.js',
        'js/plugins/back-to-top.js',
        'js/plugins/smoothScroll.js',
        'js/plugins/masterslider/masterslider.min.js',
        'js/custom.js',
        'js/app.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
