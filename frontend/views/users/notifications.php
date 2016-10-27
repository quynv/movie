<?php
use yii\widgets\LinkPager;
$this->registerCssFile(Yii::$app->urlManager->baseUrl.'/css/pages/profile.css',['depends' => [\frontend\assets\AppAsset::className()]]);
$this->title = $user->username." | notifications"
?>
<div class="container content profile">
    <div class="row">
        <?= $this->render('//template/user-profile',['user' => $user, 'type' => 'notifications']);?>
    </div>
    <div class="row profile-body margin-bottom-20">
        <ul class="list-unstyled">
            <?php foreach($notifications as $notify) {?>
            <?= $this->render('//template/notify',['notify' => $notify]);?>
            <?php } ?>
        </ul>
    </div>
    <div class="row text-center">
        <?= LinkPager::widget([
            'pagination' => $pages,
        ]);?>
    </div>
</div>
