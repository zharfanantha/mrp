<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class DestinationController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
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

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionPantai()
    {
        $this->layout = "main";
        $dataobj = (new \yii\db\Query())
                    ->select(['data_objek.*'])
                    ->from('data_objek')
                    ->where(['kategori'=> 'pantai'])
                    ->all();
        return $this->render('pantai',['dataobj'=>$dataobj]);
    }
    public function actionTerjun()
    {
        $dataobj = (new \yii\db\Query())
                    ->select(['data_objek.*'])
                    ->from('data_objek')
                    ->where(['kategori'=> 'Air Terjun'])
                    ->all();
        return $this->render('airterjun',['dataobj'=>$dataobj]);
    }
    public function actionPemandian()
    {
        $dataobj = (new \yii\db\Query())
                    ->select(['data_objek.*'])
                    ->from('data_objek')
                    ->where(['kategori'=> 'pemandian'])
                    ->all();
        return $this->render('pemandian',['dataobj'=>$dataobj]);
    }
    public function actionBudaya()
    {
        $dataobj = (new \yii\db\Query())
                    ->select(['data_objek.*'])
                    ->from('data_objek')
                    ->where(['kategori'=> 'budaya'])
                    ->all();
        return $this->render('budaya',['dataobj'=>$dataobj]);
    }
    public function actionReligi()
    {
        $dataobj = (new \yii\db\Query())
                    ->select(['data_objek.*'])
                    ->from('data_objek')
                    ->where(['kategori'=> 'religi'])
                    ->all();
        return $this->render('religi',['dataobj'=>$dataobj]);
    }
    public function actionHiburan()
    {
        $dataobj = (new \yii\db\Query())
                    ->select(['data_objek.*'])
                    ->from('data_objek')
                    ->where(['kategori'=> 'hiburan'])
                    ->all();
        return $this->render('hiburan',['dataobj'=>$dataobj]);
    }

}
