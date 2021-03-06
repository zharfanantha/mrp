<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
// use app\components\Sentiment;

use yii\helpers\Html;


class SiteController extends Controller
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

    public function actionIndex()
    {
        $this->layout = "main";
        return $this->render('index');
    }

    public function actionDestination()
    {
        $this->layout = "main";
        return $this->render('destination');
    }

    public function actionRekomendasi()
    {
        $this->layout = "main";
        $longlat = (new \yii\db\Query())
                    ->select(['longitude', 'latitude'])
                    ->from('koordinat_objek')
                    ->all();
        $datbnc = (new \yii\db\Query())
                    ->select(['bencana'])
                    ->from('data_objek')
                    ->all();
        $dathtm = (new \yii\db\Query())
                    ->select(['biaya'])
                    ->from('data_objek')
                    ->all();
        $datskor = (new \yii\db\Query())
                    ->select(['finalSkor'])
                    ->from('skor_normalisasi')
                    ->all();
        $batbnc = (new \yii\db\Query())
                    ->select(['bawah', 'tengah', 'atas'])
                    ->from('batas_atribut')
                    ->where(['atribut' => 'bencana'])
                    ->all();
        $batskor = (new \yii\db\Query())
                    ->select(['bawah', 'tengah', 'atas'])
                    ->from('batas_atribut')
                    ->where(['atribut' => 'skor'])
                    ->all();
        $datnamkor = (new \yii\db\Query())
                    ->select(['data_objek.id_objek','data_objek.nama_objek','koordinat_objek.longitude', 'koordinat_objek.latitude', 'skor_normalisasi.finalSkor'])
                    ->from('data_objek')
                    ->join('INNER JOIN','koordinat_objek','koordinat_objek.id_objek=data_objek.id_objek')
                    ->join('INNER JOIN','skor_normalisasi','skor_normalisasi.id_objek=koordinat_objek.id_objek')
                    ->all();
        // $koor = (new \yii\db\Query())
        //             ->select(['a.nama_objek', 'a.kategori', 'b.latitude', 'b.longitude'])
        //             ->from('data_objek a', 'koordinat_objek b')
        //             ->where('a.id_objek=b.id_objek')
        //             ->all();
        return $this->render('rekomendasi',['longlat'=>$longlat,
                                            'datbnc'=>$datbnc,
                                            'dathtm'=>$dathtm,
                                            'datskor'=>$datskor,
                                            'batbnc'=>$batbnc,
                                            'batskor'=>$batskor,
                                            'datnamkor'=>$datnamkor]);
    }

    public function actionFuzzy()
    {   
        //echo "string Fuzzy";
        extract($_POST);

        $bencana = array();
        $htm = array();
        $biaya = array();
        $btsbnc = array();
        $hasil_fuzzifikasi = array();

        foreach ($datbnc as $row) {
            $bencana[] = $row;
        } //echo "Bencana<br>"; print_r($bencana);
        foreach ($dathtm as $raw) {
            $htm[] = $raw;
        } //echo "Htm<br>"; print_r($htm);
        foreach ($batbnc as $riw) {
            $btsbnc[] = $riw;
        } //echo "Bts Bencana<br>"; print_r($btsbnc);

        // ===================================== FUZZIFIKASI =====================
        for($i=0; $i < sizeof($jarak); $i++) {
            $itr = 0;
            $jarak[$i] = substr($jarak[$i], 0, strlen($jarak[$i])-3);
            $biaya[$i] = ($jarak[$i]*700)+$htm[$i]['biaya'];

            // ======================= JARAK =======================
            if($jarak[$i] <= $bwh){
                $hasil_fuzzifikasi[$i][$itr] = 1;
                $itr++;
            } elseif($bwh <= $jarak[$i] && $jarak[$i] < $tgh) {
                $hasil_fuzzifikasi[$i][$itr] = round((($tgh - $jarak[$i]) / ($tgh - $bwh)),2);
                $itr++;
            } elseif($jarak[$i] >= $tgh) {
                $hasil_fuzzifikasi[$i][$itr] = 0;
                $itr++;
            }

            if($jarak[$i] <= $bwh || $jarak[$i] >= $ats){
                $hasil_fuzzifikasi[$i][$itr] = 0;
                $itr++;
            } elseif($bwh <= $jarak[$i] && $jarak[$i] < $tgh) {
                $hasil_fuzzifikasi[$i][$itr] = round((($jarak[$i] - $bwh) / ($tgh - $bwh)),2);
                $itr++;
            } elseif($jarak[$i] >= $tgh && $jarak[$i] < $ats ) {
                $hasil_fuzzifikasi[$i][$itr] = round((($ats - $jarak[$i]) / ($ats - $tgh)),2);
                $itr++;
            }

            if($jarak[$i] <= $tgh){
                $hasil_fuzzifikasi[$i][$itr] = 0;
                $itr++;
            } elseif($tgh <= $jarak[$i] && $jarak[$i] < $ats) {
                $hasil_fuzzifikasi[$i][$itr] = round((($jarak[$i] - $tgh) / ($ats - $tgh)),2);
                $itr++;
            } elseif($jarak[$i] >= $ats) {
                $hasil_fuzzifikasi[$i][$itr] = 1;
                $itr++;
            }

            // ======================= BIAYA =======================

            if($biaya[$i] <= $bbwh){
                $hasil_fuzzifikasi[$i][$itr] = 1;
                $itr++;
            } elseif($bbwh <= $biaya[$i] && $biaya[$i] < $btgh) {
                $hasil_fuzzifikasi[$i][$itr] = round((($btgh - $biaya[$i]) / ($btgh - $bbwh)),2);
                $itr++;
            } elseif($biaya[$i] >= $btgh) {
                $hasil_fuzzifikasi[$i][$itr] = 0;
                $itr++;
            }

            if($biaya[$i] <= $bbwh || $biaya[$i] >= $bats){
                $hasil_fuzzifikasi[$i][$itr] = 0;
                $itr++;
            } elseif($bbwh <= $biaya[$i] && $biaya[$i] < $btgh) {
                $hasil_fuzzifikasi[$i][$itr] = round((($biaya[$i] - $bbwh) / ($btgh - $bbwh)),2);
                $itr++;
            } elseif($biaya[$i] >= $btgh && $biaya[$i] < $bats ) {
                $hasil_fuzzifikasi[$i][$itr] = round((($bats - $biaya[$i]) / ($bats - $btgh)),2);
                $itr++;
            }

            if($biaya[$i] <= $btgh){
                $hasil_fuzzifikasi[$i][$itr] = 0;
                $itr++;
            } elseif($btgh <= $biaya[$i] && $biaya[$i] < $bats) {
                $hasil_fuzzifikasi[$i][$itr] = round((($biaya[$i] - $btgh) / ($bats - $btgh)),2);
                $itr++;
            } elseif($biaya[$i] >= $bats) {
                $hasil_fuzzifikasi[$i][$itr] = 1;
                $itr++;
            }

            // ======================= BENCANA =======================

            if($bencana[$i]['bencana'] <= $btsbnc[0]['bawah']){
                $hasil_fuzzifikasi[$i][$itr] = 1;
                $itr++;
            } elseif($btsbnc[0]['bawah'] <= $bencana[$i]['bencana'] && $bencana[$i]['bencana'] < $btsbnc[0]['tengah']) {
                $hasil_fuzzifikasi[$i][$itr] = round((($btsbnc[0]['tengah'] - $bencana[$i]['bencana']) / ($btsbnc[0]['tengah'] - $btsbnc[0]['bawah'])),2);
                $itr++;
            } elseif($bencana[$i]['bencana'] >= $btsbnc[0]['tengah']) {
                $hasil_fuzzifikasi[$i][$itr] = 0;
                $itr++;
            }

            if($bencana[$i]['bencana'] <= $btsbnc[0]['bawah'] || $bencana[$i]['bencana'] >= $btsbnc[0]['atas']){
                $hasil_fuzzifikasi[$i][$itr] = 0;
                $itr++;
            } elseif($btsbnc[0]['bawah'] <= $bencana[$i]['bencana'] && $bencana[$i]['bencana'] < $btsbnc[0]['tengah']) {
                $hasil_fuzzifikasi[$i][$itr] = round((($bencana[$i]['bencana'] - $btsbnc[0]['bawah']) / ($btsbnc[0]['tengah'] - $btsbnc[0]['bawah'])),2);
                $itr++;
            } elseif($bencana[$i]['bencana'] >= $btsbnc[0]['tengah'] && $bencana[$i]['bencana'] < $btsbnc[0]['atas'] ) {
                $hasil_fuzzifikasi[$i][$itr] = round((($btsbnc[0]['atas'] - $bencana[$i]['bencana']) / ($btsbnc[0]['atas'] - $btsbnc[0]['tengah'])),2);
                $itr++;
            }

            if($bencana[$i]['bencana'] <= $btsbnc[0]['tengah']){
                $hasil_fuzzifikasi[$i][$itr] = 0;
                $itr++;
            } elseif($btsbnc[0]['tengah'] <= $bencana[$i]['bencana'] && $bencana[$i]['bencana'] < $btsbnc[0]['atas']) {
                $hasil_fuzzifikasi[$i][$itr] = round((($bencana[$i]['bencana'] - $btsbnc[0]['tengah']) / ($btsbnc[0]['atas'] - $btsbnc[0]['tengah'])),2);
                $itr++;
            } elseif($bencana[$i]['bencana'] >= $btsbnc[0]['atas']) {
                $hasil_fuzzifikasi[$i][$itr] = 1;
                $itr++;
            }

        } //echo "Derajat Keanggotaan ==> <br>"; print_r($hasil_fuzzifikasi);//print_r($jarak); print_r($biaya);

        // ========================================== CARI MAX ========================

        $cariMax = array();
        $hasilMax = array();
        for($i=0; $i < sizeof($jarak); $i++) {
            // ===================== MAX JARAK ====================
            if($hasil_fuzzifikasi[$i][0] >= $hasil_fuzzifikasi[$i][1] && $hasil_fuzzifikasi[$i][0] >= $hasil_fuzzifikasi[$i][2]) {
                $cariMax[$i][0] = 0;//$hasil_fuzzifikasi[$i][$j][0];
                $hasilMax[$i][0] = $hasil_fuzzifikasi[$i][0];
            } else if ($hasil_fuzzifikasi[$i][1] >= $hasil_fuzzifikasi[$i][0] && $hasil_fuzzifikasi[$i][1] >= $hasil_fuzzifikasi[$i][2]) {
                $cariMax[$i][0] = 1;//$hasil_fuzzifikasi[$i][$j][1];
                $hasilMax[$i][0] = $hasil_fuzzifikasi[$i][1];
            } else if ($hasil_fuzzifikasi[$i][2] >= $hasil_fuzzifikasi[$i][0] && $hasil_fuzzifikasi[$i][2] >= $hasil_fuzzifikasi[$i][1]) {
                $cariMax[$i][0] = 2;//$hasil_fuzzifikasi[$i][$j][2];
                $hasilMax[$i][0] = $hasil_fuzzifikasi[$i][2];
            }

            // ==================== MAX BIAYA =====================
            if($hasil_fuzzifikasi[$i][3] >= $hasil_fuzzifikasi[$i][4] && $hasil_fuzzifikasi[$i][3] >= $hasil_fuzzifikasi[$i][5]) {
                $cariMax[$i][1] = 0;//$hasil_fuzzifikasi[$i][$j][0];
                $hasilMax[$i][1] = $hasil_fuzzifikasi[$i][3];
            } else if ($hasil_fuzzifikasi[$i][4] >= $hasil_fuzzifikasi[$i][3] && $hasil_fuzzifikasi[$i][4] >= $hasil_fuzzifikasi[$i][5]) {
                $cariMax[$i][1] = 1;//$hasil_fuzzifikasi[$i][$j][1];
                $hasilMax[$i][1] = $hasil_fuzzifikasi[$i][4];
            } else if ($hasil_fuzzifikasi[$i][5] >= $hasil_fuzzifikasi[$i][3] && $hasil_fuzzifikasi[$i][5] >= $hasil_fuzzifikasi[$i][4]) {
                $cariMax[$i][1] = 2;//$hasil_fuzzifikasi[$i][$j][2];
                $hasilMax[$i][1] = $hasil_fuzzifikasi[$i][5];
            }

            // ==================== MAX BENCANA =====================
            if($hasil_fuzzifikasi[$i][6] >= $hasil_fuzzifikasi[$i][7] && $hasil_fuzzifikasi[$i][6] >= $hasil_fuzzifikasi[$i][8]) {
                $cariMax[$i][2] = 0;//$hasil_fuzzifikasi[$i][$j][0];
                $hasilMax[$i][2] = $hasil_fuzzifikasi[$i][6];
            } else if ($hasil_fuzzifikasi[$i][7] >= $hasil_fuzzifikasi[$i][6] && $hasil_fuzzifikasi[$i][7] >= $hasil_fuzzifikasi[$i][8]) {
                $cariMax[$i][2] = 1;//$hasil_fuzzifikasi[$i][$j][1];
                $hasilMax[$i][2] = $hasil_fuzzifikasi[$i][7];
            } else if ($hasil_fuzzifikasi[$i][8] >= $hasil_fuzzifikasi[$i][6] && $hasil_fuzzifikasi[$i][8] >= $hasil_fuzzifikasi[$i][7]) {
                $cariMax[$i][2] = 2;//$hasil_fuzzifikasi[$i][$j][2];
                $hasilMax[$i][2] = $hasil_fuzzifikasi[$i][8];
            }
        } //echo "<br>Hasil Max ==> <br>"; print_r($hasilMax);

        // ==================================== CARI NILAI MIN ================================
        $hasilMin = array();
        for($i=0; $i < sizeof($jarak); $i++) { // Looping Objek
            if ($hasilMax[$i][0] <= $hasilMax[$i][1] && $hasilMax[$i][0] <= $hasilMax[$i][2]) {
                $hasilMin[$i] = $hasilMax[$i][0];
            } else if ($hasilMax[$i][1] <= $hasilMax[$i][0] && $hasilMax[$i][1] <= $hasilMax[$i][2]) {
                $hasilMin[$i] = $hasilMax[$i][1];
            } else if ($hasilMax[$i][2] <= $hasilMax[$i][1] && $hasilMax[$i][2] <= $hasilMax[$i][0]) {
                $hasilMin[$i] = $hasilMax[$i][2];
            } 
        } //echo "<br>Hasil Min ==> <br>"; print_r($hasilMin);
        

        $labelfuz = array();
        $choosenfuz = array();
        $cek = 0;
        for($i=0; $i < sizeof($jarak); $i++) { // Looping Objek
            if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 0) {
                $labelfuz[$i] = "Sangat Direkomendasi";
            } else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 1) {
                $labelfuz[$i] = "Sangat Direkomendasi";
            } else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 2) {
                $labelfuz[$i] = "Sangat Direkomendasi";
            } else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 0) {
                $labelfuz[$i] = "Sangat Direkomendasi";
            } else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 1) {
                $labelfuz[$i] = "Sangat Direkomendasi";
            } else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 2) {
                $labelfuz[$i] = "Sangat Direkomendasi";
            } else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 0) {
                $labelfuz[$i] = "Direkomendasi";
            } else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 1) {
                $labelfuz[$i] = "Direkomendasi";
            } else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 2) {
                $labelfuz[$i] = "Direkomendasi";
            } else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 0) {
                $labelfuz[$i] = "Sangat Direkomendasi";
            } else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 1) {
                $labelfuz[$i] = "Sangat Direkomendasi";
            } else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 2) {
                $labelfuz[$i] = "Sangat Direkomendasi";
            } else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 0) {
                $labelfuz[$i] = "Direkomendasi";
            } else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 1) {
                $labelfuz[$i] = "Direkomendasi";
            } else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 2) {
                $labelfuz[$i] = "Direkomendasi";
            } else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 0) {
                $labelfuz[$i] = "Direkomendasi";
            } else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 1) {
                $labelfuz[$i] = "Tidak Direkomendasi";
            } else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 2) {
                $labelfuz[$i] = "Tidak Direkomendasi";
            } else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 0) {
                $labelfuz[$i] = "Direkomendasi";
            } else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 1) {
                $labelfuz[$i] = "Direkomendasi";
            } else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 2) {
                $labelfuz[$i] = "Direkomendasi";
            } else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 0) {
                $labelfuz[$i] = "Direkomendasi";
            } else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 1) {
                $labelfuz[$i] = "Direkomendasi";
            } else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 2) {
                $labelfuz[$i] = "Tidak Direkomendasi";
            } else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 0) {
                $labelfuz[$i] = "Tidak Direkomendasi";
            } else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 1) {
                $labelfuz[$i] = "Tidak Direkomendasi";
            } else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 2) {
                $labelfuz[$i] = "Tidak Direkomendasi";
            }

            if ($labelfuz[$i] == "Sangat Direkomendasi") {
                $choosenfuz[$cek] = $i;
                $cek++;
            }
        } //print_r($labelfuz); echo "<br>Id Objek Terpilih<br>"; print_r($choosen); echo "<br>"; print_r(sizeof($choosen)); echo "<br>"; //print_r(sizeof($hasilMin));

        $res = array();

        for ($i=0; $i < sizeof($choosenfuz); $i++) { 
            $res[$i] = $datnamkor[$choosenfuz[$i]];
            $res[$i]['hasilMin'] = $hasilMin[$choosenfuz[$i]];
        }
        //echo "<br>Hasil Rekomendasi Fuzzy Sebelum Sentimen ==> <br>"; print_r($res);

        if (sizeof($res) == 0) {
            echo "<h4 class='list-group-item'>Mohon Maaf, Kami Tidak Dapat Menemukan Rekomendasi Objek Wisata Dari Kriteria Yang Anda Inputkan</h4>";
        } else {
            usort($res, function($a,$b){
                return ($a['finalSkor'] > $b['finalSkor']) ? -1 : 1;
            });
            // echo "RES ==><br>";
            // print_r($res);

            //echo "<br>Hasil Rekomendasi Fuzzy Setelah Sentimen ==> <br>"; print_r($res);

            for($i=0 ; $i < 15 ; $i++){
                echo " <a href='javascript:void(0)' class='item list-group-item' data-long ='".$res[$i]['longitude']."' data-lat='".$res[$i]['latitude']."'>
                             <h4 class='list-group-item'>".$res[$i]['nama_objek']."</h4>
                             ".Html::a('Details',['places/details','id' => $res[$i]['id_objek']],['target' => '_blank', 'style'=>'float:right', 'class'=>'btn btn-primary btn-flat'])."
                             <a style='color: black;'>Skor Sentimen : ".$res[$i]['finalSkor']."</a><br>
                             <a style='color: black;'>Skor Fuzzy : ".$res[$i]['hasilMin']."</a><br>
                     </a>";
            }
        }
    }

    public function actionSentimen()
    {
        //echo "stringSentimen";
        extract($_POST);
        
        $bencana = array();
        $htm = array();
        $biaya = array();
        $btsbnc = array();
        $hasil_fuzzifikasi = array();
        
        foreach ($datbnc as $row) {
            $bencana[] = $row;
        } //echo "Bencana<br>"; print_r($bencana);
        foreach ($dathtm as $raw) {
            $htm[] = $raw;
        } //echo "Htm<br>"; print_r($htm);
        foreach ($datskor as $rew) {
            $skor[] = $rew;
        } //echo "Skor<br>"; print_r($skor);
        foreach ($batbnc as $riw) {
            $btsbnc[] = $riw;
        } //echo "Bts Bencana<br>"; print_r($btsbnc);
        foreach ($batskor as $ruw) {
            $btsskor[] = $ruw;
        } //echo "Bts Skor<br>"; print_r($btsskor);

        // ===================================== FUZZIFIKASI =====================
        for($i=0; $i < sizeof($jarak); $i++) {
            $itr = 0;
            $jarak[$i] = substr($jarak[$i], 0, strlen($jarak[$i])-3);
            $biaya[$i] = ($jarak[$i]*700)+$htm[$i]['biaya'];

            // ======================= JARAK =======================
            if($jarak[$i] <= $bwh){
                $hasil_fuzzifikasi[$i][$itr] = 1;
                $itr++;
            } elseif($bwh <= $jarak[$i] && $jarak[$i] < $tgh) {
                $hasil_fuzzifikasi[$i][$itr] = round((($tgh - $jarak[$i]) / ($tgh - $bwh)),2);
                $itr++;
            } elseif($jarak[$i] >= $tgh) {
                $hasil_fuzzifikasi[$i][$itr] = 0;
                $itr++;
            }

            if($jarak[$i] <= $bwh || $jarak[$i] >= $ats){
                $hasil_fuzzifikasi[$i][$itr] = 0;
                $itr++;
            } elseif($bwh <= $jarak[$i] && $jarak[$i] < $tgh) {
                $hasil_fuzzifikasi[$i][$itr] = round((($jarak[$i] - $bwh) / ($tgh - $bwh)),2);
                $itr++;
            } elseif($jarak[$i] >= $tgh && $jarak[$i] < $ats ) {
                $hasil_fuzzifikasi[$i][$itr] = round((($ats - $jarak[$i]) / ($ats - $tgh)),2);
                $itr++;
            }

            if($jarak[$i] <= $tgh){
                $hasil_fuzzifikasi[$i][$itr] = 0;
                $itr++;
            } elseif($tgh <= $jarak[$i] && $jarak[$i] < $ats) {
                $hasil_fuzzifikasi[$i][$itr] = round((($jarak[$i] - $tgh) / ($ats - $tgh)),2);
                $itr++;
            } elseif($jarak[$i] >= $ats) {
                $hasil_fuzzifikasi[$i][$itr] = 1;
                $itr++;
            }

            // ======================= BIAYA =======================

            if($biaya[$i] <= $bbwh){
                $hasil_fuzzifikasi[$i][$itr] = 1;
                $itr++;
            } elseif($bbwh <= $biaya[$i] && $biaya[$i] < $btgh) {
                $hasil_fuzzifikasi[$i][$itr] = round((($btgh - $biaya[$i]) / ($btgh - $bbwh)),2);
                $itr++;
            } elseif($biaya[$i] >= $btgh) {
                $hasil_fuzzifikasi[$i][$itr] = 0;
                $itr++;
            }

            if($biaya[$i] <= $bbwh || $biaya[$i] >= $bats){
                $hasil_fuzzifikasi[$i][$itr] = 0;
                $itr++;
            } elseif($bbwh <= $biaya[$i] && $biaya[$i] < $btgh) {
                $hasil_fuzzifikasi[$i][$itr] = round((($biaya[$i] - $bbwh) / ($btgh - $bbwh)),2);
                $itr++;
            } elseif($biaya[$i] >= $btgh && $biaya[$i] < $bats ) {
                $hasil_fuzzifikasi[$i][$itr] = round((($bats - $biaya[$i]) / ($bats - $btgh)),2);
                $itr++;
            }

            if($biaya[$i] <= $btgh){
                $hasil_fuzzifikasi[$i][$itr] = 0;
                $itr++;
            } elseif($btgh <= $biaya[$i] && $biaya[$i] < $bats) {
                $hasil_fuzzifikasi[$i][$itr] = round((($biaya[$i] - $btgh) / ($bats - $btgh)),2);
                $itr++;
            } elseif($biaya[$i] >= $bats) {
                $hasil_fuzzifikasi[$i][$itr] = 1;
                $itr++;
            }

            // ======================= BENCANA =======================

            if($bencana[$i]['bencana'] <= $btsbnc[0]['bawah']){
                $hasil_fuzzifikasi[$i][$itr] = 1;
                $itr++;
            } elseif($btsbnc[0]['bawah'] <= $bencana[$i]['bencana'] && $bencana[$i]['bencana'] < $btsbnc[0]['tengah']) {
                $hasil_fuzzifikasi[$i][$itr] = round((($btsbnc[0]['tengah'] - $bencana[$i]['bencana']) / ($btsbnc[0]['tengah'] - $btsbnc[0]['bawah'])),2);
                $itr++;
            } elseif($bencana[$i]['bencana'] >= $btsbnc[0]['tengah']) {
                $hasil_fuzzifikasi[$i][$itr] = 0;
                $itr++;
            }

            if($bencana[$i]['bencana'] <= $btsbnc[0]['bawah'] || $bencana[$i]['bencana'] >= $btsbnc[0]['atas']){
                $hasil_fuzzifikasi[$i][$itr] = 0;
                $itr++;
            } elseif($btsbnc[0]['bawah'] <= $bencana[$i]['bencana'] && $bencana[$i]['bencana'] < $btsbnc[0]['tengah']) {
                $hasil_fuzzifikasi[$i][$itr] = round((($bencana[$i]['bencana'] - $btsbnc[0]['bawah']) / ($btsbnc[0]['tengah'] - $btsbnc[0]['bawah'])),2);
                $itr++;
            } elseif($bencana[$i]['bencana'] >= $btsbnc[0]['tengah'] && $bencana[$i]['bencana'] < $btsbnc[0]['atas'] ) {
                $hasil_fuzzifikasi[$i][$itr] = round((($btsbnc[0]['atas'] - $bencana[$i]['bencana']) / ($btsbnc[0]['atas'] - $btsbnc[0]['tengah'])),2);
                $itr++;
            }

            if($bencana[$i]['bencana'] <= $btsbnc[0]['tengah']){
                $hasil_fuzzifikasi[$i][$itr] = 0;
                $itr++;
            } elseif($btsbnc[0]['tengah'] <= $bencana[$i]['bencana'] && $bencana[$i]['bencana'] < $btsbnc[0]['atas']) {
                $hasil_fuzzifikasi[$i][$itr] = round((($bencana[$i]['bencana'] - $btsbnc[0]['tengah']) / ($btsbnc[0]['atas'] - $btsbnc[0]['tengah'])),2);
                $itr++;
            } elseif($bencana[$i]['bencana'] >= $btsbnc[0]['atas']) {
                $hasil_fuzzifikasi[$i][$itr] = 1;
                $itr++;
            }

            // ======================= SKOR SENTIMEN =======================

            if($skor[$i]['finalSkor'] <= $btsskor[0]['bawah']){
                $hasil_fuzzifikasi[$i][$itr] = 1;
                $itr++;
            } elseif($btsskor[0]['bawah'] <= $skor[$i]['finalSkor'] && $skor[$i]['finalSkor'] < $btsskor[0]['tengah']) {
                $hasil_fuzzifikasi[$i][$itr] = round((($btsskor[0]['tengah'] - $skor[$i]['finalSkor']) / ($btsskor[0]['tengah'] - $btsskor[0]['bawah'])),2);
                $itr++;
            } elseif($skor[$i]['finalSkor'] >= $btsskor[0]['tengah']) {
                $hasil_fuzzifikasi[$i][$itr] = 0;
                $itr++;
            }

            if($skor[$i]['finalSkor'] <= $btsskor[0]['bawah'] || $skor[$i]['finalSkor'] >= $btsskor[0]['atas']){
                $hasil_fuzzifikasi[$i][$itr] = 0;
                $itr++;
            } elseif($btsskor[0]['bawah'] <= $skor[$i]['finalSkor'] && $skor[$i]['finalSkor'] < $btsskor[0]['tengah']) {
                $hasil_fuzzifikasi[$i][$itr] = round((($skor[$i]['finalSkor'] - $btsskor[0]['bawah']) / ($btsskor[0]['tengah'] - $btsskor[0]['bawah'])),2);
                $itr++;
            } elseif($skor[$i]['finalSkor'] >= $btsskor[0]['tengah'] && $skor[$i]['finalSkor'] < $btsskor[0]['atas'] ) {
                $hasil_fuzzifikasi[$i][$itr] = round((($btsskor[0]['atas'] - $skor[$i]['finalSkor']) / ($btsskor[0]['atas'] - $btsskor[0]['tengah'])),2);
                $itr++;
            }

            if($skor[$i]['finalSkor'] <= $btsskor[0]['tengah']){
                $hasil_fuzzifikasi[$i][$itr] = 0;
                $itr++;
            } elseif($btsskor[0]['tengah'] <= $skor[$i]['finalSkor'] && $skor[$i]['finalSkor'] < $btsskor[0]['atas']) {
                $hasil_fuzzifikasi[$i][$itr] = round((($skor[$i]['finalSkor'] - $btsskor[0]['tengah']) / ($btsskor[0]['atas'] - $btsskor[0]['tengah'])),2);
                $itr++;
            } elseif($skor[$i]['finalSkor'] >= $btsskor[0]['atas']) {
                $hasil_fuzzifikasi[$i][$itr] = 1;
                $itr++;
            }

        } //echo "Derajat Keanggotaan ==> <br>"; print_r($hasil_fuzzifikasi); //print_r($jarak); print_r($biaya);

        // ========================================== CARI MAX ========================

        $cariMax = array();
        $hasilMax = array();
        for($i=0; $i < sizeof($jarak); $i++) {
            // ===================== MAX JARAK ====================
            if($hasil_fuzzifikasi[$i][0] >= $hasil_fuzzifikasi[$i][1] && $hasil_fuzzifikasi[$i][0] >= $hasil_fuzzifikasi[$i][2]) {
                $cariMax[$i][0] = 0;//$hasil_fuzzifikasi[$i][$j][0];
                $hasilMax[$i][0] = $hasil_fuzzifikasi[$i][0];
            } else if ($hasil_fuzzifikasi[$i][1] >= $hasil_fuzzifikasi[$i][0] && $hasil_fuzzifikasi[$i][1] >= $hasil_fuzzifikasi[$i][2]) {
                $cariMax[$i][0] = 1;//$hasil_fuzzifikasi[$i][$j][1];
                $hasilMax[$i][0] = $hasil_fuzzifikasi[$i][1];
            } else if ($hasil_fuzzifikasi[$i][2] >= $hasil_fuzzifikasi[$i][0] && $hasil_fuzzifikasi[$i][2] >= $hasil_fuzzifikasi[$i][1]) {
                $cariMax[$i][0] = 2;//$hasil_fuzzifikasi[$i][$j][2];
                $hasilMax[$i][0] = $hasil_fuzzifikasi[$i][2];
            }

            // ==================== MAX BIAYA =====================
            if($hasil_fuzzifikasi[$i][3] >= $hasil_fuzzifikasi[$i][4] && $hasil_fuzzifikasi[$i][3] >= $hasil_fuzzifikasi[$i][5]) {
                $cariMax[$i][1] = 0;//$hasil_fuzzifikasi[$i][$j][0];
                $hasilMax[$i][1] = $hasil_fuzzifikasi[$i][3];
            } else if ($hasil_fuzzifikasi[$i][4] >= $hasil_fuzzifikasi[$i][3] && $hasil_fuzzifikasi[$i][4] >= $hasil_fuzzifikasi[$i][5]) {
                $cariMax[$i][1] = 1;//$hasil_fuzzifikasi[$i][$j][1];
                $hasilMax[$i][1] = $hasil_fuzzifikasi[$i][4];
            } else if ($hasil_fuzzifikasi[$i][5] >= $hasil_fuzzifikasi[$i][3] && $hasil_fuzzifikasi[$i][5] >= $hasil_fuzzifikasi[$i][4]) {
                $cariMax[$i][1] = 2;//$hasil_fuzzifikasi[$i][$j][2];
                $hasilMax[$i][1] = $hasil_fuzzifikasi[$i][5];
            }

            // ==================== MAX BENCANA =====================
            if($hasil_fuzzifikasi[$i][6] >= $hasil_fuzzifikasi[$i][7] && $hasil_fuzzifikasi[$i][6] >= $hasil_fuzzifikasi[$i][8]) {
                $cariMax[$i][2] = 0;//$hasil_fuzzifikasi[$i][$j][0];
                $hasilMax[$i][2] = $hasil_fuzzifikasi[$i][6];
            } else if ($hasil_fuzzifikasi[$i][7] >= $hasil_fuzzifikasi[$i][6] && $hasil_fuzzifikasi[$i][7] >= $hasil_fuzzifikasi[$i][8]) {
                $cariMax[$i][2] = 1;//$hasil_fuzzifikasi[$i][$j][1];
                $hasilMax[$i][2] = $hasil_fuzzifikasi[$i][7];
            } else if ($hasil_fuzzifikasi[$i][8] >= $hasil_fuzzifikasi[$i][6] && $hasil_fuzzifikasi[$i][8] >= $hasil_fuzzifikasi[$i][7]) {
                $cariMax[$i][2] = 2;//$hasil_fuzzifikasi[$i][$j][2];
                $hasilMax[$i][2] = $hasil_fuzzifikasi[$i][8];
            }

            // ==================== MAX SKOR SENTIMEN =====================
            if($hasil_fuzzifikasi[$i][9] >= $hasil_fuzzifikasi[$i][10] && $hasil_fuzzifikasi[$i][9] >= $hasil_fuzzifikasi[$i][11]) {
                $cariMax[$i][3] = 0;//$hasil_fuzzifikasi[$i][$j][0];
                $hasilMax[$i][3] = $hasil_fuzzifikasi[$i][9];
            } else if ($hasil_fuzzifikasi[$i][10] >= $hasil_fuzzifikasi[$i][9] && $hasil_fuzzifikasi[$i][10] >= $hasil_fuzzifikasi[$i][11]) {
                $cariMax[$i][3] = 1;//$hasil_fuzzifikasi[$i][$j][1];
                $hasilMax[$i][3] = $hasil_fuzzifikasi[$i][10];
            } else if ($hasil_fuzzifikasi[$i][11] >= $hasil_fuzzifikasi[$i][9] && $hasil_fuzzifikasi[$i][11] >= $hasil_fuzzifikasi[$i][10]) {
                $cariMax[$i][3] = 2;//$hasil_fuzzifikasi[$i][$j][2];
                $hasilMax[$i][3] = $hasil_fuzzifikasi[$i][11];
            }
        } //echo "<br>Hasil Max ==> <br>"; print_r($hasilMax);

        // ==================================== CARI NILAI MIN ================================
        $hasilMin = array();
        for($i=0; $i < sizeof($jarak); $i++) { // Looping Objek
            if ($hasilMax[$i][0] <= $hasilMax[$i][1] && $hasilMax[$i][0] <= $hasilMax[$i][2] && $hasilMax[$i][0] <= $hasilMax[$i][3] ) {
                $hasilMin[$i] = $hasilMax[$i][0];
            } else if ($hasilMax[$i][1] <= $hasilMax[$i][0] && $hasilMax[$i][1] <= $hasilMax[$i][2] && $hasilMax[$i][1] <= $hasilMax[$i][3]) {
                $hasilMin[$i] = $hasilMax[$i][1];
            } else if ($hasilMax[$i][2] <= $hasilMax[$i][1] && $hasilMax[$i][2] <= $hasilMax[$i][0] && $hasilMax[$i][2] <= $hasilMax[$i][3]) {
                $hasilMin[$i] = $hasilMax[$i][2];
            } else if ($hasilMax[$i][3] <= $hasilMax[$i][0] && $hasilMax[$i][3] <= $hasilMax[$i][1] && $hasilMax[$i][3] <= $hasilMax[$i][2]) {
                $hasilMin[$i] = $hasilMax[$i][3];
            }
        } //echo "<br>Hasil Min ==> <br>"; print_r($hasilMin);

        $labelfuz = array();
        $choosen = array();
        $cek = 0;
        for($i=0; $i < sizeof($jarak); $i++) { // Looping Objek
            if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 0 && $cariMax[$i][3] == 2) {
                $labelfuz[$i] = "Sangat Direkomendasi";
            } else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 1 && $cariMax[$i][3] == 2) {
                $labelfuz[$i] = "Sangat Direkomendasi";
            } else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 2 && $cariMax[$i][3] == 2) {
                $labelfuz[$i] = "Sangat Direkomendasi";
            } else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 0 && $cariMax[$i][3] == 2) {
                $labelfuz[$i] = "Sangat Direkomendasi";
            } else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 1 && $cariMax[$i][3] == 2) {
                $labelfuz[$i] = "Sangat Direkomendasi";
            } else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 2 && $cariMax[$i][3] == 2) {
                $labelfuz[$i] = "Sangat Direkomendasi";
            } else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 0 && $cariMax[$i][3] == 2) {
                $labelfuz[$i] = "Direkomendasi";
            } else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 1 && $cariMax[$i][3] == 2) {
                $labelfuz[$i] = "Direkomendasi";
            } else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 2 && $cariMax[$i][3] == 2) {
                $labelfuz[$i] = "Direkomendasi";
            } else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 0 && $cariMax[$i][3] == 2) {
                $labelfuz[$i] = "Sangat Direkomendasi";
            } else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 1 && $cariMax[$i][3] == 2) {
                $labelfuz[$i] = "Sangat Direkomendasi";
            } else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 2 && $cariMax[$i][3] == 2) {
                $labelfuz[$i] = "Sangat Direkomendasi";
            } else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 0 && $cariMax[$i][3] == 2) {
                $labelfuz[$i] = "Direkomendasi";
            } else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 1 && $cariMax[$i][3] == 2) {
                $labelfuz[$i] = "Direkomendasi";
            } else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 2 && $cariMax[$i][3] == 2) {
                $labelfuz[$i] = "Direkomendasi";
            } else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 0 && $cariMax[$i][3] == 2) {
                $labelfuz[$i] = "Direkomendasi";
            } else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 1 && $cariMax[$i][3] == 2) {
                $labelfuz[$i] = "Tidak Direkomendasi";
            } else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 2 && $cariMax[$i][3] == 2) {
                $labelfuz[$i] = "Tidak Direkomendasi";
            } else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 0 && $cariMax[$i][3] == 2) {
                $labelfuz[$i] = "Direkomendasi";
            } else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 1 && $cariMax[$i][3] == 2) {
                $labelfuz[$i] = "Direkomendasi";
            } else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 2 && $cariMax[$i][3] == 2) {
                $labelfuz[$i] = "Direkomendasi";
            } else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 0 && $cariMax[$i][3] == 2) {
                $labelfuz[$i] = "Direkomendasi";
            } else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 1 && $cariMax[$i][3] == 2) {
                $labelfuz[$i] = "Direkomendasi";
            } else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 2 && $cariMax[$i][3] == 2) {
                $labelfuz[$i] = "Tidak Direkomendasi";
            } else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 0 && $cariMax[$i][3] == 2) {
                $labelfuz[$i] = "Tidak Direkomendasi";
            } else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 1 && $cariMax[$i][3] == 2) {
                $labelfuz[$i] = "Tidak Direkomendasi";
            } else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 2 && $cariMax[$i][3] == 2) {
                $labelfuz[$i] = "Tidak Direkomendasi";
            }

            else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 0 && $cariMax[$i][3] == 1) {
                $labelfuz[$i] = "Sangat Direkomendasi";
            } else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 1 && $cariMax[$i][3] == 1) {
                $labelfuz[$i] = "Sangat Direkomendasi";
            } else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 2 && $cariMax[$i][3] == 1) {
                $labelfuz[$i] = "Sangat Direkomendasi";
            } else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 0 && $cariMax[$i][3] == 1) {
                $labelfuz[$i] = "Sangat Direkomendasi";
            } else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 1 && $cariMax[$i][3] == 1) {
                $labelfuz[$i] = "Sangat Direkomendasi";
            } else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 2 && $cariMax[$i][3] == 1) {
                $labelfuz[$i] = "Sangat Direkomendasi";
            } else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 0 && $cariMax[$i][3] == 1) {
                $labelfuz[$i] = "Sangat Direkomendasi";
            } else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 1 && $cariMax[$i][3] == 1) {
                $labelfuz[$i] = "Sangat Direkomendasi";
            } else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 2 && $cariMax[$i][3] == 1) {
                $labelfuz[$i] = "Direkomendasi";
            } else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 0 && $cariMax[$i][3] == 1) {
                $labelfuz[$i] = "Direkomendasi";
            } else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 1 && $cariMax[$i][3] == 1) {
                $labelfuz[$i] = "Direkomendasi";
            } else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 2 && $cariMax[$i][3] == 1) {
                $labelfuz[$i] = "Direkomendasi";
            } else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 0 && $cariMax[$i][3] == 1) {
                $labelfuz[$i] = "Direkomendasi";
            } else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 1 && $cariMax[$i][3] == 1) {
                $labelfuz[$i] = "Direkomendasi";
            } else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 2 && $cariMax[$i][3] == 1) {
                $labelfuz[$i] = "Direkomendasi";
            } else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 0 && $cariMax[$i][3] == 1) {
                $labelfuz[$i] = "Direkomendasi";
            } else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 1 && $cariMax[$i][3] == 1) {
                $labelfuz[$i] = "Direkomendasi";
            } else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 2 && $cariMax[$i][3] == 1) {
                $labelfuz[$i] = "Tidak Direkomendasi";
            } else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 0 && $cariMax[$i][3] == 1) {
                $labelfuz[$i] = "Direkomendasi";
            } else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 1 && $cariMax[$i][3] == 1) {
                $labelfuz[$i] = "Direkomendasi";
            } else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 2 && $cariMax[$i][3] == 1) {
                $labelfuz[$i] = "Direkomendasi";
            } else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 0 && $cariMax[$i][3] == 1) {
                $labelfuz[$i] = "Direkomendasi";
            } else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 1 && $cariMax[$i][3] == 1) {
                $labelfuz[$i] = "Direkomendasi";
            } else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 2 && $cariMax[$i][3] == 1) {
                $labelfuz[$i] = "Tidak Direkomendasi";
            } else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 0 && $cariMax[$i][3] == 1) {
                $labelfuz[$i] = "Tidak Direkomendasi";
            } else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 1 && $cariMax[$i][3] == 1) {
                $labelfuz[$i] = "Tidak Direkomendasi";
            } else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 2 && $cariMax[$i][3] == 1) {
                $labelfuz[$i] = "Tidak Direkomendasi";
            }

            else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 0 && $cariMax[$i][3] == 0) {
                $labelfuz[$i] = "Direkomendasi";
            } else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 1 && $cariMax[$i][3] == 0) {
                $labelfuz[$i] = "Direkomendasi";
            } else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 2 && $cariMax[$i][3] == 0) {
                $labelfuz[$i] = "Direkomendasi";
            } else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 0 && $cariMax[$i][3] == 0) {
                $labelfuz[$i] = "Direkomendasi";
            } else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 1 && $cariMax[$i][3] == 0) {
                $labelfuz[$i] = "Direkomendasi";
            } else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 2 && $cariMax[$i][3] == 0) {
                $labelfuz[$i] = "Direkomendasi";
            } else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 0 && $cariMax[$i][3] == 0) {
                $labelfuz[$i] = "Tidak Direkomendasi";
            } else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 1 && $cariMax[$i][3] == 0) {
                $labelfuz[$i] = "Tidak Direkomendasi";
            } else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 2 && $cariMax[$i][3] == 0) {
                $labelfuz[$i] = "Tidak Direkomendasi";
            } else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 0 && $cariMax[$i][3] == 0) {
                $labelfuz[$i] = "Direkomendasi";
            } else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 1 && $cariMax[$i][3] == 0) {
                $labelfuz[$i] = "Direkomendasi";
            } else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 2 && $cariMax[$i][3] == 0) {
                $labelfuz[$i] = "Direkomendasi";
            } else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 0 && $cariMax[$i][3] == 0) {
                $labelfuz[$i] = "Tidak Direkomendasi";
            } else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 1 && $cariMax[$i][3] == 0) {
                $labelfuz[$i] = "Tidak Direkomendasi";
            } else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 2 && $cariMax[$i][3] == 0) {
                $labelfuz[$i] = "Tidak Direkomendasi";
            } else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 0 && $cariMax[$i][3] == 0) {
                $labelfuz[$i] = "Tidak Direkomendasi";
            } else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 1 && $cariMax[$i][3] == 0) {
                $labelfuz[$i] = "Tidak Direkomendasi";
            } else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 2 && $cariMax[$i][3] == 0) {
                $labelfuz[$i] = "Tidak Direkomendasi";
            } else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 0 && $cariMax[$i][3] == 0) {
                $labelfuz[$i] = "Tidak Direkomendasi";
            } else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 1 && $cariMax[$i][3] == 0) {
                $labelfuz[$i] = "Tidak Direkomendasi";
            } else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 2 && $cariMax[$i][3] == 0) {
                $labelfuz[$i] = "Tidak Direkomendasi";
            } else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 0 && $cariMax[$i][3] == 0) {
                $labelfuz[$i] = "Tidak Direkomendasi";
            } else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 1 && $cariMax[$i][3] == 0) {
                $labelfuz[$i] = "Tidak Direkomendasi";
            } else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 2 && $cariMax[$i][3] == 0) {
                $labelfuz[$i] = "Tidak Direkomendasi";
            } else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 0 && $cariMax[$i][3] == 0) {
                $labelfuz[$i] = "Tidak Direkomendasi";
            } else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 1 && $cariMax[$i][3] == 0) {
                $labelfuz[$i] = "Tidak Direkomendasi";
            } else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 2 && $cariMax[$i][3] == 0) {
                $labelfuz[$i] = "Tidak Direkomendasi";
            }

            if ($labelfuz[$i] == "Sangat Direkomendasi") {
                $choosen[$cek] = $i;
                $cek++;
            }
        } //print_r($labelfuz); print_r($choosen); print_r(sizeof($choosen)); print_r(sizeof($hasilMin));

        $res = array();

        for ($i=0; $i < sizeof($choosen); $i++) { 
            $res[$i] = $datnamkor[$choosen[$i]];
            $res[$i]['hasilMin'] = $hasilMin[$choosen[$i]];
        }
        // $res = array();
        //echo "<br>Hasil Rekomendasi Sentimen sebagai atribut Fuzzy ==> <br>"; print_r($res);
        if (sizeof($res) == 0) {
            echo "<h4 class='list-group-item'>Mohon Maaf, Kami Tidak Dapat Menemukan Rekomendasi Objek Wisata Dari Kriteria Yang Anda Inputkan</h4>";
        } else {
            usort($res, function($a,$b){
                return ($a['hasilMin'] > $b['hasilMin']) ? -1 : 1;
            });
            for($i=0 ; $i < 15 ; $i++){
                echo " <a href='javascript:void(0)' class='item list-group-item' data-long ='".$res[$i]['longitude']."' data-lat='".$res[$i]['latitude']."'>
                             <h4 class='list-group-item'>".$res[$i]['nama_objek']."</h4>
                             ".Html::a('Details',['places/details','id' => $res[$i]['id_objek']],['target' => '_blank', 'style'=>'float:right', 'class'=>'btn btn-primary btn-flat'])."
                             <a style='color: black;'>Skor Fuzzy : ".$res[$i]['hasilMin']."</a><br>
                             <a style='color: black;'>Skor Sentimen : ".$res[$i]['finalSkor']."</a>
                     </a>";
            }
        }
    }

    public function actionUji()
    {
        $kalimat = '';
        $kategori = '';
        $nilai = '';

        $this->layout = "main";
        // $sentimen = new Sentimen();
        if (Yii::$app->request->post()) {
            $strings = array(
                1 => Yii::$app->request->post('xxx'),
            );

            $i=1;
            foreach ($strings as $string) {
                // calculations:
                $scores = Yii::$app->sentimen->score($string);
                $class = Yii::$app->sentimen->categorise($string);

                // output:
                if (in_array("pos", $scores)) {
                    echo "Got positif";
                }

                // echo "\n\nHasil:";
                // echo "\nKalimat: <b>$string</b>\n";
                // echo "Arah sentimen: <b>$class</b>, nilai: ";
                // var_dump($scores);
                if ($class == 'positif') {
                    $skor = 1;
                } else if ($class == 'negatif') {
                    $skor = -1;
                } else {
                    $skor = 0;
                }

                $kalimat = $string;
                $kategori = $class;
                $nilai = $skor;
                //echo $skor;
                //echo "\n\n";
                $i++;
            }

        }
        return $this->render('ujisentimen', ['kalimat' => $kalimat,
                                             'kategori'=> $kategori,
                                             'nilai' => $nilai]);
    }

}
