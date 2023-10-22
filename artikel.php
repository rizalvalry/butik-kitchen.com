	<?php
		$query55          = $db->prepare("SELECT kategori_artikel.nama_kategori FROM artikel INNER JOIN kategori_artikel ON artikel.id_kategori=kategori_artikel.id_kategori WHERE kategori_artikel.id_kategori = ?");
		$query55->bind_param("i", $id_artikel55);
		$id_artikel55 = $_GET['id'];
		$query55->execute();
		$result55         = $query55->get_result();
		$row55            = $result55->fetch_assoc();
		$jumlah55         = $result55->num_rows;
		
		if ( $jumlah55 > 0 ){
		
		
	?>
	<!--breadcrumbs-->
	<section class="breadcrumb">
    <div class="container-fluid padding-fixed">
        <ul class="list-inline text-capitalize">
            <li><a href="home" title="Retailer - Multipurpose Responsive Shopify Theme/Template">Home<i class="fa fa-angle-right"></i></a></li>


            <li class="collection-handle"><?php echo $row55['nama_kategori']; ?></li>


        </ul>
    </div>
</section>
	<!--//breadcrumbs-->
	<!--products-->
	
		



<!-- galeri -->
<section class="list-collection-content text-center paira-gap-3 paira-gap-2">
        <div class="container-fluid padding-fixed">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="heading pull-left full-width">
                        <h1 class="page-header margin-bottom-0 text-left pull-left"><span><?php echo $row55['nama_kategori']; ?></span></h1>
                    </div>
                </div>
                
                <?php
				include "config/tgl_indo.php";
				$batas                   = 9;
				if ( empty($_GET['hallabel']) ){
					$posisi              = 0;
					$_GET['hallabel'] = 1;
				} else if ( $_GET['hallabel'] > 0 ){
					$posisi              = ( $_GET['hallabel'] - 1 ) * $batas;
				}
				$query5                  = $db->prepare("SELECT artikel.id_artikel, artikel.judul_artikel, artikel.judul_seo, artikel.isi_artikel, artikel.gambar, artikel.dibaca, artikel.tanggal, artikel.hari FROM artikel INNER JOIN kategori_artikel ON artikel.id_kategori=kategori_artikel.id_kategori WHERE kategori_artikel.id_kategori=? ORDER BY artikel.id_artikel DESC limit $posisi, $batas");
				$query5->bind_param("i", $id_artikel5);
				$id_artikel5             = $_GET['id'];
				$query5->execute();
				$result5                 = $query5->get_result();
				while ( $row5            = $result5->fetch_assoc() ){
					$tanggal             = tgl_indo($row5['tanggal']);
					$isi_artikel         = $row5['isi_artikel'];
					$isi                 = substr($isi_artikel,0,150); // ambil sebanyak 220 karakter
					$isi                 = substr($isi_artikel,0,strrpos($isi," ")); // potong per spasi kalimat

			?>
                <div class="col-sm-6 col-xs-12 margin-top-30 col-md-4">
                    <div class="collection-item position-r">
                        <a href="artikel-<?php echo $row5['id_artikel']; ?>-<?php echo $row5['judul_seo']; ?>.html" class="collec-im">
                            
                            <img src="gambar/thumb_artikel/<?php echo $row5['gambar']; ?>" data-srcset="gambar/thumb_artikel/<?php echo $row5['gambar']; ?>" data-src="gambar/thumb_artikel/<?php echo $row5['gambar']; ?>" alt="Electronics Collection" data-sizes="auto" class="lazyload blur-up img-responsive">
                            
                        </a>
                        <div class="display-collection">
                            <a href="artikel-<?php echo $row5['id_artikel']; ?>-<?php echo $row5['judul_seo']; ?>.html" class="back-link"></a>
                            <div class="collect-over">
                                <h4 class="margin-clear">
                                    <a href="artikel-<?php echo $row5['id_artikel']; ?>-<?php echo $row5['judul_seo']; ?>.html"><?php echo $row5['judul_artikel']; ?></a>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
				} ?>
                
            </div>
        </div>
    </section>


	

	<!--//products-->
	<?php
		} else {
			$query45 = $db->query("SELECT nama_kategori FROM kategori_artikel WHERE id_kategori='$_GET[id]'");
			$row45   = $query45->fetch_assoc();
			echo '<div class="breadcrumbs">';
			echo '<div class="container">';
			echo '<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">';
			echo '<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Beranda</a></li>';
			echo '<li class="active">Belum Ada Artikel Untuk Kategori : '.$row45['nama_kategori'].'</li>';
			echo '</ol>';
			echo '</div>';
			echo '</div>';
		}
	?>
			
	
	