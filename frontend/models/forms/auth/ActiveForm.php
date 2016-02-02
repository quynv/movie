<?php
namespace frontend\models\forms\auth;

use yii\base\Model;
use Yii;

use himiklab\yii2\recaptcha\ReCaptchaValidator;
use frontend\models\User;
use frontend\controllers\utilities\Email;

/**
 * Active form
 */
class ActiveForm extends Model
{
    public $email;
    public $reCaptcha;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'exist', 'targetClass' => '\frontend\models\User', 'message' => 'This email does not exist in our system.'],

            ['reCaptcha', 'required'],
            [['reCaptcha'],ReCaptchaValidator::className()],
        ];
    }

    public function resend()
    {
        if($this->validate())
        {
            $user = User::findOne(['email' => $this->email]);
            if(Email::signup($user))
            {
                Yii::$app->session->setFlash('success', 'Please check your email to confirm account.');
            } else {
                Yii::$app->session->setFlash('danger', 'Something wrong during send email. <br>Please try again later.');
            }
        }
    }
}
