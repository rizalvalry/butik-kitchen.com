<?php
error_reporting(0);
session_start();
require "config/koneksi.php";
$query00 = $db->query("SELECT nama_toko,email_pengelola,nomor_hp,meta_deskripsi,static_content, alamat, nomor_hp, email_protokol, gambar, alamat_web FROM profil");
$row00 = $query00->fetch_assoc();
$nama_toko00 = explode(" ", $row00['nama_toko']);
$tahun = date("Y");
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    
            <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-W9VF9GP');</script>
<!-- End Google Tag Manager -->
        
                <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-126260045-1"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
        
          gtag('config', 'UA-126260045-1');
        </script>



        <title><?= $row00['nama_toko']; ?> | <?php include 'dina_meta1.php'; ?></title>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta property="twitter:twitter" content="<?php include 'dina_meta1.php'; ?>" />
        <meta property="twitter:description" content="<?php include 'dina_meta1.php'; ?>" />
        <meta property="og:type" content="website" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=1.0" />
        <meta name="<?php include 'dina_meta2.php'; ?>" content="True" />
        <meta name="description" content="<?php include 'dina_meta2.php'; ?>" />
        <meta name="keywords" content="<?php include 'dina_meta2.php'; ?>" />
        <meta name="robots" content="index, follow" />
        
        
        
        <!-- Favicon -->
		<link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">

		<!-- all css here -->
		<!-- bootstrap v3.3.6 css -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
		<!-- animate css -->
        <link rel="stylesheet" href="css/animate.css">
		<!-- jquery-ui.min css -->
        <link rel="stylesheet" href="css/jquery-ui.min.css">
		<!-- meanmenu css -->
        <link rel="stylesheet" href="css/meanmenu.min.css">
		<!-- owl.carousel css -->
        <link rel="stylesheet" href="css/owl.carousel.css">
        <!-- magnific-popup css -->
        <link rel="stylesheet" href="css/magnific-popup.css">
		<!-- font-awesome css -->
        <link rel="stylesheet" href="css/font-awesome.min.css">
		<!-- ionicons.min css -->
        <link rel="stylesheet" href="css/ionicons.min.css">
		<!-- nivo-slider.css -->
        <link rel="stylesheet" href="css/nivo-slider.css">
		<!-- style css -->
		<link rel="stylesheet" href="style.css">
		<!-- responsive css -->
        <link rel="stylesheet" href="css/responsive.css">
		<!-- modernizr css -->
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W9VF9GP"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->  
    
