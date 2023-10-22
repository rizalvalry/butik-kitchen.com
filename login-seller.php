	<!--breadcrumbs-->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow fadeInUp" data-wow-delay=".5s">
				<li><a href="home"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Beranda</a></li>
				<li class="active">Masuk</li>
			</ol>
		</div>
	</div>
	<!--//breadcrumbs-->
	<!--login-->
	<div class="login-page">
		<div class="title-info wow fadeInUp animated" data-wow-delay=".5s">
			<h3 class="title">Form<span> Masuk</span></h3>
		</div>
		<div class="widget-shadow">
			<div class="login-top wow fadeInUp animated" data-wow-delay=".7s">
				<h4>Selamat Datang Kembali Di <?php echo $row00['nama_toko']; ?><br> Ingin Menjadi Seller ? <a href="daftar-seller.html">  Daftar Sekarang »</a> </h4>
			</div>
			<div class="login-body wow fadeInUp animated" data-wow-delay=".7s">
				<form method="POST" action="">
				<?php
					if ( isset( $_POST['masuk'] ) ){
									$user = $_POST['email'];
									$pass = $_POST['password'];
									
									$eror = array();
									
									if ( empty($user) ){
										$eror['username'] = "user-eror";
										echo '<div class="alert alert-danger alert-login" role="alert">';
										echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
										echo '<strong>Peringatan!</strong> Username atau E-Mail Tidak Boleh Kosong';
										echo '</div>';
									} else if ( empty($pass) ) {
										$eror['password'] = "lock-eror";
										echo '<div class="alert alert-danger alert-login" role="alert">';
										echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
										echo '<strong>Peringatan!</strong> Password Tidak Boleh Kosong';
										echo '</div>';
									} else {
										$sql    = "SELECT email,password,nama_lengkap,level,foto,id_session,blokir,id_user FROM user WHERE email=?";
										$query  = $db->prepare($sql);
										$query->bind_param("s", $user);
										$query->execute();
										$result = $query->get_result();
										$row    = $result->fetch_assoc();
										
										if( $user <> $row['email'] ){
											$eror['username'] = "user-eror";
											echo '<div class="alert alert-danger alert-login" role="alert" style="font-size : 12px; padding : 5px;">';
											echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
											echo '<strong>Peringatan!</strong> Username atau E-Mail Yang Anda Masukan Salah';
											echo '</div>';
										} else if ( $pass<>password_verify($pass,$row['password']) ) {
											$eror['password'] = "lock-eror";
											echo '<div class="alert alert-danger alert-login" role="alert">';
											echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
											echo '<strong>Peringatan!</strong> Password Yang Anda Masukan Salah';
											echo '</div>';
										} else if ( $row['blokir']=="Y" ){
											$eror['username'] = "user-eror";
											echo '<div class="alert alert-danger alert-login" role="alert" style="font-size : 12px; padding : 5px;">';
											echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
											echo '<strong>Peringatan!</strong> Username atau E-Mail Yang Anda Sudah Diblokir';
											echo '</div>';
										} else {
											
											$_SESSION['level'] = $row['level'];
											$_SESSION['email'] = $row['email'];
											$_SESSION['id']    = $row['id_user'];
											
											$_SESSION['login'] = 1;
											$sid_lama = session_id();
											$sid_baru = session_id();
											
											$db->query("UPDATE user SET id_session='$sid_baru' WHERE email='$user'");
											echo "<meta http-equiv='refresh' content='0; url=webadmin/media.php?module=home'>";
										}
									}
					}
				
				?>
					<input type="email" class="user" name="email" placeholder="E-Mail" required="">
					<input type="password" name="password" class="lock" placeholder="Kata Sandi">
					<input type="submit" name="masuk" value="Masuk">
					<div class="forgot-grid">
						<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Ingatkan Saya</label>
						<div class="forgot">
							<a href="lupa-password.html">Lupa Kata Sandi ?</a>
						</div>
						<div class="clearfix"> </div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!--//login-->