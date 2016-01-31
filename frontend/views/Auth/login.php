<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<!--Reg Block-->
<div class="reg-block">
    <div class="reg-block-header">
        <h2>Sign In</h2>
        <p>Don't Have Account? Click <a class="color-green" href="<?= Url::toRoute('auth/signup')?>">Sign Up</a> to registration.</p>
    </div>
    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
    <?= $form->field($model, 'email',[
        'template' => '
        <div class="input-group margin-bottom-20">
            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
            {input}
        </div>
        <strong class="text-danger">{error}</strong>'
    ])->textInput(['placeholder' => 'Email']); ?>
    <?= $form->field($model, 'password', [
        'template' => '
        <div class="input-group margin-bottom-20">
            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
            {input}
        </div>
        <strong class="text-danger">{error}</strong>'
    ])->passwordInput(['placeholder' => 'Password']); ?>
    <hr>

    <?= $form->field($model, 'rememberMe',[
    'checkboxTemplate' => '
    <div class="checkbox">
        <label>
            {input}
            <p>Always stay signed in</p>
        </label>
        <strong class="text-danger">{error}</strong>
    </div>'
    ])->checkbox() ?>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <?= Html::submitButton('Login', ['class' => 'btn-u btn-block', 'name' => 'login-button']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<!--End Reg Block-->