<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\AuthAsset;

AuthAsset::register($this);
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
    <!-- Favicon -->
    <!-- <link rel="shortcut icon" href="favicon.ico">-->
    <!-- Web Fonts -->
    <link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600&amp;subset=cyrillic,latin'>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

    <div class="container">
        <?= $content ?>
    </div>
<!-- end wrapper -->
<?php $this->endBody() ?>
<?php if($this->context->movie) {?>
    <?php if($this->context->movie->getBackdrops('w1280')) {?>
        <?= $this->render('backstretch',['images' =>
            $this->context->movie->getBackdrops('w1280')
        ]);?>
    <?php } else {?>
        <?= $this->render('backstretch',['images' =>
            [$this->context->movie->getBackdrop('w1280')]
        ]);?>
    <?php } ?>
    <?= $this->render('//template/initcoming',[]); ?>
<?php } else { ?>
    <?= $this->render('backstretch',['images' =>
        [
            Url::to('@web/img/bg/1.jpg'),
            Url::to('@web/img/bg/2.jpg'),
            Url::to('@web/img/bg/3.jpg'),
        ]
    ]);?>
<?php } ?>

</body>
</html>
<?php $this->endPage() ?>
