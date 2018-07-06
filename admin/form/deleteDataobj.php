<?php
include '../../connect.php';
	$idObj = $_GET['id_objek'];

	$query = "SELECT * FROM data_objek WHERE id_objek='".$idObj."'";
    $sql = mysql_query($query);
    $data = mysqli_fetch_array($sql);

    $queryDel = "DELETE FROM data_objek WHERE id_objek='".$idObj."'";
    $sqlDel = mysql_query($queryDel);
    if ($sqlDel) {
    	header("refresh:0; url=/rekomendasi/admin/tables/dataobj.php");
        echo "<script type='text/javascript'>alert('Data Berhasil Dihapus!')</script>";
    }
?>