<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class PlacesController extends Controller
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

    public function actionDetails($id)
    {
        $this->layout = "main";
        $datnamkor = (new \yii\db\Query())
                    ->select(['data_objek.*','koordinat_objek.longitude', 'koordinat_objek.latitude', 'normalisasi.review'])
                    ->from('data_objek')
                    ->join('INNER JOIN','koordinat_objek','koordinat_objek.id_objek=data_objek.id_objek')
                    ->join('INNER JOIN','normalisasi','normalisasi.id_objek=data_objek.id_objek')
                    ->where(['data_objek.id_objek' => $id])
                    ->all();
        return $this->render('details',['datnamkor'=>$datnamkor]);
    }

}
