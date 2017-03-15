<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Cells;

/**
 * CellsSearch represents the model behind the search form about `app\models\Cells`.
 */
class CellsSearch extends Cells
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'PROPERTY_ID', 'NAME', 'TYPE', 'ADDRESS', 'START_WORK_DATE', 'COMPLE_WORK_DATE', 'PLANE', 'CREATE_TIME', 'UPDATE_TIME', 'CREATE_USER', 'UPDATE_USER', 'REMARK'], 'safe'],
            [['STAGE', 'TOTAL_HOUSE', 'TOTAL_BUILD', 'PACK_NUM', 'ENTER_NUM', 'EXIT_NUM'], 'integer'],
            [['BUILD_AREA', 'COVER_AREA', 'HOUSE_AREA', 'STORE_AREA', 'OFFICE_AREA', 'CLUB_AREA', 'GREEN_AREA', 'LONGITUDE', 'LATITUDE'], 'number'],
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
        $query = Cells::find();

        $query->where(['ID' => Utils::authCells()]);

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
            'STAGE' => $this->STAGE,
            'TOTAL_HOUSE' => $this->TOTAL_HOUSE,
            'TOTAL_BUILD' => $this->TOTAL_BUILD,
            'BUILD_AREA' => $this->BUILD_AREA,
            'COVER_AREA' => $this->COVER_AREA,
            'HOUSE_AREA' => $this->HOUSE_AREA,
            'STORE_AREA' => $this->STORE_AREA,
            'OFFICE_AREA' => $this->OFFICE_AREA,
            'CLUB_AREA' => $this->CLUB_AREA,
            'GREEN_AREA' => $this->GREEN_AREA,
            'PACK_NUM' => $this->PACK_NUM,
            'ENTER_NUM' => $this->ENTER_NUM,
            'EXIT_NUM' => $this->EXIT_NUM,
            'LONGITUDE' => $this->LONGITUDE,
            'LATITUDE' => $this->LATITUDE,
        ]);

        $query->andFilterWhere(['like', 'ID', $this->ID])
            ->andFilterWhere(['like', 'PROPERTY_ID', $this->PROPERTY_ID])
            ->andFilterWhere(['like', 'NAME', $this->NAME])
            ->andFilterWhere(['like', 'TYPE', $this->TYPE])
            ->andFilterWhere(['like', 'ADDRESS', $this->ADDRESS])
            ->andFilterWhere(['like', 'START_WORK_DATE', $this->START_WORK_DATE])
            ->andFilterWhere(['like', 'COMPLE_WORK_DATE', $this->COMPLE_WORK_DATE])
            ->andFilterWhere(['like', 'PLANE', $this->PLANE])
            ->andFilterWhere(['like', 'CREATE_TIME', $this->CREATE_TIME])
            ->andFilterWhere(['like', 'UPDATE_TIME', $this->UPDATE_TIME])
            ->andFilterWhere(['like', 'CREATE_USER', $this->CREATE_USER])
            ->andFilterWhere(['like', 'UPDATE_USER', $this->UPDATE_USER])
            ->andFilterWhere(['like', 'REMARK', $this->REMARK]);

        return $dataProvider;
    }
}
