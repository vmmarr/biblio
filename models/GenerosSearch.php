<?php

namespace app\models;

use yii\base\Model;
use yii\data\Pagination;

class GenerosSearch extends Generos
{
    public function rules()
    {
        return [
            [['denom'], 'string', 'max' => 255],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params, $pagination, $sort)
    {
        $query = Generos::find();

        $this->load($params);
     
        if (!$this->validate()) {
            return [];
        }

        $query->andFilterWhere(['ilike', 'denom', $this->denom]);
        $pagination->totalCount = $query->count();
        $query->limit($pagination->limit)->offset($pagination->offset);
        $query->orderBy($sort->orders);

        return $query->all();
    }
}
