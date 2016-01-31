<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use himiklab\yii2\recaptcha\ReCaptcha;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<!--Reg Block-->
<div class="reg-block">
    <div class="reg-block-header">
        <h2>Sign Up</h2>
        <p>Already Signed Up? Click <a class="color-teal" href="<?= Url::toRoute('auth/login')?>">Sign In</a> to login your account.</p>
    </div>
    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
    <?= $form->field($model, 'username', [
        'template' => '
            <div class="input-group margin-bottom-20">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                {input}
            </div>
            <strong class="text-danger">{error}</strong>
        ',
    ])->textInput(['placeholder' => 'Username']); ?>
    <?= $form->field($model, 'email', [
        'template' => '
            <div class="input-group margin-bottom-20">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                {input}
            </div>
            <strong class="text-danger">{error}</strong>
        '
    ])->textInput(['placeholder' => 'Email']); ?>
    <?= $form->field($model, 'password', [
        'template' => '
            <div class="input-group margin-bottom-20">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                {input}
            </div>
            <strong class="text-danger">{error}</strong>
        '
    ])->passwordInput(['placeholder' => 'Password']); ?>
    <?= $form->field($model, 'confirmation', [
        'template' => '
            <div class="input-group margin-bottom-20">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                {input}
            </div>
            <strong class="text-danger">{error}</strong>
        '
    ])->passwordInput(['placeholder' => 'Confirmation']); ?>
    <hr>
    <?= $form->field($model, 'reCaptcha',[
        'template' =>'
        {input}
        <strong class="text-danger">{error}</strong>
        '
    ])->widget(ReCaptcha::className()) ?>
    <?= $form->field($model, 'accept', [
        'checkboxTemplate' => '
            <div class="checkbox">
                <label>
                    {input}
                    I read <a target="_blank" href="page_terms.html">Terms and Conditions</a>
                </label>
            </div>
            <strong class="text-danger">{error}</strong>
        '
    ])->checkbox(); ?>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <?= Html::submitButton('Register', ['class' => 'btn-u btn-block', 'name' => 'register-button']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<!--End Reg Block-->