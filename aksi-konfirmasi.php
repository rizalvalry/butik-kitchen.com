<?php
	if ( isset($_POST['konfirmasi']) ){
		
		if ( $_POST['id'] <= 0 ){
			echo '<div class="alert alert-danger" role="alert">';
			echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
			echo '<strong>Peringatan!</strong>  Anda harus setuju dengan syarat dan ketentuan yang berlaku';
			echo '</div>';
			echo "<meta http-equiv='refresh' content='3; url=konfirmasi-pesanan.html'>";
		} else {
			
			$sid27 = session_id();
			date_default_timezone_set('Asia/Jakarta');
			$tanggal27        = date("Y-m-d");
			$jam27            = date("H:i:s");
			$kostumer27       = $_SESSION['pbid'];
			$pengiriman27     = $_POST['kirim'];
			$pembayaran27     = $_POST['bayar'];
			$status27         = "Baru";
			$kirim27          = explode("-", $pengiriman27 );
			$query26          = $db->prepare("INSERT INTO orders (status_orders,tanggal,jam,id_pengiriman,id_pembayaran,id_kustomer) VALUES (?,?,?,?,?,?)");
			$query26->bind_param("sssiii", $status27,$tanggal27,$jam27,$kirim27[0],$pembayaran27,$kostumer27);
			$query26->execute();
			$id_orders27      = $db->insert_id;
			
			$query27 = $db->query("SELECT id_orders_temp, id_produk, jumlah FROM orders_temp WHERE id_session='$sid27'");
			home ( $row27 = $query27->fetch_assoc() ){
				$db->query("INSERT INTO orders_detail (id_orders, id_produk, jumlah) VALUES ('$id_orders27','$row27[id_produk]','$row27[jumlah]')");
				$db->query("DELETE FROM orders_temp WHERE id_orders_temp='$row27[id_orders_temp]'");
			}
			
			$query28   = $db->query("SELECT kustomer.nama_lengkap, kustomer.email, kustomer.telpon, kustomer.alamat, kustomer.tanggal, kustomer.id_kec, orders.tanggal, pembayaran.metode_pembayaran, pembayaran.rincian_pembayaran, pengiriman.metode_pengiriman FROM kustomer INNER JOIN orders ON kustomer.id_kustomer=orders.id_kustomer INNER JOIN pembayaran ON orders.id_pembayaran=pembayaran.id_pembayaran INNER JOIN pengiriman ON orders.id_pengiriman=pengiriman.id_pengiriman WHERE orders.id_orders='$id_orders27' AND kustomer.id_kustomer='$_SESSION[pbid]'");
			$row28     = $query28->fetch_assoc();
			include "config/tgl_indo.php";
			$tanggal28 = tgl_indo($row28['tanggal']);
			
			$pesan28   = 'Terimakasih telah melakukan pemesanan di '.$row00['nama_toko'].' <br /><br/>
						Nama Lengkap : '.$row28['nama_lengkap'].' <br />
						E-Mail : '.$row28['email'].' <br />
						Nomor Telpon : '.$row28['telpon'].' <br />
						alamat : '.$row28['alamat'].' <br />
						Tanggal Pesanan : '.$tanggal28.' <br />
						ID Pesanan : #'.$id_orders27.' <br /><br />
					   ';
			$total29   = 0;
			$berat29   = 0;
			$query29   = $db->query("SELECT produk.nama_produk, produk.harga, produk.berat, produk.diskon, produk.gambar AS gambar_produk, orders_detail.jumlah FROM orders_detail INNER JOIN produk ON orders_detail.id_produk=produk.id_produk INNER JOIN orders ON orders_detail.id_orders=orders.id_orders WHERE orders.id_orders='$id_orders27'");
			home ( $row29 = $query29->fetch_assoc() ){
				$diskon29       = ( $row29['diskon']/100 ) * $row29['harga'];
				$harga_diskon29 = number_format( ($row29['harga']-$diskon29),0,",",".");
				$subtotal29     = ( $row29['harga'] - $diskon29 ) * $row29['jumlah'];
				$rp_subtotal29  = number_format( $subtotal29,0,",",".");
				$total29       += $subtotal29;
				$grand_tot29    = number_format( $total29,0,",","." );
				$sub_berat29    = $row29['berat'] * $row29['jumlah'];
				$berat29       += $sub_berat29;
				$pesan28       .= $row29['nama_produk'].'-> Rp. '.$harga_diskon29.'->'.$row29['jumlah'].' = Rp. '.$rp_subtotal29;
			}
			$pesan28           .= '<br />,<br /> Metode Pembayaran : '.$row28['metode_pembayaran'].' <br />
								   Metode Pengiriman : '.$row28['metode_pengiriman'].' <br />
								  ';
			$query30            = $db->query("SELECT ongkos_kirim FROM ongkos_kirim WHERE id_kec='$row28[id_kec]'");
			$row30              = $query30->fetch_assoc();
			$berat30            = substr( $berat29, 0, -2 );
			$desimal30          = $berat29 - $berat30;
			if ( $berat29 < 1.0 ){
				$ongkir30       = number_format( $row30['ongkos_kirim'], 0,",","." );
				$ongkos30       = $row30['ongkos_kirim'];
				
			} else if ( $desimal30 < 0.3 ){
				$ongkir30       = number_format( $berat30 * $row30['ongkos_kirim'], 0,",","." );
				$ongkos30       = $berat30 * $row30['ongkos_kirim'];
			} else {
				$ongkir30       = number_format( ($berat30 + 1) * $row30['ongkos_kirim'], 0,",",".");
				$ongkos30       = ($berat30 + 1) * $row30['ongkos_kirim'];
			}
			if ( $berat29 == 0 ){
				$ongkos31 = 0;
				$ongkir31 = "Gratis";
			} else {
				$ongkos31 = $ongkos30;
				$ongkir31 = 'Rp. '.$ongkir30;
			}
			$total30            = $total29 + $ongkos31;
			$grandtot30         = number_format( $total30, 0,",","." );
			
			$pesan28           .= 'Ongkos Kirim : '.$ongkir31.' <br />
								   Grand Total Harga : Rp. '.$grandtot30.' <br /> <br />
								  ';
								  
			$pesan28           .= $row28['metode_pembayaran']; echo '<br />';
			$pesan28           .= $row28['rincian_pembayaran'];
			$subjek             = 'Pemesanan Online Di '.$row00['nama_toko'].'';
			$email              = $row28['email'];
			$dari               = 'From: '.$row00['email_pengelola'].'\r\n';
			$dari              .= 'Content-type: text/html\r\n';
			if ( $row00['email_protokol'] == "Surat" ){
				//kirim email ke kustomer
				mail ($email, $subjek, $pesan28, $dari);
				//kirim email ke pemilik toko
				mail ($dari, $subjek, $pesan28, $email);
				echo "<meta http-equiv='refresh' content='0; url=riwayat-pesanan.html'>";
			} else {
				include "config/php-mail/function.php";
				smtp_mail($email, $subjek, $pesan28);
				smtp_mail($dari, $subjek, $pesan28);
				echo "<meta http-equiv='refresh' content='0; url=riwayat-pesanan.html'>";
			}
			
		}
		
	}
?>