<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PayTamplate;

/**
 * PayTamplateSearch represents the model behind the search form about `app\models\PayTamplate`.
 */
class PayTamplateSearch extends PayTamplate
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tamplate_id', 'cell_id', 'build_id', 'accuracy', 'period'], 'integer'],
            [['tamplate_name', 'formula_types'], 'safe'],
            [['unit_cost'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = PayTamplate::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'tamplate_id' => $this->tamplate_id,
            'cell_id' => $this->cell_id,
            'build_id' => $this->build_id,
            'accuracy' => $this->accuracy,
            'unit_cost' => $this->unit_cost,
            'period' => $this->period,
        ]);

        $query->andFilterWhere(['like', 'tamplate_name', $this->tamplate_name])
            ->andFilterWhere(['like', 'formula_types', $this->formula_types]);

        return $dataProvider;
    }
}
