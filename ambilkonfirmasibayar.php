<?php
	require "config/koneksi.php";
	$query107 = $db->query("SELECT rincian_pembayaran, gambar, metode_pembayaran FROM pembayaran WHERE id_pembayaran='$_GET[bayar]'");
	$row107   = $query107->fetch_assoc();
	echo '<img src="gambar/pembayaran/'.$row107['gambar'].'" /> <br/>';
	echo 'Metode Pembayaran : <b>'.$row107['metode_pembayaran'].'</b>';
	echo $row107['rincian_pembayaran'];
?>