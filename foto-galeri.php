<?php
	$query567 = $db->query("SELECT DISTINCT foto.judul_foto ,galeri.judul_galeri, galeri.keterangan FROM galeri LEFT JOIN foto ON foto.id_galeri=galeri.id_galeri WHERE galeri.id_galeri = '$_GET[id]' ");
	$jml567   = $query567->num_rows;
	$row567   = $query567->fetch_assoc();
	
?>
	<script type="text/javascript" src="js/jquery.lightbox-0.5.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/jquery.lightbox-0.5.css" media="screen" />
	
	<script type="text/javascript">
	$(function() {
		$('#gallery a').lightBox();
	});
	</script>
	<!--breadcrumbs-->
	<section class="breadcrumb animated wow slideInLeft" data-wow-delay=".5s">
    <div class="container-fluid padding-fixed">
        <ul class="list-inline text-capitalize">
            <li><a href="galeri.html" title="Retailer - Multipurpose Responsive Shopify Theme/Template">Gallery /<?php if ($row567['judul_foto']  == "") {
					echo "kosong";
				} else {
					echo $row567['judul_galeri'];
				} ?></a></li>
            
            
        </ul>
    </div>
</section>
	<!--//breadcrumbs-->




    <div class="container">
            <div class="row ">
            <div class="col-lg-12">
							<div class="section-title mb-30 text-center animated wow slideInRight" data-wow-delay=".5s">
								<h2><?php echo $row567['judul_galeri']; ?></h2>
								<p><?php if ($row567['judul_foto']  == "") {
					echo "kosong";
				} else {
					echo $row567['keterangan'];
				} ?></p>
							</div>
						</div>
						<?php
				$query1234      = $db->query("SELECT id_foto, foto, judul_foto, keterangan FROM foto WHERE id_galeri = '$_GET[id]' ORDER BY id_foto ASC");
				while( $row1234 = $query1234->fetch_assoc() ){
			?>
    <!-- my php code which uses x-path to get results from xml query. -->
        <div class="col-sm-4 ">
            <div class="card-columns wow bounceInUp">
				<div class="card  bg-light" style = "width: 20rem; " >
				<a href="#" data-toggle="modal" data-target="#fotoGaleri<?= $row1234['id_foto']; ?>">
                    <img class="card-img-top"  src="gambar/thumb_foto/<?php echo $row1234['foto']; ?>" alt="Card image cap">
					</a>
                    <!-- <div class="card-body">
                        <h5 class="card-title"><b><?php echo $row1234['judul_galeri']; ?></b></h5>
						<h3><?php echo $row1234['judul_foto']; ?></h3>
							<p><?php echo $row1234['keterangan']; ?></p>
                    </div> -->
                </div>
            </div>
		</div>
		

        <div class="modal fade bd-example-modal-lg" id="fotoGaleri<?= $row1234['id_foto']; ?>" tabindex="-1" role="dialog" aria-labelledby="fotoGaleriLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="fotoGaleriLabel"><?php echo $row1234['judul_foto']; ?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-6"><img src="gambar/thumb_foto/<?php echo $row1234['foto']; ?>" alt=""></div>
                                            <div class="col-md-6 ml-auto"><?php echo $row1234['keterangan']; ?></div>
                                        </div>
                                    </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                    </div>
                                </div>
                                </div>
                              
                <!-- end modal -->



        <?php
}
?>
    </div>
</div> <!--container div  -->

<div class="clear-fix"></div>
