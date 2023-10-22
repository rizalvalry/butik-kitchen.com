<?php
	require "config/koneksi.php";
	$query18         = $db->query("SELECT DISTINCT pengiriman.metode_pengiriman, ongkos_kirim.ongkos_kirim, kec.nama_kec FROM ongkos_kirim INNER JOIN kec ON ongkos_kirim.id_kec=kec.id_kec INNER JOIN pengiriman ON ongkos_kirim.id_pengiriman=pengiriman.id_pengiriman WHERE kec.id_kec = '$_GET[kec]'");
	$jml18           = $query18->num_rows;
	if ( $jml18 <= 0 ){
		echo 'Ongkos kirim untuk kota tujuan Anda Belum ada';
	} else {
		echo '<ul>';
		while ( $row18   = $query18->fetch_assoc() ){
			$ongkos      = number_format( $row18['ongkos_kirim'], 0,",","." );
			echo '<li style="list-style-type: none;">'.$row18['metode_pengiriman'].' -> Rp. <b>'.$ongkos.'</b>/Kg</li>'; 
		}
		echo '</ul>';
	}	
?>