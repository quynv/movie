<?php

namespace frontend\models;

use Yii;
use \yii\db\ActiveRecord;
use common\models\User;

/**
 * This is the model class for table "providers".
 *
 * @property integer $id
 * @property string $provider
 * @property string $provider_id
 * @property integer $user_id
 */
class Provider extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'providers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['provider', 'provider_id', 'user_id'], 'required'],
            [['user_id'], 'integer'],
            [['provider'], 'string', 'max' => 255],
            [['provider_id'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'provider' => 'Provider',
            'provider_id' => 'Provider ID',
            'user_id' => 'User ID',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
