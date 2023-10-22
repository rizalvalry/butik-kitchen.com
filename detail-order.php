<?php 
	if( $_SESSION['pbemail'] != "" AND $_SESSION['pblevel'] == "kustomer" ){
?>
	<!--breadcrumbs-->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Beranda</a></li>
				<li class="active">Detail Pesanan</li>
			</ol>
		</div>
	</div>
	<!--//breadcrumbs-->
	<!--products-->
	<div class="products">	 
		<div class="container">
			<div class="col-md-3 rsidebar" style="margin-bottom : 8px;">
				<div class="rsidebar-top">
					<div class="sidebar-left">
						<h4> Menu </h4>
						<ul class="faq">
							<li><a href="akun-saya.html">Akun Saya</a></li>						
							<li><a href="riwayat-pesanan.html">Riwayat Pesanan</a></li>						
							<li><a href="kata-sandi.html">Ubah Kata Sandi</a></li>						
							<li><a href="keluar.php">Keluar</a></li>						
						</ul>
					</div>		 
				</div>
			</div>
			<div class="col-md-9 product-model-sec-custom">
				<div class="rsidebar-top">
					<?php
						date_default_timezone_set('Asia/Jakarta');
						$tahun = date("Y");
						include "config/tgl_indo.php";
						$query84   = $db->query("SELECT nama_lengkap, email, telpon, alamat, tanggal, id_kec FROM kustomer WHERE id_kustomer='$_SESSION[pbid]'");
						$row84     = $query84->fetch_assoc();
						$tanggal84 = tgl_indo( $row84['tanggal'] );
					?>
					<h3> Rincian Pesanan </h3><hr />
					<p>Nama Lengkap : <b><?php echo $row84['nama_lengkap']; ?></b></p>
					<p>E-Mail : <b><?php echo $row84['email'];  ?></b></p>
					<p>Nomor Telepon : <?php echo $row84['telpon'];  ?></p>
					<p>Alamat : <?php echo $row84['alamat'];  ?></p>
					<p>Tanggal Pesanan : <?php echo $tanggal84; ?></p>
					<p>ID Pesanan : #<?php echo $tahun.'-'.$_GET['id']; ?></p>
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th>NO</th>
									<th width="20%">Gambar</th>
									<th>Nama Barang</th>
									<th>Harga Satuan</th>
									<th>Jumlah</th>
									<th>Total</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$total85       = 0;
									$berat85       = 0;
									$no85          = 1;
									$sql85         = "SELECT produk.nama_produk, produk.harga, produk.berat, produk.diskon, produk.gambar AS gambar_produk, orders_detail.jumlah FROM orders_detail INNER JOIN produk ON orders_detail.id_produk=produk.id_produk INNER JOIN orders ON orders_detail.id_orders=orders.id_orders WHERE orders.id_orders='$_GET[id]'";
									$query85       = $db->query($sql85);
									while ( $row85 = $query85->fetch_assoc() ){
										$diskon85       = ( $row85['diskon']/100 ) * $row85['harga'];
										$harga_diskon85 = number_format( ($row85['harga']-$diskon85),0,",",".");
										$subtotal85     = ( $row85['harga'] - $diskon85 ) * $row85['jumlah'];
										$rp_subtotal85  = number_format( $subtotal85,0,",",".");
										$total85       += $subtotal85;
										$grand_tot85    = number_format( $total85,0,",","." );
										$sub_berat85    = $row85['berat'] * $row85['jumlah'];
										$berat85       += $sub_berat85;
										echo '<tr>';
										echo '<td>'.$no85.'</td>';
										echo '<td><img src="gambar/thumb_produk1/'.$row85['gambar_produk'].'" width="20%" height="20%" /></td>';
										echo '<td>'.$row85['nama_produk'].'</td>';
										echo '<td>Rp. '.$harga_diskon85.'</td>';
										echo '<td>'.$row85['jumlah'].'</td>';
										echo '<td>Rp. '.$rp_subtotal85.'</td>';
										echo '</tr>';
										$no85++;
									}
								
								?>
								<tr>
									<td colspan="5"> <center><strong>SubTotal Harga</strong></center></td>
									<td> <center><strong>Rp. <?php echo $grand_tot85; ?></strong></center></td>
								</tr>
									<?php
										$query86    = $db->query("SELECT pembayaran.metode_pembayaran,pembayaran.rincian_pembayaran, pembayaran.gambar AS gambar_pembayaran, pengiriman.gambar AS gambar_pengiriman, pengiriman.metode_pengiriman, ongkos_kirim.ongkos_kirim FROM orders INNER JOIN pembayaran ON orders.id_pembayaran=pembayaran.id_pembayaran INNER JOIN pengiriman ON orders.id_pengiriman=pengiriman.id_pengiriman INNER JOIN ongkos_kirim ON ongkos_kirim.id_pengiriman=pengiriman.id_pengiriman WHERE orders.id_orders='$_GET[id]' AND ongkos_kirim.id_kec='$row84[id_kec]'");
										$row86      = $query86->fetch_assoc();
										$berat86    = substr($berat85, 0, -2);
										$desimal86  = $berat85 - $berat86;
										if ( $berat85 < 1.0 ){
											$ongkos86 = $row86['ongkos_kirim'];
										} else if ( $desimal86 <0.3 ){
											$ongkos86 = $berat86 * $row86['ongkos_kirim'];
										} else {
											$ongkos86 = $berat86 * $row86['ongkos_kirim'];
										}
										if ( $berat85 == 0 ){
											$ongkos87 = 0;
											$ongkir87 = "Gratis";
										} else {
											$ongkos87 = $ongkos86;
											$ongkir87 = 'Rp. '.number_format($ongkos86, 0,",",".");
										}
										
										$total86    = $total85 + $ongkos87;
										$grandtot86 = number_format( $total86, 0,",","." );
									?>
								<tr>
									<td colspan="5"> <center>Metode Pengiriman : <strong><?php echo $row86['metode_pengiriman']; ?></strong> <img src="gambar/pengiriman/<?php echo $row86['gambar_pengiriman']; ?>" /></center></td>
									<td> <center><b><?php echo $ongkir87; ?></b></center></td>
								</tr>
								<tr>
									<td colspan="5"> <center><strong>Grand Total Harga</strong></center></td>
									<td> <center><strong>Rp. <span class="badge badge-success"><?php echo $grandtot86; ?></strong></span></center></td>
								</tr>
							</tbody>
						</table>
					</div>
					<div style="border : 1px dashed #ccc; padding : 1em;">
						<img src="gambar/pembayaran/<?php echo $row86['gambar_pembayaran']; ?>" />
						<p>Metode Pembayaran : <?php echo $row86['metode_pembayaran']; ?></p>
						<?php echo $row86['rincian_pembayaran']; ?>
					</div>
				</div>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	<!--//products-->
	<?php
	} else { 
		session_destroy();
		echo "<meta http-equiv='refresh' content='0; url=index.php'>";
		echo "<script>alert('silahkan login terlebih dahulu')</script>";
	}
	?>