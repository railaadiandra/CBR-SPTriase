<?php
	session_start();
	include_once '../lib/database.php';
	include_once 'header.php';
	$id = $_GET['id'];
	$konsultasi = $_GET['konsultasi'];			
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Hasil Konsultasi</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<link rel="shortcut icon" href="../img/favicon.png"/>
	<link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
    
	<style>
		body{
			background-image: url(../img/body.jpg);
			background-repeat: repeat;
			background-attachment: fixed;
		}
	</style>
</head>

<body>	

<div class="container">
        <div class="navbar-inner" style="border:1px solid #bbb; border-radius:10px; padding:10px 20px 10px 20px; margin-top:50px; margin-left:auto; margin-right:auto;">
			<div>
            	<div class="text-error">
                	<a href="../konsultasi/"><button class="btn btn-danger btn-medium" title="Keluar dan konsultasi sebagai User yang lain"><span class="icon-off icon-white"></span> Keluar</button></a>
                </div>
                <div class="text-error" style="margin-top:20px;">
                	<?php
						$sql_user = mysqli_query($conn,"select * from user where id_user='$id'");
						$detail_user = mysqli_fetch_array($sql_user);
						if(mysqli_num_rows($sql_user) > 0){
							$nama	= $detail_user['nama'];
							$umur	= $detail_user['umur'];
							$tgl_konsultasi	= $detail_user['tgl_konsultasi'];
							
							echo   "Nama : <b class='text-info'>$nama</b>
									<br>
									Usia : <b class='text-info'>$umur Tahun</b>
									<br>
									Konsultasi Pada : <b class='text-info'>$tgl_konsultasi</b>";
						}
					?>
                </div>
                <div style="margin-top:20px">
                    <form name="form1" method="post" action="">
                        <div class="span4 navbar-inner"><h5 class="text-left text-error">Gejala Yang Dipilih :</h5>
                    <?php
                        //GEJALA YANG DIPILIH USER
                        $sk = mysqli_query($conn,"select id_gejala from hasil_konsultasi where konsultasi='$konsultasi'") or die($conn);
                        $rk = mysqli_num_rows($sk);
                        
                        while($dk = mysqli_fetch_array($sk)){
                            $sg = mysqli_query($conn,"select * from gejala where id_gejala='$dk[id_gejala]'") or die($conn);
                            $dg = mysqli_fetch_array($sg);
                            echo "<font face='Comic Sans MS, cursive' class='text-info text-left'><h5>* $dg[nama_gejala]</h5></font>";
                        }
						?>
                        </div>
                        <div class="span8 navbar-inner" style="margin-top:20px">
						<?php
                        //PROSES PENYAKIT P01
                        $s1 = mysqli_query($conn,"select * from hasil_konsultasi a where a.id_gejala IN (select b.id_gejala from penyakit_gejala b where b.kode_penyakit like 'P01%') AND konsultasi=$konsultasi");
                        $r1 = mysqli_num_rows($s1);
                        
                        echo "PROSES LOGIKA KONSULTASI";
						echo "<hr>";
						echo "Ditemukan ".$r1." Gejala Yang Sama Pada Penyakit P01, Yaitu :";
						echo "<br>";
						
						while($d1 = mysqli_fetch_array($s1)){
							if($r1>0){
								$sg1 = mysqli_query($conn,"select * from gejala where id_gejala='$d1[id_gejala]'") or die($conn);
								
								while($dg1 = mysqli_fetch_array($sg1)){
									echo "$dg1[kode_gejala], bobot = $dg1[bobot] <br>";
								}
							}
						}
						
						$ssum1 = mysqli_query($conn,"select sum(if(a.konsultasi=$konsultasi, a.bobot,0)) as j1
                                                from hasil_konsultasi a where a.id_gejala IN (select b.id_gejala from penyakit_gejala b where b.kode_penyakit like 'P01%')") or die($conn);
                        $dsum1 = mysqli_fetch_array($ssum1);
						echo "<br>a = Jumlah Bobot Untuk Penyakit P01 = $dsum1[j1]";
						
                        $proses1 = $dsum1['j1']/29;
						echo "<br>b = Total Bobot Pada P01 = 29";
						echo "<br>Rumus Similarity P01 : a/b";
						echo "<br>Similarity P01 = ".$proses1;
						echo "<br><br>";
                        
                        //PROSES PENYAKIT P02
                        $s2 = mysqli_query($conn,"select * from hasil_konsultasi a where a.id_gejala IN (select b.id_gejala from penyakit_gejala b where b.kode_penyakit like 'P02%') AND konsultasi=$konsultasi");
                        $r2 = mysqli_num_rows($s2);
                        
						echo "<br><br>";
						echo "<hr>";
						echo "Ditemukan ".$r2." Gejala Yang Sama Pada Penyakit P02, Yaitu :";
						echo "<br>";
						
						while($d2 = mysqli_fetch_array($s2)){
							if($r2>0){
								$sg2 = mysqli_query($conn,"select * from gejala where id_gejala='$d2[id_gejala]'") or die($conn);
								
								while($dg2 = mysqli_fetch_array($sg2)){
									echo "$dg2[kode_gejala], bobot = $dg2[bobot] <br>";
								}
							}
						}
						
                        $ssum2 = mysqli_query($conn,"select sum(if(a.konsultasi=$konsultasi, a.bobot,0)) as j2
                                                from hasil_konsultasi a where a.id_gejala IN (select b.id_gejala from penyakit_gejala b where b.kode_penyakit like 'P02%')") or die($conn);
                        
						$dsum2 = mysqli_fetch_array($ssum2);
						echo "<br>a = Jumlah Bobot Untuk Penyakit P02 = $dsum2[j2]";
						
                        $proses2 = $dsum2['j2']/20;
                        echo "<br>b = Total Bobot Pada P02 = 20";
						echo "<br>Rumus Similarity P02 : a/b";
						echo "<br>Similarity P02 = ".$proses2;
						echo "<br><br>";
                        
                        //PROSES PENYAKIT P03
                        $s3 = mysqli_query($conn,"select * from hasil_konsultasi a where a.id_gejala IN (select b.id_gejala from penyakit_gejala b where b.kode_penyakit like 'P03%') AND konsultasi=$konsultasi");
                        $r3 = mysqli_num_rows($s3);
                        
                        echo "<br><br>";
						echo "<hr>";
						echo "Ditemukan ".$r3." Gejala Yang Sama Pada Penyakit P03, Yaitu :";
						echo "<br>";
						
						while($d3 = mysqli_fetch_array($s3)){
							if($r3>0){
								$sg3 = mysqli_query($conn,"select * from gejala where id_gejala='$d3[id_gejala]'") or die($conn);
								
								while($dg3 = mysqli_fetch_array($sg3)){
									echo "$dg3[kode_gejala], bobot = $dg3[bobot] <br>";
								}
							}
						}
						
						$ssum3 = mysqli_query($conn,"select sum(if(a.konsultasi=$konsultasi, a.bobot,0)) as j3
                                                from hasil_konsultasi a where a.id_gejala IN (select b.id_gejala from penyakit_gejala b where b.kode_penyakit like 'P03%')") or die($conn);
                        $dsum3 = mysqli_fetch_array($ssum3);
						echo "<br>a = Jumlah Bobot Untuk Penyakit P03 = $dsum3[j3]";
						
                        $proses3 = $dsum3['j3']/21;
						echo "<br>b = Total Bobot Pada P03 = 21";
						echo "<br>Rumus Similarity P03 : a/b";
						echo "<br>Similarity P03 = ".$proses3;
						echo "<br><br>";
                        
                        //PROSES PENYAKIT P04
                        $s4 = mysqli_query($conn,"select * from hasil_konsultasi a where a.id_gejala IN (select b.id_gejala from penyakit_gejala b where b.kode_penyakit like 'P04%') AND konsultasi=$konsultasi");
                        $r4 = mysqli_num_rows($s4);
                        
						echo "<br><br>";
						echo "<hr>";
						echo "Ditemukan ".$r4." Gejala Yang Sama Pada Penyakit P04, Yaitu :";
						echo "<br>";
						
						while($d4 = mysqli_fetch_array($s4)){
							if($r4>0){
								$sg4 = mysqli_query($conn,"select * from gejala where id_gejala='$d4[id_gejala]'") or die($conn);
								
								while($dg4 = mysqli_fetch_array($sg4)){
									echo "$dg4[kode_gejala], bobot = $dg4[bobot] <br>";
								}
							}
						}
						
                        $ssum4 = mysqli_query($conn,"select sum(if(a.konsultasi=$konsultasi, a.bobot,0)) as j4
                                                from hasil_konsultasi a where a.id_gejala IN (select b.id_gejala from penyakit_gejala b where b.kode_penyakit like 'P04%')") or die($conn);
                        $dsum4 = mysqli_fetch_array($ssum4);
						echo "<br>a = Jumlah Bobot Untuk Penyakit P04 = $dsum4[j4]";
						
                        $proses4 = $dsum4['j4']/17;
                        echo "<br>b = Total Bobot Pada P04 = 17";
						echo "<br>Rumus Similarity P04 : a/b";
						echo "<br>Similarity P04 = ".$proses4;
						echo "<br><br>";
                        
						
                        //PROSES PENYAKIT P05
                        $s5 = mysqli_query($conn,"select * from hasil_konsultasi a where a.id_gejala IN (select b.id_gejala from penyakit_gejala b where b.kode_penyakit like 'P05%') AND konsultasi=$konsultasi");
                        $r5 = mysqli_num_rows($s5);
						
						echo "<br><br>";
						echo "<hr>";
						echo "Data Ditemukan ".$r5." Gejala Yang Sama Pada Penyakit P05, Yaitu :";
						echo "<br>";
						
						while($d5 = mysqli_fetch_array($s5)){
							if($r5>0){
								$sg5 = mysqli_query($conn,"select * from gejala where id_gejala='$d5[id_gejala]'") or die($conn);
								
								while($dg5 = mysqli_fetch_array($sg5)){
									echo "$dg5[kode_gejala], bobot = $dg5[bobot] <br>";
								}
							}
						}
                        
                        $ssum5 = mysqli_query($conn,"select sum(if(a.konsultasi=$konsultasi, a.bobot,0)) as j5
                                                from hasil_konsultasi a where a.id_gejala IN (select b.id_gejala from penyakit_gejala b where b.kode_penyakit like 'P05%')") or die($conn);
                        $dsum5 = mysqli_fetch_array($ssum5);
						echo "<br>a = Jumlah Bobot Untuk Penyakit P05 = $dsum5[j5]";
						
                        $proses5 = $dsum5['j5']/13;
						echo "<br>b = Total Bobot Pada P05 = 13";
						echo "<br>Rumus Similarity P05 : a/b";
						echo "<br>Similarity P05 = ".$proses5;
						echo "<br><br>";
                        
                        //PROSES PENYAKIT P06
                        $s6 = mysqli_query($conn,"select * from hasil_konsultasi a where a.id_gejala IN (select b.id_gejala from penyakit_gejala b where b.kode_penyakit like 'P06%') AND konsultasi=$konsultasi");
                        $r6 = mysqli_num_rows($s6);
                        
						echo "<br><br>";
						echo "<hr>";
						echo "Data Ditemukan ".$r6." Gejala Yang Sama Pada Penyakit P06, Yaitu :";
						echo "<br>";
						
						while($d6 = mysqli_fetch_array($s6)){
							if($r6>0){
								$sg6 = mysqli_query($conn,"select * from gejala where id_gejala='$d6[id_gejala]'") or die($conn);
								
								while($dg6 = mysqli_fetch_array($sg6)){
									echo "$dg6[kode_gejala], bobot = $dg6[bobot] <br>";
								}
							}
						}
						
                        $ssum6 = mysqli_query($conn,"select sum(if(a.konsultasi=$konsultasi, a.bobot,0)) as j6
                                                from hasil_konsultasi a where a.id_gejala IN (select b.id_gejala from penyakit_gejala b where b.kode_penyakit like 'P06%')")
                                                or die($conn);
                        $dsum6 = mysqli_fetch_array($ssum6);
						echo "<br>a = Jumlah Bobot Untuk Penyakit P06 = $dsum6[j6]";
						
                        $proses6 = $dsum6['j6']/41;
						echo "<br>b = Total Bobot Pada P06 = 41";
						echo "<br>Rumus Similarity P06 : a/b";
						echo "<br>Similarity P06 = ".$proses6;
						echo "<br><br>";
                        
						
                        //PROSES PENYAKIT P07
                        $s7 = mysqli_query($conn,"select * from hasil_konsultasi a where a.id_gejala IN (select b.id_gejala from penyakit_gejala b where b.kode_penyakit like 'P07%') AND konsultasi=$konsultasi");
                        $r7 = mysqli_num_rows($s7);
                        
						echo "<br><br>";
						echo "<hr>";
						echo "Data Ditemukan ".$r7." Gejala Yang Sama Pada Penyakit P07, Yaitu :";
						echo "<br>";
						
						while($d7 = mysqli_fetch_array($s7)){
							if($r7>0){
								$sg7 = mysqli_query($conn,"select * from gejala where id_gejala='$d7[id_gejala]'") or die($conn);
								
								while($dg7 = mysqli_fetch_array($sg7)){
									echo "$dg7[kode_gejala], bobot = $dg7[bobot] <br>";
								}
							}
						}
						
                        $ssum7 = mysqli_query($conn,"select sum(if(a.konsultasi=$konsultasi, a.bobot,0)) as j7
                                                from hasil_konsultasi a where a.id_gejala IN (select b.id_gejala from penyakit_gejala b where b.kode_penyakit like 'P07%')") or die($conn);
                        $dsum7 = mysqli_fetch_array($ssum7);
						echo "<br>a = Jumlah Bobot Untuk Penyakit P07 = $dsum7[j7]";
						
                        $proses7 = $dsum7['j7']/15;
                        echo "<br>b = Total Bobot Pada P07 = 15";
						echo "<br>Rumus Similarity P07 : a/b";
						echo "<br>Similarity P07 = ".$proses7;
						echo "<br><br>";
						
						
                        //PROSES PENYAKIT P08
                        $s8 = mysqli_query($conn,"select * from hasil_konsultasi a where a.id_gejala IN (select b.id_gejala from penyakit_gejala b where b.kode_penyakit like 'P08%') AND konsultasi=$konsultasi");
                        $r8 = mysqli_num_rows($s8);
                        
						echo "<br><br>";
						echo "<hr>";
						echo "Data Ditemukan ".$r8." Gejala Yang Sama Pada Penyakit P08, Yaitu :";
						echo "<br>";
						
						while($d8 = mysqli_fetch_array($s8)){
							if($r8>0){
								$sg8 = mysqli_query($conn,"select * from gejala where id_gejala='$d8[id_gejala]'") or die($conn);
								
								while($dg8 = mysqli_fetch_array($sg8)){
									echo "$dg8[kode_gejala], bobot = $dg8[bobot] <br>";
								}
							}
						}
						
                        $ssum8 = mysqli_query($conn,"select sum(if(a.konsultasi=$konsultasi, a.bobot,0)) as j8
                                                from hasil_konsultasi a where a.id_gejala IN (select b.id_gejala from penyakit_gejala b where b.kode_penyakit like 'P08%')") or die($conn);
                        $dsum8 = mysqli_fetch_array($ssum8);
						echo "<br>a = Jumlah Bobot Untuk Penyakit P08 = $dsum8[j8]";
						
                        $proses8 = $dsum8['j8']/24;
						echo "<br>b = Total Bobot Pada P08 = 24";
						echo "<br>Rumus Similarity P08 : a/b";
						echo "<br>Similarity P08 = ".$proses8;
						echo "<br><br>";
                        
                        //MEMBANDINGKAN NILAI SIMILARITY DAN MENGAMBIL NILAI YANG PALING TINGGI
                        $MAX = max($proses1, $proses2, $proses3, $proses4, $proses5, $proses6, $proses7, $proses8);
                        ?>
                        </div>
                        <div class="span4 navbar-inner" style="margin-top:20px">
                        <?php
						//MENAMPILKAN HASIL AKHIR
                        if($MAX==$proses1){
                            $sp = mysqli_query($conn,"select * from penyakit where kode_penyakit LIKE 'P01%'") or die($conn);
                            $dp = mysqli_fetch_array($sp);
                            $spas =  mysqli_query($conn,"select * from user where id_user='$id'") or die($conn);
                            $dpas = mysqli_fetch_array($spas);
                            
                            echo "<div class='text-info' style='margin-top:10px;'><font face='Comic Sans MS, cursive'>Anda Terdiagnosa Penyakit <b class='text-error'><u>$dp[nama_penyakit]</u></b></font></div>";
                            echo "<div style='margin-top:10px;'><font face='Comic Sans MS, cursive'>$dp[ket]</font></div>";
							echo "<div class='text-success' style='margin-top:40px;'><font face='Comic Sans MS, cursive'><b>Solusi :</b><br>$dp[solusi]</font></div>";
                            $ket = mysqli_query($conn,"insert into keterangan (id_konsultasi, nama, tgl_konsultasi, nilai, kode_penyakit) values ('$konsultasi', '$dpas[nama]', NOW(), '$MAX', '$dp[kode_penyakit]')");
                        }
                        else if($MAX==$proses2){
                            $sp = mysqli_query($conn,"select * from penyakit where kode_penyakit LIKE 'P02%'") or die($conn);
                            $dp = mysqli_fetch_array($sp);
                            $spas =  mysqli_query($conn,"select * from user where id_user='$id'") or die($conn);
                            $dpas = mysqli_fetch_array($spas);
                            
                            
                            echo "<div class='text-info' style='margin-top:10px;'><font face='Comic Sans MS, cursive'>Anda Terdiagnosa Penyakit <b class='text-error'><u>$dp[nama_penyakit]</u></b></font></div>";
                            echo "<div style='margin-top:10px;'><font face='Comic Sans MS, cursive'>$dp[ket]</font></div>";
							echo "<div class='text-success' style='margin-top:40px;'><font face='Comic Sans MS, cursive'><b>Solusi :</b><br>$dp[solusi]</font></div>";
                            $ket = mysqli_query($conn,"insert into keterangan (id_konsultasi, nama, tgl_konsultasi, nilai, kode_penyakit) values ('$konsultasi', '$dpas[nama]', NOW(), '$MAX', '$dp[kode_penyakit]')");
                        }
                        else if($MAX==$proses3){
                            $sp = mysqli_query($conn,"select * from penyakit where kode_penyakit LIKE 'P03%'") or die($conn);
                            $dp = mysqli_fetch_array($sp);
                            $spas =  mysqli_query($conn,"select * from user where id_user='$id'") or die($conn);
                            $dpas = mysqli_fetch_array($spas);
                            
                            
                            echo "<div class='text-info' style='margin-top:10px;'><font face='Comic Sans MS, cursive'>Anda Terdiagnosa Penyakit <b class='text-error'><u>$dp[nama_penyakit]</u></b></font></div>";
                            echo "<div style='margin-top:10px;'><font face='Comic Sans MS, cursive'>$dp[ket]</font></div>";
							echo "<div class='text-success' style='margin-top:40px;'><font face='Comic Sans MS, cursive'><b>Solusi :</b><br>$dp[solusi]</font></div>";
                            $ket = mysqli_query($conn,"insert into keterangan (id_konsultasi, nama, tgl_konsultasi, nilai, kode_penyakit) values ('$konsultasi', '$dpas[nama]', NOW(), '$MAX', '$dp[kode_penyakit]')");
                        }
                        else if($MAX==$proses4){
                            $sp = mysqli_query($conn,"select * from penyakit where kode_penyakit LIKE 'P04%'") or die($conn);
                            $dp = mysqli_fetch_array($sp);
                            $spas =  mysqli_query($conn,"select * from user where id_user='$id'") or die($conn);
                            $dpas = mysqli_fetch_array($spas);
                            
                            
                            echo "<div class='text-info' style='margin-top:10px;'><font face='Comic Sans MS, cursive'>Anda Terdiagnosa Penyakit <b class='text-error'><u>$dp[nama_penyakit]</u></b></font></div>";
                            echo "<div style='margin-top:10px;'><font face='Comic Sans MS, cursive'>$dp[ket]</font></div>";
							echo "<div class='text-success' style='margin-top:40px;'><font face='Comic Sans MS, cursive'><b>Solusi :</b><br>$dp[solusi]</font></div>";
                            $ket = mysqli_query($conn,"insert into keterangan (id_konsultasi, nama, tgl_konsultasi, nilai, kode_penyakit) values ('$konsultasi', '$dpas[nama]', NOW(), '$MAX', '$dp[kode_penyakit]')");
                        }
                        else if($MAX==$proses5){
                            $sp = mysqli_query($conn,"select * from penyakit where kode_penyakit LIKE 'P05%'") or die($conn);
                            $dp = mysqli_fetch_array($sp);
                            $spas =  mysqli_query($conn,"select * from user where id_user='$id'") or die($conn);
                            $dpas = mysqli_fetch_array($spas);
                            
                            
                            echo "<div class='text-info' style='margin-top:10px;'><font face='Comic Sans MS, cursive'>Anda Terdiagnosa Penyakit <b class='text-error'><u>$dp[nama_penyakit]</u></b></font></div>";
                            echo "<div style='margin-top:10px;'><font face='Comic Sans MS, cursive'>$dp[ket]</font></div>";
							echo "<div class='text-success' style='margin-top:40px;'><font face='Comic Sans MS, cursive'><b>Solusi :</b><br>$dp[solusi]</font></div>";
                            $ket = mysqli_query($conn,"insert into keterangan (id_konsultasi, nama, tgl_konsultasi, nilai, kode_penyakit) values ('$konsultasi', '$dpas[nama]', NOW(), '$MAX', '$dp[kode_penyakit]')");
                        }else if($MAX==$proses6){
                            $sp = mysqli_query($conn,"select * from penyakit where kode_penyakit LIKE 'P06%'") or die($conn);
                            $dp = mysqli_fetch_array($sp);
                            $spas =  mysqli_query($conn,"select * from user where id_user='$id'") or die($conn);
                            $dpas = mysqli_fetch_array($spas);
                            
                            
                            echo "<div class='text-info' style='margin-top:10px;'><font face='Comic Sans MS, cursive'>Anda Terdiagnosa Penyakit <b class='text-error'><u>$dp[nama_penyakit]</u></b></font></div>";
                            echo "<div style='margin-top:10px;'><font face='Comic Sans MS, cursive'>$dp[ket]</font></div>";
							echo "<div class='text-success' style='margin-top:40px;'><font face='Comic Sans MS, cursive'><b>Solusi :</b><br>$dp[solusi]</font></div>";
                            $ket = mysqli_query($conn,"insert into keterangan (id_konsultasi, nama, tgl_konsultasi, nilai, kode_penyakit) values ('$konsultasi', '$dpas[nama]', NOW(), '$MAX', '$dp[kode_penyakit]')");
                        }else if($MAX==$proses7){
                            $sp = mysqli_query($conn,"select * from penyakit where kode_penyakit LIKE 'P07%'") or die($conn);
                            $dp = mysqli_fetch_array($sp);
                            $spas =  mysqli_query($conn,"select * from user where id_user='$id'") or die($conn);
                            $dpas = mysqli_fetch_array($spas);
                            
                            
                            echo "<div class='text-info' style='margin-top:10px;'><font face='Comic Sans MS, cursive'>Anda Terdiagnosa Penyakit <b class='text-error'><u>$dp[nama_penyakit]</u></b></font></div>";
                            echo "<div style='margin-top:10px;'><font face='Comic Sans MS, cursive'>$dp[ket]</font></div>";
							echo "<div class='text-success' style='margin-top:40px;'><font face='Comic Sans MS, cursive'><b>Solusi :</b><br>$dp[solusi]</font></div>";
                            $ket = mysqli_query($conn,"insert into keterangan (id_konsultasi, nama, tgl_konsultasi, nilai, kode_penyakit) values ('$konsultasi', '$dpas[nama]', NOW(), '$MAX', '$dp[kode_penyakit]')");
                        }else if($MAX==$proses8){
                            $sp = mysqli_query($conn,"select * from penyakit where kode_penyakit LIKE 'P08%'") or die($conn);
                            $dp = mysqli_fetch_array($sp);
                            $spas =  mysqli_query($conn,"select * from user where id_user='$id'") or die($conn);
                            $dpas = mysqli_fetch_array($spas);
                            
                            
                            echo "<div class='text-info' style='margin-top:10px;'><font face='Comic Sans MS, cursive'>Anda Terdiagnosa Penyakit <b class='text-error'><u>$dp[nama_penyakit]</u></b></font></div>";
                            echo "<div style='margin-top:10px;'><font face='Comic Sans MS, cursive'>$dp[ket]</font></div>";
							echo "<div class='text-success' style='margin-top:40px;'><font face='Comic Sans MS, cursive'><b>Solusi :</b><br>$dp[solusi]</font></div>";
                            $ket = mysqli_query($conn,"insert into keterangan (id_konsultasi, nama, tgl_konsultasi, nilai, kode_penyakit) values ('$konsultasi', '$dpas[nama]', NOW(), '$MAX', '$dp[kode_penyakit]')");
                        }
                    ?>
                    </div>
                    </form>
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