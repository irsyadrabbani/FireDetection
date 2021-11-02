<?php 
	
	//include koneksi
	include "koneksi.php";

	//baca data yang di kirim nodeMCU
	$api = $_GET['api'];
	

	//simpan ke tb_sensor
	//auto increment = 1
	mysqli_query($konek, "ALTER TABLE tb_api AUTO_INCREMENT =1");
	//simpan data sensor ke tb_sensor
	$simpan = mysqli_query($konek, "INSERT INTO tb_api(api)values('$api')");

	//uji simpan untuk memberikan respon
	if($simpan)
		echo "Status Api Berhasil Terkirim";
	else
		echo "Status Api Gagal Terkirim";


?>