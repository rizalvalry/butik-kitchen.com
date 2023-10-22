<?php
	if ( $_GET['module'] == "home" ){
		include "konten.php";
	} else if ( $_GET['module'] == "detailproduk" ){
		include "detail-produk.php";
	} else if ( $_GET['module'] == "keranjangbelanja" ){
		include "keranjang.php";
	} else if ( $_GET['module'] == "detailkategori" ){
		include "kategori.php";
	} else if ( $_GET['module'] == "kategoriproduk" ){
		include "kategori-produk.php";
	} else if ( $_GET['module'] == "semuaproduk" ){
		include "semua-produk.php";
	} else if ( $_GET['module'] == "selesaibelanja" ){
		include "login.php";
	} else if ( $_GET['module'] == "memberbaru" ){
		include "daftar.php";
	} else if ( $_GET['module'] == "konfirmasipesanan" ){
		include "konfirmasi-pesanan.php";
	} else if ( $_GET['module'] == "simpantransaksi" ){
		include "aksi-konfirmasi.php";
	} else if ( $_GET['module'] == "memberdaftar" ){
		include "memberdaftar.php";
	} else if ( $_GET['module'] == "loginmember" ){
		include "login-member.php";
	} else if ( $_GET['module'] == "akunsaya" ){
		include "akun-saya.php";
	} else if ( $_GET['module'] == "riwayatpesanan" ){
		include "riwayat-pesanan.php";
	} else if ( $_GET['module'] == "detailorder" ){
		include "detail-order.php";
	} else if ( $_GET['module'] == "katasandi" ){
		include "kata-sandi.php";
	} else if ( $_GET['module'] == "lupapassword" ){
		include "lupa-sandi.php";
	} else if ( $_GET['module'] == "profilkami" ){
		include "profil-kami.php";
	} else if ( $_GET['module'] == "portofolio" ){
		include "halaman-statis.php";
	} else if ( $_GET['module'] == "hubungikami" ){
		include "hubungi-kami.php";
	} else if ( $_GET['module'] == "detaillabel" ){
		include "artikel.php";
	} else if ( $_GET['module'] == "detailartikel" ){
		include "detail-artikel.php";
	} else if ( $_GET['module'] == "semuatestimoni" ){
		include "testimoni.php";
	} else if ( $_GET['module'] == "hasilcari" ){
		include "cari-produk.php";
	} else if ( $_GET['module'] == "daftarseller" ){
		include "daftar-seller.php";
	} else if ( $_GET['module'] == "galeri" ){
		include "galeri.php";
	} else if ( $_GET['module'] == "fotogaleri" ){
		include "foto-galeri.php";
	} else if ( $_GET['module'] == "loginseller" ){
		include "login-seller.php";
	} else if ( $_GET['module'] == "cekongkir" ){
		include "ongkir.php";
	} else if ( $_GET['module'] == "semuaartikel" ){
		include "semua-artikel.php";
	} else {
		echo "Page Not Found";
	}

?>