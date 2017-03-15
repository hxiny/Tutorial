<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\OwnerBill;

/**
 * BuildSearch represents the model behind the search form about `app\models\Build`.
 */
class BillSearch extends OwnerBill 
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PAY_AMOUNT','STATUS'], 'integer'],
            [['BILL_ID', 'HOUSE_ID', 'PAY_START_DATE', 'PAY_END_DATE', 'PAY_STATUS', 'CREATE_TIME', 'PAY_USER', 'OPER_TIME', 'PAY_ACCOUNT', 'REMAKR'], 'safe'],
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
        $query = OwnerBill::find()->select('t_bill.*')->where(array('STATUS' => 0));

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
        $query->joinWith('house')->addSelect(House::tableName() . '.BUILD_ID');
        $query->joinWith('house.build')->addSelect(Build::tableName().'.CELL_ID');
        $query->where(['t_build.CELL_ID' => Utils::authCells()]);
        // grid filtering conditions
        $query->andFilterWhere([
            'PAY_AMOUNT' => $this->PAY_AMOUNT,
            'STATUS' => $this->STATUS,
            'PAY_STATUS' => $this->PAY_STATUS,
        ]);

        $query->andFilterWhere(['like', 'BILL_ID', $this->BILL_ID])
            ->andFilterWhere(['like', 'HOUSE_ID', $this->HOUSE_ID])
            ->andFilterWhere(['like', 'PAY_START_DATE', $this->PAY_START_DATE])
            ->andFilterWhere(['like', 'PAY_END_DATE', $this->PAY_END_DATE])
            ->andFilterWhere(['like', 'CREATE_TIME', $this->CREATE_TIME])
            ->andFilterWhere(['like', 'OPER_TIME', $this->OPER_TIME])
            ->andFilterWhere(['like', 'REMAKR', $this->REMAKR]);

        return $dataProvider;
    }
}
