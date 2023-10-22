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
				<span style="font-size : 30px;">Slide</span> beranda / slide
				</div>
				<div class="col-sm-4">
					<p class="pull-right">
					<button type="button" class="btn btn-info" data-toggle="tooltip" title="Tambah" onclick="window.location.href='?module=slide&act=tambahslide';"><i class="glyphicon glyphicon-plus"></i></button>
					<button type="submit" class="btn btn-success" name="aktif"  data-toggle="tooltip"  title="Aktifkan"><i class="glyphicon glyphicon-ok"></i></button>
					<button type="submit" class="btn btn-warning" name="nonaktif"  data-toggle="tooltip"  title="Nonaktifkan"><i class="glyphicon glyphicon-remove"></i></button>
					<button type="submit" class="btn btn-danger"  name="hapus"  data-toggle="tooltip" onClick="return confirm('Data yang sudah dihapus tidak bisa dikembalikan lagi. Apakah anda yakin ?')" title="Hapus"><i class="glyphicon glyphicon-trash"></i></button>
					<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=slide';"><i class="glyphicon glyphicon-refresh"></i></button>
					</p>
				</div>
			</div>
			<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><i class="glyphicon glyphicon-list"></i>   Data Slide</h4>
					
				</div>
				<div class="panel-body">	
					<?php
						include "../config/tgl_indo.php";						
						if ( isset($_POST['hapus']) ){
							
							$id  = $_POST['id'];
							$jml = count($id);
							
							if( $jml > 0 ){
								for ($i = 0; $i <= $jml; $i++){
									$query1 = $db->prepare("SELECT gambar FROM slide WHERE id_slide=?");
									$query2 = $db->prepare("DELETE FROM slide WHERE id_slide=?");
									$query1->bind_param("i", $id_slide);
									$query2->bind_param("i", $id_slide);
									$id_slide  = $id[$i];
									$query1->execute();
									$result = $query1->get_result();
									$row    = $result->fetch_assoc();
									unlink("../gambar/slide/$row[gambar]");
									unlink("../gambar/thumb_slide/$row[gambar]");
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
									$query = $db->prepare("UPDATE slide SET aktif=? WHERE id_slide=?");
									$query->bind_param("si", $aktif,$id_slide);
									$id_slide = $id[$i];
									$aktif    = "T";
									$query->execute();
									
								}
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> '.$jml.' Slide Berhasil Dinonaktifkan';
								echo '</div>';
							} else {
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>Peringatan!</strong> Silahkan Tandai Terlebih Dahulu Slide Yang Akan Anda Nonaktifkan';
								echo '</div>';
							}
							
						} else if ( isset($_POST['aktif']) ){
							
							$id  = $_POST['id'];
							$jml = count($id);
							
							if( $jml > 0 ){
								for ($i = 0; $i <= $jml; $i++){
									$query = $db->prepare("UPDATE slide SET aktif=? WHERE id_slide=?");
									$query->bind_param("si", $aktif,$id_slide);
									$id_slide = $id[$i];
									$aktif    = "Y";
									$query->execute();
									
								}
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> '.$jml.' Slide Berhasil Diaktifkan';
								echo '</div>';
							} else {
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>Peringatan!</strong> Silahkan Tandai Terlebih Dahulu Slide Yang Akan Anda Aktifkan';
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
									<th>Jam</th>
									<th>Aktif</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$no     = 1;
									$query5 = $db->query("SELECT * FROM slide ORDER BY id_slide DESC");
									while( $row    = $query5->fetch_assoc()){
										$tanggal   = tgl_indo($row['tanggal']);
								?>
								<tr>
									<td><label><input type="checkbox" name="id[]" value="<?php echo $row['id_slide']; ?>" /> <?php echo $no; ?></label></td>
									<td><?php echo $row['nama_slide']; ?></td>
									<td><img src="../gambar/thumb_slide/<?php echo $row['gambar']; ?>" class="img-thumbnail" width="30%" height="30%" /></td>
									<td><?php echo $row['link_slide']; ?></td>
									<td><?php echo $tanggal; ?></td>
									<td><?php echo $row['jam']; ?> WIB</td>
									<td><?php echo ( $row['aktif'] == "Y" ) ? "Aktif" : "Tidak Aktif"; ?></td>
									<td><a href="?module=slide&act=ubahslide&id=<?php echo $row['id_slide']; ?>&token=<?php echo md5(md5($row['id_slide']).md5('H3ndri@27')); ?>" class="btn btn-primary" data-toggle="tooltip"  title="Ubah" role="button"><i class="fa fa-pencil"></i></a></td>
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
				case "tambahslide" :
			?>
			
			<form method="POST" action="" class="form-horizontal" enctype="multipart/form-data">
			<div class="row">
				<div class="col-sm-10">
				<span style="font-size : 30px;">Slide</span> beranda / tambah slide
				</div>
				<div class="col-sm-2">
					<p class="pull-right">
						<button class="btn btn-info" name="tambah" type="submit" data-toggle="tooltip" title="Simpan"><i class="fa fa-save"></i></button>
						<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=slide&act=tambahslide';"><i class="fa fa-refresh"></i></button>
						<button type="button" class="btn btn-danger" data-toggle="tooltip" title="Kembali" onclick="window.location.href='?module=slide';"><i class="fa fa-share"></i></button>
					</p>
					
				</div>
			</div>
			
			<div class="row">
			<div class="panel-group">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><i class="glyphicon glyphicon-pencil"></i>   Tambah Slide</h4>\
					
				</div>
				<div class="panel-body">	 
					<?php
						
						
						if ( isset($_POST['tambah']) ){
							
							date_default_timezone_set('Asia/Jakarta');
							
							$nama_slide = $_POST['nama_slide'];
							$judul_slide = $_POST['judul_slide'];
							$deskripsi = $_POST['deskripsi'];
							$link_slide   = $_POST['link_slide'];
							$aktif = $_POST['aktif'];
							$tgl   = date("Y-m-d");
							$jam   = date("H:i:s");
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
								Uploadslide($unik,$tfoto);
								$query = $db->prepare("INSERT INTO slide (nama_slide,judul_slide,deskripsi,link_slide,aktif,tanggal,jam,gambar) VALUES (?,?,?,?,?,?,?,?)");
								$query->bind_param("ssssssss", $nama_slide,$judul_slide,$deskripsi,$link_slide,$aktif,$tgl,$jam,$unik);
								$query->execute();
								
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> Data Berhasil Disimpan';
								echo '</div>';
								echo "<meta http-equiv='refresh' content='1; url=?module=slide&act=tambahslide'>";
							}
																			
						}	
					
					?>
						
						<div class="form-group">
							<label class="control-label col-sm-4">Nama Slide</label>
							<div class="col-sm-4">
								<input type="text" value="<?php echo isset( $nama_slide ) ? $nama_slide : ""; ?>" class="form-control" name="nama_slide" placeholder="Nama Slide" maxlength="50"  autofocus />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Judul Slide</label>
							<div class="col-sm-4">
								<input type="text" value="<?php echo isset( $judul_slide ) ? $judul_slide : ""; ?>" class="form-control" name="judul_slide" placeholder="Judul Slide" maxlength="50"   autofocus />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Keterangan</label>
							<div class="col-sm-8">
								<textarea class="form-control" name="deskripsi" id="tinymce_basic" rows="10"><?php echo isset( $deskripsi ) ? $deskripsi : ""; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">URL Link</label>
							<div class="col-sm-5">
								<input type="text" value="<?php echo isset( $link_slide ) ? $link_slide : ""; ?>" class="form-control" name="link_slide" placeholder="URL Link" maxlength="50" />
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
							<label class="control-label col-sm-4">Gambar</label>
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
				case "ubahslide" :
				$token  = $_GET['token'];
				$cek    = md5(md5($_GET['id']).md5('H3ndri@27'));
				if ( $cek == $token ){
			?>
			<form method="POST" action="" class="form-horizontal" enctype="multipart/form-data">
			<div class="row">
				<div class="col-sm-10">
				<span style="font-size : 30px;">Slide</span> beranda / ubah slide
				</div>
				<div class="col-sm-2">
					<p class="pull-right">
						<button class="btn btn-info" name="ubah" type="submit" data-toggle="tooltip" title="Simpan"><i class="fa fa-save"></i></button>
						<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=slide&act=ubahslide&id=<?php echo $_GET['id']; ?>&token=<?php echo $_GET['token']; ?>';"><i class="fa fa-refresh"></i></button>
						<button type="button" class="btn btn-danger" data-toggle="tooltip" title="Kembali" onclick="window.location.href='?module=slide';"><i class="fa fa-share"></i></button>
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
						
						$query1 = $db->prepare("SELECT warna,nama_slide,judul_slide,deskripsi,link_slide,gambar FROM slide WHERE id_slide=?");
						$query1->bind_param("i", $id_slide);
						$id_slide = $_GET['id'];
						$query1->execute();
						$result = $query1->get_result();
						$row1   = $result->fetch_assoc();
						
						if ( isset($_POST['ubah']) ){
							
							$judul = $_POST['judul'];
							$warna      = $_POST['warna'];
							$judul_slide = $_POST['judul_slide'];
							$deskripsi = $_POST['deskripsi'];
							$url   = $_POST['url'];
							$foto  = $_FILES['foto']['name'];
							$tfoto = $_FILES['foto']['type'];
							$acak  = rand(1,99);
							$unik  = $acak.$foto;
							$id_slide  = $_GET['id'];
							
							if ( empty($foto) ){
								$query = $db->prepare("UPDATE slide SET nama_slide=?, judul_slide=?, warna=?, deskripsi=?, link_slide=? WHERE id_slide=?");
								$query->bind_param("sssssi", $judul,$judul_slide,$warna,$deskripsi,$url,$id_slide);
								$query->execute();
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> Data Berhasil Diubah';
								echo '</div>';
								echo "<meta http-equiv='refresh' content='1; url=?module=slide&act=ubahslide&id=$_GET[id]&token=$_GET[token]'>";
							} else {
								if ( $tfoto != 'image/jpeg' AND $tfoto != 'image/jpg' AND $tfoto != 'image/png' ){
									echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATAN!</strong> Gambar Harus Berekstensi Jpeg/Png';
								echo '</div>';
								} else {
									unlink("../gambar/slide/$row1[gambar]");
									unlink("../gambar/thumb_slide/$row1[gambar]");
									Uploadslide($unik,$tfoto);
									$query = $db->prepare("UPDATE slide SET nama_slide=?, judul_slide=?, warna=?, deskripsi=?, link_slide=?, gambar=? WHERE id_slide=?");
									$query->bind_param("ssssssi", $judul,$judul_slide,$warna,$deskripsi,$url,$unik,$id_slide);
									$query->execute();
									
									echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
									echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
									echo '<strong>SUKSES!</strong> Data Berhasil Diubah';
									echo '</div>';
									echo "<meta http-equiv='refresh' content='1; url=?module=slide&act=ubahslide&id=$_GET[id]&token=$_GET[token]'>";
								}
	
							}
							
						}
					
					?>
						<div class="form-group">
							<label class="control-label col-sm-4">Nama Slide</label>
							<div class="col-sm-4">
								<input type="text" value="<?php echo $row1['nama_slide']; ?>" class="form-control" name="judul"  maxlength="50" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Judul Slide</label>
							<div class="col-sm-4">
								<input type="text" value="<?php echo $row1['judul_slide']; ?>" class="form-control" name="judul_slide"  maxlength="50" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Warna Font</label>
							<div class="col-sm-4">
								
								<input type="color" id="favcolor" name="warna" value="<?php echo $row1['warna']; ?>"><br><br>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Keterangan</label>
							<div class="col-sm-8">
								<textarea class="form-control" id="tinymce_basic" name="deskripsi"><?php echo $row1['deskripsi']; ?></textarea>
							</div>

						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">URL Link</label>
							<div class="col-sm-5">
								<input type="text" value="<?php echo $row1['link_slide']; ?>" class="form-control" name="url" maxlength="50" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Gambar </label>
							<div class="col-sm-4">
								<img src="../gambar/thumb_slide/<?php echo $row1['gambar']; ?>" class="img-thumbnail" width="40%" height="40%" />
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
