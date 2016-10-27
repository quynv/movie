<?php
use \frontend\models\Request;
$this->registerCssFile(Yii::$app->urlManager->baseUrl.'/css/pages/profile.css',['depends' => [\frontend\assets\AppAsset::className()]]);
$this->registerJsFile(Yii::$app->urlManager->baseUrl.'/js/request.js',['depends' => [\frontend\assets\AppAsset::className()]]);
?>
<div class="modal fade profile" id="requestModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Select your followers</h4>
            </div>
            <div class="modal-body">
                <ul class="list-unstyled">
                    <?php if($followers)  { foreach($followers as $user) {?>
                    <li class="notification list-user">
                        <img class="rounded-x " src="<?= $user->getAvatar()?>" alt="">
                        <div class="overflow-h">
                            <label class="checkbox" for="checkbox-<?=$user->id?>"><strong><?= $user->username?></strong></label>
                            <input class="request-checkbox" type="checkbox" name="checkbox[]" id="checkbox-<?=$user->id?>" data-value="<?=$user->id?>" data-movie="<?=$movie->id?>" <?= Request::check(Yii::$app->user->id, $user->id, $movie->id)?'checked':''?>>
                        </div>
                    </li>
                    <?php }}else{ ?>
                        <li class="notification">No data</li>
                    <?php } ?>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default rounded" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>