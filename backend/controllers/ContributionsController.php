<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Quy
 * Date: 4/23/2016
 * Time: 3:46 PM
 */

namespace backend\controllers;


use backend\models\ContributionSearch;
use common\models\Contribution;
use yii\web\Controller;
use Yii;

class ContributionsController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new ContributionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }

    public function actionDelete($id)
    {
        $con = Contribution::findOne(['id' => $id]);
        if($con->delete())
        {
            Yii::$app->session->setFlash('success', 'This contribution has been deleted successfully.');
        }
        else
        {
            Yii::$app->session->setFlash('danger', 'An error occurred while trying delete this contribution.');
        }
        $this->redirect(['contributions/']);
    }
}