<?php

/* @var $this yii\web\View */
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'DashBoard | Contribution';
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <h1>Contribution table</h1>
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
                        'tmdb_id',
                        [
                            'label' => 'Check data on TMDB',
                            'format' => 'raw',
                            'value' => function($model)
                            {
                                $value = '<form action="/movies/new" method="get">';
                                $value .= '<input type="hidden" name="TmdbForm[tmdb]" value="'.$model->tmdb_id.'">';
                                $value .= '<button class="btn btn-success btn-block" type="submit">Check</button>';
                                $value .= '</form>';
                                return $value;
                            }
                        ],
                        [
                            'label' => 'Available',
                            'format' => 'raw',
                            'value' => function($model)
                            {
                                if($model->available)
                                {
                                    return '<i class="glyphicon glyphicon-ok text-success"></i> Available';
                                }
                                return '<i class="glyphicon glyphicon-time text-warning"></i> Waiting';
                            }
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
