<?php
	$query33     = $db->prepare("SELECT nama_produk FROM produk WHERE id_produk=?");
	$query33->bind_param("i", $id_produk33);
	$id_produk33 = $_GET['id'];
	$query33->execute();
	$result33    = $query33->get_result();
	$row33       = $result33->fetch_assoc();
	
	if ( isset($_GET['id']) ){
		echo $row33['nama_produk'];
	} else {
		$query44 = $db->query("SELECT meta_deskripsi FROM profil");
		$row44   = $query44->fetch_assoc();
		echo $row44['meta_deskripsi'];
	}

?>
