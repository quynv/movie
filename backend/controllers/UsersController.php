<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Quy
 * Date: 4/22/2016
 * Time: 1:58 PM
 */

namespace backend\controllers;


use backend\models\UserSearch;
use common\models\User;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class UsersController extends Controller
{
    public function actionIndex()
    {

        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
           'dataProvider' => $dataProvider,
           'searchModel' => $searchModel
        ]);
    }

    public function actionView($id)
    {
        $model = User::findOne(['id' => $id]);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionChange_status()
    {
        if (Yii::$app->request->isAjax) {
            $success = false;
            if (Yii::$app->request->isPost) {
                $user_id = Yii::$app->request->post()['id'];
                $status = Yii::$app->request->post()['status'];
                $admin = User::findOne(['id' => $user_id]);
                if($admin)
                {
                    $admin->status = $status;
                    if($admin->save(false))
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
}

