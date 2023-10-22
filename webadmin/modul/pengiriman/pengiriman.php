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
				<span style="font-size : 30px;">Pengiriman</span> beranda / pengiriman
				</div>
				<div class="col-sm-4">
					<p class="pull-right">
					<button type="button" class="btn btn-info" data-toggle="tooltip" title="Tambah" onclick="window.location.href='?module=pengiriman&act=tambahpengiriman';"><i class="glyphicon glyphicon-plus"></i></button>
					<button type="submit" class="btn btn-success"  name="aktif"  data-toggle="tooltip"  title="Aktfkan"><i class="glyphicon glyphicon-ok"></i></button>
					<button type="submit" class="btn btn-warning"  name="nonaktif"  data-toggle="tooltip"  title="Nonaktifkan"><i class="glyphicon glyphicon-remove"></i></button>
					<button type="submit" class="btn btn-danger"  name="hapus"  data-toggle="tooltip" onClick="return confirm('Data yang sudah dihapus tidak bisa dikembalikan lagi. Apakah anda yakin ?')" title="Hapus"><i class="glyphicon glyphicon-trash"></i></button>
					<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=pengiriman';"><i class="glyphicon glyphicon-refresh"></i></button>
					</p>
				</div>
			</div>
			<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><i class="glyphicon glyphicon-list"></i>Pengiriman</h4>
					
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
									$query1 = $db->prepare("SELECT gambar FROM pengiriman WHERE id_pengiriman=?");
									$query2 = $db->prepare("DELETE FROM pengiriman WHERE id_pengiriman=?");
									$query1->bind_param("i", $id_pengiriman);
									$query2->bind_param("i", $id_pengiriman);
									$id_pengiriman = $id[$i];
									$query1->execute();
									$result = $query1->get_result();
									$row    = $result->fetch_assoc();
									unlink("../gambar/pengiriman/$row[gambar]");
									$query2->execute();
									
								}
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> '.$jml.' Data Berhasil Dihapus';
								echo '</div>';
								
							}
						} else if ( isset($_POST['aktif']) ){
							$id  = $_POST['id'];
							$jml = count($id);
							
							if ( $jml <= 0 ){
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATAN!</strong> Silahkan Tandai Terlebih Dahulu Data Yang Akan Anda Aktifkan';
								echo '</div>';
							} else {
								
								for ( $i = 0; $i <= $jml; $i++ ){
									
									$query = $db->prepare("UPDATE pengiriman SET aktif=? WHERE id_pengiriman=?");
									$query->bind_param("si", $aktif,$id_pengiriman);
									$id_pengiriman = $id[$i];
									$aktif          = "Y";
									$query->execute();
									
								}
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> '.$jml.' Data Berhasil Diaktifkan';
								echo '</div>';
								
							}
							
						} else if ( isset($_POST['nonaktif']) ){
							$id  = $_POST['id'];
							$jml = count($id);
							
							if ( $jml <= 0 ){
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATAN!</strong> Silahkan Tandai Terlebih Dahulu Data Yang Akan Anda Nonaktifkan';
								echo '</div>';
							} else {
								
								for ( $i = 0; $i <= $jml; $i++ ){
									
									$query = $db->prepare("UPDATE pengiriman SET aktif=? WHERE id_pengiriman=?");
									$query->bind_param("si", $aktif,$id_pengiriman);
									$id_pengiriman = $id[$i];
									$aktif          = "T";
									$query->execute();
									
								}
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> '.$jml.' Data Berhasil Nonaktifkan';
								echo '</div>';
								
							}
							
						}
					?>
					<div class="table-responsive">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr class="bg-warning">
									<th><label><input type="checkbox" name="semua" id="semua" /></label> NO</th>
									<th>Metode Pengiriman</th>
									<th>Gambar</th>
									<th>Urutan</th>
									<th>Aktif</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$no     = 1;
									$query5 = $db->query("SELECT id_pengiriman,metode_pengiriman,gambar,urutan,aktif FROM pengiriman");
									while( $row    = $query5->fetch_assoc()){
								?>
								<tr>
									<td><label><input type="checkbox" name="id[]" value="<?php echo $row['id_pengiriman']; ?>" /> <?php echo $no; ?></label></td>
									<td><?php echo $row['metode_pengiriman']; ?></td>
									<td><img src="../gambar/pengiriman/<?php echo $row['gambar']; ?>"/></td>
									<td><?php echo $row['urutan'];?></td>
									<td><?php echo ( $row['aktif'] == "Y" ) ? "Aktif" : "Tidak Aktif"; ?></td>
									<td><a href="?module=pengiriman&act=ubahpengiriman&id=<?php echo $row['id_pengiriman']; ?>&token=<?php echo md5(md5($row['id_pengiriman']).md5('H3ndri@27')); ?>" class="btn btn-primary" data-toggle="tooltip"  title="Ubah" role="button"><i class="fa fa-pencil"></i></a></td>
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
				case "tambahpengiriman" :
			?>
			
			<form method="POST" action="" class="form-horizontal" enctype="multipart/form-data">
			<div class="row">
				<div class="col-sm-10">
				<span style="font-size : 30px;">Pengiriman</span> beranda / tambah pengiriman
				</div>
				<div class="col-sm-2">
					<p class="pull-right">
						<button class="btn btn-info" name="tambah" type="submit" data-toggle="tooltip" title="Simpan"><i class="fa fa-save"></i></button>
						<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=pengiriman&act=tambahpengiriman';"><i class="fa fa-refresh"></i></button>
						<button type="button" class="btn btn-danger" data-toggle="tooltip" title="Kembali" onclick="window.location.href='?module=pengiriman';"><i class="fa fa-share"></i></button>
					</p>
					
				</div>
			</div>
			
			<div class="row">
			<div class="panel-group">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><i class="glyphicon glyphicon-pencil"></i>   Tambah Pengiriman</h4>
					
				</div>
				<div class="panel-body">	 
					<?php
						
						
						if ( isset($_POST['tambah']) ){
							
							$metode  = $_POST['metode'];
							$urutan  = $_POST['urutan'];
							$aktif   = $_POST['aktif'];
							$foto    = $_FILES['foto']['name'];
							$tfoto   = $_FILES['foto']['type'];
							$lfoto   = $_FILES['foto']['tmp_name'];
							$acak    = rand(1,99);
							$unik    = $acak.$foto;
							$folder  = "../gambar/pengiriman/";
							
							if ( !preg_match("/^[0-9]*$/",$urutan) ) {
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATAN!</strong> Urutan Harus Angka';
								echo '</div>';
							} else if ( $tfoto != 'image/jpeg' AND $tfoto != 'image/jpg' AND $tfoto != 'image/png'  ){
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATAN!</strong> Gambar Harus Berekstensi Jpeg/png';
								echo '</div>';
							} else {
								move_uploaded_file($lfoto, $folder.$unik);
								$query = $db->prepare("INSERT INTO pengiriman (metode_pengiriman,urutan,aktif,gambar) VALUES (?,?,?,?)");
								$query->bind_param("siss", $metode,$urutan,$aktif,$unik);
								$query->execute();
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> Data Berhasil Disimpan';
								echo '</div>';
								echo "<meta http-equiv='refresh' content='1; url=?module=pengiriman&act=tambahpengiriman'>";
								
							}
							
							
							
																			
						}	
					
					?>
						<div class="form-group">
							<label class="control-label col-sm-4">Metode Pengiriman</label>
							<div class="col-sm-5">
								<input type="text"  class="form-control" value="<?php echo isset ($metode) ? $metode : ""; ?>" name="metode" placeholder="Metode Pengiriman" maxlength="100" required autofocus />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Urutan</label>
							<div class="col-sm-1">
								<input type="text"  class="form-control" value="<?php echo isset ($urutan) ? $urutan : ""; ?>" name="urutan" placeholder="Urutan" maxlength="5" required />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Aktif</label>
							<div class="col-sm-6">
								<div class="radio">
									<label><input type="radio" name="aktif" value="Y" checked /><b>Ya</b>, Maka Subkategori Aktif</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="aktif" value="T" /><b>Tidak</b>, Maka Subkategori Tidak Aktif</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Gambar</label>
							<div class="col-sm-4">
								<input type="file" name="foto" class="form-control" required />
								<p class="help-block"><i>Masukan Gambar Kecil dengan tinggi : 50 dan l00 pixel</i></p>
							</div>
						</div>
						
				</div>
			</div>
			</div>
			</form>
			
			
			<?php
				break;
				case "ubahpengiriman" :
				$token  = $_GET['token'];
				$cek    = md5(md5($_GET['id']).md5('H3ndri@27'));
				if ( $cek == $token ){
			?>
			<form method="POST" action="" class="form-horizontal" enctype="multipart/form-data">
			<div class="row">
				<div class="col-sm-10">
				<span style="font-size : 30px;">Pengiriman</span> beranda / ubah pengiriman
				</div>
				<div class="col-sm-2">
					<p class="pull-right">
						<button class="btn btn-info" name="ubah" type="submit" data-toggle="tooltip" title="Simpan"><i class="fa fa-save"></i></button>
						<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=pengiriman&act=ubahpengiriman&id=<?php echo $_GET['id']; ?>&token=<?php echo $_GET['token']; ?>';"><i class="fa fa-refresh"></i></button>
						<button type="button" class="btn btn-danger" data-toggle="tooltip" title="Kembali" onclick="window.location.href='?module=pengiriman';"><i class="fa fa-share"></i></button>
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
						
						$query1 = $db->prepare("SELECT metode_pengiriman,urutan,gambar FROM pengiriman WHERE id_pengiriman=?");
						$query1->bind_param("i", $id_pengiriman);
						$id_pengiriman = $_GET['id'];
						$query1->execute();
						$result = $query1->get_result();
						$row    = $result->fetch_assoc();
						
						if ( isset($_POST['ubah']) ){
							$metode  = $_POST['metode'];
							$urutan  = $_POST['urutan'];
							$foto    = $_FILES['foto']['name'];
							$tfoto   = $_FILES['foto']['type'];
							$lfoto   = $_FILES['foto']['tmp_name'];
							$acak    = rand(1,99);
							$unik    = $acak.$foto;
							$folder  = "../gambar/pengiriman/";
							
							$id_pengiriman = $_GET['id'];
							
							if ( !preg_match("/^[0-9]*$/",$urutan) ) {
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATAN!</strong> Urutan Harus Angka';
								echo '</div>';
							} else {
								
								if ( empty($foto) ){
									$query = $db->prepare("UPDATE pengiriman SET metode_pengiriman=?urutan=? WHERE id_pengiriman=?");
									$query->bind_param("sii", $metode,$urutan,$id_pengiriman);
									$query->execute();
								} else {
									if ( $tfoto != 'image/jpeg' AND $tfoto != 'image/jpg' AND $tfoto != 'image/png'  ){
										echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
										echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
										echo '<strong>PERINGATAN!</strong> Gambar Harus Berekstensi Jpeg/png';
										echo '</div>';
									} else {
										unlink("../gambar/pengiriman/$row[gambar]");
										move_uploaded_file($lfoto, $folder.$unik);
										$query = $db->prepare("UPDATE pengiriman SET metode_pengiriman=?,urutan=?,gambar=? WHERE id_pengiriman=?");
										$query->bind_param("sisi", $metode,$urutan,$unik,$id_pengiriman);
										$query->execute();
										
									}
								}
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> Data Berhasil Disimpan';
								echo '</div>';
								echo "<meta http-equiv='refresh' content='1; url=?module=pengiriman&act=ubahpengiriman&id=$_GET[id]&token=$_GET[token]'>";
							
							}
						}
					
					?>
						<div class="form-group">
							<label class="control-label col-sm-4">Metode Pengiriman</label>
							<div class="col-sm-5">
								<input type="text"  class="form-control" value="<?php echo $row['metode_pengiriman']; ?>" name="metode" maxlength="100" required />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Urutan</label>
							<div class="col-sm-1">
								<input type="text"  class="form-control" value="<?php echo $row['urutan']; ?>" name="urutan" maxlength="5" required />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Gambar Saat Ini</label>
							<div class="col-sm-4">
								<img src="../gambar/pengiriman/<?php echo $row['gambar']; ?>" class="img-responsive"/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Ubah Gambar</label>
							<div class="col-sm-4">
								<input type="file" name="foto" class="form-control" />
								<p class="help-block"><i>Masukan Gambar Kecil dengan tinggi : 50 dan l00 pixel</i></p>
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
