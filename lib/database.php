<?php
	$host = 'localhost';
	$user = 'root';
	$pass ='';
	$db = 'new_cbr';

 	$conn = mysqli_connect($host,$user,$pass,$db);
 	if($conn){
	//echo "koneksi berhasil";

 	}

	mysqli_select_db($conn, $db);

	// mysqli_connect('localhost','root','') or die("<h2>Koneksi Database Gagal..</h2>");
	// mysqli_select_db(connection,'new_cbr') or die("<h2>Database Belum Ada..</h2>");
?>