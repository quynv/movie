<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Quy
 * Date: 4/22/2016
 * Time: 11:03 PM
 */

namespace backend\models\forms;


use yii\base\Model;

class TmdbForm extends Model
{
    public $tmdb;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['tmdb', 'required'],
            ['tmdb', 'integer'],
            ['tmdb', 'unique', 'targetAttribute' => 'tmdb_id', 'targetClass' => '\common\models\Movie', 'message' => 'This movie has already on system.'],
        ];
    }

    public function find()
    {
        if($this->validate())
        {
            return true;
        }

        return false;
    }
}