<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Quy
 * Date: 4/21/2016
 * Time: 2:55 PM
 */

namespace frontend\models\forms\auth;


use yii\base\Model;
use Yii;
use common\models\User;
use himiklab\yii2\recaptcha\ReCaptchaValidator;

class ResetPasswordForm extends Model
{
    public $password;
    public $confirmation;
    public $reCaptcha;

    private $_user;

    public function __construct($token, $config = [])
    {
        $this->_user = User::findOne([
            'access_token'=>$token
        ]);
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            ['password', 'required'],
            ['password', 'string', 'length' => [6,25]],

            ['confirmation', 'required'],
            ['confirmation', 'compare', 'compareAttribute' => 'password', 'message'=>Yii::t('frontend/form.signup',"Confirmation don't match.")],

            ['reCaptcha', 'required'],
            [['reCaptcha'],ReCaptchaValidator::className()],
        ];
    }

    public function save()
    {
        if ($this->validate())
        {
            $user = $this->_user;
            $user->setPassword($this->password);
            return $user->save(false);
        }

        return false;
    }
}