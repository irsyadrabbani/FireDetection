<?php
	//include koneksi
	include "koneksi.php";
	

	$sql = mysqli_query($konek, "SELECT * FROM tb_kontrol");
	$data = mysqli_fetch_array($sql);
	$pompa = $data['pompa'];

	//respone balik ke nodeMCU
	echo $pompa; // 1 atau 0
	?>