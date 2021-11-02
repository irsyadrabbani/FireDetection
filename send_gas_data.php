<?php 
	
	//include koneksi
	include "koneksi.php";

	//baca data yang di kirim nodeMCU
	$gas = $_GET['gas'];
	

	//simpan ke tb_sensor

	//auto increment = 1
	mysqli_query($konek, "ALTER TABLE tb_gas AUTO_INCREMENT =1");
	//simpan data sensor ke tb_sensor
	$simpan = mysqli_query($konek, "INSERT INTO tb_gas(gas)values('$gas')");

	//uji simpan untuk memberikan respon
	if($simpan)
		echo "Nilai Gas Berhasil Terkirim";
	else
		echo "Nilai Gas Gagal Terkirim";


?>