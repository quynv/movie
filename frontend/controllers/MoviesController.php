<?php
namespace frontend\controllers;

use frontend\models\Favourite;
use Yii;
use common\models\Movie;
use common\models\Rating;
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
                'only' => ['recommended', 'detail', 'search', 'favourite', 'rating'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['detail', 'search'],
                        'roles' => ['?','@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['recommended', 'favourite', 'rating'],
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

    function actionUpcoming()
    {
        $page = Yii::$app->getRequest()->getQueryParam('page');

        list($total_page, $total_item, $movies) = Movie::getUpcoming($page);
        $pages = new Pagination();
        $pages->setPage($page-1);
        $pages->totalCount = $total_item;
        return $this->render('coming', [
            'movies' => $movies,
            'pages' => $pages
        ]);
    }

    function actionComing_soon($tmdb_id)
    {
        $this->layout = "@app/views/layouts/blank";
        $movie = Movie::initWithData(Yii::$app->tmdb->getMovie(str_replace(array("\r\n", "\r",","), "", $tmdb_id)));
        $this->movie = $movie;
        return $this->render('upcoming', [
            'movie' => $movie,
        ]);
    }

    function actionNow_playing()
    {
        $page = Yii::$app->getRequest()->getQueryParam('page');

        list($total_page, $total_item, $movies) = Movie::getNowPlaying($page);
        $pages = new Pagination();
        $pages->setPage($page-1);
        $pages->totalCount = $total_item;
        return $this->render('now_playing', [
            'movies' => $movies,
            'pages' => $pages
        ]);
    }

    function actionMovie_playing($tmdb_id)
    {
        $this->layout = "@app/views/layouts/blank";
        $movie = Movie::initWithData(Yii::$app->tmdb->getMovie(str_replace(array("\r\n", "\r",","), "", $tmdb_id)));
        $this->movie = $movie;
        $videos = Yii::$app->tmdb->getVideos($movie->getTmdb_id());
        return $this->render('movie_playing', [
            'movie' => $movie,
            'videos' => $videos
        ]);
    }

    function actionFavourite()
    {
        if (Yii::$app->request->isAjax) {
            if (Yii::$app->request->isPost) {
                $value = Yii::$app->request->post()['value'];
                $movie = Yii::$app->request->post()['movie'];
                $favourite = Favourite::findOne(['movie_id' => $movie, 'user_id' => Yii::$app->user->id]);
                $success = false;
                if($value == 1&&$favourite == null) {
                    $favourite = new Favourite();
                    $favourite -> movie_id = $movie;
                    $favourite -> user_id = Yii::$app->user->id;
                    if($favourite -> save(false))
                    {
                        $success = true;
                    }
                }
                elseif($value == 0&&$favourite) {
                    if($favourite->delete())
                    {
                        $success = true;
                    }
                }

                $response = [
                    'success' => $success,
                    'count' => Favourite::find()->where(['movie_id' => $movie])->count()
                ];
                \Yii::$app->response->format = 'json';
                return $response;
            }
        } else {
            throw new NotFoundHttpException('Page not found');
        }
    }

    function actionRating()
    {
        if (Yii::$app->request->isAjax) {
            if (Yii::$app->request->isPost) {
                $value = Yii::$app->request->post()['value'];
                $movie = Yii::$app->request->post()['movie'];
                $rating = Rating::findOne(['movie_id' => $movie, 'user_id' => Yii::$app->user->id]);
                $success = false;
                if($rating == null) {
                    $rating = new Rating();
                    $rating -> movie_id = $movie;
                    $rating -> user_id = Yii::$app->user->id;
                    $rating -> rating = $value;
                    if($rating -> save(false))
                    {
                        $success = true;
                    }
                }
                elseif($rating) {
                    $rating -> rating = $value;
                    if($rating->update())
                    {
                        $success = true;
                    }
                }

                $response = [
                    'success' => $success,
                    'rating' => $rating -> rating
                ];
                \Yii::$app->response->format = 'json';
                return $response;
            }
        } else {
            throw new NotFoundHttpException('Page not found');
        }
    }
}