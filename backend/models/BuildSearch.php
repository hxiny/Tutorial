<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Build;

/**
 * BuildSearch represents the model behind the search form about `app\models\Build`.
 */
class BuildSearch extends Build
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'STOREY_NUM', 'ELEVATOR_NUM'], 'integer'],
            [['CELL_ID', 'AREA_ID', 'BUILD_NUM', 'ADDRESS', 'IS_ACCESS', 'CREATE_TIME', 'UPDATE_TIME', 'CREATE_USER', 'UPDATE_USER', 'REMARK'], 'safe'],
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
        $query = Build::find();

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
            'STOREY_NUM' => $this->STOREY_NUM,
            'ELEVATOR_NUM' => $this->ELEVATOR_NUM,
        ]);

        $query->andFilterWhere(['like', 'CELL_ID', $this->CELL_ID])
            ->andFilterWhere(['like', 'AREA_ID', $this->AREA_ID])
            ->andFilterWhere(['like', 'BUILD_NUM', $this->BUILD_NUM])
            ->andFilterWhere(['like', 'ADDRESS', $this->ADDRESS])
            ->andFilterWhere(['like', 'IS_ACCESS', $this->IS_ACCESS])
            ->andFilterWhere(['like', 'CREATE_TIME', $this->CREATE_TIME])
            ->andFilterWhere(['like', 'UPDATE_TIME', $this->UPDATE_TIME])
            ->andFilterWhere(['like', 'CREATE_USER', $this->CREATE_USER])
            ->andFilterWhere(['like', 'UPDATE_USER', $this->UPDATE_USER])
            ->andFilterWhere(['like', 'REMARK', $this->REMARK]);

        return $dataProvider;
    }
}
