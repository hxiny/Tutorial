<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UserAuth;
use yii\helpers\ArrayHelper;

/**
 * UserAuthSearch represents the model behind the search form about `app\models\UserAuth`.
 */
class UserAuthSearch extends UserAuth
{
    public $NICKNAME;
    public $PHONE;
    public $STATUS;
    public $NEXT_KIN_PHONE;
    public $CREATE_TIME;
    public $CELL_NAME;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CELL_NAME','ID', 'AUTH_USER', 'CELL_ID', 'USER_NAME', 'CERT_ID', 'CERT_IMG',
                'AUTH_FLOW', 'AUTH_STATUS', 'AUTH_LIMIT', 'REMARK', 'NICKNAME',
                'PHONE', 'STATUS', 'NEXT_KIN_PHONE', 'CREATE_TIME'
            ], 'safe'],
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
        $query = UserAuthSearch::find();
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->where(['CELL_ID' => Utils::authCells()]);
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if (!empty($params['no_auth']) && count($params) == 1)
            $query->where("AUTH_STATUS IN(0,1)");
        else
            $query->andFilterWhere(['like', 'AUTH_STATUS', $this->AUTH_STATUS]);

        // grid filtering conditions
        $query->andFilterWhere(['like', 'ID', $this->ID])
            ->andFilterWhere(['like', 'AUTH_USER', $this->AUTH_USER])
            ->andFilterWhere(['like', 'CELL_ID', $this->CELL_ID])
            ->andFilterWhere(['like', 'USER_NAME', $this->USER_NAME])
            ->andFilterWhere(['like', 'CERT_ID', $this->CERT_ID])
            ->andFilterWhere(['like', 'CERT_IMG', $this->CERT_IMG])
            ->andFilterWhere(['like', 'AUTH_FLOW', $this->AUTH_FLOW])
            ->andFilterWhere(['like', 'AUTH_LIMIT', $this->AUTH_LIMIT])
            ->andFilterWhere(['like', 'REMARK', $this->REMARK]);

        // 关联用户表(t_user)
        $query->joinWith('user')->select("t_user_auth.* , t_user.*");
        $query->andFilterWhere(['like', 't_user.NICKNAME', $this->NICKNAME]);
        $query->andFilterWhere(['like', 't_user.PHONE', $this->PHONE]);
        $query->andFilterWhere(['like', 't_user.STATUS', $this->STATUS]);
        $query->andFilterWhere(['like', 't_user.NEXT_KIN_PHONE', $this->NEXT_KIN_PHONE]);
        $query->andFilterWhere(['like', 't_user.CREATE_TIME', $this->CREATE_TIME]);

        // 关联用户身份证信息表(t_user_cert)
        $query->joinWith('userCert');
        $query->select("t_user_auth.* , t_user.*, t_user_cert.MAN_CERT, t_user_cert.HOUSE_CERT");

        //关联小区表
        $query->joinWith('cell');
        $query->select("t_user_auth.* , t_user.*, t_user_cert.MAN_CERT, t_user_cert.HOUSE_CERT,t_cells.NAME as 
        CELL_NAME");
        $query->andFilterWhere(['like', 't_cells.NAME', $this->CELL_NAME]);
        return $dataProvider;
    }

    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(),[
            'CELL_NAME'=>'小区'
        ]);
    }
}
