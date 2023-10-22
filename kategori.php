<?php 
	if( $_SESSION['pbnama'] != "" AND $_SESSION['pblevel'] == "kustomer" ){
?>

    <?php
$query55 = $db->prepare("SELECT subkategori_produk.nama_subkategori FROM produk LEFT JOIN subkategori_produk ON produk.id_subkategori=subkategori_produk.id_subkategori WHERE subkategori_produk.id_subkategori=? AND produk.aktif=?");
$query55->bind_param("is", $id_subkategori55, $aktif55);
$id_subkategori55 = $_GET['id'];
$aktif55 = "Y";
$query55->execute();
$result55 = $query55->get_result();
$row55 = $result55->fetch_assoc();
$jumlah55 = $result55->num_rows;

if ($jumlah55 > 0) {

    ?>

<!--=================== Main Body Content Container ===================-->
<div class="paira-container ">
    <!--=================== Header Container ===================-->

    <div id="shopify-section-header-layout-1" class="shopify-section">

<script type="text/javascript" src="../../translate.google.com/translate_a/elementa0d8.html?cb=googleTranslateElementInit"></script>

<style>
    .geo-text p a{
    color: #fff !important;
    }
    .geo-text p a:hover, .background-color a:hover, .menus .btn:hover {
    color: #c0c0c0 !important;
    text-decoration: underline;
    }
    .background-color ul li{
    color: rgba(255, 255, 255, 0.3) !important;
    }
    .header-top ,.header-top a, .header-top ul .btn, .header-top ul .btn.disabled, .header-top ul .btn:active{
    color: #686868;
    }
    .courenccy .symbols .fa, .com-back a{
    color: #686868;
    }
    .courenccy:hover .symbols .fa, .com-back a:hover {
    color: #000;
    }
    .goog-te-gadget-simple .goog-te-menu-value, .goog-te-gadget-simple .goog-te-menu-value span {
    color: #686868;
    }
    .goog-te-gadget-simple .goog-te-menu-value span:hover, .goog-te-menu-frame .text:hover {
    color: #000 !important;
    }
    .header-top a:hover, .header-top ul .btn:hover span, .header-top ul .btn:hover i{
    color: #000;
    }
    .search-frm input{
    background: #fff;
    color: #686868;
    border: 0;
    }
    .search-frm {
        border-right: 1px solid;
    border-color: #dcdcdc;
    }
    .search-frm .input-group-btn:first-child>.btn, .search-frm .input-group-btn:first-child>.btn-group {
    background: #fff;
    color: #686868;
    border-color: #dcdcdc;
    border-color: rgba(104, 104, 104, 0.12);
    }
    .search-frm .search-btn {
    color: #686868;
    }
    .search-frm .search-btn:hover {
    color: #000;
    }
    .search-frm ::-webkit-input-placeholder{
    color: rgba(104, 104, 104, 0.6) !important;
    }
    .search-frm ::-moz-placeholder{
    color: rgba(104, 104, 104, 0.6) !important;
    }
    .search-frm :-ms-input-placeholder{
    color: rgba(104, 104, 104, 0.6) !important;
    }
    .search-frm :-moz-placeholder{
    color: rgba(104, 104, 104, 0.6) !important;
    }

</style>
</div>
    <div id="shopify-section-navigation-1" class="shopify-section"><!--=================== Multi Layout Mega Menu ===================-->

<style>
    .header-middle {
    background: #ffffff;
    border-bottom: 1px solid #efefef;
    border-top: 1px solid #efefef;
    }
    .header-middle,.header-middle a, .navbar-default .navbar-nav>li>a{
    color: #5a5a5a;
    }
    .header-middle a:hover, .mega-menu .navbar-nav>li.active>a, .mega-menu.navbar-default .navbar-nav>li:hover>a, .navbar-default .navbar-nav>.active>a, .navbar-default .navbar-nav>.active>a:focus, .navbar-default .navbar-nav>.active>a:hover{
    color: #000000;
    }
    .mega-menu .navbar-nav>li.active, .mega-menu .navbar-nav>li:hover{
        background: transparent;
    }
    .contact-mails a:hover {
    color: #000000 !important;
    }
    .mega-menu .navbar-nav>li>a, .cart-menu-body a {
    font-size: 14px;
    }
    .phone{
    font-size: px;
    }
    .number-mail ul {
    border-color: rgba(90, 90, 90, 0.12) !important;
    }
    .icon_new > a:before {
    border-top-color: #1ebba3;
    }
    .icon_new > a:after {
    background: #1ebba3;
    color: #fff;
    }
    .icon_sale > a:before {
    border-top-color: #d9121f;
    }
    .icon_sale > a:after {
    background: #d9121f;
    color: #fff;
    }
    .icon_trade > a:before {
    border-top-color: #007c2a;
    }
    .icon_trade > a:after {
    background: #007c2a;
    color: #fff;
    }
    .search-hidden {
    background: ;
    }
    .mobo-logo ul li a, .mobo-logo button{
    color: ;
    }
    .mobo-logo ul li a:hover, .mobo-logo button:hover {
    color: ;
    }
    .mobo-logo button:focus, .mobo-logo button:active, .mobo-logo button.active.focus, .mobo-logo button.active:focus, .mobo-logo button.focus, .mobo-logo button:active.focus, .mobo-logo button:active:focus, .mobo-logo button:focus{
    color: ;
    }
    .icon_new > a:after {
        content: "Sale";
    }
    .icon_sale > a:after {
        content: "Hot";
    }
    .icon_trade > a:after {
        content: "New";
    }
    #Cart_1, #menu-1, #search-img {
    fill: #5a5a5a;
    }
    .cart-menu-body:hover #Cart_1 {
    fill:#000000;
    }
    .cart-item-counts {
        background: #1ebba3;
        color: #fff;
    }
