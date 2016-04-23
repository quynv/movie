<?php
namespace backend\controllers;

use common\models\Actor;
use common\models\Company;
use common\models\Director;
use common\models\Genre;
use common\models\Movie;
use common\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
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

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $movies = Movie::find()->count();
        $users = User::find()->count();
        $genres = Genre::find()->count();
        $actors = Actor::find()->select(['cast_id'])->distinct()->count();
        $directors = Director::find()->select(['cast_id'])->distinct()->count();
        $companies = Company::find()->count();
        return $this->render('index',[
            'movies' => $movies,
            'users' => $users,
            'genres' => $genres,
            'actors' => $actors,
            'directors' => $directors,
            'companies' => $companies
        ]);
    }
}
