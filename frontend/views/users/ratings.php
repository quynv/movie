<?php
use \yii\widgets\LinkPager;
$this->registerCssFile(Yii::$app->urlManager->baseUrl.'/css/pages/profile.css',['depends' => [\frontend\assets\AppAsset::className()]]);
$this->title = $user->username." | ratings";
?>
<div class="container content profile">
    <div class="row">
        <?= $this->render('//template/user-profile',['user' => $user, 'type' => 'ratings']);?>
    </div>
    <div class="row profile-body margin-bottom-20">
        <?= $this->render('//template/user-rated',['movies' => $movies, 'user' => $user]);?>
    </div>
    <div class="row text-center">
        <?= LinkPager::widget([
            'pagination' => $pages,
        ]);?>
    </div>
</div>
