<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Quy
 * Date: 4/19/2016
 * Time: 3:16 PM
 */

namespace frontend\models\forms\auth;

use Yii;
use yii\base\Model;
use common\models\User;

class ChangePasswordForm extends Model
{
    public $password;
    public $confirmation;
    public $old_password;

    private $_user;

    public function __construct($config = [])
    {
        $this->_user = User::findOne([
            'id'=>Yii::$app->user->id
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

            ['old_password', 'required'],
            ['old_password', 'checkCurrentPassword'],
        ];
    }

    public function checkCurrentPassword($attribute, $params)
    {
        $user = $this->_user;
        if($user->password == null) return true;
        if(!$user->validatePassword($this->old_password)){
            $this->addError($attribute,'Old password is incorrect');
            return false;
        }
        return true;
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