<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Quy
 * Date: 4/6/2016
 * Time: 9:39 PM
 */

namespace frontend\controllers;

use frontend\models\Follow;
use Yii;
use frontend\controllers\base\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;

class FollowController extends BaseController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['follow', 'unfollow'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => [],
                        'roles' => ['?','@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['follow', 'unfollow'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionFollow()
    {
        if (Yii::$app->request->isAjax) {
            $success = false;
            if (Yii::$app->request->isPost) {
                $followed = Yii::$app->request->post()['id'];
                $follow = new Follow();
                $follow->user_id = Yii::$app->user->id;
                $follow->followed = $followed;
                if($follow->save(false))
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
        else
        {
            throw new NotFoundHttpException("Page not found");
        }
    }

    public function actionUnfollow()
    {
        if (Yii::$app->request->isAjax) {
            $success = false;
            if (Yii::$app->request->isPost) {
                $followed = Yii::$app->request->post()['id'];
                $follow = Follow::findOne(['user_id' => Yii::$app->user->id, 'followed' => $followed]);
                if($follow)
                {
                    $follow->delete();
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