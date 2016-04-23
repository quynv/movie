<?php

namespace common\models;

use Yii;
use \yii\db\ActiveRecord;
use yii\helpers\Url;

/**
 * This is the model class for table "movies_directors".
 *
 * @property integer $id
 * @property integer $movie_id
 * @property integer $cast_id
 */
class Director extends ActiveRecord
{
    private $data;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'movies_directors';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['movie_id', 'cast_id'], 'required'],
            [['movie_id', 'cast_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'movie_id' => Yii::t('app', 'Movie ID'),
            'cast_id' => Yii::t('app', 'Cast ID'),
        ];
    }

    public function afterFind()
    {
        parent::afterFind();
        $this->data = Cast::findOne(['id' => $this->cast_id]);
    }

    public function getId()
    {
        return $this->cast_id;
    }

    public function getName()
    {
        return $this->data->name;
    }

    public function getAvatar($size)
    {
        if($this->data->avatar)
        {
            return Yii::$app->tmdb->config['images']['base_url'].$size.$this->data->avatar;
        }
        else
        {
            return Url::to('@web/img/no_avatar.png');
        }
    }

    public function getMovies()
    {
        return self::find()->where(['cast_id' => $this->cast_id])->count();
    }

    public function getCast()
    {
        return $this->hasOne(Cast::className(), ['id' => 'cast_id']);
    }
}
