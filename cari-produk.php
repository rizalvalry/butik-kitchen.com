<?php 
	if( $_SESSION['pbnama'] != "" AND $_SESSION['pblevel'] == "kustomer" ){
?>

<?php
	$kata = trim( $_POST['kata'] );
	// mencegah XSS
	$kata = htmlentities( htmlspecialchars( $kata ), ENT_QUOTES );
	// pisahkan kata per kalimat lalu hitung jumlah kata
	$pisah_kata       = explode(" ", $kata);
	$jml_katakan      = (integer) count( $pisah_kata );
	$jml_kata         = $jml_katakan - 1;
	for ( $i = 0; $i <= $jml_kata; $i++ ){
		$sql5         = "SELECT kategori_produk.id_kategori,kategori_produk.kategori_seo,produk.id_produk,produk.nama_produk,produk.produk_seo,produk.diskon,produk.stok,produk.harga,produk.gambar FROM produk LEFT JOIN subkategori_produk ON produk.id_subkategori=subkategori_produk.id_subkategori LEFT JOIN kategori_produk ON subkategori_produk.id_kategori=kategori_produk.id_kategori WHERE produk.deskripsi LIKE '%$pisah_kata[$i]%' OR produk.nama_produk LIKE '%$pisah_kata[$i]%' ORDER BY produk.id_produk DESC limit 9";
	}
	$query5           = $db->query($sql5);
	$jml5             = $query5->num_rows;
	if ( $jml5 > 0 ){
	
?>
	<!--breadcrumbs-->
	<section class="breadcrumb">
    <div class="container-fluid padding-fixed">
        <ul class="list-inline text-capitalize">
            <li><a href="home" title="Retailer - Multipurpose Responsive Shopify Theme/Template">Home<i class="fa fa-angle-right"></i></a></li>


            <li class="collection-handle"><?php echo $row55['nama_subkategori']; ?></li>


        </ul>
    </div>
</section>
	<!--//breadcrumbs-->

	
<div id="shopify-section-collection-template" class="shopify-section collection-section collection-section--collectionsection"><!--=================== Collection Template ===================-->
	<main id="collectionsection--collection-template" class="collection-page collection-template paira-sticky-root" data-section-id="collection-template" data-section-type="collection-template">
    <!--=================== Collections Product Section ===================-->
    <section class="collection-content paira-gap-2">
            <div class="container-fluid padding-clear">

                <a href="all.html" class="display-in-b full-width"></a>

            </div>
            <div class="container-fluid padding-fixed">
                <div class="row">
                    <aside id="sidebar" class="sidebar col-md-3 col-lg-3 col-sm-12 col-xs-12 paira-gap-3" style="float: right;">

                    <div class="filter-product paira-filter-product">



						<?php
$query56 = $db->query("SELECT id_kategori,nama_kategori FROM kategori_produk ORDER BY nama_kategori ASC");
    while ($row56 = $query56->fetch_assoc()) {
        ?>
						<div class="panel-group margin-clear collection-widget-list" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="filter">
                                <h2 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#filter<?php echo $row56['id_kategori']; ?>" aria-expanded="true" aria-controls="filter<?php echo $row56['id_kategori']; ?>">
									<?php echo $row56['nama_kategori']; ?>
                                    </a>
                                </h2>
                            </div>
                            <div id="filter<?php echo $row56['id_kategori']; ?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="filter">
                                <div class="panel-body">
                                    <ul class="list-unstyled margin-clear">

									<?php
							$query57 = $db->query("SELECT id_subkategori,nama_subkategori,subkategori_seo FROM subkategori_produk WHERE id_kategori='$row56[id_kategori]' ORDER BY nama_subkategori ASC");
									while ($row57 = $query57->fetch_assoc()) {?>
																	<li><a href="electronics-collection.html" class="paira-filter-category "><?php echo $row57['nama_subkategori']; ?></a></li>
																<?php }?>


																</ul>
															</div>
														</div>
													</div>
													</div>
													<?php
							}
								?>

					<!-- <div class="panel-group margin-clear" id="accordion5" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="price">
                                <h2 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion5" href="#price_1" aria-expanded="true" aria-controls="price_1">
                                        Cek Ongkir
                                    </a>
                                </h2>
                            </div>
                            <div id="price_1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="price">
                                <div class="panel-body">
                                    <ul class="list-inline margin-clear">




                                        <label><input type="checkbox" name="under-150" id="under-150" value="under-150" class="paira-filter-checkbox"> under $150</label>




                                        <label><input type="checkbox" name="150-300" id="150-300" value="150-300" class="paira-filter-checkbox"> $150 - $300</label>





                                    </ul>
                                </div>
                            </div>
                        </div>
                        </div> -->


                        <div class="panel-group margin-clear" id="accordion6" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="type">
                                <h2 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion6" href="#type_1" aria-expanded="true" aria-controls="type_1">
                                        Shop By Type
                                    </a>
                                </h2>
                            </div>
                            <div id="type_1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="type">
                                <div class="panel-body">
                                    <ul class="list-inline margin-clear">


                                    </ul>
                                </div>
                            </div>
                        </div>
                        </div>



                    </div>


                    <figure class="margin-bottom-30 small-products">
                        <figcaption><h4 class="panel-heading padding-bottom-0">Terbaru & Terlaris</h4></figcaption>


                        <div class="product-widget">
                            <div class="products-wrapper">

							<?php
$query17 = $db->query("SELECT produk.id_produk,produk.nama_produk,produk.produk_seo,produk.gambar,produk.harga,produk.stok,produk.diskon FROM produk ORDER BY dibeli DESC LIMIT 3");
    while ($row17 = $query17->fetch_assoc()) {
        $harga17 = number_format($row17['harga'], 0, ",", ".");
        $disc17 = ($row17['diskon'] / 100) * $row17['harga'];
        $hargadisc17 = number_format(($row17['harga'] - $disc17), 0, ",", ".");

        $cek_diskon17 = $row17['diskon'];
        $harga_tetap17 = 'Rp. ' . $hargadisc17 . '';
        $harga_diskon17 = 'Rp. <del>' . $harga17 . '</del>  ' . $hargadisc17 . '';
        if ($cek_diskon17 == 0) {
            $harga_barang17 = $harga_tetap17;
        } else {
            $harga_barang17 = $harga_diskon17;
        }

        $stok17 = $row17['stok'];
        $tombolbeli17 = '<a class="item_add" href="aksi.php?module=keranjang&act=tambah&id=' . $row17['id_produk'] . '"><span class="glyphicon glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></a>';
        $tombolhabis17 = '<a class="item_add" href="#"><span class="glyphicon glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></a>';
        if ($stok17 == 0) {
            $tombol17 = $tombolhabis17;
        } else {
            $tombol17 = $tombolbeli17;
        }
        ?>
				<!-- start loop -->
                                <div class="col-md-12 col-sm-4 col-xs-12 margin-top-15 padding-clear">
                                    <!--=================== Product ===================-->
                                    <div class="paira-product product img">
                                        <div class="overflow-h pro-im position-r col-md-3 col-sm-3 col-xs-3 padding-clear" data-value="0">
                                            <a href="produk-<?php echo $row17['id_produk']; ?>-<?php echo $row17['produk_seo']; ?>.html" class="overflow-h">
                                                <img src="gambar/thumb_produk1/<?php echo $row17['gambar']; ?>" class="paira-product-image img-responsive full-width main-product lazyload blur-up" alt="LATUDE Men's Casual Denim Short" data-srcset="gambar/thumb_produk1/<?php echo $row17['gambar']; ?>" data-src="gambar/thumb_produk1/<?php echo $row17['gambar']; ?>" data-sizes="auto">
                                            </a>
                                            <div class="sale-stock">
                                            </div>
                                        </div>
                                        <div class="product-title-price col-md-9 col-sm-9 col-xs-9 padding-right-0 padding-left-15 padding-top-0">


                                            <div class="pro-reating margin-top-0 margin-bottom-5">
                                                <div class="paira-rating-con product-rating">
                                                    <span class="shopify-product-reviews-badge" data-id="2609387077717"></span>
                                                </div>
                                            </div>


                                            <h5 class="margin-bottom-0 vendor margin-top-0">Sisa <?php echo $row17['stok']; ?></h5>
                                            <h2 class="margin-top-5 margin-bottom-0"><a href="produk-<?php echo $row17['id_produk']; ?>-<?php echo $row17['produk_seo']; ?>.html" title="LATUDE Men's Casual Denim Short" class="paira-product-title"> <?php echo $row17['nama_produk']; ?></a></h2>
                                            <div class="text-left margin-top-5">

                                                <span class="money"><?php echo $harga_barang17; ?></span>

                                            </div>
                                        </div>
                                    </div>
								</div>
								<?php
}
    ?>
								<!-- end loop -->

                            </div>
                        </div>

                    </figure>


					<?php
include "config/tgl_indo.php";
    $query0 = $db->prepare("SELECT artikel.id_artikel, artikel.judul_artikel, artikel.judul_seo, artikel.isi_artikel, artikel.gambar, artikel.dibaca, artikel.tanggal, artikel.hari FROM artikel INNER JOIN kategori_artikel ON artikel.id_kategori=kategori_artikel.id_kategori ORDER BY artikel.id_artikel DESC LIMIT 2");
    $query0->execute();
    $result0 = $query0->get_result();
    while ($row0 = $result0->fetch_assoc()) {
        $tanggal = tgl_indo($row0['tanggal']);
        $isi_artikel = $row0['isi_artikel'];
        $isi = substr($isi_artikel, 0, 110); // ambil sebanyak 220 karakter
        $isi = substr($isi_artikel, 0, strrpos($isi, " ")); // potong per spasi kalimat

        ?>
                    <a href="all.html" class="display-in-b margin-bottom-0">
					<h4 align="center">Hot News</h4>
						<center><a href="artikel-<?php echo $row0['id_artikel']; ?>-<?php echo $row0['judul_seo']; ?>.html"><img src="gambar/thumb_artikel/<?php echo $row0['gambar']; ?>" class="img-responsive" alt=""/></a></center>
						<div class="new-text" style="color : #fff;">
							<p><?php echo $isi . ' ...'; ?></p>
						</div>
					</a>
					<?php
}
    ?>

                    </aside>

                    <a href="#sidebar" class="bars" id="displayTextLeft"><span>Show Sidebar</span> <i class="fa fa-plus-circle" style="display: inline-block;margin-left: 5px;"></i><i class="fa fa-minus-circle" style="display: none;margin-left: 5px;"></i></a>

                    <div  class="col-md-9 col-lg-9 col-sm-12 col-xs-12 paira-gap-3 text-center">
                    <div class="paira-collection-content collection-content">
                        <!--=================== collections image ===================-->

                        <div class="row">
                            <div class="col-lg-6 col-md-5 col-sm-5 col-xs-6 text-left">
                                <h1 class="page-header margin-bottom-0 text-left"><?php echo $row55['nama_subkategori']; ?></h1>
                            </div>

                        </div>


						<div class="row paira-grid-view mar-clear">
						<?php
				while ( $row5     = $query5->fetch_assoc()){
				include "diskon.php";

			?>
                            <div class="col-md-3 margin-top-30 product-con">
                                <!--=================== Product ===================-->
								<div class="paira-product product img text-center">
									<div class="overflow-h pro-im position-r" data-value="0">
										<a href="produk-<?php echo $row5['id_produk']; ?>-<?php echo $row5['produk_seo']; ?>.html" class="overflow-h">

											<img src="gambar/thumb_produk1/<?php echo $row5['gambar']; ?>" class="paira-product-image img-responsive full-width main-product lazyload blur-up" alt="Body Workout Equipment for Leg" data-srcset="gambar/thumb_produk1/<?php echo $row5['gambar']; ?>" data-src="gambar/thumb_produk1/<?php echo $row5['gambar']; ?>" data-sizes="auto">

										</a>

										<div class="sale-stock">

								<div class="product-sale"><span><?php echo $row5['diskon']; ?>%</span></div>

										</div>
										<div class="product-hover hidden-xs">
											<div class="paira-wish-compare-con">


											<a href="#" data-toggle="tooltip" data-placement="top"
                                                                title="Cek Sekarang"
                                                                data-title="Shoulder Front Tie Knot T Shirt"
                                                                data-handle="shoulder-front-tie-knot-t-shirt"
                                                                class="paira-add-to-compare add-to-compare"><i
                                                                    class="fa fa-whatsapp"></i></a>



								</div>
									</div>
								</div>
								<div class="list-views">
									<div class="product-title-price">



										<div class="pro-reating text-center margin-top-0">
											<div class="paira-rating-con product-rating">
												<span class="shopify-product-reviews-badge" data-id="2609386520661"></span>
											</div>
										</div>



								<h2 class="margin-top-5 margin-bottom-0"><a href="../products/body-workout-equipment-for-leg.html" title="Body Workout Equipment for Leg" class="paira-product-title"><?php echo $row5['nama_produk']; ?></a></h2>

								<div class="text-center margin-top-5" style="margin-bottom: 3px">

								<?php echo $harga_barang; ?>

								</div>

								<ul class="item-swatch item-swatchs list-inline margin-bottom-0 margin-top-5">



								</ul>



								<div class="paira-list-product-des list-product-des" style="display: none;margin-top: 8px">Advanced Features Shopify Theme Get the latest fashion tips and outfit ideas from your favorite celebrities and designers. Click through runway and front row photos from fashion week shows in...</div>
								</div>
								</div>
								</div>
							</div>

					<?php } ?>

                        </div>


                    </div>
                </div>
            </div>


	<!--products-->
	<div class="col-md-9 product-model-sec-custom2">
			<?php
				while ( $row5     = $query5->fetch_assoc()){
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
			</div>


<!-- script -->
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

<?php
	} else {
		echo 
			'<section class="breadcrumb">
			<div class="container-fluid padding-fixed">
				<ul class="list-inline text-capitalize">
					<li><a href="home" title="Retailer - Multipurpose Responsive Shopify Theme/Template">Home<i class="fa fa-angle-right"></i></a></li>
					<li>Belum ada produk untuk pencarian : '.$kata.'</li>
				</ul>
			</div>
		</section>
		
		<div class="products">	 
		<div class="container">
			<div class="col-md-12 product-model-sec-custom title-info wow fadeInUp animated" data-wow-delay=".5s">
				<div class="rsidebar-top">
					<h3 class="text-center">Belum ada produk untuk pencarian : '.$kata.'</h3>		
				</div>
			</div>
		</div>
	</div>';
	}
?>

<?php
	} else { 
		session_destroy();
		echo "<meta http-equiv='refresh' content='0; url=index.php'>";
		echo "<script>alert('silahkan login terlebih dahulu')</script>";
	}
?>
<!-- end script -->