<?php
	session_start();
	require "config/koneksi.php";
	
	if ( $_GET['module'] == "keranjang" && $_GET['act'] == "tambah" ){
		$sid    = session_id();
		$query1 = $db->query("SELECT stok FROM produk WHERE id_produk='$_GET[id]'");
		$row1   = $query1->fetch_assoc();
		
		if ( $row1['stok'] == 0 ){
			echo 'Stok Habis';
		} else {
			$query2  = $db->query("SELECT id_produk,jumlah FROM orders_temp WHERE id_produk='$_GET[id]' AND id_session='$sid'");
			$jumlah2 = $query2->num_rows;
			$row2    = $query2->fetch_assoc();
			$jml_stok= $row2['jumlah']+1;
			
			if ( $jumlah2 <= 0 ){
				date_default_timezone_set('Asia/Jakarta');
				$tgl = date("Y-m-d");
				$jam = date ("H:i:s");
				$db->query("INSERT INTO orders_temp (id_produk, jumlah, id_session, tgl_order_temp, jam_order_temp, stok_temp) VALUES ('$_GET[id]','1','$sid','$tgl','$jam','$row1[stok]')");
			} else {
				$db->query("UPDATE orders_temp SET jumlah='$jml_stok' WHERE id_produk='$_GET[id]' AND id_session='$sid'");
			}
			header("location:keranjang-belanja.html");
		}
	} else if ( $_GET['module'] == "keranjang" && $_GET['act'] == "kosongkan" ){
		$sid = session_id();
		$db->query("DELETE FROM orders_temp WHERE id_session='$sid'");
		header("location:index.php");
	} else if ( $_GET['module'] == "keranjang" && $_GET['act'] == "detailbeli" ){
		$sid    = session_id();
		$query1 = $db->query("SELECT stok FROM produk WHERE id_produk='$_GET[id]'");
		$row1   = $query1->fetch_assoc();
		
		if ( $row1['stok'] == 0 ){
			echo 'Stok Habis';
		} else {
			$query2  = $db->query("SELECT id_produk,jumlah FROM orders_temp WHERE id_produk='$_GET[id]' AND id_session='$sid'");
			$jumlah2 = $query2->num_rows;
			$row2    = $query2->fetch_assoc();
			$qty     = $_POST['qty'];
			$jml_stok= $row2['jumlah']+$qty;
			
			if ( $jumlah2 <= 0 ){
				date_default_timezone_set('Asia/Jakarta');
				$tgl = date("Y-m-d");
				$jam = date ("H:i:s");
				$db->query("INSERT INTO orders_temp (id_produk, jumlah, id_session, tgl_order_temp, jam_order_temp, stok_temp) VALUES ('$_GET[id]','$qty','$sid','$tgl','$jam','$row1[stok]')");
			} else {
				$db->query("UPDATE orders_temp SET jumlah='$jml_stok' WHERE id_produk='$_GET[id]' AND id_session='$sid'");
			}
			header("location:keranjang-belanja.html");
		}
	} else if ( $_GET['module'] == "keranjang" && $_GET['act'] == "update" ){
		$db->query("UPDATE orders_temp SET jumlah='$_POST[jml]' WHERE id_orders_temp='$_POST[id]'");
		header("location:keranjang-belanja.html");
	} else if ( $_GET['module'] == "keranjang" && $_GET['act'] == "hapus" ){
		$db->query("DELETE FROM orders_temp WHERE id_orders_temp='$_GET[id]'");
		header("location:keranjang-belanja.html");
	}

?>