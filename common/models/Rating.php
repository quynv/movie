<?php

namespace common\models;

use Yii;
use \yii\db\ActiveRecord;
use \yii\db\Expression;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "ratings".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $movie_id
 * @property double $rating
 * @property integer $created_at
 */
class Rating extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ratings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'movie_id', 'rating', 'created_at'], 'required'],
            [['user_id', 'movie_id', 'created_at'], 'integer'],
            [['rating'], 'number']
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
            'rating' => Yii::t('app', 'Rating'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    public function beforeSave($insert) {
        $this->created_at = new Expression('NOW()');
        return parent::beforeSave($insert);
    }

    public static function similarity($user_rated ,$other_rated)
    {
        $sim = 0;

        $ur = 0;
        $or = 0;
        foreach($user_rated as $key => $value)
        {
            if(isset($other_rated[$key])) {
                $sim = $other_rated[$key]*$value;
                $ur += $value**2;
                $or += $other_rated[$key]**2;
            }
        }
        if($ur == 0 || $or == 0) {$sim = 0;}
        else $sim /= $ur*$or;

        return $sim;
    }
}
