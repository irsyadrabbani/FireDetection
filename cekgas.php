<?php 
	//Koneksi ke Database
	include "koneksi.php";

	//Baca data dari tabel tb_sensor
	$sql = mysqli_query($konek, "SELECT * FROM tb_gas ORDER BY id DESC"); //Data terakhir akan berada diatas

	//Membaca data yang paling atas
	$data = mysqli_fetch_array($sql);
	$gas = $data['gas'];

	//apabila nilai belum ada,maka suhu dianggap 0
	if( $gas == "") $gas = 0;

	echo $gas;
?>
