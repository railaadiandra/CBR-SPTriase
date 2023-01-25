<?php
	include_once '../lib/database.php';

	$nama = mysqli_real_escape_string($conn, trim($_POST["username"]));
	$pass = mysqli_real_escape_string($conn, trim($_POST["password"]));

	$sql	= mysqli_query($conn,"SELECT * FROM admin WHERE username='$nama' && password='$pass'");
	$data	= mysqli_fetch_array($sql);

	if(mysqli_num_rows($sql) > 0){
		session_start();
		$_SESSION['id_user']	= $data['id_user'];;
		$_SESSION['username']	= $data['username'];
		$_SESSION['password']	= $data['password'];
		
		echo "<script language=javascript>
				window.location='home.php';
				</script>";
		exit;
		
	}else{
		echo "<script language=javascript>
				window.alert('Login GAGAL');
				history.back();
				</script>";
		exit;
	}
?>