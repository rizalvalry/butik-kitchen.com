<?php
$sql = $db->query("SELECT nama_produk from produk where id_produk='$_GET[id]'");
$j   = $sql->fetch_assoc();

if (isset($_GET['id'])){
		echo "$j[nama_produk]";
}
else{
      $sql2 = $db->query("SELECT meta_deskripsi from profil");
      $j2   = $sql2->fetch_assoc();
		  echo "$j2[meta_deskripsi]";
}
?>
