<?php

/* @var $this yii\web\View */
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'DashBoard | Actors';
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <h1>Actors table</h1>
            <div class="table-responsive">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'showOnEmpty'=>true,
                    'columns' => [
                        [
                            'attribute'=>'id',
                            'options' => ['width' => '80'],
                            'value' => 'cast_id'
                        ],
                        [
                            'label'=>'Avatar',
                            'format'=>'raw',
                            'value' => function($data) {
                                return Html::img($data->getAvatar('w185'), ['width' => 185,'alt' => 'avatar']);
                            }
                        ],
                        'name'
                    ],
                    'tableOptions' =>['class' => 'table table-striped table-bordered'],
                ]);?>
            </div>
        </div>
    </div>
</div>
