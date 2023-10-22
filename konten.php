<?php
$page = "Home";
$query37 = $db->query("SELECT id_slide, gambar FROM slide WHERE aktif = 'Y' ORDER BY id_slide ASC");
$query38 = $db->query("SELECT id_slide, warna, nama_slide, judul_slide, deskripsi, link_slide FROM slide WHERE aktif = 'Y' ORDER BY id_slide ASC");
$querywelcome = $db->query("SELECT nama_toko, pin_bb, meta_keyword FROM profil");
$rowwelcome   = $querywelcome->fetch_assoc();
?>
  <!-- slider-area-start -->
  <div class="slider-area">
            <div id="slider">
                            <?php while ($rowslider = $query37->fetch_assoc()) {?>
                <img src="gambar/thumb_slide/<?=$rowslider['gambar']?>" alt="slider-img" title="#caption<?php echo $rowslider['id_slide']; ?>" />
                            <?php }?>

            </div>

            <?php while ($rowslider = $query38->fetch_assoc()) {?>
            <div class="nivo-html-caption" id="caption<?php echo $rowslider['id_slide']; ?>" >
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="slider-text">
                                <h2  style="color:<?= $rowslider['warna']; ?>" class="wow fadeInRight" data-wow-delay=".3s"><?=$rowslider['nama_slide'];?></h2>
                                <h1  style="color:<?= $rowslider['warna']; ?>" class="wow fadeInRight" data-wow-delay=".5s"><?=$rowslider['judul_slide'];?></h1>
                                <p class="wow fadeInLeft" data-wow-delay=".9s"><?=$rowslider['deskripsi'];?></p>
                                <a style="color:<?= $rowslider['warna']; ?>" class="btn btn-info" href="<?= $rowslider['link_slide']; ?>" class=" wow bounceInRight" data-wow-delay="1.5s">read more</a>
                            </div>
                        </div><!-- col -->
                    </div><!-- row -->
                </div><!-- container -->
            </div>
            <?php }?>

        </div>
        <!-- slider-area-end -->


        <!-- banner-area-start -->
			<div class="banner-area pt-80  animated wow slideInLeft" data-wow-delay=".5s">
				<div class="container">
					<div class="row">

                    <?php
							$query100       = $db->query("SELECT warna, judul_banner, keterangan, gambar, url FROM banner where aktif = 'Y'");
							while ( $row100 = $query100->fetch_assoc() ){
						?>
						<div class="col-xl-4 col-lg-4 col-md-4 col-12">
							<!-- single-banner-start -->
							<div class="single-banner mb-3">
								<div class="banner-img">
									<a href="<?php echo $row100['url']; ?>"><img src="gambar/thumb_banner/<?php echo $row100['gambar']; ?>" class="rounded" alt="banner" style="width:358px; height:250px" /></a>
								</div>
								<div class="banner-content-3 wow slideInLeft" data-wow-duration="1.0s" data-wow-delay="2s">
									<h2 style="color:<?= $row100['warna']; ?>"><?php echo $row100['judul_banner']; ?></h2>
									<!-- <h2>Clothing Originals</h2> -->
									<!-- <a href="<?php echo $row100['url']; ?>" class="text-white">view collection</a> -->
								</div>
							</div>
							<!-- single-banner-end -->
                        </div>
                        <?php } ?>
						
					</div>
				</div>
			</div>
            <!-- banner-area-end -->
            

            <!-- founder-area-start -->
        <div class="founder-area ptb-80">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="founder-description text-center fadeIndown animated" data-wow-delay="1.5s">
                            <h3 class="wow fadeIndown animated" data-wow-delay="1.5s">Kami ada untuk Anda</h3>
                            <h1>Welcome To <?= $rowwelcome['nama_toko']; ?></h1>
                            <img class="rounded" src="img/team/first-banner.jpg" alt="banner" />
                            <div class="wow zoomIn animated" data-wow-delay=".5s"><?= $rowwelcome['pin_bb']; ?></div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- founder-area-end -->

        <!-- banner-area-start -->
        <div class="container scrollmenu">

            <?php
                    $query5  = $db->prepare("SELECT kategori_produk.id_kategori,kategori_produk.kategori_seo,id_produk,nama_produk,deskripsi,produk_seo,gambar,harga,diskon,stok FROM produk LEFT JOIN subkategori_produk ON produk.id_subkategori=subkategori_produk.id_subkategori LEFT JOIN kategori_produk ON subkategori_produk.id_kategori=kategori_produk.id_kategori WHERE produk.aktif = ? ORDER BY id_produk DESC limit 8");
                    $aktif = "Y";
                    $query5->bind_param("s", $aktif);
                    $query5->execute();
                    $result5 = $query5->get_result();
                    while ( $row5 = $result5->fetch_assoc() ){
                    include "diskon.php";
                ?>
                            <div class="collection-product wow zoomIn animated" data-wow-delay=".5s">
                                <div class="collection-img">
                                    <a href="#" data-toggle="modal" data-target="#exampleModal<?= $row5['id_produk']; ?>">
                                    <img src="gambar/thumb_produk1/<?php echo $row5['gambar']; ?>" alt=""></a>
                                </div>
                                <div class="collection-content text-center">
                                    <!-- <span><?php echo $row5['stok']; ?></span> -->
                                    <h4> <?php echo $row5['nama_produk']; ?> </h4>
                                </div>
                            </div>

                            <?php } ?>

        </div>
        <!-- banner-area-end -->

        <!-- modal -->
            <?php
                    $query5  = $db->prepare("SELECT kategori_produk.id_kategori,kategori_produk.kategori_seo,id_produk,nama_produk,deskripsi,produk_seo,gambar,harga,diskon,stok FROM produk LEFT JOIN subkategori_produk ON produk.id_subkategori=subkategori_produk.id_subkategori LEFT JOIN kategori_produk ON subkategori_produk.id_kategori=kategori_produk.id_kategori WHERE produk.aktif = ? ORDER BY id_produk DESC limit 8");
                    $aktif = "Y";
                    $query5->bind_param("s", $aktif);
                    $query5->execute();
                    $result5 = $query5->get_result();
                    while ( $row5 = $result5->fetch_assoc() ){
                    include "diskon.php";
                ?>
        <div class="modal fade bd-example-modal-lg" id="exampleModal<?= $row5['id_produk']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"><?php echo $row5['nama_produk']; ?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-6"><img src="gambar/thumb_produk1/<?php echo $row5['gambar']; ?>" alt=""></div>
                                            <div class="col-md-6 ml-auto"><?php echo $row5['deskripsi']; ?></div>
                                        </div>
                                    </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                <?php } ?>
                <!-- end modal -->

        <div class="clear-fix"></div>

        <!-- Gallery -->
    <!-- Gallery -->
    <div class="container">
               <div class="text-center">
                   <h4>Galeri</h4>
               </div>

            <!-- new grid -->
            <div class="row-custom">

                    <?php
        $query1234 = $db->query("SELECT id_galeri, judul_galeri, keterangan, gambar FROM galeri WHERE aktif = 'Y' ORDER BY id_galeri DESC LIMIT 8");
        while ($row1234 = $query1234->fetch_assoc()) {
            $query12345 = $db->query("SELECT COUNT(id_foto) AS jumlah FROM foto WHERE id_galeri = '$row1234[id_galeri]'");
            $row12345 = $query12345->fetch_assoc();
            $isi_galeri         = $row1234['judul_galeri'];
            $isi                 = substr($isi_galeri,0,10); // ambil sebanyak 220 karakter
					// $isi                 = substr($isi_galeri,0,strrpos($isi," ")); // potong per spasi kalimat
            ?>
                <div class="column-grid">

                <div class="card-columns-fluid wow bounceInUp">
                <div class="card  bg-light" >
                    <img class="card-img-top"  src="gambar/thumb_galeri/<?php echo $row1234['gambar']; ?>" alt="Card image cap">

                    <div class="card-body">
                        <!-- <p class="card-title"><b><?php echo $isi.'..'; ?></b></p> -->
                        <p><?php echo $row12345['jumlah']; ?> Foto </p>
                       
                        <?php if ($row12345['jumlah'] > 0)  { ?>
                            <a href="foto-galeri-<?php echo $row1234['id_galeri']; ?>" class="btn btn-primary btn-sm">Full Details</a>
                        <?php }  else { ?>
                            <a href="#" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#fotoGaleri<?= $row1234['id_galeri']; ?>">Lihat</a>
                        <?php } ?>

                        <div class="modal fade" id="fotoGaleri<?= $row1234['id_galeri']; ?>" tabindex="-1" role="dialog" aria-labelledby="fotoGaleriLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="fotoGaleriLabel"><?php echo $row1234['judul_galeri']; ?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                    
                                            <center><img class="img-responsive" src="gambar/thumb_galeri/<?php echo $row1234['gambar']; ?>" alt=""><center>
                                            <?php echo $row1234['keterangan']; ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                    </div>
                                </div>
                                </div>
                        
                            </div>
                        </div>
                    </div>
            
                </div>
            

                <?php
                }
                ?>
            </div>
            <!-- end grid new -->

           
