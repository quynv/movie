<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Quy
 * Date: 2/1/2016
 * Time: 2:58 PM
 */

namespace frontend\controllers\utilities;

use Yii;
use yii\base\Controller;

class Email extends Controller
{
    public static function signup($model){
        return Yii::$app->mailer->compose(
            ['html' => 'signup-html', 'text' => 'signup-text'],
            ['user' => $model]
        )
        ->setFrom(Yii::$app->params['adminEmail'])
        ->setTo($model->email)
        ->setSubject('Account Registration Confirmation')
        ->send();
    }

    public static function forgotPassword($model){
        return Yii::$app->mailer->compose(
            ['html' => 'forgot-password-html', 'text' => 'forgot-password-text'],
            ['user' => $model]
        )
            ->setFrom(Yii::$app->params['adminEmail'])
            ->setTo($model->email)
            ->setSubject('Reset Password Request')
            ->send();
    }
}