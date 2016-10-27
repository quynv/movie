<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\forms\ContributionForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Alert;

$this->title = 'Movie | Contributions';
?>
<div class="container">
    <br>
    <br>
    <br>
    <br>
    <h1>Contributions</h1>
    <br>
    <br>
    <div class="row">
        <div class="col-lg-5">
            <?php
            if(Yii::$app->session->getAllFlashes()) {
                foreach (Yii::$app->session->getAllFlashes() as $name => $value) {
                    echo Alert::widget([
                        'options' => [
                            'class' => 'alert-' . $name,
                        ],
                        'body' => $value,
                    ]);
                }
            }
            ?>
            <?php $form = ActiveForm::begin(['id' => 'contribution-form']); ?>

            <?= $form->field($model, 'email',[
                'template' => '
                {label}
                <div class="input-group margin-bottom-20">
                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                    {input}
                </div>
                <strong class="text-danger">{error}</strong>'
            ])->textInput(['placeholder' => 'Email']); ?>

            <?= $form->field($model, 'tmdb',[
                'template' => '
                {label}
                <div class="input-group margin-bottom-20">
                    <span class="input-group-addon"><i class="fa fa-film"></i></span>
                    {input}
                </div>
                <strong class="text-danger">{error}</strong>'
            ])->textInput(['placeholder' => 'Tmdb ID']); ?>


            <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary rounded', 'name' => 'contribution-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
