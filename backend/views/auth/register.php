<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \backend\models\forms\RegisterForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Admin | Register';
?>

<div class="register-page">
    <div class="form">
        <h1>Register admin</h1>
        <?php $form = ActiveForm::begin(['class' => 'login-form']); ?>
        <?= $form->field($model, 'email',[
            'template' => '
                {input}
                <p class="text-danger">{error}</p>'
        ])->textInput(['placeholder' => 'Email']); ?>
        <?= $form->field($model, 'password',[
            'template' => '
                {input}
                <p class="text-danger">{error}</p>'
        ])->passwordInput(['placeholder' => 'Password']); ?>
        <?= $form->field($model, 'confirmation',[
            'template' => '
                {input}
                <p class="text-danger">{error}</p>'
        ])->passwordInput(['placeholder' => 'Confirmation']); ?>
        <?= Html::submitButton('Register', ['class' => 'btn btn-primary btn-block', 'name' => 'register-button']) ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>