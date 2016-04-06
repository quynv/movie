<?php

namespace frontend\models;

use Yii;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "follows".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $followed
 * @property integer $created_at
 */
class Follow extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'follows';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'followed', 'created_at'], 'required'],
            [['user_id', 'followed', 'created_at'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'followed' => Yii::t('app', 'Followed'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['created_at'],
                ],
            ],
        ];
    }
}
