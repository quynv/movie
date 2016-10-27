<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Quy
 * Date: 4/21/2016
 * Time: 11:25 PM
 */

namespace backend\assets;


use yii\web\AssetBundle;

class AuthAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/plugins/font-awesome/css/font-awesome.min.css',
        'css/auth.css',
    ];
    public $js = [

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}