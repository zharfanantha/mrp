<?php
include 'connect.php';

$sentimen = mysql_query("select finalSkor from skor_sentimen") or die (mysql_error());
$btssen = mysql_query("select bawah, tengah, atas from batas_atribut where atribut='skor'") or die (mysql_error());

while($rew = mysql_fetch_array($sentimen)) {
	$skor[] = $rew;
} print_r($skor);
echo "<br><br>";
while($ruw = mysql_fetch_array($btssen)) {
	$btsskor[] = $ruw;
} print_r($btsskor);

?>