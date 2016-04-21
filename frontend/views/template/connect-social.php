<?php
use yii\helpers\Url;
$this->registerCssFile(Yii::$app->urlManager->baseUrl.'/css/plugins/brand-buttons-inversed.min.css',['depends' => [\frontend\assets\AppAsset::className()]]);
$this->registerCssFile(Yii::$app->urlManager->baseUrl.'/css/plugins/brand-buttons.css',['depends' => [\frontend\assets\AppAsset::className()]]);
?>
<div id="passwordTab" class="profile-edit tab-pane">
    <h2 class="heading-md">Manage your Security Settings</h2>

    <p>Connect to social network.</p>
    <div class="avatar-container">
        <?php foreach(['Facebook' => 'facebook', 'Twitter' => 'twitter', 'Google' => 'googleplus'] as $provider => $name) {?>
        <?php if(array_key_exists(strtolower($provider), $providers)) { ?>
        <a href="<?= Url::toRoute(['settings/disable_social', 'authclient' => strtolower($provider)])?>" class="btn btn-<?=$name?>-inversed rounded tooltips" data-placement="top" title="Click to delete provider">
            <i class="fa fa-<?= strtolower($provider)?>"></i>
            <?= $provider?>
        </a>
        <?php } else { ?>
        <a href="<?= Url::toRoute(['auth/auth', 'authclient' => strtolower($provider)])?>" class="btn btn-<?=$name?> rounded tooltips" data-placement="top" title="Click to connect provider">
            <i class="fa fa-<?= strtolower($provider)?>"></i>
            <?= $provider?>
        </a>
        <?php } }?>
    </div>
</div>