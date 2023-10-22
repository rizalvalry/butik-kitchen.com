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
				<span style="font-size : 30px;">Footer</span> beranda / Footer
				</div>
				<div class="col-sm-4">
					<p class="pull-right">
					<button type="submit" class="btn btn-success"  name="aktif"  data-toggle="tooltip" title="Aktifkan"><i class="glyphicon glyphicon-ok"></i></button>
					<button type="submit" class="btn btn-warning"  name="nonaktif"  data-toggle="tooltip" title="Nonaktifkan"><i class="glyphicon glyphicon-remove"></i></button>
					<button type="submit" class="btn btn-danger"  name="hapus"  data-toggle="tooltip" onClick="return confirm('Data yang sudah dihapus tidak bisa dikembalikan lagi. Apakah anda yakin ?')" title="Hapus"><i class="glyphicon glyphicon-trash"></i></button>
					<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=testimoni';"><i class="glyphicon glyphicon-refresh"></i></button>
					</p>
				</div>
			</div>
			<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><i class="glyphicon glyphicon-list"></i> Footer</h4>
					
				</div>
				<div class="panel-body">	
					<?php
						if ( isset($_POST['hapus']) ){
							$id  = $_POST['id'];
							$jml = count($id);
							
							if ( $jml <= 0 ){
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATAN!</strong> Silahkan Tandai Terlebih Dahulu Data Yang Akan Anda Hapus';
								echo '</div>';
							} else {
								
								for ( $i = 0; $i <= $jml; $i++ ){
									$query2       = $db->prepare("DELETE FROM testimoni WHERE id_testimoni=?");
									$query2->bind_param("i", $id_testimoni);
									$id_testimoni = $id[$i];
									$query2->execute();
									
								}
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> '.$jml.' Data Berhasil Dihapus';
								echo '</div>';
								
							}
						
						} else if( isset($_POST['aktif']) ){
							$id  = $_POST['id'];
							$jml = count($id);
							
							if ( $jml <= 0 ){
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATAN!</strong> Silahkan Tandai Terlebih Dahulu Data Yang Akan Anda Aktifkan';
								echo '</div>';
							} else {
								
								for ( $i = 0; $i <= $jml; $i++ ){
									$query2       = $db->prepare("UPDATE testimoni SET aktif = ? WHERE id_testimoni = ?");
									$query2->bind_param("si", $aktif, $id_testimoni);
									$id_testimoni = $id[$i];
									$aktif        = "Y";
									$query2->execute();
									
								}
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> '.$jml.' Data Berhasil Diaktifkan';
								echo '</div>';
								
							}
						} else if( isset($_POST['nonaktif']) ){
							$id  = $_POST['id'];
							$jml = count($id);
							
							if ( $jml <= 0 ){
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATAN!</strong> Silahkan Tandai Terlebih Dahulu Data Yang Akan Anda Nonaktifkan';
								echo '</div>';
							} else {
								
								for ( $i = 0; $i <= $jml; $i++ ){
									$query2       = $db->prepare("UPDATE testimoni SET aktif = ? WHERE id_testimoni = ?");
									$query2->bind_param("si", $aktif, $id_testimoni);
									$id_testimoni = $id[$i];
									$aktif        = "T";
									$query2->execute();
									
								}
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> '.$jml.' Data Berhasil Dinonaktifan';
								echo '</div>';
								
							}
						}
					?>
					<div class="table-responsive">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr class="bg-warning">
									<th><label><input type="checkbox" name="semua" id="semua" /></label> NO</th>
									<th>Nama</th>
									<th>Footer</th>
									<th>Aktif</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$no            = 1;
									$query5        = $db->query("SELECT id_testimoni, nama_lengkap, aktif, testimoni FROM testimoni ORDER BY id_testimoni DESC");
									while( $row    = $query5->fetch_assoc()){
								?>
								<tr>
									<td><label><input type="checkbox" name="id[]" value="<?php echo $row['id_testimoni']; ?>" /> <?php echo $no; ?></label></td>
									<td><?php echo $row['nama_lengkap']; ?></td>
									<td><?php echo $row['testimoni']; ?></td>
									<td><?php echo ( $row['aktif'] == "Y" ) ? "Aktif" : "Tidak Aktif"; ?></td>
									<td><a href="?module=testimoni&act=ubahtestimoni&id=<?php echo $row['id_testimoni']; ?>&token=<?php echo md5(md5($row['id_testimoni']).md5('H3ndri@27')); ?>" class="btn btn-primary" data-toggle="tooltip"  title="Ubah Footer" role="button"><i class="fa fa-pencil"></i></a></td>
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
				case "ubahtestimoni" :
				$token  = $_GET['token'];
				$cek    = md5(md5($_GET['id']).md5('H3ndri@27'));
				if ( $cek == $token ){
				 $db->query("UPDATE hubungi SET dibuka = 'Y' WHERE id_hubungi = '$_GET[id]'");
			?>
			<form method="POST" action="" class="form-horizontal" enctype="multipart/form-data">
			<div class="row">
				<div class="col-sm-10">
				<span style="font-size : 30px;">Ubah Footer</span> beranda / ubah testimoni
				</div>
				<div class="col-sm-2">
					<p class="pull-right">
						<button class="btn btn-info" name="ubah" type="submit" data-toggle="tooltip" title="Simpan"><i class="fa fa-save"></i></button>
						<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=testimoni&act=ubahtestimoni&id=<?php echo $_GET['id']; ?>&token=<?php echo $_GET['token']; ?>';"><i class="fa fa-refresh"></i></button>
						<button type="button" class="btn btn-danger" data-toggle="tooltip" title="Kembali" onclick="window.location.href='?module=testimoni';"><i class="fa fa-share"></i></button>
					</p>
					
				</div>
			</div>
			<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><i class="glyphicon glyphicon-edit"></i>   Ubah Pengiriman</h4>
					
				</div>
				<div class="panel-body">	 
					<?php
						
						$query1     = $db->prepare("SELECT nama_lengkap, alamat, testimoni FROM testimoni WHERE id_testimoni=?");
						$query1->bind_param("i", $id_testimoni);
						$id_testimoni = $_GET['id'];
						$query1->execute();
						$result     = $query1->get_result();
						$row        = $result->fetch_assoc();
						
						if ( isset($_POST['ubah']) ){
							$query9 = $db->query("SELECT email_pengelola,email_protokol FROM profil");
							$row9   = $query9->fetch_assoc();
							$nama   = $_POST['nama'];
							$alamat = $_POST['alamat'];
							$testi  = $_POST['testi'];
							if ( empty($nama) ){
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATAN!</strong> Balas Pesan Tidak Boleh Kosong';
								echo '</div>';
							} else if ( empty($alamat) ){
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATAN!</strong> Alamat Tidak Boleh Kosong';
								echo '</div>';
							} 
							// else if ( empty($testi) ){
							// 	echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
							// 	echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
							// 	echo '<strong>PERINGATAN!</strong> Footer Tidak Boleh Kosong';
							// 	echo '</div>';
							// } 
							else {
								$db->query("UPDATE testimoni SET nama_lengkap = '$nama', alamat = '$alamat', testimoni = '$testi' WHERE id_testimoni = '$id_testimoni'");
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> Data Berhasil Diubah';
								echo '</div>';
								echo "<meta http-equiv='refresh' content='1; url=?module=testimoni'>";
							}
						}
					
					?>
						<div class="form-group">
							<label class="control-label col-sm-4">Nama Lengkap</label>
							<div class="col-sm-5">
								<input type="text"  class="form-control" value="<?php echo $row['nama_lengkap']; ?>" name="nama" maxlength="100" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Alamat</label>
							<div class="col-sm-8">
								<textarea rows="5" name="alamat" class="form-control"><?php echo $row['alamat']; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Footer</label>
							<div class="col-sm-8">
							<textarea name="testi"rows="10" id="tinymce_basic"><?php echo $row['testimoni']; ?></textarea>
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
