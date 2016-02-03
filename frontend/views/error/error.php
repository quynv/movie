<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $exception->getMessage();
?>
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="error-v4">
            <h1><?= $exception->statusCode?></h1>
            <span class="sorry">Sorry, <?= $exception->getMessage() ?>!</span>
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <a class="btn-u btn-brd btn-u-light" href="<?= Yii::$app->homeUrl?>"> Go Back to Main Page</a>
                </div>
            </div>
        </div>
    </div>
</div>