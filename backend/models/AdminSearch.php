<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Quy
 * Date: 4/22/2016
 * Time: 4:39 PM
 */

namespace backend\models;

use yii\data\ActiveDataProvider;

class AdminSearch extends Admin
{
    public function search($params) {
        $query = Admin::find()->andWhere(['<>', 'role', self::OWNER]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'role' => $this->role
        ])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}