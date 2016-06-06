<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Quy
 * Date: 1/22/2016
 * Time: 11:23 PM
 */
namespace frontend\controllers\base;

use common\models\Genre;
use common\models\Rating;
use yii\web\Controller;

class BaseController extends Controller
{
    public $movie;
    public $genres;
    public $required;

    public function init()
    {
       $this->genres = Genre::find()->all();
       $this->layout = "@app/views/layouts/base";
    }

    public function required()
    {
        $this->required = array(
            'is_required' => false,
            'remain' => 0
        );
        if(!\Yii::$app->user->isGuest) {
            $count = Rating::find()->where(['user_id' => \Yii::$app->user->id])->count();
            if(\Yii::$app->params['rating_min'] - $count > 0) {
                $this->required = [
                    'is_required' => true,
                    'remain' => \Yii::$app->params['rating_min'] - $count
                ];
            }
        }
    }
}