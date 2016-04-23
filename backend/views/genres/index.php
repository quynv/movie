<?php

/* @var $this yii\web\View */
use yii\grid\GridView;

$this->title = 'DashBoard | Genres';
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <h1>Genres table</h1>
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
                        'name',
                    ],
                    'tableOptions' =>['class' => 'table table-striped table-bordered'],
                ]);?>
            </div>
        </div>
    </div>
</div>
