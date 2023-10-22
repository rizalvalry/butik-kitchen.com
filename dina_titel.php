<?php
if (isset($_GET['id'])){
    $sql = $db->query("SELECT nama_produk from produk where id_produk='$_GET[id]'");
    $row00 = $sql->fetch_assoc();
    
    if ($row00) {
        echo "$row00[nama_produk]";
    } 
    else{
      $sql2 = $db->query("SELECT nama_toko from profil");
      $j2   = $sql2->fetch_assoc();
		  echo "$j2[nama_toko]";
		}
}
else{
      $sql3 = $db->query("SELECT nama_toko from profil");
      $j3   = $sql3->fetch_assoc();
		  echo "$j3[nama_toko]";
}
?>
