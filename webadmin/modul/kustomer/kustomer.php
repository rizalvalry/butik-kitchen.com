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
				<span style="font-size : 30px;">Kustomer</span> beranda / kustomer
				</div>
				<div class="col-sm-4">
					<p class="pull-right">
					<button type="submit" class="btn btn-success" name="aktif"  data-toggle="tooltip"  title="Aktifkan"><i class="glyphicon glyphicon-ok"></i></button>
					<button type="submit" class="btn btn-warning" name="nonaktif"  data-toggle="tooltip"  title="Nonaktifkan"><i class="glyphicon glyphicon-remove"></i></button>
					<button type="submit" class="btn btn-danger"  name="hapus"  data-toggle="tooltip" onClick="return confirm('Data yang sudah dihapus tidak bisa dikembalikan lagi. Apakah anda yakin ?')" title="Hapus Kustomer"><i class="glyphicon glyphicon-trash"></i></button>
					<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=kustomer';"><i class="glyphicon glyphicon-refresh"></i></button>
					</p>
				</div>
			</div>
			<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><i class="glyphicon glyphicon-list"></i>   Data Kustomer</h4>
					
				</div>
				
				<div class="panel-body">	
					<?php
						
						if ( isset($_POST['aktif']) ){
							$id  = $_POST['id'];
							$jml = count($id);
							
							if ( $jml <= 0 ){
								
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>Peringatan!</strong> Silahkan Tandai Terlebih Dahulu Kostumer Yang Akan Anda Aktifkan';
								echo '</div>';
								
							} else {
								
								for ( $i = 0; $i <= $jml; $i++ ){
									$query = $db->prepare("UPDATE kustomer SET aktif=? WHERE id_kustomer=?");
									$query->bind_param("si", $aktif,$id_kustomer);
									$id_kustomer = $id[$i];
									$aktif       = "Y";
									$query->execute();
								}
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> '.$jml.' kustomer Berhasil Diaktikan';
								echo '</div>';
								
							}
							
						} else if ( isset($_POST['nonaktif']) ){
							$id  = $_POST['id'];
							$jml = count($id);
							
							if ( $jml <= 0 ){
								
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>Peringatan!</strong> Silahkan Tandai Terlebih Dahulu kustomer Yang Akan Anda Nonaktifkan';
								echo '</div>';
								
							} else {
								
								for ( $i = 0; $i <= $jml; $i++ ){
									$query = $db->prepare("UPDATE kustomer SET aktif=? WHERE id_kustomer=?");
									$query->bind_param("si", $aktif,$id_kustomer);
									$id_kustomer = $id[$i];
									$aktif       = "T";
									$query->execute();
								}
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> '.$jml.' kustomer Berhasil Dinonaktifkan';
								echo '</div>';
								
							}
							
						} else if ( isset($_POST['hapus']) ){
							$id  = $_POST['id'];
							$jml = count($id);
							
							if ( $jml <= 0 ){
								
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>Peringatan!</strong> Silahkan Tandai Terlebih Dahulu kustomer Yang Akan Anda Hapus';
								echo '</div>';
								
							} else {
								
								for ( $i = 0; $i <= $jml; $i++ ){
									$query = $db->prepare("DELETE FROM kustomer WHERE id_kustomer=?");
									$query->bind_param("i", $id_kustomer);
									$id_kustomer = $id[$i];
									$query->execute();
								}
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> '.$jml.' kustomer Berhasil Dihapus';
								echo '</div>';
								
							}
							
						}
						
					?>
					<div class="table-responsive">	
						<table id="example" class="table table-bordered table-striped">
							<thead>
								<tr class="bg-warning">
									<th width="7%"><label><input type="checkbox" name="semua" id="semua" /></label> NO</th>
									<th>Nama Kustomer</th>
									<th>Kontak</th>
									<th>Tanggal Daftar</th>
									<th>Jam Daftar</th>
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
				case "ubahkustomer" :
				$token  = $_GET['token'];
				$cek    = md5(md5($_GET['id']).md5('H3ndri@27'));
				if ( $cek == $token ){
			?>
			<form method="POST" action="" class="form-horizontal" enctype="multipart/form-data">
			<div class="row">
				<div class="col-sm-10">
				<span style="font-size : 30px;">Kustomer</span> beranda / ubah kustomer
				</div>
				<div class="col-sm-2">
					<p class="pull-right">
						<button class="btn btn-info" name="ubah" type="submit" data-toggle="tooltip" title="Simpan"><i class="fa fa-save"></i></button>
						<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=kustomer&act=ubahkustomer&id=<?php echo $_GET['id']; ?>&token=<?php echo $_GET['token']; ?>';"><i class="fa fa-refresh"></i></button>
						<button type="button" class="btn btn-danger" data-toggle="tooltip" title="Kembali" onclick="window.location.href='?module=kustomer';"><i class="fa fa-share"></i></button>
					</p>
					
				</div>
			</div>
			<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><i class="glyphicon glyphicon-edit"></i>   Ubah Kustomer</h4>
					
				</div>
				<div class="panel-body">	 
					<?php
						
						$query1 = $db->prepare("SELECT nama_lengkap,email,alamat,telpon FROM kustomer WHERE id_kustomer=?");
						$query1->bind_param("i", $id_sub);
						$id_sub = $_GET['id'];
						$query1->execute();
						$result = $query1->get_result();
						$row1   = $result->fetch_assoc();
						
						if ( isset($_POST['ubah']) ){
							
							$nama        = $_POST['nama'];
							$email       = $_POST['email'];
							$alamat      = $_POST['alamat'];
							$tlp         = $_POST['tlp'];
							$id_kustomer = $_GET['id'];
							
							if ( !preg_match("/^[a-zA-Z .,]*$/",$nama) ){
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATRANN!</strong> Nama Tidak Boleh Mengandung Angka dan Karakter';
								echo '</div>';
							} else if ( !preg_match("/^[0-9+]*$/",$tlp) ){
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATRANN!</strong> Nomor Telpon Harus Angka';
								echo '</div>';
							} else {
								
								$query = $db->prepare("UPDATE kustomer SET nama_lengkap=?,email=?,alamat=?,telpon=? WHERE id_kustomer=?");
								$query->bind_param("ssssi", $nama,$email,$alamat,$tlp,$id_kustomer);
								$query->execute();
								
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> Data Berhasil Diubah';
								echo '</div>';
								echo "<meta http-equiv='refresh' content='1; url=?module=kustomer&act=ubahkustomer&id=$_GET[id]&token=$_GET[token]'>";
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
								<input type="text" value="<?php echo $row1['alamat']; ?>" class="form-control" name="alamat" maxlength="150" required />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Nomor Telpon</label>
							<div class="col-sm-2">
								<input type="text" value="<?php echo $row1['telpon']; ?>" class="form-control" name="tlp" maxlength="15" required />
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
