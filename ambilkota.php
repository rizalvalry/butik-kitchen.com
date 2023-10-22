<?php
	require "config/koneksi.php";
	$query18      = $db->query("SELECT id_kabkot,nama_kabkot FROM kabkot WHERE id_prov='$_GET[propinsi]' ORDER BY nama_kabkot ASC");
	echo '<option value="" disabled selected> -- Pilih Kabupaten/Kota -- </option>';
	while ( $row18 = $query18->fetch_assoc() ){
		echo '<option value="'.$row18['id_kabkot'].'">'.$row18['nama_kabkot'].'</option>';
	}
?>
