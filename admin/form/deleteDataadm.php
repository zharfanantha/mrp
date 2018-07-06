<?php
include '../../connect.php';
	$idAdm = $_GET['id_admin'];

	$query = "SELECT * FROM admin WHERE id_admin='".$idAdm."'";
    $sql = mysql_query($query);
    $data = mysqli_fetch_array($sql);

    $queryDel = "DELETE FROM admin WHERE id_admin='".$idAdm."'";
    $sqlDel = mysql_query($queryDel);
    if ($sqlDel) {
    	header("refresh:0; url=/rekomendasi/admin/tables/dataAdm.php");
        echo "<script type='text/javascript'>alert('Data Berhasil Dihapus!')</script>";
    }
?>