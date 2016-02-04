<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Quy
 * Date: 2/1/2016
 * Time: 1:53 PM
 */
namespace frontend\models\forms\auth;

use Yii;
use yii\base\Model;
use frontend\models\User;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $email;
    public $password;
    public $rememberMe = true;

    private $_user;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // email and password are both required
            ['email', 'required', 'message' => Yii::t('frontend/form.login','Email cannot be blank.')],
            ['password', 'required', 'message' => Yii::t('frontend/form.login','Password cannot be blank.')],
            // email must validated
            ['email','email', 'message' => 'Email is invalid.'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean', 'message' => Yii::t('frontend/form.login', 'RememberMe must be a boolean value.')],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, Yii::t('frontend/form.login','Incorrect username or password.'));
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[email]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByEmail($this->email);
        }

        return $this->_user;
    }
}