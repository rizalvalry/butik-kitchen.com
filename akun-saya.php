<?php 
	if ( $_SESSION['pbnama'] != " " && $_SESSION['pblevel'] == "kustomer" ){
?> 
	<!--breadcrumbs-->
	<section class="breadcrumb">
    <div class="container-fluid padding-fixed">
        <ul class="list-inline text-capitalize">
            <li><a href="home" title="Retailer - Multipurpose Responsive Shopify Theme/Template">Home<i class="fa fa-angle-right"></i></a></li>


            <li>Akun Saya</li>

        </ul>
    </div>
</section>


<section class="login-content paira-gap-3 paira-gap-2">
        <div class="container">
            <div class="row">
                <div id="login">
                    <div class="col-md-12 text-center">
                        <div class="heading pull-left full-width">
                            <h1 class="page-header margin-bottom-30 text-left pull-left"><span>Akun Saya</span></h1>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="login-back">
								
								<?php
						$query79 = $db->query("SELECT kustomer.id_kustomer, kustomer.nama_lengkap, kustomer.email, kustomer.alamat, kustomer.telpon, kec.nama_kec FROM kustomer LEFT JOIN kec ON kec.id_kec=kustomer.id_kec WHERE kustomer.nama_lengkap='$_SESSION[pbnama]'");
						$row79   = $query79->fetch_assoc();
					
					?>
					<form method="POST" action="">					
						<h4> Hi, <?php echo $_SESSION['pbnama']; ?> ! </h4>
						<p>Terimakasih telah percaya pada <?php echo $row00['nama_toko']; ?> sebagai salah satu toko online pilhan Anda :)  </p>
						<br />
						<hr />
						<p>
						<?php
							if ( isset($_POST['simpan']) ){
								$nama81        = $_POST['nama'];
								// $email81       = $_POST['email'];
								// $tlp81         = $_POST['tlp'];
								$id_kustomer81 = $row79['id_kustomer'];
								
								// ini baru
								// $level         = "kustomer";
								// $aktif         = "Y";
								// $tanggal       = date("Y-m-d");
								// $jam           = date("H:i:s");
								
								if ( empty($nama81) ){
									echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
									echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
									echo '<strong>Peringatan!</strong>  Nama Lengkap Tidak Boleh Kosong';
									echo '</div>';
								} else if ( !preg_match("/^[a-zA-Z .,]*$/",$nama81) ){
									echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
									echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
									echo '<strong>Peringatan!</strong>  Nama Lengkap Tidak Boleh Mengandung Angka dan Katakter';
									echo '</div>';
								} else {
									$query81 = $db->prepare("UPDATE kustomer SET nama_lengkap=? WHERE id_kustomer=?");
									$query81->bind_param("si", $nama81, $id_kustomer81);
									$query81->execute();
									echo '<div class="alert alert-info" role="alert">';
									echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
									echo '<strong>SUKSES!</strong> Data Nama berhasil diubah';
									echo '</div>';
									session_destroy();
									echo "<meta http-equiv='refresh' content='1'; url=akun-saya.html'>";
								}
							}
						?>
							<div class="form-group">
								<label>Nama Lengkap</label>
								<input type="text" name="nama" class="form-control" value="<?php echo $row79['nama_lengkap']; ?>" maxlength="50" required />
							</div>
							<div class="form-group">
								<label>E-Mail</label>
								<input type="email"  class="form-control" value="<?php echo $row79['email']; ?>" maxlength="50" readonly/>
							</div>
							<div class="form-group">
								<label>Nomor Telepon</label>
								<input type="text"  class="form-control" value="<?php echo $row79['telpon']; ?>" maxlength="15" readonly/>
							</div>
							<span class="pull-right"><button name="simpan" class="btn btn-info" data-toogle="tooltip" title="SIMPAN"><i class="fa fa-angle-right"></i> SIMPAN</button></span>
						</p>
					</form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="recover-password" style="display:none">
                    <div class="col-md-12 text-center">
                        <div class="heading pull-left full-width">
                            <h1 class="page-header margin-bottom-30 text-left pull-left"><span>Reset Password</span></h1>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="login-back">
                                    <h5 class="margin-top-20">We will send you an email to reset your password.</h5>

                                    <form method="post" action="/account/recover" accept-charset="UTF-8"><input type="hidden" name="form_type" value="recover_customer_password" /><input type="hidden" name="utf8" value="✓" />
                                    <input type="email" placeholder="Email Address" value="" size="30" name="email" id="recover-email" class="form-control margin-bottom-10" />
                                    <button type="submit" class="btn btn-default pull-left margin-top-10">Reset</button>
                                    <button onclick="hideRecoverPasswordForm();return false;" class="pull-right cancel-btn margin-top-20"><i class="fa fa-times" aria-hidden="true"></i> <span>Cancel</span></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
	<!--//products-->
	<!--//Module-select-city-->
	<script type="text/javascript">
	var htmlobjek;
	$(document).ready(function(){
	  //apabila terjadi event onchange terhadap object <select id=propinsi>
	  $("#propinsi").change(function(){
		var propinsi = $("#propinsi").val();
		$.ajax({
			url: "ambilkota.php",
			data: "propinsi="+propinsi,
			cache: false,
			success: function(msg){
				//jika data sukses diambil dari server kita tampilkan
				//di <select id=kota>
				$("#kota").html(msg);
			}
		});
	  });
	  $("#kota").change(function(){
		var kota = $("#kota").val();
		$.ajax({
			url: "ambilkecamatan.php",
			data: "kota="+kota,
			cache: false,
			success: function(msg){
				$("#kec").html(msg);
			}
		});
	  });
	});

	</script>
	<!--//end-module-select-city-->
<?php
	} else {
		echo "<meta http-equiv='refresh' content='0; url=index.php'>";
	}
?>