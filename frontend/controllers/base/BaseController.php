<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Quy
 * Date: 1/22/2016
 * Time: 11:23 PM
 */
namespace frontend\controllers\base;

use common\models\Genre;
use yii\web\Controller;

class BaseController extends Controller
{
    public $movie;
    public $genres;

    public function init()
    {
       $this->genres = Genre::find()->all();
       $this->layout = "@app/views/layouts/base";
    }
}