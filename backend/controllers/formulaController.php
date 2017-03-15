<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Qiniu\Storage\UploadManager;
use Qiniu\Auth;
use app\models\SmsFormula;
use app\models\SmsFormulaData;
use yii\db\Query;

class FormulaController extends Controller
{
	public function actionIndex(){
		$userId = '04kvf19yabbuw1nuqqa68yx7vose2msj';
		$smsFormula = SmsFormula::find()->where(['id' => 1])->asArray() -> one();
		$variableSets = explode(',',$smsFormula['variable_set']);
		$arr = '';
		if (!empty($variableSets)) {
			foreach ($variableSets as $val) {
				$smsFormulaData = SmsFormulaData::find()->where(['id' => $val])->asArray()->one();
				$queryData = (new Query())
								-> select($smsFormulaData['query_column'])
								-> from($smsFormulaData['query_table'])
								-> where(['USER_ID' => $userId])
								-> one();
				$arr[] = '"'.$smsFormulaData['variable'].'":"'.$queryData[$smsFormulaData['query_column']].'"';				
				print_r($queryData);echo "<br/>";
				print_r($smsFormulaData);echo "<br/>";
			}
		}
		print_r($arr);echo "<br/>";
		$str = '{'.implode(',', $arr).'}';
		echo $str."</br>"; 
		print_r($variableSets);
		echo "<br/>";
		print_r($smsFormula);die();
	}
}