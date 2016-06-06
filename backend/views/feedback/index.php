<?php

/* @var $this yii\web\View */
use yii\grid\GridView;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\Feedback;
$this->registerJsFile(Yii::$app->urlManager->baseUrl.'/js/feedback.js',['depends' => [\backend\assets\AppAsset::className()]]);

$this->title = 'DashBoard | Feedback';
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <h1>Feedback table</h1>
            <div class="table-responsive">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'showOnEmpty'=>true,
                    'columns' => [
                        [
                            'attribute'=>'id',
                            'options' => ['width' => '80']
                        ],
                        'email',
                        'content',
                        [
                            'attribute' => 'created_at',
                            'options' => ['width' => '160'],
                            'format' =>  ['date', 'php:Y-m-d H:i:s'],
                        ],
                        [
                            'attribute'=>'status',
                            'options' => ['width' => '240'],
                            'filter'=>Feedback::getStatus(),
                            'format'=>'raw',
                            'value' => function ($model)
                            {
                                $value = Html::activeDropDownList($model, 'status', Feedback::getStatus(),['class'=>'form-control change-status', 'data-feedback' => $model->id,'prompt' => 'Select status']);
                                return $value;
                            }
                        ],
                        [
                            'header' => 'Response',
                            'format'=>'raw',
                            'value' => function ($model)
                            {
                                $value = Html::button('to '.$model->email,['class' => 'btn btn-primary rounded', 'data-toggle' => 'modal', 'data-target' => '#sendmailmodal', 'data-whatever' => $model->email]);
                                return $value;
                            }
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'header' => 'Action',
                            'template' => '{delete}{link}',
                        ],
                    ],
                    'tableOptions' =>['class' => 'table table-striped table-bordered'],
                ]);?>
            </div>
        </div>
    </div>
</div>
<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="sendmailmodal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">New message</h4>
            </div>
            <?php $form = ActiveForm::begin([
                'id' => 'contact-form',
                'action' => Yii::$app->urlManager->createUrl(['email/index'])
            ]); ?>
            <div class="modal-body">
                <?= $form->field($model, 'email')->textInput(['class' => 'form-control recipient', 'placeholder' => 'to Email']); ?>

                <?= $form->field($model, 'title')->textInput(['class' => 'form-control', 'placeholder' => 'Title']); ?>

                <?= $form->field($model, 'content')->textArea(['rows' => 6, 'class' => 'form-control', 'placeholder' => 'Content']) ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Send message</button>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>