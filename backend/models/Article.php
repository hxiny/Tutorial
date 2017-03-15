<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_article".
 *
 * @property string $ID
 * @property string $ARTICLE_TITLE
 * @property string $ARTICLE_URL
 * @property string $ARTICLE_INTRODUCT
 * @property string $ARTICLE_TYPE
 * @property string $ARTICLE_CONTENT
 * @property string $PIC_URL
 * @property string $IS_NEW
 * @property string $IS_TOP
 * @property string $IS_COMMENT
 * @property integer $COMMENT_NUM
 * @property integer $HITS
 * @property string $USER_ID
 * @property string $CREATE_TIME
 * @property string $CREATE_USER
 * @property string $UPDATE_TIME
 * @property string $UPDATE_USER
 * @property string $REMARK
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 't_article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'ARTICLE_CONTENT'], 'required'],
            [['ARTICLE_CONTENT'], 'string'],
            [['COMMENT_NUM', 'HITS'], 'integer'],
            [['USER_ID'], 'string', 'max' => 32],
            [['ARTICLE_TITLE', 'CREATE_TIME', 'UPDATE_TIME'], 'string', 'max' => 20],
            [['ARTICLE_URL', 'ARTICLE_INTRODUCT'], 'string', 'max' => 200],
            [['ARTICLE_TYPE'], 'string', 'max' => 12],
            [['PIC_URL'], 'string', 'max' => 100],
            [['IS_NEW', 'IS_TOP', 'IS_COMMENT'], 'string', 'max' => 1],
            [['CREATE_USER', 'UPDATE_USER'], 'string', 'max' => 50],
            [['REMARK'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => '文章编号',
            'ARTICLE_TITLE' => '文章标题',
            'ARTICLE_URL' => '文章路径',
            'ARTICLE_INTRODUCT' => '文章简介',
            'ARTICLE_TYPE' => '文章类型',
            'ARTICLE_CONTENT' => '文章内容',
            'PIC_URL' => '图片路径',
            'IS_NEW' => '是否新发布',
            'IS_TOP' => '是否热点',
            'IS_COMMENT' => '是否可评论',
            'COMMENT_NUM' => '评论数',
            'HITS' => '点击数',
            'USER_ID' => '用户编号',
            'CREATE_TIME' => '创建时间',
            'CREATE_USER' => '创建人员',
            'UPDATE_TIME' => '修改时间',
            'UPDATE_USER' => '修改人员',
            'REMARK' => '备注信息',
        ];
    }
}
