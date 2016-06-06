<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "feedbacks".
 *
 * @property integer $id
 * @property string $email
 * @property string $content
 * @property integer $status
 * @property integer $created_at
 */
class Feedback extends ActiveRecord
{
    const NOT_YET_ACCEPTED = 0;
    const REJECT = 1;
    const ACCEPT = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'feedbacks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['created_at', 'status'], 'integer'],
            [['email'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'email' => Yii::t('app', 'Email'),
            'content' => Yii::t('app', 'Content'),
            'status' => Yii::t('app', 'Status'),
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
                ],
            ],
        ];
    }

    public static function getStatus()
    {
        return [
            self::NOT_YET_ACCEPTED => 'Haven\'t yet accepted',
            self::REJECT => 'Rejected',
            self::ACCEPT => 'Accepted'
        ];
    }
}
