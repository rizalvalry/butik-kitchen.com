<?php
	require "config/koneksi.php";
	$kirim103  = explode( "-", $_GET['kirim'] );
	$query103  = $db->query("SELECT ongkos_kirim.ongkos_kirim FROM ongkos_kirim INNER JOIN pengiriman ON ongkos_kirim.id_pengiriman=pengiriman.id_pengiriman WHERE ongkos_kirim.id_kec='$kirim103[1]' AND ongkos_kirim.id_pengiriman='$kirim103[0]'");
	$row103    = $query103->fetch_assoc();
	$berat56   = substr( $kirim103[2], 0, -2 );
	$desimal   = $kirim103[2] - $berat56;
	if ( $kirim103[2] < 1.0 ){
		$ongkir56 = $row103['ongkos_kirim'];
	} else if ( $desimal < 0.3 ){
		$ongkir56 = $row103['ongkos_kirim'] * $berat56;
	} else {
		$ongkir56 = $row103['ongkos_kirim'] * ( $berat56 + 1);
	}
	if ( $kirim103[2] == 0 ){
		$ongkir57 = $kirim103[2];
	} else {
		$ongkir57 = $ongkir56;
	}
	$harga103  = number_format( ( $ongkir57 + $kirim103[3] ), 0,",","." );
	echo $harga103;
?>