</div> <!--container div  -->

<div class="clear-fix"></div>

<div class="text-center mb-4">
<a href="galeri" class="btn btn-danger btn-sm wow fadeInUp animated" data-wow-delay=".7s">Lihat Semua Galeri</a>
</div>


<!-- new client -->
<section id="clients" class="section-bg">
    <div class="container">
        <div class="section-header">
            <h3>Our CLients</h3>
            <p>Meet our happy clients</p>
        </div>
       
    </div>
</section>

<div class="container scrollmenu">
        <?php
        $page = "Home";
        $query37 = $db->query("SELECT * FROM pembayaran WHERE aktif = 'Y' ORDER BY id_pembayaran ASC");
        // $query38 = $db->query("SELECT id_slide, warna, nama_slide, judul_slide, deskripsi, link_slide FROM slide WHERE aktif = 'Y' ORDER BY id_slide ASC");
        $querywelcome = $db->query("SELECT nama_toko, pin_bb, meta_keyword FROM profil");
        $rowwelcome   = $querywelcome->fetch_assoc();
        ?>
        
        <?php while ($rowslider = $query37->fetch_assoc()) {?>
                <div class="collection-product wow zoomIn animated" data-wow-delay=".5s">
                    <div class="collection-img">
                        <a href="#">
                        <img src="gambar/pembayaran/<?=$rowslider['gambar']?>" style="width:200px; height:200px;" alt=""></a>
                    </div>
                    <div class="collection-content text-center">
                        <!-- <span><?php echo $row5['stok']; ?></span> -->
                        <h4> <?php echo $row0['tag']; ?> </h4>
                    </div>
                </div>

                <?php } ?>

</div>
<!-- new client -->



<div class="clear-fix"></div>
<!-- artikel -->
    <div class="text-center">
        <h4>Artikel</h4>
    </div>


                <!-- banner-artikel-start -->
        <div class="container scrollmenu">

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
                <div class="collection-product wow zoomIn animated" data-wow-delay=".5s">
                    <div class="collection-img">
                        <a href="artikel-<?php echo $row0['id_artikel']; ?>-<?php echo $row0['judul_seo']; ?>">
                        <img src="gambar/thumb_artikel/<?php echo $row0['gambar']; ?>" style="width:250px; height:333px;" alt=""></a>
                    </div>
                    <div class="collection-content text-center">
                        <!-- <span><?php echo $row5['stok']; ?></span> -->
                        <h4> <?php echo $row0['tag']; ?> </h4>
                    </div>
                </div>

                <?php } ?>

</div>
<!-- banner-artikel-end -->


<div class="clear-fix"></div>
<!-- end artikel -->
<div class="text-center mb-4">
<a href="semua-artikel" class="btn btn-danger btn-sm wow fadeInUp animated" data-wow-delay=".7s">Lihat Semua Artikel</a>
</div>

<!-- disini artikel -->
<div class="clear-fix"></div>