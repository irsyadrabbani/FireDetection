<?php 
	
	//include koneksi
	include "koneksi.php";

	//baca data yang di kirim nodeMCU
	$gas = $_GET['gas'];
    $api = $_GET['api'];
	

	//simpan ke tb_sensor

	//auto increment = 1
	mysqli_query($konek, "ALTER TABLE tb_sensor AUTO_INCREMENT =1");
	//simpan data sensor ke tb_sensor
	$simpan = mysqli_query($konek, "INSERT INTO tb_sensor(gas,api)values('$gas','$api')");

	//uji simpan untuk memberikan respon
	if($simpan)
		echo "Nilai Sensor Berhasil Terkirim";
	else
		echo "Nilai Sensor Gagal Terkirim";


?>