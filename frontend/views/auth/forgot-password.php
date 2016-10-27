<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\Alert;
use yii\bootstrap\ActiveForm;
use himiklab\yii2\recaptcha\ReCaptcha;

$this->title = Yii::t('frontend/views.login','Forgot password');
$this->params['breadcrumbs'][] = $this->title;
?>

<!--Reg Block-->
<div class="reg-block">
    <div class="reg-block-header">
        <h2><?= Yii::t('frontend/views.login', 'Forgot password')?></h2>
    </div>
    <br>
    <?php
    if(Yii::$app->session->getAllFlashes()) {
        foreach (Yii::$app->session->getAllFlashes() as $name => $value) {
            echo Alert::widget([
                'options' => [
                    'class' => 'alert-' . $name,
                ],
                'body' => $value,
            ]);
        }
    }
    ?>
    <br>
    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
    <?= $form->field($model, 'email',[
        'template' => '
        <div class="input-group margin-bottom-20">
            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
            {input}
        </div>
        <strong class="text-danger">{error}</strong>'
    ])->textInput(['placeholder' => 'Email']); ?>
    <?= $form->field($model, 'reCaptcha',[
        'template' =>'
        {input}
        <strong class="text-danger">{error}</strong>
        '
    ])->widget(ReCaptcha::className()) ?>
    <hr>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <?= Html::submitButton(Yii::t('frontend/views.login','Submit'), ['class' => 'btn-u btn-block rounded', 'name' => 'login-button']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
    <br>
</div>
<!--End Reg Block-->