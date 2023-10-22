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
				<span style="font-size : 30px;">File</span> beranda / file
				</div>
				<div class="col-sm-4">
					<p class="pull-right">
					<button type="button" class="btn btn-info" data-toggle="tooltip" title="Tambah" onclick="window.location.href='?module=file&act=tambahfile';"><i class="glyphicon glyphicon-plus"></i></button>
					<button type="submit" class="btn btn-success" name="aktif"  data-toggle="tooltip"  title="Aktifkan"><i class="glyphicon glyphicon-ok"></i></button>
					<button type="submit" class="btn btn-warning" name="nonaktif"  data-toggle="tooltip"  title="Nonaktifkan"><i class="glyphicon glyphicon-remove"></i></button>
					<button type="submit" class="btn btn-danger"  name="hapus"  data-toggle="tooltip" onClick="return confirm('Data yang sudah dihapus tidak bisa dikembalikan lagi. Apakah anda yakin ?')" title="Hapus"><i class="glyphicon glyphicon-trash"></i></button>
					<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=file';"><i class="glyphicon glyphicon-refresh"></i></button>
					</p>
				</div>
			</div>
			<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><i class="glyphicon glyphicon-list"></i>   Data File</h4>
					
				</div>
				<div class="panel-body">	
					<?php
						include "../config/tgl_indo.php";						
						if ( isset($_POST['hapus']) ){
							
							$id  = $_POST['id'];
							$jml = count($id);
							
							if( $jml > 0 ){
								for ($i = 0; $i <= $jml; $i++){
									$query1   = $db->prepare("SELECT file FROM file WHERE id_file=?");
									$query2   = $db->prepare("DELETE FROM file WHERE id_file=?");
									$query2->bind_param("i", $id_file);
									$query1->bind_param("i", $id_file);
									$id_file  = $id[$i];
									
									$query1->execute();
									$result   = $query1->get_result();
									$row      = $result->fetch_assoc();
									unlink("../file/$row[file]");
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
									$query = $db->prepare("UPDATE file SET aktif=? WHERE id_file=?");
									$query->bind_param("si", $aktif,$id_file);
									$id_file = $id[$i];
									$aktif    = "T";
									$query->execute();
									
								}
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> '.$jml.' File Berhasil Dinonaktifkan';
								echo '</div>';
							} else {
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>Peringatan!</strong> Silahkan Tandai Terlebih Dahulu File Yang Akan Anda Nonaktifkan';
								echo '</div>';
							}
							
						} else if ( isset($_POST['aktif']) ){
							
							$id  = $_POST['id'];
							$jml = count($id);
							
							if( $jml > 0 ){
								for ($i = 0; $i <= $jml; $i++){
									$query = $db->prepare("UPDATE file SET aktif=? WHERE id_file=?");
									$query->bind_param("si", $aktif,$id_file);
									$id_file = $id[$i];
									$aktif    = "Y";
									$query->execute();
									
								}
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> '.$jml.' File Berhasil Diaktifkan';
								echo '</div>';
							} else {
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>Peringatan!</strong> Silahkan Tandai Terlebih Dahulu File Yang Akan Anda Aktifkan';
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
									<th>Tanggal</th>
									<th>Jam</th>
									<th>Aktif</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$no     = 1;
									$query5 = $db->query("SELECT * FROM file ORDER BY id_file DESC");
									while( $row    = $query5->fetch_assoc()){
										$tanggal   = tgl_indo($row['tanggal']);
								?>
								<tr>
									<td><label><input type="checkbox" name="id[]" value="<?php echo $row['id_file']; ?>" /> <?php echo $no; ?></label></td>
									<td><?php echo $row['judul_file']; ?></td>
									<td><?php echo $tanggal; ?></td>
									<td><?php echo $row['jam']; ?> WIB</td>
									<td><?php echo ( $row['aktif'] == "Y" ) ? "Aktif" : "Tidak Aktif"; ?></td>
									<td>
										<a href="?module=file&act=ubahfile&id=<?php echo $row['id_file']; ?>&token=<?php echo md5(md5($row['id_file']).md5('H3ndri@27')); ?>" class="btn btn-primary" data-toggle="tooltip"  title="Ubah" role="button"><i class="fa fa-pencil"></i></a>
										<a href="../file/<?php echo $row['file']; ?>" class="btn btn-success" data-toggle="tooltip"  title="Download" role="button"><i class="fa fa-download"></i></a>
										</td>
									
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
				case "tambahfile" :
			?>
			
			<form method="POST" action="" class="form-horizontal" enctype="multipart/form-data">
			<div class="row">
				<div class="col-sm-10">
				<span style="font-size : 30px;">File </span> beranda / tambah file
				</div>
				<div class="col-sm-2">
					<p class="pull-right">
						<button class="btn btn-info" name="tambah" type="submit" data-toggle="tooltip" title="Simpan"><i class="fa fa-save"></i></button>
						<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=file&act=tambahfile';"><i class="fa fa-refresh"></i></button>
						<button type="button" class="btn btn-danger" data-toggle="tooltip" title="Kembali" onclick="window.location.href='?module=file';"><i class="fa fa-share"></i></button>
					</p>
					
				</div>
			</div>
			
			<div class="row">
			<div class="panel-group">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><i class="glyphicon glyphicon-pencil"></i>   Tambah File</h4>
					
				</div>
				<div class="panel-body">	 
					<?php
						
						
						if ( isset($_POST['tambah']) ){
							
							date_default_timezone_set('Asia/Jakarta');
							
							$judul  = $_POST['judul'];
							$aktif  = $_POST['aktif'];
							$tgl    = date("Y-m-d");
							$jam    = date("h:i:sa");
							$file   = $_FILES['file']['name'];
							$tfile  = $_FILES['file']['tmp_name'];
							$acak   = rand(1,99);
							$unik   = $acak.$file;
							$folder = "../file/";
							
							move_uploaded_file($tfile, $folder.$unik);
							
							
							$query = $db->prepare("INSERT INTO file (judul_file,aktif,tanggal,jam,file) VALUES (?,?,?,?,?)");
							$query->bind_param("sssss", $judul,$aktif,$tgl,$jam,$unik);
							$query->execute();
								
							echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
							echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
							echo '<strong>SUKSES!</strong> Data Berhasil Disimpan';
							echo '</div>';
							echo "<meta http-equiv='refresh' content='1; url=?module=file&act=tambahfile'>";
																			
						}	
					
					?>
						
						<div class="form-group">
							<label class="control-label col-sm-4">Judul File</label>
							<div class="col-sm-4">
								<input type="text" value="<?php echo isset( $judul ) ? $judul : ""; ?>" class="form-control" name="judul" placeholder="Judul Slide" maxlength="50" required />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Aktif</label>
							<div class="col-sm-6">
								<div class="radio">
									<label><input type="radio" name="aktif" value="Y" checked /> <b>Ya</b>, Maka File Aktif</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="aktif" value="T" /> <b>Tidak</b>, Maka File Tidak Aktif</label>
								</div>
							</div>
						</div>	
						<div class="form-group">
							<label class="control-label col-sm-4">File</label>
							<div class="col-sm-4">
								<input type="file"  class="form-control" name="file"  required />
							</div>
						</div>
				</div>
			</div>
			</div>
			</form>
			
			
			<?php
				break;
				case "ubahfile" :
				$token  = $_GET['token'];
				$cek    = md5(md5($_GET['id']).md5('H3ndri@27'));
				if ( $cek == $token ){
			?>
			<form method="POST" action="" class="form-horizontal" enctype="multipart/form-data">
			<div class="row">
				<div class="col-sm-10">
				<span style="font-size : 30px;">File</span> beranda / ubah file
				</div>
				<div class="col-sm-2">
					<p class="pull-right">
						<button class="btn btn-info" name="ubah" type="submit" data-toggle="tooltip" title="Simpan"><i class="fa fa-save"></i></button>
						<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=file&act=ubahfile&id=<?php echo $_GET['id']; ?>&token=<?php echo $_GET['token']; ?>';"><i class="fa fa-refresh"></i></button>
						<button type="button" class="btn btn-danger" data-toggle="tooltip" title="Kembali" onclick="window.location.href='?module=file';"><i class="fa fa-share"></i></button>
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
						
						$query1 = $db->prepare("SELECT judul_file,file FROM file WHERE id_file=?");
						$query1->bind_param("i", $id_slide);
						$id_slide = $_GET['id'];
						$query1->execute();
						$result = $query1->get_result();
						$row1   = $result->fetch_assoc();
						
						if ( isset($_POST['ubah']) ){
							
							$judul   = $_POST['judul'];
							$file    = $_FILES['file']['name'];
							$tfile   = $_FILES['file']['tmp_name'];
							$acak    = rand(1,99);
							$unik    = $acak.$file;
							$id_file = $_GET['id'];
							$folder  = "../file/";
							
							if( empty($file) ){
								$query = $db->prepare("UPDATE file SET judul_file=? WHERE id_file=?");
								$query->bind_param("si", $judul,$id_file);
								$query->execute();
							} else {
								unlink("../file/$row1[file]");
								move_uploaded_file($tfile, $folder.$unik);
								$query = $db->prepare("UPDATE file SET judul_file=?,file=? WHERE id_file=?");
								$query->bind_param("ssi", $judul,$unik,$id_file);
								$query->execute();
								
							}
							echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
							echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
							echo '<strong>SUKSES!</strong> Data Berhasil Diubah';
							echo '</div>';
							echo "<meta http-equiv='refresh' content='1; url=?module=file&act=ubahfile&id=$_GET[id]&token=$_GET[token]'>";
						}
					
					?>
						<div class="form-group">
							<label class="control-label col-sm-4">Judul File</label>
							<div class="col-sm-4">
								<input type="text" value="<?php echo $row1['judul_file']; ?>" class="form-control" name="judul"  maxlength="50" required />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Ganti File</label>
							<div class="col-sm-4">
								<input type="file"  class="form-control" name="file"  />
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
