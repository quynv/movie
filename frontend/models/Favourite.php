<?php

namespace frontend\models;

use Yii;
use \yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use \yii\db\ActiveRecord;
/**
 * This is the model class for table "favourites".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $movie_id
 * @property integer $updated_at
 */
class Favourite extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'favourites';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'movie_id', 'updated_at'], 'required'],
            [['user_id', 'movie_id', 'updated_at'], 'integer']
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
            'movie_id' => Yii::t('app', 'Movie ID'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    public function beforeSave($insert) {
        $this->updated_at = new Expression('NOW()');
        return parent::beforeSave($insert);
    }
}
