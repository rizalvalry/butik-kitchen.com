	<!--breadcrumbs-->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Beranda</a></li>
				<li class="active">Daftar</li>
			</ol>
		</div>
	</div>
	<!--//breadcrumbs-->
	<!--login-->
	<div class="login-page">
		<div class="title-info wow fadeInUp animated" data-wow-delay=".5s">
			<h3 class="title">Form<span> Daftar</span></h3>
			<p>Silahkan isikan data diri Anda dengan benar pada form dibawah ini</p>
		</div>
		<div class="widget-shadow">
			<div class="login-top wow fadeInUp animated" data-wow-delay=".7s">
				<h4>Sudah Punya Akun ?<a href="selesai-belanja.html">  Masuk »</a> </h4>
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
					$kec           = $_POST['kec'];
					$kode          = $_POST['kode'];
					$level         = "kustomer";
					$aktif         = "Y";
					$tanggal       = date("Y-m-d");
					$jam           = date("H:i:s");
					$nama_lengkap  = $nama_depan.' '.$nama_belakang;
					$cost          = ['cost' => 10,];
					$hash          = password_hash($upass, PASSWORD_BCRYPT,$cost);
					
					$query76       = $db->query("SELECT email FROM kustomer WHERE email='$email'");
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
					} else if ( empty($kec) ){
						echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
						echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
						echo '<strong>Peringatan!</strong> Kecamatan Tidak Boleh Kosong';
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
					} else {
						if ( $kode == $_SESSION['key'] ){
							$query77 = $db->prepare("INSERT INTO kustomer (id_kec,nama_lengkap,email,password,alamat,telpon,tanggal,jam,aktif,level) VALUES (?,?,?,?,?,?,?,?,?,?)");
							$query77->bind_param("isssssssss", $kec,$nama_lengkap,$email,$hash,$alamat,$tlp,$tanggal,$jam,$aktif,$level);
							$query77->execute();
							$_SESSION['pbemail'] = $email;
							$_SESSION['pblevel'] = $level;
							$_SESSION['pbnama']  = $nama_lengkap;
							$_SESSION['pbid']    = $db->insert_id;
							echo "<meta http-equiv='refresh' content='0; url=konfirmasi-pesanan.html'>";
						} else {
							echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
							echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
							echo '<strong>Peringatan!</strong>  Hasil Hitung Yang Anda Masukan Salah';
							echo '</div>';
						}
					}
					
				}
			?>
				<form class="wow fadeInUp animated" data-wow-delay=".7s" method="POST" action="">
					<input type="text" value="<?php echo isset ( $nama_depan ) ? $nama_depan : ""; ?>" name="nama_depan" placeholder="Nama Depan" required="">
					<input type="text" value="<?php echo isset ( $nama_belakang ) ? $nama_belakang : ""; ?>" name="nama_belakang" placeholder="Nama Belakang" required="">
					<input type="email" value="<?php echo isset ( $email ) ? $email : ""; ?>" name="email" placeholder="Alamat Email" required="">
					<input type="password" value="<?php echo isset ( $pass ) ? $pass : ""; ?>" name="pass" class="lock" placeholder="Kata Sandi" required="">
					<input type="password" value="<?php echo isset ( $upass ) ? $upass : ""; ?>" name="upass" class="lock" placeholder="Konfirmasi Kata Sandi" required="">
					<textarea name="alamat" placeholder="Alamat Lengkap Beserta Kode Pos" required=""><?php echo isset ( $alamat ) ? $alamat : ""; ?></textarea>
					<input type="text" value="<?php echo isset ( $tlp ) ? $tlp : ""; ?>" name="tlp" placeholder="Nomor Telepon Yang Bisa Dihubungi" required="">
					<select name="propinsi" id="propinsi" required="">
						<option value="" disabled selected>-- Pilih Provinsi --</option>
						<?php
							$query17       = $db->query("SELECT id_prov,nama_prov FROM prov ORDER BY nama_prov ASC");
							while ( $row17 = $query17->fetch_assoc()  ){
								echo '<option value="'.$row17['id_prov'].'">'.$row17['nama_prov'].'</option>';
							}
						?>
					</select>
					<select name="kota" id="kota" required="">
						<option value="" disabled selected>-- Kabupaten/Kota --</option>
					</select>
					<select name="kec" id="kec" required="">
						<option value="" disabled selected>-- Pilih Kecamatan --</option>	
					</select>
					<img src="captcha/captcha.php" />
					<input type="text" name="kode" placeholder="Masukan Hasil Hitungan Diatas" required="">
					<input type="submit" name="daftar" value="Daftar">
				</form>
			</div>
		</div>
	</div>
	<!--//login-->
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