<?php
	require "../../../config/koneksi.php";
	include "../../../config/tgl_indo.php";
	date_default_timezone_set('Asia/Jakarta');
	$token  = $_GET['token'];
	$cek    = md5(md5($_GET['id']).md5('H3ndri@27'));
	if ( $cek == $token ){
		$query1 = $db->query("SELECT gambar, nama_toko, alamat, email_pengelola, nomor_hp FROM profil");
		$row1   = $query1->fetch_assoc();
		$query2 = $db->query("SELECT kustomer.nama_lengkap, kustomer.alamat, kustomer.telpon, kustomer.email, kustomer.id_kec, orders.tanggal, orders.id_orders, orders.status_orders FROM orders,kustomer WHERE orders.id_kustomer=kustomer.id_kustomer AND orders.id_orders = '$_GET[id]'");
		$row2   = $query2->fetch_assoc();
		$tgl    = date("Y-m-d");
		$tgl_sk = tgl_indo( $tgl );
		$tahun  = date("Y");
?>
		<style type="text/css">
			.tabel td {
				border : 1px dashed #ccc;
			}
		</style>
		<body onLoad="javascript:window.print()">
			<div style="width:100%; margin:auto;">
				<table align="center" width="90%" cellspacing="0" cellpadding="5">
					<tr>
						<td>
							<img src="../../../gambar/toko/<?php echo $row1['gambar']; ?>" width="50px" height="50px" />
						</td>
						<td>
							<center>
								<b>Kwitansi Pembayaran <?php echo $row1['nama_toko']; ?></b> <br/>
								Alamat : <?php echo $row1['alamat']; ?>, Tlp. <?php echo $row1['nomor_hp']; ?>, E-Mail : <?php echo  $row1['email_pengelola']; ?>
							</center>
						</td>
					</tr>
					<tr>
						<td></td>
					</tr>
				</table><hr />
				<table align="center" width="90%" cellspacing="0" cellpadding="5">
					<tr>
						<td rowspan="5">	
							Dari : <b>Administrator</b><br/>
							<?php echo $row1['nama_toko']; ?><br />						
							<?php echo $row1['alamat']; ?><br />	
							Telpon : <?php echo $row1['nomor_hp']; ?><br/>
							E-Mail : <?php echo $row1['email_pengelola']; ?>
						</td>
						<td>
							Untuk : <b><?php echo $row2['nama_lengkap']; ?></b><br/>
							<?php echo $row2['alamat']; ?><br/>
							Telpon : <?php echo $row2['telpon']; ?><br/>
							E-Mail : <?php echo $row2['email']; ?><br/>
							&nbsp;
						
						</td>
						<td>
							<b>Invoice : #<?php echo $tahun.'-'.$row2['id_orders']; ?></b><br/>
							Status Pesanan : <b><?php echo $row2['status_orders']; ?></b><br />
							Tanggal Pesanan : <?php echo $tgl_sk; ?><br/>
							&nbsp;<br/>
							&nbsp;
						</td>
					</tr>
				</table>
				<table align="center" width="90%" cellspacing="0" cellpadding="5" class="tabel">
					<tr>
						<th>No</th>
						<th>Gambar Barang</th>
						<th>Nama Barang</th>
						<th>Harga Satuan</th>
						<th>Jumlah</th>
						<th>Total</th>
					</tr>
					<?php
						$total3       = 0;
						$berat3       = 0;
						$no3          = 1;
						$sql3         = "SELECT produk.nama_produk, produk.harga, produk.berat, produk.diskon, produk.gambar AS gambar_produk, orders_detail.jumlah FROM orders_detail INNER JOIN produk ON orders_detail.id_produk=produk.id_produk INNER JOIN orders ON orders_detail.id_orders=orders.id_orders WHERE orders.id_orders='$_GET[id]'";
						$query3       = $db->query($sql3);
						while ( $row3 = $query3->fetch_assoc() ){
							$diskon3       = ( $row3['diskon']/100 ) * $row3['harga'];
							$harga_diskon3 = number_format( ($row3['harga']-$diskon3),0,",",".");
							$subtotal3     = ( $row3['harga'] - $diskon3 ) * $row3['jumlah'];
							$rp_subtotal3  = number_format( $subtotal3,0,",",".");
							$total3       += $subtotal3;
							$grand_tot3    = number_format( $total3,0,",","." );
							$sub_berat3    = $row3['berat'] * $row3['jumlah'];
							$berat3       += $sub_berat3;
							echo '<tr>';
							echo '<td>'.$no3.'</td>';
							echo '<td ><img src="../../../gambar/thumb_produk1/'.$row3['gambar_produk'].'" width="20%" height="20%" /></td>';
							echo '<td>'.$row3['nama_produk'].'</td>';
							echo '<td >Rp. '.$harga_diskon3.'</td>';
							echo '<td>'.$row3['jumlah'].'</td>';
							echo '<td>Rp. '.$rp_subtotal3.'</td>';
							echo '</tr>';
							$no3++;
						}
					?>
					<tr>
						<td colspan="5"> <center><strong>SubTotal Harga</strong></center></td>
						<td> <center>Rp.<strong> <?php echo $grand_tot3; ?></strong></center></td>
					</tr>
						<?php
							$query4    = $db->query("SELECT pembayaran.rincian_pembayaran, pembayaran.gambar AS gambar_pembayaran, pengiriman.gambar AS gambar_pengiriman, ongkos_kirim.ongkos_kirim, pengiriman.metode_pengiriman, pembayaran.metode_pembayaran FROM orders INNER JOIN pembayaran ON orders.id_pembayaran=pembayaran.id_pembayaran INNER JOIN pengiriman ON orders.id_pengiriman=pengiriman.id_pengiriman INNER JOIN ongkos_kirim ON ongkos_kirim.id_pengiriman=pengiriman.id_pengiriman WHERE orders.id_orders='$_GET[id]' AND ongkos_kirim.id_kec='$row2[id_kec]'");
							$row4      = $query4->fetch_assoc();
							$berat4    = substr($berat3, 0, -2);
							$desimal4  = $berat3 - $berat4;
							if ( $berat3 < 1.0 ){
								$ongkos4   = $row4['ongkos_kirim'];
								$ongkir4   = number_format( $ongkos4, 0,",","." );
							} else if ( $desimal4 < 0.3 ){
								$ongkos4   = $row4['ongkos_kirim'] * $berat4;
								$ongkir4   = number_format( $ongkos4, 0,",","." );
							} else {
								$ongkos4   = $row4['ongkos_kirim'] * ($berat4 + 1);
								$ongkir4   = number_format( $ongkos4, 0,",","." );
							}
							if ( $berat3 == 0 ){
								$ongkos5   = 0;
								$ongkir5   = "Gratis";
							} else {
								$ongkos5   = $ongkos4;
								$ongkir5   = 'Rp. <b>'.$ongkir4.'</b>';
							}
							$total4    = $total3 + $ongkos5;
							$grandtot4 = number_format( $total4, 0,",","." );
						?>
					<tr>
						<td colspan="5"> <center>Metode Pengiriman : <strong><?php echo $row4['metode_pengiriman']; ?></strong></center></td>
						<td> <center><?php echo $ongkir5; ?></center></td>
					</tr>
					<tr>
						<td colspan="5"> <center><strong>Grand Total Harga</strong></center></td>
						<td> <center>Rp.<strong> <?php echo $grandtot4; ?></strong></center></td>
					</tr>
				</table>
				<div style="width:88%; margin:auto; margin-top:8px; border : 1px dashed #ccc; padding : 8px;">
					<img src="../../../gambar/pembayaran/<?php echo $row4['gambar_pembayaran']; ?>" />
					<p>Metode Pembayaran : <?php echo $row4['metode_pembayaran']; ?></p>
					<?php echo $row4['rincian_pembayaran']; ?>
				</div>
			</div>
		</body>
<?php
	} else {
		echo "";
	}

?>