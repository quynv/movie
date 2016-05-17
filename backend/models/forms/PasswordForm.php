<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Quy
 * Date: 5/17/2016
 * Time: 9:47 AM
 */

namespace backend\models\forms;


use backend\models\Admin;
use yii\base\Model;

class PasswordForm extends Model
{
    public $email;

    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'exist',
                'targetClass' => '\backend\models\Admin',
                'message' => 'This email does not exist in our system.'
            ],
        ];
    }

    public function generate()
    {
        if($this->validate())
        {
            $user = Admin::findByEmail($this->email);
            $new_pass = \Yii::$app->security->generateRandomString(6);
            $user->setPassword($new_pass);
            if($user->save(false))
            {
                return $new_pass;
            }
        }
        return null;
    }
}