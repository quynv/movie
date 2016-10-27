<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Quy
 * Date: 4/23/2016
 * Time: 10:39 PM
 */

namespace backend\models\forms;


use yii\base\Model;
use Yii;

class EmailForm extends Model
{
    public $email;
    public $title;
    public $content;

    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],

            ['title', 'required'],
            ['title', 'string', 'max' => 255],

            ['content', 'required'],

        ];
    }

    public function send()
    {
        if($this->validate())
        {
            return Yii::$app->mailer->compose(
                ['html' => 'blank-html', 'text' => 'blank-text'],
                ['content' => $this->content]
            )
                ->setFrom(Yii::$app->params['adminEmail'])
                ->setTo($this->email)
                ->setSubject($this->title)
                ->send();
        }
        return false;
    }
}