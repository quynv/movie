<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Quy
 * Date: 4/23/2016
 * Time: 1:33 AM
 */

namespace backend\models;


use common\models\Genre;
use yii\data\ActiveDataProvider;

class GenreSearch extends Genre
{
    public function search($params) {
        $query = Genre::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ])
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}