<?php

/* @var $this yii\web\View */
use yii\grid\GridView;
use yii\helpers\Html;
use backend\models\Admin;
$this->registerJsFile(Yii::$app->urlManager->baseUrl.'/js/role.js',['depends' => [\backend\assets\AppAsset::className()]]);
$this->title = 'DashBoard | Administrators';
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <h1>Administrators table</h1>
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
                            return Html::img($data->getAvatar(), ['with' => 80, 'height' => 80]);
                        }
                    ],
                    'username',
                    'email',
                    [
                        'attribute' => 'created_at',
                        'format' =>  ['date', 'php:Y-m-d H:i:s'],
                    ],
                    [
                        'attribute'=>'role',
                        'filter'=>Admin::getRoles(),
                        'format'=>'raw',
                        'value' => function ($model)
                        {
                            $value = Html::activeDropDownList($model, 'role', Admin::getRoles(),['class'=>'form-control change-role', 'data-user' => $model->id,'prompt' => 'Select role']);
                            return $value;
                        }
                    ]
                ],
                'tableOptions' =>['class' => 'table table-striped table-bordered'],
            ]);?>
            </div>
        </div>
    </div>
</div>
