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
				<span style="font-size : 30px;">Galeri</span> beranda / galeri
				</div>
				<div class="col-sm-4">
					<p class="pull-right">
					<button type="button" class="btn btn-info" data-toggle="tooltip" title="Tambah" onclick="window.location.href='?module=galeri&act=tambahgaleri';"><i class="glyphicon glyphicon-plus"></i></button>
					<button type="submit" class="btn btn-success" name="aktif"  data-toggle="tooltip"  title="Aktifkan"><i class="glyphicon glyphicon-ok"></i></button>
					<button type="submit" class="btn btn-warning" name="nonaktif"  data-toggle="tooltip"  title="Nonaktifkan"><i class="glyphicon glyphicon-remove"></i></button>
					<button type="submit" class="btn btn-danger"  name="hapus"  data-toggle="tooltip" onClick="return confirm('Data yang sudah dihapus tidak bisa dikembalikan lagi. Apakah anda yakin ?')" title="Hapus"><i class="glyphicon glyphicon-trash"></i></button>
					<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=galeri';"><i class="glyphicon glyphicon-refresh"></i></button>
					</p>
				</div>
			</div>
			<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><i class="glyphicon glyphicon-list"></i>   Data Galeri</h4>
					
				</div>
				<div class="panel-body">	
					<?php					
						if ( isset($_POST['hapus']) ){
							
							$id  = $_POST['id'];
							$jml = count($id);
							
							if( $jml > 0 ){
								for ($i = 0; $i <= $jml; $i++){
									$query1     = $db->prepare("SELECT id_galeri, gambar FROM galeri WHERE id_galeri=?");
									$query2     = $db->prepare("DELETE FROM galeri WHERE id_galeri=?");
									$query1->bind_param("i", $id_galeri);
									$query2->bind_param("i", $id_galeri);
									$id_galeri  = $id[$i];
									$query1->execute();
									$result     = $query1->get_result();
									$row        = $result->fetch_assoc();
									unlink("../gambar/thumb_galeri/$row[gambar]");
									$query3     = $db->query("SELECT foto FROM foto WHERE id_galeri = '$id_galeri'");
									while($row3 = $query3->fetch_assoc() ){
										$db->query("DELETE FROM foto WHERE id_galeri = '$id_galeri'");
										unlink("../gambar/foto/$row3[foto]");
										unlink("../gambar/thumb_foto/$row3[foto]");
									}
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
							
						} else if ( isset($_POST['nonaktif']) ){
							
							$id  = $_POST['id'];
							$jml = count($id);
							
							if( $jml > 0 ){
								for ($i = 0; $i <= $jml; $i++){
									$query     = $db->prepare("UPDATE galeri SET aktif = ? WHERE id_galeri=?");
									$query->bind_param("si", $aktif,$id_galeri);
									$id_galeri = $id[$i];
									$aktif     = "T";
									$query->execute();
									
								}
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> '.$jml.' Galeri Berhasil Dinonaktifkan';
								echo '</div>';
							} else {
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>Peringatan!</strong> Silahkan Tandai Terlebih Dahulu Galeri Yang Akan Anda Nonaktifkan';
								echo '</div>';
							}
							
						} else if ( isset($_POST['aktif']) ){
							
							$id  = $_POST['id'];
							$jml = count($id);
							
							if( $jml > 0 ){
								for ($i = 0; $i <= $jml; $i++){
									$query     = $db->prepare("UPDATE galeri SET aktif = ? WHERE id_galeri = ?");
									$query->bind_param("si", $aktif,$id_galeri);
									$id_galeri = $id[$i];
									$aktif     = "Y";
									$query->execute();
									
								}
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> '.$jml.' Galeri Berhasil Diaktifkan';
								echo '</div>';
							} else {
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>Peringatan!</strong> Silahkan Tandai Terlebih Dahulu Galeri Yang Akan Anda Aktifkan';
								echo '</div>';
							}
							
						}
					?>
					<div class="table-responsive">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr class="bg-warning">
									<th><label><input type="checkbox" name="semua" id="semua" /></label> NO</th>
									<th>Judul</th>
									<th>Gambar</th>
									<th>Aktif</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$no     = 1;
									$query5 = $db->query("SELECT * FROM galeri ORDER BY judul_galeri ASC");
									while( $row    = $query5->fetch_assoc()){
								?>
								<tr>
									<td><label><input type="checkbox" name="id[]" value="<?php echo $row['id_galeri']; ?>" /> <?php echo $no; ?></label></td>
									<td><?php echo $row['judul_galeri']; ?></td>
									<td><img src="../gambar/thumb_galeri/<?php echo $row['gambar']; ?>" class="img-thumbnail" width="30%" height="30%" /></td>
									<td><?php echo ( $row['aktif'] == "Y" ) ? "Aktif" : "Tidak Aktif"; ?></td>
									<td><a href="?module=galeri&act=ubahgaleri&id=<?php echo $row['id_galeri']; ?>&token=<?php echo md5(md5($row['id_galeri']).md5('H3ndri@27')); ?>" class="btn btn-primary" data-toggle="tooltip"  title="Ubah" role="button"><i class="fa fa-pencil"></i></a></td>
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
				case "tambahgaleri" :
			?>
			
			<form method="POST" action="" class="form-horizontal" enctype="multipart/form-data">
			<div class="row">
				<div class="col-sm-10">
				<span style="font-size : 30px;">Galeri</span> beranda / tambah galeri
				</div>
				<div class="col-sm-2">
					<p class="pull-right">
						<button class="btn btn-info" name="tambah" type="submit" data-toggle="tooltip" title="Simpan"><i class="fa fa-save"></i></button>
						<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=galeri&act=tambahgaleri';"><i class="fa fa-refresh"></i></button>
						<button type="button" class="btn btn-danger" data-toggle="tooltip" title="Kembali" onclick="window.location.href='?module=galeri';"><i class="fa fa-share"></i></button>
					</p>
					
				</div>
			</div>
			
			<div class="row">
			<div class="panel-group">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><i class="glyphicon glyphicon-pencil"></i>   Tambah Galeri</h4>
					
				</div>
				<div class="panel-body">	 
					<?php
						
						
						if ( isset($_POST['tambah']) ){
							
							date_default_timezone_set('Asia/Jakarta');
							
							$judul = $_POST['judul'];
							$keterangan = $_POST['keterangan'];
							$aktif = $_POST['aktif'];
							$tgl   = date("Y-m-d");
							$jam   = date("h:i:sa");
							$foto  = $_FILES['foto']['name'];
							$tfoto = $_FILES['foto']['type'];
							$acak  = rand(1,99);
							$unik  = $acak.$foto;
							
							if ( $tfoto != 'image/jpeg' AND $tfoto != 'image/jpg' AND $tfoto != 'image/png' ){
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATAN!</strong> Gambar Harus Berekstensi Jpeg/Png';
								echo '</div>';
							} else {
								Uploadgaleri($unik,$tfoto);
								$query = $db->prepare("INSERT INTO galeri (judul_galeri,keterangan,aktif,gambar) VALUES (?,?,?,?)");
								$query->bind_param("ssss", $judul,$keterangan,$aktif,$unik);
								$query->execute();
								
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> Data Berhasil Disimpan';
								echo '</div>';
								echo "<meta http-equiv='refresh' content='1; url=?module=galeri&act=tambahgaleri'>";
							}
																			
						}	
					
					?>
						
						<div class="form-group">
							<label class="control-label col-sm-4">Judul Galeri</label>
							<div class="col-sm-4">
								<input type="text" value="<?php echo isset( $judul ) ? $judul : ""; ?>" class="form-control" name="judul" placeholder="Judul Galeri" maxlength="100" required  autofocus />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Keterangan</label>
							<div class="col-sm-8">
								<textarea id="tinymce_basic" rows="10" type="text" class="form-control" name="keterangan" placeholder="keterangan Galeri"><?php echo isset( $keterangan ) ? $keterangan : ""; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Aktif</label>
							<div class="col-sm-6">
								<div class="radio">
									<label><input type="radio" name="aktif" value="Y" checked /> <b>Ya</b>, Maka Galeri Aktif</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="aktif" value="T" /> <b>Tidak</b>, Maka Galeri Tidak Aktif</label>
								</div>
							</div>
						</div>	
						<div class="form-group">
							<label class="control-label col-sm-4">Gambar <a href="#" class="badge badge-primary">595x500px</a></label>
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
				case "ubahgaleri" :
				$token  = $_GET['token'];
				$cek    = md5(md5($_GET['id']).md5('H3ndri@27'));
				if ( $cek == $token ){
			?>
			<form method="POST" action="" class="form-horizontal" enctype="multipart/form-data">
			<div class="row">
				<div class="col-sm-10">
				<span style="font-size : 30px;">Galeri</span> beranda / ubah galeri
				</div>
				<div class="col-sm-2">
					<p class="pull-right">
						<button class="btn btn-info" name="ubah" type="submit" data-toggle="tooltip" title="Simpan"><i class="fa fa-save"></i></button>
						<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=galeri&act=ubahgaleri&id=<?php echo $_GET['id']; ?>&token=<?php echo $_GET['token']; ?>';"><i class="fa fa-refresh"></i></button>
						<button type="button" class="btn btn-danger" data-toggle="tooltip" title="Kembali" onclick="window.location.href='?module=galeri';"><i class="fa fa-share"></i></button>
					</p>
					
				</div>
			</div>
			<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><i class="glyphicon glyphicon-edit"></i>   Ubah galeri</h4>
					
				</div>
				<div class="panel-body">	 
					<?php
						
						$query1    = $db->prepare("SELECT judul_galeri, keterangan, gambar FROM galeri WHERE id_galeri = ?");
						$query1->bind_param("i", $id_galeri);
						$id_galeri = $_GET['id'];
						$query1->execute();
						$result    = $query1->get_result();
						$row1      = $result->fetch_assoc();
						
						if ( isset($_POST['ubah']) ){
							
							$judul      = $_POST['judul'];
							$keterangan      = $_POST['keterangan'];
							$foto       = $_FILES['foto']['name'];
							$tfoto      = $_FILES['foto']['type'];
							$acak       = rand(1,99);
							$unik       = $acak.$foto;
							$id_galeri  = $_GET['id'];
							
							if ( empty($foto) ){
								$query = $db->prepare("UPDATE galeri SET judul_galeri = ?, keterangan = ? WHERE id_galeri=?");
								$query->bind_param("ssi", $judul,$keterangan,$id_galeri);
								$query->execute();
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> Data Berhasil Diubah';
								echo '</div>';
								echo "<meta http-equiv='refresh' content='1; url=?module=galeri&act=ubahgaleri&id=$_GET[id]&token=$_GET[token]'>";
							} else {
								if ( $tfoto != 'image/jpeg' AND $tfoto != 'image/jpg' AND $tfoto != 'image/png' ){
									echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATAN!</strong> Gambar Harus Berekstensi Jpeg/Png';
								echo '</div>';
								} else {
									unlink("../gambar/thumb_galeri/$row1[gambar]");
									Uploadgaleri($unik,$tfoto);
									$query = $db->prepare("UPDATE galeri SET judul_galeri = ?, keterangan =?, gambar = ? WHERE id_galeri=?");
									$query->bind_param("sssi", $judul,$keterangan,$unik,$id_galeri);
									$query->execute();
									
									echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
									echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
									echo '<strong>SUKSES!</strong> Data Berhasil Diubah';
									echo '</div>';
									echo "<meta http-equiv='refresh' content='1; url=?module=galeri&act=ubahgaleri&id=$_GET[id]&token=$_GET[token]'>";
								}
	
							}
							
						}
					
					?>
						<div class="form-group">
							<label class="control-label col-sm-4">Judul Galeri</label>
							<div class="col-sm-4">
								<input type="text" value="<?php echo $row1['judul_galeri']; ?>" class="form-control" name="judul"  maxlength="100" required />
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4">Keterangan Galeri</label>
							<div class="col-sm-8">
								<textarea id="tinymce_basic" type="text" class="form-control" name="keterangan"><?php echo $row1['keterangan']; ?></textarea>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-sm-4">Gambar </label>
							<div class="col-sm-4">
								<img src="../gambar/thumb_galeri/<?php echo $row1['gambar']; ?>" class="img-thumbnail" width="40%" height="40%" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Ganti Gambar <a href="#" class="badge badge-primary">595x500px</a></label>
							<div class="col-sm-4">
								<input type="file"  class="form-control" name="foto" onchange="readURL(this);"  />
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
