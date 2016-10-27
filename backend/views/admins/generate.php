<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \backend\models\forms\RegisterForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Admin | Generate password';
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
        <p><strong>New password:</strong><?= $new != null?$new:''?></p>
        <?= Html::submitButton('Generate', ['class' => 'btn btn-primary btn-block', 'name' => 'register-button']) ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>