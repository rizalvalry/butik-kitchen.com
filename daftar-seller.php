	<!--breadcrumbs-->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Beranda</a></li>
				<li class="active">Daftar Seller</li>
			</ol>
		</div>
	</div>
	<!--//breadcrumbs-->
	<!--login-->
	<div class="login-page">
		<div class="title-info wow fadeInUp animated" data-wow-delay=".5s">
			<h3 class="title">Daftar<span> Seller</span></h3>
			<p>Silahkan isikan data diri Anda dengan benar pada form dibawah ini</p>
		</div>
		<div class="widget-shadow">
			<div class="login-top wow fadeInUp animated" data-wow-delay=".7s">
				<h4>Sudah Punya Akun ?<a href="login-seller.html">  Masuk »</a> </h4>
			</div>
			<div class="login-body">
			<?php
				if ( isset($_POST['daftar']) ){
					
					date_default_timezone_set('Asia/Jakarta');
					$nama_depan    = $_POST['nama_depan'];
					$nama_belakang = $_POST['nama_belakang'];
					$email         = $_POST['email'];
					$pass          = $_POST['pass'];
					$upass         = $_POST['upass'];
					$alamat        = $_POST['alamat'];
					$tlp           = $_POST['tlp'];
					$kode          = $_POST['kode'];
					$level         = "User";
					$blokir        = "Y";
					$nama_lengkap  = $nama_depan.' '.$nama_belakang;
					$cost          = ['cost' => 10,];
					$hash          = password_hash($upass, PASSWORD_BCRYPT,$cost);
					$id_session    = session_id();
					$web           = $_POST['web'];
					$perusahaan    = $_POST['perusahaan'];
					$foto          = $_FILES['foto']['name'];
					$tfoto         = $_FILES['foto']['type'];
					$acak          = rand(1,99);
					$unik          = $acak.$foto;
					$query76       = $db->query("SELECT email FROM user WHERE email='$email'");
					$row76         = $query76->fetch_assoc();
					
					if ( empty($nama_depan) ){
						echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
						echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
						echo '<strong>Peringatan!</strong> Nama Depan Tidak Boleh Kosong';
						echo '</div>';
					} else if ( empty($nama_belakang) ){
						echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
						echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
						echo '<strong>Peringatan!</strong> Nama Belakang Tidak Boleh Kosong';
						echo '</div>';
					} else if ( empty($email) ){
						echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
						echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
						echo '<strong>Peringatan!</strong> E-Mail Tidak Boleh Kosong';
						echo '</div>';
					} else if ( empty($pass) ){
						echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
						echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
						echo '<strong>Peringatan!</strong> Kata Sandi Tidak Boleh Kosong';
						echo '</div>';
					} else if ( empty($upass) ){
						echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
						echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
						echo '<strong>Peringatan!</strong> Konfirmasi Kata Sandi Tidak Boleh Kosong';
						echo '</div>';
					} else if ( empty($alamat) ){
						echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
						echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
						echo '<strong>Peringatan!</strong> Alamat Tidak Boleh Kosong';
						echo '</div>';
					} else if ( empty($tlp) ){
						echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
						echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
						echo '<strong>Peringatan!</strong> Nomor Telpon Tidak Boleh Kosong';
						echo '</div>';
					} else if ( empty($kode) ){
						echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
						echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
						echo '<strong>Peringatan!</strong>  Hasil Hitung Tidak Boleh Kosong';
						echo '</div>';
					} else if ( !preg_match("/^[a-zA-Z]*$/",$nama_depan) ){
						echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
						echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
						echo '<strong>Peringatan!</strong>  Nama Depan Tidak Boleh Mengandung Angka dan Katakter';
						echo '</div>';
					} else if ( !preg_match("/^[a-zA-Z .,]*$/",$nama_belakang) ){
						echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
						echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
						echo '<strong>Peringatan!</strong>  Nama Belakang Tidak Boleh Mengandung Angka dan Katakter';
						echo '</div>';
					} else if ( strlen($pass) < 6 ){
						echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
						echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
						echo '<strong>Peringatan!</strong>  Kata Sandi Minimal 6 Karakter';
						echo '</div>';
					} else if ( strlen($upass) < 6 ){
						echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
						echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
						echo '<strong>Peringatan!</strong>  Konfirmasi Kata Sandi Minimal 6 Karakter';
						echo '</div>';
					} else if ( $pass <> $upass ){
						echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
						echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
						echo '<strong>Peringatan!</strong>  Kata Sandi dan Konfirmasi Kata Sandi Tidak Cocok';
						echo '</div>';
					} else if ( !preg_match("/^[0-9+]*$/",$tlp) ){
						echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
						echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
						echo '<strong>Peringatan!</strong>  Nomor Telpon Harus Angka';
						echo '</div>';
					} else if ( $row76['email'] == $email ){
						echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
						echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
						echo '<strong>Peringatan!</strong>  E-Mail Yang Anda Masukan Sudah Terdaftar';
						echo '</div>';
					} else if ( $tfoto != 'image/jpg' AND $tfoto != 'image/jpeg' AND $tfoto != 'image/png' ){
						echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
						echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
						echo '<strong>Peringatan!</strong>  Tipe Foto Harus jpg/png';
						echo '</div>';
					} else {
						if ( $kode == $_SESSION['key'] ){
							if ( empty($foto) ){
								$query77 = $db->prepare("INSERT INTO user (nama_lengkap, email, password, perusahaan, alamat, no_telp, nama_web, level, blokir, id_session) VALUES (?,?,?,?,?,?,?,?,?,?)");
								$query77->bind_param("ssssssssss", $nama_lengkap,$email,$hash,$perusahaan,$alamat,$tlp,$web,$level,$blokir,$id_session);
								$query77->execute();
							} else {
								include "config/thumb.php";
								Uploadseller($unik,$tfoto);
								$query77 = $db->prepare("INSERT INTO user (nama_lengkap, email, password, perusahaan, alamat, no_telp, nama_web, level, blokir, id_session, foto) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
								$query77->bind_param("sssssssssss", $nama_lengkap,$email,$hash,$perusahaan,$alamat,$tlp,$web,$level,$blokir,$id_session, $unik);
								$query77->execute();
							}
							echo '<div class="alert alert-info" role="alert">';
							echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
							echo '<strong>SUKSES!</strong>  Pendaftaran berhasil, kami akan segera mengkonfirmasi ke E-mail Anda';
							echo '</div>';
							echo "<meta http-equiv='refresh' content='2; url=daftar-seller.html'>";
						} else {
							echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
							echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
							echo '<strong>Peringatan!</strong>  Hasil Hitung Yang Anda Masukan Salah';
							echo '</div>';
						}
					}
					
				}
			?>
				<form class="wow fadeInUp animated" data-wow-delay=".7s" method="POST" action="" enctype="multipart/form-data">
					<input type="text" value="<?php echo isset ( $nama_depan ) ? $nama_depan : ""; ?>" name="nama_depan" placeholder="Nama Depan" required="">
					<input type="text" value="<?php echo isset ( $nama_belakang ) ? $nama_belakang : ""; ?>" name="nama_belakang" placeholder="Nama Belakang" required="">
					<input type="email" value="<?php echo isset ( $email ) ? $email : ""; ?>" name="email" placeholder="Alamat Email" required="">
					<input type="password" value="<?php echo isset ( $pass ) ? $pass : ""; ?>" name="pass" class="lock" placeholder="Kata Sandi" required="">
					<input type="password" value="<?php echo isset ( $upass ) ? $upass : ""; ?>" name="upass" class="lock" placeholder="Konfirmasi Kata Sandi" required="">
					<input type="text" value="<?php echo isset ( $perusahaan ) ? $perusahaan : ""; ?>" name="perusahaan" placeholder="Nama Perusahaan">
					<textarea name="alamat" placeholder="Alamat Lengkap Beserta Kode Pos" required=""><?php echo isset ( $alamat ) ? $alamat : ""; ?></textarea>
					<input type="text" value="<?php echo isset ( $tlp ) ? $tlp : ""; ?>" name="tlp" placeholder="Nomor Telepon Yang Bisa Dihubungi" required="">
					<input type="text" value="<?php echo isset ( $web ) ? $web : ""; ?>" name="web" placeholder="Alamat Website">
					<input type="file" name="foto" required="">
					<img src="captcha/captcha.php" />
					<input type="text" name="kode" placeholder="Masukan Hasil Hitungan Diatas" required="">
					<input type="submit" name="daftar" value="Daftar">
				</form>
			</div>
		</div>
	</div>
	<!--//login-->