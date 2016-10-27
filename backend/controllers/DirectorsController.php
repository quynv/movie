<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Quy
 * Date: 4/23/2016
 * Time: 1:43 AM
 */

namespace backend\controllers;


use backend\models\DirectorSearch;
use yii\web\Controller;
use Yii;

class DirectorsController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new DirectorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }
}