<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TRepairEvidence;

/**
 * TRepairEvidenceSearch represents the model behind the search form about `app\models\TRepairEvidence`.
 */
class TRepairEvidenceSearch extends TRepairEvidence
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'REPAIR_NOTES_ID', 'WORK_NOTES_ID', 'DEAL_BEFORE_PHOTO', 'DEAL_AFTER_PHOTO', 'REMARK'], 'safe'],
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
        $query = TRepairEvidence::find();

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
        $query->andFilterWhere(['like', 'ID', $this->ID])
            ->andFilterWhere(['like', 'REPAIR_NOTES_ID', $this->REPAIR_NOTES_ID])
            ->andFilterWhere(['like', 'WORK_NOTES_ID', $this->WORK_NOTES_ID])
            ->andFilterWhere(['like', 'DEAL_BEFORE_PHOTO', $this->DEAL_BEFORE_PHOTO])
            ->andFilterWhere(['like', 'DEAL_AFTER_PHOTO', $this->DEAL_AFTER_PHOTO])
            ->andFilterWhere(['like', 'REMARK', $this->REMARK]);

        return $dataProvider;
    }
}
