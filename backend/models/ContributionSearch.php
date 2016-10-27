<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Quy
 * Date: 4/23/2016
 * Time: 3:48 PM
 */

namespace backend\models;


use common\models\Contribution;
use yii\data\ActiveDataProvider;

class ContributionSearch extends Contribution
{
    public function search($params) {
        $query = Contribution::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'tmdb_id' => $this->tmdb_id,
        ])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}