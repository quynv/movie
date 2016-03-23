<?php
use yii\helpers\Url;
$this->registerJsFile(Yii::$app->urlManager->baseUrl.'/js/plugins/countdown/jquery.plugin.min.js',['depends' => [\frontend\assets\AppAsset::className()]]);
$this->registerJsFile(Yii::$app->urlManager->baseUrl.'/js/plugins/countdown/jquery.countdown.min.js',['depends' => [\frontend\assets\AppAsset::className()]]);
$this->registerJsFile(Yii::$app->urlManager->baseUrl.'/js/pages/page_coming_soon.js',['depends' => [\frontend\assets\AppAsset::className()]]);
$this->registerCssFile(Yii::$app->urlManager->baseUrl.'/css/pages/page_coming_soon.css',['depends' => [\frontend\assets\AppAsset::className()]]);
$this->title = 'Coming soon | '.$movie->getTitle();
?>
<div class="container cooming-soon-content">
    <!-- Coming Soon Content -->
    <div class="row">
        <div class="col-md-12 coming-soon">
            <h1><?= $movie->getTitle()?></h1>
            <p>
                <?= $movie->getOverview()?>
            </p><br>
            <a class="btn-u btn-brd btn-brd-width-2 btn-brd-hover btn-u-light btn-u-block rounded-4x margin-right-10" href="<?= Url::to('/movies/upcoming')?>">All Coming Soon</a>
        </div>
    </div>

    <!-- Coming Soon Plugin -->
    <div class="coming-soon-plugin">
        <div id="defaultCountdown" data-value="<?= $movie->getReleaseDate()?>"></div>
    </div>
</div><!--/container-->
