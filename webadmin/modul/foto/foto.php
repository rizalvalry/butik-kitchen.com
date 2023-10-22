<?php
	
	if( $_SESSION['email']=="" AND $_SESSION['level']=="" ){
		header('location:blank.php?eror='.md5('hendri@27').'');
	} else {
		switch ( $_GET['act'] ){
			default :
?>
			<form method="POST" action="" class="form-horizontal">
			<div class="row">
				<div class="col-sm-8">
				<span style="font-size : 30px;">Foto</span> beranda / foto
				</div>
				<div class="col-sm-4">
					<p class="pull-right">
					<button type="button" class="btn btn-info" data-toggle="tooltip" title="Tambah" onclick="window.location.href='?module=foto&act=tambahfoto';"><i class="glyphicon glyphicon-plus"></i></button>
					<button type="submit" class="btn btn-danger"  name="hapus"  data-toggle="tooltip" onClick="return confirm('Data yang sudah dihapus tidak bisa dikembalikan lagi. Apakah anda yakin ?')" title="Hapus"><i class="glyphicon glyphicon-trash"></i></button>
					<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=foto';"><i class="glyphicon glyphicon-refresh"></i></button>
					</p>
				</div>
			</div>
			<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><i class="glyphicon glyphicon-list"></i>   Data Foto</h4>
					
				</div>
				<div class="panel-body">	
					<?php					
						if ( isset($_POST['hapus']) ){
							
							$id  = $_POST['id'];
							$jml = count($id);
							
							if( $jml > 0 ){
								for ($i = 0; $i <= $jml; $i++){
									$query1   = $db->prepare("SELECT foto FROM foto WHERE id_foto = ?");
									$query2   = $db->prepare("DELETE FROM foto WHERE id_foto = ?");
									$query1->bind_param("i", $id_foto);
									$query2->bind_param("i", $id_foto);
									$id_foto  = $id[$i];
									$query1->execute();
									$result   = $query1->get_result();
									$row      = $result->fetch_assoc();
									unlink("../gambar/foto/$row[foto]");
									unlink("../gambar/thumb_foto/$row[foto]");
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
							
						}
					?>
					<div class="table-responsive">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr class="bg-warning">
									<th><label><input type="checkbox" name="semua" id="semua" /></label> NO</th>
									<th>Galeri</th>
									<th>Judul</th>
									<th>Gambar</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$no     = 1;
									$query5 = $db->query("SELECT galeri.judul_galeri, foto.id_foto, foto.judul_foto, foto.foto FROM foto INNER JOIN galeri ON foto.id_galeri=galeri.id_galeri ORDER BY galeri.judul_galeri ASC");
									while( $row    = $query5->fetch_assoc()){
								?>
								<tr>
									<td><label><input type="checkbox" name="id[]" value="<?php echo $row['id_foto']; ?>" /> <?php echo $no; ?></label></td>
									<td><?php echo $row['judul_galeri']; ?></td>
									<td><?php echo $row['judul_foto']; ?></td>
									<td><img src="../gambar/thumb_foto/<?php echo $row['foto']; ?>" class="img-thumbnail" width="30%" height="30%" /></td>
									<td><a href="?module=foto&act=ubahfoto&id=<?php echo $row['id_foto']; ?>&token=<?php echo md5(md5($row['id_foto']).md5('H3ndri@27')); ?>" class="btn btn-primary" data-toggle="tooltip"  title="Ubah" role="button"><i class="fa fa-pencil"></i></a></td>
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
				case "tambahfoto" :
			?>
			
			<form method="POST" action="" class="form-horizontal" enctype="multipart/form-data">
			<div class="row">
				<div class="col-sm-10">
				<span style="font-size : 30px;">Foto</span> beranda / tambah Foto
				</div>
				<div class="col-sm-2">
					<p class="pull-right">
						<button class="btn btn-info" name="tambah" type="submit" data-toggle="tooltip" title="Simpan"><i class="fa fa-save"></i></button>
						<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=foto&act=tambahfoto';"><i class="fa fa-refresh"></i></button>
						<button type="button" class="btn btn-danger" data-toggle="tooltip" title="Kembali" onclick="window.location.href='?module=foto';"><i class="fa fa-share"></i></button>
					</p>
					
				</div>
			</div>
			
			<div class="row">
			<div class="panel-group">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><i class="glyphicon glyphicon-pencil"></i>   Tambah Foto</h4>
					
				</div>
				<div class="panel-body">	 
					<?php
						
						
						if ( isset($_POST['tambah']) ){
							
							$galeri = $_POST['galeri'];
							$judul  = $_POST['judul'];
							$ket    = $_POST['ket'];
							$foto   = $_FILES['foto']['name'];
							$tfoto  = $_FILES['foto']['type'];
							$acak   = rand(1,99);
							$unik   = $acak.$foto;
							
							if ( $tfoto != 'image/jpeg' AND $tfoto != 'image/jpg' AND $tfoto != 'image/png' ){
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATAN!</strong> Gambar Harus Berekstensi Jpeg/Png';
								echo '</div>';
							} else {
								Uploadfoto($unik,$tfoto);
								$query = $db->prepare("INSERT INTO foto (id_galeri, judul_foto, foto, keterangan) VALUES (?,?,?,?)");
								$query->bind_param("isss", $galeri,$judul,$unik,$ket);
								$query->execute();
								
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> Data Berhasil Disimpan';
								echo '</div>';
								echo "<meta http-equiv='refresh' content='1; url=?module=foto&act=tambahfoto'>";
							}
																			
						}	
					
					?>
						<div class="form-group">
							<label class="control-label col-sm-4">Galeri</label>
							<div class="col-sm-4">
								<select name="galeri" class="form-control" id="select7" required>
									<option value=""></option>
									<?php
										$query321       = $db->query("SELECT id_galeri, judul_galeri FROM galeri ORDER BY judul_galeri ASC");
										while ( $row321 = $query321->fetch_assoc() ){
											echo '<option value="'.$row321['id_galeri'].'">'.$row321['judul_galeri'].'</option>';
										}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Judul Foto</label>
							<div class="col-sm-4">
								<input type="text" value="<?php echo isset( $judul ) ? $judul : ""; ?>" class="form-control" name="judul" placeholder="Judul Foto" maxlength="100" required  autofocus />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Keterangan</label>
							<div class="col-sm-8">
								<textarea name="ket" class="form-control" id="tinymce_basic" rows="10"><?php echo isset( $ket ) ? $ket : ""; ?></textarea>
							</div>
						</div>	
						<div class="form-group">
							<label class="control-label col-sm-4">Gambar</label>
							<div class="col-sm-4">
								<input type="file"  class="form-control" name="foto" onchange="readURL(this);"  required />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Preview Gambar</label>
							<div class="col-sm-4">
								<img id="preview_gambar" src="images/slide.png" class="img-thumbnail" />
							</div>
						</div>
				</div>
			</div>
			</div>
			</form>
			
			
			<?php
				break;
				case "ubahfoto" :
				$token  = $_GET['token'];
				$cek    = md5(md5($_GET['id']).md5('H3ndri@27'));
				if ( $cek == $token ){
			?>
			<form method="POST" action="" class="form-horizontal" enctype="multipart/form-data">
			<div class="row">
				<div class="col-sm-10">
				<span style="font-size : 30px;">Foto</span> beranda / ubah foto
				</div>
				<div class="col-sm-2">
					<p class="pull-right">
						<button class="btn btn-info" name="ubah" type="submit" data-toggle="tooltip" title="Simpan"><i class="fa fa-save"></i></button>
						<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=foto&act=ubahfoto&id=<?php echo $_GET['id']; ?>&token=<?php echo $_GET['token']; ?>';"><i class="fa fa-refresh"></i></button>
						<button type="button" class="btn btn-danger" data-toggle="tooltip" title="Kembali" onclick="window.location.href='?module=foto';"><i class="fa fa-share"></i></button>
					</p>
					
				</div>
			</div>
			<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><i class="glyphicon glyphicon-edit"></i>   Ubah Foto</h4>
					
				</div>
				<div class="panel-body">	 
					<?php
						
						$query1    = $db->prepare("SELECT id_galeri, judul_foto, foto, keterangan FROM foto WHERE id_foto = ?");
						$query1->bind_param("i", $id_foto);
						$id_foto   = $_GET['id'];
						$query1->execute();
						$result    = $query1->get_result();
						$row1      = $result->fetch_assoc();
						
						if ( isset($_POST['ubah']) ){
							$galeri     = $_POST['galeri'];
							$judul      = $_POST['judul'];
							$ket        = $_POST['ket'];
							$foto       = $_FILES['foto']['name'];
							$tfoto      = $_FILES['foto']['type'];
							$acak       = rand(1,99);
							$unik       = $acak.$foto;
							$id_foto  = $_GET['id'];
							
							if ( empty($foto) ){
								$query = $db->prepare("UPDATE foto SET id_galeri = ?, judul_foto = ?, keterangan = ? WHERE id_foto = ?");
								$query->bind_param("issi", $galeri,$judul,$ket,$id_foto);
								$query->execute();
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> Data Berhasil Diubah';
								echo '</div>';
								echo "<meta http-equiv='refresh' content='1; url=?module=foto&act=ubahfoto&id=$_GET[id]&token=$_GET[token]'>";
							} else {
								if ( $tfoto != 'image/jpeg' AND $tfoto != 'image/jpg' AND $tfoto != 'image/png' ){
									echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATAN!</strong> Gambar Harus Berekstensi Jpeg/Png';
								echo '</div>';
								} else {
									unlink("../gambar/thumb_foto/$row1[foto]");
									unlink("../gambar/foto/$row1[foto]");
									Uploadfoto($unik,$tfoto);
									$query = $db->prepare("UPDATE foto SET id_galeri = ?, foto = ?, judul_foto = ?, keterangan = ? WHERE id_foto=?");
									$query->bind_param("isssi", $galeri,$unik,$judul,$ket,$id_foto);
									$query->execute();
									
									echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
									echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
									echo '<strong>SUKSES!</strong> Data Berhasil Diubah';
									echo '</div>';
									echo "<meta http-equiv='refresh' content='1; url=?module=foto&act=ubahfoto&id=$_GET[id]&token=$_GET[token]'>";
								}
	
							}
							
						}
					
					?>
						<div class="form-group">
							<label class="control-label col-sm-4">Galeri</label>
							<div class="col-sm-4">
								<select name="galeri" class="form-control" id="select7" required>
									<option value=""></option>
									<?php
										$query321       = $db->query("SELECT id_galeri, judul_galeri FROM galeri ORDER BY judul_galeri ASC");
										while ( $row321 = $query321->fetch_assoc() ){
											$pilih = ( $row321['id_galeri'] == $row1['id_galeri'] ) ? "selected" : "";
											echo '<option value="'.$row321['id_galeri'].'" '.$pilih.'>'.$row321['judul_galeri'].'</option>';
										}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Judul Foto</label>
							<div class="col-sm-4">
								<input type="text" value="<?php echo $row1['judul_foto']; ?>" class="form-control" name="judul" placeholder="Judul Foto" maxlength="100" required  />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Keterangan</label>
							<div class="col-sm-8">
								<textarea name="ket" class="form-control" id="tinymce_basic" rows="10"><?php echo $row1['keterangan']; ?></textarea>
							</div>
						</div>	
						<div class="form-group">
							<label class="control-label col-sm-4">Gambar Saat Ini</label>
							<div class="col-sm-4">
								<img src="../gambar/thumb_foto/<?php echo $row1['foto']; ?>" width="40%" height="40%" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Ubah Gambar</label>
							<div class="col-sm-4">
								<input type="file"  class="form-control" name="foto" onchange="readURL(this);"/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Preview Gambar</label>
							<div class="col-sm-4">
								<img id="preview_gambar" src="images/slide.png" class="img-thumbnail" />
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
