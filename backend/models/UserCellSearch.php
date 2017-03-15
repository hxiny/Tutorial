<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UserCell;

/**
 * UserCellSearch represents the model behind the search form about `app\models\UserCell`.
 */
class UserCellSearch extends UserCell
{
    public $NICKNAME;
    public $PHONE;
    public $NEXT_KIN_PHONE;
    public $CREATE_TIME;
    public $CELL_NAME;
    public $BUILD_NUM;
    public $ADDRESS;
    public $STOREY;
    public $HOUSE_CODE;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[
                'NICKNAME',
                'PHONE',
                'NEXT_KIN_PHONE',
                'CREATE_TIME',
                'CELL_NAME',
                'BUILD_NUM',
                'ADDRESS',
                'STOREY',
                'HOUSE_CODE',
                'ID', 'USER_ID', 'HOUSE_IDENTITY', 'STATUS', 'IS_DEFAULT'], 'safe'],
            [['CELL_ID', 'BUILD_ID', 'HOUSE_ID'], 'integer'],
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
        $query = UserCellSearch::find()->select('t_user_cell.*');
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
        $query->where(['t_user_cell.CELL_ID' => Utils::authCells()]);
        // 关联用户表(t_user)
        $query->joinWith('user')->addSelect("t_user.*");
        $query->andFilterWhere(['like', 't_user.NICKNAME', $this->NICKNAME]);
        $query->andFilterWhere(['like', 't_user.PHONE', $this->PHONE]);
        $query->andFilterWhere(['like', 't_user.NEXT_KIN_PHONE', $this->NEXT_KIN_PHONE]);

        //关联小区表
        $query->joinWith('cell')->addSelect("t_cells.NAME as CELL_NAME");
        $query->andFilterWhere(['like', 't_cells.NAME', $this->CELL_NAME]);
//
        //楼宇
        $query->joinWith('build')->addSelect("t_build.BUILD_NUM ,t_build.ADDRESS");
        $query->andFilterWhere(['like', 't_build.BUILD_NUM', $this->BUILD_NUM]);
        $query->andFilterWhere(['like', 't_build.ADDRESS', $this->ADDRESS]);
        //房间
        $query->joinWith('house')->addSelect("t_house.STOREY,t_house.HOUSE_CODE");
        $query->andFilterWhere(['like', 't_house.STOREY', $this->STOREY]);
        $query->andFilterWhere(['like', 't_house.HOUSE_CODE', $this->HOUSE_CODE]);

        // grid filtering conditions
        $query->andFilterWhere([
            't_user_cell.CELL_ID' => $this->CELL_ID,
            'BUILD_ID' => $this->BUILD_ID,
            'HOUSE_ID' => $this->HOUSE_ID,
        ]);

        $query->andFilterWhere(['like', 'ID', $this->ID])
            ->andFilterWhere(['like', 't_user_cell.USER_ID', $this->USER_ID])
            ->andFilterWhere(['like', 't_user_cell.HOUSE_IDENTITY', $this->HOUSE_IDENTITY])
            ->andFilterWhere(['like', 't_user_cell.STATUS', $this->STATUS])
            ->andFilterWhere(['like', 't_user_cell.IS_DEFAULT', $this->IS_DEFAULT]);

        return $dataProvider;
    }

    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(),[
            'NICKNAME' => '姓名',
            'PHONE' => '手机',
            'NEXT_KIN_PHONE' => '近亲电话',
            'CELL_NAME' => '小区名称',
            'BUILD_NUM' => '楼房编号',
            'ADDRESS' => '楼房地址',
            'STOREY' => '所在楼层',
            'HOUSE_CODE' => '房屋编号',
        ]);
    }

}
