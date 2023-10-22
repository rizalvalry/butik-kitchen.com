	<?php
		$query55          = $db->prepare("SELECT kategori_produk.nama_kategori FROM produk LEFT JOIN subkategori_produk ON produk.id_subkategori=subkategori_produk.id_subkategori LEFT JOIN kategori_produk ON subkategori_produk.id_kategori=kategori_produk.id_kategori WHERE kategori_produk.id_kategori=? AND produk.aktif=?");
		$query55->bind_param("is", $id_subkategori55,$aktif55);
		$id_subkategori55 = $_GET['id'];
		$aktif55          = "Y";
		$query55->execute();
		$result55         = $query55->get_result();
		$row55            = $result55->fetch_assoc();
		$jumlah55         = $result55->num_rows;
		
		if ( $jumlah55 > 0 ){
		
		
	?>
	<!--breadcrumbs-->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="home"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Beranda</a></li>
				<li class="active">Terkait : <?php echo $row55['nama_kategori']; ?></li>
			</ol>
		</div>
	</div>
	<!--//breadcrumbs-->
	<!--products-->
	<div class="products">	 
		<div class="container">
			<div class="col-md-3 rsidebar">
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
				<div class="rsidebar-top" style="margin-top:2em;">
					<div class="sidebar-left">
						<h4> Cek Ongkos Kirim </h4>
						<ul class="faq">
							<li>
								<select class="form-control" name="propinsi" id="propinsi">
									<option value=""> -- Pilih Provinsi -- </option>
									<?php
										$query456       = $db->query("SELECT id_prov, nama_prov FROM prov ORDER BY nama_prov ASC");
										while ( $row456 = $query456->fetch_assoc() ){
											echo '<option value="'.$row456['id_prov'].'">'.$row456['nama_prov'].'</option>';
										}
									?>
								</select>
							</li>
							<li>
								<select class="form-control" name="kota" id="kota">
									<option value=""> -- Pilih Kabupaten/Kota -- </option>
								</select>
							</li>
							<li>
								<select class="form-control" name="kec" id="kec">
									<option value=""> -- Pilih Kecamatan -- </option>
								</select>
							</li>
							<li id="ongkos_kirim"></li>
						</ul>
					</div>		 
				</div>
				<?php
				include "config/tgl_indo.php";
				$query0                  = $db->prepare("SELECT artikel.id_artikel, artikel.judul_artikel, artikel.judul_seo, artikel.isi_artikel, artikel.gambar, artikel.dibaca, artikel.tanggal, artikel.hari FROM artikel INNER JOIN kategori_artikel ON artikel.id_kategori=kategori_artikel.id_kategori ORDER BY artikel.id_artikel DESC LIMIT 3");
				$query0->execute();
				$result0                 = $query0->get_result();
				while ( $row0            = $result0->fetch_assoc() ){
					$tanggal             = tgl_indo($row0['tanggal']);
					$isi_artikel         = $row0['isi_artikel'];
					$isi                 = substr($isi_artikel,0,110); // ambil sebanyak 220 karakter
					$isi                 = substr($isi_artikel,0,strrpos($isi," ")); // potong per spasi kalimat

				?>
				<div class="product-grids2 simpleCart_shelfItem wow fadeInUp animated" data-wow-delay=".5s">
					<div class="new-top">
						<h4 align="center">BERITA TERKINI</h4>
						<center><a href="artikel-<?php echo $row0['id_artikel']; ?>-<?php echo $row0['judul_seo']; ?>.html"><img src="gambar/thumb_artikel/<?php echo $row0['gambar']; ?>" class="img-responsive" alt=""/></a></center>
						<div class="new-text" style="color : #fff;">
							<p><?php echo $isi.' ...'; ?></p>
						</div>
					</div>
					<div class="new-bottom">
						<center><p style="font-size : 10px;">Diposting: <?php echo $row0['hari'].' ,'.$tanggal; ?>, Dibaca: <?php echo $row0['dibaca']; ?> kali</p></center>
						<h5><a class="name" href="artikel-<?php echo $row0['id_artikel']; ?>-<?php echo $row0['judul_seo']; ?>.html"><?php echo $row0['judul_artikel']; ?></a></h5><hr />
						<div class="ofr" style="margin-top : 4px;">
							<center><a href="artikel-<?php echo $row0['id_artikel']; ?>-<?php echo $row0['judul_seo']; ?>.html" class="btn btn-default btn-block">Selengkapnya</a></center>
						</div>
					</div>
				</div>
			<?php
				}
			?>
			</div>
			<div class="col-md-9 product-model-sec-custom2">
			<?php
				$batas                   = 9;
				if ( empty($_GET['halkatproduk']) ){
					$posisi              = 0;
					$_GET['halkatproduk'] = 1;
				} else if ( $_GET['halkatproduk'] > 0 ){
					$posisi              = ( $_GET['halkatproduk'] - 1 ) * $batas;
				}
				$query5                  = $db->prepare("SELECT kategori_produk.id_kategori,kategori_produk.kategori_seo,produk.id_produk,produk.nama_produk,produk.produk_seo,produk.diskon,produk.stok,produk.harga,produk.gambar FROM produk INNER JOIN subkategori_produk ON produk.id_subkategori=subkategori_produk.id_subkategori LEFT JOIN kategori_produk ON subkategori_produk.id_kategori=kategori_produk.id_kategori WHERE kategori_produk.id_kategori=? AND produk.aktif = ? ORDER BY produk.id_produk DESC limit $posisi, $batas");
				$query5->bind_param("is", $id_kategori,$aktif);
				$id_kategori             = $_GET['id'];
				$aktif                   = "Y";
				$query5->execute();
				$result5                 = $query5->get_result();
				while ( $row5 = $result5->fetch_assoc() ){
				include "diskon.php";

			?>
				<div class="product-grids3 simpleCart_shelfItem wow fadeInUp animated" data-wow-delay=".5s">
					<div class="new-top">
						<center><a href="produk-<?php echo $row5['id_produk']; ?>-<?php echo $row5['produk_seo']; ?>.html"><img src="gambar/thumb_produk1/<?php echo $row5['gambar']; ?>" class="img-responsive" alt=""/></a></center>
						<div class="new-text">
							<ul>
								<li><?php echo $tombol; ?></li>
								<li><a href="produk-<?php echo $row5['id_produk']; ?>-<?php echo $row5['produk_seo']; ?>.html">Detail </a></li>
								<li><a class="item_add" href="kategori-produk-<?php echo $row5['id_kategori']; ?>-<?php echo $row5['kategori_seo']; ?>.html">Terkait</a></li>
							</ul>
						</div>
					</div>
					<div class="new-bottom">
						<h5><a class="name" href="produk-<?php echo $row5['id_produk']; ?>-<?php echo $row5['produk_seo']; ?>.html"><?php echo $row5['nama_produk']; ?></a></h5>
						<div class="ofr">
							<?php echo $harga_barang; ?>
						</div>
					</div>
				</div>
			<?php
				}
			?>
				<div class="clearfix"></div>
				<div class="grid_3 grid_5 wow fadeInDown animated" data-wow-delay=".5s">
				<center>
					<ul class="pagination pagination-lg">
					<?php
						$query27      = $db->query("SELECT id_produk FROM produk,subkategori_produk,kategori_produk WHERE produk.id_subkategori=subkategori_produk.id_subkategori AND subkategori_produk.id_kategori=kategori_produk.id_kategori AND kategori_produk.id_kategori='$_GET[id]'");
						$row27        = $query27->num_rows;
						$jumlah_hal27 = ceil ($row27/$batas);
					?>
						<li class="<?php if ( $_GET['halkatproduk'] <= 1 ) echo "disabled"; ?>"><a href="halkatproduk-<?php echo $_GET['id']; ?>-<?php echo $_GET['halkatproduk'] - 1; ?>.html"><i class="fa fa-angle-left">«</i></a></li>
						<?php
							for ( $i = 1; $i <= $jumlah_hal27; $i++ ){
						?>
							<li class="<?php if ( $_GET['halkatproduk'] == $i ) echo "active"; ?>"><a href="halkatproduk-<?php echo $_GET['id'].'-'. $i; ?>.html"><?php echo $i; ?></a></li>
						<?php
							}
						?>
						<li class="<?php if ( $_GET['halkatproduk'] >= $jumlah_hal27 ) echo "disabled"; ?>"><a href="halkatproduk-<?php echo $_GET['id']; ?>-<?php echo $_GET['halkatproduk'] + 1; ?>.html"><i class="fa fa-angle-right">»</i></a></li>
					</ul>
				</center>
				</div>
			</div>
		</div>
	</div>
	<!--//products-->
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
			$query45 = $db->query("SELECT nama_kategori FROM kategori_produk WHERE id_kategori='$_GET[id]'");
			$row45   = $query45->fetch_assoc();
			echo '<div class="breadcrumbs">';
			echo '<div class="container">';
			echo '<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">';
			echo '<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Beranda</a></li>';
			echo '<li class="active">Belum Ada Produk Untuk Kategori : '.$row45['nama_kategori'].'</li>';
			echo '</ol>';
			echo '</div>';
			echo '</div>';
		}
	?>
			
	
	