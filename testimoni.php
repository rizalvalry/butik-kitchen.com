	<!--breadcrumbs-->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Beranda</a></li>
				<li class="active">Testimoni</li>
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
						<h4> Kategori Produk </h4>
						<ul class="faq">
						<?php
							$query56 = $db->query("SELECT id_kategori,nama_kategori FROM kategori_produk ORDER BY nama_kategori ASC");
							while ( $row56   = $query56->fetch_assoc() ){
						?>
							<li class="item1"><a href="#"><?php echo $row56['nama_kategori']; ?><span class="glyphicon glyphicon-menu-down"></span></a>
								<ul>
								<?php
									$query57 = $db->query("SELECT id_subkategori,nama_subkategori,subkategori_seo FROM subkategori_produk WHERE id_kategori='$row56[id_kategori]' ORDER BY nama_subkategori ASC");
									while ( $row57 = $query57->fetch_assoc() ){
										echo '<li class="subitem1"><a href="kategori-'.$row57['id_subkategori'].'-'.$row57['subkategori_seo'].'.html">'.$row57['nama_subkategori'].'</a></li>';
									}
								?>																		
								</ul>
							</li>
						<?php
							}
						?>
						</ul>
						<!-- script for tabs -->
						<script type="text/javascript">
							$(function() {
							
								var menu_ul = $('.faq > li > ul'),
									   menu_a  = $('.faq > li > a');
								
								menu_ul.hide();
							
								menu_a.click(function(e) {
									e.preventDefault();
									if(!$(this).hasClass('active')) {
										menu_a.removeClass('active');
										menu_ul.filter(':visible').slideUp('normal');
										$(this).addClass('active').next().stop(true,true).slideDown('normal');
									} else {
										$(this).removeClass('active');
										$(this).next().stop(true,true).slideUp('normal');
									}
								});
							
							});
						</script>
						<!-- script for tabs -->
					</div>		 
				</div>
				<?php 
					$query17 = $db->query("SELECT produk.id_produk,produk.nama_produk,produk.produk_seo,produk.gambar,produk.harga,produk.stok,produk.diskon FROM produk ORDER BY dibeli DESC LIMIT 3");
					while ( $row17 = $query17->fetch_assoc() ){
					$harga17        = number_format( $row17['harga'],0,",","." );
					$disc17         = ($row17['diskon']/100)*$row17['harga'];
					$hargadisc17    = number_format(( $row17['harga']-$disc17),0,",","." );
					
					$cek_diskon17   = $row17['diskon'];
					$harga_tetap17  = 'Rp. '.$hargadisc17.'';
					$harga_diskon17 = 'Rp. <del>'.$harga17.'</del>  '.$hargadisc17.'';
					if ( $cek_diskon17 == 0 ){
						$harga_barang17 = $harga_tetap17;
					} else {
						$harga_barang17 = $harga_diskon17;
					}
					
					$stok17     = $row17['stok'];
					$tombolbeli17 = '<a class="item_add" href="aksi.php?module=keranjang&act=tambah&id='.$row17['id_produk'].'"><span class="glyphicon glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></a>';
					$tombolhabis17 = '<a class="item_add" href="#"><span class="glyphicon glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></a>';
					if ( $stok17 == 0 ){
						$tombol17 = $tombolhabis17;
					} else {
						$tombol17 = $tombolbeli17;
					}
				?>
				<div class="gallery-grid">
					<h6>PRODUK TERLARIS</h6>
					<a href="produk-<?php echo $row17['id_produk']; ?>-<?php echo $row17['produk_seo']; ?>.html"><img src="gambar/thumb_produk1/<?php echo $row17['gambar']; ?>" class="img-responsive" alt=""/></a>
					<div class="gallery-text simpleCart_shelfItem">
						<h5><a class="name" href="produk-<?php echo $row17['id_produk']; ?>-<?php echo $row17['produk_seo']; ?>.html"><?php echo $row17['nama_produk']; ?></a></h5>
						<p><span class="item_price"><?php echo $harga_barang17; ?></span></p>
						<ul>
							<li><a href="produk-<?php echo $row17['id_produk']; ?>-<?php echo $row17['produk_seo']; ?>.html"><span class="glyphicon glyphicon-globe" aria-hidden="true"></span></a></li>
							<li><?php echo $tombol17; ?></li>
							<li><a href="#"><span class="glyphicon glyphicon glyphicon-heart-empty" aria-hidden="true"></span></a></li>
						</ul>
					</div>
				</div>
				<?php
					}
				?>
			</div>
			<div class="col-md-9 product-model-sec-custom1">
				<div class="rsidebar-top">
					<?php
						include "config/tgl_indo.php";
						$batas      = 10;
						if ( empty( $_GET['haltestimoni'] ) ) {
							$posisi=0;
							$_GET['haltestimoni']=1;	
						} else if ( $_GET['haltestimoni'] > 0 ) {
							$posisi = ( $_GET['haltestimoni'] - 1 ) * $batas;
						}
						$query123       = $db->query("SELECT nama_lengkap, alamat, tanggal, testimoni FROM testimoni WHERE aktif = 'Y' ORDER BY id_testimoni DESC LIMIT $posisi,$batas");
						while ( $row123 = $query123->fetch_assoc() ){
						$tanggal        = tgl_indo( $row123['tanggal'] );
					?>
						<div class="row" style="background-color : #f2f2f2; border-radius : 0% 10px 0 0; box-shadow: -4px -4px 3px #918e8e; padding : 12px; margin-bottom : 15px;">
							<div class="col-md-1">
								<img src="images/poto.jpg" />
							</div>
							<div class="col-md-11">
								<p><?php echo $row123['testimoni']; ?> </p>
								<i><p style="font-size : 10px;"><?php echo $row123['nama_lengkap'].' | '.$row123['alamat'].' | '.$tanggal; ?></p></i>
							</div>
						</div><hr/>
					<?php
						}
					?>
					<div class="row">
						<center>
							<ul class="pagination pagination-lg">
							<?php
								$query127      = $db->query("SELECT id_testimoni FROM testimoni");
								$row127        = $query127->num_rows;
								$jumlah_hal127 = ceil ( $row127 / $batas);
							?>
								<li class="<?php if ( $_GET['haltestimoni'] <= 1 ) echo "disabled"; ?>"><a href="haltestimoni-<?php echo $_GET['haltestimoni'] - 1; ?>.html"><i class="fa fa-angle-left">«</i></a></li>
								<?php
									for ( $i = 1; $i <= $jumlah_hal127; $i++ ){
								?>
									<li class="<?php if ( $_GET['haltestimoni'] == $i ) echo "active"; ?>"><a href="haltestimoni-<?php echo $i; ?>.html"><?php echo $i; ?></a></li>
								<?php
									}
								?>
								<li class="<?php if ( $_GET['haltestimoni'] >= $jumlah_hal127 ) echo "disabled"; ?>"><a href="haltestimoni-<?php echo $_GET['haltestimoni'] + 1; ?>.html"><i class="fa fa-angle-right">»</i></a></li>
							</ul>
						</center>
					</div>
					<div class="row">
						<form method="POST" action="">					
							<h4 style="color : #FF590F;"><b>TAMBAH TESTIMONI</b></h4>
							<hr />
							<?php
								if ( isset($_POST['tambah']) ){
									date_default_timezone_set('Asia/Jakarta');
									$nama81        = $_POST['nama'];
									$alamat81      = $_POST['alamat'];
									$testi81       = $_POST['testimoni'];
									$kode81        = $_POST['kode'];
									$aktif81       = "Y";
									$tanggal81     = date("Y-m-d");
									if ( empty($nama81) ){
										echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
										echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
										echo '<strong>Peringatan!</strong>  Nama Lengkap Tidak Boleh Kosong';
										echo '</div>';
									} else if ( empty($testi81) ){
										echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
										echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
										echo '<strong>Peringatan!</strong>  Testimoni Tidak Boleh Kosong';
										echo '</div>';
									} else if ( empty($alamat81) ){
										echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
										echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
										echo '<strong>Peringatan!</strong>  Alamat Tidak Boleh Kosong';
										echo '</div>';
									}else if ( !preg_match("/^[a-zA-Z .,]*$/",$nama81) ){
										echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
										echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
										echo '<strong>Peringatan!</strong>  Nama Lengkap Tidak Boleh Mengandung Angka dan Katakter';
										echo '</div>';
									} else if ( empty($kode81) ){
										echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
										echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
										echo '<strong>Peringatan!</strong>  Hasil Hitung Tidak Boleh Kosong';
										echo '</div>';
									} else {
										if ( $kode81 == $_SESSION['key'] ){
											$query81 = $db->prepare("INSERT INTO testimoni (nama_lengkap, alamat, testimoni, tanggal, aktif) VALUES (?,?,?,?,?)");
											$query81->bind_param("sssss", $nama81, $alamat81, $testi81, $tanggal81, $aktif81);
											$query81->execute();
											echo '<div class="alert alert-info" role="alert">';
											echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
											echo '<strong>SUKSES!</strong> Data berhasil diubah, Anda akan keluar secara otomatis dari akun Anda. Silahkan masuk kembali';
											echo '</div>';
											session_destroy();
											echo "<meta http-equiv='refresh' content='1; url=semua-testimoni.html'>";
										} else {
											echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
											echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
											echo '<strong>Peringatan!</strong>  Hasil Hitung Yang Anda Masukan Salah';
											echo '</div>';
										}
									}
								}
							?>
								<div class="form-group">
									<label>Nama Lengkap</label>
									<input type="text" name="nama" class="form-control" value="<?php echo isset($nama81) ? $nama81 : ""; ?>" maxlength="50" placeholder="Nama Lengkap" required />
								</div>
								<div class="form-group">
									<label>Alamat</label>
									<input type="text" name="alamat" class="form-control" value="<?php echo isset($alamat81) ? $alamat81 : ""; ?>" maxlength="150" placeholder="Alamat" required  />
								</div>
								<div class="form-group">
									<label>Testimoni</label>
									<textarea name="testimoni" class="form-control" rows="8" placeholder="Isi Testimoni" required><?php echo isset($testi81) ? $testi81 : ""; ?></textarea>
								</div>
								<div class="form-group">
									<img src="captcha/captcha.php" />
								</div>
								<div class="form-group">
									<input type="text" name="kode" class="form-control"  maxlength="5" placeholder="Masukan Hasil Matematika Diatas" required  />
								</div>
								<div class="form-group">
									<button type="submit" name="tambah" class="btn btn-primary btn-block">TAMBAH</button>
								</div>
						</form>
					</div>
				</div>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	<!--//products-->