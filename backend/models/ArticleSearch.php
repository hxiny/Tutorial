<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Article;

/**
 * ArticleSearch represents the model behind the search form about `app\models\Article`.
 */
class ArticleSearch extends Article
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID', 'ARTICLE_TITLE', 'ARTICLE_URL', 'ARTICLE_INTRODUCT', 'ARTICLE_TYPE', 'ARTICLE_CONTENT', 'PIC_URL', 'IS_NEW', 'IS_TOP', 'IS_COMMENT', 'USER_ID', 'CREATE_TIME', 'CREATE_USER', 'UPDATE_TIME', 'UPDATE_USER', 'REMARK'], 'safe'],
            [['COMMENT_NUM', 'HITS'], 'integer'],
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
        $query = Article::find();

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
            'COMMENT_NUM' => $this->COMMENT_NUM,
            'HITS' => $this->HITS,
        ]);

        $query->andFilterWhere(['like', 'ID', $this->ID])
            ->andFilterWhere(['like', 'ARTICLE_TITLE', $this->ARTICLE_TITLE])
            ->andFilterWhere(['like', 'ARTICLE_URL', $this->ARTICLE_URL])
            ->andFilterWhere(['like', 'ARTICLE_INTRODUCT', $this->ARTICLE_INTRODUCT])
            ->andFilterWhere(['like', 'ARTICLE_TYPE', $this->ARTICLE_TYPE])
            ->andFilterWhere(['like', 'ARTICLE_CONTENT', $this->ARTICLE_CONTENT])
            ->andFilterWhere(['like', 'PIC_URL', $this->PIC_URL])
            ->andFilterWhere(['like', 'IS_NEW', $this->IS_NEW])
            ->andFilterWhere(['like', 'IS_TOP', $this->IS_TOP])
            ->andFilterWhere(['like', 'IS_COMMENT', $this->IS_COMMENT])
            ->andFilterWhere(['like', 'USER_ID', $this->USER_ID])
            ->andFilterWhere(['like', 'CREATE_TIME', $this->CREATE_TIME])
            ->andFilterWhere(['like', 'CREATE_USER', $this->CREATE_USER])
            ->andFilterWhere(['like', 'UPDATE_TIME', $this->UPDATE_TIME])
            ->andFilterWhere(['like', 'UPDATE_USER', $this->UPDATE_USER])
            ->andFilterWhere(['like', 'REMARK', $this->REMARK]);

        return $dataProvider;
    }
}
