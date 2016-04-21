<?php
$this->registerCssFile(Yii::$app->urlManager->baseUrl.'/css/pages/profile.css',['depends' => [\frontend\assets\AppAsset::className()]]);
$this->title = Yii::$app->user->identity->username." | settings"
?>
<div class="container content profile">
    <div class="row">
        <?= $this->render('//template/setting-navbar',['user' => $user]);?>
        <div class="col-md-9">
            <div class="profile-body">
                <?= $this->render('//template/change-avatar',['providers' => $providers, 'user' => $user]);?>
            </div>
        </div>
    </div>
</div>