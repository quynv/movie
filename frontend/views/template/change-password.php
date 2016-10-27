<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Alert;
use yii\helpers\Html;
?>
<div id="passwordTab" class="profile-edit tab-pane">
    <h2 class="heading-md">Manage your Security Settings</h2>

    <p>Change your password.</p>
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
    <?= $form->field($model, 'password', [
        'template' => '
        <div class="input-group margin-bottom-20">
            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
            {input}
        </div>
        <strong class="text-danger">{error}</strong>'
    ])->passwordInput(['placeholder' => Yii::t('frontend/views.login','New Password')]); ?>
    <?= $form->field($model, 'confirmation', [
        'template' => '
        <div class="input-group margin-bottom-20">
            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
            {input}
        </div>
        <strong class="text-danger">{error}</strong>'
    ])->passwordInput(['placeholder' => Yii::t('frontend/views.login','Confirmation Password')]); ?>
    <?= $form->field($model, 'old_password', [
        'template' => '
        <div class="input-group margin-bottom-20">
            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
            {input}
        </div>
        <strong class="text-danger">{error}</strong>'
    ])->passwordInput(['placeholder' => Yii::t('frontend/views.login','Old Password')]); ?>
    <hr>

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <button type="reset" class="btn btn-default rounded">Reset</button>
            <?= Html::submitButton(Yii::t('frontend/views.login','Save changes'), ['class' => 'btn-u rounded', 'name' => 'login-button']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>