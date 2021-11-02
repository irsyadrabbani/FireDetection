<?php
	//include koneksi
	include "koneksi.php";
	

	$sql = mysqli_query($konek, "SELECT * FROM tb_kontrol");
	$data = mysqli_fetch_array($sql);
	$fan = $data['fan'];

	//respone balik ke nodeMCU
	echo $fan; // 1 atau 0

?>