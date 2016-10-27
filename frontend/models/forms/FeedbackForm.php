<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Quy
 * Date: 4/23/2016
 * Time: 9:35 PM
 */

namespace frontend\models\forms;


use common\models\Feedback;
use himiklab\yii2\recaptcha\ReCaptchaValidator;
use yii\base\Model;


class FeedbackForm extends Model
{
    public $email;
    public $content;
    public $reCaptcha;

    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],

            ['content', 'required'],

            ['reCaptcha', 'required'],
            [['reCaptcha'],ReCaptchaValidator::className()],
        ];
    }

    public function save()
    {
        if($this->validate())
        {
            $feedback = new Feedback();
            $feedback->email = $this->email;
            $feedback->content = $this->content;
            if($feedback->save(false))
            {
                return true;
            }
        }
        return false;
    }
}