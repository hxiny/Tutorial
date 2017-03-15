<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SmsFormula;

/**
 * SmsFormulaSearch represents the model behind the search form about `app\models\SmsFormula`.
 */
class SmsFormulaSearch extends SmsFormula
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cell_id', 'sms_configuration_id'], 'integer'],
            [['formula_name', 'variable_set'], 'safe'],
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
        $query = SmsFormula::find();

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
            'cell_id' => $this->cell_id,
            'sms_configutation_id' => $this->sms_configuration_id,
        ]);

        $query->andFilterWhere(['like', 'formula_name', $this->formula_name])
            ->andFilterWhere(['like', 'variable_set', $this->variable_set]);

        return $dataProvider;
    }
}
