<?php 
	if( $_SESSION['pbnama'] != "" AND $_SESSION['pblevel'] == "kustomer" ){
?>
	<!--breadcrumbs-->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Beranda</a></li>
				<li class="active">Konfirmasi Pesanan</li>
			</ol>
		</div>
	</div>
	<!--//breadcrumbs-->
	<!--Short codes-->
	<div class="codes">
		<div class="container">
		<?php
			$sid55          = session_id();
			$query55        = $db->query("SELECT orders_temp.tgl_order_temp,orders_temp.id_orders_temp,orders_temp.jumlah,produk.id_produk,produk.harga,produk.berat,produk.gambar,produk.nama_produk,produk.diskon,produk.stok FROM orders_temp,produk WHERE orders_temp.id_session='$sid55' AND orders_temp.id_produk=produk.id_produk ORDER BY orders_temp.id_orders_temp DESC");
			$jumlah55       = $query55->num_rows;
			if ( $jumlah55 <=  0 ){
				echo '<h3>Keranjang Belanja Masih Kosong</h3>';
			} else {
		?>
			<div class="title-info wow fadeInUp animated" data-wow-delay=".5s">
				<h3 class="title">Konfirmasi<span> Pesanan</span></h3>
			</div>
			<form method="POST" action="simpan-transaksi.html">
				<!--collapse-tabs-->
				<div class="collpse tabs">
					<div class="panel-group collpse" id="accordion" role="tablist" aria-multiselectable="true">
						<div class="panel panel-default wow fadeInUp animated" data-wow-delay=".5s">
							<div class="panel-heading" role="tab" id="headingOne">
								<h4 class="panel-title">
									<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
									Pesanan
									</a>
								</h4>
							</div>
							<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
								<div class="panel-body">
								<?php
									include "config/tgl_indo.php";
									$email51   = $_SESSION['pbemail'];
									$query51   = $db->query("SELECT nama_lengkap,alamat,email,telpon,id_kec FROM kustomer WHERE email='$email51'");
									$row51     = $query51->fetch_assoc();
									
									$query52   = $db->query("SELECT orders_temp.tgl_order_temp FROM orders_temp,produk WHERE orders_temp.id_session='$sid55' AND orders_temp.id_produk=produk.id_produk ORDER BY orders_temp.id_orders_temp DESC");
									$row52     = $query52->fetch_assoc();
									$tanggal   = tgl_indo( $row52['tgl_order_temp'] );
									
		
								?>
									<h3 class="hdg">Pesanan Anda ( <?php echo $jumlah55; ?> )</h3>
									<p>Nama Lengkap : <b><?php echo $row51['nama_lengkap']; ?></b></p>
									<p>Email : <b><?php echo $row51['email']; ?></b></p>
									<p>No Telepon : <?php echo $row51['telpon']; ?></p>
									<p>Alamat : <?php echo $row51['alamat']; ?></p>
									<p>Tanggal Pesanan : <?php echo $tanggal; ?></p>
									<div class="table-responsive">
										<table class="table table-bordered">
											<thead>
												<tr>
													<th>N0</th>
													<th>Gambar Barang</th>
													<th>Nama Barang</th>
													<th>Harga Satuan</th>
													<th>Jumlah </th>
													<th>Total</th>
												</tr>
											</thead>
											<tbody>
											<?php
												$no           = 1;
												$total5       = 0;
												$berat5       = 0;
												while ( $row5 = $query55->fetch_assoc() )
												{
													$diskon5       = ( $row5['diskon']/100 ) * $row5['harga'];
													$harga_diskon5 = number_format( ($row5['harga']-$diskon5),0,",",".");
													$subtotal5     = ( $row5['harga'] - $diskon5 ) * $row5['jumlah'];
													$rp_subtotal5  = number_format( $subtotal5,0,",",".");
													$total5       += $subtotal5;
													$subberat5     = $row5['jumlah'] * $row5['berat'];
													$grand_tot5    = number_format( $total5,0,",","." );
													$sub_berat5    = $row5['berat'] * $row5['jumlah'];
													$berat5       += $sub_berat5;
													
											?>
													<tr>
														<td><?php echo $no; ?></td>
														<td><img src="gambar/thumb_produk1/<?php echo $row5['gambar']; ?>" width="15%" height="15%" class="img-responsive" /></td>
														<td><?php echo $row5['nama_produk']; ?> ( <i><?php echo ( $subberat5 == 0) ? "Gratis Ongkos Kirim" : "Berat $subberat5 kg" ; ?> </i>)</td>
														<td>Rp. <?php echo $harga_diskon5; ?></td>
														<td><center><?php echo $row5['jumlah']; ?></center></td>
														<td>Rp. <?php echo $rp_subtotal5; ?></td>
													</tr>
											<?php
													$no++;
												}
											?>
												<tr>
													<td colspan="5"><center><b>Total Harga</b></center></td>
													<td ><center>Rp. <b><span class="badge badge-success"><?php echo $grand_tot5; ?></span></b></center></td>
												</tr>
											</tbody>
										</table>                    
									</div>
									<?php
										$query56  = $db->prepare("SELECT ongkos_kirim.ongkos_kirim,pengiriman.id_pengiriman,pengiriman.metode_pengiriman FROM ongkos_kirim RIGHT JOIN pengiriman ON ongkos_kirim.id_pengiriman=pengiriman.id_pengiriman WHERE pengiriman.aktif=? AND ongkos_kirim.id_kec=? ORDER BY urutan ASC");
										$query56->bind_param("si", $aktif56,$id_kec56);
										$aktif56  = "Y";
										$id_kec56 = $row51['id_kec'];
										$query56->execute();
										$result56 = $query56->get_result();
										$jml56 = $result56->num_rows;
										if ( $jml56 > 0 ){
									?>
									<p class="pull-right"><a role="button" class="btn btn-primary" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseOne">Lanjutkan</a></p>
									<?php
													} else {
														echo '<p class="pull-right"><a class="collapsed btn btn-primary" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseTwo">Lanjutkan</a></p>';
													}
									?>
								</div>
							</div>
						</div>
						<?php
							if ( $jml56 > 0 ){
						?>
						<div class="panel panel-default wow fadeInUp animated" data-wow-delay=".6s">
							<div class="panel-heading" role="tab" id="headingTwo">
								<h4 class="panel-title">
									<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
									   Metode Pengiriman
									</a>
								</h4>
							</div>
							<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
								<div class="panel-body">
									<div class="col-md-4">
										<div class="form-group">
											<label> Pilih Metode Pengiriman : </label>
											<select name="kirim" id="kirim" class="form-control" required>
												<option value="" disabled selected> Pilih Jasa Pengiriman </option>
												<?php
													
													while ( $row56 = $result56->fetch_assoc() ){
														$berat56   = substr( $berat5, 0, -2 );
														$desimal   = $berat5 - $berat56;
														if ( $berat5 < 1.0 AND $berat5 > 0 ){
															$ongkir56 = number_format( $row56['ongkos_kirim'] , 0, ",", ".");
														} else if ( $desimal < 0.3 ){
															$ongkir56 = number_format( $row56['ongkos_kirim'] * $berat56 , 0, ",", ".");
														} else {
															$ongkir56 = number_format( $row56['ongkos_kirim'] * ( $berat56 + 1) , 0, ",", ".");
														}
														if ( $berat5 == 0 ){
															$ongkir80 = "Gratis";
														} else {
															$ongkir80 = 'Rp. '.$ongkir56;
														}
														echo '<option value="'.$row56['id_pengiriman'].'-'.$id_kec56.'-'.$berat5.'-'.$total5.'" > '.$row56['metode_pengiriman'].' ( '.$ongkir80.' ) </option>';
													}
												?>
											</select>
										</div>
										<div class="form-group">
											<a class="collapsed btn btn-primary" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseTwo">Lanjutkan</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php
							}
						?>
						<div class="panel panel-default wow fadeInUp animated" data-wow-delay=".7s">
							<div class="panel-heading" role="tab" id="headingThree">
								<h4 class="panel-title">
									<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
										Metode Pembayaran
									</a>
								</h4>
							</div>
							<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
								<div class="panel-body">
									<div class="col-md-3">
										<div class="form-group">
											<label><strong>Pilih Metode Pembayaran : </strong></label>
											<select name="bayar" id="bayar" class="form-control" required>
												<option value="" disabled selected> Pilih Bank Transfer</option>
												<?php
													$query57 = $db->query("SELECT id_pembayaran,metode_pembayaran FROM pembayaran WHERE aktif = 'Y' AND total_minimum <= '$total5' ORDER BY urutan ASC ");
													while ( $row57 = $query57->fetch_assoc() ){
														echo '<option value="'.$row57['id_pembayaran'].'">'.$row57['metode_pembayaran'].'</option>';
													}
												?>
											</select>
										</div>
										<div class="form-group">
											<a class="collapsed btn btn-primary" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseThree">Lanjutkan</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="panel panel-default wow fadeInUp animated" data-wow-delay=".8s">
							<div class="panel-heading" role="tab" id="headingFour">
								<h4 class="panel-title">
									<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
										Konfirmasi Pesanan
									</a>
								</h4>
							</div>
							<div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
								<div class="panel-body">
								<?php						
									$query58   = $db->query("SELECT orders_temp.tgl_order_temp,orders_temp.id_orders_temp,orders_temp.jumlah,produk.id_produk,produk.harga,produk.berat,produk.gambar,produk.nama_produk,produk.diskon,produk.stok FROM orders_temp,produk WHERE orders_temp.id_session='$sid55' AND orders_temp.id_produk=produk.id_produk ORDER BY orders_temp.id_orders_temp DESC");
									$jumlah58  = $query55->num_rows;
								?>
									<h3 class="hdg">Pesanan Anda ( <?php echo $jumlah58; ?> )</h3>
									<p>Nama Lengkap : <?php echo $row51['nama_lengkap']; ?></p>
									<p>Alamat &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $row51['alamat']; ?></p>
									<p>Email &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $row51['email']; ?></p>
									<p>No Telepon &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $row51['telpon']; ?></p>
									<p>Tanggal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $tanggal; ?></p>
									<div class="table-responsive">
										<table class="table table-bordered">
											<thead>
												<tr>
													<th>N0</th>
													<th>Gambar Barang</th>
													<th>Nama Barang</th>
													<th>Harga Satuan</th>
													<th>Jumlah </th>
													<th>Total</th>
												</tr>
											</thead>
											<tbody>
											<?php
												$no58           = 1;
												$total58        = 0;
												while ( $row58  = $query58->fetch_assoc() )
												{
													$diskon58       = ( $row58['diskon']/100 ) * $row58['harga'];
													$harga_diskon58 = number_format( ($row58['harga']-$diskon58),0,",",".");
													$subtotal58     = ( $row58['harga'] - $diskon58 ) * $row58['jumlah'];
													$rp_subtotal58  = number_format( $subtotal58,0,",",".");
													$subberat85     = $row58['jumlah'] * $row58['berat'];
													$total58       += $subtotal58;
													$grand_tot58    = number_format( $total58,0,",","." );
											?>
												<tr>
													<td><?php echo $no58; ?></td>
													<td><img src="gambar/thumb_produk1/<?php echo $row58['gambar']; ?>" width="15%" height="15%" class="img-responsive" /></td>
													<td><?php echo $row58['nama_produk']; ?> ( <i><?php echo ( $subberat85 == 0) ? "Gratis Ongkos Kirim" : "Berat $subberat85 kg" ; ?> </i>)</td>
													<td>Rp. <?php echo $harga_diskon58; ?></td>
													<td><center><?php echo $row58['jumlah']; ?></center></td>
													<td>Rp. <?php echo $rp_subtotal58; ?></td>
												</tr>
											<?php
													$no++;
												}
											?>
												<tr>
													<td colspan="5"><center><b>Total Harga</b></center></td>
													<td ><center>Rp. <b><?php echo $grand_tot5; ?></b></center></td>
												</tr>
												<?php
													if ( $jml56 > 0 ) {
												?>
												<tr id="data_ongkir">
												</tr>
												<tr>
													<td colspan="5"><center><b>Grand Total Harga</b></center></td>
													<td ><center>Rp. <b><span class="badge badge-success" id="data_harga"></span></b></center></td>
												</tr>
												<?php
													} else {
														echo '<tr>
													<td colspan="5"><center><b>Grand Total Harga</b></center></td>
													<td ><center>Rp. <b>< class="badge badge-success">'.$grand_tot5.'</span></b></center></td>
												</tr>';
													}
												?>
											</tbody>
										</table>                    
									</div>
									<div style="border : 1px dashed #ccc; padding : 1em; margin-bottom : 8px;" id="data_konfirm" ></div>
									<p class="pull-right"><label>Saya setutuju dengan syarat dan ketentuan yang berlaku <input type="checkbox" id="id" name="id[]" value="1" onclick="run();" /></label>  <button type="submit" name="konfirmasi" id="cb" class="btn btn-primary" disabled>Konfirmasi Pesanan</button></p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--//collapse -->
			</form>
		<?php
			}
		?>
		</div>
	</div>
	<!--//short-codes-->	
	<!--//ambil data pengiriman dan pembayaran-->	
	<script type="text/javascript">
    	var htmlobjek;
    	$(document).ready(function(){
    		$("#kirim").change(function(){
				var kirim = $("#kirim").val();
    			$.ajax({
					url: "ambilongkir.php",
					data: "kirim="+kirim,
					cache: false,
					success: function(msg){
						$("#data_ongkir").html(msg);
					}
				});
			});
			
			$("#kirim").change(function(){
				var kirim = $("#kirim").val();
    			$.ajax({
					url: "ambiltotharga.php",
					data: "kirim="+kirim,
					cache: false,
					success: function(msg){
						$("#data_harga").html(msg);
					}
				});
			});
						
			$("#bayar").change(function(){
				var bayar = $("#bayar").val();
    			$.ajax({
					url: "ambilkonfirmasibayar.php",
					data: "bayar="+bayar,
					cache: false,
					success: function(msg){
						$("#data_konfirm").html(msg);
					}
				});
			});
		});

    </script>
	<script type="text/javascript">
		function run(){
			var cb = document.getElementById("cb");
	 
			if(document.getElementById("id").checked == true){
				cb.disabled = false;
			}else{
				cb.disabled = true;
			}
	 
		}
	</script>
<?php
	} else { 
		session_destroy();
		echo "<meta http-equiv='refresh' content='0; url=index.php'>";
		echo "<script>alert('silahkan login terlebih dahulu')</script>";
	}
?>
