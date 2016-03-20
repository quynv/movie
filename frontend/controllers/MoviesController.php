<?php
namespace frontend\controllers;

use Yii;
use common\models\Movie;
use frontend\controllers\base\BaseController;
use \yii\web\NotFoundHttpException;
use yii\filters\AccessControl;

class MoviesController extends BaseController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['recommended', 'detail'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['detail'],
                        'roles' => ['?','@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['recommended'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    function actionDetail($id)
    {
        $this->layout = "@app/views/layouts/base";
        $movie = Movie::findOne(['id' => $id]);
        $this->movie = $movie;
        if(isset($movie)) {
            return $this->render('detail', [
                'movie' => $movie,
            ]);
        } else {
            throw new NotFoundHttpException('Movie not found');
        }
    }

    function actionRecommended()
    {
        $this->layout = "@app/views/layouts/base";
        $movies = Movie::getUserBaseRecommends(Yii::$app->user,40);

        if(isset($movies)) {
            return $this->render('recommend', [
                'movies' => $movies,
            ]);
        } else {
            throw new NotFoundHttpException('Entry not found');
        }
    }
}