<?php

/**
 * Created by PhpStorm.
 * User: Nguyen Quy
 * Date: 4/23/2016
 * Time: 1:30 AM
 */

namespace backend\controllers;

use yii\web\Controller;
use backend\models\GenreSearch;
use Yii;

class GenresController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new GenreSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }
}