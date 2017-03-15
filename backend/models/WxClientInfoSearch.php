<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\WxClientInfo;

/**
 * WxClientInfoSearch represents the model behind the search form about `app\models\WxClientInfo`.
 */
class WxClientInfoSearch extends WxClientInfo
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['name', 'app_id', 'mch_id', 'gid', 'key', 'ap_secret', 'create_date', 'update_date', 'describe'], 'safe'],
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
        $query = WxClientInfo::find();

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
            'create_date' => $this->create_date,
            'update_date' => $this->update_date,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'app_id', $this->app_id])
            ->andFilterWhere(['like', 'gid', $this->gid])
            ->andFilterWhere(['like', 'mch_id', $this->mch_id])
            ->andFilterWhere(['like', 'key', $this->key])
            ->andFilterWhere(['like', 'ap_secret', $this->ap_secret])
            ->andFilterWhere(['like', 'describe', $this->describe]);

        return $dataProvider;
    }
}
