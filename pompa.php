<?php 
	
	//include koneksi
	include "koneksi.php";
	
	//tangkap parameter stat yang di kirim ajax
	$kondis = $_GET['kondis'];
	if ($kondis == "ON") 
	{
		//ubah field fan menjadi 1
		mysqli_query($konek, "UPDATE tb_kontrol SET pompa=0");
		//Respon
		echo "ON";
	}
	else
	{
		//ubah field fan menjadi 0
		mysqli_query($konek, "UPDATE tb_kontrol SET pompa=1");
		//Respon
		echo "OFF";
	}
 ?>