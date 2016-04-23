<?php

/* @var $this yii\web\View */
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'DashBoard | Feedback';
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <h1>Feedback table</h1>
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
                        'email',
                        'content',
                        [
                            'attribute' => 'created_at',
                            'options' => ['width' => '160'],
                            'format' =>  ['date', 'php:Y-m-d H:i:s'],
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'header' => 'Action',
                            'template' => '{delete}{link}',
                        ],
                    ],
                    'tableOptions' =>['class' => 'table table-striped table-bordered'],
                ]);?>
            </div>
        </div>
    </div>
</div>
