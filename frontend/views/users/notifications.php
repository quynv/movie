<?php
$this->registerCssFile(Yii::$app->urlManager->baseUrl.'/css/pages/profile.css',['depends' => [\frontend\assets\AppAsset::className()]]);
?>
<div class="container content profile">
    <div class="row">
        <?= $this->render('//template/user-profile',['user' => '']);?>
    </div>
    <div class="row profile-body margin-bottom-20">
        <ul class="list-unstyled">
            <?= $this->render('//template/user-profile',['user' => '']);?>
        </ul>
    </div>
</div>
