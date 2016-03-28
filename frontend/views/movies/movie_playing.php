<?php
use yii\helpers\Url;
$this->registerCssFile(Yii::$app->urlManager->baseUrl.'/css/pages/page_coming_soon.css',['depends' => [\frontend\assets\AppAsset::className()]]);
$this->title = 'Now playing | '.$movie->getTitle();
?>
<div class="container-fluid cooming-soon-content">
    <!-- Coming Soon Content -->
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12 coming-soon">
            <h1><?= $movie->getTitle()?></h1>
            <p>
                <?= $movie->getOverview()?>
            </p>
            <p>
                <strong>Released: </strong>
                <?= $movie->getReleaseDate()?>
            </p>
            <br>
            <a class="btn-u btn-brd btn-brd-width-2 btn-brd-hover btn-u-light btn-u-block rounded-4x margin-right-10" href="<?= Url::to('/movies/now_playing')?>">All Now Playing</a>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-12 coming-soon">
            <div class="responsive-video">
                <?php if($videos['results'] && $videos['results'][0]['site'] == 'YouTube') {?>
                <iframe width="100%" src="https://www.youtube.com/embed/<?= $videos['results'][0]['key']?>" frameborder="0" allowfullscreen>

                </iframe>
                <?php } ?>
            </div>
        </div>
    </div>

</div><!--/container-->
