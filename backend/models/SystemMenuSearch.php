<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SystemMenu;

/**
 * SystemMenuSearch represents the model behind the search form about `app\models\SystemMenu`.
 */
class SystemMenuSearch extends SystemMenu
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'MODULE_NAME', 'MODULE_URL', 'PIC_NAME', 'REMARK'], 'safe'],
            [['SORT'], 'integer'],
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
        $query = SystemMenu::find();

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
            'SORT' => $this->SORT,
        ]);

        $query->andFilterWhere(['like', 'ID', $this->ID])
            ->andFilterWhere(['like', 'MODULE_NAME', $this->MODULE_NAME])
            ->andFilterWhere(['like', 'MODULE_URL', $this->MODULE_URL])
            ->andFilterWhere(['like', 'PIC_NAME', $this->PIC_NAME])
            ->andFilterWhere(['like', 'REMARK', $this->REMARK]);

        return $dataProvider;
    }
}
