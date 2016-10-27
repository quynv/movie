<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Quy
 * Date: 4/22/2016
 * Time: 2:23 PM
 */

namespace backend\models;


use common\models\User;
use yii\data\ActiveDataProvider;

class UserSearch extends User
{
    public function search($params) {
        $query = User::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status
        ])
        ->andFilterWhere(['like', 'username', $this->username])
        ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}