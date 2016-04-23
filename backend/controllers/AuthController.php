<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Quy
 * Date: 4/22/2016
 * Time: 1:08 AM
 */

namespace backend\controllers;

use backend\models\forms\UpdateForm;
use Yii;
use backend\models\forms\RegisterForm;
use backend\models\forms\LoginForm;
use yii\web\Controller;
use backend\components\AccessRule;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\Admin;

class AuthController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'only' => ['index', 'register', 'update', 'delete'],
                'rules' => [
                    [
                        'actions' => ['update'],
                        'allow' => true,
                        // Allow moderators and admins to update
                        'roles' => [
                            Admin::OWNER,
                            Admin::ADMIN
                        ],
                    ],
                    [
                        'actions' => ['register', 'index', 'delete'],
                        'allow' => true,
                        // Allow admins to delete
                        'roles' => [
                            Admin::OWNER
                        ],
                    ],
                ],
            ],
        ];
    }


    public function actionRegister()
    {
        $model = new RegisterForm();
        if($model->load(Yii::$app->request->post()))
        {
            if($model->save())
            {
                Yii::$app->session->setFlash('success', 'Admin has been inserted successfully.');
            } else {
                Yii::$app->session->setFlash('danger', 'An error occurred while trying insert new record.');
            }
        }
        return $this->render('register',[
            'model' => $model
        ]);
    }

    public function actionLogin()
    {
        $this->layout = "@app/views/layouts/blank";
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate()
    {
        $model = new UpdateForm();
        if($model->load(Yii::$app->request->post()))
        {
            if($model->save())
            {
                Yii::$app->session->setFlash('success', 'Your password updated');
            }
            else
            {
                Yii::$app->session->setFlash('danger', 'An error occurred while trying update your password.');
            }
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect(['auth/login']);
    }
}