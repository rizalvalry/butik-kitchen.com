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
				<span style="font-size : 30px;">Banner</span> beranda / banner
				</div>
				<div class="col-sm-4">
					<p class="pull-right">
					<button type="button" class="btn btn-info" data-toggle="tooltip" title="Tambah" onclick="window.location.href='?module=banner&act=tambahbanner';"><i class="glyphicon glyphicon-plus"></i></button>
					<button type="submit" class="btn btn-success" name="aktif"  data-toggle="tooltip"  title="Aktifkan"><i class="glyphicon glyphicon-ok"></i></button>
					<button type="submit" class="btn btn-warning" name="nonaktif"  data-toggle="tooltip"  title="Nonaktifkan"><i class="glyphicon glyphicon-remove"></i></button>
					<button type="submit" class="btn btn-danger"  name="hapus"  data-toggle="tooltip" onClick="return confirm('Data yang sudah dihapus tidak bisa dikembalikan lagi. Apakah anda yakin ?')" title="Hapus"><i class="glyphicon glyphicon-trash"></i></button>
					<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=banner';"><i class="glyphicon glyphicon-refresh"></i></button>
					</p>
				</div>
			</div>
			<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><i class="glyphicon glyphicon-list"></i>   Data Baner</h4>
					
				</div>
				<div class="panel-body">	
					<?php
						include "../config/tgl_indo.php";						
						if ( isset($_POST['hapus']) ){
							
							$id  = $_POST['id'];
							$jml = count($id);
							
							if( $jml > 0 ){
								for ($i = 0; $i <= $jml; $i++){
									$query1      = $db->prepare("SELECT gambar FROM banner WHERE id_banner=?");
									$query2      = $db->prepare("DELETE FROM banner WHERE id_banner=?");
									$query1->bind_param("i", $id_banner);
									$query2->bind_param("i", $id_banner);
									$id_banner   = $id[$i];
									$query1->execute();
									$result      = $query1->get_result();
									$row         = $result->fetch_assoc();
									unlink("../gambar/banner/$row[gambar]");
									unlink("../gambar/thumb_banner/$row[gambar]");
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
									$query       = $db->prepare("UPDATE banner SET aktif=? WHERE id_banner=?");
									$query->bind_param("si", $aktif,$id_banner);
									$id_banner   = $id[$i];
									$aktif       = "T";
									$query->execute();
									
								}
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> '.$jml.' Baner Berhasil Dinonaktifkan';
								echo '</div>';
							} else {
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>Peringatan!</strong> Silahkan Tandai Terlebih Dahulu Baner Yang Akan Anda Nonaktifkan';
								echo '</div>';
							}
							
						} else if ( isset($_POST['aktif']) ){
							
							$id  = $_POST['id'];
							$jml = count($id);
							
							if( $jml > 0 ){
								for ($i = 0; $i <= $jml; $i++){
									$query       = $db->prepare("UPDATE banner SET aktif=? WHERE id_banner=?");
									$query->bind_param("si", $aktif,$id_banner);
									$id_banner   = $id[$i];
									$aktif       = "Y";
									$query->execute();
									
								}
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> '.$jml.' Baner Berhasil Diaktifkan';
								echo '</div>';
							} else {
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>Peringatan!</strong> Silahkan Tandai Terlebih Dahulu Baner Yang Akan Anda Aktifkan';
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
									<th>Link</th>
									<th>Tanggal</th>
									<th>Aktif</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$no     = 1;
									$query5 = $db->query("SELECT id_banner, judul_banner, gambar, url, tanggal, aktif FROM banner ORDER BY id_banner DESC");
									while( $row    = $query5->fetch_assoc()){
										$tanggal   = tgl_indo($row['tanggal']);
								?>
								<tr>
									<td><label><input type="checkbox" name="id[]" value="<?php echo $row['id_banner']; ?>" /> <?php echo $no; ?></label></td>
									<td><?php echo $row['judul_banner']; ?></td>
									<td><img src="../gambar/thumb_banner/<?php echo $row['gambar']; ?>" class="img-thumbnail" width="30%" height="30%" /></td>
									<td><?php echo $row['url']; ?></td>
									<td><?php echo $tanggal; ?></td>
									<td><?php echo ( $row['aktif'] == "Y" ) ? "Aktif" : "Tidak Aktif"; ?></td>
									<td><a href="?module=banner&act=ubahbanner&id=<?php echo $row['id_banner']; ?>&token=<?php echo md5(md5($row['id_banner']).md5('H3ndri@27')); ?>" class="btn btn-primary" data-toggle="tooltip"  title="Ubah" role="button"><i class="fa fa-pencil"></i></a></td>
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
				case "tambahbanner" :
			?>
			
			<form method="POST" action="" class="form-horizontal" enctype="multipart/form-data">
			<div class="row">
				<div class="col-sm-10">
				<span style="font-size : 30px;">Banner</span> beranda / tambah banner
				</div>
				<div class="col-sm-2">
					<p class="pull-right">
						<button class="btn btn-info" name="tambah" type="submit" data-toggle="tooltip" title="Simpan"><i class="fa fa-save"></i></button>
						<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=banner&act=tambahbanner';"><i class="fa fa-refresh"></i></button>
						<button type="button" class="btn btn-danger" data-toggle="tooltip" title="Kembali" onclick="window.location.href='?module=banner';"><i class="fa fa-share"></i></button>
					</p>
					
				</div>
			</div>
			
			<div class="row">
			<div class="panel-group">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><i class="glyphicon glyphicon-pencil"></i>   Tambah Banner</h4>
					
				</div>
				<div class="panel-body">	 
					<?php
						
						
						if ( isset($_POST['tambah']) ){
							
							date_default_timezone_set('Asia/Jakarta');
							
							$judul = $_POST['judul'];
							$url   = $_POST['url'];
							$aktif = $_POST['aktif'];
							$ket   = $_POST['keterangan'];
							$tgl   = date("Y-m-d");
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
								Uploadbanner($unik,$tfoto);
								$query = $db->prepare("INSERT INTO banner (judul_banner,url,aktif,tanggal,gambar,keterangan) VALUES (?,?,?,?,?,?)");
								$query->bind_param("ssssss", $judul,$url,$aktif,$tgl,$unik,$ket);
								$query->execute();
								
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> Data Berhasil Disimpan';
								echo '</div>';
								echo "<meta http-equiv='refresh' content='1; url=?module=banner&act=tambahbanner'>";
							}
																			
						}	
					
					?>
						
						<div class="form-group">
							<label class="control-label col-sm-4">Judul Banner</label>
							<div class="col-sm-4">
								<input type="text" value="<?php echo isset( $judul ) ? $judul : ""; ?>" class="form-control" name="judul" placeholder="Judul Banner" maxlength="50"   autofocus />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">URL Link</label>
							<div class="col-sm-5">
								<input type="text" value="<?php echo isset( $url ) ? $url : ""; ?>" class="form-control" name="url" placeholder="URL Link" maxlength="50" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Keterangan</label>
							<div class="col-sm-8">
								<textarea name="keterangan" id="tinymce_basic" rows="6"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Aktif</label>
							<div class="col-sm-6">
								<div class="radio">
									<label><input type="radio" name="aktif" value="Y" checked /> <b>Ya</b>, Maka Slide Aktif</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="aktif" value="T" /> <b>Tidak</b>, Maka Slide Tidak Aktif</label>
								</div>
							</div>
						</div>	
						<div class="form-group">
							<label class="control-label col-sm-4">Gambar <a href="#" class="badge badge-primary">358px x 200px</a></label>
							
							<div class="col-sm-4">
								<input type="file"  class="form-control" name="foto" onchange="readURL(this);"  required />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Preview Gambar</label>
							<div class="col-sm-4">
								<img id="preview_gambar" src="images/slide.png" class="" />
							</div>
						</div>
				</div>
			</div>
			</div>
			</form>
			
			
			<?php
				break;
				case "ubahbanner" :
				$token  = $_GET['token'];
				$cek    = md5(md5($_GET['id']).md5('H3ndri@27'));
				if ( $cek == $token ){
			?>
			<form method="POST" action="" class="form-horizontal" enctype="multipart/form-data">
			<div class="row">
				<div class="col-sm-10">
				<span style="font-size : 30px;">Banner</span> beranda / ubah banner
				</div>
				<div class="col-sm-2">
					<p class="pull-right">
						<button class="btn btn-info" name="ubah" type="submit" data-toggle="tooltip" title="Simpan"><i class="fa fa-save"></i></button>
						<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=banner&act=ubahbanner&id=<?php echo $_GET['id']; ?>&token=<?php echo $_GET['token']; ?>';"><i class="fa fa-refresh"></i></button>
						<button type="button" class="btn btn-danger" data-toggle="tooltip" title="Kembali" onclick="window.location.href='?module=banner';"><i class="fa fa-share"></i></button>
					</p>
					
				</div>
			</div>
			<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><i class="glyphicon glyphicon-edit"></i>   Ubah Slide</h4>
					
				</div>
				<div class="panel-body">	 
					<?php
						
						$query1    = $db->prepare("SELECT warna,judul_banner,url,keterangan,gambar FROM banner WHERE id_banner=?");
						$query1->bind_param("i", $id_banner);
						$id_banner = $_GET['id'];
						$query1->execute();
						$result    = $query1->get_result();
						$row1      = $result->fetch_assoc();
						
						if ( isset($_POST['ubah']) ){
							
							$judul      = $_POST['judul'];
							$warna      = $_POST['warna'];
							$url        = $_POST['url'];
							$ket        = $_POST['keterangan'];
							$foto       = $_FILES['foto']['name'];
							$tfoto      = $_FILES['foto']['type'];
							$acak       = rand(1,99);
							$unik       = $acak.$foto;
							$id_banner  = $_GET['id'];
							
							if ( empty($foto) ){
								$query = $db->prepare("UPDATE banner SET judul_banner=?, warna=?, url=?,keterangan=? WHERE id_banner=?");
								$query->bind_param("ssssi", $judul,$warna,$url,$ket,$id_banner);
								$query->execute();
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> Data Berhasil Diubah';
								echo '</div>';
								echo "<meta http-equiv='refresh' content='1; url=?module=banner&act=ubahbanner&id=$_GET[id]&token=$_GET[token]'>";
							} else {
								if ( $tfoto != 'image/jpeg' AND $tfoto != 'image/jpg' AND $tfoto != 'image/png' ){
									echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATAN!</strong> Gambar Harus Berekstensi Jpeg/Png';
								echo '</div>';
								} else {
									unlink("../gambar/banner/$row1[gambar]");
									unlink("../gambar/thumb_banner/$row1[gambar]");
									Uploadbanner($unik,$tfoto);
									$query = $db->prepare("UPDATE banner SET judul_banner=?,warna=?,url=?,gambar=?,keterangan=? WHERE id_banner=?");
									$query->bind_param("sssssi", $judul,$warna,$url,$unik,$ket,$id_banner);
									$query->execute();
									
									echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
									echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
									echo '<strong>SUKSES!</strong> Data Berhasil Diubah';
									echo '</div>';
									echo "<meta http-equiv='refresh' content='1; url=?module=banner&act=ubahbanner&id=$_GET[id]&token=$_GET[token]'>";
								}
	
							}
							
						}
					
					?>
						<div class="form-group">
							<label class="control-label col-sm-4">Judul Slide</label>
							<div class="col-sm-4">
								<input type="text" value="<?php echo $row1['judul_banner']; ?>" class="form-control" name="judul"  maxlength="50"  />
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-4">Warna Font</label>
							<div class="col-sm-4">
								
								<input type="color" id="favcolor" name="warna" value="<?php echo $row1['warna']; ?>"><br><br>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-4">URL Link</label>
							<div class="col-sm-5">
								<input type="text" value="<?php echo $row1['url']; ?>" class="form-control" name="url" maxlength="50" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Keterangan</label>
							<div class="col-sm-8">
								<textarea name="keterangan" id="tinymce_basic" rows="10"><?php echo $row1['keterangan']; ?></textarea>
							</div>
						</div>
						<div class="form-group">
						<label class="control-label col-sm-4">Gambar <a href="#" class="badge badge-primary">358px x 200px</a></label>
							<div class="col-sm-4">
								<img src="../gambar/thumb_banner/<?php echo $row1['gambar']; ?>" class="img-thumbnail" width="40%" height="40%" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Ganti Gambar</label>
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
