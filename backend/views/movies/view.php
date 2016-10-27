<?php

/* @var $this yii\web\View */
use yii\widgets\DetailView;
use yii\helpers\Html;

$this->title = 'Movie | Detail';
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <h1><?= $model->title?>'s Information</h1>
            <div class="table-responsive">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'label' => 'Poster',
                        'format'=>'raw',
                        'value' => Html::img($model->getPoster('w185'), ['alt' => 'poster'])
                    ],
                    'id',
                    'title',
                    'overview',
                    [
                        'label' => 'Genres',
                        'format' =>'raw',
                        'value' => implode(', ', array_map(function($entry){
                            return $entry -> name;
                        },$model->genres))
                    ],
                    [
                        'label' => 'Directors',
                        'format' =>'raw',
                        'value' => implode(', ', array_map(function($entry){
                            return $entry -> name;
                        },$model->directors))
                    ],
                    [
                        'label' => 'Actors',
                        'format'=>'raw',
                        'value' => implode(', ', array_map(function($entry){
                            return $entry -> name;
                        },$model->casts))
                    ],
                    [
                        'label' => 'Companies',
                        'format'=>'raw',
                        'value' => implode(', ', array_map(function($entry){
                            return $entry -> name;
                        },$model->companies))
                    ],
                    'released_at',
                    'runtime',
                    'tmdb_id',
                    'imdb_id',
                    [
                        'label' => 'Backdrop',
                        'format'=>'raw',
                        'value' => Html::img($model->getBackdrop('w300'), ['alt' => 'backdrop'])
                    ],
                ],
            ])?>
            </div>
        </div>
    </div>
</div>
