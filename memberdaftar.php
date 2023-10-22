<style>


</style>

<section class="breadcrumb">
    <div class="container-fluid padding-fixed">
        <ul class="list-inline text-capitalize">
            <li><a href="home" title="Retailer - Multipurpose Responsive Shopify Theme/Template">Home<i class="fa fa-angle-right"></i></a></li>
            
            <li>Buat Akun</li>
            
        </ul>
    </div>
</section>

					
						
	<main class="login-page paira-sticky-root">
    <section class="login-content paira-gap-3 paira-gap-2">

<div class="col-md-12 text-center">
                        
						<div class="heading pull-left full-width">
													<h1 class="page-header margin-bottom-30 text-left pull-left"><span class="akun-register">Buat Akun</span></h1>
												</div>
										</div>
        <div class="container">
            <div class="row">
                <div id="login">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="register-page">
										<?php
										if ( isset($_POST['daftar']) ){
											
											date_default_timezone_set('Asia/Jakarta');
											$nama_depan    = "";
											$nama_belakang = "";
											$email         = $_POST['email'];
											$pass          = $_POST['pass'];
											$upass         = $_POST['upass'];
											$id_user	   = $_POST['id_user'];
											$alamat        = "";
											$tlp           = $_POST['tlp'];
											$kec           = 5201051;
											$kode          = $_POST['kode'];
											$level         = "kustomer";
											$aktif         = "Y";
											$tanggal       = date("Y-m-d");
											$jam           = date("H:i:s");
											$nama_lengkap  = $_POST['nama_lengkap'];
											$cost          = ['cost' => 10,];
											$hash          = password_hash($upass, PASSWORD_BCRYPT,$cost);
											
											$query76       = $db->query("SELECT email FROM kustomer WHERE email='$email'");
											$row76         = $query76->fetch_assoc();
											
											if ( empty($email) ){
												echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
												echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
												echo '<strong>Peringatan!</strong> E-Mail Tidak Boleh Kosong';
												echo '</div>';
											} else if ( empty($nama_lengkap) ){
												echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
												echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
												echo '<strong>Peringatan!</strong> Nama Depan Tidak Boleh Kosong';
												echo '</div>';
											} else if ( !preg_match("/^[a-zA-Z]*$/",$nama_lengkap) ){
												echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
												echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
												echo '<strong>Peringatan!</strong>  Nama Depan Tidak Boleh Mengandung Angka dan Katakter';
												echo '</div>';
											} else if ( empty($id_user) ){
												echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
												echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
												echo '<strong>Peringatan!</strong> Admin wajib dipilih';
												echo '</div>';
											}
											 else if ( empty($pass) ){
												echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
												echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
												echo '<strong>Peringatan!</strong> Kata Sandi Tidak Boleh Kosong';
												echo '</div>';
											} else if ( empty($upass) ){
												echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
												echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
												echo '<strong>Peringatan!</strong> Konfirmasi Kata Sandi Tidak Boleh Kosong';
												echo '</div>';
											} else if ( strlen($pass) < 6 ){
												echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
												echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
												echo '<strong>Peringatan!</strong>  Kata Sandi Minimal 6 Karakter';
												echo '</div>';
											} else if ( empty($tlp) ){
												echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
												echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
												echo '<strong>Peringatan!</strong> Nomor Telpon Tidak Boleh Kosong';
												echo '</div>';
											} else if ( !preg_match("/^[0-9+]*$/",$tlp) ){
												echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
												echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
												echo '<strong>Peringatan!</strong>  Nomor Telpon Harus Angka';
												echo '</div>';
											} else if ( strlen($tlp) < 11 ){
												echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
												echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
												echo '<strong>Peringatan!</strong> Nomor Telpon minimal 11 Digit';
												echo '</div>';
											}  else if ( strlen($upass) < 6 ){
												echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
												echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
												echo '<strong>Peringatan!</strong>  Konfirmasi Kata Sandi Minimal 6 Karakter';
												echo '</div>';
											} else if ( $pass <> $upass ){
												echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
												echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
												echo '<strong>Peringatan!</strong>  Kata Sandi dan Konfirmasi Kata Sandi Tidak Cocok';
												echo '</div>';
											} else if( !preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email )) {
												echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
												echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
												echo '<strong>Peringatan!</strong>  Invalid Email';
												echo '</div>';
											} else if ( $row76['email'] == $email ){
												echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
												echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
												echo '<strong>Peringatan!</strong>  E-Mail Yang Anda Masukan Sudah Terdaftar';
												echo '</div>';
											} else {
												if ( $kode == $_SESSION['key'] ){
													$query77 = $db->prepare("INSERT INTO kustomer (id_kec,nama_lengkap,email,password,alamat,telpon,tanggal,jam,aktif,level,id_user) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
													$query77->bind_param("isssssssssi", $kec,$nama_lengkap,$email,$hash,$alamat,$tlp,$tanggal,$jam,$aktif,$level,$id_user);
													$query77->execute();
													$_SESSION['pbemail'] = $email;
													$_SESSION['pblevel'] = $level;
													$_SESSION['pbnama']  = $nama_lengkap;
													$_SESSION['pbid']    = $db->insert_id;
													$pesan               = 'Terimakasih telah menjadi member pada toko '.$row00['nama_toko'].' <br/>';
													$pesan              .= "Sekarang Anda bisa belanja dengan mudah <br/>";
													$pesan              .= "Username : $email <br/>";
													$pesan              .= "Password : $upass ";
													$subjek              = "Daftar Member"; 
													$dari                = $row00['email_pengelola'];
													echo '<div class="alert alert-info" role="alert">';
													echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
													echo '<strong>Terimakasih!</strong>  Kini Anda bisa berbelanja Online';
													echo "<meta http-equiv='refresh' content='0'; url=home'>";
													echo '</div>';
													if ( $row00['email_protokol'] == "Surat" ){
														//kirim email ke kustomer
														mail ($email, $subjek, $pesan, $dari);
														echo "<meta http-equiv='refresh' content='3; url=index.php'>";
													} else {
														include "config/php-mail/function.php";
														smtp_mail($email, $subjek, $pesan);
														echo "<meta http-equiv='refresh' content='3; url=index.php'>";
													}
													
												} else {
													echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
													echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
													echo '<strong>Peringatan!</strong>  Hasil Hitung Yang Anda Masukan Salah';
													echo '</div>';
												}
											}
											
										}
									?>
									<form class="wow fadeInUp animated register" method="POST" data-wow-delay=".7s" method="POST" action="">
									
									<label>Nama</label>
                                    <!-- <input type="text" name="email" value="" name="customer[email]" class="form-control margin-bottom-10" id="customer_email" /> -->
                                    <input type="text" class="form-control margin-bottom-10" value="<?php echo isset ( $nama_lengkap ) ? $nama_lengkap : ""; ?>" name="nama_lengkap" placeholder="Nama Lengkap" required="" autocomplete="off">
									<label>Telpon</label>
                                    <!-- <input type="text" name="email" value="" name="customer[email]" class="form-control margin-bottom-10" id="customer_email" /> -->
                                    <input type="number" min="10" class="form-control margin-bottom-10" value="<?php echo isset ( $tlp ) ? $tlp : ""; ?>" name="tlp" placeholder="No Telp" required="" autocomplete="off">
                                    <label>Email</label>
                                    <!-- <input type="text" name="email" value="" name="customer[email]" class="form-control margin-bottom-10" id="customer_email" /> -->
                                    <input type="email" class="form-control margin-bottom-10" value="<?php echo isset ( $email ) ? $email : ""; ?>" name="email" placeholder="Alamat Email" required="" autocomplete="off">
									
