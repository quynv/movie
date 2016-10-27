<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <script src="<?= Url::to('@web/js/modernizr.min.js')?>"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body class="fixed-left">
<?php $this->beginBody() ?>
<div id="wrapper">
    <?= $this->render('//layouts/header',[])?>
    <?= $this->render('//layouts/menu',[])?>
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">
                <?php
                if(Yii::$app->session->getAllFlashes()) {
                    foreach (Yii::$app->session->getAllFlashes() as $name => $value) {
                        echo Alert::widget([
                            'options' => [
                                'class' => 'alert-' . $name,
                            ],
                            'body' => $value,
                        ]);
                    }
                }
                ?>
                <?= $content?>
            </div>
        </div>
        <?= $this->render('//layouts/footer',[])?>
    </div>
</div>
<script>
    var resizefunc = [];
</script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
