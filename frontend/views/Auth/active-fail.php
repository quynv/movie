<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\forms\auth\SignupForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use himiklab\yii2\recaptcha\ReCaptcha;

$this->title = 'Resend email';
$this->params['breadcrumbs'][] = $this->title;
?>
<!--Reg Block-->
<div class="reg-block">
    <div class="reg-block-header">
        <h2>Resend email</h2>
        <p>Already Signed Up? Click <a class="color-teal" href="<?= Url::toRoute('auth/login')?>">Sign In</a> to login your account.</p>
    </div>
    <h3>Your access token is invalid or has expired.</h3>
    <p>Please enter and submit your email to generate new token.</p>
    <?= $this->render('//layouts/alert',[])?>
    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
    <?= $form->field($model, 'email', [
        'template' => '
            <div class="input-group margin-bottom-20">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                {input}
            </div>
            <strong class="text-danger">{error}</strong>
        '
    ])->textInput(['placeholder' => 'Email']); ?>

    <hr>
    <?= $form->field($model, 'reCaptcha',[
        'template' =>'
        {input}
        <strong class="text-danger">{error}</strong>
        '
    ])->widget(ReCaptcha::className()) ?>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <?= Html::submitButton('Resend', ['class' => 'btn-u btn-block', 'name' => 'register-button']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<!--End Reg Block-->