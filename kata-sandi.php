<?php 
	if ( $_SESSION['pbnama'] != " " && $_SESSION['pblevel'] == "kustomer" ){
?> 
	<!--breadcrumbs-->
	<section class="breadcrumb">
    <div class="container-fluid padding-fixed">
        <ul class="list-inline text-capitalize">
            <li><a href="home" title="Retailer - Multipurpose Responsive Shopify Theme/Template">Home<i class="fa fa-angle-right"></i></a></li>


            <li>Kata Sandi</li>

        </ul>
    </div>
</section>
	<!--//breadcrumbs-->
	<!--products-->
	
			
	<section class="login-content paira-gap-3 paira-gap-2">
        <div class="container">
            <div class="row">
                <div id="login">
                    <div class="col-md-12 text-center">
                        <div class="heading pull-left full-width">
                            <h1 class="page-header margin-bottom-30 text-left pull-left"><span>Ubah Kata Sandi</span></h1>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="login-back">
								
					<form method="POST" action="" autocomplete="off">					
						<h4> Ubah Kata Sandi </h4>
						
						
						<br />
						<hr />
						<p>
						<?php
							if ( isset($_POST['simpan']) ){
								$query32  = $db->query("SELECT password FROM kustomer WHERE id_kustomer='$_SESSION[pbid]'");
								$row32    = $query32->fetch_assoc();
								
								$kslama   = $_POST['kslama'];
								$ksbaru   = $_POST['ksbaru'];
								$kskonfir = $_POST['kskonfir'];
								$cost     = ['cost' => 10,];
								$hash     = password_hash( $kskonfir, PASSWORD_BCRYPT, $cost ); 
								
								if ( $kslama <> password_verify( $kslama,$row32['password'] ) ){
									echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
									echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
									echo '<strong>PERINGATAN!</strong> Kata Sandi Lama Yang Anda Masukan Salah';
									echo '</div>';
								} else if ( empty($kslama) ){
									echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
									echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
									echo '<strong>PERINGATAN!</strong> Kata Sandi Lama Tidak Boleh Kosong';
									echo '</div>';
								} else if ( empty($ksbaru) ){
									echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
									echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
									echo '<strong>PERINGATAN!</strong> Kata Sandi Baru Tidak Boleh Kosong';
									echo '</div>';
								} else if ( empty($kskonfir) ){
									echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
									echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
									echo '<strong>PERINGATAN!</strong> Konfirmasi Kata Sandi Baru Tidak Boleh Kosong';
									echo '</div>';
								} else if ( strlen($ksbaru) < 6 ){
									echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
									echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
									echo '<strong>PERINGATAN!</strong> Kata Sandi Baru Minimal 6 Karakter';
									echo '</div>';
								} else if ( strlen($kskonfir) < 6 ){
									echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
									echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
									echo '<strong>PERINGATAN!</strong> Konfirmasi Kata Sandi Baru Minimal 6 Karakter';
									echo '</div>';
								} else if ( $ksbaru <> $kskonfir ){
									echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
									echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
									echo '<strong>PERINGATAN!</strong> Kata Sandi Baru dan Konfirmasi Kata Sandi Tidak Sama';
									echo '</div>';
								} else {
									$query33 = $db->prepare("UPDATE kustomer SET password = ? WHERE id_kustomer = ?");
									$query33->bind_param("si", $hash, $_SESSION['pbid']);
									$query33->execute();
									echo '<div class="alert alert-info" role="alert">';
									echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
									echo '<strong>SUKSES!</strong> Kata Sandi Berhasil Diubah';
									echo '</div>';
									echo "<meta http-equiv='refresh' content='1; url=kata-sandi.html'>";
								}
							}
						?>
							<div class="form-group">
								<label>Kata Sandi Lama</label>
								<input type="text" autocomplete="off" name="kslama" value="<?php echo isset( $kslama ) ? $kslama : ""; ?>" class="form-control" placeholder="Kata Sandi Lama"  maxlength="60" required />
							</div>
							<div class="form-group">
								<label>Kata Sandi Baru</label>
								<input type="password" name="ksbaru" value="<?php echo isset( $ksbaru ) ? $ksbaru : ""; ?>" class="form-control" placeholder="Kata Sandi Baru"  maxlength="60" required  />
							</div>
							<div class="form-group">
								<label>Konfirmasi Kata Sandi Baru</label>
								<input type="password" name="kskonfir" value="<?php echo isset( $kskonfir ) ? $kskonfir : ""; ?>" class="form-control" placeholder="Konfirmasi Kata Sandi Baru" maxlength="60" required  />
							</div>
							<span class="pull-right"><button name="simpan" class="btn btn-info" data-toogle="tooltip" title="SIMPAN"><i class="fa fa-angle-right"></i> SIMPAN</button></span>
						</p>
					</form>
				</div>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
	<!--//products-->
	<div id="login" class="col-md-6 login-register ">
                    <div class="login-back">
                    
						<ul class="faq">
						<h4> Menu </h4>
							<li><a href="akun-saya.html">Akun Saya</a></li>						
							
							<li><a href="kata-sandi.html">Ubah Kata Sandi</a></li>						
							<li><a href="keluar.php">Keluar</a></li>						
						</ul>
                    </div>
                </div>

            </div>
        </div>
    </section>
	<!--//breadcrumbs-->
	<!--products-->
	<div class="products">	 
		<div class="container">
			<div class="col-md-3 rsidebar" style="margin-bottom : 8px;">
				<div class="rsidebar-top">
					<div class="sidebar-left">
						
					</div>		 
				</div>
			</div>
			<div class="col-md-9 product-model-sec-custom1">
				<div class="rsidebar-top">
					
				</div>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
<?php
	} else {
		echo "<meta http-equiv='refresh' content='0; url=index.php'>";
	}
?>