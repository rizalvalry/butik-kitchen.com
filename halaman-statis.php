

<?php
		
		$query75  = $db->prepare("SELECT judul_halaman, isi_halaman FROM halaman_statis WHERE id_halaman = 1 AND aktif = 'Y'");
		$query75->bind_param("is", $_GET['id'], $aktif75);
		$aktif75  = "Y";
		$query75->execute();
		$result75 = $query75->get_result();
		$row75    = $result75->fetch_assoc();
		$judul75  = explode( " ", $row75['judul_halaman'] );
	?>

	<!--breadcrumbs-->
	<section class="breadcrumb">
    <div class="container-fluid padding-fixed">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="home"><span class="glyphicon glyphicon-home" aria-hidden="true"> Beranda /</a></li>
				<li class="active"><?php echo $row75['judul_halaman']; ?></li>
			</ol>
		</div>
	</section>
	<!--//breadcrumbs-->
	<!--products-->
	<div class="products">	 
		<div class="container">
			<div class="col-md-12 product-model-sec-custom title-info wow fadeInUp animated" data-wow-delay=".5s">
				<div class="rsidebar-top">
					<p><?php echo $row75['isi_halaman']; ?></p>		
				</div>
			</div>
		</div>
	</div>
	<!--//products-->