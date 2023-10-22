<?php 
	if( $_SESSION['pbnama'] != "" AND $_SESSION['pblevel'] == "kustomer" ){
?>
<div class="paira-container ">
    <!--=================== Header Container ===================-->

    <div id="shopify-section-header-layout-1" class="shopify-section">



<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

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


            <li>Product Details</li>

        </ul>
    </div>
</section>


<?php
$query10 = $db->prepare("SELECT kategori_produk.id_kategori,kategori_produk.nama_kategori,kategori_produk.kategori_seo,subkategori_produk.id_subkategori,subkategori_produk.nama_subkategori,subkategori_produk.subkategori_seo,produk.id_produk,produk.nama_produk,produk.produk_seo,produk.deskripsi,produk.harga,produk.stok,produk.berat,produk.gambar,produk.diskon, user.nama_lengkap, user.no_telp FROM produk LEFT JOIN subkategori_produk ON produk.id_subkategori=subkategori_produk.id_subkategori LEFT JOIN kategori_produk ON subkategori_produk.id_kategori=kategori_produk.id_kategori INNER JOIN user ON produk.id_user=user.id_user WHERE produk.id_produk=?");
$query10->bind_param("i", $id_produk10);
$id_produk10 = $_GET['id'];
$query10->execute();
$result10 = $query10->get_result();
$row10 = $result10->fetch_assoc();
$isi = substr($row10['deskripsi'], 0, 350); // ambil sebanyak 200 karakter
$isi = substr($row10['deskripsi'], 0, strrpos($isi, " ")); // potong per spasi kalimat
$harga = number_format($row10['harga'], 0, ",", ".");
$disc = ($row10['diskon'] / 100) * $row10['harga'];
$hargadisc = number_format(($row10['harga'] - $disc), 0, ",", ".");

$cek_diskon = $row10['diskon'];
$harga_tetap = 'Rp. ' . $hargadisc . '';
$harga_diskon = 'Rp. <del>' . $harga . '</del>  ' . $hargadisc . '';
if ($cek_diskon == 0) {
    $harga_barang = $harga_tetap;
} else {
    $harga_barang = $harga_diskon;
}

$stok = $row10['stok'];
$tombolbeli = '<button type="submit" class="add-cart item_add"> Beli</button>';
$tombolhabis = '<a class="add-cart item_add" href="#"> Stok Habis</a>';
if ($stok == 0) {
    $tombol = $tombolhabis;
} else {
    $tombol = $tombolbeli;
}
?>

    <!--=================== Main Content Container ===================-->
    <div id="shopify-section-product-template" class="shopify-section product-page-section product-page-section--product-page">
<!--=================== Product Template ===================-->
		<maintestproduct-pagesection--product-template"
			class="product-page product-page-template-3 paira-sticky-root"
			data-section-id="product-template" data-section-type="product-page-template" xmlns="http://www.w3.org/1999/html">
			<div class="sticky-price-cart text-center paira-animation-container paira-animation" data-paira-animation="fadeIn" data-paira-animation-delay="0.5ms" style="display: none">
				<div class="container">
					<div class="col-md-8 col-sm-12 col-md-offset-2">
						<div class="paira-product text-left">
							<div class="pull-left col-md-10 col-sm-10 col-xs-9 padding-clear">
								<div class="wi-1 pull-left">
									<img src="//cdn.shopify.com/s/files/1/0087/9303/0741/products/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-7-themetidy_433dd612-4dfe-4e2f-bcea-43382ef1ec67_compact.jpg?v=1560751136" class="paira-product-image display-in-b pull-left img-responsive" id="paira-cart-small-image">
								</div>
								<div class="wi-2 pull-left">
									<h1 class="margin-clear paira-product-title margin-top-10 display-in-b"><?php echo $row10['nama_produk']; ?></h1>
								</div>
								<div class="wi-3 padding-clear text-center pull-left">
									<h3 class="paira-price-preview display-in-b margin-clear">


										<span class="paira-default-price"><span class="money"<?php echo $harga_barang; ?>span></span>
									</h3>
								</div>
							</div>
							<div class="single-product-buttons display-in-b pull-left col-md-2 col-sm-2 col-xs-3 padding-clear">
								<a href="#" data-item-quantity="1" data-varient-id="22640249339989" class="btn btn-primary paira-add-to-cart">Add To Cart</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="single-product paira-gap-3">
				<div class="container-fluid padding-fixed">
					<div class="row">
						<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
							<div class="blog-back row">
								<div class="paira-product">
									<div class="col-md-5 col-sm-12 col-xs-12">
										<div class="fotorama paira-single-product-image" data-nav="thumbs">

										<li data-thumb="gambar/produk/<?php echo $row10['gambar']; ?>">
											<div class="thumb-image"> <img src="gambar/produk/<?php echo $row10['gambar']; ?>" data-imagezoom="true" class="img-responsive" alt=""> </div>
										</li>

										<?php
												$query11 = $db->prepare("SELECT gambar FROM gambar_produk WHERE id_produk=?");
												$query11->bind_param("i", $id_produk11);
												$id_produk11 = $_GET['id'];
												$query11->execute();
												$result11 = $query11->get_result();
												while ($row11 = $result11->fetch_assoc()) { ?>
												<a src="gambar/gambar_produk/<?php echo $row11['gambar']; ?>" class="paira-product-image img-responsive">
												<img
												src="gambar/gambar_produk/<?php echo $row11['gambar']; ?>"
												data-zoom-image="gambar/gambar_produk/<?php echo $row11['gambar']; ?>"
												id="paira-product-zoom"></a>
										<?php }?>


											<!-- <a src="//cdn.shopify.com/s/files/1/0087/9303/0741/products/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-8-themetidy_9aa0116f-8a90-45b7-9d8b-e0a674047739_1024x1024.jpg?v=1560751137" class="paira-product-image img-responsive"><img src="//cdn.shopify.com/s/files/1/0087/9303/0741/products/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-8-themetidy_9aa0116f-8a90-45b7-9d8b-e0a674047739_1024x1024.jpg?v=1560751137" data-zoom-image="//cdn.shopify.com/s/files/1/0087/9303/0741/products/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-8-themetidy_9aa0116f-8a90-45b7-9d8b-e0a674047739_1024x1024.jpg?v=1560751137" id="paira-product-zoom"></a>

											<a src="//cdn.shopify.com/s/files/1/0087/9303/0741/products/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-9-themetidy_d976eab5-fd7c-42e4-b749-810d93493b09_1024x1024.jpg?v=1560751139" class="paira-product-image img-responsive"><img src="//cdn.shopify.com/s/files/1/0087/9303/0741/products/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-9-themetidy_d976eab5-fd7c-42e4-b749-810d93493b09_1024x1024.jpg?v=1560751139" data-zoom-image="//cdn.shopify.com/s/files/1/0087/9303/0741/products/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-9-themetidy_d976eab5-fd7c-42e4-b749-810d93493b09_1024x1024.jpg?v=1560751139" id="paira-product-zoom"></a> -->

											<!-- <a src="//cdn.shopify.com/s/files/1/0087/9303/0741/products/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-10-themetidy_fe452558-1e67-498b-9345-b6305c471187_1024x1024.jpg?v=1560751141" class="paira-product-image img-responsive"><img src="//cdn.shopify.com/s/files/1/0087/9303/0741/products/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-10-themetidy_fe452558-1e67-498b-9345-b6305c471187_1024x1024.jpg?v=1560751141" data-zoom-image="//cdn.shopify.com/s/files/1/0087/9303/0741/products/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-10-themetidy_fe452558-1e67-498b-9345-b6305c471187_1024x1024.jpg?v=1560751141" id="paira-product-zoom"></a>

											<a src="//cdn.shopify.com/s/files/1/0087/9303/0741/products/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-11-themetidy_a6b3f116-c878-4656-9601-acb27e033ac5_1024x1024.jpg?v=1560751142" class="paira-product-image img-responsive"><img src="//cdn.shopify.com/s/files/1/0087/9303/0741/products/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-11-themetidy_a6b3f116-c878-4656-9601-acb27e033ac5_1024x1024.jpg?v=1560751142" data-zoom-image="//cdn.shopify.com/s/files/1/0087/9303/0741/products/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-11-themetidy_a6b3f116-c878-4656-9601-acb27e033ac5_1024x1024.jpg?v=1560751142" id="paira-product-zoom"></a>

											<a src="//cdn.shopify.com/s/files/1/0087/9303/0741/products/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-12-themetidy_022cf871-9dce-46dc-9206-8d080c918cdf_1024x1024.jpg?v=1560751144" class="paira-product-image img-responsive"><img src="//cdn.shopify.com/s/files/1/0087/9303/0741/products/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-12-themetidy_022cf871-9dce-46dc-9206-8d080c918cdf_1024x1024.jpg?v=1560751144" data-zoom-image="//cdn.shopify.com/s/files/1/0087/9303/0741/products/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-12-themetidy_022cf871-9dce-46dc-9206-8d080c918cdf_1024x1024.jpg?v=1560751144" id="paira-product-zoom"></a>

											<a src="//cdn.shopify.com/s/files/1/0087/9303/0741/products/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-1-themetidy_27e8619c-ec78-40a7-af7b-7cf0523b3464_1024x1024.jpg?v=1560751145" class="paira-product-image img-responsive"><img src="//cdn.shopify.com/s/files/1/0087/9303/0741/products/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-1-themetidy_27e8619c-ec78-40a7-af7b-7cf0523b3464_1024x1024.jpg?v=1560751145" data-zoom-image="//cdn.shopify.com/s/files/1/0087/9303/0741/products/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-1-themetidy_27e8619c-ec78-40a7-af7b-7cf0523b3464_1024x1024.jpg?v=1560751145" id="paira-product-zoom"></a>

											<a src="//cdn.shopify.com/s/files/1/0087/9303/0741/products/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-2-themetidy_b2b59758-0704-4879-9f12-e7a54227b07c_1024x1024.jpg?v=1560751147" class="paira-product-image img-responsive"><img src="//cdn.shopify.com/s/files/1/0087/9303/0741/products/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-2-themetidy_b2b59758-0704-4879-9f12-e7a54227b07c_1024x1024.jpg?v=1560751147" data-zoom-image="//cdn.shopify.com/s/files/1/0087/9303/0741/products/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-2-themetidy_b2b59758-0704-4879-9f12-e7a54227b07c_1024x1024.jpg?v=1560751147" id="paira-product-zoom"></a>

											<a src="//cdn.shopify.com/s/files/1/0087/9303/0741/products/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-3-themetidy_f9c61d7e-00b2-42b2-a66a-18db7f1c1651_1024x1024.jpg?v=1560751148" class="paira-product-image img-responsive"><img src="//cdn.shopify.com/s/files/1/0087/9303/0741/products/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-3-themetidy_f9c61d7e-00b2-42b2-a66a-18db7f1c1651_1024x1024.jpg?v=1560751148" data-zoom-image="//cdn.shopify.com/s/files/1/0087/9303/0741/products/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-3-themetidy_f9c61d7e-00b2-42b2-a66a-18db7f1c1651_1024x1024.jpg?v=1560751148" id="paira-product-zoom"></a>

											<a src="//cdn.shopify.com/s/files/1/0087/9303/0741/products/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-4-themetidy_fa94ed5f-a0a8-4645-a0f0-f038d91db36d_1024x1024.jpg?v=1560751150" class="paira-product-image img-responsive"><img src="//cdn.shopify.com/s/files/1/0087/9303/0741/products/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-4-themetidy_fa94ed5f-a0a8-4645-a0f0-f038d91db36d_1024x1024.jpg?v=1560751150" data-zoom-image="//cdn.shopify.com/s/files/1/0087/9303/0741/products/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-4-themetidy_fa94ed5f-a0a8-4645-a0f0-f038d91db36d_1024x1024.jpg?v=1560751150" id="paira-product-zoom"></a>

											<a src="//cdn.shopify.com/s/files/1/0087/9303/0741/products/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-5-themetidy_2d5620ef-e2ec-4c6d-92b4-e64dd6ef1ee2_1024x1024.jpg?v=1560751152" class="paira-product-image img-responsive"><img src="//cdn.shopify.com/s/files/1/0087/9303/0741/products/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-5-themetidy_2d5620ef-e2ec-4c6d-92b4-e64dd6ef1ee2_1024x1024.jpg?v=1560751152" data-zoom-image="//cdn.shopify.com/s/files/1/0087/9303/0741/products/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-5-themetidy_2d5620ef-e2ec-4c6d-92b4-e64dd6ef1ee2_1024x1024.jpg?v=1560751152" id="paira-product-zoom"></a>

											<a src="//cdn.shopify.com/s/files/1/0087/9303/0741/products/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-6-themetidy_4bf7995e-fb6c-4791-9e2b-fef98b2d6ac8_1024x1024.jpg?v=1560751153" class="paira-product-image img-responsive"><img src="//cdn.shopify.com/s/files/1/0087/9303/0741/products/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-6-themetidy_4bf7995e-fb6c-4791-9e2b-fef98b2d6ac8_1024x1024.jpg?v=1560751153" data-zoom-image="//cdn.shopify.com/s/files/1/0087/9303/0741/products/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-6-themetidy_4bf7995e-fb6c-4791-9e2b-fef98b2d6ac8_1024x1024.jpg?v=1560751153" id="paira-product-zoom"></a> -->


										</div>
										<!-- <ul class="list-unstyled icon-but">
											<li><a href="#" rel='gallery' class="single-product-zoom paira-product-zoom-data"><img src="//cdn.shopify.com/s/files/1/0087/9303/0741/t/2/assets/zoom.png?v=6588043026302573289"></a></li>

											<li><a href="#" class="videos"><img src="//cdn.shopify.com/s/files/1/0087/9303/0741/t/2/assets/video.png?v=6532549522147354259"></a></li>

										</ul> -->

                                                    <!-- menjadi semakin dekat dengan gambar -->
										<!-- <div class="half-width pull-left barcode">
											<div class="pull-left full-width">
												<svg id="barcode"></svg>
											</div>
										</div> -->


										<!-- <div class="half-width  pull-right"> -->
											<!--=================== Social Share Widget ===================-->

		<!-- <div class="sicoal-share-widget">
			<ul class="list-inline">

				<li class="margin-top-10">
					<a href="https://www.facebook.com/sharer/sharer.php?u=homeproducts/shoulder-front-tie-knot-t-shirt" target="_blank"><i class="fa fa-facebook"></i></a>
				</li>


				<li class="margin-top-10">
					<a href="https://twitter.com/home?status=homeproducts/shoulder-front-tie-knot-t-shirt" target="_blank"><i class="fa fa-twitter"></i></a>
				</li>


				<li class="margin-top-10">
					<a href="https://www.linkedin.com/cws/share?url=homeproducts/shoulder-front-tie-knot-t-shirt" target="_blank"><i class="fa fa-linkedin"></i></a>
				</li>


				<li class="margin-top-10">
					<a href="https://plus.google.com/share?url=homeproducts/shoulder-front-tie-knot-t-shirt" target="_blank"><i class="fa fa-google-plus"></i></a>
				</li>


				<li class="margin-top-10">
					<a href="https://pinterest.com/pin/create/button/?url=homeproducts/shoulder-front-tie-knot-t-shirt&media=//cdn.shopify.com/s/files/1/0087/9303/0741/products/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-7-themetidy_433dd612-4dfe-4e2f-bcea-43382ef1ec67_1024x1024.jpg?v=1560751136&description=Shoulder Front Tie Knot T Shirt" target="_blank"><i class="fa fa-pinterest"></i></a>
				</li>


				<li class="margin-top-10">
					<a href="mailto:support@themetidy.com" target="_blank"><i class="fa fa-envelope"></i></a>
				</li>

			</ul>
	</div> -->
                                <!-- </div> -->
                                <div class="paira-product-zoom-data data" style="display: none"></div>
                            </div>
                            <div class="col-md-7 col-sm-12 col-xs-12 product-detail">
                                <div class="col-md-12 col-sm-12 col-xs-12 padding-clear">
                                    <div class="title-sale">



                                        <h1 class="margin-clear paira-product-title margin-bottom-20 pull-left full-width"><?php echo $row10['nama_produk']; ?></h1>
                                    </div>

                                    <span class="reviews margin-clear padding-clear pull-left margin-right-20 margin-bottom-10"><span class="shopify-product-reviews-badge margin-clear padding-clear" data-id="2609383800917"></span></span>


                                    <div class="pull-left margin-bottom-10">
                                        <div class="vendor-type-sku">

                                            <div class="pull-left margin-top-0 margin-right-20">
                                                <label class="pull-left margin-right-10 margin-bottom-0">Penjual: </label>
                                                <p class="pull-left margin-clear"><a href="#"><?php echo $row10['nama_lengkap']; ?></a></p>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="price-preview full-width pull-left">
                                        <div class="full-width pull-left">
                                            <h3 class="margin-top-0 margin-bottom-10 paira-price-preview pull-left">


                                                <span class="paira-default-price"><span class="money"><?php echo $harga_barang; ?></span></span>
                                            </h3>
                                        </div>

                                        <div class="full-width pull-left count-product margin-bottom-20">


                                            <img src="//cdn.shopify.com/s/files/1/0087/9303/0741/files/sold.gif?v=1560682519" class="margin-right-5">

                                             <p><?php echo $row10['diskon']; ?></p> <i class="fa fa-percent" aria-hidden="true"></i></div>

                                        <!--=================== Countdown Timer Product ===================-->


                                        <div class="option-background">
                                            <div class="paira-option-switch option-switch"></div>
                                        <ul class="magin-bottom-0" style="display: none !important;">


                                            <li class="paira-variant-image-red" data-variant-image="//cdn.shopify.com/s/files/1/0087/9303/0741/products/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-8-themetidy_9aa0116f-8a90-45b7-9d8b-e0a674047739_small.jpg?v=1560751137"></li>



                                            <li class="paira-variant-image-green" data-variant-image="//cdn.shopify.com/s/files/1/0087/9303/0741/products/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-9-themetidy_d976eab5-fd7c-42e4-b749-810d93493b09_small.jpg?v=1560751139"></li>



                                            <li class="paira-variant-image-blue" data-variant-image="//cdn.shopify.com/s/files/1/0087/9303/0741/products/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-11-themetidy_a6b3f116-c878-4656-9601-acb27e033ac5_small.jpg?v=1560751142"></li>



                                            <li class="paira-variant-image-brown" data-variant-image="//cdn.shopify.com/s/files/1/0087/9303/0741/products/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-1-themetidy_27e8619c-ec78-40a7-af7b-7cf0523b3464_small.jpg?v=1560751145"></li>



                                        </ul>
                                        <div class="option-switch-dropdown"  style="display: none;">


                                        <div class="product-options ">
                                            <div class="select clearfix">
                                                <select id="product-select" name="id">

                                                    <option value="22640249339989" selected="selected" >Red / M / Polyester - $100.00</option>

                                                    <option value="22640249372757">Red / L / Polyester - $100.00</option>

                                                    <option value="22640249405525">Red / XL / Polyester - $100.00</option>

                                                    <option value="22640249438293">Red / 3XL / Polyester - $100.00</option>

                                                    <option value="22640249471061">Red / 4XL / Polyester - $100.00</option>

                                                    <option value="22640249503829">Green / M / Polyester - $100.00</option>

                                                    <option value="22640249536597">Green / L / Polyester - $100.00</option>

                                                    <option value="22640249569365">Green / XL / Polyester - $100.00</option>

                                                    <option value="22640249602133">Green / 3XL / Polyester - $100.00</option>

                                                    <option value="22640249634901">Green / 4XL / Polyester - $100.00</option>

                                                    <option value="22640249667669">Blue / M / Polyester - $100.00</option>

                                                    <option value="22640249700437">Blue / L / Polyester - $100.00</option>

                                                    <option value="22640249733205">Blue / XL / Polyester - $100.00</option>

                                                    <option value="22640249765973">Blue / 3XL / Polyester - $100.00</option>

                                                    <option value="22640249798741">Blue / 4XL / Polyester - $100.00</option>

                                                    <option value="22640249831509">Brown / M / Polyester - $100.00</option>

                                                    <option value="22640249864277">Brown / L / Polyester - $100.00</option>

                                                    <option value="22640249897045">Brown / XL / Polyester - $100.00</option>

                                                    <option value="22640249929813">Brown / 3XL / Polyester - $100.00</option>

                                                    <option value="22640249962581">Brown / 4XL / Polyester - $100.00</option>

                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="full-width pull-left margin-bottom-30 margin-top-0">

									<a href="#"><?php echo $row10['nama_kategori']; ?></a><b>-></b>
                                    <a href="#" class="display-in-b padding-right-15 text-underline"><?php echo $row10['nama_subkategori']; ?></a>


                                    <a href="#" class="display-in-b padding-right-15 text-underline"><?php echo $row10['berat']; ?> Kg</a>


                                    <a href="#" class="display-in-b ask-margin"> <i class="fa fa-archive" aria-hidden="true"></i> <?php echo $row10['stok']; ?></a>

                                </div>
                                <div class="full-width pull-left single-product-buttons margin-bottom-15">
                                    <div class="display-in-b quantities pull-left padding-right-10">
                                        <!-- <div class="input-group paira-quantity-group product-quantity-group"> -->
                                            <!-- <div class="input-group-addon left-adon" data-direction="down"><i class="fa fa-minus"></i></div> -->
                                            <!-- <input type="text" value="1" class="form-control paira-single-quantity text-center" placeholder="1"> -->
                                            <!-- <div class="input-group-addon right-adon" data-direction="up"><i class="fa fa-plus"></i></div> -->
                                        <!-- </div> -->
                                    </div>
                                   
                                    <?php 
                                    $dbwebsite = $db->query("SELECT alamat_web from profil"); 
                                    $whatsapp = $dbwebsite->fetch_assoc();
                                    ?>
                                    <?php  if ( $_SESSION['pbnama'] != " " && $_SESSION['pblevel'] == "kustomer" ){
                                            $queryhalo = $db->query("SELECT kustomer.id_user, user.nama_lengkap as nama_cs, kustomer.nama_lengkap, user.foto, user.no_telp
                                            from kustomer,`user` WHERE user.id_user = kustomer.id_user AND kustomer.nama_lengkap ='$_SESSION[pbnama]'");
                                            $rowhallo   = $queryhalo->fetch_assoc();
                                        
                                     ?>
                                    <a href="https://wa.me/62<?php echo $rowhallo['no_telp'];?>?text=<?php echo $whatsapp['alamat_web'];?>/produk-<?php echo $row10['id_produk']; ?>-<?php echo $row10['produk_seo']; ?>.html" data-item-quantity="1" data-varient-id="22640249339989" target="_blank" class="btn btn-primary btn-lg">Live Chat</a>
                                    <?php }  else { ?>
                                        <a></a>
                                    <?php } ?>
                                    <!-- <a href="#" data-item-quantity="1" data-varient-id="22640249339989" class="btn btn-default btn-lg margin-right-10 paira-buy-now buy-now">Pesan</a> -->

                                    <div class="compare-wishlists display-in-b">


                                        <!-- <a href="#" data-title="Shoulder Front Tie Knot T Shirt" data-handle="shoulder-front-tie-knot-t-shirt" class="paira-add-to-compare add-to-compare margin-top-10 margin-right-10"><i class="fa fa-balance-scale"></i></a>
                                        <a href="#" data-title="Shoulder Front Tie Knot T Shirt" data-handle="shoulder-front-tie-knot-t-shirt" class="paira-add-to-wish add-to-compare margin-top-10"><i class="fa fa-heart-o"></i></a> -->


                                    </div>
                                </div>
                            </div>
                            <span id="basic-waypoint" class="pull-left full-width"></span>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 padding-clear">
                            <div class="pull-left full-width margin-top-10 margin-bottom-10">


                                <div class="pull-left margin-right-20 margin-right-20 margin-bottom-0">
                                    <label class="pull-left margin-right-10 margin-bottom-0">Type:</label>
                                    <p class="pull-left margin-clear"><a href="#"><?php echo $row10['nama_kategori']; ?></a></p>
                                </div>


                                <!-- <div class="pull-left">
                                    <label class="pull-left margin-right-10 margin-bottom-0">SKU:</label>
                                    <p class="pull-left margin-clear">TTHABIT28</p>
                                </div> -->


                                <!-- <div class="full-width pull-left shipping-method margin-bottom-5 margin-top-5">
                                    <div class="margin-clear free-ship">
                                        <img src="//cdn.shopify.com/s/files/1/0087/9303/0741/files/earth_f3d50791-893d-4749-8239-281b9a0f3f94.gif?v=1560682586" class="margin-right-5">
                                        <p>$50 Cash Back to</p> <span class="paira-country-flag flag display-in-b" style="display: none;"></span> <span class="paira-geo-country display-in-b"></span>
                                    </div>
                                </div> -->


                                <div class="full-width pull-left count-product margin-bottom-5">
                                    <img src="//cdn.shopify.com/s/files/1/0087/9303/0741/files/user.gif?v=1560682530" class="margin-right-5">
                                    <span class="number-span paira-total-viewing"></span> <p><?php echo $rowhallo['nama_cs']; ?></p></div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row paira-gap-2 tab-products-con">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <ul class="nav nav-tabs single-product-tabs">
                        <li class="active"><a href="#description" data-toggle="tab">Deskripsi</a></li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="description">
						<?php echo $row10['deskripsi']; ?>
                        </div>

                        <div class="tab-pane" id="shippingreturns">

                            <p class="col-md-12">Please select a Page from <a href="/admin/themes" class="text-muted">theme customization</a></p>

                        </div>


                        <div class="tab-pane" id="reviews">
                            <div id="shopify-product-reviews" data-id="2609383800917"></div>
                        </div>


                        <div class="tab-pane" id="shippings">

                            <p class="col-md-12">Please select a Page from <a href="/admin/themes" class="text-muted">theme customization</a></p>

                        </div>

                    </div>
                </div>
            </div>

            <!--=================== Related Product ===================-->
<div class="row related-pro paira-related-product position-r margin-clear paira-gap-2">
    <div class="heading row margin-clear">
        <h2 class="page-header margin-bottom-0"><span>Lihat yang sering dikunjungi Lain nya</span></h2>
    </div>
    <div class="swiper-container s3 related-product">
        <div class="swiper-wrapper">

		<?php
					$query13  = $db->query("SELECT id_produk,nama_produk,produk_seo,gambar,harga,diskon,stok FROM produk ORDER BY rand() limit 5");
					while ( $row13    = $query13->fetch_assoc() ){
					 // diskon  
					$harga13        = number_format( $row13['harga'],0,",","." );
					$disc13         = ($row13['diskon']/100)*$row13['harga'];
					$hargadisc13    = number_format(( $row13['harga']-$disc13),0,",","." );
					
					$cek_diskon13   = $row13['diskon'];
					$harga_tetap13  = '<p><span class="item_price">Rp. '.$hargadisc13.'</span></p>';
					$harga_diskon13 = '<p class="pric1">Rp. <del>'.$harga13.'</del></p>
									 <p><span class="item_price">'.$hargadisc13.'</span></p>';
					if ( $cek_diskon13 == 0 ){
						$harga_barang13 = $harga_tetap13;
					} else {
						$harga_barang13 = $harga_diskon13;
					}
					
					$stok13  = $row13['stok'];
					$tombolbeli13 = '<a class="item_add" href="aksi.php?module=keranjang&act=tambah&id='.$row13['id_produk'].'"> Beli</a>';
					$tombolhabis13 = '<a class="item_add" href="#"> Stok Habis</a>';
					if ( $stok13 == 0 ){
						$tombol13 = $tombolhabis13;
					} else {
						$tombol13 = $tombolbeli13;
					}
				?>
			<!-- Start Loop -->
            <div class="swiper-slide margin-top-30">
                <!--=================== Product ===================-->
				<div class="paira-product product img text-center">
					<div class="overflow-h pro-im position-r" data-value="0">
						<a href="produk-<?php echo $row13['id_produk']; ?>-<?php echo $row13['produk_seo']; ?>.html" class="overflow-h">
							<img src="gambar/thumb_produk1/<?php echo $row13['gambar']; ?>" class="paira-product-image img-responsive full-width main-product lazyload blur-up" alt="Mens Sport Hiking Sandals Athletic" data-srcset="gambar/thumb_produk1/<?php echo $row13['gambar']; ?>" data-src="gambar/thumb_produk1/<?php echo $row13['gambar']; ?>" data-sizes="auto">
						</a>

						<div class="sale-stock">

						</div>
							<div class="product-hover hidden-xs">
								<div class="paira-wish-compare-con">

									<!-- <a href="#" data-toggle="tooltip" data-placement="top" title="Cek Sekarang" data-title="Mens Sport Hiking Sandals Athletic" data-handle="mens-sport-hiking-sandals-athletic" class="paira-add-to-compare add-to-compare"><i class="fa fa-whatsapp"></i></a> -->

							</div>
						</div>
						</div>
						<div class="list-views">
							<div class="product-title-price">


							<div class="pro-reating text-center margin-top-0">
								<div class="paira-rating-con product-rating">
									<span class="shopify-product-reviews-badge" data-id="2609383014485"></span>
								</div>
							</div>


							<h2 class="margin-top-5 margin-bottom-0"><a href="/products/mens-sport-hiking-sandals-athletic" title="Mens Sport Hiking Sandals Athletic" class="paira-product-title"> <?php echo $row13['nama_produk']; ?></a></h2>

							<div class="text-center margin-top-5" style="margin-bottom: 3px">

								<span class="money"><?php echo $harga_barang13; ?></span>

							</div>

							<ul class="item-swatch item-swatchs list-inline margin-bottom-0 margin-top-5">

								<!-- <li class="active paira-variant-image-change" data-toggle="tooltip" data-placement="top" title="Red" data-variant-image="gambar/produk/<?php echo $row10['gambar']; ?>">
									<label class="margin-bottom-0" style="background: #ddd;background-color: red;border-radius: 30px;margin-top:0;padding: 1px;opacity: 0.6;">

										<span style="background: url('gambar/produk/<?php echo $row10['gambar']; ?>');width: 25px; height: 25px;background-size: cover;background-repeat: no-repeat;-webkit-border-radius: 30px;-moz-border-radius: 100px;display: block;" data-img="gambar/produk/<?php echo $row10['gambar']; ?>" class="paira-color-img color-img"></span>

									</label>
								</li> -->

							</ul>



				<div class="paira-list-product-des list-product-des" style="display: none;margin-top: 8px">Advanced Features Shopify Theme Get the latest fashion tips and outfit ideas from your favorite celebrities and designers. Click through runway and front row photos from fashion week shows in...</div>
				</div>
				</div>
				</div>
			</div>
			<!-- end for loop -->
			<?php
					}
				?>


        </div>
    </div>
    <div class="another-btn">
    <div class="swiper-button-prev swiper-button-prev-related"><i class="fa fa-angle-left"></i></div>
    <div class="swiper-button-next swiper-button-next-related"><i class="fa fa-angle-right"></i></div>
    </div>
</div>
<script>
    $(function() {
        var swiper = new Swiper('.swiper-container.s3', {
            navigation: {
                nextEl: '.swiper-button-next-related',
                prevEl: '.swiper-button-prev-related'
            },
            slidesPerView: 4,
            spaceBetween: 30,
            freeMode: true,
            breakpoints: {
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 15
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 15
                },
                767: {
                    slidesPerView: 2,
                    spaceBetween: 15
                },
                480: {
                    slidesPerView: 2,
                    spaceBetween: 15
                }
            }
        });

    });
</script>


        </div>
    </div>
    </div>
    </div>
</main>
<!--=================== Video ===================-->
<div class="modal playvideo" id="playvideo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog modal-md" role="document">
<div class="modal-content">
<button type="button" class="close close-video" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
                                                                                                                     <div class="modal-body">
</div>
  </div>
    </div>
      </div>

<!--=================== Video ===================-->
<div class="modal sizechart" id="sizechart" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
            <div class="modal-body">

                <p class="col-md-12">Please select image from <a href="/admin/themes" class="text-muted">theme customization</a></p>

            </div>
        </div>
    </div>
</div>


<!--=================== Video ===================-->
<div class="modal page" id="page" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
            <div class="modal-body">

                <p class="col-md-12">Please select a Page from <a href="/admin/themes" class="text-muted">theme customization</a></p>

            </div>
        </div>
    </div>
</div>


<!--=================== Video ===================-->
<div class="modal ask" id="ask" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
            <div class="modal-body">
                <form method="post" action="/contact#contact_form" id="contact_form" accept-charset="UTF-8" class="contact-form"><input type="hidden" name="form_type" value="contact" /><input type="hidden" name="utf8" value="✓" />
                <div class="row">
                    <div class="col-md-12 faq-padding">
                        <h3 class="margin-clear margin-bottom-30">Ask Your Questions</h3>
                    </div>


                    <div class="col-md-4">
                        <input name="form_type" type="hidden" value="contact">
                        <input name="utf8" type="hidden" value="✓">
                        <label>Your Name</label>
                        <input type="text" class="form-control margin-bottom-20" name="contact[name]" placeholder="">
                    </div>
                    <div class="col-md-4">
                        <label>Email</label>
                        <input type="email" class="form-control margin-bottom-20" name="contact[email]" placeholder="">
                    </div>
                    <div class="col-md-4">
                        <label>Phone Number</label>
                        <input type="telephone" class="form-control margin-bottom-20" name="contact[phone]" placeholder="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 faq-padding">
                        <label>Your Question</label>
                        <textarea rows="9" name="contact[body]" class="form-control margin-bottom-20" placeholder=""></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-default">Send Question</button>
                </form>
            </div>
        </div>
    </div>
</div>



<script src="//cdn.shopify.com/s/files/1/0087/9303/0741/t/2/assets/JsBarcode.all.min.js?v=16836900761894978890" type="text/javascript"></script>


<script>
    function subTotal(quantity, price, subTotal) {
        var v = quantity,
                p = price,
                x = /([0-9]+[.|,][0-9]+[.|,][0-9]+)/g,
                q = p.match(x);
        if (!q){
            x = /([0-9]+[.|,][0-9]+)/g; q = p.match(x);
        }
        if(q){
            var b = Shopify.formatMoney(q[0].replace(/[.|,]/g,'') * parseInt(v)),
                    s = p.replace(new RegExp(q[0], "g") ,b.match(x)[0]);
            subTotal.text(s);
        }
    }
    function SocialShare(url, title, w, h) {
        var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
        var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;
        var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
        var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;
        var left = ((width / 2) - (w / 2)) + dualScreenLeft;
        var top = ((height / 2) - (h / 2)) + dualScreenTop;
        var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
        if (window.focus) {
            newWindow.focus();
        }
    }
    var switchImage = function(newImageSrc, newImage, mainImageDomEl) {
        $(mainImageDomEl).attr('src', newImageSrc);
        $(mainImageDomEl).parents('a').attr('href', newImageSrc);
    };
    var selectCallback = function(variant, selector) {
        if (variant && variant.featured_image) {
            var newImage = variant.featured_image,
                    mainImageDomEl = $('.fotorama__loaded.fotorama__active img')[0];
            Shopify.Image.switchImage(newImage, mainImageDomEl, function(a) {
                $("#paira-cart-small-image").attr("src", a);
                $(".fotorama__nav__frame--thumb").each(function(index) {
                    var i = $(this).find('img').attr('src');
                    if (i === a){
                        var fotorama = $('.fotorama').fotorama();
                        var fotoramaApi = fotorama.data('fotorama');
                        fotoramaApi.show(index);
                        $(".zoomContainer").show();
                        $("#paira-product-zoom").show();
                        $(".single-product-image").show();
                        $("#paira-product-zoom").attr("src", i);
                        $(".image-popup .paira-product-image").attr("src", i);
                        $('.zoomWindow').css("background-image", "url("+i+")");
                        $(this).trigger("click");
                    }
                })
            })
        }
        function removeA(arr) {
            var what, a = arguments, L = a.length, ax;
            while (L > 1 && arr.length) {
                what = a[--L];
                while ((ax= arr.indexOf(what)) !== -1) {
                    arr.splice(ax, 1);
                }
            }
            return arr;
        }
        $("a.paira-product-zoom-data").fancybox();
        $('.fotorama').on('fotorama:ready ' +
                'fotorama:show ' +
                'fotorama:showend ' +
                'fotorama:load ' +
                'fotorama:error ' +
                'fotorama:startautoplay ' +
                'fotorama:stopautoplay ' +
                'fotorama:fullscreenenter ' +
                'fotorama:fullscreenexit ' +
                'fotorama:loadvideo ' +
                'fotorama:unloadvideo',
                function (e, fotorama, extra) {
                    $('.single-product-zoom').attr('href', fotorama.activeFrame.img);
                    $('.fotorama__stage__frame.fotorama__active img').addClass('paira-product-image');
                    var ary = [

                    "//cdn.shopify.com/s/files/1/0087/9303/0741/products/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-7-themetidy_433dd612-4dfe-4e2f-bcea-43382ef1ec67_1024x1024.jpg?v=1560751136",

                    "//cdn.shopify.com/s/files/1/0087/9303/0741/products/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-8-themetidy_9aa0116f-8a90-45b7-9d8b-e0a674047739_1024x1024.jpg?v=1560751137",

                    "//cdn.shopify.com/s/files/1/0087/9303/0741/products/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-9-themetidy_d976eab5-fd7c-42e4-b749-810d93493b09_1024x1024.jpg?v=1560751139",

                    "//cdn.shopify.com/s/files/1/0087/9303/0741/products/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-10-themetidy_fe452558-1e67-498b-9345-b6305c471187_1024x1024.jpg?v=1560751141",

                    "//cdn.shopify.com/s/files/1/0087/9303/0741/products/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-11-themetidy_a6b3f116-c878-4656-9601-acb27e033ac5_1024x1024.jpg?v=1560751142",

                    "//cdn.shopify.com/s/files/1/0087/9303/0741/products/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-12-themetidy_022cf871-9dce-46dc-9206-8d080c918cdf_1024x1024.jpg?v=1560751144",

                    "//cdn.shopify.com/s/files/1/0087/9303/0741/products/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-1-themetidy_27e8619c-ec78-40a7-af7b-7cf0523b3464_1024x1024.jpg?v=1560751145",

                    "//cdn.shopify.com/s/files/1/0087/9303/0741/products/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-2-themetidy_b2b59758-0704-4879-9f12-e7a54227b07c_1024x1024.jpg?v=1560751147",

                    "//cdn.shopify.com/s/files/1/0087/9303/0741/products/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-3-themetidy_f9c61d7e-00b2-42b2-a66a-18db7f1c1651_1024x1024.jpg?v=1560751148",

                    "//cdn.shopify.com/s/files/1/0087/9303/0741/products/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-4-themetidy_fa94ed5f-a0a8-4645-a0f0-f038d91db36d_1024x1024.jpg?v=1560751150",

                    "//cdn.shopify.com/s/files/1/0087/9303/0741/products/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-5-themetidy_2d5620ef-e2ec-4c6d-92b4-e64dd6ef1ee2_1024x1024.jpg?v=1560751152",

                    "//cdn.shopify.com/s/files/1/0087/9303/0741/products/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-6-themetidy_4bf7995e-fb6c-4791-9e2b-fef98b2d6ac8_1024x1024.jpg?v=1560751153",
                    ],
                    valueRemove = $('.single-product-zoom').attr('href'),index,result, finalResult;
                    removeA(ary, valueRemove);
                    for (index = 0; index < ary.length; ++index) {
                        result += "<a class='paira-product-zoom-data' rel='gallery' href='"+ary[index]+"'></a>";
                    }
                    $(".paira-product-zoom-data.data").html(result);
                }
        ).fotorama();
        if (variant && variant.available) {
            $('.single-product-buttons .paira-add-to-compare').removeAttr('disabled').removeClass('disabled');
            if(variant.price < variant.compare_at_price){
                $('.paira-price-preview').html('<del><span class="money">'+ Shopify.formatMoney(variant.compare_at_price, "${{amount}}") +'</span></del><span class="margin-left-10 paira-default-price"><span class="money">'+ Shopify.formatMoney(variant.price, "${{amount}}") +'</span></span>');
            } else {
                $('.paira-price-preview').html('<span class="paira-default-price"><span class="money">'+ Shopify.formatMoney(variant.price, "${{amount}}") +'</span></span>');
            }
            $('.paira-quantity-'+variant.id).show();
            var tr = parseInt($('.paira-quantity-'+variant.id).html());
            if(tr <= 0){
                $('.single-product-buttons .paira-add-to-cart').removeAttr('disabled').removeClass('disabled').attr('data-varient-id', variant.id).html('Pre Order');
                $('.single-product-buttons .paira-buy-now').removeAttr('disabled').removeClass('disabled').attr('data-varient-id', variant.id).html('Buy Now');
            }else{
                $('.single-product-buttons .paira-add-to-cart').removeAttr('disabled').removeClass('disabled').attr('data-varient-id', variant.id).html('Add To Cart');
                $('.single-product-buttons .paira-buy-now').removeAttr('disabled').removeClass('disabled').attr('data-varient-id', variant.id).html('Buy Now');
            }
        } else {
            var message = variant ? "Sold Out" : "Unavailable";
            $('.single-product-buttons .paira-add-to-cart').addClass('disabled').attr('disabled', 'disabled').html(message);
            $('.single-product-buttons .paira-buy-now').addClass('disabled').attr('disabled', 'disabled').html(message);
            $('.single-product-buttons .paira-add-to-compare').addClass('disabled').attr('disabled', 'disabled');
            $('.paira-price-preview').html(message);
        }
    };
    $(function() {
        Shopify.PairaCookie.recordItem('shoulder-front-tie-knot-t-shirt', {cookieName: "paira_cookieName_recentView"});
        /*******************************************************************************
         * Call Shopify Option Selectors
         *******************************************************************************/
        new Shopify.OptionSelectors("product-select", { product: {"id":2609383800917,"title":"Shoulder Front Tie Knot T Shirt","handle":"shoulder-front-tie-knot-t-shirt","description":"\u003cp\u003e\u003cstrong\u003eAdvanced Features Shopify Theme\u003c\/strong\u003e\u003c\/p\u003e\n\u003cp\u003eGet the latest fashion tips and outfit ideas from your favorite celebrities and designers. Click through runway and front row photos from fashion week shows in New York, London, Paris, and Milan. Plus: browse key accessories like bags, shoes, and sunglasses, must-have denim looks, and more top fashion trends.\u003c\/p\u003e\n\u003col\u003e\n\u003cli\u003eC'est magnifique! How to look French when you're not\u003c\/li\u003e\n\u003cli\u003eThe best nutty fragrances\u003c\/li\u003e\n\u003cli\u003eHow to wear: matinee glamour for the festive season\u003c\/li\u003e\n\u003cli\u003eFrom ginger to Michael Bublé: this week’s fashion trends\u003c\/li\u003e\n\u003cli\u003eFashion designer Raf Simons leaves Calvin Klein\u003c\/li\u003e\n\u003cli\u003eFrom drab to fab: the six quickest ways to get Christmas party-ready\u003c\/li\u003e\n\u003cli\u003eThe best beauty stocking fillers for £10 or less\u003c\/li\u003e\n\u003cli\u003eWhy the humble hair clip is this season's must-have accessory\u003c\/li\u003e\n\u003cli\u003eHow to wear... utilitarian\u003c\/li\u003e\n\u003cli\u003eJudy Blame remembered by Boy George\u003c\/li\u003e\n\u003c\/ol\u003e\n\u003cp\u003e\u003cstrong\u003eFashion Shopify Theme\u003c\/strong\u003e\u003c\/p\u003e\n\u003cp\u003eEarly Western travelers, traveling whether to India, Persia, Turkey or China, would frequently remark on the absence of change in fashion in those countries. The Japanese shōgun's secretary bragged (not completely accurately) to a Spanish visitor in 1609 that Japanese clothing had not changed in over a thousand years. However, there is considerable evidence in Ming China of rapidly changing fashions in Chinese clothing. Changes in costume often took place at times of economic or social change, as occurred in ancient Rome and the medieval Caliphate, followed by a long period without major changes. In 8th-century Moorish Spain, the musician Ziryab introduced to Córdoba sophisticated clothing-styles based on seasonal and daily fashions from his native Baghdad, modified by his own inspiration. Similar changes in fashion occurred in the 11th century in the Middle East following the arrival of the Turks, who introduced clothing styles from Central Asia and the Far East. \u003c\/p\u003e\n\u003col\u003e\u003c\/ol\u003e\n\u003cp\u003e \u003c\/p\u003e","published_at":"2019-06-15T02:28:38-04:00","created_at":"2019-06-15T02:28:38-04:00","vendor":"Calvin Klein","type":"Sweaters","tags":["$150 - $300","2XL","Black","Grey","H\u0026M","Jeans","L","Tom Ford","Tops","under $150","video-VkuLRLsKbcI","XL","Yellow"],"price":10000,"price_min":10000,"price_max":10000,"available":true,"price_varies":false,"compare_at_price":null,"compare_at_price_min":0,"compare_at_price_max":0,"compare_at_price_varies":false,"variants":[{"id":22640249339989,"title":"Red \/ M \/ Polyester","option1":"Red","option2":"M","option3":"Polyester","sku":"TTHABIT28","requires_shipping":true,"taxable":false,"featured_image":{"id":8274151768149,"product_id":2609383800917,"position":2,"created_at":"2019-06-17T01:58:57-04:00","updated_at":"2019-06-17T01:58:57-04:00","alt":null,"width":766,"height":1000,"src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-8-themetidy_9aa0116f-8a90-45b7-9d8b-e0a674047739.jpg?v=1560751137","variant_ids":[22640249339989,22640249372757,22640249405525,22640249438293,22640249471061]},"available":true,"name":"Shoulder Front Tie Knot T Shirt - Red \/ M \/ Polyester","public_title":"Red \/ M \/ Polyester","options":["Red","M","Polyester"],"price":10000,"weight":50000,"compare_at_price":null,"inventory_management":null,"barcode":"HST201968","featured_media":{"alt":null,"id":1415220691029,"position":2,"preview_image":{"aspect_ratio":0.766,"height":1000,"width":766,"src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-8-themetidy_9aa0116f-8a90-45b7-9d8b-e0a674047739.jpg?v=1569187672"}}},{"id":22640249372757,"title":"Red \/ L \/ Polyester","option1":"Red","option2":"L","option3":"Polyester","sku":"TTHABIT32","requires_shipping":true,"taxable":false,"featured_image":{"id":8274151768149,"product_id":2609383800917,"position":2,"created_at":"2019-06-17T01:58:57-04:00","updated_at":"2019-06-17T01:58:57-04:00","alt":null,"width":766,"height":1000,"src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-8-themetidy_9aa0116f-8a90-45b7-9d8b-e0a674047739.jpg?v=1560751137","variant_ids":[22640249339989,22640249372757,22640249405525,22640249438293,22640249471061]},"available":true,"name":"Shoulder Front Tie Knot T Shirt - Red \/ L \/ Polyester","public_title":"Red \/ L \/ Polyester","options":["Red","L","Polyester"],"price":10000,"weight":50000,"compare_at_price":null,"inventory_management":null,"barcode":"","featured_media":{"alt":null,"id":1415220691029,"position":2,"preview_image":{"aspect_ratio":0.766,"height":1000,"width":766,"src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-8-themetidy_9aa0116f-8a90-45b7-9d8b-e0a674047739.jpg?v=1569187672"}}},{"id":22640249405525,"title":"Red \/ XL \/ Polyester","option1":"Red","option2":"XL","option3":"Polyester","sku":"TTHABIT36","requires_shipping":true,"taxable":false,"featured_image":{"id":8274151768149,"product_id":2609383800917,"position":2,"created_at":"2019-06-17T01:58:57-04:00","updated_at":"2019-06-17T01:58:57-04:00","alt":null,"width":766,"height":1000,"src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-8-themetidy_9aa0116f-8a90-45b7-9d8b-e0a674047739.jpg?v=1560751137","variant_ids":[22640249339989,22640249372757,22640249405525,22640249438293,22640249471061]},"available":true,"name":"Shoulder Front Tie Knot T Shirt - Red \/ XL \/ Polyester","public_title":"Red \/ XL \/ Polyester","options":["Red","XL","Polyester"],"price":10000,"weight":50000,"compare_at_price":null,"inventory_management":null,"barcode":"","featured_media":{"alt":null,"id":1415220691029,"position":2,"preview_image":{"aspect_ratio":0.766,"height":1000,"width":766,"src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-8-themetidy_9aa0116f-8a90-45b7-9d8b-e0a674047739.jpg?v=1569187672"}}},{"id":22640249438293,"title":"Red \/ 3XL \/ Polyester","option1":"Red","option2":"3XL","option3":"Polyester","sku":"TTHABIT40","requires_shipping":true,"taxable":false,"featured_image":{"id":8274151768149,"product_id":2609383800917,"position":2,"created_at":"2019-06-17T01:58:57-04:00","updated_at":"2019-06-17T01:58:57-04:00","alt":null,"width":766,"height":1000,"src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-8-themetidy_9aa0116f-8a90-45b7-9d8b-e0a674047739.jpg?v=1560751137","variant_ids":[22640249339989,22640249372757,22640249405525,22640249438293,22640249471061]},"available":true,"name":"Shoulder Front Tie Knot T Shirt - Red \/ 3XL \/ Polyester","public_title":"Red \/ 3XL \/ Polyester","options":["Red","3XL","Polyester"],"price":10000,"weight":50000,"compare_at_price":null,"inventory_management":null,"barcode":"","featured_media":{"alt":null,"id":1415220691029,"position":2,"preview_image":{"aspect_ratio":0.766,"height":1000,"width":766,"src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-8-themetidy_9aa0116f-8a90-45b7-9d8b-e0a674047739.jpg?v=1569187672"}}},{"id":22640249471061,"title":"Red \/ 4XL \/ Polyester","option1":"Red","option2":"4XL","option3":"Polyester","sku":"TTHABIT44","requires_shipping":true,"taxable":false,"featured_image":{"id":8274151768149,"product_id":2609383800917,"position":2,"created_at":"2019-06-17T01:58:57-04:00","updated_at":"2019-06-17T01:58:57-04:00","alt":null,"width":766,"height":1000,"src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-8-themetidy_9aa0116f-8a90-45b7-9d8b-e0a674047739.jpg?v=1560751137","variant_ids":[22640249339989,22640249372757,22640249405525,22640249438293,22640249471061]},"available":true,"name":"Shoulder Front Tie Knot T Shirt - Red \/ 4XL \/ Polyester","public_title":"Red \/ 4XL \/ Polyester","options":["Red","4XL","Polyester"],"price":10000,"weight":50000,"compare_at_price":null,"inventory_management":null,"barcode":"","featured_media":{"alt":null,"id":1415220691029,"position":2,"preview_image":{"aspect_ratio":0.766,"height":1000,"width":766,"src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-8-themetidy_9aa0116f-8a90-45b7-9d8b-e0a674047739.jpg?v=1569187672"}}},{"id":22640249503829,"title":"Green \/ M \/ Polyester","option1":"Green","option2":"M","option3":"Polyester","sku":"TTHABIT29","requires_shipping":true,"taxable":false,"featured_image":{"id":8274151997525,"product_id":2609383800917,"position":3,"created_at":"2019-06-17T01:58:59-04:00","updated_at":"2019-06-17T01:58:59-04:00","alt":null,"width":766,"height":1000,"src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-9-themetidy_d976eab5-fd7c-42e4-b749-810d93493b09.jpg?v=1560751139","variant_ids":[22640249503829,22640249536597,22640249569365,22640249602133,22640249634901]},"available":true,"name":"Shoulder Front Tie Knot T Shirt - Green \/ M \/ Polyester","public_title":"Green \/ M \/ Polyester","options":["Green","M","Polyester"],"price":10000,"weight":50000,"compare_at_price":null,"inventory_management":null,"barcode":"","featured_media":{"alt":null,"id":1415220920405,"position":3,"preview_image":{"aspect_ratio":0.766,"height":1000,"width":766,"src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-9-themetidy_d976eab5-fd7c-42e4-b749-810d93493b09.jpg?v=1569187672"}}},{"id":22640249536597,"title":"Green \/ L \/ Polyester","option1":"Green","option2":"L","option3":"Polyester","sku":"TTHABIT33","requires_shipping":true,"taxable":false,"featured_image":{"id":8274151997525,"product_id":2609383800917,"position":3,"created_at":"2019-06-17T01:58:59-04:00","updated_at":"2019-06-17T01:58:59-04:00","alt":null,"width":766,"height":1000,"src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-9-themetidy_d976eab5-fd7c-42e4-b749-810d93493b09.jpg?v=1560751139","variant_ids":[22640249503829,22640249536597,22640249569365,22640249602133,22640249634901]},"available":true,"name":"Shoulder Front Tie Knot T Shirt - Green \/ L \/ Polyester","public_title":"Green \/ L \/ Polyester","options":["Green","L","Polyester"],"price":10000,"weight":50000,"compare_at_price":null,"inventory_management":null,"barcode":"","featured_media":{"alt":null,"id":1415220920405,"position":3,"preview_image":{"aspect_ratio":0.766,"height":1000,"width":766,"src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-9-themetidy_d976eab5-fd7c-42e4-b749-810d93493b09.jpg?v=1569187672"}}},{"id":22640249569365,"title":"Green \/ XL \/ Polyester","option1":"Green","option2":"XL","option3":"Polyester","sku":"TTHABIT37","requires_shipping":true,"taxable":false,"featured_image":{"id":8274151997525,"product_id":2609383800917,"position":3,"created_at":"2019-06-17T01:58:59-04:00","updated_at":"2019-06-17T01:58:59-04:00","alt":null,"width":766,"height":1000,"src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-9-themetidy_d976eab5-fd7c-42e4-b749-810d93493b09.jpg?v=1560751139","variant_ids":[22640249503829,22640249536597,22640249569365,22640249602133,22640249634901]},"available":true,"name":"Shoulder Front Tie Knot T Shirt - Green \/ XL \/ Polyester","public_title":"Green \/ XL \/ Polyester","options":["Green","XL","Polyester"],"price":10000,"weight":50000,"compare_at_price":null,"inventory_management":null,"barcode":"","featured_media":{"alt":null,"id":1415220920405,"position":3,"preview_image":{"aspect_ratio":0.766,"height":1000,"width":766,"src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-9-themetidy_d976eab5-fd7c-42e4-b749-810d93493b09.jpg?v=1569187672"}}},{"id":22640249602133,"title":"Green \/ 3XL \/ Polyester","option1":"Green","option2":"3XL","option3":"Polyester","sku":"TTHABIT41","requires_shipping":true,"taxable":false,"featured_image":{"id":8274151997525,"product_id":2609383800917,"position":3,"created_at":"2019-06-17T01:58:59-04:00","updated_at":"2019-06-17T01:58:59-04:00","alt":null,"width":766,"height":1000,"src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-9-themetidy_d976eab5-fd7c-42e4-b749-810d93493b09.jpg?v=1560751139","variant_ids":[22640249503829,22640249536597,22640249569365,22640249602133,22640249634901]},"available":true,"name":"Shoulder Front Tie Knot T Shirt - Green \/ 3XL \/ Polyester","public_title":"Green \/ 3XL \/ Polyester","options":["Green","3XL","Polyester"],"price":10000,"weight":50000,"compare_at_price":null,"inventory_management":null,"barcode":"","featured_media":{"alt":null,"id":1415220920405,"position":3,"preview_image":{"aspect_ratio":0.766,"height":1000,"width":766,"src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-9-themetidy_d976eab5-fd7c-42e4-b749-810d93493b09.jpg?v=1569187672"}}},{"id":22640249634901,"title":"Green \/ 4XL \/ Polyester","option1":"Green","option2":"4XL","option3":"Polyester","sku":"TTHABIT45","requires_shipping":true,"taxable":false,"featured_image":{"id":8274151997525,"product_id":2609383800917,"position":3,"created_at":"2019-06-17T01:58:59-04:00","updated_at":"2019-06-17T01:58:59-04:00","alt":null,"width":766,"height":1000,"src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-9-themetidy_d976eab5-fd7c-42e4-b749-810d93493b09.jpg?v=1560751139","variant_ids":[22640249503829,22640249536597,22640249569365,22640249602133,22640249634901]},"available":true,"name":"Shoulder Front Tie Knot T Shirt - Green \/ 4XL \/ Polyester","public_title":"Green \/ 4XL \/ Polyester","options":["Green","4XL","Polyester"],"price":10000,"weight":50000,"compare_at_price":null,"inventory_management":null,"barcode":"","featured_media":{"alt":null,"id":1415220920405,"position":3,"preview_image":{"aspect_ratio":0.766,"height":1000,"width":766,"src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-9-themetidy_d976eab5-fd7c-42e4-b749-810d93493b09.jpg?v=1569187672"}}},{"id":22640249667669,"title":"Blue \/ M \/ Polyester","option1":"Blue","option2":"M","option3":"Polyester","sku":"TTHABIT30","requires_shipping":true,"taxable":false,"featured_image":{"id":8274152554581,"product_id":2609383800917,"position":5,"created_at":"2019-06-17T01:59:02-04:00","updated_at":"2019-06-17T01:59:02-04:00","alt":null,"width":766,"height":1000,"src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-11-themetidy_a6b3f116-c878-4656-9601-acb27e033ac5.jpg?v=1560751142","variant_ids":[22640249667669,22640249700437,22640249733205,22640249765973,22640249798741]},"available":true,"name":"Shoulder Front Tie Knot T Shirt - Blue \/ M \/ Polyester","public_title":"Blue \/ M \/ Polyester","options":["Blue","M","Polyester"],"price":10000,"weight":50000,"compare_at_price":null,"inventory_management":null,"barcode":"","featured_media":{"alt":null,"id":1415221411925,"position":5,"preview_image":{"aspect_ratio":0.766,"height":1000,"width":766,"src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-11-themetidy_a6b3f116-c878-4656-9601-acb27e033ac5.jpg?v=1569187672"}}},{"id":22640249700437,"title":"Blue \/ L \/ Polyester","option1":"Blue","option2":"L","option3":"Polyester","sku":"TTHABIT34","requires_shipping":true,"taxable":false,"featured_image":{"id":8274152554581,"product_id":2609383800917,"position":5,"created_at":"2019-06-17T01:59:02-04:00","updated_at":"2019-06-17T01:59:02-04:00","alt":null,"width":766,"height":1000,"src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-11-themetidy_a6b3f116-c878-4656-9601-acb27e033ac5.jpg?v=1560751142","variant_ids":[22640249667669,22640249700437,22640249733205,22640249765973,22640249798741]},"available":true,"name":"Shoulder Front Tie Knot T Shirt - Blue \/ L \/ Polyester","public_title":"Blue \/ L \/ Polyester","options":["Blue","L","Polyester"],"price":10000,"weight":50000,"compare_at_price":null,"inventory_management":null,"barcode":"","featured_media":{"alt":null,"id":1415221411925,"position":5,"preview_image":{"aspect_ratio":0.766,"height":1000,"width":766,"src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-11-themetidy_a6b3f116-c878-4656-9601-acb27e033ac5.jpg?v=1569187672"}}},{"id":22640249733205,"title":"Blue \/ XL \/ Polyester","option1":"Blue","option2":"XL","option3":"Polyester","sku":"TTHABIT38","requires_shipping":true,"taxable":false,"featured_image":{"id":8274152554581,"product_id":2609383800917,"position":5,"created_at":"2019-06-17T01:59:02-04:00","updated_at":"2019-06-17T01:59:02-04:00","alt":null,"width":766,"height":1000,"src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-11-themetidy_a6b3f116-c878-4656-9601-acb27e033ac5.jpg?v=1560751142","variant_ids":[22640249667669,22640249700437,22640249733205,22640249765973,22640249798741]},"available":true,"name":"Shoulder Front Tie Knot T Shirt - Blue \/ XL \/ Polyester","public_title":"Blue \/ XL \/ Polyester","options":["Blue","XL","Polyester"],"price":10000,"weight":50000,"compare_at_price":null,"inventory_management":null,"barcode":"","featured_media":{"alt":null,"id":1415221411925,"position":5,"preview_image":{"aspect_ratio":0.766,"height":1000,"width":766,"src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-11-themetidy_a6b3f116-c878-4656-9601-acb27e033ac5.jpg?v=1569187672"}}},{"id":22640249765973,"title":"Blue \/ 3XL \/ Polyester","option1":"Blue","option2":"3XL","option3":"Polyester","sku":"TTHABIT42","requires_shipping":true,"taxable":false,"featured_image":{"id":8274152554581,"product_id":2609383800917,"position":5,"created_at":"2019-06-17T01:59:02-04:00","updated_at":"2019-06-17T01:59:02-04:00","alt":null,"width":766,"height":1000,"src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-11-themetidy_a6b3f116-c878-4656-9601-acb27e033ac5.jpg?v=1560751142","variant_ids":[22640249667669,22640249700437,22640249733205,22640249765973,22640249798741]},"available":true,"name":"Shoulder Front Tie Knot T Shirt - Blue \/ 3XL \/ Polyester","public_title":"Blue \/ 3XL \/ Polyester","options":["Blue","3XL","Polyester"],"price":10000,"weight":50000,"compare_at_price":null,"inventory_management":null,"barcode":"","featured_media":{"alt":null,"id":1415221411925,"position":5,"preview_image":{"aspect_ratio":0.766,"height":1000,"width":766,"src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-11-themetidy_a6b3f116-c878-4656-9601-acb27e033ac5.jpg?v=1569187672"}}},{"id":22640249798741,"title":"Blue \/ 4XL \/ Polyester","option1":"Blue","option2":"4XL","option3":"Polyester","sku":"TTHABIT46","requires_shipping":true,"taxable":false,"featured_image":{"id":8274152554581,"product_id":2609383800917,"position":5,"created_at":"2019-06-17T01:59:02-04:00","updated_at":"2019-06-17T01:59:02-04:00","alt":null,"width":766,"height":1000,"src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-11-themetidy_a6b3f116-c878-4656-9601-acb27e033ac5.jpg?v=1560751142","variant_ids":[22640249667669,22640249700437,22640249733205,22640249765973,22640249798741]},"available":true,"name":"Shoulder Front Tie Knot T Shirt - Blue \/ 4XL \/ Polyester","public_title":"Blue \/ 4XL \/ Polyester","options":["Blue","4XL","Polyester"],"price":10000,"weight":50000,"compare_at_price":null,"inventory_management":null,"barcode":"","featured_media":{"alt":null,"id":1415221411925,"position":5,"preview_image":{"aspect_ratio":0.766,"height":1000,"width":766,"src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-11-themetidy_a6b3f116-c878-4656-9601-acb27e033ac5.jpg?v=1569187672"}}},{"id":22640249831509,"title":"Brown \/ M \/ Polyester","option1":"Brown","option2":"M","option3":"Polyester","sku":"TTHABIT31","requires_shipping":true,"taxable":false,"featured_image":{"id":8274152980565,"product_id":2609383800917,"position":7,"created_at":"2019-06-17T01:59:05-04:00","updated_at":"2019-06-17T01:59:05-04:00","alt":null,"width":766,"height":1000,"src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-1-themetidy_27e8619c-ec78-40a7-af7b-7cf0523b3464.jpg?v=1560751145","variant_ids":[22640249831509,22640249864277,22640249897045,22640249929813,22640249962581]},"available":true,"name":"Shoulder Front Tie Knot T Shirt - Brown \/ M \/ Polyester","public_title":"Brown \/ M \/ Polyester","options":["Brown","M","Polyester"],"price":10000,"weight":50000,"compare_at_price":null,"inventory_management":null,"barcode":"","featured_media":{"alt":null,"id":1415221837909,"position":7,"preview_image":{"aspect_ratio":0.766,"height":1000,"width":766,"src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-1-themetidy_27e8619c-ec78-40a7-af7b-7cf0523b3464.jpg?v=1569187672"}}},{"id":22640249864277,"title":"Brown \/ L \/ Polyester","option1":"Brown","option2":"L","option3":"Polyester","sku":"TTHABIT35","requires_shipping":true,"taxable":false,"featured_image":{"id":8274152980565,"product_id":2609383800917,"position":7,"created_at":"2019-06-17T01:59:05-04:00","updated_at":"2019-06-17T01:59:05-04:00","alt":null,"width":766,"height":1000,"src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-1-themetidy_27e8619c-ec78-40a7-af7b-7cf0523b3464.jpg?v=1560751145","variant_ids":[22640249831509,22640249864277,22640249897045,22640249929813,22640249962581]},"available":true,"name":"Shoulder Front Tie Knot T Shirt - Brown \/ L \/ Polyester","public_title":"Brown \/ L \/ Polyester","options":["Brown","L","Polyester"],"price":10000,"weight":50000,"compare_at_price":null,"inventory_management":null,"barcode":"","featured_media":{"alt":null,"id":1415221837909,"position":7,"preview_image":{"aspect_ratio":0.766,"height":1000,"width":766,"src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-1-themetidy_27e8619c-ec78-40a7-af7b-7cf0523b3464.jpg?v=1569187672"}}},{"id":22640249897045,"title":"Brown \/ XL \/ Polyester","option1":"Brown","option2":"XL","option3":"Polyester","sku":"TTHABIT39","requires_shipping":true,"taxable":false,"featured_image":{"id":8274152980565,"product_id":2609383800917,"position":7,"created_at":"2019-06-17T01:59:05-04:00","updated_at":"2019-06-17T01:59:05-04:00","alt":null,"width":766,"height":1000,"src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-1-themetidy_27e8619c-ec78-40a7-af7b-7cf0523b3464.jpg?v=1560751145","variant_ids":[22640249831509,22640249864277,22640249897045,22640249929813,22640249962581]},"available":true,"name":"Shoulder Front Tie Knot T Shirt - Brown \/ XL \/ Polyester","public_title":"Brown \/ XL \/ Polyester","options":["Brown","XL","Polyester"],"price":10000,"weight":50000,"compare_at_price":null,"inventory_management":null,"barcode":"","featured_media":{"alt":null,"id":1415221837909,"position":7,"preview_image":{"aspect_ratio":0.766,"height":1000,"width":766,"src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-1-themetidy_27e8619c-ec78-40a7-af7b-7cf0523b3464.jpg?v=1569187672"}}},{"id":22640249929813,"title":"Brown \/ 3XL \/ Polyester","option1":"Brown","option2":"3XL","option3":"Polyester","sku":"TTHABIT43","requires_shipping":true,"taxable":false,"featured_image":{"id":8274152980565,"product_id":2609383800917,"position":7,"created_at":"2019-06-17T01:59:05-04:00","updated_at":"2019-06-17T01:59:05-04:00","alt":null,"width":766,"height":1000,"src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-1-themetidy_27e8619c-ec78-40a7-af7b-7cf0523b3464.jpg?v=1560751145","variant_ids":[22640249831509,22640249864277,22640249897045,22640249929813,22640249962581]},"available":true,"name":"Shoulder Front Tie Knot T Shirt - Brown \/ 3XL \/ Polyester","public_title":"Brown \/ 3XL \/ Polyester","options":["Brown","3XL","Polyester"],"price":10000,"weight":50000,"compare_at_price":null,"inventory_management":null,"barcode":"","featured_media":{"alt":null,"id":1415221837909,"position":7,"preview_image":{"aspect_ratio":0.766,"height":1000,"width":766,"src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-1-themetidy_27e8619c-ec78-40a7-af7b-7cf0523b3464.jpg?v=1569187672"}}},{"id":22640249962581,"title":"Brown \/ 4XL \/ Polyester","option1":"Brown","option2":"4XL","option3":"Polyester","sku":"TTHABIT47","requires_shipping":true,"taxable":false,"featured_image":{"id":8274152980565,"product_id":2609383800917,"position":7,"created_at":"2019-06-17T01:59:05-04:00","updated_at":"2019-06-17T01:59:05-04:00","alt":null,"width":766,"height":1000,"src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-1-themetidy_27e8619c-ec78-40a7-af7b-7cf0523b3464.jpg?v=1560751145","variant_ids":[22640249831509,22640249864277,22640249897045,22640249929813,22640249962581]},"available":true,"name":"Shoulder Front Tie Knot T Shirt - Brown \/ 4XL \/ Polyester","public_title":"Brown \/ 4XL \/ Polyester","options":["Brown","4XL","Polyester"],"price":10000,"weight":50000,"compare_at_price":null,"inventory_management":null,"barcode":"","featured_media":{"alt":null,"id":1415221837909,"position":7,"preview_image":{"aspect_ratio":0.766,"height":1000,"width":766,"src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-1-themetidy_27e8619c-ec78-40a7-af7b-7cf0523b3464.jpg?v=1569187672"}}}],"images":["\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-7-themetidy_433dd612-4dfe-4e2f-bcea-43382ef1ec67.jpg?v=1560751136","\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-8-themetidy_9aa0116f-8a90-45b7-9d8b-e0a674047739.jpg?v=1560751137","\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-9-themetidy_d976eab5-fd7c-42e4-b749-810d93493b09.jpg?v=1560751139","\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-10-themetidy_fe452558-1e67-498b-9345-b6305c471187.jpg?v=1560751141","\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-11-themetidy_a6b3f116-c878-4656-9601-acb27e033ac5.jpg?v=1560751142","\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-12-themetidy_022cf871-9dce-46dc-9206-8d080c918cdf.jpg?v=1560751144","\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-1-themetidy_27e8619c-ec78-40a7-af7b-7cf0523b3464.jpg?v=1560751145","\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-2-themetidy_b2b59758-0704-4879-9f12-e7a54227b07c.jpg?v=1560751147","\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-3-themetidy_f9c61d7e-00b2-42b2-a66a-18db7f1c1651.jpg?v=1560751148","\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-4-themetidy_fa94ed5f-a0a8-4645-a0f0-f038d91db36d.jpg?v=1560751150","\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-5-themetidy_2d5620ef-e2ec-4c6d-92b4-e64dd6ef1ee2.jpg?v=1560751152","\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-6-themetidy_4bf7995e-fb6c-4791-9e2b-fef98b2d6ac8.jpg?v=1560751153"],"featured_image":"\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-7-themetidy_433dd612-4dfe-4e2f-bcea-43382ef1ec67.jpg?v=1560751136","options":["Color","Size","Material"],"media":[{"alt":null,"id":1415220461653,"position":1,"preview_image":{"aspect_ratio":0.766,"height":1000,"width":766,"src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-7-themetidy_433dd612-4dfe-4e2f-bcea-43382ef1ec67.jpg?v=1569187672"},"aspect_ratio":0.766,"height":1000,"media_type":"image","src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-7-themetidy_433dd612-4dfe-4e2f-bcea-43382ef1ec67.jpg?v=1569187672","width":766},{"alt":null,"id":1415220691029,"position":2,"preview_image":{"aspect_ratio":0.766,"height":1000,"width":766,"src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-8-themetidy_9aa0116f-8a90-45b7-9d8b-e0a674047739.jpg?v=1569187672"},"aspect_ratio":0.766,"height":1000,"media_type":"image","src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-8-themetidy_9aa0116f-8a90-45b7-9d8b-e0a674047739.jpg?v=1569187672","width":766},{"alt":null,"id":1415220920405,"position":3,"preview_image":{"aspect_ratio":0.766,"height":1000,"width":766,"src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-9-themetidy_d976eab5-fd7c-42e4-b749-810d93493b09.jpg?v=1569187672"},"aspect_ratio":0.766,"height":1000,"media_type":"image","src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-9-themetidy_d976eab5-fd7c-42e4-b749-810d93493b09.jpg?v=1569187672","width":766},{"alt":null,"id":1415221215317,"position":4,"preview_image":{"aspect_ratio":0.766,"height":1000,"width":766,"src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-10-themetidy_fe452558-1e67-498b-9345-b6305c471187.jpg?v=1569187672"},"aspect_ratio":0.766,"height":1000,"media_type":"image","src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-10-themetidy_fe452558-1e67-498b-9345-b6305c471187.jpg?v=1569187672","width":766},{"alt":null,"id":1415221411925,"position":5,"preview_image":{"aspect_ratio":0.766,"height":1000,"width":766,"src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-11-themetidy_a6b3f116-c878-4656-9601-acb27e033ac5.jpg?v=1569187672"},"aspect_ratio":0.766,"height":1000,"media_type":"image","src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-11-themetidy_a6b3f116-c878-4656-9601-acb27e033ac5.jpg?v=1569187672","width":766},{"alt":null,"id":1415221641301,"position":6,"preview_image":{"aspect_ratio":0.766,"height":1000,"width":766,"src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-12-themetidy_022cf871-9dce-46dc-9206-8d080c918cdf.jpg?v=1569187672"},"aspect_ratio":0.766,"height":1000,"media_type":"image","src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-12-themetidy_022cf871-9dce-46dc-9206-8d080c918cdf.jpg?v=1569187672","width":766},{"alt":null,"id":1415221837909,"position":7,"preview_image":{"aspect_ratio":0.766,"height":1000,"width":766,"src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-1-themetidy_27e8619c-ec78-40a7-af7b-7cf0523b3464.jpg?v=1569187672"},"aspect_ratio":0.766,"height":1000,"media_type":"image","src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-1-themetidy_27e8619c-ec78-40a7-af7b-7cf0523b3464.jpg?v=1569187672","width":766},{"alt":null,"id":1415222034517,"position":8,"preview_image":{"aspect_ratio":0.766,"height":1000,"width":766,"src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-2-themetidy_b2b59758-0704-4879-9f12-e7a54227b07c.jpg?v=1569187672"},"aspect_ratio":0.766,"height":1000,"media_type":"image","src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-2-themetidy_b2b59758-0704-4879-9f12-e7a54227b07c.jpg?v=1569187672","width":766},{"alt":null,"id":1415222231125,"position":9,"preview_image":{"aspect_ratio":0.766,"height":1000,"width":766,"src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-3-themetidy_f9c61d7e-00b2-42b2-a66a-18db7f1c1651.jpg?v=1569187672"},"aspect_ratio":0.766,"height":1000,"media_type":"image","src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-3-themetidy_f9c61d7e-00b2-42b2-a66a-18db7f1c1651.jpg?v=1569187672","width":766},{"alt":null,"id":1415222460501,"position":10,"preview_image":{"aspect_ratio":0.766,"height":1000,"width":766,"src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-4-themetidy_fa94ed5f-a0a8-4645-a0f0-f038d91db36d.jpg?v=1569187672"},"aspect_ratio":0.766,"height":1000,"media_type":"image","src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-4-themetidy_fa94ed5f-a0a8-4645-a0f0-f038d91db36d.jpg?v=1569187672","width":766},{"alt":null,"id":1415222722645,"position":11,"preview_image":{"aspect_ratio":0.766,"height":1000,"width":766,"src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-5-themetidy_2d5620ef-e2ec-4c6d-92b4-e64dd6ef1ee2.jpg?v=1569187672"},"aspect_ratio":0.766,"height":1000,"media_type":"image","src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-5-themetidy_2d5620ef-e2ec-4c6d-92b4-e64dd6ef1ee2.jpg?v=1569187672","width":766},{"alt":null,"id":1415222984789,"position":12,"preview_image":{"aspect_ratio":0.766,"height":1000,"width":766,"src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-6-themetidy_4bf7995e-fb6c-4791-9e2b-fef98b2d6ac8.jpg?v=1569187672"},"aspect_ratio":0.766,"height":1000,"media_type":"image","src":"https:\/\/cdn.shopify.com\/s\/files\/1\/0087\/9303\/0741\/products\/fake-multipurpose-ecommerce-clothing-fashion-shop-responsive-shopify-theme-product-image-6-themetidy_4bf7995e-fb6c-4791-9e2b-fef98b2d6ac8.jpg?v=1569187672","width":766}],"content":"\u003cp\u003e\u003cstrong\u003eAdvanced Features Shopify Theme\u003c\/strong\u003e\u003c\/p\u003e\n\u003cp\u003eGet the latest fashion tips and outfit ideas from your favorite celebrities and designers. Click through runway and front row photos from fashion week shows in New York, London, Paris, and Milan. Plus: browse key accessories like bags, shoes, and sunglasses, must-have denim looks, and more top fashion trends.\u003c\/p\u003e\n\u003col\u003e\n\u003cli\u003eC'est magnifique! How to look French when you're not\u003c\/li\u003e\n\u003cli\u003eThe best nutty fragrances\u003c\/li\u003e\n\u003cli\u003eHow to wear: matinee glamour for the festive season\u003c\/li\u003e\n\u003cli\u003eFrom ginger to Michael Bublé: this week’s fashion trends\u003c\/li\u003e\n\u003cli\u003eFashion designer Raf Simons leaves Calvin Klein\u003c\/li\u003e\n\u003cli\u003eFrom drab to fab: the six quickest ways to get Christmas party-ready\u003c\/li\u003e\n\u003cli\u003eThe best beauty stocking fillers for £10 or less\u003c\/li\u003e\n\u003cli\u003eWhy the humble hair clip is this season's must-have accessory\u003c\/li\u003e\n\u003cli\u003eHow to wear... utilitarian\u003c\/li\u003e\n\u003cli\u003eJudy Blame remembered by Boy George\u003c\/li\u003e\n\u003c\/ol\u003e\n\u003cp\u003e\u003cstrong\u003eFashion Shopify Theme\u003c\/strong\u003e\u003c\/p\u003e\n\u003cp\u003eEarly Western travelers, traveling whether to India, Persia, Turkey or China, would frequently remark on the absence of change in fashion in those countries. The Japanese shōgun's secretary bragged (not completely accurately) to a Spanish visitor in 1609 that Japanese clothing had not changed in over a thousand years. However, there is considerable evidence in Ming China of rapidly changing fashions in Chinese clothing. Changes in costume often took place at times of economic or social change, as occurred in ancient Rome and the medieval Caliphate, followed by a long period without major changes. In 8th-century Moorish Spain, the musician Ziryab introduced to Córdoba sophisticated clothing-styles based on seasonal and daily fashions from his native Baghdad, modified by his own inspiration. Similar changes in fashion occurred in the 11th century in the Middle East following the arrival of the Turks, who introduced clothing styles from Central Asia and the Far East. \u003c\/p\u003e\n\u003col\u003e\u003c\/ol\u003e\n\u003cp\u003e \u003c\/p\u003e"}, onVariantSelected: selectCallback});
        // Add label if only one product option and it isn't 'Title'.

        if ($(".product-options .selector-wrapper").length) {
            $(".product-options .selector-wrapper").each(function(){
                var switch_ID = $(this).find('.single-option-selector').attr('id'),
                        option_title = $(this).find('label').text(),
                        option_title_default = '';
                if(option_title.length == 0) {
                    option_title_default = 'style="display:none"';
                }
                $('.paira-option-switch').append('<div class="'+switch_ID+' margin-bottom-20" '+option_title_default+'><strong class="label-name-'+option_title.toLowerCase()+'">'+option_title+':</strong><ul class="list-inline"></ul></div>');
                $(this).find('.single-option-selector option').each(function(i, v){
                    var text = '', val = 'white', select_first = '', dataVal = $(this).val(), colorClass = '';
                    if(i == 0){
                        select_first = 'active';
                    }
                    if(option_title == 'Color'){
                        var val = $(this).val(),
                                colorClass = 'color-option-class',
                                imageUrl = $('.paira-variant-image-'+val.toLowerCase()).attr('data-variant-image');
                        $('.'+switch_ID+' ul').append('<li data-toggle="tooltip" data-placement="top" title="'+ val +'" class="margin-top-10 '+ colorClass +'"><button type="button" id="'+switch_ID+'" data-value="'+ dataVal +'" style="background-color: '+ val.toLowerCase() +';" class="select_options '+ select_first +'"><span style="background: url('+ imageUrl +')"></span></button></li>');
                    } else{
                        text = $(this).text();
                        $('.'+switch_ID+' ul').append('<li class="margin-top-10 '+ colorClass +'"><button type="button" id="'+switch_ID+'" data-value="'+ dataVal +'" style="background-color: '+ val.toLowerCase() +';" class="select_options '+ select_first +'"><span>'+ text +'</span></button></li>');
                    }
                });
            });
        }
        $(document).on("click", ".select_options", function() {
            $('.selector-wrapper #'+$(this).attr('id')).val($(this).attr('data-value')).trigger('change');
        });
        $(document).on("click", ".paira-quantity-group .input-group-addon", function() {
            var t = $(this).attr("data-direction"),
                    n = $(this).parent().children('input[type="text"]'),
                    i = n.val();
            if ("up" == t){
                i++;
                n.val(i);
            } else if ("down" == t) {
                if (1 == i) return;
                i--;
                n.val(i);
            }
            $('.paira-add-to-cart').attr('data-item-quantity', n.val());
            $('.paira-buy-now').attr('data-item-quantity', n.val());
        });
        if($('.paira-single-product-count .paira-countdown').length) {
            $('.paira-single-product-count').show();
        }
        $(document).on('click', '.select_options', function() {
            $(this).parents('ul').find('.select_options').removeClass('active');
            $(this).addClass('active');
        });
        $(document).on("click", ".sicoal-share-widget a", function(p) {
            p.preventDefault();
            SocialShare(this.href,'Social Share','650','350');
            return false;
        });
        $("#basic-waypoint").waypoint({
            handler: function(direction) {
                $(".sticky-price-cart").toggleClass('cart-sticky', direction=='down');
                $(".notify-container").toggleClass('top-position');
            }
        });

        /*******************************************************************************
         * Total Sold
         *******************************************************************************/
        function getRandomArbitrary(min, max) {
            return Math.floor(Math.random() * (max - min + 1)) + min;
        }
        $(".paira-total-sold").text(getRandomArbitrary(10,15));


        /*******************************************************************************
         * Total Active View
         *******************************************************************************/
        function getandomArbitrary(min, max) {
            return Math.floor(Math.random() * (max - min + 1)) + min;
        }
        $(".paira-total-viewing").text(getandomArbitrary(30,50));

        /*******************************************************************************
         * Total Availability
         *******************************************************************************/
        function getanAvaiArbitrary(min, max) {
            return Math.floor(Math.random() * (max - min + 1)) + min;
        }
        $(".paira-total-available").text(getanAvaiArbitrary(40,100));
        $(".paira-progress-bar").css("width", parseInt($(".paira-total-available").text())+'%');
        var interval = setInterval(function(){
            var total_sold = parseInt($(".paira-total-sold").text()),
                    total_available = parseInt($(".paira-total-available").text());
            if(total_available <= 40){
                clearInterval(interval);
            }else {
                $(".paira-total-sold").text(total_sold+1);
                $(".paira-total-available").text(total_available-1);
                $(".paira-progress-bar").css("width", total_available-1+'%');
            }
        }, 8000);


        JsBarcode("#barcode", "HST201968", {
            lineColor: "rgba(26, 28, 21, 0.6)",
            background: "transparent",
            width: 1.5,
            marginTop: 25,
            marginLeft: 0,
            height: 30,
            fontSize: 16,
            margin: 0,
            font: ""Open Sans"",
            displayValue: true
        });


        $(document).on('click', '.videos', function() {
            $("#playvideo").show();
            $("#playvideo .modal-body").html('<iframe id="ytplayer" width="100" height="480" src="https://www.youtube.com/embed/VkuLRLsKbcI?vq=hd720&amp;autoplay=0&amp;modestbranding=1&amp;controls=1&amp;showinfo=0&amp;rel=0&amp;enablejsapi=1&amp;version=3&amp;playerapiid=mbYTP_Video&amp;allowfullscreen=true&amp;wmode=transparent&amp;iv_load_policy=3&amp;html5=1&amp;widgetid=1" frameborder="0" allowfullscreen=""></iframe>');
        });
        $(document).on('click', '.close-video', function() {
            $("#playvideo").hide();
            $("#playvideo .modal-body").html("");
        });
    });
</script>
<style>
    .playvideo #ytplayer {
    height: 400px !important;
    width: 100%;
    }
    .playvideo .modal-dialog {
    width: 38%;
    }

    .ask-margin {
        margin-left: 60px;
    }

    .icon-banner {
        padding: 0;
    }
    .icon-banner h4{
    color: #000;
    font-size: 14px;
    line-height: 1;
    }
    .icon-banner p{
    color: #565656;
    font-size: 12px;
    }
    .playvideo {
        background: rgba(26, 28, 21, 0.7)!important;
    }
</style>
</div>
    <!--=================== Footer Container ===================-->

    <?php
	} else { 
		session_destroy();
		echo "<meta http-equiv='refresh' content='0; url=index.php'>";
		echo "<script>alert('silahkan login terlebih dahulu')</script>";
	}
    ?>