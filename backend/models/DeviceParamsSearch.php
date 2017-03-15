<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DeviceParams;

/**
 * DeviceParamsSearch represents the model behind the search form about `app\models\DeviceParams`.
 */
class DeviceParamsSearch extends DeviceParams
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID'], 'integer'],
            [['APP_ID', 'GID', 'AGT_NUM', 'MD_BINDINGS_URL', 'MD_OPENDOOR_URL', 'MD_SHARE_URL', 'APP_KEY'], 'safe'],
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
        $query = DeviceParams::find();

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

        $query->andFilterWhere(['like', 'APP_ID', $this->APP_ID])
            ->andFilterWhere(['like', 'GID', $this->GID])
            ->andFilterWhere(['like', 'AGT_NUM', $this->AGT_NUM])
            ->andFilterWhere(['like', 'MD_BINDINGS_URL', $this->MD_BINDINGS_URL])
            ->andFilterWhere(['like', 'MD_OPENDOOR_URL', $this->MD_OPENDOOR_URL])
            ->andFilterWhere(['like', 'MD_SHARE_URL', $this->MD_SHARE_URL])
            ->andFilterWhere(['like', 'APP_KEY', $this->APP_KEY]);

        return $dataProvider;
    }
}
