<?php

namespace common\models;

use Yii;
use \yii\db\ActiveRecord;
/**
 * This is the model class for table "genres".
 *
 * @property integer $id
 * @property string $name
 */
class Genre extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'genres';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
            [['name'], 'string', 'max' => 50]
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
        ];
    }

    public function getMovies()
    {
        return $this->hasMany(Movie::className(), ['id' => 'movie_id'])
            ->viaTable('movies_genres', ['genre_id' => 'id']);
    }
}
