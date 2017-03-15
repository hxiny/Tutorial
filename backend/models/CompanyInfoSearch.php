<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CompanyInfo;

/**
 * CompanyInfoSearch represents the model behind the search form about `app\models\CompanyInfo`.
 */
class CompanyInfoSearch extends CompanyInfo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'NAME', 'ADDRESS', 'SET_DATE', 'CHARGE_MAN', 'CORPORATE', 'CREDIT_CODE', 'ENTERPRISE_TYPE', 'ORGANIZATION_CODE', 'CREATE_TIME', 'UPDATE_TIME', 'CREATE_USER', 'UPDATE_USER', 'REMARK'], 'safe'],
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
        $query = CompanyInfo::find();

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
            ->andFilterWhere(['like', 'NAME', $this->NAME])
            ->andFilterWhere(['like', 'ADDRESS', $this->ADDRESS])
            ->andFilterWhere(['like', 'SET_DATE', $this->SET_DATE])
            ->andFilterWhere(['like', 'CHARGE_MAN', $this->CHARGE_MAN])
            ->andFilterWhere(['like', 'CORPORATE', $this->CORPORATE])
            ->andFilterWhere(['like', 'CREDIT_CODE', $this->CREDIT_CODE])
            ->andFilterWhere(['like', 'ENTERPRISE_TYPE', $this->ENTERPRISE_TYPE])
            ->andFilterWhere(['like', 'ORGANIZATION_CODE', $this->ORGANIZATION_CODE])
            ->andFilterWhere(['like', 'CREATE_TIME', $this->CREATE_TIME])
            ->andFilterWhere(['like', 'UPDATE_TIME', $this->UPDATE_TIME])
            ->andFilterWhere(['like', 'CREATE_USER', $this->CREATE_USER])
            ->andFilterWhere(['like', 'UPDATE_USER', $this->UPDATE_USER])
            ->andFilterWhere(['like', 'REMARK', $this->REMARK]);

        return $dataProvider;
    }
}
