<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \backend\models\forms\RegisterForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Admin | Update';
?>

<div class="register-page">
    <div class="form">
        <h1>Update password</h1>
        <?php $form = ActiveForm::begin(['class' => 'login-form']); ?>

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
        <?= $form->field($model, 'old_password',[
            'template' => '
                {input}
                <p class="text-danger">{error}</p>'
        ])->passwordInput(['placeholder' => 'Old password']); ?>
        <?= Html::submitButton('Update', ['class' => 'btn btn-primary btn-block', 'name' => 'register-button']) ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>