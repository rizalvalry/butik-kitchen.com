<?php
if (isset($_GET['id'])){
	$query77     = $db->prepare("SELECT nama_produk FROM produk WHERE id_produk=?");
	$query77->bind_param("i", $id_produk77);
	$id_produk77 = $_GET['id'];
	$query77->execute();
	$result77    = $query77->get_result();
	$row77       = $result77->fetch_assoc();
    if ( $row77 ) {
        echo $row77['nama_produk'];
    } else {
		$query88 = $db->query("SELECT nama_toko FROM profil");
		$row88   = $query88->fetch_assoc();
		echo $row88['nama_toko'];
	}
} else {
	$query99 = $db->query("SELECT nama_toko FROM profil");
	$row99   = $query99->fetch_assoc();
	echo $row99['nama_toko'];
}
?>