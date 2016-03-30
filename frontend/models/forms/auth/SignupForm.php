<?php
namespace frontend\models\forms\auth;

use common\models\User;
use yii\base\Model;
use Yii;

use himiklab\yii2\recaptcha\ReCaptchaValidator;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $confirmation;
    public $accept;
    public $reCaptcha;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'length' => [6,25]],

            ['confirmation', 'required'],
            ['confirmation', 'compare', 'compareAttribute' => 'password', 'message'=>Yii::t('frontend/form.signup',"Confirmation don't match.")],

            ['accept', 'required', 'requiredValue' => 1, 'message' => Yii::t('frontend/form.signup','You must agree to the terms and conditions.')],

            ['reCaptcha', 'required'],
            [['reCaptcha'],ReCaptchaValidator::className()],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->status = User::STATUS_NOT_ACTIVE;
            $user->generateAccessToken();
            $user->generateAuthKey();
            return $user;
        }

        return null;
    }
}
