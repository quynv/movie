<?php
use yii\helpers\Url;
use common\models\User;
$this->registerJsFile(Yii::$app->urlManager->baseUrl.'/js/avatar.js',['depends' => [\frontend\assets\AppAsset::className()]]);
?>
<div id="passwordTab" class="profile-edit tab-pane">
    <h2 class="heading-md">Manage your Security Settings</h2>

    <p>Select your avatar.</p>
    <div class="avatar-container">
        <label class="img-avatar">
            <input class="change-avatar" type="radio" name="avatar" value="<?= User::NONE_AVATAR?>" <?php if($user->avatar==User::NONE_AVATAR) echo 'checked'?>/>
            <img class="img-responsive rounded-x" src="<?= Url::toRoute('@web/img/default_avatar.png')?>" width="160" height="160">
            <br>
            default
        </label>
        <?php foreach($providers as $provider){?>
        <label class="img-avatar">
            <input class="change-avatar" type="radio" name="avatar" value="<?= $provider->id?>" <?php if($user->avatar==$provider->id) echo 'checked'?>/>
            <img class="img-responsive rounded-x" src="<?= Yii::$app->avatar->getAvatar(strtolower($provider->provider), $provider->provider_id, 240)?>" width="160" height="160">
            <br>
            <a href="http://www.<?=strtolower($provider->provider)?>.com"><?= $provider->provider?></a>
        </label>
        <?php }?>
        <label class="img-avatar">
            <input class="change-avatar" type="radio" name="avatar" value="<?= User::GRAVATAR?>" <?php if($user->avatar==User::GRAVATAR) echo 'checked'?>/>
            <img class="img-responsive rounded-x" src="<?= Yii::$app->avatar->getAvatar('gravatar', md5($user->email), 240)?>" width="160" height="160">
            <br>
            <a href="http://www.gravatar.com">gravatar</a>
        </label>
    </div>
</div>