<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 profile-item">
    <div class="profile-blog">
        <img class="rounded-x" src="<?= $user->getAvatar()?>" alt="">
        <div class="name-location">
            <strong><a href="/u/<?= $user->username?>/favourites"><?= $user->username?></a></strong>
            <div id="friend-btn-container">
                <?php if(Yii::$app->user->id!=$user->id) {?>
                    <input type="checkbox" class="follow-btn" <?= $user->is_following?'checked':''?> data-user="<?= $user->id?>">
                <?php } ?>
            </div>
        </div>
        <div class="clearfix margin-bottom-20"></div>
        <hr>
        <ul class="list-inline share-list">
            <li><i class="fa fa-group"></i><a href="/u/<?= $user->username?>/following"><?= count($user->following)?> Followings</a></li>
            <li><i class="fa fa-group"></i><a href="/u/<?= $user->username?>/followers"><?= count($user->followers)?> Followers</a></li>
        </ul>
    </div>
</div>