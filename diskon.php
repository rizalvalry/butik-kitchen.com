<?php
	
    // diskon  
	$harga        = number_format( $row5['harga'],0,",","." );
	$disc         = ($row5['diskon']/100)*$row5['harga'];
	$hargadisc    = number_format(( $row5['harga']-$disc),0,",","." );
	
	$cek_diskon   = $row5['diskon'];
	$harga_tetap  = '<p><span class="item_price">Rp. '.$hargadisc.'</span></p>';
	$harga_diskon = '<p class="pric1">Rp. <del>'.$harga.'</del></p>
					 <p><span class="item_price">'.$hargadisc.'</span></p>';
	if ( $cek_diskon == 0 ){
		$harga_barang = $harga_tetap;
	} else {
		$harga_barang = $harga_diskon;
	}
	
	$stok  = $row5['stok'];
	$tombolbeli = '<a class="item_add" href="aksi.php?module=keranjang&act=tambah&id='.$row5['id_produk'].'"> Beli</a>';
	$tombolhabis = '<a class="item_add" href="#" style="color:red;"> Stok Habis</a>';
	if ( $stok == 0 ){
		$tombol = $tombolhabis;
	} else {
		$tombol = $tombolbeli;
	}
   
    
    
?>
