<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Qiniu\Storage\UploadManager;
use Qiniu\Auth;

class TestController extends Controller
{
	public function actionTest(){
		$upManager = new UploadManager();
		$accessKey='111';
		$secretKey='3333';
		$bucketName='1111';
	    $auth = new Auth($accessKey, $secretKey);
	    $token = $auth->uploadToken($bucketName);
	    list($ret, $error) = $upManager->put($token, 'formput', 'hello world');
	    var_dump($ret);
	    var_dump($error);
	}
}