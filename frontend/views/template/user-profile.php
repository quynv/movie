<?php
$this->registerJsFile(Yii::$app->urlManager->baseUrl.'/js/follow.js',['depends' => [\frontend\assets\AppAsset::className()]]);
?>
<div class="profile-blog">
    <img class="rounded-x img-responsive img-bordered avatar" src="<?= $user->getAvatar()?>" alt="">
    <div class="name-location">
        <strong><?= $user->username?></strong>
        <div id="friend-btn-container">
        <?php if(Yii::$app->user->id!=$user->id) {?>
        <input type="checkbox" class="follow-btn" <?= $user->is_following?'checked':''?> data-user="<?= $user->id?>">
        <?php } ?>
        </div>
    </div>
    <div class="clearfix margin-bottom-20"></div>
    <hr>
    <div class="tab-v6">
        <ul class="nav nav-tabs">
            <li class="<?= $type=='favourites'?'active':''?>"><a href="/u/<?= $user->username?>/favourites"><i class="fa fa-heart"></i> <?= count($user->favourites)?> Favourites</a></li>
            <li class="<?= $type=='following'?'active':''?>"><a href="/u/<?= $user->username?>/following"><i class="fa fa-group"></i> <?= count($user->following)?> Followings</a></li>
            <li class="<?= $type=='followers'?'active':''?>"><a href="/u/<?= $user->username?>/followers"><i class="fa fa-group"></i> <?= count($user->followers)?> Followers</a></li>
            <li class="<?= $type=='ratings'?'active':''?>"><a href="/u/<?= $user->username?>/ratings"><i class="fa  fa-film"></i> Rated <?= count($user->ratings)?> movies</a></li>
            <?php if(Yii::$app->user->id==$user->id) {?>
                <li class="<?= $type=='notifications'?'active':''?>"><a href="/u/<?= $user->username?>/notifications"><i class="fa fa-bell"></i> <?= count($user->notifications)?> Notifications</a></li>
            <?php } ?>
        </ul>
    </div>
</div>