<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\forms\auth\SignupForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use himiklab\yii2\recaptcha\ReCaptcha;

$this->title = Yii::t('frontend/views.signup','Sign up');
$this->params['breadcrumbs'][] = $this->title;
?>
<!--Reg Block-->
<div class="reg-block">
    <div class="reg-block-header">
        <h2><?= Yii::t('frontend/views.signup','Sign up')?></h2>
        <p><?= Yii::t('frontend/views.signup','Already Signed Up? Click {link} to login your account.',['link' => Html::a(Yii::t('frontend/views.signup','Sign In'), Url::toRoute('auth/login'), ['class' => 'color-teal'])])?></p>
    </div>
    <?= $this->render('//layouts/alert',[])?>
    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
    <?= $form->field($model, 'username', [
        'template' => '
            <div class="input-group margin-bottom-20">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                {input}
            </div>
            <strong class="text-danger">{error}</strong>
        ',
    ])->textInput(['placeholder' => Yii::t('frontend/views.signup','Username')]); ?>
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
    ])->passwordInput(['placeholder' => Yii::t('frontend/views.signup','Password')]); ?>
    <?= $form->field($model, 'confirmation', [
        'template' => '
            <div class="input-group margin-bottom-20">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                {input}
            </div>
            <strong class="text-danger">{error}</strong>
        '
    ])->passwordInput(['placeholder' => Yii::t('frontend/views.signup','Confirmation')]); ?>
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
                    '.Yii::t('frontend/views.signup','I read {link}.', ['link' => Html::a(Yii::t('frontend/views.signup','Terms and Conditions'), Url::toRoute('#'), ['target' => '_blank'])]).'
                </label>
            </div>
            <strong class="text-danger">{error}</strong>
        '
    ])->checkbox(); ?>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <?= Html::submitButton(Yii::t('frontend/views.signup','Register'), ['class' => 'btn-u btn-block rounded', 'name' => 'register-button']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
    <hr>
    <div class="row">
        <div class="heading heading-v1">
            <h5>Sign up by</h5>
        </div>
        <div class="col-md-10 col-md-offset-1">
            <a href="<?= Url::toRoute(['auth/auth', 'authclient' => 'facebook'])?>" class="btn btn-block btn-facebook-inversed rounded">
                <i class="fa fa-facebook"></i>
                Facebook
            </a>
            <a href="<?= Url::toRoute(['auth/auth', 'authclient' => 'twitter'])?>" class="btn btn-block btn-twitter-inversed rounded">
                <i class="fa fa-twitter"></i>
                Twitter
            </a>
            <a href="<?= Url::toRoute(['auth/auth', 'authclient' => 'google'])?>" class="btn btn-block btn-googleplus-inversed rounded">
                <i class="fa fa-google-plus"></i>
                Google +
            </a>
        </div>
    </div>
</div>
<!--End Reg Block-->