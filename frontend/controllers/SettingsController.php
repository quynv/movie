<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Quy
 * Date: 4/19/2016
 * Time: 3:07 PM
 */

namespace frontend\controllers;


use common\models\User;
use frontend\controllers\base\BaseController;
use frontend\models\forms\auth\ChangePasswordForm;
use frontend\models\forms\auth\ChangeUsernameForm;
use frontend\models\Provider;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;

class SettingsController extends BaseController
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['change_password', 'change_username', 'change_avatar', 'connect_social', 'disable_social'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => [],
                        'roles' => ['?','@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['change_password', 'change_username', 'change_avatar', 'connect_social', 'disable_social'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionChange_password()
    {
        $model = new ChangePasswordForm();
        $user = User::findOne(['id' => \Yii::$app->user->id]);
        if (Yii::$app->request->isPost)
        {
            if($model->load(Yii::$app->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success','Your password has been updated!');
            } else {
                Yii::$app->session->setFlash('danger','An error occurred while updating your username!');
            }
        }
        return $this->render('//users/setting', [
            'model' => $model,
            'user' => $user
        ]);
    }

    public function actionChange_username()
    {
        $model = new ChangeUsernameForm();
        $user = User::findOne(['id' => \Yii::$app->user->id]);
        if (Yii::$app->request->isPost)
        {
            if($model->load(Yii::$app->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success','Your username has been updated!<br> Please reload page to update all');
            } else {
                Yii::$app->session->setFlash('danger','An error occurred while updating your username!');
            }
        }
        return $this->render('//users/username', [
            'model' => $model,
            'user' => $user
        ]);
    }

    public function actionChange_avatar()
    {
        $user = User::findOne(['id' => \Yii::$app->user->id]);
        $providers = $user->providers;
        return $this->render('//users/avatar', [
            'providers' => $providers,
            'user' => $user
        ]);
    }

    public function actionConnect_social()
    {
        $user = User::findOne(['id' => \Yii::$app->user->id]);
        $providers = ArrayHelper::map($user->getProviders()->select(['id','provider'])->asArray()->all(), 'provider', 'id');
        return $this->render('//users/social', [
            'providers' => $providers,
            'user' => $user
        ]);
    }

    public function actionSelect_avatar()
    {
        if (Yii::$app->request->isAjax) {
            if (Yii::$app->request->isPost) {
                $id = Yii::$app->request->post()['id'];
                $user = User::findOne(['id' => Yii::$app->user->id]);
                $user->avatar = $id;
                $success = false;
                if($user->save(false))
                {
                    $success = true;
                }
                $response = [
                    'success' => $success,
                ];
                \Yii::$app->response->format = 'json';
                return $response;
            }
        } else {
            throw new NotFoundHttpException("Page not found");
        }
    }

    public function actionDisable_social()
    {
        $service = Yii::$app->request->get()['authclient'];
        switch($service)
        {
            case 'facebook':
            case 'google':
            case 'twitter':
                $provider = Provider::findOne(['provider' => $service, 'user_id' => Yii::$app->user->id]);
                $user = User::findOne(['id' => Yii::$app->user->id]);
                if($user->avatar == $provider->id)
                {
                    $user->avatar = User::NONE_AVATAR;
                    $user->save(false);
                }
                $provider->delete();
                break;

        }
        return $this->redirect('/settings/connect_social');
    }
}