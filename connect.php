<?php

$dbhost ="localhost";
$dbuser ="root";
$dbpass ="";

mysql_connect($dbhost, $dbuser, $dbpass) or die ("Koneksi tidak berhasil");
mysql_select_db("malangraya") or die ("Database tidak di temukan");
?>