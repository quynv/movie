<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Quy
 * Date: 4/7/2016
 * Time: 1:08 AM
 */

namespace frontend\controllers;


use frontend\controllers\base\BaseController;
use frontend\models\Notification;
use frontend\models\Request;
use yii\filters\AccessControl;
use Yii;
use yii\web\NotFoundHttpException;

class RequestsController extends BaseController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['check', 'uncheck'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => [],
                        'roles' => ['?','@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['check', 'uncheck'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionCheck()
    {
        if (Yii::$app->request->isAjax) {
            $success = false;
            if (Yii::$app->request->isPost) {
                $requested = Yii::$app->request->post()['id'];
                $movie = Yii::$app->request->post()['movie'];
                $request = new Request();
                $request->user_id = Yii::$app->user->id;
                $request->requested = $requested;
                $request->movie_id = $movie;
                if($request->save(false))
                {
                    Notification::addNotification($requested, Notification::REQUEST, $request->id);
                    $success = true;
                }
            }
            $response = [
                'success' => $success,
            ];
            \Yii::$app->response->format = 'json';
            return $response;
        }
        else
        {
            throw new NotFoundHttpException("Page not found");
        }
    }

    public function actionUncheck()
    {
        if (Yii::$app->request->isAjax) {
            $success = false;
            if (Yii::$app->request->isPost) {
                $requested = Yii::$app->request->post()['id'];
                $movie = Yii::$app->request->post()['movie'];
                $request = Request::findOne([
                    'user_id' => Yii::$app->user->id,
                    'requested' => $requested,
                    'movie_id' => $movie]);
                if($request)
                {
                    $request->delete();
                    $success = true;
                }
            }
            $response = [
                'success' => $success,
            ];
            \Yii::$app->response->format = 'json';
            return $response;
        }
        else
        {
            throw new NotFoundHttpException("Page not found");
        }
    }
}