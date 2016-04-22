<?php

/* @var $this yii\web\View */
use yii\widgets\DetailView;
use yii\helpers\Html;
use common\models\User;

$this->title = 'User | Detail';
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <h1><?= $model->username?>'s Information</h1>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'label' => 'Avatar',
                        'format'=>'raw',
                        'value' => Html::img($model->getAvatar(200), ['width' => 200, 'height' => 200])
                    ],
                    'id',
                    'username',
                    [
                        'label' => 'Email',
                        'value' => $model->email,
                    ],
                    [
                        'label' => 'Status',
                        'value' => User::getStatus()[$model->status]
                    ],
                    'created_at:datetime',
                ],
            ])?>
        </div>
    </div>
</div>
