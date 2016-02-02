<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Quy
 * Date: 1/30/2016
 * Time: 11:14 PM
 */

namespace frontend\controllers;

use Yii;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use frontend\controllers\base\BaseController;
use frontend\models\forms\auth\SignupForm;
use frontend\models\forms\auth\LoginForm;
use frontend\models\forms\auth\ActiveForm;
use frontend\controllers\utilities\Email;
use frontend\models\User;

class AuthController extends BaseController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
    public function beforeAction($event)
    {
        $this->layout = "@app/views/layouts/blank";
        return parent::beforeAction($event);
    }
    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
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

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                $connection = \Yii::$app->db;
                $transaction = $connection->beginTransaction();
                if($user->save(false)) {
                    try{
                        if(Email::signup($user)){
                            $transaction->commit();
                            return $this->render('signup-success');
                        }

                    }catch (\Exception $e) {
                        $transaction->rollBack();
                        Yii::$app->session->setFlash('danger','We couldn\'t send mail to your address.<br> Please confirm your email address before sign up again!');
                    }
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionActive_account($token) {
        $user = User::findOne(['access_token' => $token]);
        if($user) {
            $user->status = User::STATUS_ACTIVE;
            $user->save(false);
            return $this->render('active-success');
        } else {
            $model = new ActiveForm();
            if($model->load(Yii::$app->request->post())) {
                $model->resend();
            }
            return $this->render('active-fail', ['model' => $model]);
        }
    }
}