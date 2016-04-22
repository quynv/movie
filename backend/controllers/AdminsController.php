<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Quy
 * Date: 4/22/2016
 * Time: 4:50 PM
 */

namespace backend\controllers;

use backend\models\AdminSearch;
use yii\web\Controller;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\components\AccessRule;
use backend\models\Admin;
use yii\web\NotFoundHttpException;

class AdminsController extends Controller
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
                'only' => ['index', 'change_role'],
                'rules' => [
                    [
                        'actions' => ['index', 'change_role'],
                        'allow' => true,
                        'roles' => [
                            Admin::OWNER
                        ],
                    ],
                ],
            ],
        ];
    }

    
    public function actionIndex()
    {
        $searchModel = new AdminSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }

    public function actionChange_role()
    {
        if (Yii::$app->request->isAjax) {
            $success = false;
            if (Yii::$app->request->isPost) {
                $user_id = Yii::$app->request->post()['id'];
                $role = Yii::$app->request->post()['role'];
                $admin = Admin::findOne(['id' => $user_id]);
                if($admin)
                {
                    $admin->role = $role;
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