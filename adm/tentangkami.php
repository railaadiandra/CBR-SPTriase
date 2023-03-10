<?php
	session_start();
	include_once('admin.session.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Tentang Kami</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<link rel="shortcut icon" href="../img/favicon.png"/>
	<link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
    
	<style>
		body{
			background-image: url(../img/bro.jpg);
			background-repeat: repeat;
			background-attachment: fixed;
		}
	</style>
</head>

<body>

<?php
	include_once('menu.php');
?>
<div class="container">
        <div class="navbar-inner" style="border:1px solid #bbb; border-radius:10px; padding:10px 20px 10px 20px; margin-top:50px; margin-left:auto; margin-right:auto;">
			<div>
            	<div class="modal-header">
                	<h3>Tentang Kami</h3>
                </div>
                <div style="margin-top:10px">
                	<div class="span3">
                    	<div class="text-center">
                    		<img src="../img/bunga.png" width="130">
						</div>
                        <div class="text-center text-error">
                    		<h5><a href="<?php echo "http://ginekolog.esy.es/"?>" target="_blank">www.triase.com</a></h5>
						</div>
                    </div>
                    <div class="span3">
                    	<div class="row text-error" style="margin-left:20px; margin-right:auto; margin-top:15px; margin-bottom:15px;">
                        	<div>
                    			<span class="icon-map-marker"></span>  Jln. bung hatta no.9
                            </div>
                            <div>
                    			<span class="icon-envelope"></span>  <a href="mailto:#">kelompoktiga@gmail.com</a>
                            </div>
                            <div>
                    			<span class="icon-bell"></span> 082266228753
                            </div>
						</div>
                    </div>
                    <div class="span3">
                    	<div class="row text-warning text-left" style="margin-left:20px; margin-right:auto; margin-top:15px; margin-bottom:15px;">
						Triase/Triage merupakan suatu sistem yang digunakan dalam mengidentifikasi korban dengan cedera yang mengancam jiwa untuk kemudian diberikan prioritas untuk dirawat atau dievakuasi ke fasilitas kesehatan.
						</div>
                    </div>
                </div>
			</div>
    	</div>
</div>

<br><br><br><br>
<?php include_once('../footer.php'); ?>
<script src="../js/jquery-1.8.3.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

</body>
</html>