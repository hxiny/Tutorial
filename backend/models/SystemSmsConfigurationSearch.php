<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SystemSmsConfiguration;

/**
 * SystemSmsConfigurationSearch represents the model behind the search form about `app\models\SystemSmsConfiguration`.
 */
class SystemSmsConfigurationSearch extends SystemSmsConfiguration
{
	//11
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'company_id', 'type'], 'integer'],
            [['app_key', 'configuration_name', 'app_id', 'secret_key', 'extend', 'sms_type', 'sms_free_sign_name', 'sms_template_code'], 'safe'],
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
        $query = SystemSmsConfiguration::find();

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
            'company_id' => $this->company_id,
            'type' => $this->type,
        ]);

        $query->andFilterWhere(['like', 'app_key', $this->app_key])
            ->andFilterWhere(['like', 'secret_key', $this->secret_key])
            ->andFilterWhere(['like', 'configuration_name', $this->configuration_name])
            ->andFilterWhere(['like', 'app_id', $this->app_id])
            ->andFilterWhere(['like', 'extend', $this->extend])
            ->andFilterWhere(['like', 'sms_type', $this->sms_type])
            ->andFilterWhere(['like', 'sms_free_sign_name', $this->sms_free_sign_name])
            ->andFilterWhere(['like', 'sms_template_code', $this->sms_template_code]);

        return $dataProvider;
    }
}
