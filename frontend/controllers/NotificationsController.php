<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Quy
 * Date: 5/22/2016
 * Time: 2:16 PM
 */

namespace frontend\controllers;


use frontend\controllers\base\BaseController;
use frontend\models\Notification;
use yii\filters\AccessControl;

class NotificationsController extends BaseController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => [],
                        'roles' => ['?','@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['delete'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionDelete($id)
    {
        $notify = Notification::findOne(['id' => $id, 'user_id' => \Yii::$app->user->id]);
        if($notify)
        {
            $notify->delete(false);
            \Yii::$app->session->setFlash('success','This notification has been deleted!');
        } else {
            \Yii::$app->session->setFlash('danger','An error occurred while deleting this notification!');
        }

        $this->redirect('/u/'.\Yii::$app->user->identity->username.'/notifications');
    }
}