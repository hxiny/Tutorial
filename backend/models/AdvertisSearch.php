<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Advertis;

/**
 * AdvertisSearch represents the model behind the search form about `app\models\Advertis`.
 */
class AdvertisSearch extends Advertis
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'PIC_IMG', 'ADVERTIS_URL', 'ADVERTIS_TYPE', 'ADVERTIS_INTRODUCT', 'ADVERTIS_TITLE', 'ADVERTIS_START_DATE', 'ADVERTIS_END_DATE', 'STATUS', 'REMARK'], 'safe'],
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
        $query = Advertis::find();

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

        $query->andFilterWhere(['like', 'ID', $this->ID])
            ->andFilterWhere(['like', 'PIC_IMG', $this->PIC_IMG])
            ->andFilterWhere(['like', 'ADVERTIS_URL', $this->ADVERTIS_URL])
            ->andFilterWhere(['like', 'ADVERTIS_TYPE', $this->ADVERTIS_TYPE])
            ->andFilterWhere(['like', 'ADVERTIS_INTRODUCT', $this->ADVERTIS_INTRODUCT])
            ->andFilterWhere(['like', 'ADVERTIS_TITLE', $this->ADVERTIS_TITLE])
            ->andFilterWhere(['like', 'ADVERTIS_START_DATE', $this->ADVERTIS_START_DATE])
            ->andFilterWhere(['like', 'ADVERTIS_END_DATE', $this->ADVERTIS_END_DATE])
            ->andFilterWhere(['like', 'STATUS', $this->STATUS])
            ->andFilterWhere(['like', 'REMARK', $this->REMARK]);

        return $dataProvider;
    }
}
