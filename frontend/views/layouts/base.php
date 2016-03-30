<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="<?= Yii::$app->language ?>" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="<?= Yii::$app->language ?>" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="<?= Yii::$app->language ?>"> <!--<![endif]-->
<head>
    <!-- Meta -->
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php if(isset($this->context->movie)) {?>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="<?= Yii::$app->urlManager->createAbsoluteUrl('/').$this->context->movie->id.'-'.str_replace([':', ' '], '-', $this->context->movie->title)?>" />
    <meta property="og:title" content="<?= $this->context->movie->title?>" />
    <meta property="og:description" content="<?= $this->context->movie->overview?>" />
    <meta property="og:image" content="<?= $this->context->movie->getPoster('w342')?>" />
    <?php } ?>
    <!-- Favicon -->
    <!-- <link rel="shortcut icon" href="favicon.ico">-->
    <!-- Web Fonts -->
    <link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600&amp;subset=cyrillic,latin'>
    <?php $this->head() ?>
</head>
<body class="header-fixed header-fixed-space">
<?php $this->beginBody() ?>
<!-- wrapper -->
<div class="wrapper">
    <?= $this->render('header',[]);?>
    <?php //$this->render('slider',[]); ?>
    <div class="container-fluid">
    <?= $content ?>
    </div>
    <?= $this->render('footer',[])?>
</div>
<!-- end wrapper -->
<?php $this->endBody() ?>
<?= $this->render('scripts') ?>
<?php
//if($this->context->required['is_required'])
//{
//    echo $this->render('//template/rating_require',[]);
//}
//?>
</body>
</html>
<?php $this->endPage() ?>
