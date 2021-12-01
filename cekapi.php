<?php 
	//Koneksi ke Database
	include "koneksi.php";

	//Baca data dari tabel tb_sensor
	$sql = mysqli_query($konek, "SELECT * FROM tb_sensor ORDER BY id DESC"); //Data terakhir akan berada diatas

	//Membaca data yang paling atas
	$data = mysqli_fetch_array($sql);
	$api = $data['api'];

	//uji, apabila nilai belum ada,maka suhu dianggap 1
	if($api == "") $api  = 1;

	if ($api == 1){
	
		//Respon
		echo "AMAN";
		}
		else if ($api == 0)
		{
		//Respon
		echo "API TERDETEKSI";
		} 

 ?>