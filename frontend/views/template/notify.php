<?php
use \frontend\models\Notification;
use frontend\controllers\utilities\Common;
?>
<?php if($notify->type == Notification::FOLLOW) {?>
<li class="notification">
    <a href="/u/<?= $notify->user->username?>/favourites"><img class="rounded-x " src="<?= $notify->user->getAvatar()?>" alt=""></a>
    <div class="overflow-h">
        <span><a href="/u/<?= $notify->user->username?>/favourites"><strong><?= $notify->user->username?></strong></a> started following you.</span>
        <small><?= Common::humanTiming($notify->created_at)?></small>
    </div>
</li>
<?php } else {?>
<li class="notification">
    <img class="rounded-x " src="<?= $notify->user->getAvatar()?>" alt="">
    <div class="overflow-h">
        <span><a href="/u/<?= $notify->user->username?>/favourites"><strong><?= $notify->user->username?></strong></a> asked your rating about a <a href="<?= Yii::$app->urlManager->createAbsoluteUrl('/').$notify->movie->id.'-'.str_replace([':', ' '], '-', $notify->movie->title)?>">movie(<?= $notify->movie->title?>)</a>.</span>
        <small><?= Common::humanTiming($notify->created_at)?></small>
    </div>
</li>
<?php } ?>
