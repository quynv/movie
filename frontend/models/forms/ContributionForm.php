<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Quy
 * Date: 4/23/2016
 * Time: 4:16 PM
 */

namespace frontend\models\forms;


use common\models\Contribution;
use yii\base\Model;

class ContributionForm extends Model
{
    public $email;
    public $tmdb;

    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],

            ['tmdb', 'required'],
            ['tmdb', 'integer'],
            ['tmdb', 'unique', 'targetAttribute' => 'tmdb_id', 'targetClass' => '\common\models\Movie', 'message' => 'This movie has already on system.'],
        ];
    }

    public function save()
    {
        if($this->validate())
        {
            $contribution = new Contribution();
            $contribution->email = $this->email;
            $contribution->tmdb_id = $this->tmdb;
            if($contribution->save(false))
            {
                return true;
            }
        }
        return false;
    }
}