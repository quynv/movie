<?php
$this->registerJsFile(Yii::$app->urlManager->baseUrl.'/js/follow.js',['depends' => [\frontend\assets\AppAsset::className()]]);
?>
<div class="profile-blog">
    <img class="rounded-x img-responsive img-bordered avatar" src="<?= $user->getAvatar()?>" alt="">
    <div class="name-location">
        <strong><?= $user->username?></strong>
        <span><i class="fa fa-envelope"></i><?= $user->email?></span>
        <br>
        <br>
        <div id="friend-btn-container">
        <?php if(Yii::$app->user->id!=$user->id) {?>
        <input type="checkbox" class="follow-btn" <?= $user->is_following?'checked':''?> data-user="<?= $user->id?>">
        <?php } ?>
        </div>
    </div>
    <div class="clearfix margin-bottom-20"></div>
    <hr>
    <ul class="list-inline share-list">
        <li><i class="fa fa-heart"></i><a href="/u/<?= $user->username?>/favourites"><?= count($user->favourites)?> Favourites</a></li>
        <li><i class="fa fa-group"></i><a href="/u/<?= $user->username?>/following"><?= count($user->following)?> Followings</a></li>
        <li><i class="fa fa-group"></i><a href="/u/<?= $user->username?>/followers"><?= count($user->followers)?> Followers</a></li>
        <li><i class="fa  fa-film"></i><a href="/u/<?= $user->username?>/ratings">Rated <?= count($user->ratings)?> movies</a></li>
        <?php if(Yii::$app->user->id==$user->id) {?>
        <li><i class="fa fa-bell"></i><a href="/u/<?= $user->username?>/notifications"><?= count($user->notifications)?> Notifications</a></li>
        <?php } ?>
    </ul>
</div>