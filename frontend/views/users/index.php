<?php

/* @var $this yii\web\View */
use \yii\widgets\LinkPager;

$this->registerCssFile(Yii::$app->urlManager->baseUrl.'/css/pages/profile.css',['depends' => [\frontend\assets\AppAsset::className()]]);
$this->registerJsFile(Yii::$app->urlManager->baseUrl.'/js/follow.js',['depends' => [\frontend\assets\AppAsset::className()]]);

$this->title = 'Users | All';
?>
<div class="site-index">
    <div class="row">
        <br>
        <div class="container">
            <form action="" method="get" class="form-inline" role="form" style="margin: 0px auto; max-width: 600px">
                <div class="form-group">
                    <label class="sr-only" for="query-text">Username</label>
                    <input type="text" name="keyword" class="form-control" id="query-text" placeholder="Enter username">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn-u btn-u-green">Search</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row content profile">
        <div class="container profile-body margin-bottom-20">
            <?php foreach($users as $user) { ?>
                <?= $this->render('//template/user',['user' => $user]);?>
            <?php } ?>
        </div>
        <div class="row text-center">
            <?= LinkPager::widget([
                'pagination' => $pages,
            ]);?>
        </div>
    </div>

</div>
