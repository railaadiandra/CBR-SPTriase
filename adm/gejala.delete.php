<?php
	session_start();
	include_once('admin.session.php');
	$kode	= $_GET['kode'];
	$sql	= mysqli_query($conn,"delete from gejala where kode_gejala='$kode'");
	
	echo "<script language=javascript>
			window.alert('Hapus Berhasil');
			window.location='gejala.php?hal=1';
			</script>";
?>