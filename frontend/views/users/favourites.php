<?php
use \yii\widgets\LinkPager;
$this->registerCssFile(Yii::$app->urlManager->baseUrl.'/css/pages/profile.css',['depends' => [\frontend\assets\AppAsset::className()]]);

$this->title = $user->username." | favourites"
?>
<div class="container content profile">
    <div class="row">
        <?= $this->render('//template/user-profile',['user' => $user, 'type' => 'favourites']);?>
    </div>
    <div class="row profile-body margin-bottom-20">
        <div class="grid-boxes">
            <?php foreach($movies as $movie) { ?>
            <?= $this->render('//template/movie',['movie' => $movie]);?>
            <?php } ?>
        </div>
    </div>
    <div class="row text-center">
        <?= LinkPager::widget([
            'pagination' => $pages,
        ]);?>
    </div>
</div>
