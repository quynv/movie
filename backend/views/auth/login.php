<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Admin | Login';
?>

<div class="login-page">
    <div class="form">
        <h1>Login</h1>
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

            <?= Html::submitButton('Login', ['class' => 'btn-u btn-block', 'name' => 'login-button']) ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>