<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\forms\auth\SignupForm */

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
    <h1>Congratulations!</h1>

    <p class="lead">You have successfully created your account.</p>
    <p>Please check your email to confirm your email.</p>
    <p><a class="btn-u btn-block" href="<?= Yii::$app->homeUrl?>" style="text-decoration: none">Home</a></p>
</div>
<!--End Reg Block-->