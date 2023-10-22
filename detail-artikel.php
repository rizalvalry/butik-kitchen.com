	<!--breadcrumbs-->
	<section class="breadcrumb">
    <div class="container-fluid padding-fixed">
        <ul class="list-inline text-capitalize">
            <li><a href="home" title="Retailer - Multipurpose Responsive Shopify Theme/Template">Home<i class="fa fa-angle-right"></i></a></li>


            <li class="collection-handle">Detail Artikel</li>


        </ul>
    </div>
</section>
	<!--//breadcrumbs-->
	<!--products-->
	<div class="products">	 
		<div class="container" style="padding:2em;">
			
			<div class="col-md- product-model-sec-custom">
			<?php
				include "config/tgl_indo.php";
				$db->query("UPDATE artikel SET dibaca = dibaca + 1 WHERE id_artikel = '$_GET[id]'");
				$query89     = $db->prepare("SELECT kategori_artikel.nama_kategori, artikel.judul_artikel, artikel.isi_artikel, artikel.tanggal, artikel.jam, artikel.dibaca, artikel.gambar, artikel.judul_seo, user.nama_lengkap FROM artikel INNER JOIN kategori_artikel ON artikel.id_kategori=kategori_artikel.id_kategori LEFT JOIN user ON artikel.id_user=user.id_user WHERE artikel.id_artikel = ?");
				$query89->bind_param("i", $id_artikel);
				$id_artikel  = $_GET['id'];
				$query89->execute();
				$result89    = $query89->get_result();
				$row89       = $result89->fetch_assoc();
				$tanggal     = tgl_indo( $row89['tanggal'] );
			?>
				<div class="rsidebar-top">	
					<div class="row">
						<center>
							<h2> <?php echo $row89['judul_artikel']; ?>  </h2>
							<!--<p style="font-size : 10px; margin-top : 6px;">
							<?php //echo 'Kategori : '.$row89['nama_kategori'].' | Tanggal : '.$tanggal.' | Jam : '.$row89['jam'].' WIB | Diposting : '.$row89['nama_lengkap'].' | Dibaca : '.$row89['dibaca'].' kali '; ?>
							</p><br />-->
							<img src="gambar/artikel/<?php echo $row89['gambar']; ?>" class="img-responsive" height="80%" width="80%" /><br/>
						</center>
						<p><?php echo $row89['isi_artikel']; ?></p>
					</div>
					<br />
					<?php
						$batas                   = 10;
						if ( empty($_GET['halkomentar']) ){
							$posisi              = 0;
							$_GET['halkomentar'] = 1;
						} else if ( $_GET['halkomentar'] > 0 ){
							$posisi              = ( $_GET['halkomentar'] - 1 ) * $batas;
						}
						$query11  = $db->prepare("SELECT nama_lengkap, email, komentar, tanggal, jam FROM komentar WHERE id_artikel = ? AND aktif = ? ORDER BY id_komentar DESC limit $posisi,$batas");
						$query11->bind_param("is", $id_artikel, $aktif11);
						$aktif11  = "Y";
						$query11->execute();
						$result11 = $query11->get_result();
						$row11    = $result11->num_rows;
					?>
					
					<?php
						while ( $row111 = $result11->fetch_assoc() ){
					?>
					<div class="row">
						<div class="col-md-1">
						<img src="images/poto.jpg" />
						</div>
						<div class="col-md-11">
							<p><?php echo $row111['komentar']; ?></p>
							<p><?php echo $row111['nama_lengkap'].' | '.$row111['tanggal'].' - '.$row111['jam'].' WIB' ?></p>
						</div>
					</div><hr />
					<?php
						}
					?>
					<div class="row">
						<center>
							<ul class="pagination pagination-lg">
							<?php
								$query27      = $db->prepare("SELECT id_komentar FROM komentar WHERE id_artikel = ? AND aktif = ?");
								$query27->bind_param("is", $id_artikel, $aktif11);
								$query27->execute();
								$result27     = $query27->get_result();
								$row27        = $result27->num_rows;
								$jumlah_hal27 = ceil ($row27/$batas);
							?>
								<li class="<?php if ( $_GET['halkomentar'] <= 1 ) echo "disabled"; ?>"><a href="halkomentar-<?php echo $_GET['id']; ?>-<?php echo $_GET['halkomentar'] - 1; ?>.html"><i class="fa fa-angle-left">«</i></a></li>
								<?php
									for ( $i = 1; $i <= $jumlah_hal27; $i++ ){
								?>
									<li class="<?php if ( $_GET['halkomentar'] == $i ) echo "active"; ?>"><a href="<?php echo "halkomentar-$_GET[id]-$i.html"; ?>"><?php echo $i; ?></a></li>
								<?php
									}
								?>
								<li class="<?php if ( $_GET['halkomentar'] >= $jumlah_hal27 ) echo "disabled"; ?>"><a href="halkomentar-<?php echo $_GET['id']; ?>-<?php echo $_GET['halkomentar'] + 1; ?>.html"><i class="fa fa-angle-right">»</i></a></li>
							</ul>
						</center>
					</div>
					<div class="row">
					</div>
				</div>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	<!--//products-->