<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \backend\models\forms\EmailForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Admin | email';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <h1>Send an email</h1>

    <div class="row">
        <div class="col-lg-12">
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

            <?= $form->field($model, 'email')->textInput(['class' => 'form-control', 'placeholder' => 'to Email']); ?>

            <?= $form->field($model, 'title')->textInput(['class' => 'form-control', 'placeholder' => 'Title']); ?>

            <?= $form->field($model, 'content')->textArea(['rows' => 6, 'class' => 'form-control', 'placeholder' => 'Content']) ?>


            <div class="form-group">
                <?= Html::submitButton('Send', ['class' => 'btn btn-primary rounded', 'name' => 'contact-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
