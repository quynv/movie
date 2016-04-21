<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Quy
 * Date: 4/21/2016
 * Time: 2:09 PM
 */

namespace frontend\models\forms\auth;


use yii\base\Model;
use common\models\User;
use frontend\controllers\utilities\Email;
use himiklab\yii2\recaptcha\ReCaptchaValidator;

class ForgotPasswordForm extends Model
{
    public $email;
    public $reCaptcha;

    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'exist',
                'targetClass' => '\common\models\User',
                'filter' => ['status' => User::STATUS_ACTIVE],
                'message' => 'This email does not exist in our system.'
            ],
            ['reCaptcha', 'required'],
            [['reCaptcha'],ReCaptchaValidator::className()],
        ];
    }

    public function sendMail()
    {
        if($this->validate())
        {
            $user = User::findOne([
                'status' => User::STATUS_ACTIVE,
                'email' => $this->email,
            ]);

            if($user)
            {
                $user->generateAccessToken();
                if($user->save(false))
                {
                    try{
                        if(Email::forgotPassword($user)){
                            return true;
                        }

                    }catch (\Exception $e) {
                        \Yii::$app->session->setFlash('danger','We couldn\'t send mail to your email address.');
                    }
                }
            }
        }
        return false;
    }
}