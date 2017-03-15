<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DeviceUserAuth;

/**
 * DeviceUserAuthSearch represents the model behind the search form about `app\models\DeviceUserAuth`.
 */
class DeviceUserAuthSearch extends DeviceUserAuth
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID'], 'integer'],
            [['DEVICE_ID', 'DEVICE_NAME', 'AUID', 'USER_ID', 'KEY_TYPE', 'IS_BINDINGS_WECHAT', 'IS_BINDINGS_MD', 'LOCK_ID', 'VALIDITY', 'KSID', 'CELL_ID', 'PID', 'MTYPE', 'STATUS', 'KEY_SECRET'], 'safe'],
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
        $query = DeviceUserAuth::find();

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

        $query->andFilterWhere(['like', 'DEVICE_ID', $this->DEVICE_ID])
            ->andFilterWhere(['like', 'DEVICE_NAME', $this->DEVICE_NAME])
            ->andFilterWhere(['like', 'AUID', $this->AUID])
            ->andFilterWhere(['like', 'USER_ID', $this->USER_ID])
            ->andFilterWhere(['like', 'KEY_TYPE', $this->KEY_TYPE])
            ->andFilterWhere(['like', 'IS_BINDINGS_WECHAT', $this->IS_BINDINGS_WECHAT])
            ->andFilterWhere(['like', 'IS_BINDINGS_MD', $this->IS_BINDINGS_MD])
            ->andFilterWhere(['like', 'LOCK_ID', $this->LOCK_ID])
            ->andFilterWhere(['like', 'VALIDITY', $this->VALIDITY])
            ->andFilterWhere(['like', 'KSID', $this->KSID])
            ->andFilterWhere(['like', 'CELL_ID', $this->CELL_ID])
            ->andFilterWhere(['like', 'PID', $this->PID])
            ->andFilterWhere(['like', 'MTYPE', $this->MTYPE])
            ->andFilterWhere(['like', 'STATUS', $this->STATUS])
            ->andFilterWhere(['like', 'KEY_SECRET', $this->KEY_SECRET]);

        return $dataProvider;
    }
}
