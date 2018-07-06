<?php
	extract($_POST);

    include 'connect.php';
    $bencana = array();
    $htm = array();
    $biaya = array();
    $btsbnc = array();
    $hasil_fuzzifikasi = array();
    
    $data = mysql_query("select bencana from data_objek") or die (mysql_error());
    $htm2 = mysql_query("select biaya from data_objek") or die (mysql_error());
    $sentimen = mysql_query("select finalSkor from skor_sentimen") or die (mysql_error());
    $bts = mysql_query("select bawah, tengah, atas from batas_atribut where atribut='bencana'") or die (mysql_error());
    $btssen = mysql_query("select bawah, tengah, atas from batas_atribut where atribut='skor'") or die (mysql_error());

    while($row = mysql_fetch_array($data)) {
		$bencana[] = $row;
	} //print_r($bencana);
	while($raw = mysql_fetch_array($htm2)) {
		$htm[] = $raw;
	} //print_r($htm);
	while($rew = mysql_fetch_array($sentimen)) {
		$skor[] = $rew;
	} //print_r($skor);
	while($riw = mysql_fetch_array($bts)) {
		$btsbnc[] = $riw;
	} //print_r($btsbnc);
	while($ruw = mysql_fetch_array($btssen)) {
		$btsskor[] = $ruw;
	} //print_r($btsskor);

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

		if($skor[$i]['finalSkor'] <= $btssen[0]['bawah']){
			$hasil_fuzzifikasi[$i][$itr] = 1;
			$itr++;
		} elseif($btssen[0]['bawah'] <= $skor[$i]['finalSkor'] && $skor[$i]['finalSkor'] < $btssen[0]['tengah']) {
			$hasil_fuzzifikasi[$i][$itr] = round((($btssen[0]['tengah'] - $skor[$i]['finalSkor']) / ($btssen[0]['tengah'] - $btssen[0]['bawah'])),2);
			$itr++;
		} elseif($skor[$i]['finalSkor'] >= $btssen[0]['tengah']) {
			$hasil_fuzzifikasi[$i][$itr] = 0;
			$itr++;
		}

		if($skor[$i]['finalSkor'] <= $btssen[0]['bawah'] || $skor[$i]['finalSkor'] >= $btssen[0]['atas']){
			$hasil_fuzzifikasi[$i][$itr] = 0;
			$itr++;
		} elseif($btssen[0]['bawah'] <= $skor[$i]['finalSkor'] && $skor[$i]['finalSkor'] < $btssen[0]['tengah']) {
			$hasil_fuzzifikasi[$i][$itr] = round((($skor[$i]['finalSkor'] - $btssen[0]['bawah']) / ($btssen[0]['tengah'] - $btssen[0]['bawah'])),2);
			$itr++;
		} elseif($skor[$i]['finalSkor'] >= $btssen[0]['tengah'] && $skor[$i]['finalSkor'] < $btssen[0]['atas'] ) {
			$hasil_fuzzifikasi[$i][$itr] = round((($btssen[0]['atas'] - $skor[$i]['finalSkor']) / ($btssen[0]['atas'] - $btssen[0]['tengah'])),2);
			$itr++;
		}

		if($skor[$i]['finalSkor'] <= $btssen[0]['tengah']){
			$hasil_fuzzifikasi[$i][$itr] = 0;
			$itr++;
		} elseif($btssen[0]['tengah'] <= $skor[$i]['finalSkor'] && $skor[$i]['finalSkor'] < $btssen[0]['atas']) {
			$hasil_fuzzifikasi[$i][$itr] = round((($skor[$i]['finalSkor'] - $btssen[0]['tengah']) / ($btssen[0]['atas'] - $btssen[0]['tengah'])),2);
			$itr++;
		} elseif($skor[$i]['finalSkor'] >= $btssen[0]['atas']) {
			$hasil_fuzzifikasi[$i][$itr] = 1;
			$itr++;
		}

	} //print_r($hasil_fuzzifikasi);//print_r($jarak); print_r($biaya);

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
	} //print_r($cariMax); print_r($hasilMax);

	// ==================================== CARI NILAI MIN ================================
	$hasilMin3 = array();
	for($i=0; $i < sizeof($jarak); $i++) { // Looping Objek
		if ($hasilMax[$i][0] <= $hasilMax[$i][1] && $hasilMax[$i][0] <= $hasilMax[$i][2]) {
			$hasilMin3[$i] = $hasilMax[$i][0];
		} else if ($hasilMax[$i][1] <= $hasilMax[$i][0] && $hasilMax[$i][1] <= $hasilMax[$i][2]) {
			$hasilMin3[$i] = $hasilMax[$i][1];
		} else if ($hasilMax[$i][2] <= $hasilMax[$i][1] && $hasilMax[$i][2] <= $hasilMax[$i][0]) {
			$hasilMin3[$i] = $hasilMax[$i][2];
		} 
	} //print_r($hasilMin3);

	$hasilMin4 = array();
	for($i=0; $i < sizeof($jarak); $i++) { // Looping Objek
		if ($hasilMax[$i][0] <= $hasilMax[$i][1] && $hasilMax[$i][0] <= $hasilMax[$i][2] && $hasilMax[$i][0] <= $hasilMax[$i][3]) {
			$hasilMin4[$i] = $hasilMax[$i][0];
		} else if ($hasilMax[$i][1] <= $hasilMax[$i][0] && $hasilMax[$i][1] <= $hasilMax[$i][2] && $hasilMax[$i][1] <= $hasilMax[$i][3]) {
			$hasilMin4[$i] = $hasilMax[$i][1];
		} else if ($hasilMax[$i][2] <= $hasilMax[$i][1] && $hasilMax[$i][2] <= $hasilMax[$i][0] && $hasilMax[$i][2] <= $hasilMax[$i][3]) {
			$hasilMin4[$i] = $hasilMax[$i][2];
		} else if ($hasilMax[$i][3] <= $hasilMax[$i][0] && $hasilMax[$i][3] <= $hasilMax[$i][1] && $hasilMax[$i][3] <= $hasilMax[$i][2]) {
			$hasilMin4[$i] = $hasilMax[$i][3];
		}
	} //print_r($hasilMin3);
	

	$labelfuz = array();
	$choosen = array();
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
			$choosen[$cek] = $i;
			$cek++;
		}
	} //print_r($labelfuz); echo "<br>Id Objek Terpilih<br>"; print_r($choosen); echo "<br>"; print_r(sizeof($choosen)); echo "<br>"; //print_r(sizeof($hasilMin));

	$labelfuz3 = array();
	$choosen3 = array();
	$cek3 = 0;
	for($i=0; $i < sizeof($choosen); $i++) { // Looping Objek
		if ($cariMax[$choosen[$i]][0] == 0 && $cariMax[$choosen[$i]][1] == 0 && $cariMax[$choosen[$i]][2] == 0 && $cariMax[$choosen[$i]][3] == 2) {
			$labelfuz3[$i] = "Sangat Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 0 && $cariMax[$choosen[$i]][1] == 0 && $cariMax[$choosen[$i]][2] == 1 && $cariMax[$choosen[$i]][3] == 2) {
			$labelfuz3[$i] = "Sangat Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 0 && $cariMax[$choosen[$i]][1] == 0 && $cariMax[$choosen[$i]][2] == 2 && $cariMax[$choosen[$i]][3] == 2) {
			$labelfuz3[$i] = "Sangat Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 0 && $cariMax[$choosen[$i]][1] == 1 && $cariMax[$choosen[$i]][2] == 0 && $cariMax[$choosen[$i]][3] == 2) {
			$labelfuz3[$i] = "Sangat Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 0 && $cariMax[$choosen[$i]][1] == 1 && $cariMax[$choosen[$i]][2] == 1 && $cariMax[$choosen[$i]][3] == 2) {
			$labelfuz3[$i] = "Sangat Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 0 && $cariMax[$choosen[$i]][1] == 1 && $cariMax[$choosen[$i]][2] == 2 && $cariMax[$choosen[$i]][3] == 2) {
			$labelfuz3[$i] = "Sangat Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 0 && $cariMax[$choosen[$i]][1] == 2 && $cariMax[$choosen[$i]][2] == 0 && $cariMax[$choosen[$i]][3] == 2) {
			$labelfuz3[$i] = "Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 0 && $cariMax[$choosen[$i]][1] == 2 && $cariMax[$choosen[$i]][2] == 1 && $cariMax[$choosen[$i]][3] == 2) {
			$labelfuz3[$i] = "Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 0 && $cariMax[$choosen[$i]][1] == 2 && $cariMax[$choosen[$i]][2] == 2 && $cariMax[$choosen[$i]][3] == 2) {
			$labelfuz3[$i] = "Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 1 && $cariMax[$choosen[$i]][1] == 0 && $cariMax[$choosen[$i]][2] == 0 && $cariMax[$choosen[$i]][3] == 2) {
			$labelfuz3[$i] = "Sangat Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 1 && $cariMax[$choosen[$i]][1] == 0 && $cariMax[$choosen[$i]][2] == 1 && $cariMax[$choosen[$i]][3] == 2) {
			$labelfuz3[$i] = "Sangat Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 1 && $cariMax[$choosen[$i]][1] == 0 && $cariMax[$choosen[$i]][2] == 2 && $cariMax[$choosen[$i]][3] == 2) {
			$labelfuz3[$i] = "Sangat Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 1 && $cariMax[$choosen[$i]][1] == 1 && $cariMax[$choosen[$i]][2] == 0 && $cariMax[$choosen[$i]][3] == 2) {
			$labelfuz3[$i] = "Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 1 && $cariMax[$choosen[$i]][1] == 1 && $cariMax[$choosen[$i]][2] == 1 && $cariMax[$choosen[$i]][3] == 2) {
			$labelfuz3[$i] = "Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 1 && $cariMax[$choosen[$i]][1] == 1 && $cariMax[$choosen[$i]][2] == 2 && $cariMax[$choosen[$i]][3] == 2) {
			$labelfuz3[$i] = "Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 1 && $cariMax[$choosen[$i]][1] == 2 && $cariMax[$choosen[$i]][2] == 0 && $cariMax[$choosen[$i]][3] == 2) {
			$labelfuz3[$i] = "Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 1 && $cariMax[$choosen[$i]][1] == 2 && $cariMax[$choosen[$i]][2] == 1 && $cariMax[$choosen[$i]][3] == 2) {
			$labelfuz3[$i] = "Tidak Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 1 && $cariMax[$choosen[$i]][1] == 2 && $cariMax[$choosen[$i]][2] == 2 && $cariMax[$choosen[$i]][3] == 2) {
			$labelfuz3[$i] = "Tidak Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 2 && $cariMax[$choosen[$i]][1] == 0 && $cariMax[$choosen[$i]][2] == 0 && $cariMax[$choosen[$i]][3] == 2) {
			$labelfuz3[$i] = "Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 2 && $cariMax[$choosen[$i]][1] == 0 && $cariMax[$choosen[$i]][2] == 1 && $cariMax[$choosen[$i]][3] == 2) {
			$labelfuz3[$i] = "Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 2 && $cariMax[$choosen[$i]][1] == 0 && $cariMax[$choosen[$i]][2] == 2 && $cariMax[$choosen[$i]][3] == 2) {
			$labelfuz3[$i] = "Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 2 && $cariMax[$choosen[$i]][1] == 1 && $cariMax[$choosen[$i]][2] == 0 && $cariMax[$choosen[$i]][3] == 2) {
			$labelfuz3[$i] = "Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 2 && $cariMax[$choosen[$i]][1] == 1 && $cariMax[$choosen[$i]][2] == 1 && $cariMax[$choosen[$i]][3] == 2) {
			$labelfuz3[$i] = "Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 2 && $cariMax[$choosen[$i]][1] == 1 && $cariMax[$choosen[$i]][2] == 2 && $cariMax[$choosen[$i]][3] == 2) {
			$labelfuz3[$i] = "Tidak Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 2 && $cariMax[$choosen[$i]][1] == 2 && $cariMax[$choosen[$i]][2] == 0 && $cariMax[$choosen[$i]][3] == 2) {
			$labelfuz3[$i] = "Tidak Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 2 && $cariMax[$choosen[$i]][1] == 2 && $cariMax[$choosen[$i]][2] == 1 && $cariMax[$choosen[$i]][3] == 2) {
			$labelfuz3[$i] = "Tidak Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 2 && $cariMax[$choosen[$i]][1] == 2 && $cariMax[$choosen[$i]][2] == 2 && $cariMax[$choosen[$i]][3] == 2) {
			$labelfuz3[$i] = "Tidak Direkomendasi";
		}

		else if ($cariMax[$choosen[$i]][0] == 0 && $cariMax[$choosen[$i]][1] == 0 && $cariMax[$choosen[$i]][2] == 0 && $cariMax[$choosen[$i]][3] == 1) {
			$labelfuz3[$i] = "Sangat Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 0 && $cariMax[$choosen[$i]][1] == 0 && $cariMax[$choosen[$i]][2] == 1 && $cariMax[$choosen[$i]][3] == 1) {
			$labelfuz3[$i] = "Sangat Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 0 && $cariMax[$choosen[$i]][1] == 0 && $cariMax[$choosen[$i]][2] == 2 && $cariMax[$choosen[$i]][3] == 1) {
			$labelfuz3[$i] = "Sangat Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 0 && $cariMax[$choosen[$i]][1] == 1 && $cariMax[$choosen[$i]][2] == 0 && $cariMax[$choosen[$i]][3] == 1) {
			$labelfuz3[$i] = "Sangat Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 0 && $cariMax[$choosen[$i]][1] == 1 && $cariMax[$choosen[$i]][2] == 1 && $cariMax[$choosen[$i]][3] == 1) {
			$labelfuz3[$i] = "Sangat Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 0 && $cariMax[$choosen[$i]][1] == 1 && $cariMax[$choosen[$i]][2] == 2 && $cariMax[$choosen[$i]][3] == 1) {
			$labelfuz3[$i] = "Sangat Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 0 && $cariMax[$choosen[$i]][1] == 2 && $cariMax[$choosen[$i]][2] == 0 && $cariMax[$choosen[$i]][3] == 1) {
			$labelfuz3[$i] = "Sangat Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 0 && $cariMax[$choosen[$i]][1] == 2 && $cariMax[$choosen[$i]][2] == 1 && $cariMax[$choosen[$i]][3] == 1) {
			$labelfuz3[$i] = "Sangat Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 0 && $cariMax[$choosen[$i]][1] == 2 && $cariMax[$choosen[$i]][2] == 2 && $cariMax[$choosen[$i]][3] == 1) {
			$labelfuz3[$i] = "Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 1 && $cariMax[$choosen[$i]][1] == 0 && $cariMax[$choosen[$i]][2] == 0 && $cariMax[$choosen[$i]][3] == 1) {
			$labelfuz3[$i] = "Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 1 && $cariMax[$choosen[$i]][1] == 0 && $cariMax[$choosen[$i]][2] == 1 && $cariMax[$choosen[$i]][3] == 1) {
			$labelfuz3[$i] = "Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 1 && $cariMax[$choosen[$i]][1] == 0 && $cariMax[$choosen[$i]][2] == 2 && $cariMax[$choosen[$i]][3] == 1) {
			$labelfuz3[$i] = "Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 1 && $cariMax[$choosen[$i]][1] == 1 && $cariMax[$choosen[$i]][2] == 0 && $cariMax[$choosen[$i]][3] == 1) {
			$labelfuz3[$i] = "Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 1 && $cariMax[$choosen[$i]][1] == 1 && $cariMax[$choosen[$i]][2] == 1 && $cariMax[$choosen[$i]][3] == 1) {
			$labelfuz3[$i] = "Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 1 && $cariMax[$choosen[$i]][1] == 1 && $cariMax[$choosen[$i]][2] == 2 && $cariMax[$choosen[$i]][3] == 1) {
			$labelfuz3[$i] = "Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 1 && $cariMax[$choosen[$i]][1] == 2 && $cariMax[$choosen[$i]][2] == 0 && $cariMax[$choosen[$i]][3] == 1) {
			$labelfuz3[$i] = "Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 1 && $cariMax[$choosen[$i]][1] == 2 && $cariMax[$choosen[$i]][2] == 1 && $cariMax[$choosen[$i]][3] == 1) {
			$labelfuz3[$i] = "Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 1 && $cariMax[$choosen[$i]][1] == 2 && $cariMax[$choosen[$i]][2] == 2 && $cariMax[$choosen[$i]][3] == 1) {
			$labelfuz3[$i] = "Tidak Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 2 && $cariMax[$choosen[$i]][1] == 0 && $cariMax[$choosen[$i]][2] == 0 && $cariMax[$choosen[$i]][3] == 1) {
			$labelfuz3[$i] = "Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 2 && $cariMax[$choosen[$i]][1] == 0 && $cariMax[$choosen[$i]][2] == 1 && $cariMax[$choosen[$i]][3] == 1) {
			$labelfuz3[$i] = "Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 2 && $cariMax[$choosen[$i]][1] == 0 && $cariMax[$choosen[$i]][2] == 2 && $cariMax[$choosen[$i]][3] == 1) {
			$labelfuz3[$i] = "Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 2 && $cariMax[$choosen[$i]][1] == 1 && $cariMax[$choosen[$i]][2] == 0 && $cariMax[$choosen[$i]][3] == 1) {
			$labelfuz3[$i] = "Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 2 && $cariMax[$choosen[$i]][1] == 1 && $cariMax[$choosen[$i]][2] == 1 && $cariMax[$choosen[$i]][3] == 1) {
			$labelfuz3[$i] = "Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 2 && $cariMax[$choosen[$i]][1] == 1 && $cariMax[$choosen[$i]][2] == 2 && $cariMax[$choosen[$i]][3] == 1) {
			$labelfuz3[$i] = "Tidak Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 2 && $cariMax[$choosen[$i]][1] == 2 && $cariMax[$choosen[$i]][2] == 0 && $cariMax[$choosen[$i]][3] == 1) {
			$labelfuz3[$i] = "Tidak Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 2 && $cariMax[$choosen[$i]][1] == 2 && $cariMax[$choosen[$i]][2] == 1 && $cariMax[$choosen[$i]][3] == 1) {
			$labelfuz3[$i] = "Tidak Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 2 && $cariMax[$choosen[$i]][1] == 2 && $cariMax[$choosen[$i]][2] == 2 && $cariMax[$choosen[$i]][3] == 1) {
			$labelfuz3[$i] = "Tidak Direkomendasi";
		}

		else if ($cariMax[$choosen[$i]][0] == 0 && $cariMax[$choosen[$i]][1] == 0 && $cariMax[$choosen[$i]][2] == 0 && $cariMax[$choosen[$i]][3] == 0) {
			$labelfuz3[$i] = "Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 0 && $cariMax[$choosen[$i]][1] == 0 && $cariMax[$choosen[$i]][2] == 1 && $cariMax[$choosen[$i]][3] == 0) {
			$labelfuz3[$i] = "Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 0 && $cariMax[$choosen[$i]][1] == 0 && $cariMax[$choosen[$i]][2] == 2 && $cariMax[$choosen[$i]][3] == 0) {
			$labelfuz3[$i] = "Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 0 && $cariMax[$choosen[$i]][1] == 1 && $cariMax[$choosen[$i]][2] == 0 && $cariMax[$choosen[$i]][3] == 0) {
			$labelfuz3[$i] = "Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 0 && $cariMax[$choosen[$i]][1] == 1 && $cariMax[$choosen[$i]][2] == 1 && $cariMax[$choosen[$i]][3] == 0) {
			$labelfuz3[$i] = "Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 0 && $cariMax[$choosen[$i]][1] == 1 && $cariMax[$choosen[$i]][2] == 2 && $cariMax[$choosen[$i]][3] == 0) {
			$labelfuz3[$i] = "Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 0 && $cariMax[$choosen[$i]][1] == 2 && $cariMax[$choosen[$i]][2] == 0 && $cariMax[$choosen[$i]][3] == 0) {
			$labelfuz3[$i] = "Tidak Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 0 && $cariMax[$choosen[$i]][1] == 2 && $cariMax[$choosen[$i]][2] == 1 && $cariMax[$choosen[$i]][3] == 0) {
			$labelfuz3[$i] = "Tidak Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 0 && $cariMax[$choosen[$i]][1] == 2 && $cariMax[$choosen[$i]][2] == 2 && $cariMax[$choosen[$i]][3] == 0) {
			$labelfuz3[$i] = "Tidak Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 1 && $cariMax[$choosen[$i]][1] == 0 && $cariMax[$choosen[$i]][2] == 0 && $cariMax[$choosen[$i]][3] == 0) {
			$labelfuz3[$i] = "Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 1 && $cariMax[$choosen[$i]][1] == 0 && $cariMax[$choosen[$i]][2] == 1 && $cariMax[$choosen[$i]][3] == 0) {
			$labelfuz3[$i] = "Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 1 && $cariMax[$choosen[$i]][1] == 0 && $cariMax[$choosen[$i]][2] == 2 && $cariMax[$choosen[$i]][3] == 0) {
			$labelfuz3[$i] = "Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 1 && $cariMax[$choosen[$i]][1] == 1 && $cariMax[$choosen[$i]][2] == 0 && $cariMax[$choosen[$i]][3] == 0) {
			$labelfuz3[$i] = "Tidak Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 1 && $cariMax[$choosen[$i]][1] == 1 && $cariMax[$choosen[$i]][2] == 1 && $cariMax[$choosen[$i]][3] == 0) {
			$labelfuz3[$i] = "Tidak Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 1 && $cariMax[$choosen[$i]][1] == 1 && $cariMax[$choosen[$i]][2] == 2 && $cariMax[$choosen[$i]][3] == 0) {
			$labelfuz3[$i] = "Tidak Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 1 && $cariMax[$choosen[$i]][1] == 2 && $cariMax[$choosen[$i]][2] == 0 && $cariMax[$choosen[$i]][3] == 0) {
			$labelfuz3[$i] = "Tidak Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 1 && $cariMax[$choosen[$i]][1] == 2 && $cariMax[$choosen[$i]][2] == 1 && $cariMax[$choosen[$i]][3] == 0) {
			$labelfuz3[$i] = "Tidak Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 1 && $cariMax[$choosen[$i]][1] == 2 && $cariMax[$choosen[$i]][2] == 2 && $cariMax[$choosen[$i]][3] == 0) {
			$labelfuz3[$i] = "Tidak Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 2 && $cariMax[$choosen[$i]][1] == 0 && $cariMax[$choosen[$i]][2] == 0 && $cariMax[$choosen[$i]][3] == 0) {
			$labelfuz3[$i] = "Tidak Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 2 && $cariMax[$choosen[$i]][1] == 0 && $cariMax[$choosen[$i]][2] == 1 && $cariMax[$choosen[$i]][3] == 0) {
			$labelfuz3[$i] = "Tidak Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 2 && $cariMax[$choosen[$i]][1] == 0 && $cariMax[$choosen[$i]][2] == 2 && $cariMax[$choosen[$i]][3] == 0) {
			$labelfuz3[$i] = "Tidak Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 2 && $cariMax[$choosen[$i]][1] == 1 && $cariMax[$choosen[$i]][2] == 0 && $cariMax[$choosen[$i]][3] == 0) {
			$labelfuz3[$i] = "Tidak Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 2 && $cariMax[$choosen[$i]][1] == 1 && $cariMax[$choosen[$i]][2] == 1 && $cariMax[$choosen[$i]][3] == 0) {
			$labelfuz3[$i] = "Tidak Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 2 && $cariMax[$choosen[$i]][1] == 1 && $cariMax[$choosen[$i]][2] == 2 && $cariMax[$choosen[$i]][3] == 0) {
			$labelfuz3[$i] = "Tidak Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 2 && $cariMax[$choosen[$i]][1] == 2 && $cariMax[$choosen[$i]][2] == 0 && $cariMax[$choosen[$i]][3] == 0) {
			$labelfuz3[$i] = "Tidak Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 2 && $cariMax[$choosen[$i]][1] == 2 && $cariMax[$choosen[$i]][2] == 1 && $cariMax[$choosen[$i]][3] == 0) {
			$labelfuz3[$i] = "Tidak Direkomendasi";
		} else if ($cariMax[$choosen[$i]][0] == 2 && $cariMax[$choosen[$i]][1] == 2 && $cariMax[$choosen[$i]][2] == 2 && $cariMax[$choosen[$i]][3] == 0) {
			$labelfuz3[$i] = "Tidak Direkomendasi";
		}

		if ($labelfuz3[$i] == "Sangat Direkomendasi") {
			$choosen3[$cek3] = $i;
			$cek3++;
		}
	} //print_r($labelfuzsen); echo "<br>"; print_r($choosensen); echo "<br>"; print_r(sizeof($choosensen)); echo "<br>";
	
	// ambil data
	$data_nama = mysql_query("select a.nama_objek, b.latitude, b.longitude
						from data_objek a, koordinat_objek b
						where a.id_objek = b.id_objek") or die (mysql_error());

	$i=0;
	while($row = mysql_fetch_array($data_nama)) {

		$hasil_data_nama[$i] = $row;
		$i++;
	} //print_r($hasil_data_nama);

	// for ($i=0; $i < sizeof($data_nama); $i++) { 
	// 	$data_nama[$i]['hasil_fuzzy']=$hasilMin[$i];
	// 	// gak mbok lebok no res
	// }
	$res = array();
	
	// memilih data berdasarkan choosen
	foreach ($choosen3 as $keyChoosen => $valueChoosen) {
		foreach ($hasil_data_nama as $keyHasil => $valueHasil) {
			if ($valueChoosen == $keyHasil) {
				array_push($res, $valueHasil);
			}
		}
	}

	//print_r($res);
	// tampil
	foreach ($res as $key) {
		echo " <a href='#' class='list-group-item' data-long ='".$key['longitude']."' data-lat='".$key['latitude']."'>
      				<h4 class='list-group-item-success'>".$key[0]."</h4>
			</a>";
	}
	// print_r($data_nama);

	// $labelfuzsen = array();
	// $choosensen = array();
	// $ceksen = 0;
	// for($i=0; $i < sizeof($jarak); $i++) { // Looping Objek
	// 	if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 0 && $cariMax[$i][3] == 2) {
	// 		$labelfuzsen[$i] = "Sangat Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 1 && $cariMax[$i][3] == 2) {
	// 		$labelfuzsen[$i] = "Sangat Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 2 && $cariMax[$i][3] == 2) {
	// 		$labelfuzsen[$i] = "Sangat Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 0 && $cariMax[$i][3] == 2) {
	// 		$labelfuzsen[$i] = "Sangat Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 1 && $cariMax[$i][3] == 2) {
	// 		$labelfuzsen[$i] = "Sangat Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 2 && $cariMax[$i][3] == 2) {
	// 		$labelfuzsen[$i] = "Sangat Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 0 && $cariMax[$i][3] == 2) {
	// 		$labelfuzsen[$i] = "Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 1 && $cariMax[$i][3] == 2) {
	// 		$labelfuzsen[$i] = "Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 2 && $cariMax[$i][3] == 2) {
	// 		$labelfuzsen[$i] = "Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 0 && $cariMax[$i][3] == 2) {
	// 		$labelfuzsen[$i] = "Sangat Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 1 && $cariMax[$i][3] == 2) {
	// 		$labelfuzsen[$i] = "Sangat Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 2 && $cariMax[$i][3] == 2) {
	// 		$labelfuzsen[$i] = "Sangat Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 0 && $cariMax[$i][3] == 2) {
	// 		$labelfuzsen[$i] = "Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 1 && $cariMax[$i][3] == 2) {
	// 		$labelfuzsen[$i] = "Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 2 && $cariMax[$i][3] == 2) {
	// 		$labelfuzsen[$i] = "Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 0 && $cariMax[$i][3] == 2) {
	// 		$labelfuzsen[$i] = "Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 1 && $cariMax[$i][3] == 2) {
	// 		$labelfuzsen[$i] = "Tidak Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 2 && $cariMax[$i][3] == 2) {
	// 		$labelfuzsen[$i] = "Tidak Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 0 && $cariMax[$i][3] == 2) {
	// 		$labelfuzsen[$i] = "Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 1 && $cariMax[$i][3] == 2) {
	// 		$labelfuzsen[$i] = "Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 2 && $cariMax[$i][3] == 2) {
	// 		$labelfuzsen[$i] = "Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 0 && $cariMax[$i][3] == 2) {
	// 		$labelfuzsen[$i] = "Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 1 && $cariMax[$i][3] == 2) {
	// 		$labelfuzsen[$i] = "Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 2 && $cariMax[$i][3] == 2) {
	// 		$labelfuzsen[$i] = "Tidak Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 0 && $cariMax[$i][3] == 2) {
	// 		$labelfuzsen[$i] = "Tidak Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 1 && $cariMax[$i][3] == 2) {
	// 		$labelfuzsen[$i] = "Tidak Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 2 && $cariMax[$i][3] == 2) {
	// 		$labelfuzsen[$i] = "Tidak Direkomendasi";
	// 	}

	// 	else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 0 && $cariMax[$i][3] == 1) {
	// 		$labelfuzsen[$i] = "Sangat Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 1 && $cariMax[$i][3] == 1) {
	// 		$labelfuzsen[$i] = "Sangat Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 2 && $cariMax[$i][3] == 1) {
	// 		$labelfuzsen[$i] = "Sangat Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 0 && $cariMax[$i][3] == 1) {
	// 		$labelfuzsen[$i] = "Sangat Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 1 && $cariMax[$i][3] == 1) {
	// 		$labelfuzsen[$i] = "Sangat Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 2 && $cariMax[$i][3] == 1) {
	// 		$labelfuzsen[$i] = "Sangat Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 0 && $cariMax[$i][3] == 1) {
	// 		$labelfuzsen[$i] = "Sangat Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 1 && $cariMax[$i][3] == 1) {
	// 		$labelfuzsen[$i] = "Sangat Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 2 && $cariMax[$i][3] == 1) {
	// 		$labelfuzsen[$i] = "Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 0 && $cariMax[$i][3] == 1) {
	// 		$labelfuzsen[$i] = "Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 1 && $cariMax[$i][3] == 1) {
	// 		$labelfuzsen[$i] = "Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 2 && $cariMax[$i][3] == 1) {
	// 		$labelfuzsen[$i] = "Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 0 && $cariMax[$i][3] == 1) {
	// 		$labelfuzsen[$i] = "Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 1 && $cariMax[$i][3] == 1) {
	// 		$labelfuzsen[$i] = "Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 2 && $cariMax[$i][3] == 1) {
	// 		$labelfuzsen[$i] = "Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 0 && $cariMax[$i][3] == 1) {
	// 		$labelfuzsen[$i] = "Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 1 && $cariMax[$i][3] == 1) {
	// 		$labelfuzsen[$i] = "Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 2 && $cariMax[$i][3] == 1) {
	// 		$labelfuzsen[$i] = "Tidak Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 0 && $cariMax[$i][3] == 1) {
	// 		$labelfuzsen[$i] = "Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 1 && $cariMax[$i][3] == 1) {
	// 		$labelfuzsen[$i] = "Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 2 && $cariMax[$i][3] == 1) {
	// 		$labelfuzsen[$i] = "Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 0 && $cariMax[$i][3] == 1) {
	// 		$labelfuzsen[$i] = "Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 1 && $cariMax[$i][3] == 1) {
	// 		$labelfuzsen[$i] = "Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 2 && $cariMax[$i][3] == 1) {
	// 		$labelfuzsen[$i] = "Tidak Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 0 && $cariMax[$i][3] == 1) {
	// 		$labelfuzsen[$i] = "Tidak Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 1 && $cariMax[$i][3] == 1) {
	// 		$labelfuzsen[$i] = "Tidak Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 2 && $cariMax[$i][3] == 1) {
	// 		$labelfuzsen[$i] = "Tidak Direkomendasi";
	// 	}

	// 	else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 0 && $cariMax[$i][3] == 0) {
	// 		$labelfuzsen[$i] = "Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 1 && $cariMax[$i][3] == 0) {
	// 		$labelfuzsen[$i] = "Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 2 && $cariMax[$i][3] == 0) {
	// 		$labelfuzsen[$i] = "Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 0 && $cariMax[$i][3] == 0) {
	// 		$labelfuzsen[$i] = "Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 1 && $cariMax[$i][3] == 0) {
	// 		$labelfuzsen[$i] = "Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 2 && $cariMax[$i][3] == 0) {
	// 		$labelfuzsen[$i] = "Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 0 && $cariMax[$i][3] == 0) {
	// 		$labelfuzsen[$i] = "Tidak Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 1 && $cariMax[$i][3] == 0) {
	// 		$labelfuzsen[$i] = "Tidak Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 0 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 2 && $cariMax[$i][3] == 0) {
	// 		$labelfuzsen[$i] = "Tidak Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 0 && $cariMax[$i][3] == 0) {
	// 		$labelfuzsen[$i] = "Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 1 && $cariMax[$i][3] == 0) {
	// 		$labelfuzsen[$i] = "Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 2 && $cariMax[$i][3] == 0) {
	// 		$labelfuzsen[$i] = "Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 0 && $cariMax[$i][3] == 0) {
	// 		$labelfuzsen[$i] = "Tidak Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 1 && $cariMax[$i][3] == 0) {
	// 		$labelfuzsen[$i] = "Tidak Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 2 && $cariMax[$i][3] == 0) {
	// 		$labelfuzsen[$i] = "Tidak Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 0 && $cariMax[$i][3] == 0) {
	// 		$labelfuzsen[$i] = "Tidak Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 1 && $cariMax[$i][3] == 0) {
	// 		$labelfuzsen[$i] = "Tidak Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 1 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 2 && $cariMax[$i][3] == 0) {
	// 		$labelfuzsen[$i] = "Tidak Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 0 && $cariMax[$i][3] == 0) {
	// 		$labelfuzsen[$i] = "Tidak Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 1 && $cariMax[$i][3] == 0) {
	// 		$labelfuzsen[$i] = "Tidak Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 0 && $cariMax[$i][2] == 2 && $cariMax[$i][3] == 0) {
	// 		$labelfuzsen[$i] = "Tidak Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 0 && $cariMax[$i][3] == 0) {
	// 		$labelfuzsen[$i] = "Tidak Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 1 && $cariMax[$i][3] == 0) {
	// 		$labelfuzsen[$i] = "Tidak Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 1 && $cariMax[$i][2] == 2 && $cariMax[$i][3] == 0) {
	// 		$labelfuzsen[$i] = "Tidak Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 0 && $cariMax[$i][3] == 0) {
	// 		$labelfuzsen[$i] = "Tidak Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 1 && $cariMax[$i][3] == 0) {
	// 		$labelfuzsen[$i] = "Tidak Direkomendasi";
	// 	} else if ($cariMax[$i][0] == 2 && $cariMax[$i][1] == 2 && $cariMax[$i][2] == 2 && $cariMax[$i][3] == 0) {
	// 		$labelfuzsen[$i] = "Tidak Direkomendasi";
	// 	}

	// 	if ($labelfuzsen[$i] == "Sangat Direkomendasi") {
	// 		$choosensen[$ceksen] = $i;
	// 		$ceksen++;
	// 	}
	// } //print_r($labelfuzsen); echo "<br>"; print_r($choosensen); echo "<br>"; print_r(sizeof($choosensen)); echo "<br>";

	// $ressen = array();
	
	// // memilih data berdasarkan choosen
	// foreach ($choosensen as $keyChoosensen => $valueChoosensen) {
	// 	foreach ($hasil_data_nama as $keyHasilsen => $valueHasilsen) {
	// 		if ($valueChoosensen == $keyHasilsen) {
	// 			array_push($ressen, $valueHasilsen);
	// 		}
	// 	}
	// }

	// // tampil
	// foreach ($ressen as $keysen) {
	// 	echo " <a href='#' class='list-group-item' data-long ='".$keysen['longitude']."' data-lat='".$keysen['latitude']."'>
 //      				<h4 class='list-group-item-heading home-description right'>".$keysen[0]." Sen</h4>
	// 		</a>";
	// }

?>