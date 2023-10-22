<?php
	require "config/koneksi.php";
	$query19       = $db->query("SELECT id_kec,nama_kec FROM kec WHERE id_kabkot='$_GET[kota]' ORDER BY nama_kec ASC");
	echo '<option value="" disabled selected> -- Pilih Kecamatan -- </option>';
	while ( $row19 = $query19->fetch_assoc() ){
		echo '<option value="'.$row19['id_kec'].'">'.$row19['nama_kec'].'</option>';
	}
?>