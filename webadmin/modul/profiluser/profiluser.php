<?php
	if( $_SESSION['email']=="" AND $_SESSION['level']=="" ){
		header('location:blank.php?eror='.md5('hendri@27').'');
	} else {
?>
<form method="POST" action="" class="form-horizontal" enctype="multipart/form-data">
			<div class="row">
				<div class="col-sm-10">
				<span style="font-size : 30px;">Profil User</span> beranda / profil user
				</div>
				<div class="col-sm-2">
					<p class="pull-right">
					<button type="submit" class="btn btn-info" name="simpan"  data-toggle="tooltip"  title="Simpan"><i class="fa fa-save"></i></button>
					<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=profiluser';"><i class="glyphicon glyphicon-refresh"></i></button>
					</p>
				</div>
			</div>
			<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><i class="glyphicon glyphicon-pencil"></i>   Profil User</h4>\
					
				</div>
				<div class="panel-body">	
				<?php
					$query = $db->prepare("SELECT nama_lengkap,no_telp,blokir,foto,email FROM user WHERE id_user=?");
					$query->bind_param("i", $id);
					$id    = $_SESSION['id'];
					$query->execute();
					$result= $query->get_result();
					$row   = $result->fetch_assoc();
					
					if ( isset($_POST['simpan']) ){
						
						$nama  = $_POST['nama'];
						$tlp   = $_POST['tlp'];
						$foto  = $_FILES['foto']['name'];
						$tfoto = $_FILES['foto']['type'];
						$email = $_POST['email'];
						
						$acak  = rand(1,99);
						$unik  = $acak.$foto;
						$css   = "border : 1px solid red;";
						
						$eror  = array();
						if ( empty($nama) ){
							$eror = $css;
							echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
							echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
							echo '<strong>Peringatan!</strong> Nama Tidak Boleh Kosong';
							echo '</div>';
						} else if ( !preg_match("/^[a-zA-Z .,]*$/",$nama) ) {
							$eror['nama']  = $css;
							echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
							echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
							echo '<strong>PERINGATRANN!</strong> Nama Tidak Boleh Mengandung Angka dan Karakter';
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
						} else {
							if ( empty($foto) ){
								$query = $db->prepare("UPDATE user SET nama_lengkap=?,no_telp=?, email=? WHERE id_user=?");
								$query->bind_param("sssi", $nama,$tlp,$email,$id);
								$query->execute();
							} else {
								if ( $tfoto != 'image/jpeg' AND $tfoto <> 'image/png' AND $tfoto <> 'image/jpg' ){
									$eror['foto']  = $css;
									echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
									echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
									echo '<strong>PERINGATRANN!</strong> Foto Harus Berekstensi Jpeg/Png';
									echo '</div>';
								} else {
									Uploaduser($unik,$tfoto);
									$query = $db->prepare("UPDATE user SET nama_lengkap=?,no_telp=?,foto=?,email=? WHERE id_user=?");
									$query->bind_param("ssssi", $nama,$tlp,$unik,$email,$id);
									$query->execute();
									unlink ("../gambar/user/$row[foto]");
									unlink ("../gambar/thumb_user/$row[foto]");
									unlink ("../gambar/thumb_user2/$row[foto]");
								}
								
							}
							echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
							echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
							echo '<strong>Sukses!</strong> Profil Berhasil Diperbaharui';
							echo '</div>';
							echo "<meta http-equiv='refresh' content='1; url=?module=profiluser'>";
						}
						
					}
				
				?>
					<div class="widget_middle">
					<div class="col-sm-6">
						<img src="../gambar/user/<?php echo $row['foto']; ?>" class="img-thumbnail" />
					</div>
					<div class="col-sm-6">
						<h4 align="center">Data Pribadi</h4>
						<form class="form-horizontal">
							<div class="form-group">
								<label class="control-label col-sm-4">E-Mail</label>
								<div class="col-sm-6">
									<input type="text" value="<?php echo $row['email']; ?>" name="email" class="form-control" required/>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4">Nama Lengkap</label>
								<div class="col-sm-6">
									<input type="text" class="form-control" name="nama" maxlength="40" value="<?php echo $row['nama_lengkap'];?>" style="<?php echo ( $eror['nama'] ) ? $eror['nama'] : ""; ?>" />
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4">Nomor Telpon</label>
								<div class="col-sm-5">
									<input type="text" class="form-control" maxlength="15" name="tlp" value="<?php echo $row['no_telp'];?>" style="<?php echo ( $eror['tlp'] ) ? $eror['tlp'] : ""; ?>" />
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4">Status</label>
								<div class="col-sm-3">
									<input type="text" class="form-control" value="<?php echo ( $row['blokir'] == "Y" ) ? "Blokir" : "Aktif"; ?>" disabled />
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4">Level</label>
								<div class="col-sm-3">
									<input type="text" class="form-control" value="<?php echo $_SESSION['level']; ?>" disabled />
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4">Ganti Foto</label>
								<div class="col-sm-8">
									<input type="file" class="form-control" name="foto" style="<?php echo ( $eror['foto'] ) ? $eror['foto'] : ""; ?>" />
								</div>
							</div>
						</form>
					</div>
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>
			</form>
<?php
	}
?>