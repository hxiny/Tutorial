<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TRepairWorkNotes;

/**
 * TRepairWorkNotesSearch represents the model behind the search form about `app\models\TRepairWorkNotes`.
 */
class TRepairWorkNotesSearch extends TRepairWorkNotes
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'NOTES_ID', 'PRE_REPAIR_TIME', 'REAL_REPAIR_TIME', 'REPAIR_SCHEMA_DIRECT', 'SEND_USER', 'REPAIR_USER', 'REPAIR_USER_PHONE', 'CREATE_TIME', 'OPER_TIME', 'OPER_USER', 'REMARK'], 'safe'],
            [['REPAIR_FEE'], 'number'],
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
        $query = TRepairWorkNotes::find();

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
        $query->joinWith('notes')->addSelect(TRepairNotes::tableName() . '.CELL_ID')->where(['t_repair_notes.CELL_ID'
        =>
            Utils::authCells()]);
        // grid filtering conditions
        $query->andFilterWhere([
            'REPAIR_FEE' => $this->REPAIR_FEE,
        ]);

        $query->andFilterWhere(['like', 'ID', $this->ID])
            ->andFilterWhere(['like', 'NOTES_ID', $this->NOTES_ID])
            ->andFilterWhere(['like', 'PRE_REPAIR_TIME', $this->PRE_REPAIR_TIME])
            ->andFilterWhere(['like', 'REAL_REPAIR_TIME', $this->REAL_REPAIR_TIME])
            ->andFilterWhere(['like', 'REPAIR_SCHEMA_DIRECT', $this->REPAIR_SCHEMA_DIRECT])
            ->andFilterWhere(['like', 'SEND_USER', $this->SEND_USER])
            ->andFilterWhere(['like', 'REPAIR_USER', $this->REPAIR_USER])
            ->andFilterWhere(['like', 'REPAIR_USER_PHONE', $this->REPAIR_USER_PHONE])
            ->andFilterWhere(['like', 'CREATE_TIME', $this->CREATE_TIME])
            ->andFilterWhere(['like', 'OPER_TIME', $this->OPER_TIME])
            ->andFilterWhere(['like', 'OPER_USER', $this->OPER_USER])
            ->andFilterWhere(['like', 'REMARK', $this->REMARK]);

        return $dataProvider;
    }
}
