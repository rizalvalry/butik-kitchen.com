<?php 
$query1234 = $db->query("SELECT id_galeri, judul_galeri, keterangan, gambar FROM galeri WHERE aktif = 'Y' ORDER BY id_galeri DESC");
$query1231 = $db->query("SELECT id_galeri, judul_galeri, keterangan, gambar FROM galeri WHERE aktif = 'Y' ORDER BY id_galeri DESC");
?>

<!--=================== Breadcrumbs ===================-->
<!--breadcrumbs-->
<section class="breadcrumb">
    <div class="container-fluid padding-fixed">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="home"><span class="glyphicon glyphicon-home" aria-hidden="true"> Beranda /</a></li>
				<li class="active">Galeri </li>
			</ol>
		</div>
	</section>
	<!--//breadcrumbs-->

<!-- Gallery -->
    <div class="container">
               <div class="text-center">
                   <h4>Galeri</h4>
               </div>

            <!-- new grid -->
            <div class="row-custom">

                    <?php
        $query1234 = $db->query("SELECT id_galeri, judul_galeri, keterangan, gambar FROM galeri WHERE aktif = 'Y' ORDER BY id_galeri DESC");
        while ($row1234 = $query1234->fetch_assoc()) {
            $query12345 = $db->query("SELECT COUNT(id_foto) AS jumlah FROM foto WHERE id_galeri = '$row1234[id_galeri]'");
            $row12345 = $query12345->fetch_assoc();
            $isi_artikel         = $row1234['judul_galeri'];
            $isi                 = substr($isi_artikel,0,10); // ambil sebanyak 220 karakter
					// $isi                 = substr($isi_artikel,0,strrpos($isi," ")); // potong per spasi kalimat
            ?>
                <div class="column-grid">

                <div class="card-columns-fluid wow bounceInUp">
                <div class="card  bg-light" >
                    <img class="card-img-top"  src="gambar/thumb_galeri/<?php echo $row1234['gambar']; ?>" alt="Card image cap">

                    <div class="card-body">
                        <!-- <p class="card-title"><b><?php echo $isi.'..'; ?></b></p> -->
                        <p><?php echo $row12345['jumlah']; ?> Foto </p>
                       
                        <?php if ($row12345['jumlah'] > 0)  { ?>
                            <a href="foto-galeri-<?php echo $row1234['id_galeri']; ?>.html" class="btn btn-primary btn-sm">Full Details</a>
                        <?php }  else { ?>
                            <a href="#" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#fotoGaleri<?= $row1234['id_galeri']; ?>">Lihat</a>
                        <?php } ?>

                        <div class="modal fade" id="fotoGaleri<?= $row1234['id_galeri']; ?>" tabindex="-1" role="dialog" aria-labelledby="fotoGaleriLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="fotoGaleriLabel"><?php echo $row1234['judul_galeri']; ?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                    
                                            <center><img class="img-responsive" src="gambar/thumb_galeri/<?php echo $row1234['gambar']; ?>" alt=""><center>
                                            <?php echo $row1234['keterangan']; ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                    </div>
                                </div>
                                </div>
                        
                            </div>
                        </div>
                    </div>
            
                </div>
            

                <?php
                }
                ?>
            </div>
            <!-- end grid new -->

           
</div> <!--container div  -->

<div class="clear-fix"></div>