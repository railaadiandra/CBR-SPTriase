<?php
	session_start();
	include_once('admin.session.php');
	$id	= $_GET['id'];
	
	mysqli_query($conn,"delete from keterangan where id_konsultasi='$id'");
	mysqli_query($conn,"delete from hasil_konsultasi where konsultasi='$id'");
	
	echo "<script language=javascript>
			window.alert('Hapus Berhasil');
			window.location='hasil.konsultasi.php?hal=1';
			</script>";
?>