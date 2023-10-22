	<?php
		$sid       = session_id();
		$query55   = $db->query("SELECT orders_temp.id_orders_temp,orders_temp.jumlah,produk.id_produk,produk.harga,produk.berat,produk.gambar,produk.nama_produk,produk.diskon,produk.stok FROM orders_temp,produk WHERE orders_temp.id_session='$sid' AND orders_temp.id_produk=produk.id_produk ORDER BY orders_temp.id_orders_temp DESC");
		$jumlah55 = $query55->num_rows;
		if ( $jumlah55 > 0 ){
	?>
	<!--breadcrumbs-->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
				<li class="active">Keranjang Belanja</li>
			</ol>
		</div>
	</div>
	<!--//breadcrumbs-->
	<!--cart-items-->
	<div class="cart-items">
		<div class="container">
			<h3 class="wow fadeInUp animated" data-wow-delay=".5s">Keranjang Belanja Anda (<?php echo $jumlah55; ?>)</h3>
		<?php
			$total5        = 0;
			$berat5        = 0;
			while ( $row5  = $query55->fetch_assoc() ){
			$diskon5       = ( $row5['diskon']/100 ) * $row5['harga'];
			$harga_diskon5 = number_format( ($row5['harga']-$diskon5),0,",",".");
			$subtotal5     = ( $row5['harga'] - $diskon5 ) * $row5['jumlah'];
			$sub_berat5    = $row5['berat'] * $row5['jumlah'];
			$berat5       += $sub_berat5;
			$rp_subtotal5  = number_format( $subtotal5,0,",",".");
			$total5       += $subtotal5;
			$grand_tot5    = number_format( $total5,0,",","." );
		?>
			<form method="POST" action="aksi.php?module=keranjang&act=update" class="form-horizontal">
				<input type="hidden" name="id" value="<?php echo $row5['id_orders_temp']; ?>"/>
				<div class="cart-header wow fadeInUp animated" data-wow-delay=".5s">
					<div><a href="aksi.php?module=keranjang&act=hapus&id=<?php echo $row5['id_orders_temp']; ?>" class="alert-close"></a> </div>
					<div class="cart-sec simpleCart_shelfItem">
						<div class="cart-item cyc">
							<a href="#"><img src="gambar/thumb_produk1/<?php echo $row5['gambar']; ?>" class="img-responsive" alt=""></a>
						</div>
						<div class="cart-item-info">
							<h4><a href=""><?php echo $row5['nama_produk'] ?></a><span>Harga Satuan : Rp. <?php echo $harga_diskon5; ?></span></h4>
							<ul class="qty">
								<li><p>Quantity :</p></li>
								<li>
									<p>
										<select class="form-control" name="jml" onChange="this.form.submit()">
											<?php 
												for ( $i = 1; $i <= $row5['stok']; $i++ ){
													$selected = ( $i == $row5['jumlah'] ) ? "selected" : "";
													echo '<option '.$selected.'>'.$i.'</option>';
												} 
											?>
										</select>
									</p>
								</li>
							</ul>
							<p><?php echo ( $sub_berat5 == 0 ) ? "Gratis Ongkos Kirim" : "Berat : $sub_berat5 kg"; ?></p>
							<div class="delivery">
								<h4>Total : Rp. <?php echo $rp_subtotal5; ?></h4>
								<div class="clearfix"></div>
							</div>	
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</form>
			<?php
				}
			?>
			
			<div class="cart-header wow fadeInUp animated" data-wow-delay=".5s">
					<div class="cart-sec simpleCart_shelfItem">
						<div class="cart-item">
							
						</div>
						<div class="cart-item-info">
							<div class="delivery">
								<h4>Berat Keranjang : <strong><?php echo $berat5; ?> Kg</strong></h4>
								<h4>Grand Total : Rp. <strong><?php echo $grand_tot5; ?></strong></h4>
								<a href="semua-produk.html" class="btn btn-default" style="margin : 4px;"><i class="glyphicon glyphicon-shopping-cart"></i> Lanjut Belanja ?</a>
								<?php
									if ( $_SESSION['pbemail'] != " " && $_SESSION['pblevel'] == "kustomer" ){
										echo '<a href="konfirmasi-pesanan.html" class="btn btn-primary" style="margin : 4px;">Bayar <i class="glyphicon glyphicon-share-alt"></i></a>';
									} else {
										echo '<a href="selesai-belanja.html" class="btn btn-primary" style="margin : 4px;">Bayar <i class="glyphicon glyphicon-share-alt"></i></a>';
									}
								?>
								<div class="clearfix"></div>
							</div>	
						</div>
						<div class="clearfix"></div>
						<!--collapse-tabs-->
						<div class="collpse tabs">
							<div class="panel-group collpse" id="accordion" role="tablist" aria-multiselectable="true">
								<div class="panel panel-default wow fadeInUp animated" data-wow-delay=".5s">
									<div class="panel-heading" role="tab" id="headingOne">
										<h4 class="panel-title">
											<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
											Cek Ongkos Kirim
											</a>
										</h4>
									</div>
									<div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
										<div class="panel-body">
											<div class="form-group">
												<label>Provinsi</label>
													<select class="form-control" name="propinsi" id="propinsi">
														<option value=""> -- Pilih Provinsi -- </option>
														<?php
															$query456       = $db->query("SELECT id_prov, nama_prov FROM prov ORDER BY nama_prov ASC");
															while ( $row456 = $query456->fetch_assoc() ){
																echo '<option value="'.$row456['id_prov'].'">'.$row456['nama_prov'].'</option>';
															}
														?>
													</select>
											</div>
											<div class="form-group">
												<label>Kabupaten/Kota</label>
													<select class="form-control" name="kota" id="kota">
														<option value=""> -- Pilih Kabupaten/Kota -- </option>
													</select>
											</div>
											<div class="form-group">
												<label>Kabupaten/Kota</label>
													<select class="form-control" name="kec" id="kec">
														<option value=""> -- Pilih Kecamatan -- </option>
													</select>
											</div>
											<div id="ongkos_kirim">
											
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!--//collapse -->
					</div>
				</div>
		</div>
	</div>
	<!--//cart-items-->	
	<!--//Module-select-city-->
	<script type="text/javascript">
	var htmlobjek;
	$(document).ready(function(){
	  //apabila terjadi event onchange terhadap object <select id=propinsi>
	  $("#propinsi").change(function(){
		var propinsi = $("#propinsi").val();
		$.ajax({
			url: "ambilkota.php",
			data: "propinsi="+propinsi,
			cache: false,
			success: function(msg){
				//jika data sukses diambil dari server kita tampilkan
				//di <select id=kota>
				$("#kota").html(msg);
			}
		});
	  });
	  $("#kota").change(function(){
		var kota = $("#kota").val();
		$.ajax({
			url: "ambilkecamatan.php",
			data: "kota="+kota,
			cache: false,
			success: function(msg){
				$("#kec").html(msg);
			}
		});
	  });
	  $("#kec").change(function(){
		var kec = $("#kec").val();
		var kirim = $("#kirim").val();
		$.ajax({
			url: "ambilmetodepembayaran.php",
			data: "kec="+kec,
			cache: false,
			success: function(msg){
				$("#ongkos_kirim").html(msg);
			}
		});
	  });
	});

	</script>
	<!--//end-module-select-city-->
<?php
	} else {
		echo '<div class="breadcrumbs">';
		echo '<div class="container">';
		echo '<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">';
		echo '<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>';
		echo '<li class="active">Keranjang Belanja Masih Kosong</li>';
		echo '</ol>';
		echo '</div>';
		echo '</div>';
	}
?>