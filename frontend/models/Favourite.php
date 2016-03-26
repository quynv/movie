<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "favourites".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $movie_id
 * @property integer $updated_at
 */
class Favourite extends \yii\db\ActiveRecord
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
}
