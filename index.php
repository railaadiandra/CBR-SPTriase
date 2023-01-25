<!DOCTYPE html>
<html lang="en">

<head>
	<!-- basic -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- mobile metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="initial-scale=1, maximum-scale=1">
	<!-- site metas -->
	
	<meta name="keywords" content="">
	<meta name="description" content="">
	<meta name="author" content="">
	<!-- bootstrap css -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- style css -->
	<link rel="stylesheet" href="css/style.css">
	<!-- Responsive-->
	<link rel="stylesheet" href="css/responsive.css">
	<!-- fevicon -->
	<link rel="icon" href="images/fevicon.png" type="image/gif" />
	<!-- Scrollbar Custom CSS -->
	<link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
	<!-- Tweaks for older IEs-->
	<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
	<title>Sistem Pakar</title>

	<meta name="description" content="">
	<meta name="author" content="">

	<link rel="shortcut icon" href="img/favicon.png" />
	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">

	<style>
		body {
			background-image: url(img/bro.jpg);
			background-repeat: repeat;
			background-attachment: fixed;
		}
	</style>
</head>

<body>

	<?php
	include 'lib/database.php';
	include('menu.php');
	include 'header.php';

	// mysqli_query($conn,);


	?>
	<!-- awal -->
	<div class="container">
		<!-- a -->
		<div class="navbar-inner" style="border:0px solid #bbb; border-radius:10px; padding:10px 20px 10px 20px; margin-top:45px; margin-left:auto; margin-right:auto;">


			<ul class="breadcrumb" style="margin:0; background-color:transparent;">

				<li class="active">Home
					<span class="devider">&raquo;</span>
				</li>


			</ul>

			<div class="modal-header">
				<h4>Selamat Datang</h4>
			</div>


			<div style="margin-top:5px;">

				<!-- three_box -->
				<div class="three_box" >
					<div class="container" >
						<div class="row">
							<div class="col-lg-4">
								<div class="box_text" width:200px>
									<i><img src="img/pasien.png" width="100" height="100" alt="#" /></i>

									<a href="./konsultasi/index.php">
										<h3>Pasien</h3>
									</a>

								</div>
							</div>

							<div class="col-lg-4">
								<div class="box_text" width:200px>
									<i><img src="img/diagnose.png" width="100" height="100" alt="#" /></i>
									<a href="tampil.php">
										<h3>Diagnosa Penyakit</h3>
									</a>
								</div>
							</div>

							
							<div class="col-lg-4">
								<div class="box_text" width:200px>
									<i><img src="img/antriaan.png" width="100" height="100" alt="#" /></i>
									<a href="./adm/hasil.konsultasi.php">
										<h3>Hasil Antrian</h3>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- three_box -->

			</div>

		</div>

	</div>
	<!-- akhir -->


	<br><br><br><br>

	<?php include_once('footer.php'); ?>

	<script src="js/jquery-1.8.3.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

	<!-- Javascript files-->
	<script src="js/jquery.min.js"></script>
	<script src="js/popper.min.js"></script>
	<!-- sidebar -->
	<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="js/custom.js"></script>

</body>

</html>