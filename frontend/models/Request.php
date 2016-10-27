<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "requests".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $requested
 * @property integer $movie_id
 * @property integer $created_at
 */
class Request extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'requests';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'requested', 'movie_id', 'created_at'], 'required'],
            [['user_id', 'requested', 'movie_id', 'created_at'], 'integer']
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
            'requested' => Yii::t('app', 'Requested'),
            'movie_id' => Yii::t('app', 'Movie ID'),
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

    public static function check($user_id, $requested, $movie_id)
    {
        $request = self::findOne(['user_id' => $user_id, 'requested' => $requested, 'movie_id' => $movie_id]);
        if($request) return true;
        return false;
    }
}
