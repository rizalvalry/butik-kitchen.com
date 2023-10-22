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
				<span style="font-size : 30px;">Komentar</span> beranda / komentar
				</div>
				<div class="col-sm-4">
					<p class="pull-right">
					<button type="submit" class="btn btn-success" name="aktif"  data-toggle="tooltip"  title="Aktifkan"><i class="glyphicon glyphicon-ok"></i></button>
					<button type="submit" class="btn btn-warning" name="nonaktif"  data-toggle="tooltip"  title="Nonaktifkan"><i class="glyphicon glyphicon-remove"></i></button>
					<button type="submit" class="btn btn-danger"  name="hapus"  data-toggle="tooltip" onClick="return confirm('Data yang sudah dihapus tidak bisa dikembalikan lagi. Apakah anda yakin ?')" title="Hapus Kustomer"><i class="glyphicon glyphicon-trash"></i></button>
					<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=komentar';"><i class="glyphicon glyphicon-refresh"></i></button>
					</p>
				</div>
			</div>
			<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><i class="glyphicon glyphicon-list"></i>   Data Komentar</h4>
					
				</div>
				
				<div class="panel-body">	
					<?php
						
						if ( isset($_POST['aktif']) ){
							$id  = $_POST['id'];
							$jml = count($id);
							
							if ( $jml <= 0 ){
								
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>Peringatan!</strong> Silahkan Tandai Terlebih Dahulu Komentar Yang Akan Anda Aktifkan';
								echo '</div>';
								
							} else {
								
								for ( $i = 0; $i <= $jml; $i++ ){
									$query       = $db->prepare("UPDATE komentar SET aktif=? WHERE id_komentar=?");
									$query->bind_param("si", $aktif,$id_komentar);
									$id_komentar = $id[$i];
									$aktif       = "Y";
									$query->execute();
								}
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> '.$jml.' Komentar Berhasil Diaktikan';
								echo '</div>';
								
							}
							
						} else if ( isset($_POST['nonaktif']) ){
							$id  = $_POST['id'];
							$jml = count($id);
							
							if ( $jml <= 0 ){
								
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>Peringatan!</strong> Silahkan Tandai Terlebih Dahulu Komentar Yang Akan Anda Nonaktifkan';
								echo '</div>';
								
							} else {
								
								for ( $i = 0; $i <= $jml; $i++ ){
									$query = $db->prepare("UPDATE komentar SET aktif=? WHERE id_komentar=?");
									$query->bind_param("si", $aktif,$id_komentar);
									$id_komentar = $id[$i];
									$aktif       = "T";
									$query->execute();
								}
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> '.$jml.' Komentar Berhasil Dinonaktifkan';
								echo '</div>';
								
							}
							
						} else if ( isset($_POST['hapus']) ){
							$id  = $_POST['id'];
							$jml = count($id);
							
							if ( $jml <= 0 ){
								
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>Peringatan!</strong> Silahkan Tandai Terlebih Dahulu Komentar Yang Akan Anda Hapus';
								echo '</div>';
								
							} else {
								
								for ( $i = 0; $i <= $jml; $i++ ){
									$query = $db->prepare("DELETE FROM komentar WHERE id_komentar=?");
									$query->bind_param("i", $id_komentar);
									$id_komentar = $id[$i];
									$query->execute();
								}
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> '.$jml.' Komentar Berhasil Dihapus';
								echo '</div>';
								
							}
							
						}
						
					?>
					<div class="table-responsive">	
						<table id="komentar" class="table table-bordered table-striped">
							<thead>
								<tr class="bg-warning">
									<th width="7%"><label><input type="checkbox" name="semua" id="semua" /></label> NO</th>
									<th>Judul Artikel</th>
									<th>Nama</th>
									<th>Komentar</th>
									<th>Tanggal</th>
									<th>Aktif</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
					</div>
			</div>
			</div>
			</form>
			
			<?php
				break;
				case "ubahkomentar" :
				$token  = $_GET['token'];
				$cek    = md5(md5($_GET['id']).md5('H3ndri@27'));
				if ( $cek == $token ){
			?>
			<form method="POST" action="" class="form-horizontal" enctype="multipart/form-data">
			<div class="row">
				<div class="col-sm-10">
				<span style="font-size : 30px;">Komentar</span> beranda / ubah komentar
				</div>
				<div class="col-sm-2">
					<p class="pull-right">
						<button class="btn btn-info" name="ubah" type="submit" data-toggle="tooltip" title="Simpan"><i class="fa fa-save"></i></button>
						<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=komentar&act=ubahkomentar&id=<?php echo $_GET['id']; ?>&token=<?php echo $_GET['token']; ?>';"><i class="fa fa-refresh"></i></button>
						<button type="button" class="btn btn-danger" data-toggle="tooltip" title="Kembali" onclick="window.location.href='?module=komentar';"><i class="fa fa-share"></i></button>
					</p>
					
				</div>
			</div>
			<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><i class="glyphicon glyphicon-edit"></i>   Ubah Komentar</h4>
					
				</div>
				<div class="panel-body">	 
					<?php
						
						$query1      = $db->prepare("SELECT nama_lengkap,email,komentar FROM komentar WHERE id_komentar=?");
						$query1->bind_param("i", $id_komentar);
						$id_komentar = $_GET['id'];
						$query1->execute();
						$result      = $query1->get_result();
						$row1        = $result->fetch_assoc();
						
						if ( isset($_POST['ubah']) ){
							
							$nama        = $_POST['nama'];
							$email       = $_POST['email'];
							$komentar      = $_POST['komentar'];
							$id_komentar = $_GET['id'];
							
							if ( !preg_match("/^[a-zA-Z .,]*$/",$nama) ){
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATRANN!</strong> Nama Tidak Boleh Mengandung Angka dan Karakter';
								echo '</div>';
							} else if ( empty($komentar) ){
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATRANN!</strong> Komentar Tidak Boleh Kosong';
								echo '</div>';
							} else {
								
								$query = $db->prepare("UPDATE komentar SET nama_lengkap=?,email=?,komentar=? WHERE id_komentar=?");
								$query->bind_param("sssi", $nama,$email,$komentar,$id_komentar);
								$query->execute();
								
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> Data Berhasil Diubah';
								echo '</div>';
								echo "<meta http-equiv='refresh' content='1; url=?module=komentar&act=ubahkomentar&id=$_GET[id]&token=$_GET[token]'>";
							}
							
						}
					
					?>
						<div class="form-group">
							<label class="control-label col-sm-4">Nama Lengkap</label>
							<div class="col-sm-4">
								<input type="text" value="<?php echo $row1['nama_lengkap']; ?>" class="form-control" name="nama" maxlength="50" required />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">E-Mail</label>
							<div class="col-sm-5">
								<input type="email" value="<?php echo $row1['email']; ?>" class="form-control" name="email" maxlength="50" required />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Alamat</label>
							<div class="col-sm-8">
								<textarea name="komentar" class="form-control" rows="5" required><?php echo $row1['komentar']; ?></textarea>
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
