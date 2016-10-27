<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Quy
 * Date: 4/22/2016
 * Time: 12:29 AM
 */
namespace backend\models\forms;

use backend\models\Admin;
use Yii;
use yii\base\Model;

/**
 * Login form
 */
class RegisterForm extends Model
{
    public $email;
    public $password;
    public $confirmation;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // email and password are both required
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\backend\models\Admin', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'length' => [6,25]],

            ['confirmation', 'required'],
            ['confirmation', 'compare', 'compareAttribute' => 'password', 'message'=>"Confirmation don't match."],
        ];
    }

    public function save()
    {
        if($this->validate())
        {
            $admin = new Admin();
            $admin->email = $this->email;
            $admin->username = explode("@", $this->email)[0];
            $admin->password = Yii::$app->security->generatePasswordHash($this->password);
            $admin->role = Admin::ADMIN;
            if($admin->save(false))
            {
                return true;
            }
        }
        return false;
    }
}
