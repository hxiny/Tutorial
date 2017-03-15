<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TRepairNotes;
use yii\helpers\ArrayHelper;

/**
 * TRepairNotesSearch represents the model behind the search form about `app\models\TRepairNotes`.
 */
class TRepairNotesSearch extends TRepairNotes
{
    public $NICKNAME;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID','NICKNAME', 'USER_ID', 'REPAIR_TIME', 'REPAIR_PROJECT', 'REPAIR_PROBLEM', 'REPAIR_CONTENT', 'REPAIR_TYPE',
                'REPAIR_IMG', 'CELL_ID', 'BUILD_NUM', 'HOUSE_CODE', 'PHONE', 'EXPECT_TIME', 'STATUS', 'CREATE_TIME', 'CREATE_USER', 'UPDATE_TIME', 'UPDATE_USER', 'REMARK'], 'safe'],
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
//        select rn.`*`,u.NICKNAME from t_repair_notes rn left join t_user u on rn.USER_ID=u.USER_ID;
        $query = TRepairNotesSearch::find();
        $query->alias('rn')
            ->select('rn.*,u.NICKNAME')
            ->leftJoin('t_user u','rn.USER_ID=u.USER_ID');
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
//        $query->where(['CELL_ID' => [1]]);

        // grid filtering conditions
        $query->andFilterWhere(['like', 'ID', $this->ID])
            ->andFilterWhere(['like', 'u.NICKNAME', $this->NICKNAME])
            ->andFilterWhere(['like', 'REPAIR_TIME', $this->REPAIR_TIME])
            ->andFilterWhere(['like', 'REPAIR_PROJECT', $this->REPAIR_PROJECT])
            ->andFilterWhere(['like', 'REPAIR_PROBLEM', $this->REPAIR_PROBLEM])
            ->andFilterWhere(['like', 'REPAIR_CONTENT', $this->REPAIR_CONTENT])
            ->andFilterWhere(['like', 'REPAIR_TYPE', $this->REPAIR_TYPE])
            ->andFilterWhere(['like', 'REPAIR_IMG', $this->REPAIR_IMG])
            ->andFilterWhere(['like', 'CELL_ID', $this->CELL_ID])
            ->andFilterWhere(['like', 'BUILD_NUM', $this->BUILD_NUM])
            ->andFilterWhere(['like', 'HOUSE_CODE', $this->HOUSE_CODE])
            ->andFilterWhere(['like', 'PHONE', $this->PHONE])
            ->andFilterWhere(['like', 'EXPECT_TIME', $this->EXPECT_TIME])
            ->andFilterWhere(['like', 'rn.STATUS', $this->STATUS])
            ->andFilterWhere(['like', 'CREATE_TIME', $this->CREATE_TIME])
            ->andFilterWhere(['like', 'CREATE_USER', $this->CREATE_USER])
            ->andFilterWhere(['like', 'UPDATE_TIME', $this->UPDATE_TIME])
            ->andFilterWhere(['like', 'UPDATE_USER', $this->UPDATE_USER])
            ->andFilterWhere(['like', 'REMARK', $this->REMARK]);

        return $dataProvider;
    }
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(),[
            'NICKNAME'=>'报修人'
        ]);
    }
}
