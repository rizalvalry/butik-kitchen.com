<?php
	if( $_SESSION['email']=="" AND $_SESSION['level']=="" ){
		header('location:blank.php?eror='.md5('hendri@27').'');
	} else {
		$query = $db->prepare("SELECT * FROM profil WHERE id_profil=?");
		$query->bind_param("i", $id);
		$id    = 1;
		$query->execute();
		$result= $query->get_result();
		$row   = $result->fetch_assoc();
?>
	<form method="POST" action="" class="form-horizontal" enctype="multipart/form-data">
			<div class="row">
				<div class="col-sm-10">
				<span style="font-size : 30px;">Profil Toko</span> beranda / profil toko
				</div>
				<div class="col-sm-2">
					<p class="pull-right">
					<button type="submit" class="btn btn-info" name="simpan"  data-toggle="tooltip"  title="Simpan"><i class="fa fa-save"></i></button>
					<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=profiltoko';"><i class="glyphicon glyphicon-refresh"></i></button>
					</p>
				</div>
			</div>
			<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><i class="glyphicon glyphicon-list"></i>   Profil Toko</h4>
					
				</div>
				<div class="panel-body">	
				
					<div class="widget_middle">
					<div class="col-sm-3">
						<img src="../gambar/toko/<?php echo $row['gambar']; ?>" class="img-thumbnail" />
						
					</div>
					<div class="col-sm-9">
					<?php				
					if ( isset($_POST['simpan']) ){
						$alamat_web     = $_POST['alamat_web'];					
						$nama           = $_POST['toko'];
						$alamat         = $_POST['alamat'];
						$meta_deskripsi = $_POST['meta_deskripsi'];
						$meta_keyword   = $_POST['meta_keyword'];
						$email          = $_POST['email'];
						$hp             = $_POST['no_hp'];
						$bb             = $_POST['pin_bb'];
						$rek            = $_POST['no_rek'];
						$foto           = $_FILES['foto']['name'];
						$tfoto          = $_FILES['foto']['type'];
						$lfoto          = $_FILES['foto']['tmp_name'];
						$deskripsi      = $_POST['deskripsi'];
						$id             = 1;
						$folder         = "../gambar/toko/";
						$protokol       = $_POST['protokol'];
						$pass           = $_POST['pass'];
						$host           = $_POST['host'];
						$port           = $_POST['port'];
						
						if ( !preg_match("/^[0-9+]*$/",$hp) ){
							echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
							echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
							echo '<strong>PERINGATRANN!</strong> Nomor Telpon Harus Angka';
							echo '</div>';
						} else {
							if ( empty($foto) ){
								$query = $db->prepare("UPDATE profil SET nama_toko=?,alamat=?,meta_deskripsi=?,meta_keyword=?,email_pengelola=?,nomor_rekening=?,nomor_hp=?,pin_bb=?,static_content=?,email_protokol=?,password=?,host=?,port=?,alamat_web=? WHERE id_profil=?");
								$query->bind_param("ssssssssssssssi", $nama,$alamat,$meta_deskripsi,$meta_keyword,$email,$rek,$hp,$bb,$deskripsi,$protokol,$pass,$host,$port,$alamat_web,$id);
								$query->execute();
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> Profil Toko Berhasil Diubah';
								echo '</div>';
								echo "<meta http-equiv='refresh' content='1; url=?module=profiltoko'>";
							} else {
								if ( $tfoto != 'image/jpeg' AND $tfoto != 'image/jpg' AND $tfoto != 'image/png' ){
									echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
									echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
									echo '<strong>PERINGATRANN!</strong> Foto Harus Berekstensi Jpeg/Png';
									echo '</div>';
								} else {
									unlink("../gambar/toko/$row[gambar]");
									move_uploaded_file($lfoto, $folder.$foto);
									$query = $db->prepare("UPDATE profil SET nama_toko=?,alamat=?,meta_deskripsi=?,meta_keyword=?,email_pengelola=?,nomor_rekening=?,nomor_hp=?,pin_bb=?,gambar=?,static_content=?,email_protokol=?,password=?,host=?,port=?,alamat_web=? WHERE id_profil=?");
									$query->bind_param("sssssssssssssssi", $nama,$alamat,$meta_deskripsi,$meta_keyword,$email,$rek,$hp,$bb,$foto,$deskripsi,$protokol,$pass,$host,$port,$alamat_web,$id);
									$query->execute();
									echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
									echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
									echo '<strong>SUKSES!</strong> Profil Toko Berhasil Diubah';
									echo '</div>';
									echo "<meta http-equiv='refresh' content='1; url=?module=profiltoko'>";
								}
								
							}
						}
						
							
						
						
					}
				
				?>
							<ul class="nav nav-tabs">
								<li class="active"><a data-toggle="tab" href="#toko">Profil Website</a></li>
								<!-- <li><a data-toggle="tab" href="#surat">Surat</a></li> -->
							</ul>
							<div class="tab-content">
								<div id="toko" class="tab-pane fade in active">
									<div class="form-group">
										<label class="control-label col-sm-2">Alamat Web/Domain</label>
										<div class="col-sm-4">
											<input type="text" class="form-control" name="alamat_web" value="<?php echo $row['alamat_web'];?>" required />
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2">Nama Toko</label>
										<div class="col-sm-4">
											<input type="text" class="form-control" name="toko" value="<?php echo $row['nama_toko'];?>" required />
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2">Alamat</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" name="alamat" value="<?php echo $row['alamat'];?>" required />
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2">Meta Deskripsi</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="meta_deskripsi" value="<?php echo $row['meta_deskripsi'];?>" required />
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2">Meta Keyword</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="meta_keyword" value="<?php echo $row['meta_keyword'];?>" required />
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2">Hp Pengelola</label>
										<div class="col-sm-3">
											<input type="text" class="form-control" name="no_hp" value="<?php echo $row['nomor_hp'];?>" required />
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2">Banner Awal Tayang</label>
										<div class="col-sm-10">
											<textarea name="pin_bb" rows="10" id="tinymce_basic_two"><?php echo $row['pin_bb'];?></textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2">No Rekening</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" name="no_rek" value="<?php echo $row['nomor_rekening'];?>" required />
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2">Ganti Logo</label>
										<div class="col-sm-6">
											<input type="file" class="form-control" name="foto" />
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2">Deskripsi Toko</label>
										<div class="col-sm-10">
											<textarea name="deskripsi" rows="10" id="tinymce_basic"><?php echo $row['static_content']; ?></textarea>
										</div>
									</div>
								</div>
								<div id="surat" class="tab-pane fade">
									<div class="form-group">
										<label class="control-label col-sm-2">E-Mail Protokol</label>
										<div class="col-sm-5">
											<label class="radio-inline"><input type="radio" name="protokol" value="Surat" <?php echo ( $row['email_protokol'] == "Surat" ) ? "checked" : "";?> />Surat </label>
											<label class="radio-inline"><input type="radio" name="protokol" value="SMTP" <?php echo ( $row['email_protokol'] == "SMTP" ) ? "checked" : "";?> />SMTP </label>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2">E-Mail Pengelola</label>
										<div class="col-sm-5">
											<input type="email" class="form-control" name="email" value="<?php echo $row['email_pengelola'];?>" required />
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2">Password</label>
										<div class="col-sm-5">
											<input type="password" class="form-control" name="pass" value="<?php echo $row['password'];?>" />
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2">SMTP Hostname</label>
										<div class="col-sm-5">
											<input type="text" class="form-control" name="host" value="<?php echo $row['host'];?>" />
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2">E-SMTP Port</label>
										<div class="col-sm-5">
											<input type="text" class="form-control" name="port" value="<?php echo $row['port'];?>" />
										</div>
									</div>
								</div>
							</div>		
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