<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "contributions".
 *
 * @property integer $id
 * @property string $email
 * @property integer $tmdb_id
 * @property integer $created_at
 */
class Contribution extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contributions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tmdb_id', 'created_at'], 'integer'],
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
            'tmdb_id' => Yii::t('app', 'Tmdb ID'),
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

    public function getAvailable()
    {
        $movie = Movie::findOne(['tmdb_id' => $this->tmdb_id]);
        if($movie) return true;
        return false;
    }
}
