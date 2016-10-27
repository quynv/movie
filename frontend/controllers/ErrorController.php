<?php

namespace frontend\controllers;

use \frontend\controllers\base\BaseController;
use Yii;

class ErrorController extends BaseController
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function beforeAction($event)
    {
        $this->layout = "@app/views/layouts/error";
        return parent::beforeAction($event);
    }

    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            $this->render('error', ['exception' => $exception]);
        }
    }

}
