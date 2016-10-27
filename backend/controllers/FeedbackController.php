<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Quy
 * Date: 4/23/2016
 * Time: 4:05 PM
 */

namespace backend\controllers;


use backend\models\FeedbackSearch;
use common\models\Feedback;
use yii\web\Controller;
use Yii;

class FeedbackController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new FeedbackSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }

    public function actionDelete($id)
    {
        $feedback = Feedback::findOne(['id' => $id]);
        if($feedback->delete())
        {
            Yii::$app->session->setFlash('success', 'This feedback has been deleted successfully.');
        }
        else
        {
            Yii::$app->session->setFlash('danger', 'An error occurred while trying delete this feedback.');
        }
        $this->redirect(['feedback/']);
    }
}