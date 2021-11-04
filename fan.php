<?php 
	
	//include koneksi
	include "koneksi.php";
	
	//tangkap parameter stat yang di kirim ajax
	$stat = $_GET['stat'];
	if ($stat == "ON") 
	{
		//ubah field fan menjadi 0
		mysqli_query($konek, "UPDATE tb_kontrol SET fan=1");
		//Respon
		echo "ON";
	}
	else
	{
		//ubah field fan menjadi 1
		mysqli_query($konek, "UPDATE tb_kontrol SET fan=0");
		//Respon
		echo "OFF";
	}
 ?>