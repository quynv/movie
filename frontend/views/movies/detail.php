<?php
use kartik\social\FacebookPlugin;

$this->title = "Detail | ".$movie->getTitle();
$this->registerCssFile(Yii::$app->urlManager->baseUrl.'/css/favourite.css',['depends' => [\frontend\assets\AppAsset::className()]]);
$this->registerJsFile(Yii::$app->urlManager->baseUrl.'/js/favourite.js',['depends' => [\frontend\assets\AppAsset::className()]]);
?>
<div class="container content-md">
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="box-shadow shadow-effect-1">
                <img src="<?= $movie->getPoster('w342') ?>" width="100%" class="img-responsive img-bordered">
                <?php if($movie->infavourite){?>
                    <div class="tooltips oneLine heart_icon on" data-toggle="tooltip" data-placement="top" title="In favourite" data-movie="<?= $movie->id?>" data-value="0"> </div>
                <?php } else {?>
                    <div class="tooltips oneLine heart_icon off" data-toggle="tooltip" data-placement="top" title="Add to favourite" data-movie="<?= $movie->id?>" data-value="1"> </div>
                <?php }?>
                <div class="oneLine num_vote"><?= count($movie->favourites)?></div>
                <i class="tooltips icon-users fa fa-users" data-toggle="tooltip" data-placement="top" title="Ask your friend's rating"></i>
            </div>
        </div>
        <div class="col-lg-8 col-md-6 col-sm-12">
            <h2><?= $movie->getTitle() ?></h2>
            <p><strong><?= Yii::t('frontend/views.detail', 'Released date:') ?></strong>&nbsp;<?= $movie->getReleaseDate();?></p>
            <p><strong><?= Yii::t('frontend/views.detail', 'Runtime:')?></strong>&nbsp;<?= $movie->getRuntime().Yii::t('frontend/views.detail', 'mins')?></p>
            <p>
                <strong><?= Yii::t('frontend/views.detail','Description:')?></strong>
                <?= $movie->getOverview() ?>
            </p>
            <p>
                <strong><?= Yii::t('frontend/views.detail','Genres:')?> </strong>
                <?php foreach($movie->genres as $genre){ ?>
                    <a href="#"><i class="fa fa-tags"></i><?= $genre->name?></a>&nbsp;&nbsp;
                <?php } ?>
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
        </div>
    </div>
    <br>
    <br>
    <br>
    <div class="row col-lg-offset-4">
        <?php foreach($movie->getTrailers() as $video) { ?>
        <div class="col-lg-12 col-md-6 col-sm-12">
            <h4><?= $video['name']?></h4>
            <div class="responsive-video">
                <iframe src="http://www.youtube.com/embed/<?= $video['source']?>" allowfullscreen width="100%" frameborder="0">

                </iframe>
            </div>
        </div>
        <?php } ?>
    </div>
    <br>
    <br>
    <h4>Images</h4>
    <?= $this->render('//template/portfolio',['images' => $movie->getImages('w780'), 'backdrop' => $movie->getBackdrop('w780')]);?>
    <br>
    <br>
    <div class="row">
        <div class="tab-v6 container">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#review" data-toggle="tab" aria-expanded="true">Review&nbsp;&nbsp;&nbsp;</a></li>
                <li class=""><a href="#cast" class="cast" data-toggle="tab" aria-expanded="false">Casts&nbsp;&nbsp;&nbsp;</a></li>
                <li class=""><a href="#crew" class="crew" data-toggle="tab" aria-expanded="false">Crews&nbsp;&nbsp;&nbsp;</a></li>
                <li class=""><a href="#settings-1" data-toggle="tab" aria-expanded="false">Your friend rated it&nbsp;&nbsp;&nbsp;</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade active in" id="review">
                    <?= FacebookPlugin::widget(['type'=>FacebookPlugin::COMMENT, 'settings' => ['data-width'=>1000, 'data-numposts'=>5]]);?>
                </div>
                <div class="tab-pane fade" id="cast">
                    <?= $this->render('//template/casts',['users' => $movie->getCasts()]);?>
                </div>
                <div class="tab-pane fade" id="crew">
                    <?= $this->render('//template/casts',['users' => $movie->getCrews()]);?>
                </div>
                <div class="tab-pane fade" id="settings-1">
                    <h4>Heading Sample 4</h4>
                    <p><img alt="" class="pull-right rgt-img-margin img-width-200" src="assets/img/main/img23.jpg"> Vivamus imperdiet condimentum diam, eget placerat felis consectetur id. Donec eget orci metus, Vivamus imperdiet condimentum diam, eget placerat felis consectetur id. Donec eget orci metus, ac adipiscing nunc. Pellentesque fermentum, ante ac interdum ullamcorper. Donec eget orci metus, ac adipiscing nunc. Pellentesque fermentum, consectetur id. Donec eget orci metus, ac adipiscing nunc. <strong>Pellentesque fermentum</strong>, ante ac interdum ullamcorper. Donec eget orci metus, ac adipiscing nunc. Pellentesque fermentum, ante ac interdum ullamcorper.</p>
                </div>
            </div>
        </div>
    </div>
</div>