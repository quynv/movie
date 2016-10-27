<?php

/* @var $this yii\web\View */
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'DashBoard | Movies';
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <h1>Movies table</h1>
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
                            'label'=>'Poster',
                            'format'=>'raw',
                            'value' => function($data) {
                                return Html::img($data->getPoster('w154'), ['alt' => 'poster']);
                            }
                        ],
                        'title',
                        [
                            'label'=>'Tmdb',
                            'attribute'=>'tmdb_id',
                            'format'=>'raw',
                            'value' => function($data) {
                                return $data->tmdb_id;
                            }
                        ],
                        [
                            'label'=>'Imdb',
                            'attribute'=>'imdb_id',
                            'format'=>'raw',
                            'value' => function($data) {
                                return $data->imdb_id;
                            }
                        ],
                        [
                            'label' => 'released date',
                            'value' => function($data) {
                                return $data->released_at;
                            }
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'header' => 'Action',
                            'template' => '{view} {delete}{link}',
                        ],
                    ],
                    'tableOptions' =>['class' => 'table table-striped table-bordered'],
                ]);?>
            </div>
        </div>
    </div>
</div>
