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
				<span style="font-size : 30px;">Halaman Statis</span> beranda / halaman statis
				</div>
				<div class="col-sm-4">
					<p class="pull-right">
						<button type="button" class="btn btn-info" data-toggle="tooltip" title="Tambah" onclick="window.location.href='?module=halaman&act=tambahhalaman';"><i class="glyphicon glyphicon-plus"></i></button>
						<button class="btn btn-success" name="aktif" type="submit" data-toggle="tooltip" title="Aktifkan"><i class="glyphicon glyphicon-ok"></i></button>
						<button class="btn btn-warning" name="nonaktif" type="submit" data-toggle="tooltip" title="Nonaktifkan"><i class="glyphicon glyphicon-remove"></i></button>
						<button type="submit" class="btn btn-danger"  name="hapus"  data-toggle="tooltip" onClick="return confirm('Data yang sudah dihapus tidak bisa dikembalikan lagi. Apakah anda yakin ?')" title="Hapus"><i class="glyphicon glyphicon-trash"></i></button>
						<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=halaman';"><i class="glyphicon glyphicon-refresh"></i></button>
					</p>
				</div>
			</div>
			<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><i class="glyphicon glyphicon-list"></i>   Data Halaman Statis</h4>
					
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
									
									$query = $db->prepare("DELETE FROM halaman_statis WHERE id_halaman=?");
									$query->bind_param("i", $id_halaman);
									$id_halaman = $id[$i];
									$query->execute();
									
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
									
									$query = $db->prepare("UPDATE halaman_statis SET aktif=? WHERE id_halaman=?");
									$query->bind_param("si", $aktif,$id_halaman);
									$id_halaman = $id[$i];
									$aktif       = "Y";
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
									
									$query = $db->prepare("UPDATE halaman_statis SET aktif=? WHERE id_halaman=?");
									$query->bind_param("si", $aktif,$id_halaman);
									$id_halaman = $id[$i];
									$aktif       = "T";
									$query->execute();
									
								}
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> '.$jml.' Data Berhasil Diaktifkan';
								echo '</div>';
								
							}
							
						} 
					?>
					<div class="table-responsive">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr class="bg-warning">
									<th><label><input type="checkbox" name="semua" id="semua" /></label> NO</th>
									<th>ID Halaman</th>
									<th>Judul Halaman</th>
									<th>Link Halaman</th>
									<th>Aktif</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$no     = 1;
									$query5 = $db->query("SELECT id_halaman,judul_halaman,link_halaman,aktif FROM halaman_statis ORDER BY judul_halaman ASC");
									while( $row    = $query5->fetch_assoc()){
								?>
								<tr>
									<td><label><input type="checkbox" name="id[]" value="<?php echo $row['id_halaman']; ?>" /> <?php echo $no; ?></label></td>
									<td><?php echo $row['id_halaman']; ?></td>
									<td><?php echo $row['judul_halaman']; ?></td>
									<td><?php echo $row['link_halaman']; ?></td>
									<td><?php echo ( $row['aktif'] == "Y" ) ? "Aktif" : "Tidak Aktif"; ?></td>
									<td><a href="?module=halaman&act=ubahhalaman&id=<?php echo $row['id_halaman']; ?>&token=<?php echo md5(md5($row['id_halaman']).md5('H3ndri@27')); ?>" class="btn btn-primary" data-toggle="tooltip"  title="Ubah" role="button"><i class="fa fa-pencil"></i></a></td>
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
				case "tambahhalaman" :
			?>
			
			<form method="POST" action="" class="form-horizontal" enctype="multipart/form-data">
			<div class="row">
				<div class="col-sm-10">
				<span style="font-size : 30px;">Halaman Statis</span> beranda / tambah halaman statis
				</div>
				<div class="col-sm-2">
					<p class="pull-right">
						<button class="btn btn-info" name="tambah" type="submit" data-toggle="tooltip" title="Simpan"><i class="fa fa-save"></i></button>
						<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=halaman&act=tambahhalaman';"><i class="fa fa-refresh"></i></button>
						<button type="button" class="btn btn-danger" data-toggle="tooltip" title="Kembali" onclick="window.location.href='?module=halaman';"><i class="fa fa-share"></i></button>
					</p>
					
				</div>
			</div>
			
			<div class="row">
			<div class="panel-group">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><i class="glyphicon glyphicon-pencil"></i>   Tambah Halaman Statis</h4>
					
				</div>
				<div class="panel-body">	 
					<?php
						
						
						if ( isset($_POST['tambah']) ){
							
							$judul    = $_POST['judul'];
							$url      = $_POST['url'];
							$aktif    = $_POST['aktif'];
							$isi      = $_POST['isi'];
							
							$query    = $db->prepare("INSERT INTO halaman_statis (judul_halaman,link_halaman,aktif,isi_halaman) VALUES (?,?,?,?)");
							$query->bind_param("ssss", $judul,$url,$aktif,$isi);
							$query->execute();
							
							echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
							echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
							echo '<strong>SUKSES!</strong> Data Berhasil Disimpan';
							echo '</div>';
							echo "<meta http-equiv='refresh' content='1; url=?module=halaman&act=tambahhalaman'>";
							
																			
						}	
					
					?>
						
						<div class="form-group">
							<label class="control-label col-sm-4">Judul Halaman</label>
							<div class="col-sm-4">
								<input type="text"  class="form-control" name="judul" placeholder="Judul Halaman" maxlength="50" required autofocus />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">URL Link</label>
							<div class="col-sm-4">
								<input type="text"  class="form-control" name="url" placeholder="URL Link" maxlength="50" required/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Aktif</label>
							<div class="col-sm-6">
								<div class="radio">
									<label><input type="radio" name="aktif" value="Y" checked /><b>Ya</b>, Maka Kategori Aktif</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="aktif" value="T" /><b>Tidak</b>, Maka Kategori Tidak Aktif</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Isi Halaman</label>
							<div class="col-sm-8">
								<textarea name="isi" id="tinymce_basic" class="form-control" rows="10"></textarea>
							</div>
						</div>
						
				</div>
			</div>
			</div>
			</form>
			
			
			<?php
				break;
				case "ubahhalaman" :
				$token  = $_GET['token'];
				$cek    = md5(md5($_GET['id']).md5('H3ndri@27'));
				if ( $cek == $token ){
			?>
			<form method="POST" action="" class="form-horizontal" enctype="multipart/form-data">
			<div class="row">
				<div class="col-sm-10">
				<span style="font-size : 30px;">Halaman Statis</span> beranda / ubah halaman statis
				</div>
				<div class="col-sm-2">
					<p class="pull-right">
						<button class="btn btn-info" name="ubah" type="submit" data-toggle="tooltip" title="Simpan"><i class="fa fa-save"></i></button>
						<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=halaman&act=ubahhalaman&id=<?php echo $_GET['id']; ?>&token=<?php echo $_GET['token']; ?>';"><i class="fa fa-refresh"></i></button>
						<button type="button" class="btn btn-danger" data-toggle="tooltip" title="Kembali" onclick="window.location.href='?module=halaman';"><i class="fa fa-share"></i></button>
					</p>
					
				</div>
			</div>
			<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><i class="glyphicon glyphicon-edit"></i>   Ubah Halaman Statis</h4>
					
				</div>
				<div class="panel-body">	 
					<?php
						
						$query1 = $db->prepare("SELECT judul_halaman,link_halaman,isi_halaman FROM halaman_statis WHERE id_halaman=?");
						$query1->bind_param("i", $id_halaman);
						$id_halaman = $_GET['id'];
						$query1->execute();
						$result = $query1->get_result();
						$row    = $result->fetch_assoc();
						
						if ( isset($_POST['ubah']) ){
							
							$judul      = $_POST['judul'];
							$url        = $_POST['url'];
							$isi        = $_POST['isi'];
							$id_halaman = $_GET['id'];
							
							$query      = $db->prepare("UPDATE halaman_statis SET judul_halaman=?,link_halaman=?,isi_halaman=? WHERE id_halaman=? ");
							$query->bind_param("sssi", $judul,$url,$isi,$id_halaman);
							$query->execute();
							
							echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
							echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
							echo '<strong>SUKSES!</strong> Data Berhasil Diubah Dong';
							echo '</div>';
							echo "<meta http-equiv='refresh' content='1; url=?module=halaman&act=ubahhalaman&id=$_GET[id]&token=$_GET[token]'>";
							
						}
					
					?>
						<div class="form-group">
							<label class="control-label col-sm-4">Judul Halaman</label>
							<div class="col-sm-4">
								<input type="text"  class="form-control" name="judul" value="<?php echo $row['judul_halaman']; ?>"  maxlength="50" required />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">URL Link</label>
							<div class="col-sm-4">
								<input type="text"  class="form-control" name="url" value="<?php echo $row['link_halaman']; ?>" maxlength="50" required/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Isi Halaman</label>
							<div class="col-sm-8">
								<textarea name="isi" id="tinymce_basic" class="form-control" rows="10"><?php echo $row['isi_halaman']; ?></textarea>
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
