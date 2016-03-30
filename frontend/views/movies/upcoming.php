<?php
use yii\helpers\Url;
use kartik\social\FacebookPlugin;
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
            <a class="btn-u btn-brd btn-brd-width-2 btn-brd-hover btn-u-light btn-u-block rounded-4x margin-right-10" href="<?= Url::to('/movies/upcoming')?>">All Coming Soon</a>
        </div>
    </div>

    <!-- Coming Soon Plugin -->
    <div class="coming-soon-plugin">
        <div id="defaultCountdown" data-value="<?= $movie->getReleaseDate()?>"></div>
    </div>

    <div class="row">
        <div class="col-md-12 coming-soon">
            <p>
                <?= $movie->getOverview()?>
            </p>
            <p>
                <?= FacebookPlugin::widget(['type'=>FacebookPlugin::SEND, 'settings' => []]);?>
                <?= FacebookPlugin::widget(['type'=>FacebookPlugin::SHARE, 'settings' => [
                    'layout' => 'button_count'
                ]])?>
                <?= FacebookPlugin::widget(['type'=>FacebookPlugin::LIKE, 'settings' => [
                    'layout' => 'button_count'
                ]])?>
            </p>
            <br>
            <?php $trailers = $movie->getTrailers()?>
            <?php if($trailers) { ?>
            <p>
            <?php for($i = 0; $i < count($trailers); $i++) {?>
                <a href="#video-<?=$i?>" class="btn-u btn-brd btn-brd-width-2 btn-brd-hover btn-u-light btn-u-block rounded-4x"><?= $trailers[$i]['name']?></a>
            <?php }?>
            </p>
            <?php foreach($trailers as $key => $trailer) {?>
                <br>
                <div class="responsive-video md-margin-bottom-40" id="video-<?= $key?>">
                    <iframe width="100%" src="//www.youtube.com/embed/<?= $trailer['source']?>" frameborder="0" allowfullscreen=""></iframe>
                </div>
                <br>
            <?php }} ?>
        </div>
    </div>
</div><!--/container-->
