<!--breadcrumbs-->
	<section class="breadcrumb">
    <div class="container-fluid padding-fixed">
	<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="home"><span class="glyphicon glyphicon-home" aria-hidden="true"> Beranda /</a></li>
				<?php $query00 = $db->query("SELECT nama_toko FROM profil");
					  $rowcrumb = $query00->fetch_assoc(); ?>
				<li class="active">Profil <?= $rowcrumb['nama_toko']; ?></li>
			</ol>
    </div>
</section>
	<!--//breadcrumbs-->
	<!--products-->
	<div class="products">	 
		<div class="container">
			<div class="col-md-12 product-model-sec-custom title-info wow fadeInUp animated" data-wow-delay=".5s">
				<div class="rsidebar-top">
					<p><?php echo $row00['static_content']; ?></p>		
				</div>
			</div>
		</div>
	</div>
	<!--//products-->