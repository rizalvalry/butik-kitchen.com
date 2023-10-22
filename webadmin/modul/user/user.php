<?php
	
	if( $_SESSION['email']=="" AND $_SESSION['level']=="" ){
		header('location:blank.php?eror='.md5('hendri@27').'');
	} else {
		switch ( $_GET['act'] ){
			default :
?>
			<form method="POST" action="" class="form-horizontal">
			<div class="row">
				<div class="col-sm-9">
				<span style="font-size : 30px;">Seller</span> beranda / seller
				</div>
				<div class="col-sm-3">
					<p class="pull-right">
					<button type="button" class="btn btn-info" data-toggle="tooltip" title="Tambah" onclick="window.location.href='?module=user&act=tambahuser';"><i class="glyphicon glyphicon-plus"></i></button>
					<button type="submit" class="btn btn-success" name="unblokir"  data-toggle="tooltip"  title="Aktifkan User"><i class="glyphicon glyphicon-ok"></i></button>
					<button type="submit" class="btn btn-warning" name="blokir"  data-toggle="tooltip"  title="Blokir User"><i class="glyphicon glyphicon-remove"></i></button>					
					<button type="submit" class="btn btn-danger"  name="hapus"  data-toggle="tooltip" onClick="return confirm('Data yang sudah dihapus tidak bisa dikembalikan lagi. Apakah anda yakin ?')" title="Hapus"><i class="glyphicon glyphicon-trash"></i></button>
					<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=user';"><i class="glyphicon glyphicon-refresh"></i></button>
					</p>
				</div>
			</div>
			<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><i class="glyphicon glyphicon-list"></i>   Data Seller</h4>
					
				</div>
				<div class="panel-body">	
					<?php
						if ( isset($_POST['hapus']) ){
							$id  = $_POST['id'];
							$jml = count($id);
							if( $jml > 0 ){
								for ($i = 0; $i <= $jml; $i++){
									//$query2 = $db->prepare("DELETE FROM user WHERE email=?");
									$query1 = $db->prepare("SELECT foto FROM user WHERE id_user=?");
									$query2 = $db->prepare("DELETE FROM user WHERE id_user=?");
									$query1->bind_param("s", $email);
									$query2->bind_param("s", $email);
									//$query2->bind_param("s", $email);
									$email  = $id[$i];
									//$query2->execute();
									$query1->execute();
									$result = $query1->get_result();
									$row    = $result->fetch_assoc();
									unlink("../gambar/user/$row[foto]");
									unlink("../gambar/thumb_user/$row[foto]");
									unlink("../gambar/thumb_user2/$row[foto]");
									$query2->execute();
								}
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> '.$jml.' Data Berhasil Dihapus';
								echo '</div>';
							} else {
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>Peringatan!</strong> Silahkan Tandai Terlebih Dahulu Data Yang Akan Anda Hapus';
								echo '</div>';
							}
							
						} else if ( isset($_POST['blokir']) ) {
							$id  = $_POST['id'];
							$jml = count($id);
								if( $jml > 0 ){
								for ($i = 0; $i <= $jml; $i++){
									$query = $db->prepare("UPDATE user SET blokir=? WHERE id_user=?");
									$query->bind_param("ss", $blok,$email);
									$blok  = "Y";
									$email = $id[$i];
									$query->execute();
								}
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> '.$jml.' Data Berhasil Diblokir';
								echo '</div>';
							} else {
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>Peringatan!</strong> Silahkan Tandai Terlebih Dahulu Data Yang Akan Anda Blokir';
								echo '</div>';
							}
							
						} else if ( isset($_POST['unblokir']) ){
							$id  = $_POST['id'];
							$jml = count($id);
							if( $jml > 0 ){
								for ($i = 0; $i <= $jml; $i++){
									$query = $db->prepare("UPDATE user SET blokir=? WHERE id_user=?");
									$query->bind_param("ss", $blok,$email);
									$blok  = "T";
									$email = $id[$i];
									$query->execute();
								}
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> '.$jml.' Data Berhasil Diaktifkan';
								echo '</div>';
							} else {
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>Peringatan!</strong> Silahkan Tandai Terlebih Dahulu Data Yang Akan Anda Aktifkan';
								echo '</div>';
							}
						}
					?>
					<div class="table-responsive">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr class="bg-warning">
									<th><label><input type="checkbox" name="semua" id="semua" /></label> NO</th>
									<th>Username</th>
									<th>Nama Lengkap</th>
									<th>Foto</th>
									<th>Level</th>
									<th>Status</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$no     = 1;
									$query5 = $db->query("SELECT * FROM user ORDER BY nama_lengkap ASC");
									while( $row    = $query5->fetch_assoc()){						
								?>
								<tr>
									<td><label><input type="checkbox" name="id[]" value="<?php echo $row['id_user']; ?>" /> <?php echo $no; ?></label></td>
									<td><?php echo $row['email']; ?></td>
									<td><?php echo $row['nama_lengkap']; ?></td>
									<td><img src="../gambar/thumb_user/<?php echo $row['foto']; ?>" /></td>
									<td><?php echo $row['level']; ?></td>
									<td><?php echo ( $row['blokir'] == "Y" ) ? "Blokir" : "Aktif"; ?></td>
									<td><a href="?module=user&act=ubahuser&id=<?php echo $row['id_user']; ?>&token=<?php echo md5(md5($row['id_user']).md5('H3ndri@27')); ?>" class="btn btn-primary" data-toggle="tooltip"  title="Ubah" role="button"><i class="fa fa-pencil"></i></a></td>
								</tr>
								<?php
									$no++;
									}
								?>
							</tbody>
						</table>
					</div>
					</div>
			</div>
			</div>
			</form>
			<?php
				break;
				case "tambahuser" :
			?>
			<form method="POST" action="" class="form-horizontal" enctype="multipart/form-data">
			<div class="row">
				<div class="col-sm-10">
				<span style="font-size : 30px;">Seller</span> beranda / tambah seller
				</div>
				<div class="col-sm-2">
					<p class="pull-right">
						<button class="btn btn-info" name="tambah" type="submit" data-toggle="tooltip" title="Simpan"><i class="fa fa-save"></i></button>
						<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=user&act=tambahuser';"><i class="fa fa-refresh"></i></button>
						<button type="button" class="btn btn-danger" data-toggle="tooltip" title="Kembali" onclick="window.location.href='?module=user';"><i class="fa fa-share"></i></button>
					</p>
					
				</div>
			</div>
			<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><i class="glyphicon glyphicon-pencil"></i>   Tambah Seller</h4>
					
				</div>
				<div class="panel-body">	 
					<?php
						
						if ( isset($_POST['tambah']) ){
							
							$query1 = $db->prepare("SELECT email FROM user WHERE email=?");
							$query1->bind_param("s", $email);
							
							//membuat variabel form
							$email = $_POST['email'];
							$pass  = $_POST['pass'];
							$upass = $_POST['upas'];
							$nama  = $_POST['nama'];
							$tlp   = $_POST['tlp'];
							$perusahaan = "";
							$alamat = "";
							$nama_web = "";
							$level = $_POST['level'];
							$blok  = $_POST['blok'];
							$foto  = $_FILES['foto']['name'];
							$tfoto = $_FILES['foto']['type'];
							//membuat password bycrypt
							$cost  = ['cost' => 10,];
							$hash  = password_hash($pass, PASSWORD_BCRYPT,$cost);
							//mengunggah gambar dengan nama acak
							$dir   = "gambar/user/";
							$acak  = rand(1,99);
							$unik  = $acak.$foto;
							$css   = "border : 1px solid red;";
							$eror  = array();
							
							$query1->execute();
							$result1 = $query1-> get_result();
							$row1    = $result1->fetch_assoc();
							
							if( empty($email) ){
								$eror['email'] = $css;
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATRANN!</strong> E-Mail Tidak Boleh Kosong';
								echo '</div>';
							} else if ( empty($pass) ){
								$eror['pass']  = $css; 
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATRANN!</strong> Password Tidak Boleh Kosong';
								echo '</div>';
							} else if ( strlen($pass)<6 ){
								$eror['pass']  = $css;
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATRANN!</strong> Password Miniman 6 Karakter';
								echo '</div>';
							} else if ( $pass<>$upass ){
								$eror['upas']  = $css;
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATRANN!</strong> Password Dan Konfirmasik Password Tidak Sama';
								echo '</div>';
							} else if ( empty($tlp) ){
								$eror['tlp']   = $css;
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATRANN!</strong> Nomor Telpon Tidak Boleh Kosong';
								echo '</div>';
							} else if ( !preg_match("/^[0-9+]*$/",$tlp) ){
								$eror['tlp']   = $css;
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATRANN!</strong> Nomor Telpon Harus Angka';
								echo '</div>';
							} else if ( empty($nama) ){
								$eror['nama']  = $css;
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATRANN!</strong> Nama Tidak Boleh Kosong';
								echo '</div>';
							} else if ( !preg_match("/^[a-zA-Z .,]*$/",$nama) ) {
								$eror['nama']  = $css;
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATRANN!</strong> Nama Tidak Boleh Mengandung Angka dan Karakter';
								echo '</div>';
							} else if ( $tfoto != 'image/jpeg' AND $tfoto <> 'image/png' AND $tfoto <> 'image/jpg' ) {
								$eror['foto']  = $css;
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATRANN!</strong> Foto Harus Berekstensi Jpeg/Png';
								echo '</div>';
							} else if ( $email == $row1['email'] ){
								$eror['email']  = $css;
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATRANN!</strong> E-mail atau Username Yang Anda Masukan Sudah Terdaftar';
								echo '</div>';
							} else {
								Uploaduser($unik,$tfoto);
								$query = $db->prepare("INSERT INTO user (email,password,perusahaan,alamat,nama_web,nama_lengkap,no_telp,level,blokir,foto,id_session) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
								$query->bind_param("sssssssssss", $email,$hash,$perusahaan,$alamat,$nama_web,$nama,$tlp,$level,$blok,$unik,$hash);
								$query->execute();									
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> Data Berhasil Disimpan';
								echo '</div>';
								echo "<meta http-equiv='refresh' content='1; url=?module=user&act=tambahuser'>";
							}
							
							
						}
					
					?>
						<div class="form-group">
							<label class="control-label col-sm-4">E-Mail</label>
							<div class="col-sm-4">
								<input type="text" value="<?php echo isset( $email ) ? $email : ""; ?>" class="form-control" name="email" placeholder="E-Mail" maxlength="40" style="<?php echo ( $eror['email'] ) ? $eror['email'] : ""; ?>" required autofocus />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Password</label>
							<div class="col-sm-3">
								<input type="password" value="<?php echo isset( $pass ) ? $pass : ""; ?>" class="form-control" name="pass" placeholder="Paswword" style="<?php echo ( $eror['pass'] ) ? $eror['pass'] : ""; ?>"  required />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Konfirmasi Password</label>
							<div class="col-sm-3">
								<input type="password" value="<?php echo isset( $upass ) ? $upass : ""; ?>" class="form-control" name="upas" placeholder="Konfirmasi Paswword" style="<?php echo ( $eror['upas'] ) ? $eror['upas'] : ""; ?>"  required />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Nama Lengkap</label>
							<div class="col-sm-4">
								<input type="text" value="<?php echo isset( $nama ) ? $nama : ""; ?>" class="form-control" name="nama" placeholder="Nama Lengkap" maxlength="40" style="<?php echo ( $eror['nama'] ) ? $eror['nama'] : ""; ?>" required />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Nomor Telpon</label>
							<div class="col-sm-2">
								<input type="text" value="<?php echo isset( $tlp ) ? $tlp : ""; ?>" class="form-control" name="tlp" placeholder="Nomor Telpon" maxlength="15" style="<?php echo ( $eror['tlp'] ) ? $eror['tlp'] : ""; ?>" required />			
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Level</label>
							<div class="col-sm-4">
								<label class="radio-inline"><input type="radio" name="level" value="Admin" /> Admin</label>
								<label class="radio-inline"><input type="radio" name="level" value="User" checked /> User</label>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Blokir</label>
							<div class="col-sm-4">
								<label class="radio-inline"><input type="radio" name="blok" value="Y" /> Ya</label>
								<label class="radio-inline"><input type="radio" name="blok" value="T" checked /> Tidak</label>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Foto</label>
							<div class="col-sm-4">
								<input type="file" class="form-control" name="foto" required style="<?php echo ( $eror['foto'] ) ? $eror['foto'] : ""; ?>" onchange="readURL(this);" />
								<p class="help-block"><i>File gambar harus berekstention .JPG / JPEG</i></p>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Preview Foto</label>
							<div class="col-sm-4">
								<img id="preview_gambar" src="images/icon.png" class="img-thumbnail" />
							</div>
						</div>
					
				</div>
			</div>
			</div>
			</form>
			<?php
				break;
				case "ubahuser" :
				$token  = $_GET['token'];
				$cek    = md5(md5($_GET['id']).md5('H3ndri@27'));
				if ( $cek == $token ){
			?>
			<form method="POST" action="" class="form-horizontal" enctype="multipart/form-data">
			<div class="row">
				<div class="col-sm-10">
				<span style="font-size : 30px;">Seller</span> beranda / ubah seller
				</div>
				<div class="col-sm-2">
					<p class="pull-right">
						<button class="btn btn-info" name="ubah" type="submit" data-toggle="tooltip" title="Simpan"><i class="fa fa-save"></i></button>
						<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=user&act=ubahuser&id=<?php echo $_GET['id']; ?>&token=<?php echo $_GET['token']; ?>';"><i class="fa fa-refresh"></i></button>
						<button type="button" class="btn btn-danger" data-toggle="tooltip" title="Kembali" onclick="window.location.href='?module=user';"><i class="fa fa-share"></i></button>
					</p>
					
				</div>
			</div>
			<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><i class="glyphicon glyphicon-edit"></i>   Ubah Seller</h4>
					
				</div>
				<div class="panel-body">	 
					<?php
						$query  = $db->prepare("SELECT email,nama_lengkap,no_telp,level,foto FROM user WHERE id_user=?");
						$query->bind_param("i", $id);
						$id     = $_GET['id'];
						$query->execute();
						$result = $query->get_result();
						$row    = $result->fetch_assoc();
						
						//jika tombol simpan ditekan
						if ( isset($_POST['ubah']) ){							
							//membuat variabel form
							$email = $_POST['email'];
							$nama  = $_POST['nama'];
							$tlp   = $_POST['tlp'];
							$level = $_POST['level'];
							$foto  = $_FILES['foto']['name'];
							$tfoto = $_FILES['foto']['type'];
							
							//mengunggah gambar dengan nama acak
							$acak  = rand(1,99);
							$unik  = $acak.$foto;
							$css   = "border : 1px solid red";
							$eror  = array();
							if( empty($email) ){
								$eror['email'] = $css;
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATRANN!</strong> E-Mail Tidak Boleh Kosong';
								echo '</div>';
							
							} else if ( empty($tlp) ){
								$eror['tlp']   = $css;
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATRANN!</strong> Nomor Telpon Tidak Boleh Kosong';
								echo '</div>';
							} else if ( !preg_match("/^[0-9+]*$/",$tlp) ){
								$eror['tlp']   = $css;
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATRANN!</strong> Nomor Telpon Harus Angka';
								echo '</div>';
							} else if ( empty($nama) ){
								$eror['nama']  = $css;
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATRANN!</strong> Nama Tidak Boleh Kosong';
								echo '</div>';
							} else if ( !preg_match("/^[a-zA-Z .,]*$/",$nama) ) {
								$eror['nama']  = $css;
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATRANN!</strong> Nama Tidak Boleh Mengandung Angka dan Karakter';
								echo '</div>';
							} else {
								if ( empty($foto) ){
									$query = $db->prepare("UPDATE user SET nama_lengkap=?,no_telp=?,level=? WHERE email=?");
									$query->bind_param("ssss", $nama,$tlp,$level,$email);
									$query->execute();
									echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
									echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
									echo '<strong>SUKSES!</strong> Data Berhasil Diubah';
									echo '</div>';
									echo "<meta http-equiv='refresh' content='1; url=?module=user&act=ubahuser&id=$_GET[id]&token=$_GET[token]'>";
								} else {
									if ( $tfoto != 'image/jpeg' AND $tfoto <> 'image/png' AND $tfoto <> 'image/jpg' ){
										$eror['foto']  = $css;
										echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
										echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
										echo '<strong>PERINGATRANN!</strong> Foto Harus Berekstensi Jpeg/Png';
										echo '</div>';
										
										
									} else {
										unlink ("../gambar/user/$row[foto]");
										unlink ("../gambar/thumb_user/$row[foto]");
										unlink ("../gambar/thumb_user2/$row[foto]");
										Uploaduser($unik, $tfoto);
										$query = $db->prepare("UPDATE user SET nama_lengkap=?,no_telp=?,level=?,foto=? WHERE email=?");
										$query->bind_param("sssss", $nama,$tlp,$level,$unik,$email);
										$query->execute();
										
										echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
										echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
										echo '<strong>SUKSES!</strong> Data Berhasil Diubah';
										echo '</div>';
										echo "<meta http-equiv='refresh' content='1; url=?module=user&act=ubahuser&id=$_GET[id]&token=$_GET[token]'>";
									}
									
								}
								
							}
							
							
						}
					
					?>
						<div class="form-group">
							<label class="control-label col-sm-4">E-Mail</label>
							<div class="col-sm-4">
								<input type="text" value="<?php echo $row['email']; ?>" class="form-control" name="email"  maxlength="40" style="<?php echo ( $eror['email'] ) ? $eror['email'] : ""; ?>" readonly />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Nama Lengkap</label>
							<div class="col-sm-4">
								<input type="text" value="<?php echo $row['nama_lengkap']; ?>" class="form-control" name="nama" placeholder="Nama Lengkap" maxlength="40" style="<?php echo ( $eror['nama'] ) ? $eror['nama'] : ""; ?>" required />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Nomor Telpon</label>
							<div class="col-sm-2">
								<input type="text" value="<?php echo $row['no_telp']; ?>" class="form-control" name="tlp" placeholder="Nomor Telpon" maxlength="15" style="<?php echo ( $eror['tlp'] ) ? $eror['tlp'] : ""; ?>" required />			
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Level</label>
							<div class="col-sm-4">
								<label class="radio-inline"><input type="radio" name="level" value="Admin" <?php echo ( $row['level'] == "Admin" ) ? "checked" : ""; ?> /> Admin</label>
								<label class="radio-inline"><input type="radio" name="level" value="User" <?php echo ( $row['level'] == "User" ) ? "checked" : ""; ?> /> User</label>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Foto Saat Ini</label>
							<div class="col-sm-4">
								<img src="../gambar/thumb_user2/<?php echo $row['foto']; ?>" class="img-thumbnail" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Ganti Foto</label>
							<div class="col-sm-4">
								<input type="file" class="form-control" name="foto" style="<?php echo ( $eror['foto'] ) ? $eror['foto'] : ""; ?>" />
								<p class="help-block"><i>File gambar harus berekstention .JPG / JPEG</i></p>
							</div>
						</div>
					
				</div>
			</div>
			</div>
			</form>
<?php
				} else {
					echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
					echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
					echo '<strong>PERINGATRANN!</strong> Anda Tidak Boleh Iseng-Iseng Dengan URL :p';
					echo '</div>';
				}
		}
	}
?>
