<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

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
        'css/site.css',
        'css/plugins/font-awesome/css/font-awesome.min.css',
        'css/material-design-iconic-font.min.css',
        'css/animate.css',
        'css/waves-effect.css',
        'css/helper.css',
        'css/style.css'
    ];
    public $js = [
        'js/waves.js',
        'js/wow.min.js',
        'js/jquery.nicescroll.js',
        'js/jquery.scrollTo.min.js',
        'js/plugins/detect.js',
        'js/plugins/fastclick.js',
        'js/jquery.app.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
