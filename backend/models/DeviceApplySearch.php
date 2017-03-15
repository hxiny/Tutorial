<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DeviceApply;

/**
 * DeviceApplySearch represents the model behind the search form about `app\models\DeviceApply`.
 */
class DeviceApplySearch extends DeviceApply
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID'], 'integer'],
            [['USER_ID', 'CELL_ID', 'DEVICE_ID', 'APPLY_TIME', 'AUDIT_STATUS'], 'safe'],
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
        $query = DeviceApply::find();

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
        $query->where(['CELL_ID' => Utils::authCells()]);

        // grid filtering conditions
        $query->andFilterWhere([
            'ID' => $this->ID,
        ]);

        $query->andFilterWhere(['like', 'USER_ID', $this->USER_ID])
            ->andFilterWhere(['like', 'CELL_ID', $this->CELL_ID])
            ->andFilterWhere(['like', 'DEVICE_ID', $this->DEVICE_ID])
            ->andFilterWhere(['like', 'APPLY_TIME', $this->APPLY_TIME])
            ->andFilterWhere(['like', 'AUDIT_STATUS', $this->AUDIT_STATUS]);

        return $dataProvider;
    }
}
