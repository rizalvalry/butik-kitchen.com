<?php 
	if( $_SESSION['pbemail'] != "" AND $_SESSION['pblevel'] == "kustomer" ){
?>
	<!--breadcrumbs-->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Beranda</a></li>
				<li class="active">Riwayat Pesanan</li>
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
						<h4> Menu </h4>
						<ul class="faq">
							<li><a href="akun-saya.html">Akun Saya</a></li>						
							<li><a href="riwayat-pesanan.html">Riwayat Pesanan</a></li>						
							<li><a href="kata-sandi.html">Ubah Kata Sandi</a></li>						
							<li><a href="keluar.php">Keluar</a></li>						
						</ul>
					</div>		 
				</div>
			</div>
			<div class="col-md-9 product-model-sec-custom1">
				<div class="rsidebar-top">				
					<h3> Riwayat Pesanan </h3><hr />
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<th>NO</th>
								<th>ID Pesanan</th>
								<th>Nama Pelanggan</th>
								<th>Tanggal Pesanan</th>
								<th>Status Pesanan</th>
								<th>Aksi</th>
							</thead>
							<tbody>
								<?php
									date_default_timezone_set('Asia/Jakarta');
									$tahun = date("Y");
									include "config/tgl_indo.php";
									$no83          = 1;
									$query83       = $db->query("SELECT id_orders, status_orders, tanggal FROM orders WHERE id_kustomer='$_SESSION[pbid]' ORDER BY id_orders DESC");
									while ( $row83 = $query83->fetch_assoc() ){
										$tanggal83 = tgl_indo( $row83['tanggal'] );
										echo '<tr>';
										echo '<td>'.$no83.'</td>';
										echo '<td>#'.$tahun.'-'.$row83['id_orders'].'</td>';
										echo '<td>'.$_SESSION['pbnama'].'</td>';
										echo '<td>'.$tanggal83.'</td>';
										echo '<td>'.$row83['status_orders'].'</td>';
										echo '<td><a href="detail-order-'.$row83['id_orders'].'.html" class="btn btn-primary btn-xs">Detail</a></td>';
										echo '</tr>';
										$no83++;
									}
								
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	<!--//products-->
	<?php
	} else { 
		session_destroy();
		echo "<meta http-equiv='refresh' content='0; url=index.php'>";
		echo "<script>alert('silahkan login terlebih dahulu')</script>";
	}
	?>