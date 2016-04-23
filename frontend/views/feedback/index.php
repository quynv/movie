<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\forms\FeedbackForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Alert;
use himiklab\yii2\recaptcha\ReCaptcha;

$this->title = 'Feedback';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <h1>Feedback</h1>

    <p>
        If you have business inquiries or other questions, please fill out the following form to feedback us. Thank you.
    </p>

    <div class="row">
        <div class="col-lg-12">
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
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

            <?= $form->field($model, 'email')->textInput(['class' => 'form-control', 'placeholder' => 'Email']); ?>

            <?= $form->field($model, 'content')->textArea(['rows' => 6, 'class' => 'form-control', 'placeholder' => 'Content']) ?>

            <?= $form->field($model, 'reCaptcha',[
                'template' =>'
                {input}
                <strong class="text-danger">{error}</strong>
                '
            ])->widget(ReCaptcha::className()) ?>

            <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary rounded', 'name' => 'contact-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
