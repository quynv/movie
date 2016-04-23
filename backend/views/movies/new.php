<?php

/* @var $this yii\web\View */
use yii\widgets\DetailView;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Movie | Add';
?>
<div class="site-index">
    <div class="body-content">
        <h1>Add new movie</h1>
        <div class="row">
            <?php $form = ActiveForm::begin(['method' => 'get', 'options' => ['class' => 'login-form']]); ?>
            <?= $form->field($model, 'tmdb',[
                'template' => '
                {input}
                {error}'
            ])->textInput(['placeholder' => 'Enter Tmdb ID']); ?>
            <?= Html::submitButton('Check', ['class' => 'btn btn-primary', 'value' => 0, 'name' => 'view-button']) ?>
            <?= Html::submitButton('Insert', ['class' => 'btn btn-success', 'value' => 1, 'name' => 'insert', 'disabled' => isset($movie)?false:'disabled']) ?>
            <?php ActiveForm::end(); ?>
        </div>
        <br>
        <div class="row">
            <?php if(isset($movie)) {?>
            <h1><?= $movie->getTitle()?></h1>
            <div class="table-responsive">
            <?= DetailView::widget([
                'model' => $movie,
                'attributes' => [
                    [
                        'label' => 'Poster',
                        'format'=>'raw',
                        'value' => Html::img($movie->getPoster('w185'), ['alt' => 'poster'])
                    ],
                    [
                        'label' => 'Title',
                        'format' => 'raw',
                        'value' => $movie->getTitle()
                    ],
                    [
                        'label' => 'Overview',
                        'format' => 'raw',
                        'value' => $movie->getOverview()
                    ],
                    [
                        'label' => 'Genres',
                        'format' =>'raw',
                        'value' => implode(', ', array_map(function($entry){
                            return $entry['name'];
                        },$movie->getGenres()))
                    ],
                    [
                        'label' => 'Directors',
                        'format' =>'raw',
                        'value' => implode(', ', array_map(function($entry){
                            return $entry['name'];
                        },$movie->getDirectors()))
                    ],
                    [
                        'label' => 'Actors',
                        'format'=>'raw',
                        'value' => implode(', ', array_map(function($entry){
                            return $entry['name'];
                        },$movie->getCasts()))
                    ],
                    [
                        'label' => 'Companies',
                        'format'=>'raw',
                        'value' => implode(', ', array_map(function($entry){
                            return $entry['name'];
                        },$movie->getCompanies()))
                    ],
                    [
                        'label' => 'Release Date',
                        'format' => 'raw',
                        'value' => $movie->getReleaseDate()
                    ],
                    [
                        'label' => 'Runtime',
                        'format' => 'raw',
                        'value' => $movie->getRuntime()
                    ],
                    [
                        'label' => 'Tmdb ID',
                        'format' => 'raw',
                        'value' => $movie->getTmdb_id()
                    ],
                    [
                        'label' => 'Imdb ID',
                        'format' => 'raw',
                        'value' => $movie->getImdb_id()
                    ],
                    [
                        'label' => 'Backdrop',
                        'format'=>'raw',
                        'value' => Html::img($movie->getBackdrop('w300'), ['alt' => 'backdrop'])
                    ],
                ],
            ])?>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
