<?php
	include 'connect.php';
	
	$data_training = array();
	$data_batas = array();
	$hasil_fuzzifikasi = array();
		
	$data = mysql_query("select jarak, biaya, bencana, kategori from data_objek") or die (mysql_error());
	$batas = mysql_query("select bawah, tengah, atas from batas_atribut") or die (mysql_error());
	
	//Ambil Data Objek Wisata
	while($row = mysql_fetch_array($data)) {
		$data_training[] = $row;
		//print_r($row); echo "<br>";
	}
	$jumdat = sizeof($data_training);
	// print_r($data_training);
	
	//Ambil Data Batas Kriteria
	while($row = mysql_fetch_array($batas)) {
		$data_batas[] = $row;
	}
	//print_r($data_batas);
	// echo $data_training[0][1];
	//echo $data_batas[0][0];
	//if($data_batas[0][0]<=$data_training[0][0] && $data_training[0][0] < $data_batas[0][1])
		//echo "Hasil nya .... ";
	
	//Hitung Derajat Keanggotaan Tiap Objek Tiap Kriteria
	for($i=0; $i < $jumdat; $i++) { // Looping Objek
		for($j=0; $j < 3; $j++) { // Looping Kriteria
			$itr = 0; // Indeks Miu Perkriteria
			// echo $data_training[$i][$j]." ";
			
			// //Miu Rendah
			if($data_training[$i][$j] <= $data_batas[$j][0]) {
				$hasil_fuzzifikasi[$i][$j][$itr] = 1;
				$itr++;
				//echo "Jarak Dekat <br>";
			} elseif($data_batas[$j][0]<=$data_training[$i][$j] && $data_training[$i][$j] < $data_batas[$j][1]) {
				$hasil_fuzzifikasi[$i][$j][$itr] = round((($data_batas[$j][1] - $data_training[$i][$j]) / ($data_batas[$j][1] - $data_batas[$j][0])),2);
				$itr++;
				//echo "Jarak Sedang <br>";
			} elseif($data_training[$i][$j] >= $data_batas[$j][1]) {
				$hasil_fuzzifikasi[$i][$j][$itr] = 0;
				$itr++;
				//echo "Jarak Jauh <br>";
			}
			
			//Miu Sedang
			if($data_training[$i][$j] <= $data_batas[$j][0] || $data_training[$i][$j] >= $data_batas[$j][2]) {
				$hasil_fuzzifikasi[$i][$j][$itr] = 0;
				$itr++;
			} elseif($data_batas[$j][0]<=$data_training[$i][$j] && $data_training[$i][$j] < $data_batas[$j][1]) {
				$hasil_fuzzifikasi[$i][$j][$itr] = round((($data_training[$i][$j] - $data_batas[$j][0]) / ($data_batas[$j][1] - $data_batas[$j][0])),2);
				$itr++;
			} elseif($data_batas[$j][1]<=$data_training[$i][$j] && $data_training[$i][$j] < $data_batas[$j][2]) {
				$hasil_fuzzifikasi[$i][$j][$itr] = round((($data_batas[$j][2] - $data_training[$i][$j]) / ($data_batas[$j][2] - $data_batas[$j][1])),2);
				$itr++;
			}
			
			//Miu Tinggi
			if($data_training[$i][$j] <= $data_batas[$j][1]) {
				$hasil_fuzzifikasi[$i][$j][$itr] = 0;
				$itr++;
			} elseif($data_batas[$j][1] <= $data_training[$i][$j] && $data_training[$i][$j] < $data_batas[$j][2]) {
				$hasil_fuzzifikasi[$i][$j][$itr] = round((($data_training[$i][$j] - $data_batas[$j][1]) / ($data_batas[$j][2] - $data_batas[$j][1])),2);
				$itr++;
			} elseif($data_training[$i][$j] >= $data_batas[$j][2]) {
				$hasil_fuzzifikasi[$i][$j][$itr] = 1;
				$itr++;
			}
			
		} 
	}
	
	// print_r($hasil_fuzzifikasi);

	// for($i=0; $i < $jumdat; $i++) { // Looping Objek
	// 	$simpanfk=mysql_query("SELECT id_objek FROM fuzzifikasi where id_objek='".($i+1)."'");
 //        if (mysql_num_rows($simpanfk)==0)
 //            mysql_query("INSERT INTO fuzzifikasi values('','".($i+1)."','".$hasil_fuzzifikasi[$i][0][0]."','".$hasil_fuzzifikasi[$i][0][1]."','".$hasil_fuzzifikasi[$i][0][2]."','".$hasil_fuzzifikasi[$i][1][0]."','".$hasil_fuzzifikasi[$i][1][1]."','".$hasil_fuzzifikasi[$i][1][2]."','".$hasil_fuzzifikasi[$i][2][0]."','".$hasil_fuzzifikasi[$i][2][1]."','".$hasil_fuzzifikasi[$i][2][2]."')")or die(mysql_error());
 //        else
 //            mysql_query("UPDATE fuzzifikasi SET jrkdekat='".$hasil_fuzzifikasi[$i][0][0]."',jrksedang='".$hasil_fuzzifikasi[$i][0][1]."',jrkjauh='".$hasil_fuzzifikasi[$i][0][2]."',bgtmurah='".$hasil_fuzzifikasi[$i][1][0]."',bgtsedang='".$hasil_fuzzifikasi[$i][1][1]."',bgtmahal='".$hasil_fuzzifikasi[$i][1][2]."',bncsedikit='".$hasil_fuzzifikasi[$i][2][0]."',bncsedang='".$hasil_fuzzifikasi[$i][2][1]."',bncbanyak='".$hasil_fuzzifikasi[$i][2][2]."' where id_objek ='".($i+1)."'");
	// }

	$cariMax = array();
	$hasilMax = array();
	for($i=0; $i < $jumdat; $i++) { // Looping Objek
		for($j=0; $j < 3; $j++) { // Looping Kriteria
			if($hasil_fuzzifikasi[$i][$j][0] >= $hasil_fuzzifikasi[$i][$j][1] && $hasil_fuzzifikasi[$i][$j][0] >= $hasil_fuzzifikasi[$i][$j][2]) {
				$cariMax[$i][$j] = 0;//$hasil_fuzzifikasi[$i][$j][0];
				$hasilMax[$i][$j] = $hasil_fuzzifikasi[$i][$j][0];
			} else if ($hasil_fuzzifikasi[$i][$j][1] >= $hasil_fuzzifikasi[$i][$j][0] && $hasil_fuzzifikasi[$i][$j][1] >= $hasil_fuzzifikasi[$i][$j][2]) {
				$cariMax[$i][$j] = 1;//$hasil_fuzzifikasi[$i][$j][1];
				$hasilMax[$i][$j] = $hasil_fuzzifikasi[$i][$j][1];
			} else if ($hasil_fuzzifikasi[$i][$j][2] >= $hasil_fuzzifikasi[$i][$j][0] && $hasil_fuzzifikasi[$i][$j][2] >= $hasil_fuzzifikasi[$i][$j][1]) {
				$cariMax[$i][$j] = 2;//$hasil_fuzzifikasi[$i][$j][2];
				$hasilMax[$i][$j] = $hasil_fuzzifikasi[$i][$j][2];
			}
		}
	}

	// print_r($cariMax);
	print_r($hasilMax);

	$cariMin = array();
	for($i=0; $i < $jumdat; $i++) { // Looping Objek
		if ($hasilMax[$i][0] <= $hasilMax[$i][1] && $hasilMax[$i][0] <= $hasilMax[$i][2]) {
			$cariMin[$i] = $hasilMax[$i][0];
		} else if ($hasilMax[$i][1] <= $hasilMax[$i][0] && $hasilMax[$i][1] <= $hasilMax[$i][2]) {
			$cariMin[$i] = $hasilMax[$i][1];
		} else if ($hasilMax[$i][2] <= $hasilMax[$i][1] && $hasilMax[$i][1] <= $hasilMax[$i][0]) {
			$cariMin[$i] = $hasilMax[$i][2];
		}
	}
	// print_r($cariMin);

	$labelfuz = array();
	for($i=0; $i < $jumdat; $i++) { // Looping Objek
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
	}

	// print_r($labelfuz);

?>