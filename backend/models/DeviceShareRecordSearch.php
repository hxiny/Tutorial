<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DeviceShareRecord;

/**
 * DeviceShareRecordSearch represents the model behind the search form about `app\models\DeviceShareRecord`.
 */
class DeviceShareRecordSearch extends DeviceShareRecord
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID'], 'integer'],
            [['USER_ID', 'CELL_ID', 'SHARE_TIME', 'OPEN_TIME', 'SHARE_NAME', 'SHARE_PHONE'], 'safe'],
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
        $query = DeviceShareRecord::find();

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
            'ID' => $this->ID,
        ]);

        $query->andFilterWhere(['like', 'USER_ID', $this->USER_ID])
            ->andFilterWhere(['like', 'CELL_ID', $this->CELL_ID])
            ->andFilterWhere(['like', 'SHARE_TIME', $this->SHARE_TIME])
            ->andFilterWhere(['like', 'OPEN_TIME', $this->OPEN_TIME])
            ->andFilterWhere(['like', 'SHARE_NAME', $this->SHARE_NAME])
            ->andFilterWhere(['like', 'SHARE_PHONE', $this->SHARE_PHONE]);

        return $dataProvider;
    }
}
