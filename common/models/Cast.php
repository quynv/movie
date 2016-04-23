<?php

namespace common\models;

use Yii;
use \yii\db\ActiveRecord;
use yii\helpers\Url;

/**
 * This is the model class for table "casts".
 *
 * @property integer $id
 * @property string $name
 * @property string $avatar
 */
class Cast extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'casts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name'], 'required'],
            [['id'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['avatar'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'avatar' => Yii::t('app', 'Avatar'),
        ];
    }

    public function getAvatar($size)
    {
        if(isset($this->poster))
            return Yii::$app->tmdb->config['images']['base_url'].$size.$this->avatar;
        else
            return Url::to('@web/img/movie_default.jpg');
    }

    public function getMoviesByActor()
    {
        return $this->hasMany(Movie::className(), ['id' => 'movie_id'])
            ->viaTable('movies_actors', ['cast_id' => 'id']);
    }

    public function getMoviesByDirector()
    {
        return $this->hasMany(Movie::className(), ['id' => 'movie_id'])
            ->viaTable('movies_directors', ['cast_id' => 'id']);
    }
}
