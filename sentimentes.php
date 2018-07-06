<?php
	include 'connect.php';
	$rev = mysql_query("SELECT no_review, review FROM normalisasi WHERE id_objek = 102") or die (mysql_error());
	while($row = mysql_fetch_array($rev)) {
		$data_rev[] = $row;
		// print_r($row); echo "<br>";
	}
	//print_r($data_rev);

	for ($i=0; $i < sizeof($data_rev) ; $i++) { 
		$strings[$i] = array(
			$i => $data_rev[$i]['review'],
		);
	}
	// print_r($strings);
	$jumdat = sizeof($strings);

	require_once __DIR__ . '/autoload.php';
	$sentiment = new \PHPInsight\Sentiment();

	$countpos = 0;
	$countnet = 0;
	$countneg = 0;
	for ($i=0; $i < sizeof($strings) ; $i++) {
			// calculations:
			$scores[$i] = $sentiment->score($strings[$i][$i]);
			$class[$i] = $sentiment->categorise($strings[$i][$i]);

			// output:
			if (in_array("pos", $scores)) {
			    echo "Got positif";
			}

			echo "Hasil: <br>";
			echo "Kalimat : ";
			print_r($strings[$i][$i]);
			echo "<br>Arah sentimen: <b>$class[$i]</b>, nilai: ";
			// var_dump($scores);
			if ($class[$i] == 'positif') {
				$skor[$i] = 1;
				$countpos++;
			} else if ($class[$i] == 'negatif') {
				$skor[$i] = -1;
				$countneg++;
			} else {
				$skor[$i] = 0;
				$countnet++;
			}
			echo $skor[$i]."<br>";
			echo "\n\n";
	}
	echo "Total Hasil Sentimen ($jumdat Data) :<br>";
	echo "Positif: $countpos<br>";
	echo "Negatif: $countneg<br>";
	echo "Netral: $countnet<br>";
	$finalskor = $countpos/$jumdat ;
	echo "Final Skor: $finalskor<br>";
	//mysql_query("INSERT INTO skor_normalisasi (id_objek, jumlahReview, jumlahPositif, jumlahNetral, jumlahNegatif, finalSkor)
     			//VALUES ('102', '$jumdat', '$countpos', '$countnet', '$countneg', '$finalskor')") or die (mysql_error());
?>