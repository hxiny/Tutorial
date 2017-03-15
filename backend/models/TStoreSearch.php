<?php

namespace app\models;

use Yii;
use yii\base\Exception;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TStore;
use yii\helpers\ArrayHelper;

/**
 * TStoreSearch represents the model behind the search form about `app\models\TStore`.
 */
class TStoreSearch extends TStore
{
    public $CELL_NAME;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CELL_NAME'
                ,'ID', 'NAME', 'PIC_URL', 'STORE_TYPE', 'STORE_INTRODUCT', 'STORE_IMG', 'PHONE', 'LANDLINE',
                'ADDRESS', 'BOSS_NAME', 'BOSS_CERT', 'OPEN_TIME', 'CERT_INFO', 'CREATE_TIME', 'UPDATE_TIME', 'CREATE_USER', 'UPDATE_USER', 'REMARK'], 'safe'],
            [['IS_TOP', 'STAR_LEVEL', 'AWAY_FROM'], 'integer'],
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
        $query = TStore::find();

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
            'IS_TOP' => $this->IS_TOP,
            'STAR_LEVEL' => $this->STAR_LEVEL,
            'AWAY_FROM' => $this->AWAY_FROM,
        ]);

        $query->andFilterWhere(['like', 'ID', $this->ID])
            ->andFilterWhere(['like', 'NAME', $this->NAME])
            ->andFilterWhere(['like', 'PIC_URL', $this->PIC_URL])
            ->andFilterWhere(['like', 'STORE_TYPE', $this->STORE_TYPE])
            ->andFilterWhere(['like', 'STORE_INTRODUCT', $this->STORE_INTRODUCT])
            ->andFilterWhere(['like', 'STORE_IMG', $this->STORE_IMG])
            ->andFilterWhere(['like', 'PHONE', $this->PHONE])
            ->andFilterWhere(['like', 'LANDLINE', $this->LANDLINE])
            ->andFilterWhere(['like', 'ADDRESS', $this->ADDRESS])
            ->andFilterWhere(['like', 'BOSS_NAME', $this->BOSS_NAME])
            ->andFilterWhere(['like', 'BOSS_CERT', $this->BOSS_CERT])
            ->andFilterWhere(['like', 'OPEN_TIME', $this->OPEN_TIME])
            ->andFilterWhere(['like', 'CERT_INFO', $this->CERT_INFO])
            ->andFilterWhere(['like', 'CREATE_TIME', $this->CREATE_TIME])
            ->andFilterWhere(['like', 'UPDATE_TIME', $this->UPDATE_TIME])
            ->andFilterWhere(['like', 'CREATE_USER', $this->CREATE_USER])
            ->andFilterWhere(['like', 'UPDATE_USER', $this->UPDATE_USER])
            ->andFilterWhere(['like', 'REMARK', $this->REMARK]);

        return $dataProvider;
    }
    public function attributeLabels()
    {
        return   ArrayHelper::merge(parent::attributeLabels(),[
            'CELL_NAME' => '小区'
        ]);
    }
}
