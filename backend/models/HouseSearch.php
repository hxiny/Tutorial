<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\House;

/**
 * HouseSearch represents the model behind the search form about `app\models\House`.
 */
class HouseSearch extends House
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'BUILD_ID', 'HOUSE_CODE', 'HOUSE_TYPE', 'DEVICE_ID', 'IS_DOUBLE_DECK', 'ORIENTATION', 'CREATE_TIME', 'UPDATE_TIME', 'CREATE_USER', 'UPDATE_USER', 'REMARK'], 'safe'],
            [['STOREY', 'POOL_AREA', 'HOUSE_HEIGHT', 'ROOM_NUM', 'HALL_NUM', 'BALCONY_NUM', 'KITCHEN_NUM', 'BATHROOM_NUM'], 'integer'],
            [['HOUSE_AREA'], 'number'],
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
        $query = House::find()->select('t_house.*');

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
        $query->joinWith('build')->addSelect(Build::tableName() . '.CELL_ID')->where(['t_build.CELL_ID'=>Utils::authCells()]);

        // grid filtering conditions
        $query->andFilterWhere([
            'STOREY' => $this->STOREY,
            'HOUSE_AREA' => $this->HOUSE_AREA,
            'POOL_AREA' => $this->POOL_AREA,
            'HOUSE_HEIGHT' => $this->HOUSE_HEIGHT,
            'ROOM_NUM' => $this->ROOM_NUM,
            'HALL_NUM' => $this->HALL_NUM,
            'BALCONY_NUM' => $this->BALCONY_NUM,
            'KITCHEN_NUM' => $this->KITCHEN_NUM,
            'BATHROOM_NUM' => $this->BATHROOM_NUM,
        ]);

        $query->andFilterWhere(['like', 'ID', $this->ID])
            ->andFilterWhere(['like', 'BUILD_ID', $this->BUILD_ID])
            ->andFilterWhere(['like', 'HOUSE_CODE', $this->HOUSE_CODE])
            ->andFilterWhere(['like', 'HOUSE_TYPE', $this->HOUSE_TYPE])
            ->andFilterWhere(['like', 'DEVICE_ID', $this->DEVICE_ID])
            ->andFilterWhere(['like', 'IS_DOUBLE_DECK', $this->IS_DOUBLE_DECK])
            ->andFilterWhere(['like', 'ORIENTATION', $this->ORIENTATION])
            ->andFilterWhere(['like', 'CREATE_TIME', $this->CREATE_TIME])
            ->andFilterWhere(['like', 'UPDATE_TIME', $this->UPDATE_TIME])
            ->andFilterWhere(['like', 'CREATE_USER', $this->CREATE_USER])
            ->andFilterWhere(['like', 'UPDATE_USER', $this->UPDATE_USER])
            ->andFilterWhere(['like', 'REMARK', $this->REMARK]);

        return $dataProvider;
    }
}
