<?php
namespace frontend\controllers;

use Yii;
use common\models\Movie;
use frontend\controllers\base\BaseController;
use \yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\data\Pagination;

class MoviesController extends BaseController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['recommended', 'detail', 'search'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['detail', 'search'],
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

    function actionSearch()
    {
        $text = Yii::$app->getRequest()->getQueryParam('keyword');
        $year = Yii::$app->getRequest()->getQueryParam('year');
        $genre = Yii::$app->getRequest()->getQueryParam('genre');
        $query = Movie::find();
        if($text) {
            $query->andWhere(['LIKE', 'title', $text]);
        }
        if($year) {
            $query->andWhere(['LIKE', 'title', $year]);
        }
        if($genre) {
            $query->joinWith('genres')->andwhere(['genres.id' => $genre]);
        }

        $pages = new Pagination(['totalCount' => $query->count()]);
        $pages->setPageSize(20);
        $movies = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return $this->render('search', [
            'movies' => $movies,
            'pages' => $pages
        ]);
    }
}