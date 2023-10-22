				<?php
					if( $_GET['module'] == "home" ){
						if( $_SESSION['level'] == "Admin" ){
				?>
					<div class="col_3">
						<div class="col-md-3 widget widget1">
						<?php
							$query95 = $db->query("SELECT COUNT(orders.id_orders) AS jumlah_order FROM orders");
							$row95   = $query95->fetch_assoc();
						?>
							<div class="r3_counter_box">
								<i class="fa fa-shopping-cart"></i>
								<div class="stats">
								  <h5><?php echo $row95['jumlah_order']; ?></h5>
								  <div class="grow">
									<a href="?module=order"><p>Data Order</p></a>
								  </div>
								</div>
							</div>
						</div>
						<div class="col-md-3 widget widget1">
						<?php
							$query96 = $db->query("SELECT COUNT(produk.id_produk) AS jumlah_produk FROM produk");
							$row96   = $query96->fetch_assoc();
						?>
							<div class="r3_counter_box">
								<i class="fa fa-th-large"></i>
								<div class="stats">
								  <h5><?php echo $row96['jumlah_produk']; ?></h5>
								  <div class="grow grow1">
									<a href="?module=produk"><p>Data Produk</p></a>
								  </div>
								</div>
							</div>
						</div>
						<div class="col-md-3 widget widget1">
						 <?php
							$query97 = $db->query("SELECT COUNT(artikel.id_artikel) AS jumlah_artikel FROM artikel");
							$row97   = $query97->fetch_assoc();
						 ?>
							<div class="r3_counter_box">
								<i class="fa fa-file"></i>
								<div class="stats">
								  <h5><?php echo $row97['jumlah_artikel']; ?></h5>
								  <div class="grow grow3">
									<a href="?module=artikel"><p>Data Artkel</p></a>
								  </div>
								</div>
							</div>
						 </div>
						 <div class="col-md-3 widget">
						 <?php
							$query98 = $db->query("SELECT COUNT(hubungi.id_hubungi) AS jumlah_hubungi FROM hubungi");
							$row98   = $query98->fetch_assoc();
						 ?>
							<div class="r3_counter_box">
								<i class="fa fa-bullhorn"></i>
								<div class="stats">
								  <h5><?php echo $row98['jumlah_hubungi']; ?></h5>
								  <div class="grow grow2">
									<a href="?module=hubungi"><p>Pesan Masuk</p></a>
								  </div>
								</div>
							</div>
						</div>
						<div class="clearfix"> </div>
					</div>
				<?php
						} else {
				?>
				<div class="col_3">
						<div class="col-md-3 widget widget1">
						<?php
						    $ssid    = $_SESSION['id'];
							$query95 = $db->query("SELECT COUNT(orders_detail.id_orders) AS jumlah_order FROM orders_detail INNER JOIN orders ON orders_detail.id_orders=orders.id_orders INNER JOIN produk ON orders_detail.id_produk=produk.id_produk WHERE produk.id_user = '$ssid'");
							$row95   = $query95->fetch_assoc();
						?>
							<div class="r3_counter_box">
								<i class="fa fa-shopping-cart"></i>
								<div class="stats">
								  <h5><?php echo $row95['jumlah_order']; ?></h5>
								  <div class="grow">
									<a href="?module=orderseller"><p>Data Order</p></a>
								  </div>
								</div>
							</div>
						</div>
						<div class="col-md-3 widget widget1">
						<?php
							$query96 = $db->query("SELECT COUNT(produk.id_produk) AS jumlah_produk FROM produk WHERE id_user = '$ssid'");
							$row96   = $query96->fetch_assoc();
						?>
							<div class="r3_counter_box">
								<i class="fa fa-th-large"></i>
								<div class="stats">
								  <h5><?php echo $row96['jumlah_produk']; ?></h5>
								  <div class="grow grow1">
									<a href="?module=produkseller"><p>Data Produk</p></a>
								  </div>
								</div>
							</div>
						</div>
						<div class="clearfix"> </div>
					</div>
				<?php
						}
					} else if ( $_GET['module'] == "user" ){
						if( $_SESSION['level'] == "Admin" OR $_SESSION['level'] == "User" ){
							include "modul/user/user.php";
						}
					} else if ( $_GET['module'] == "profiluser" ){
						if ( $_SESSION['level'] == "Admin" OR $_SESSION['level'] == "User" ){
							include "modul/profiluser/profiluser.php";
						}
					} else if ( $_GET['module'] == "upass" ){
						if ( $_SESSION['level'] == "Admin" OR $_SESSION['level'] == "User" ){
							include "modul/upass/upass.php";
						}
					} else if ( $_GET['module'] == "profiltoko" ){
						if ( $_SESSION['level'] == "Admin" OR $_SESSION['level'] == "User" ){
							include "modul/profiltoko/profiltoko.php";
						}
					} else if ( $_GET['module'] == "menuutama" ){
						if ( $_SESSION['level'] == "Admin" OR $_SESSION['level'] == "User" ){
							include "modul/menuutama/menuutama.php";
						}
					} else if ( $_GET['module'] == "submenu" ){
						if ( $_SESSION['level'] == "Admin" OR $_SESSION['level'] == "User" ){
							include "modul/submenu/submenu.php";
						}
					} else if ( $_GET['module'] == "kustomer" ){
						if ( $_SESSION['level'] == "Admin" OR $_SESSION['level'] == "User" ){
							include "modul/kustomer/kustomer.php";
						}
					} else if ( $_GET['module'] == "slide" ){
						if ( $_SESSION['level'] == "Admin" OR $_SESSION['level'] == "User" ){
							include "modul/slide/slide.php";
						}
					} else if ( $_GET['module'] == "katproduk" ){
						if ( $_SESSION['level'] == "Admin" OR $_SESSION['level'] == "User" ){
							include "modul/katproduk/katproduk.php";
						}
					} else if ( $_GET['module'] == "katartikel" ){
						if ( $_SESSION['level'] == "Admin" OR $_SESSION['level'] == "User" ){
							include "modul/katartikel/katartikel.php";
						}
					} else if ( $_GET['module'] == "halaman" ){
						if ( $_SESSION['level'] == "Admin" OR $_SESSION['level'] == "User" ){
							include "modul/halaman/halaman.php";
						}
					} else if ( $_GET['module'] == "tagartikel" ){
						if ( $_SESSION['level'] == "Admin" OR $_SESSION['level'] == "User" ){
							include "modul/tagartikel/tagartikel.php";
						}
					} else if ( $_GET['module'] == "file" ){
						if ( $_SESSION['level'] == "Admin" OR $_SESSION['level'] == "User" ){
							include "modul/file/file.php";
						}
					} else if ( $_GET['module'] == "subkategori" ){
						if ( $_SESSION['level'] == "Admin" OR $_SESSION['level'] == "User" ){
							include "modul/subkategori/subkategori.php";
						}
					} else if ( $_GET['module'] == "pembayaran" ){
						if ( $_SESSION['level'] == "Admin" OR $_SESSION['level'] == "User" ){
							include "modul/pembayaran/pembayaran.php";
						}
					} else if ( $_GET['module'] =="pengiriman" ){
						if ( $_SESSION['level'] == "Admin" OR $_SESSION['level'] == "User" ){
							include "modul/pengiriman/pengiriman.php";
						}
					} else if ( $_GET['module'] == "ongkir" ){
						if ( $_SESSION['level'] == "Admin" OR $_SESSION['level'] == "User" ){
							include "modul/ongkir/ongkir.php";
						}
					} else if ( $_GET['module'] == "produk" ){
						if ( $_SESSION['level'] == "Admin" ){
							include "modul/produk/produk.php";
						}
					} else if ( $_GET['module'] == "hubungi" ){
						if ( $_SESSION['level'] == "Admin" OR $_SESSION['level'] == "User" ){
							include "modul/hubungi/hubungi.php";
						}
					} else if ( $_GET['module'] == "gambarproduk" ){
						if ( $_SESSION['level'] == "Admin" ){
							include "modul/gambarproduk/gambar.php";
						}
					} else if ( $_GET['module'] == "artikel" ){
						if ( $_SESSION['level'] == "Admin" OR $_SESSION['level'] == "User" ){
							include "modul/artikel/artikel.php";
						}
					} else if ( $_GET['module'] == "komentar" ){
						if ( $_SESSION['level'] == "Admin" OR $_SESSION['level'] == "User" ){
							include "modul/komentar/komentar.php";
						}
					} else if ( $_GET['module'] == "order" ){
						if ( $_SESSION['level'] == "Admin" ){
							include "modul/order/order.php";
						}
					} else if ( $_GET['module'] == "laporan" ){
						if ( $_SESSION['level'] == "Admin" ){
							include "modul/laporan/laporan.php";
						}
					} else if ( $_GET['module'] == "banner" ){
						if ( $_SESSION['level'] == "Admin" OR $_SESSION['level'] == "User" ){
							include "modul/banner/banner.php";
						}
					} else if ( $_GET['module'] == "sosmed" ){
						if ( $_SESSION['level'] == "Admin" OR $_SESSION['level'] == "User" ){
							include "modul/sosmed/sosmed.php";
						}
					} else if ( $_GET['module'] == "produkseller" ){
						if ( $_SESSION['level'] == "Admin" OR $_SESSION['level'] == "User" ){
							include "modul/produkseller/produkseller.php";
						}
					} else if ( $_GET['module'] == "gambarseller" ){
						if ( $_SESSION['level'] == "Admin" OR $_SESSION['level'] == "User" ){
							include "modul/gambarseller/gambarseller.php";
						}
					} else if ( $_GET['module'] == "galeri" ){
						if ( $_SESSION['level'] == "Admin" OR $_SESSION['level'] == "User" ){
							include "modul/galeri/galeri.php";
						}
					} else if ( $_GET['module'] == "foto" ) {
						if ( $_SESSION['level'] == "Admin" OR $_SESSION['level'] == "User" ){
							include "modul/foto/foto.php";
						}
					} else if ( $_GET['module'] == "orderseller" ){
						if ( $_SESSION['level'] == "Admin" OR $_SESSION['level'] == "User" ){
							include "modul/orderseller/orderseller.php";
						}
					} else if ( $_GET['module'] == "laporanseller" ){
						if ( $_SESSION['level'] == "Admin" OR $_SESSION['level'] == "User" ){
							include "modul/laporanseller/laporan.php";
						}
					} else if ( $_GET['module'] == "testimoni"){
					    if ( $_SESSION['level'] == "Admin" OR $_SESSION['level'] == "User" ){
							include "modul/testimoni/testimoni.php";
						}
					}
					
					else {
						echo "Modul Not Found";
					}
				
				?>