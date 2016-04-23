<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Quy
 * Date: 4/23/2016
 * Time: 11:22 AM
 */

namespace backend\models;


use common\models\Actor;
use yii\data\ActiveDataProvider;

class ActorSearch extends Actor
{
    public $id;
    public $name;

    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    public function search($params) {
        $query = Actor::find()->select('cast_id')->distinct();
        $query->joinWith(['cast']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'casts.id' => $this->id,
        ])
            ->andFilterWhere(['like', 'casts.name', $this->name]);

        return $dataProvider;
    }
}