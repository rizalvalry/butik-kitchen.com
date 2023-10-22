<?php
	if( $_SESSION['email']=="" AND $_SESSION['level']=="" ){
		header('location:blank.php?eror='.md5('hendri@27').'');
	} else {
		date_default_timezone_set('Asia/Jakarta');
		switch ( $_GET['act'] ){
			default :
?>
			<form method="POST" action="" class="form-horizontal">
			<div class="row">
				<div class="col-sm-8">
				<span style="font-size : 30px;">Order</span> beranda / order
				</div>
				<div class="col-sm-4">
					<p class="pull-right">
					<button type="submit" class="btn btn-danger"  name="hapus"  data-toggle="tooltip" onClick="return confirm('Data yang sudah dihapus tidak bisa dikembalikan lagi. Apakah anda yakin ?')" title="Hapus"><i class="glyphicon glyphicon-trash"></i></button>
					<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=order';"><i class="glyphicon glyphicon-refresh"></i></button>
					</p>
				</div>
			</div>
			<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><i class="glyphicon glyphicon-list"></i>   Data Order</h4>
				</div>
				
				<div class="panel-body">	
					<?php
						if ( isset($_POST['hapus']) ){
							$id  = $_POST['id'];
							$jml = count($id);
							
							if ( $jml <= 0 ){
								
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>Peringatan!</strong> Silahkan Tandai Terlebih Dahulu Data Order Yang Akan Anda Hapus';
								echo '</div>';
								
							} else {
								for ( $i = 0; $i <= $jml; $i++ ){
									$query1   = $db->prepare("DELETE FROM orders WHERE id_orders = ?");
									$query2   = $db->prepare("DELETE FROM orders_detail WHERE id_orders = ?");
									$query1->bind_param("i", $id_order);
									$query2->bind_param("i", $id_order);
									$id_order = $id[$i];
									$query2->execute();
									$query1->execute();
									
									
								}
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> '.$jml.' Data Order Berhasil Dihapus';
								echo '</div>';
								
							}
							
						}
						
					?>
					<div class="table-responsive">	
						<table id="order" class="table table-bordered table-striped">
							<thead>
								<tr class="bg-warning">
									<th width="7%"><label><input type="checkbox" name="semua" id="semua" /></label> NO</th>
									<th>ID Order</th>
									<th>Nama Kustomer</th>
									<th>Tanggal</th>
									<th>Jam</th>
									<th>Status</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
					</div>
			</div>
			</div>
			</form>
			<?php
				break;
				case "detailorder" :
				$token  = $_GET['token'];
				$cek    = md5(md5($_GET['id']).md5('H3ndri@27'));
				if ( $cek == $token ){
			?>
			<div class="row">
				<div class="col-sm-10">
				<span style="font-size : 30px;">Produk</span> beranda / ubah produk
				</div>
				<div class="col-sm-2">
					<p class="pull-right">
						<a href="modul/order/print.php?id=<?php echo $_GET['id']; ?>&token=<?php echo $_GET['token']; ?>" target="blank" data-toggle="tooltip" title="Cetak" class="btn btn-info"><i class="glyphicon glyphicon-print"></i></a>
						<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=order&act=detailorder&id=<?php echo $_GET['id']; ?>&token=<?php echo $_GET['token']; ?>';"><i class="fa fa-refresh"></i></button>
						<button type="button" class="btn btn-danger" data-toggle="tooltip" title="Kembali" onclick="window.location.href='?module=order';"><i class="fa fa-share"></i></button>
					</p>
					
				</div>
			</div>
			<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><i class="glyphicon glyphicon-edit"></i>   Detail Order</h4>
					
				</div>
				<div class="panel-body">	 
					<?php
						
						include "../config/tgl_indo.php";
						$tgl       = date("Y-m-d");
						$tgl_skrg  = tgl_indo( $tgl );
						$tahun     = date("Y");
						$query84   = $db->query("SELECT kustomer.nama_lengkap, kustomer.email, kustomer.telpon, kustomer.alamat, kustomer.tanggal, kustomer.id_kec, orders.id_orders,orders.status_orders FROM orders INNER JOIN kustomer ON orders.id_kustomer=kustomer.id_kustomer WHERE orders.id_orders='$_GET[id]'");
						$row84     = $query84->fetch_assoc();
						$tanggal84 = tgl_indo( $row84['tanggal'] );
						$query97 = $db->query("SELECT nama_toko, alamat, nomor_hp, email_pengelola, gambar FROM profil");
						$row97   = $query97->fetch_assoc();
					?>
						<div class="row">				
							<section class="content invoice">
								<!-- title row -->
								<div class="row">
									<div class="col-xs-12">
										<h2 class="page-header">
											<img src="../gambar/toko/<?php echo $row97['gambar']; ?>">
											<small class="pull-right">Tanggal : <?php echo $tgl_skrg; ?></small>
										</h2>
									</div><!-- /.col -->
								</div>
								<!-- info row -->
								<div class="row invoice-info">
									<div class="col-sm-4 invoice-col">
										Dari :
										<address>
											<strong>Administrator.</strong><br>
											<?php echo $row97['nama_toko']; ?><br>
											<?php echo $row97['alamat']; ?><br>
											<?php echo 'Telepon : '.$row97['nomor_hp'];?><br/>
											<?php echo 'E-Mail : '.$row97['email_pengelola']; ?>
										</address>
									</div><!-- /.col -->
									<div class="col-sm-4 invoice-col">
										Untuk : 
										<address>
											<strong><?php echo $row84['nama_lengkap']; ?></strong><br>
											<?php echo $row84['alamat']; ?><br>                                
											<?php echo 'Telpon : '.$row84['telpon'];?><br/>
											<?php echo 'E-Mail : '.$row84['email'];?>
										</address>
									</div><!-- /.col -->
									<div class="col-sm-4 invoice-col">
										<form method="POST" action="">
										<?php
											
											if ( $_POST['status_order']  == "Lunas"  ){
												$id = $_POST['id'];
												$status = $_POST['status_order'];
												$db->query("UPDATE produk,orders_detail SET produk.stok = produk.stok - orders_detail.jumlah WHERE produk.id_produk=orders_detail.id_produk AND orders_detail.id_orders = '$id'");
												$db->query("UPDATE produk,orders_detail SET produk.dibeli = produk.dibeli + orders_detail.jumlah WHERE produk.id_produk=orders_detail.id_produk AND orders_detail.id_orders = '$id'");
												$db->query("UPDATE orders SET status_orders = '$status' WHERE id_orders = '$id'");
												
											} else if ( $_POST['status_order'] == "Batal" ){
												$id = $_POST['id'];
												$status = $_POST['status_order'];
												$db->query("UPDATE produk,orders_detail SET produk.stok = produk.stok + orders_detail.jumlah WHERE produk.id_produk=orders_detail.id_produk AND orders_detail.id_orders = '$id'");
												$db->query("UPDATE produk,orders_detail SET produk.dibeli = produk.dibeli - orders_detail.jumlah WHERE produk.id_produk=orders_detail.id_produk AND orders_detail.id_orders = '$id'");
												$db->query("UPDATE orders SET status_orders = '$status' WHERE id_orders = '$id'");
												
											} else {
												$id = $_POST['id'];
												$status = $_POST['status_order'];
												$db->query("UPDATE orders SET status_orders = '$status' WHERE id_orders = '$id'");
												
											}
										?>
											<input type="hidden" value="<?php echo $row84['id_orders']; ?>" name="id" />
											<b>Invoice : <?php echo '#'.$tahun.'-'.$row84['id_orders']; ?></b><br/>
											<b>Status Order</b> : 
											<select onChange="this.form.submit()" name="status_order">
												<?php 
													$status = array('','Baru','DP','Lunas','Batal');
													for ( $i = 1; $i <= 4; $i++ ){
														$pilih = ($row84['status_orders'] == $status[$i]) ? "selected disabled" : "";
														echo '<option value="'.$status[$i].'" '.$pilih.'>'.$status[$i].'</option>';
													}
												?>
											</select>
										</form>
									</div><!-- /.col -->
								</div><!-- /.row -->
						</section>
					</div>
					<div class="row">	
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
											echo '<td ><img src="../gambar/thumb_produk1/'.$row85['gambar_produk'].'" width="20%" height="20%" /></td>';
											echo '<td>'.$row85['nama_produk'].'</td>';
											echo '<td >Rp. '.$harga_diskon85.'</td>';
											echo '<td>'.$row85['jumlah'].'</td>';
											echo '<td>Rp. '.$rp_subtotal85.'</td>';
											echo '</tr>';
											$no85++;
										}
									
									?>
									<tr>
										<td colspan="5"> <center><strong>SubTotal Harga</strong></center></td>
										<td> <center>Rp.<strong> <?php echo $grand_tot85; ?></strong></center></td>
									</tr>
										<?php
											$query86    = $db->query("SELECT pembayaran.rincian_pembayaran, pembayaran.gambar AS gambar_pembayaran, pengiriman.gambar AS gambar_pengiriman, ongkos_kirim.ongkos_kirim, pengiriman.metode_pengiriman, pembayaran.metode_pembayaran FROM orders INNER JOIN pembayaran ON orders.id_pembayaran=pembayaran.id_pembayaran INNER JOIN pengiriman ON orders.id_pengiriman=pengiriman.id_pengiriman INNER JOIN ongkos_kirim ON ongkos_kirim.id_pengiriman=pengiriman.id_pengiriman WHERE orders.id_orders='$_GET[id]' AND ongkos_kirim.id_kec='$row84[id_kec]'");
											$row86      = $query86->fetch_assoc();
											
											$berat86    = substr($berat85, 0, -2);
											$desimal86  = $berat85 - $berat86;
											if ( $berat85 < 1.0 ){
												$ongkir86 = number_format( $row86['ongkos_kirim'], 0,",","." );
												$ongkos86 = $row86['ongkos_kirim'];
											} else if ( $desimal86 < 0.3 ){
												$ongkir86 = number_format( $row86['ongkos_kirim'] * $berat86, 0,",","." );
												$ongkos86 = $row86['ongkos_kirim'] * $berat86;
											} else {
												$ongkir86 = number_format( $row86['ongkos_kirim'] * ($berat86 +1), 0,",","." );
												$ongkos86 = $row86['ongkos_kirim'] * ($berat86 + 1);
											}
											if ( $berat85 == 0  ){
												$ongkir89 = "Gratis";
												$ongkos89 = 0;
											} else {
												$ongkir89 = 'Rp. '.$ongkir86;
												$ongkos89 = $ongkos86;
											}
											$total86    = $total85 + $ongkos89;
											$grandtot86 = number_format( $total86, 0,",","." );
										?>
									<tr>
										<td colspan="5"> <center>Metode Pengiriman : <strong><?php echo $row86['metode_pengiriman']; ?></strong> <img src="../gambar/pengiriman/<?php echo $row86['gambar_pengiriman']; ?>" /></center></td>
										<td> <center><?php echo $ongkir89; ?></center></td>
									</tr>
									<tr>
										<td colspan="5"> <center><strong>Grand Total Harga</strong></center></td>
										<td> <center>Rp.<strong style="background-color : green; color :#fff; padding : 2px;"> <?php echo $grandtot86; ?></strong></center></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div style="border : 1px dashed #ccc; padding : 1em;">
							<img src="../gambar/pembayaran/<?php echo $row86['gambar_pembayaran']; ?>" />
							<p>Metode Pembayaran : <?php echo $row86['metode_pembayaran']; ?></p>
							<?php echo $row86['rincian_pembayaran']; ?>
						</div>
					</div>
				</div>
			</div>
			</div>
<?php
				} else {
					echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
					echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
					echo '<strong>PERINGATRANN!</strong> Anda Tidak Boleh Iseng-Iseng Dengan URL :p';
					echo '</div>';
				}
		}
	}
?>
