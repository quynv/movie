<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('frontend/views.login','Login');
$this->params['breadcrumbs'][] = $this->title;
?>

<!--Reg Block-->
<div class="reg-block">
    <div class="reg-block-header">
        <h2><?= Yii::t('frontend/views.login', 'Sign In')?></h2>
        <p><?= Yii::t('frontend/views.login', 'Don\'t Have Account? Click {link} to registration.',['link' => Html::a(Yii::t('frontend/views.login','Sign up'), Url::toRoute('auth/signup'), ['class' => 'color-green'])])?></p>
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
    ])->passwordInput(['placeholder' => Yii::t('frontend/views.login','Password')]); ?>
    <hr>

    <?= $form->field($model, 'rememberMe',[
    'checkboxTemplate' => '
    <div class="checkbox">
        <label>
            {input}
            <p>'.Yii::t('frontend/views.login','Always stay signed in').'</p>
        </label>
        <strong class="text-danger">{error}</strong>
    </div>'
    ])->checkbox() ?>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <?= Html::submitButton(Yii::t('frontend/views.login','Login'), ['class' => 'btn-u btn-block', 'name' => 'login-button']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
    <hr>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <a href="<?= Url::toRoute(['auth/auth', 'authclient' => 'facebook'])?>">
                <?= Html::img('@web/img/btn/fb_btn.png',['width' => '278', 'height' => '54'])?>
            </a>
        </div>
    </div>
</div>
<!--End Reg Block-->