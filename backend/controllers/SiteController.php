<?php
namespace backend\controllers;

use app\models\Helper;
use app\models\SystemLog;
use common\models\User;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'wx'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $session = Yii::$app->session;
            $nowTime = date('Y-m-d H:i:s');
            $systemLog = new SystemLog();
            $systemLog['user_id'] = $session['__id'];
            $systemLog['operation'] = '登录';
            $systemLog['create_time'] = $nowTime;
            $systemLog->save();
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        $session = Yii::$app->session;
        $nowTime = date('Y-m-d H:i:s');
        $systemLog = new SystemLog();
        $systemLog['user_id'] = $session['__id'];
        $systemLog['operation'] = '退出登录';
        $systemLog['create_time'] = $nowTime;

        Yii::$app->user->logout();

        $systemLog->save();

        return $this->goHome();
    }

    public function actionWx()
    {
        $this->layout = false;

        $signature = Yii::$app->request->get("signature");
        $timestamp = Yii::$app->request->get("timestamp");
        $nonce = Yii::$app->request->get("nonce");
        $echostr = Yii::$app->request->get("echostr");
        //return $this->render('index');

        if ($this->checkSignature($signature, $timestamp, $nonce)) {
            echo $echostr;
        }

        exit;
    }

    public function actionSignup()
    {
        $user = new User();
        $user->username = 'yonglong';
        $user->password = '1';
        $user->setPassword('1');
        $user->generateAuthKey();
        $user->email="1@qq.com";
        $save = $user->save();
		echo '0';
    }

    private function checkSignature($signature, $timestamp, $nonce)
    {
        $token = Helper::TOKEN;

        $tmpArr = array($token, $timestamp, $nonce);

        sort($tmpArr, SORT_STRING);

        $tmpStr = implode( $tmpArr );

        $tmpStr = sha1( $tmpStr );


        if( $tmpStr == $signature ){

            return true;

        }else{

            return false;

        }
    }
}