<header>
            <!-- header-top-area-start -->
            <div class="header-top-area" id="sticky-header">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-2 col-lg-2 col-md-6 col-6">
                            <!-- logo-area-start -->
                            <div class="logo-area">
                                <a href="/"><img src="gambar/toko/<?php echo $row00['gambar']; ?>" alt="logo" /></a>
                            </div>
                            <!-- logo-area-end -->
                        </div>
                        <div class="col-xl-8 col-lg-8 d-none d-lg-block">
                            <!-- menu-area-start -->
                            <div class="menu-area menu-area-center">
                                <nav>
                                    <ul>
                                        <li><a href="/">Home</a>
                                        </li>
                                        <!-- <li>
                                        <a href="#">Men & Women</a>
                                            <ul class="mega-menu">
                                            <?php
											$query1 = $db->prepare("SELECT id_kategori,nama_kategori FROM kategori_produk ORDER BY nama_kategori ASC");
											$query1->execute();
											$result1= $query1->get_result();
											while ( $row1 = $result1->fetch_assoc() ){
												echo '<li>'.$row1['nama_kategori'];
												$query2 = $db->prepare("SELECT id_subkategori,nama_subkategori,subkategori_seo FROM subkategori_produk WHERE aktif=? AND id_kategori=? ORDER BY nama_subkategori ASC");
												$query2->bind_param("si", $aktif2,$id_kategori2);
												$id_kategori2 = $row1['id_kategori'];
												$aktif2       = "Y";
												$query2->execute();
												$result2      = $query2->get_result();
												while ( $row2         = $result2->fetch_assoc() ){
													echo '<ul class="sub-menu-2">';
													echo '<li><a class="list" href="kategori-'.$row2['id_subkategori'].'-'.$row2['subkategori_seo'].'">'.$row2['nama_subkategori'].'</a></li>';
													echo '</ul>';
												}
												echo '</li>';
											}
										?>
                                            </ul>
                                        </li>
                                        <li><a href="#">Artikel</a>
                                            <ul class="mega-menu mega-menu-2">

                                            <?php
                                                $query3 = $db->prepare("SELECT id_kategori,nama_kategori,kategori_seo FROM kategori_artikel WHERE aktif=? ORDER BY nama_kategori ASC");
                                                $query3->bind_param("s", $aktif3);
                                                $aktif3 = "Y";
                                                $query3->execute();
                                                $result3= $query3->get_result();
                                                while ( $row3 = $result3->fetch_assoc() ){
									
												echo '<li><a href="label-'.$row3['id_kategori'].'-'.$row3['kategori_seo'].'">'.$row3['nama_kategori'].'</a></li>';
									
											}
										?>
                                            </ul>
                                        </li> -->

                                        <?php
                                            $query4  = $db->prepare("SELECT nama_menu,link FROM menuutama WHERE aktif=? AND lokasi=? ORDER BY urutan ASC");
                                            $query4->bind_param("ss", $aktif4,$lokasi4);
                                            $lokasi4 = "Public";
                                            $aktif4  = "Y";
                                            $query4->execute();
                                            $result4 = $query4->get_result();
                                            while ( $row4 = $result4->fetch_assoc() ){ ?>

                                        <li><a href="<?= $row4['link']; ?>"><?= $row4['nama_menu']; ?></a></li>

                                        <?php } ?>

                                    </ul>
                                </nav>
                            </div>
                            <!-- menu-area-end -->
                        </div>
                        <div class="col-xl-2 col-lg-2 com-md-6 col-6">
                            <!-- header-right-area-start -->
                            <div class="header-right-area header-right-hm7">
                                <ul>
                                    <li><a id="show-search" href="#"><i class="icon ion-ios-search-strong"></i></a>
                                        <div class="search-content" id="hide-search">
                                            <span class="close" id="close-search">
                                                <i class="ion-close"></i>
                                            </span>
                                            <div class="search-text">
                                                <h1>Search</h1>
                                                <form action="#">
                                                    <input type="text" placeholder="search"/>
                                                    <button class="btn" type="button">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <!-- header-right-area-end -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- header-top-area-end -->

            <!-- mobile-menu-area-start -->
            <div class="mobile-menu-area d-block d-lg-none clearfix">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mobile-menu">
                                <nav id="mobile-menu-active">
                                    <ul id="nav">
                                        <li><a href="/">Home</a></li>
                                        <!-- <li><a href="#">Men & Women</a>
                                            <div class="margin-both">
                                                <ul class="seed-both">
                                                    <?php
                                                    $query1 = $db->prepare("SELECT id_kategori,nama_kategori FROM kategori_produk ORDER BY nama_kategori ASC");
                                                    $query1->execute();
                                                    $result1= $query1->get_result();
                                                    while ( $row1 = $result1->fetch_assoc() ){
                                                        echo '<li>'.$row1['nama_kategori'];
                                                        $query2 = $db->prepare("SELECT id_subkategori,nama_subkategori,subkategori_seo FROM subkategori_produk WHERE aktif=? AND id_kategori=? ORDER BY nama_subkategori ASC");
                                                        $query2->bind_param("si", $aktif2,$id_kategori2);
                                                        $id_kategori2 = $row1['id_kategori'];
                                                        $aktif2       = "Y";
                                                        $query2->execute();
                                                        $result2      = $query2->get_result();
                                                        while ( $row2         = $result2->fetch_assoc() ){
                                                            echo '<ul class="sub-menu-2">';
                                                            echo '<li><a class="list" href="kategori-'.$row2['id_subkategori'].'-'.$row2['subkategori_seo'].'">'.$row2['nama_subkategori'].'</a></li>';
                                                            echo '</ul>';
                                                        }
                                                        echo '</li>';
                                                            }
                                                        ?>
                                                    </ul>
                                            </div>
                                        </li>
                                        <li><a href="#">Artikel</a>
                                            <ul>

                                                <?php
                                                    $query3 = $db->prepare("SELECT id_kategori,nama_kategori,kategori_seo FROM kategori_artikel WHERE aktif=? ORDER BY nama_kategori ASC");
                                                    $query3->bind_param("s", $aktif3);
                                                    $aktif3 = "Y";
                                                    $query3->execute();
                                                    $result3= $query3->get_result();
                                                    while ( $row3 = $result3->fetch_assoc() ){

                                                    echo '<li><a href="label-'.$row3['id_kategori'].'-'.$row3['kategori_seo'].'.html">'.$row3['nama_kategori'].'</a></li>';

                                                }
                                                ?>
                                            </ul>
                                        </li> -->
                                        <?php
                                            $query4  = $db->prepare("SELECT nama_menu,link FROM menuutama WHERE aktif=? AND lokasi=? ORDER BY urutan ASC");
                                            $query4->bind_param("ss", $aktif4,$lokasi4);
                                            $lokasi4 = "Public";
                                            $aktif4  = "Y";
                                            $query4->execute();
                                            $result4 = $query4->get_result();
                                            while ( $row4 = $result4->fetch_assoc() ){ ?>

                                        <li><a href="<?= $row4['link']; ?>"><?= $row4['nama_menu']; ?></a></li>
                                        <?php } ?>

                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- mobile-menu-area-end -->
        </header>
        <!-- header-area-end -->


        
    <!-- main body -->
    <?php include "tengah.php";?>
    <!-- end main body -->


    <!-- footer-area-start -->
    <footer>
            <!-- footer-top-area-start -->
            <div class="footer-top-area ptb-80">
                <div class="container">
                    
                <div class="row">
             

                        <?php $queryfooter = $db->query("SELECT * from testimoni where aktif = 'Y'");
