<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Quy
 * Date: 3/30/2016
 * Time: 3:49 PM
 */

namespace frontend\controllers;


use common\models\Actor;
use common\models\Cast;
use frontend\controllers\base\BaseController;
use yii\data\Pagination;
use \yii\web\NotFoundHttpException;

class ActorsController extends BaseController
{
    function actionView($id)
    {
        $this->layout = "@app/views/layouts/base";

        $cast = Cast::findOne(['id' => $id]);
        $query = Cast::findOne(['id' => $id])->getMoviesByActor();
        $count = $query->count();

        $pagination = new Pagination(['totalCount' => $count]);

        $movies = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        if(isset($movies)) {
            return $this->render('actor', [
                'cast' => $cast,
                'movies' => $movies,
                'pages' => $pagination
            ]);
        } else {
            throw new NotFoundHttpException('Actor not found');
        }
    }

    function actionAll()
    {
        $this->layout = "@app/views/layouts/base";
        $query = Actor::find()->select(['cast_id'])->distinct();
        $text = \Yii::$app->getRequest()->getQueryParam('keyword');
        if($text) {
            $query->joinWith(['cast']);
            $query->andFilterWhere(['like', 'casts.name', $text]);
        }
        $pagination = new Pagination(['totalCount' => $query->count()]);

        $actors = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        if(isset($actors)) {
            return $this->render('actors', [
                'actors' => $actors,
                'pages' => $pagination
            ]);
        } else {
            throw new NotFoundHttpException('Actor not found');
        }
    }
}