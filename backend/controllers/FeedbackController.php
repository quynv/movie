<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Quy
 * Date: 4/23/2016
 * Time: 4:05 PM
 */

namespace backend\controllers;


use backend\models\FeedbackSearch;
use backend\models\forms\EmailForm;
use common\models\Feedback;
use yii\web\Controller;
use Yii;
use yii\web\NotFoundHttpException;

class FeedbackController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new FeedbackSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new EmailForm();
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'model' => $model
        ]);
    }

    public function actionChange_status()
    {
        if (Yii::$app->request->isAjax) {
            $success = false;
            if (Yii::$app->request->isPost) {
                $feedback_id = Yii::$app->request->post()['id'];
                $status = Yii::$app->request->post()['status'];
                $feedback = Feedback::findOne(['id' => $feedback_id]);
                if($feedback)
                {
                    $feedback->status = $status;
                    if($feedback->save(false))
                    {
                        $success = true;
                    }
                }
                $response = [
                    'success' => $success,
                ];
                \Yii::$app->response->format = 'json';
                return $response;
            }
        } else {
            throw new NotFoundHttpException("Page not found.");
        }
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