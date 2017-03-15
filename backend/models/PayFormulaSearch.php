<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PayFormula;

/**
 * PayFormulaSearch represents the model behind the search form about `app\models\PayFormula`.
 */
class PayFormulaSearch extends PayFormula
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['formula_id'], 'integer'],
            [['formula_name', 'formula_type', 'formula_text'], 'safe'],
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
        $query = PayFormula::find();

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
            'formula_id' => $this->formula_id,
        ]);

        $query->andFilterWhere(['like', 'formula_name', $this->formula_name])
            ->andFilterWhere(['like', 'formula_type', $this->formula_type])
            ->andFilterWhere(['like', 'formula_text', $this->formula_text]);

        return $dataProvider;
    }
}
