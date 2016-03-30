<?php
use kartik\social\FacebookPlugin;

$this->title = "Detail | ".$movie->title;
$this->registerJsFile(Yii::$app->urlManager->baseUrl.'/js/rating.js',['depends' => [\frontend\assets\AppAsset::className()]]);
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
            <h1><?= $movie->title ?></h1>
            <div class="row">
                <strong class="rating-label">Rating: &nbsp;&nbsp;</strong>
                <div class="rating" data-rating="<?= $movie->rated ?>" data-movie="<?= $movie->id?>">
                    <input type="radio" name="stars-rating" id="stars-rating-5" data-value="5">
                    <label for="stars-rating-5"></label>
                    <input type="radio" name="stars-rating" id="stars-rating-4" data-value="4">
                    <label for="stars-rating-4"></label>
                    <input type="radio" name="stars-rating" id="stars-rating-3" data-value="3">
                    <label for="stars-rating-3"></label>
                    <input type="radio" name="stars-rating" id="stars-rating-2" data-value="2">
                    <label for="stars-rating-2"></label>
                    <input type="radio" name="stars-rating" id="stars-rating-1" data-value="1">
                    <label for="stars-rating-1"></label>
                </div>
            </div>
            <p><strong><?= Yii::t('frontend/views.detail', 'Released date:') ?></strong>&nbsp;<?= $movie->released_at;?></p>
            <p><strong><?= Yii::t('frontend/views.detail', 'Runtime:')?></strong>&nbsp;<?= $movie->runtime.Yii::t('frontend/views.detail', 'mins')?></p>
            <p>
                <strong><?= Yii::t('frontend/views.detail','Description:')?></strong>
                <?= $movie->overview ?>
            </p>
            <p>
                <strong><?= Yii::t('frontend/views.detail','Companies:')?></strong>
                <?php foreach($movie->companies as $company){ ?>
                    <a href="#">
                        <?= $company['name']?>,
                    </a>
                <?php } ?>
            </p>
            <p>
                <strong><?= Yii::t('frontend/views.detail','Directors:')?></strong>
                <?php foreach($movie->directors as $director){ ?>
                    <a href="#" class="tooltips-image" data-placement="bottom">
                        <?= $director['name']?>,
                    </a>
                <?php } ?>
            </p>
            <p>
                <strong><?= Yii::t('frontend/views.detail','Casts:')?></strong>
                <?php foreach($movie->casts as $cast){ ?>
                    <a href="/actors/<?= $cast->id.'-'.strtolower(urlencode($cast->name))?>" data-value="<?= $cast->id?>" class="hovercard" data-placement="bottom">
                        <?= $cast['name']?>,
                    </a>
                <?php } ?>
            </p>
            <p>
                <strong><?= Yii::t('frontend/views.detail','Genres:')?> </strong>
                <?php foreach($movie->genres as $genre){ ?>
                    <a href="/genres/<?= $genre->id.'-'.strtolower(urlencode($genre->name))?>"><i class="fa fa-tags"></i><?= $genre->name?></a>&nbsp;&nbsp;
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
    <br>
    <h4>Images and Videos</h4>
    <?= $this->render('//template/portfolio',[
        'videos' => $movie->getVideos(),
        'images' => $movie->getImages('w342'),
        'backdrop' => $movie->getPoster('w342')
    ]);?>
    <br>
    <br>
    <div class="row">
        <div class="tab-v6 container">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#review" data-toggle="tab" aria-expanded="true">Review&nbsp;&nbsp;&nbsp;</a></li>
                <li class=""><a href="#settings-1" data-toggle="tab" aria-expanded="false">Your friend rated it&nbsp;&nbsp;&nbsp;</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade active in" id="review">
                    <?= FacebookPlugin::widget(['type'=>FacebookPlugin::COMMENT, 'settings' => ['data-width'=>1000, 'data-numposts'=>5]]);?>
                </div>
                <div class="tab-pane fade" id="settings-1">
                    <h4>Heading Sample 4</h4>
                    <p><img alt="" class="pull-right rgt-img-margin img-width-200" src="assets/img/main/img23.jpg"> Vivamus imperdiet condimentum diam, eget placerat felis consectetur id. Donec eget orci metus, Vivamus imperdiet condimentum diam, eget placerat felis consectetur id. Donec eget orci metus, ac adipiscing nunc. Pellentesque fermentum, ante ac interdum ullamcorper. Donec eget orci metus, ac adipiscing nunc. Pellentesque fermentum, consectetur id. Donec eget orci metus, ac adipiscing nunc. <strong>Pellentesque fermentum</strong>, ante ac interdum ullamcorper. Donec eget orci metus, ac adipiscing nunc. Pellentesque fermentum, ante ac interdum ullamcorper.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="advance-content" style="display: none;">
    <p>Loading....</p>
</div>