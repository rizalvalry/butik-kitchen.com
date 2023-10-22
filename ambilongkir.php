<?php
	require "config/koneksi.php";
	$kirim102  = explode( "-", $_GET['kirim'] );
	$query102  = $db->query("SELECT ongkos_kirim.ongkos_kirim, pengiriman.metode_pengiriman, pengiriman.gambar FROM ongkos_kirim INNER JOIN pengiriman ON ongkos_kirim.id_pengiriman=pengiriman.id_pengiriman WHERE ongkos_kirim.id_kec='$kirim102[1]' AND ongkos_kirim.id_pengiriman='$kirim102[0]'");
	$row102    = $query102->fetch_assoc();
	$berat102  = substr( $kirim102[2], 0, -2 );
	$desimal102 = $kirim102[2] - $berat102;
	if ( $kirim102[2] < 1.0 ){
		$ongkir102 = number_format( $row102['ongkos_kirim'], 0, ",",".");
	} else if ( $desimal102 < 0.3 ){
		$ongkir102 = number_format( $berat102 * $row102['ongkos_kirim'], 0, ",",".");
	} else {
		$ongkir102 = number_format( ( $berat102 + 1 ) * $row102['ongkos_kirim'], 0, ",",".");
	}
	if ( $kirim102[2] == 0 ){
		$ongkir1021 = "<b>Gratis</b>";
	} else {
		$ongkir1021 = 'Rp. '. $ongkir102;
	}
	echo '	<td colspan="5"><center>Metode Pengiriman : <b>'.$row102['metode_pengiriman'].'</b>  <img src="gambar/pengiriman/'.$row102['gambar'].'" /></center></td>;
			<td ><center>'.$ongkir1021.'</center></td>';
?>