while ($loop = $queryfooter->fetch_assoc()) {?>

                            <!--=================== Footer Middle Column 3 ===================-->
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12 mb-40-2 mb-40-3">
                        
                                <h4 class="margin-clear margin-bottom-15"><?php echo $loop['nama_lengkap']; ?></h4>
                                <ul>
                                    <li><?php
if (empty($loop['testimoni'])) {
    $queryIfEmpty = $db->prepare("SELECT id_kategori,nama_kategori FROM kategori_produk ORDER BY nama_kategori ASC");
    $queryIfEmpty->execute();
    $result1 = $queryIfEmpty->get_result();

    while ($row1 = $result1->fetch_assoc()) {
        echo '<li>' . $row1['nama_kategori'] . '</li>';
    }
} else {
    echo $loop['testimoni'];
}

    ?></li>
                                </ul>

                            </div>
                        <?php }?>

                                    
                    </div>
                </div>
            </div>
            <!-- footer-top-area-end -->
            <div class="footer-area bg  ptb-40">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                            <!-- copy-right-area-start -->
                            <div class="copy-right-area mb-3">
                                <p>Copyright © 2020 <a href="butik-kitchen.com">butik-kitchen.com</a> . All Right Reserved</p>
                            </div>
                            <!-- copy-right-area-end -->
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                            <!-- footer-bottom-menu-start -->
                            <div class="footer-bottom-menu">
                                <ul>
                                    <li><a href="#">Policy</a></li>
                                    <li><a href="#">Term & Conditions</a></li>
                                    <li><a href="#">Affiliate</a></li>
                                    <li><a href="#">Help</a></li>
                                </ul>
                            </div>
                            <!-- footer-bottom-menu-end -->
                        </div>
                    </div>
                </div>
            </div>
       </footer>
        <!-- footer-area-end -->

   <!-- modal-area-start -->
   <div class="modal-area">
            <!-- single-modal-start -->
            <div class="modal fade" id="mymodal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="modal-img">
                                <div class="single-img">
                                    <img src="img/product/2.jpg" alt="hat" class="primary" />
                                </div>
                            </div>
                            <div class="model-text">
                                <h2><a href="#">Pyrolux Pyrostone</a> </h2>
                                <div class="product-rating">
                                    <a href="#"><i class="fa fa-star"></i></a>
                                    <a href="#"><i class="fa fa-star"></i></a>
                                    <a href="#"><i class="fa fa-star"></i></a>
                                    <a href="#"><i class="fa fa-star"></i></a>
                                    <a href="#"><i class="fa fa-star-o"></i></a>
                                </div>
                                <div class="price-rate">
                                    <span class="old-price"><del>$30.00</del></span>
                                    <span class="new-price">$28.00</span>
                                </div>
                                <div class="short-description mt-20">
                                    <p>Bacon ipsum dolor sit amet ut nostrud chuck, voluptate adipisicing veniam kielbasa fugiat ex spare ribs. Incididunt sint officia non cow, ut et. Cillum porchetta tongue occaecat laborum bacon aliquip fatback flank dolore short loin ball tip bresaola deserunt dolor. Shoulder fugiat ut in ut tail swine dolore, capicola ullamco beef occaecat meatball. Laboris turkey in et chuck deserunt ad incididunt do.</p>
                                </div>
                                <form action="#">
                                    <input type="number" value="1"/>
                                    <button type="submit">Add to cart</button>
                                </form>
                                <div class="product-meta">
                                    <span>
                                        Categories: 
                                        <a href="#">albums</a>,<a href="#">Music</a>
                                    </span>
                                    <span>
                                        Tags: 
                                        <a href="#">albums</a>,<a href="#">Music</a>
                                    </span>
                                </div>
                                <!-- social-icon-start -->
                                <div class="social-icon mt-20">
                                    <ul>
                                        <li><a href="#" data-toggle="tooltip" title="Share on Facebook"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#" data-toggle="tooltip" title="Share on Twitter"><i  class="fa fa-twitter"></i></a></li>
                                        <li><a href="#" data-toggle="tooltip" title="Email to a Friend"><i class="fa fa-envelope-o"></i></a></li>
                                        <li><a href="#" data-toggle="tooltip" title="Pin on Pinterest"><i class="fa fa-pinterest"></i></a></li>
                                        <li><a href="#" data-toggle="tooltip" title="Share on Google+"><i class="fa fa-google-plus"></i></a></li>
                                    </ul>
                                </div>
                                <!-- social-icon-end -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- single-modal-end -->
        </div>
        <!-- modal-area-end -->

        <!-- options 1 whatsapp -->
        <!-- <a href="https://api.whatsapp.com/send?phone=51955081075&text=Hola%21%20Quisiera%20m%C3%A1s%20informaci%C3%B3n%20sobre%20Varela%202." class="float" target="_blank">
        <i class="fa fa-whatsapp my-float"></i>
        </a> -->

        <!-- options 2 whatsapp -->
        <!-- <div class="fixed-tabs-Whats">
            <div class="aba-whatsphone">
                <div class="aba-whatsphone-icone">
                <a target="_blank" href="https://wa.me/<?= $row00['nomor_hp']; ?>"><?= $row00['alamat_web']; ?> <br><strong>Tanpa Antri!</strong></a>          
                </div>
            </div>          
        </div> -->

        <!-- options 3  -->
        <div class="fab-wrapper wow fadeInUp animated" data-wow-delay=".2s">
            <input id="fabCheckbox" type="checkbox" class="fab-checkbox" />
            <label class="fab" for="fabCheckbox">
                <span class="fab-dots fab-dots-1"></span>
                <span class="fab-dots fab-dots-2"></span>
                <span class="fab-dots fab-dots-3"></span>
            </label>
            <div class="fab-wheel">
                <a class="fab-action fab-action-1" href="https://api.whatsapp.com/send?phone=<?php echo $row00['nomor_hp']; ?>&text=Halo%20*Butik(butik-kitchen)*,%20saya%20ingin%20consultasi%20dengan%20anda" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=700,height=450');return false;">
                <i class="fa fa-whatsapp" style="color:green;"  aria-hidden="true"></i>
                </a>
                <a class="fab-action fab-action-2" href="https://www.instagram.com/butikkitchen.official/" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=700,height=450');return false;">
                <i class="fa fa-instagram" style="color:red;" aria-hidden="true"></i>
                </a>
                    <a class="fab-action fab-action-3" href="tel:<?php echo $row00['nomor_hp']; ?>">
                    <i class="fa fa-phone" style="color:black;" aria-hidden="true"></i>
                </a>
                    <a class="fab-action fab-action-4" href="hubungi-kami">
                    <i class="fa fa-paper-plane" style="color:blue;" aria-hidden="true"></i>
                </a>
            </div>
        </div>
        <!-- end options -->

       
    
            <!-- link googlemap API -->
            <!-- https://embedgooglemap.xyz/?gclid=CjwKCAiA8ov_BRAoEiwAOZogwYqunc5Hh7DfOLYtJkJOYJT6L8lI9rYC3sINbS5ln7ROQ128yBlXqhoC_QwQAvD_BwE -->
    
    <!-- all js here -->
		<!-- jquery latest version -->
        <script src="js/vendor/jquery-v3.4.1.min.js"></script>
		<!-- popper js -->
        <script src="js/popper.js"></script>
		<!-- bootstrap js -->
        <script src="js/bootstrap.min.js"></script>
		<!-- owl.carousel js -->
        <script src="js/owl.carousel.min.js"></script>
        <!-- magnific popup js -->
        <script src="js/magnific-popup.js"></script>
		<!-- meanmenu js -->
        <script src="js/jquery.meanmenu.js"></script>
		<!-- jquery-ui js -->
        <script src="js/jquery-ui.min.js"></script>
		<!-- wow js -->
        <script src="js/wow.min.js"></script>
		<!-- jquery.nivo.slider.js -->
        <script src="js/jquery.nivo.slider.js"></script>
		<!-- jquery.elevateZoom-3.0.8.min.js -->
        <script src="js/jquery.elevateZoom-3.0.8.min.js"></script>
		<!-- jquery.parallax-1.1.3.js -->
        <script src="js/jquery.parallax-1.1.3.js"></script>
		<!-- jquery.counterup.min.js -->
        <script src="js/jquery.counterup.min.js"></script>
		<!-- waypoints.min.js -->
        <script src="js/waypoints.min.js"></script>
		<!-- plugins js -->
        <script src="js/plugins.js"></script>
		<!-- main js -->
        <script src="js/main.js"></script>
    
    </body>
</html>