<div class="daftar">
									<!-- checkbox -->
									<label>Pilih Admin</label>
									<div class="cntr">
										<?php 
											$queryuser = $db->query("SELECT id_user, nama_lengkap from user where level = 'User' AND blokir = 'T'");
											while( $rowuser = $queryuser->fetch_assoc() ){
												
										?>
										
										<label for="<?php echo $rowuser['id_user']; ?>" class="btn-radio">
										<input type="radio" id="<?php echo $rowuser['id_user']; ?>" name="id_user" value="<?php echo $rowuser['id_user']; ?>">
										<span><?php echo $rowuser['nama_lengkap']; ?></span>

										</label>
											<?php } ?>
									</div>
											</div>
									<!-- finish -->
									
									<label>Password</label>
									<!-- <input type="password" name="password" class="form-control margin-bottom-10" id="customer_password" size="16" /> -->
									<input type="password" id="password" class="form-control margin-bottom-10" value="<?php echo isset ( $pass ) ? $pass : ""; ?>" name="pass" class="lock" placeholder="Kata Sandi" required="">
									
									<div class="row">
                                    <div class="col-md-12">
									<i class="fa fa-eye" id="togglePassword"> <label> Show Password</label></i>
                                    </label>
                                    </div>
                                    </div>

									<label>Konfirmasi Password</label>
									<!-- <input type="password" name="password" class="form-control margin-bottom-10" id="customer_password" size="16" /> -->
									<input type="password" id="customer_password" class="form-control margin-bottom-10" value="<?php echo isset ( $upass ) ? $upass : ""; ?>" name="upass" class="lock" placeholder="Kata Sandi" required="">

									<img src="captcha/captcha.php" />
									<input type="text" class="form-control margin-bottom-5" name="kode" placeholder="Masukan Hasil Hitungan Diatas" required="">

                                    <button type="submit" name="daftar" class="btn btn-default pull-left margin-top-10">Daftar</button>
                                    <!-- <a href="#" class="pull-right margin-top-20 undreline" onclick="showRecoverPasswordForm();return false;"><h5 class="margin-clear">Lupa Password?</h5></a> -->
                                    
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
                <div id="login-mobile" class="col-md-6 text-center login-register mobile">
                    <div class="login-back">
                    <form method="POST" action="aksi_loginmember.php" accept-charset="UTF-8">
                    <img src="images/signup.png" style="width:100%; height:25%">                    
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
	<!--//login-->


	<script>
const togglePassword = document.querySelector('#togglePassword');
const password = document.querySelector('#password');
togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});
</script>