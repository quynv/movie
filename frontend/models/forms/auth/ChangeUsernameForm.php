<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Quy
 * Date: 4/19/2016
 * Time: 3:42 PM
 */

namespace frontend\models\forms\auth;


use yii\base\Model;
use common\models\User;
use Yii;

class ChangeUsernameForm extends Model
{
    public $username;
    public $password;

    private $_user;

    public function __construct($config = [])
    {
        $this->_user = User::findOne([
            'id'=>Yii::$app->user->id
        ]);
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'match', 'pattern' => '/^[a-zA-Z0-9_]+$/', 'message' => 'Your username can only contain alphanumeric characters, underscores.'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['password', 'required'],
            ['password', 'checkCurrentPassword'],
        ];
    }

    public function checkCurrentPassword($attribute, $params)
    {
        $user = $this->_user;
        if($user->password == null) return true;
        if(!$user->validatePassword($this->password))
            $this->addError($attribute,'Password is incorrect');
    }

    public function save()
    {
        if ($this->validate())
        {
            $user = $this->_user;
            $user->username = $this->username;
            return $user->save(false);
        }
    }
}