<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Quy
 * Date: 4/23/2016
 * Time: 4:15 PM
 */

namespace frontend\controllers;


use frontend\controllers\base\BaseController;
use frontend\models\forms\ContributionForm;
use Yii;

class ContributionsController extends BaseController
{
    public function actionIndex()
    {
        $model = new ContributionForm();
        if($model->load(Yii::$app->request->post()))
        {
            if($model->save())
            {
                Yii::$app->session->setFlash('success', 'Thank you for contribution!');
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