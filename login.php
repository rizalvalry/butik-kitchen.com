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
			<p>Silahkan masukan E-Mail dan Password Anda untuk melakukan proses pembelian</p>
		</div>
		<div class="widget-shadow">
			<div class="login-top wow fadeInUp animated" data-wow-delay=".7s">
				<h4>Selamat Datang Kembali Di <?php echo $row00['nama_toko']; ?><br> Bukan Member ? <a href="member-baru.html">  Daftar Sekarang »</a> </h4>
			</div>
			<div class="login-body wow fadeInUp animated" data-wow-delay=".7s">
				<form method="POST" action="">
				<?php
					if ( isset( $_POST['masuk'] ) ){
						$email    = $_POST['email'];
						$password = $_POST['password'];
						
						if ( empty( $email ) ){
							echo '<div class="alert alert-danger alert-login" role="alert">';
							echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
							echo '<strong>Peringatan!</strong> E-Mail Tidak Boleh Kosong';
							echo '</div>';
						} else if ( empty($password ) ) {
							echo '<div class="alert alert-danger alert-login" role="alert">';
							echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
							echo '<strong>Peringatan!</strong> Password Tidak Boleh Kosong';
							echo '</div>';
						} else {
							$query72  = $db->prepare("SELECT id_kustomer, email, password, level, nama_lengkap, aktif FROM kustomer WHERE email = ?");
							$query72->bind_param("s", $email);
							$query72->execute();
							$result72 = $query72->get_result();
							$row72    = $result72->fetch_assoc();
							if ( $email <> $row72['email'] ){
								echo '<div class="alert alert-danger alert-login" role="alert">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>Peringatan!</strong> E-Mail Yang Anda Masukan Salah';
								echo '</div>';
							} else if ( $password <> password_verify($password,$row72['password']) ){
								echo '<div class="alert alert-danger alert-login" role="alert">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>Peringatan!</strong> Password Yang Anda Masukan Salah';
								echo '</div>';
							} else if ( $row72['aktif'] != "Y" ){
								echo '<div class="alert alert-danger alert-login" role="alert">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>Peringatan!</strong> Akun Anda Sudah Tidak Aktif';
								echo '</div>';
							} else {
								$_SESSION['pbemail'] = $row72['email'];
								$_SESSION['pblevel'] = $row72['level'];
								$_SESSION['pbnama']  = $row72['nama_lengkap'];
								$_SESSION['pbid']    = $row72['id_kustomer'];
								echo "<meta http-equiv='refresh' content='0; url=konfirmasi-pesanan.html'>";
							}
						}
					}
				
				?>
					<input type="text" class="user" name="email" placeholder="E-Mail" required="">
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