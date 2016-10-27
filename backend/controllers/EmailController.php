<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Quy
 * Date: 4/23/2016
 * Time: 10:39 PM
 */

namespace backend\controllers;


use backend\models\forms\EmailForm;
use Yii;
use yii\web\Controller;

class EmailController extends Controller
{
    public function actionIndex()
    {
        $model = new EmailForm();
        if($model->load(Yii::$app->request->post()))
        {
            if($model->send())
            {
                Yii::$app->session->setFlash('success', 'Send mail successfully.');
            }
            else
            {
                Yii::$app->session->setFlash('danger', 'An error occurred while trying send email.');
            }
        }

        return $this->render('index', [
            'model' => $model
        ]);
    }
}