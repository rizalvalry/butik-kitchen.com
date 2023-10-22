<?php
	session_start();
	if( $_SESSION['email'] == "" AND $_SESSION['level'] == "" ){
		header('location:../blank.php?eror='.md5('hendri@27').'');
	} else {
		include "class.ezpdf.php";
		require "../../../config/koneksi.php";
		require "../../../config/tgl_indo.php";
		if(isset($_POST['cetak'])){
			date_default_timezone_set('Asia/Jakarta');
			$dari    	= $_POST['dari'];
			$sampai     = $_POST['sampai'];
			$tgl_dari	= tgl_indo($_POST['dari']);
			$tgl_sampai = tgl_indo($_POST['sampai']);
			$query7     = $db->query("SELECT nama_toko FROM profil");
			$row7       = $query7->fetch_assoc();
			$tahun      = date("Y");
			$id         = $_SESSION['id'];
			$pdf        = new Cezpdf();
			$query123   = $db->query("SELECT nama_lengkap FROM user WHERE id_user = '$id'");
			$row123     = $query123->fetch_assoc();
			 
			// Set margin dan font
			$pdf->ezSetCmMargins(3, 3, 3, 3);
			$pdf->selectFont('fonts/Courier.afm');

			$all = $pdf->openObject();

			// Tampilkan logo
			$pdf->setStrokeColor(0, 0, 0, 1);
			$pdf->addJpegFromFile('logo.jpg',20,800,69);

			// Teks di tengah atas untuk judul header
			$pdf->addText(220, 820, 16,'<b>Laporan Penjualan '.$row123['nama_lengkap'].'</b>');
			$pdf->addText(180, 800, 14,'<b>Toko Online '.$row7['nama_toko'].' </b>');
			// Garis atas untuk header
			$pdf->line(10, 795, 578, 795);

			// Garis bawah untuk footer
			$pdf->line(10, 50, 578, 50);
			// Teks kiri bawah
			$pdf->addText(30,34,8,'Dicetak tgl:' . date( 'd-m-Y, H:i:s'));

			$pdf->closeObject();

			// Tampilkan object di semua halaman
			$pdf->addObject($all, 'all');

			$no       = 1;
			$total17  = 0;
			$query17  = $db->query("SELECT orders.id_orders,orders.tanggal,
						produk.nama_produk,orders_detail.jumlah,produk.harga,produk.diskon
						FROM orders, orders_detail, produk, user  
						WHERE orders.id_orders=orders_detail.id_orders AND produk.id_produk=orders_detail.id_produk AND produk.id_user=user.id_user AND user.id_user = '$id' AND
						orders.status_orders= 'Lunas' AND orders.tanggal BETWEEN '$dari' AND '$sampai'");
			$jml = $query17->num_rows;

			if ($jml > 0){
				$i = 1;
				while ( $row17 = $query17->fetch_assoc() ) {
					$tanggal   = tgl_indo($row17['tanggal']);
					$diskon17       = ( $row17['diskon']/100 ) * $row17['harga'];
					$harga_diskon17 = number_format( ($row17['harga']-$diskon17),0,",",".");
					$subtotal17     = ( $row17['harga'] - $diskon17 ) * $row17['jumlah'];
					$rp_subtotal17  = number_format( $subtotal17,0,",",".");
					$total17       += $subtotal17;
					$grand_tot17    = number_format( $total17,0,",","." );
					
					$data[$i]=array('<b>No</b>'=>$i, 
								  '<b>Faktur</b>'=>'#'.$tahun.'-'.$row17['id_orders'], 
								  '<b>Tanggal</b>'=>$tanggal, 
								  '<b>Nama Produk</b>'=>$row17['nama_produk'], 
								  '<b>Qty</b>'=>$row17['jumlah'], 
								  '<b>Harga</b>'=>$harga_diskon17,
								  '<b>Sub Total</b>'=>$rp_subtotal17);
					$i++;
				}

				$pdf->ezTable($data, '', '', '');
				$pdf->ezText("\n\nTotal keseluruhan : Rp. {$grand_tot17}");
				$pdf->ezText("\nJumlah yang terjual : {$jml} unit");

				// Penomoran halaman
				$pdf->ezStartPageNumbers(320, 15, 8);
				$pdf->ezStream();
			} else {
				echo 'Tidak ada transaksi pada tanggal '.$dari.' sampai '.$sampai.'';
		}
	}
	}
?>
