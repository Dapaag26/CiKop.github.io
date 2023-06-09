<?php
//buka koneksi ke engine MySQL
	$Open = mysql_connect("localhost","root","");
		if (!$Open){
		die ("Koneksi ke Engine MySQL Gagal !<br>");
		}
//koneksi ke database
	$Koneksi = mysqli_select_db("koperasi_new");
		if (!$Koneksi){
		die ("Koneksi ke Database Gagal !");
		}
?>