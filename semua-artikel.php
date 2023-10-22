<?php
		$query00 = $db->query("SELECT nomor_hp, nama_toko FROM profil");
		$rowcrumb = $query00->fetch_assoc();
		$query75  = $db->query("SELECT count(*) as jumlah from artikel");
		$row75    = $query75->fetch_assoc();
		
	?>
	
	

<!--breadcrumbs-->
<section class="breadcrumb">
    <div class="container-fluid padding-fixed">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="home"><span class="glyphicon glyphicon-home" aria-hidden="true"> Beranda /</a></li>
				<li class="active"><?php echo $row75['jumlah']; ?> artikel</li>
			</ol>
		</div>
	</section>
	<!--//breadcrumbs-->

<!-- banner-area-start -->
<div class="banner-area pt-80  animated wow slideInLeft" data-wow-delay=".5s">
				<div class="container">
					<div class="row">

                  
						
						<?php
				include "config/tgl_indo.php";
				$query0                  = $db->prepare("SELECT artikel.id_artikel, artikel.tag, artikel.judul_artikel, artikel.judul_seo, artikel.isi_artikel, artikel.gambar, artikel.dibaca, artikel.tanggal, artikel.hari FROM artikel INNER JOIN kategori_artikel ON artikel.id_kategori=kategori_artikel.id_kategori ORDER BY artikel.id_artikel DESC LIMIT 5");
				$query0->execute();
				$result0                 = $query0->get_result();
				while ( $row0            = $result0->fetch_assoc() ){
					$tanggal             = tgl_indo($row0['tanggal']);
					$isi_artikel         = $row0['isi_artikel'];
					$isi                 = substr($isi_artikel,0,50); // ambil sebanyak 220 karakter
					$isi                 = substr($isi_artikel,0,strrpos($isi," ")); // potong per spasi kalimat

			?>
						<div class="col-xl-4 col-lg-4 col-md-4 col-12">
							<!-- single-banner-start -->
							<div class="single-banner mb-3">
								<div class="banner-img">
									<a href="artikel-<?php echo $row0['id_artikel']; ?>-<?php echo $row0['judul_seo']; ?>"><img src="gambar/thumb_artikel/<?php echo $row0['gambar']; ?>" class="rounded" alt="banner" style="width:358px; height:250px" /></a>
								</div>
								<div class="banner-content-3 wow slideInLeft" data-wow-duration="1.0s" data-wow-delay="2s">
									<h2><?php echo $row0['judul_artikel']; ?></h2>
									<!-- <h2>Clothing Originals</h2> -->
									<!-- <a href="<?php echo $row0['url']; ?>" class="text-white">view collection</a> -->
								</div>
							</div>
							<!-- single-banner-end -->
                        </div>
                        <?php } ?>
						
					</div>
				</div>
			</div>
            <!-- banner-area-end -->