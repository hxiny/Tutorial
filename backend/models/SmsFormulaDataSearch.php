<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SmsFormulaData;

/**
 * SmsFormulaDataSearch represents the model behind the search form about `app\models\SmsFormulaData`.
 */
class SmsFormulaDataSearch extends SmsFormulaData
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['variable_name', 'variable', 'query_table', 'query_column'], 'safe'],
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
        $query = SmsFormulaData::find();

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
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'variable_name', $this->variable_name])
            ->andFilterWhere(['like', 'variable', $this->variable])
            ->andFilterWhere(['like', 'query_table', $this->query_table])
            ->andFilterWhere(['like', 'query_column', $this->query_column]);

        return $dataProvider;
    }
}
