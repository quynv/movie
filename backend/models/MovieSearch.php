<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Quy
 * Date: 4/22/2016
 * Time: 9:55 PM
 */

namespace backend\models;


use common\models\Movie;
use yii\data\ActiveDataProvider;

class MovieSearch extends Movie
{
    public function search($params) {
        $query = Movie::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'tmdb_id' => $this->tmdb_id,
            'imdb_id' => $this->imdb_id
        ])
            ->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}