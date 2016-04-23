<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Quy
 * Date: 4/23/2016
 * Time: 9:32 PM
 */

namespace frontend\controllers;


use frontend\controllers\base\BaseController;
use frontend\models\forms\FeedbackForm;
use Yii;

class FeedbackController extends BaseController
{
    public function actionIndex()
    {
        $model = new FeedbackForm();
        if($model->load(Yii::$app->request->post()))
        {
            if($model->save())
            {
                Yii::$app->session->setFlash('success', 'Thank you!<br>we will feedback to you soon');
            }
            else
            {
                Yii::$app->session->setFlash('danger', 'An error occurred while trying insert new record.');
            }
        }

        return $this->render('index', [
            'model' => $model
        ]);
    }
}