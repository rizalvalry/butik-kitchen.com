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
				<span style="font-size : 30px;">Sub Menu</span> beranda / sub menu
				</div>
				<div class="col-sm-4">
					<p class="pull-right">
					<button type="button" class="btn btn-info" data-toggle="tooltip" title="Tambah" onclick="window.location.href='?module=submenu&act=tambahsubmenu';"><i class="glyphicon glyphicon-plus"></i></button>
					<button type="submit" class="btn btn-success" name="aktif"  data-toggle="tooltip"  title="Aktifkan"><i class="glyphicon glyphicon-ok"></i></button>
					<button type="submit" class="btn btn-warning" name="nonaktif"  data-toggle="tooltip"  title="Nonaktifkan"><i class="glyphicon glyphicon-remove"></i></button>
					<button type="submit" class="btn btn-success" name="akses"  data-toggle="tooltip"  title="Diakses User"><i class="glyphicon glyphicon-ok"></i></button>
					<button type="submit" class="btn btn-warning" name="nonakses"  data-toggle="tooltip"  title="Tidak Diakses User"><i class="glyphicon glyphicon-remove"></i></button>
					<button type="submit" class="btn btn-danger"  name="hapus"  data-toggle="tooltip" onClick="return confirm('Data yang sudah dihapus tidak bisa dikembalikan lagi. Apakah anda yakin ?')" title="Hapus"><i class="glyphicon glyphicon-trash"></i></button>
					<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=submenu';"><i class="glyphicon glyphicon-refresh"></i></button>
					</p>
				</div>
			</div>
			<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><i class="glyphicon glyphicon-list"></i>   Data Sub Menu</h4>
					
				</div>
				<div class="panel-body">	
					<?php
												
						if ( isset($_POST['akses']) ){
							
							$id  = $_POST['id'];
							$jml = count($id);	
							
							if ( $jml <= 0 ){
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>Peringatan!</strong> Silahkan Tandai Terlebih Dahulu Sub Menu Yang Akan Anda Berikan Hak Akses Terhadap User';
								echo '</div>';
							} else {
								for ( $i = 0; $i <= $jml; $i++ ){
									$query = $db->prepare("UPDATE submenu SET user=? WHERE id_sub=?");
									$query->bind_param("si", $akses,$id_sub);
									$id_sub = $id[$i];
									$akses   = "Y";
									$query->execute();
								}
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> '.$jml.' Sub Menu Bisa Diakses Oleh User ';
								echo '</div>';
							} 
			
						} else if ( isset($_POST['nonakses']) ){
							
							$id  = $_POST['id'];
							$jml = count($id);	
							
							if ( $jml <= 0 ){
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>Peringatan!</strong> Silahkan Tandai Terlebih Dahulu Sub Menu Yang Tidak Akan Anda Berikan Hak Akses Terhadap User';
								echo '</div>';
							} else {
								for ( $i = 0; $i <= $jml; $i++ ){
									$query = $db->prepare("UPDATE submenu SET user=? WHERE id_sub=?");
									$query->bind_param("si", $akses,$id_sub);
									$id_sub = $id[$i];
									$akses   = "T";
									$query->execute();
								}
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> '.$jml.' Sub Menu Tidak Bisa Diakses Oleh User ';
								echo '</div>';
							} 
							
						} else if ( isset($_POST['nonaktif']) ){
							
							$id  = $_POST['id'];
							$jml = count($id);	
							
							if ( $jml <= 0 ){
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>Peringatan!</strong> Silahkan Tandai Terlebih Sub Dahulu Menu Yang Akan Anda Nonaktifkan';
								echo '</div>';
							} else {
								for ( $i = 0; $i <= $jml; $i++ ){
									$query = $db->prepare("UPDATE submenu SET aktif=? WHERE id_sub=?");
									$query->bind_param("si", $aktif,$id_sub);
									$id_sub = $id[$i];
									$aktif   = "T";
									$query->execute();
								}
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> '.$jml.' Sub Menu Berhasil Dinonaktifkan ';
								echo '</div>';
							}
							
						} else if ( isset($_POST['aktif']) ){
							
							$id  = $_POST['id'];
							$jml = count($id);	
							
							if ( $jml <= 0 ){
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>Peringatan!</strong> Silahkan Tandai Terlebih Dahulu Sub Menu Yang Akan Anda Aktifkan';
								echo '</div>';
							} else {
								for ( $i = 0; $i <= $jml; $i++ ){
									$query = $db->prepare("UPDATE submenu SET aktif=? WHERE id_sub=?");
									$query->bind_param("si", $aktif,$id_sub);
									$id_sub = $id[$i];
									$aktif   = "Y";
									$query->execute();
								}
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> '.$jml.' Sub Menu Berhasil Diaktifkan ';
								echo '</div>';
							}
							
						} else if ( isset($_POST['hapus']) ){
							
							$id  = $_POST['id'];
							$jml = count($id);	
							
							if ( $jml <= 0 ){
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>Peringatan!</strong> Silahkan Tandai Terlebih Dahulu Sub Menu Yang Akan Anda Hapus';
								echo '</div>';
							} else {
								for ( $i = 0; $i <= $jml; $i++ ){
									$query = $db->prepare("DELETE FROM submenu WHERE id_sub=?");
									$query->bind_param("i", $id_sub);
									$id_sub = $id[$i];
									$query->execute();
								}
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> '.$jml.' Sub Menu Berhasil Hapus ';
								echo '</div>';
							}
							
						}
					?>
					<div class="table-responsive">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr class="bg-warning">
									<th><label><input type="checkbox" name="semua" id="semua" /></label> NO</th>
									<th>Sub Menu</th>
									<th>Menu Utama</th>
									<th>Link</th>
									<th>Aktif</th>
									<th>Diakses User</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$no     = 1;
									$query5 = $db->query("SELECT menuutama.nama_menu,submenu.id_sub,submenu.nama_sub,submenu.link_sub,submenu.aktif,submenu.user FROM submenu LEFT JOIN menuutama ON submenu.id_main=menuutama.id_main ORDER BY menuutama.nama_menu ASC");
									while( $row    = $query5->fetch_assoc()){						
								?>
								<tr>
									<td><label><input type="checkbox" name="id[]" value="<?php echo $row['id_sub']; ?>" /> <?php echo $no; ?></label></td>
									<td><?php echo $row['nama_sub']; ?></td>
									<td><?php echo $row['nama_menu']; ?></td>
									<td><?php echo $row['link_sub']; ?></td>
									<td><?php echo ( $row['aktif'] == "Y" ) ? "Aktif" : "Tidak Aktif"; ?></td>
									<td><?php echo ( $row['user'] == "Y" ) ? "Diakses" : "Tidak Diakses"; ?></td>
									<td><a href="?module=submenu&act=ubahsubmenu&id=<?php echo $row['id_sub']; ?>&token=<?php echo md5(md5($row['id_sub']).md5('H3ndri@27')); ?>" class="btn btn-primary" data-toggle="tooltip"  title="Ubah" role="button"><i class="fa fa-pencil"></i></a></td>
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
				case "tambahsubmenu" :
			?>
			
			<form method="POST" action="" class="form-horizontal" enctype="multipart/form-data">
			<div class="row">
				<div class="col-sm-10">
				<span style="font-size : 30px;">Sub Menu</span> beranda / sub menu
				</div>
				<div class="col-sm-2">
					<p class="pull-right">
						<button class="btn btn-info" name="tambah" type="submit" data-toggle="tooltip" title="Simpan"><i class="fa fa-save"></i></button>
						<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=submenu&act=tambahsubmenu';"><i class="fa fa-refresh"></i></button>
						<button type="button" class="btn btn-danger" data-toggle="tooltip" title="Kembali" onclick="window.location.href='?module=submenu';"><i class="fa fa-share"></i></button>
					</p>
					
				</div>
			</div>
			
			<div class="row">
			<div class="panel-group">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><i class="glyphicon glyphicon-pencil"></i>   Tambah Sub Menu</h4>\
					
				</div>
				<div class="panel-body">	 
					<?php
						
						
						if ( isset($_POST['tambah']) ){
							
							$id_main = $_POST['menu_utama'];
							$submenu = $_POST['submenu'];
							$url     = $_POST['url'];
							$aktif   = $_POST['aktif'];
							$akses   = $_POST['akses'];
							
							$query   = $db->prepare("INSERT INTO submenu (id_main,nama_sub,link_sub,aktif,user) VALUES (?,?,?,?,?)");
							$query->bind_param("issss", $id_main,$submenu,$url,$aktif,$akses);
							$query->execute();
							
							echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
							echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
							echo '<strong>SUKSES!</strong> Data Berhasil Disimpan';
							echo '</div>';
							echo "<meta http-equiv='refresh' content='1; url=?module=submenu&act=tambahsubmenu'>";
							
						}	
					
					?>
						<div class="form-group">
							<label class="control-label col-sm-4">Menu Utama</label>
							<div class="col-sm-3">
								<select name="menu_utama" id="select" class="form-control" required>
								<option value=""></option>
									<?php
										$query = $db->query("SELECT id_main,nama_menu FROM menuutama ORDER BY nama_menu ASC");
										while ( $row = $query->fetch_assoc() ){
											echo "<option value='$row[id_main]'>$row[nama_menu]</option>";
										}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Nama Submenu</label>
							<div class="col-sm-4">
								<input type="text" value="<?php echo isset( $submenu ) ? $submenu : ""; ?>" class="form-control" name="submenu" placeholder="Nama Submenu" maxlength="100" required />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">URL Link</label>
							<div class="col-sm-5">
								<input type="text" value="<?php echo isset( $url ) ? $url : ""; ?>" class="form-control" name="url" placeholder="URL Link" maxlength="100" required />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Aktif</label>
							<div class="col-sm-6">
								<div class="radio">
									<label><input type="radio" name="aktif" value="Y" checked /> <b>Ya</b>, Maka Menu Aktif</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="aktif" value="T" /> <b>Tidak</b>, Maka Menu Tidak Aktif</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Akses User</label>
							<div class="col-sm-6">
								<div class="radio">
									<label><input type="radio" name="akses" value="Y" /> <b>Ya</b>, Maka Menu Dapat Diakses Oleh User dan Admin</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="akses" value="T" checked /> <b>Tidak</b>, Maka Menu Hanya Dapat Diakses Oleh Admin Saja </label>
								</div>
							</div>
						</div>
					
				</div>
			</div>
			</div>
			</form>
			
			
			<?php
				break;
				case "ubahsubmenu" :
				$token  = $_GET['token'];
				$cek    = md5(md5($_GET['id']).md5('H3ndri@27'));
				if ( $cek == $token ){
			?>
			<form method="POST" action="" class="form-horizontal" enctype="multipart/form-data">
			<div class="row">
				<div class="col-sm-10">
				<span style="font-size : 30px;">Sub Menu</span> beranda / ubah sub menu
				</div>
				<div class="col-sm-2">
					<p class="pull-right">
						<button class="btn btn-info" name="ubah" type="submit" data-toggle="tooltip" title="Simpan"><i class="fa fa-save"></i></button>
						<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=submenu&act=ubahsubmenu&id=<?php echo $_GET['id']; ?>&token=<?php echo $_GET['token']; ?>';"><i class="fa fa-refresh"></i></button>
						<button type="button" class="btn btn-danger" data-toggle="tooltip" title="Kembali" onclick="window.location.href='?module=submenu';"><i class="fa fa-share"></i></button>
					</p>
					
				</div>
			</div>
			<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><i class="glyphicon glyphicon-edit"></i>   Ubah Sub Menu</h4>
					
				</div>
				<div class="panel-body">	 
					<?php
						
						$query1 = $db->prepare("SELECT id_main,nama_sub,link_sub FROM submenu WHERE id_sub=?");
						$query1->bind_param("i", $id_sub);
						$id_sub = $_GET['id'];
						$query1->execute();
						$result = $query1->get_result();
						$row1   = $result->fetch_assoc();
						
						if ( isset($_POST['ubah']) ){
							
							$id_main = $_POST['menu_utama'];
							$submenu = $_POST['submenu'];
							$url     = $_POST['url'];
							$id_sub  = $_GET['id'];
							
							$query = $db->prepare("UPDATE submenu SET id_main=?,nama_sub=?,link_sub=? WHERE id_sub=?");
							$query->bind_param("issi", $id_main,$submenu,$url,$id_sub);
							$query->execute();
							
							echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
							echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
							echo '<strong>SUKSES!</strong> Data Berhasil Diubah';
							echo '</div>';
							echo "<meta http-equiv='refresh' content='1; url=?module=submenu&act=ubahsubmenu&id=$_GET[id]&token=$_GET[token]'>";
							
						}
					
					?>
						<div class="form-group">
							<label class="control-label col-sm-4">Menu Utama</label>
							<div class="col-sm-3">
								<select name="menu_utama" id="select" class="form-control" required>
								<option value=""></option>
									<?php
										$query2 = $db->query("SELECT id_main,nama_menu FROM menuutama ORDER BY nama_menu ASC");
										while ( $row2 = $query2->fetch_assoc() ){
											$pilih = ( $row1['id_main'] == $row2['id_main'] ) ? "selected" : "";
											echo "<option value='$row2[id_main]' $pilih>$row2[nama_menu]</option>";
										}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Nama Submenu</label>
							<div class="col-sm-4">
								<input type="text" value="<?php echo $row1['nama_sub']; ?>" class="form-control" name="submenu" placeholder="Nama Submenu" maxlength="100" required />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">URL Link</label>
							<div class="col-sm-5">
								<input type="text" value="<?php echo $row1['link_sub']; ?>" class="form-control" name="url" placeholder="URL Link" maxlength="100" required />
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
