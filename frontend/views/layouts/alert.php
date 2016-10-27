<?php
use yii\bootstrap\Alert;

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
