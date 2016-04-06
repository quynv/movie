<?php
use common\models\User;
?>
<div class="table-responsive">
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Id</th>
            <th>Title</th>
            <?php if(Yii::$app->user->isGuest) {?><th><?= $user->username?>'s rating</th><?php } ?>
            <?php if(!Yii::$app->user->isGuest && Yii::$app->user->id == $user->id) {?><th>Your rating</th><?php } ?>
            <?php if(!Yii::$app->user->isGuest && Yii::$app->user->id != $user->id) {?>
                <th><?= $user->username?>'s rating</th>
                <th>Your rating</th>
            <?php } ?>
        </tr>
        </thead>
        <tbody>
        <?php foreach($movies as $movie) {?>
        <tr>
            <th>
                <a href="<?= Yii::$app->urlManager->createAbsoluteUrl('/').$movie['id'].'-'.str_replace([':', ' '], '-', $movie['title'])?>">
                    <?= $movie['id']?>
                </a>
            </th>
            <td>
                <a href="<?= Yii::$app->urlManager->createAbsoluteUrl('/').$movie['id'].'-'.str_replace([':', ' '], '-', $movie['title'])?>">
                    <?= $movie['title']?>
                </a>
            </td>
            <?php if(Yii::$app->user->isGuest) {?><td><?= $movie['rating']?>&nbsp;&nbsp;<i class="fa fa-star"></i></td><?php } ?>
            <?php if(!Yii::$app->user->isGuest && Yii::$app->user->id == $user->id) {?>
                <td>
                    <div class="rating" data-rating="<?= $movie['rating']?>" data-movie="<?= $movie['id']?>">
                        <input type="radio" name="stars-rating-<?= $movie['id']?>" id="stars-rating-5-<?= $movie['id']?>" data-value="5">
                        <label for="stars-rating-5-<?= $movie['id']?>"></label>
                        <input type="radio" name="stars-rating-<?= $movie['id']?>" id="stars-rating-4-<?= $movie['id']?>" data-value="4">
                        <label for="stars-rating-4-<?= $movie['id']?>"></label>
                        <input type="radio" name="stars-rating-<?= $movie['id']?>" id="stars-rating-3-<?= $movie['id']?>" data-value="3">
                        <label for="stars-rating-3-<?= $movie['id']?>"></label>
                        <input type="radio" name="stars-rating-<?= $movie['id']?>" id="stars-rating-2-<?= $movie['id']?>" data-value="2">
                        <label for="stars-rating-2-<?= $movie['id']?>"></label>
                        <input type="radio" name="stars-rating-<?= $movie['id']?>" id="stars-rating-1-<?= $movie['id']?>" data-value="1">
                        <label for="stars-rating-1-<?= $movie['id']?>"></label>
                    </div>
                </td>
            <?php } ?>
            <?php if(!Yii::$app->user->isGuest && Yii::$app->user->id != $user->id) {?>
                <td><?= $movie['rating']?>&nbsp;&nbsp;<i class="fa fa-star"></i></td>
                <td>
                    <div class="rating" data-rating="<?= User::getRated($movie['id'])?>" data-movie="<?= $movie['id']?>">
                        <input type="radio" name="stars-rating-<?= $movie['id']?>" id="stars-rating-5-<?= $movie['id']?>" data-value="5">
                        <label for="stars-rating-5-<?= $movie['id']?>"></label>
                        <input type="radio" name="stars-rating-<?= $movie['id']?>" id="stars-rating-4-<?= $movie['id']?>" data-value="4">
                        <label for="stars-rating-4-<?= $movie['id']?>"></label>
                        <input type="radio" name="stars-rating-<?= $movie['id']?>" id="stars-rating-3-<?= $movie['id']?>" data-value="3">
                        <label for="stars-rating-3-<?= $movie['id']?>"></label>
                        <input type="radio" name="stars-rating-<?= $movie['id']?>" id="stars-rating-2-<?= $movie['id']?>" data-value="2">
                        <label for="stars-rating-2-<?= $movie['id']?>"></label>
                        <input type="radio" name="stars-rating-<?= $movie['id']?>" id="stars-rating-1-<?= $movie['id']?>" data-value="1">
                        <label for="stars-rating-1-<?= $movie['id']?>"></label>
                    </div>
                </td>
            <?php } ?>
        </tr>
        <?php }?>
        </tbody>
    </table>
</div>