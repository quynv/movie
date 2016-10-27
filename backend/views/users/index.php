<?php

/* @var $this yii\web\View */
use yii\grid\GridView;
use yii\helpers\Html;
use common\models\User;
$this->registerJsFile(Yii::$app->urlManager->baseUrl.'/js/status.js',['depends' => [\backend\assets\AppAsset::className()]]);
$this->title = 'DashBoard | Users';
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <h1>Users table</h1>
            <div class="table-responsive">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'showOnEmpty'=>true,
                'columns' => [
                    [
                        'attribute'=>'id',
                        'options' => ['width' => '80']
                    ],
                    [
                        'label'=>'Avatar',
                        'format'=>'raw',
                        'options' => ['width' => '80', 'height' => 80],
                        'value' => function($data) {
                            return Html::img($data->getAvatar(200), ['with' => 80, 'height' => 80]);
                        }
                    ],
                    'username',
                    'email',
                    [
                        'attribute' => 'created_at',
                        'format' =>  ['date', 'php:Y-m-d H:i:s'],
                    ],
                    [
                        'attribute'=>'status',
                        'filter'=>User::getStatus(),
                        'format'=>'raw',
                        'value' => function ($model)
                        {
                            $value = Html::activeDropDownList($model, 'status', User::getStatus(),['class'=>'form-control change-status', 'data-user' => $model->id,'prompt' => 'Select status']);
//                            return User::getStatus()[$model->status];
                            return $value;
                        }
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => 'Action',
                        'template' => '{view}{link}',
                    ],
                ],
                'tableOptions' =>['class' => 'table table-striped table-bordered'],
            ]);?>
            </div>
        </div>
    </div>
</div>
