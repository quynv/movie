<?php
namespace frontend\controllers;

use Yii;
use common\models\Movie;
use frontend\controllers\base\BaseController;
use \yii\web\NotFoundHttpException;

class MoviesController extends BaseController
{
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
}