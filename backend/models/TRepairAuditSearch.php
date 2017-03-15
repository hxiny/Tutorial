<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TRepairAudit;

/**
 * TRepairAuditSearch represents the model behind the search form about `app\models\TRepairAudit`.
 */
class TRepairAuditSearch extends TRepairAudit
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'NOTES_ID', 'AUDIT_TIME', 'AUDIT_USER', 'AUDIT_RESULT', 'AUDIT_OPTION', 'REMARK'], 'safe'],
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
        $query = TRepairAudit::find()->select(TRepairAudit::tableName().'.*');

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
            ->andFilterWhere(['like', 'NOTES_ID', $this->NOTES_ID])
            ->andFilterWhere(['like', 'AUDIT_TIME', $this->AUDIT_TIME])
            ->andFilterWhere(['like', 'AUDIT_USER', $this->AUDIT_USER])
            ->andFilterWhere(['like', 'AUDIT_RESULT', $this->AUDIT_RESULT])
            ->andFilterWhere(['like', 'AUDIT_OPTION', $this->AUDIT_OPTION])
            ->andFilterWhere(['like', 'REMARK', $this->REMARK]);

        return $dataProvider;
    }
}
