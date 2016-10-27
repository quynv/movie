<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\forms\auth\SignupForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use himiklab\yii2\recaptcha\ReCaptcha;

$this->title = 'Completed signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<!--Reg Block-->
<div class="reg-block">
    <div class="reg-block-header">
        <h2>Completed Your Registration</h2>
    </div>
    <h1>Congratulations!</h1>

    <p class="lead">You have successfully created your account.</p>

    <p><a class="btn-u btn-block" href="<?= Url::toRoute('auth/login')?>" style="text-decoration: none">Home</a></p>
</div>
<!--End Reg Block-->