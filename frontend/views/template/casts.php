<?php
use yii\helpers\Html;
?>
<div class="row casts-container">
    <?php foreach($users as $user) { ?>
    <div class="casts-item">
        <div class="thumbnails thumbnail-style thumbnail-kenburn">
            <div class="thumbnail-img">
                <div class="overflow-hidden">
                    <?php if($user['avatar']){?>
                    <img src="<?= $user['avatar']?>" class="img-thumbnail img-responsive" alt="Avatar">
                    <?php } else {?>
                    <?= Html::img('@web/img/no_avatar.png', ['alt'=>'Avatar']) ?>
                    <?php } ?>
                </div>
            </div>
            <div class="caption">
                <h3><a class="hover-effect" href="https://en.wikipedia.org/wiki/<?= str_replace(' ','_', $user['name'])?>"><?= $user['name']?></a></h3>
            </div>
        </div>
    </div>
    <?php } ?>
</div>