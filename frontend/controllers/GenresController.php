<?php
namespace frontend\controllers;

use common\models\Genre;
use Yii;
use frontend\controllers\base\BaseController;
use \yii\web\NotFoundHttpException;
use yii\data\Pagination;

class GenresController extends BaseController
{

    function actionView($id)
    {
        $this->layout = "@app/views/layouts/base";

        $genre = Genre::findOne(['id' => $id]);
        $query = Genre::findOne(['id' => $id])->getMovies();
        $count = $query->count();

        $pagination = new Pagination(['totalCount' => $count]);

        $movies = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        if(isset($movies)) {
            return $this->render('genres', [
                'genre' => $genre,
                'movies' => $movies,
                'pages' => $pagination
            ]);
        } else {
            throw new NotFoundHttpException('Movie not found');
        }
    }

}