</style>
</div>


    <!--=================== Breadcrumb Section ===================-->

<!--=================== Breadcrumbs ===================-->
<section class="breadcrumb">
    <div class="container-fluid padding-fixed">
        <ul class="list-inline text-capitalize">
            <li><a href="home" title="Retailer - Multipurpose Responsive Shopify Theme/Template">Home<i class="fa fa-angle-right"></i></a></li>


            <li class="collection-handle"><?php echo $row55['nama_subkategori']; ?></li>


        </ul>
    </div>
</section>


    <!--=================== Main Content Container ===================-->
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
						$batas = 9;
							if (empty($_GET['halkategori'])) {
								$posisi = 0;
								$_GET['halkategori'] = 1;
							} else if ($_GET['halkategori'] > 0) {
								$posisi = ($_GET['halkategori'] - 1) * $batas;
							}
							$query5 = $db->prepare("SELECT kategori_produk.id_kategori,kategori_produk.kategori_seo,produk.id_produk,produk.nama_produk,produk.produk_seo,produk.diskon,produk.stok,produk.harga,produk.gambar FROM produk INNER JOIN subkategori_produk ON produk.id_subkategori=subkategori_produk.id_subkategori INNER JOIN kategori_produk ON subkategori_produk.id_kategori=kategori_produk.id_kategori WHERE subkategori_produk.id_subkategori=? AND produk.aktif =? ORDER BY produk.id_produk DESC limit $posisi, $batas");
							$query5->bind_param("is", $id_subkategori5, $aktif);
							$id_subkategori5 = $_GET['id'];
							$aktif = "Y";
							$query5->execute();
							$result5 = $query5->get_result();
							while ($row5 = $result5->fetch_assoc()) {
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
        <div class="container-fluid padding-fixed collection-clear">
            <div class="recentView-list">

                <!--=================== Recently View ===================-->
<div id="paira-recentView" class="paira-recentView paira-gap-1">
    <div class="heading">
        <h2 class="page-header text-center margin-bottom-0 padding-bottom-0 margin-top-0"><span>Recently Viewed Items</span></h2>
    </div>
    <div class="row paira-recent-view-list " id="paira-recentView-list"></div>
</div>



<script type="text/javascript">
    Shopify.PairaCookie.showItemList({
        cookieViewedLimit: '4',
        cookieMemoryLimit: 20,
        cookieViewedId: "paira-recentView-list",
        cookieTemplateId: "paira-recentView-template",
        cookieName: "paira_cookieName_recentView",
        cookieComplete: function() {

            Currency.convertAll(window.shopCurrency, $('#currencies').val(), 'span.money', window.currencyFormat);
        }
    });
    $(window).load(function() {
        var recentView_count = Shopify.PairaCookie.countItem('paira_cookieName_recentView');
        if (recentView_count == 0) {
            $("#paira-recentView").hide();
        }
    });
</script>

            </div>
        </div>
    </section>
</main>
<style>

    .collection-page .product-con, .collection-page .products-con  {
        width: 33.33%;
    }





    .collection-page .products-con {
        width: 25%;
    }


</style>

</div>
    <!--=================== Footer Container ===================-->



<?php
} else {
    $query45 = $db->query("SELECT nama_subkategori FROM subkategori_produk WHERE id_subkategori='$_GET[id]'");
    $row45 = $query45->fetch_assoc();
    echo '<div class="breadcrumbs">';
    echo '<div class="container">';
    echo '<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">';
    echo '<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Beranda</a></li>';
    echo '<li class="active">Belum Ada Produk Untuk Kategori : ' . $row45['nama_subkategori'] . '</li>';
    echo '</ol>';
    echo '</div>';
    echo '</div>';
}
?>

<?php
	} else { 
		session_destroy();
		echo "<meta http-equiv='refresh' content='0; url=index.php'>";
		echo "<script>alert('silahkan login terlebih dahulu')</script>";
	}
?>