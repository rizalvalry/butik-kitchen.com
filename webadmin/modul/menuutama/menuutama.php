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
				<span style="font-size : 30px;">Menu Utama</span> beranda / menu utama
				</div>
				<div class="col-sm-4">
					<p class="pull-right">
					<button type="button" class="btn btn-info" data-toggle="tooltip" title="Tambah" onclick="window.location.href='?module=menuutama&act=tambahmenuutama';"><i class="glyphicon glyphicon-plus"></i></button>
					<button type="submit" class="btn btn-success" name="aktif"  data-toggle="tooltip"  title="Aktifkan"><i class="glyphicon glyphicon-ok"></i></button>
					<button type="submit" class="btn btn-warning" name="nonaktif"  data-toggle="tooltip"  title="Nonaktifkan"><i class="glyphicon glyphicon-remove"></i></button>
					<button type="submit" class="btn btn-success" name="akses"  data-toggle="tooltip"  title="Diakses User"><i class="glyphicon glyphicon-ok"></i></button>
					<button type="submit" class="btn btn-warning" name="nonakses"  data-toggle="tooltip"  title="Tidak Diakses User"><i class="glyphicon glyphicon-remove"></i></button>
					<button type="submit" class="btn btn-danger"  name="hapus"  data-toggle="tooltip" onClick="return confirm('Data yang sudah dihapus tidak bisa dikembalikan lagi. Apakah anda yakin ?')" title="Hapus"><i class="glyphicon glyphicon-trash"></i></button>
					<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=menuutama';"><i class="glyphicon glyphicon-refresh"></i></button>
					</p>
				</div>
			</div>
			<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><i class="glyphicon glyphicon-list"></i>   Data Menu Utama</h4>
					
				</div>
				<div class="panel-body">	
					<?php
												
						if ( isset($_POST['akses']) ){
							
							$id  = $_POST['id'];
							$jml = count($id);	
							
							if ( $jml <= 0 ){
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>Peringatan!</strong> Silahkan Tandai Terlebih Dahulu Menu Yang Akan Anda Berikan Hak Akses Terhadap User';
								echo '</div>';
							} else {
								for ( $i = 0; $i <= $jml; $i++ ){
									$query = $db->prepare("UPDATE menuutama SET user=? WHERE id_main=?");
									$query->bind_param("si", $akses,$id_main);
									$id_main = $id[$i];
									$akses   = "Y";
									$query->execute();
								}
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> '.$jml.' Menu Utama Bisa Diakses Oleh User ';
								echo '</div>';
							} 
			
						} else if ( isset($_POST['nonakses']) ){
							
							$id  = $_POST['id'];
							$jml = count($id);	
							
							if ( $jml <= 0 ){
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>Peringatan!</strong> Silahkan Tandai Terlebih Dahulu Menu Yang Tidak Akan Anda Berikan Hak Akses Terhadap User';
								echo '</div>';
							} else {
								for ( $i = 0; $i <= $jml; $i++ ){
									$query = $db->prepare("UPDATE menuutama SET user=? WHERE id_main=?");
									$query->bind_param("si", $akses,$id_main);
									$id_main = $id[$i];
									$akses   = "T";
									$query->execute();
								}
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> '.$jml.' Menu Utama Tidak Bisa Diakses Oleh User ';
								echo '</div>';
							} 
							
						} else if ( isset($_POST['nonaktif']) ){
							
							$id  = $_POST['id'];
							$jml = count($id);	
							
							if ( $jml <= 0 ){
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>Peringatan!</strong> Silahkan Tandai Terlebih Dahulu Menu Yang Akan Anda Nonaktifkan';
								echo '</div>';
							} else {
								for ( $i = 0; $i <= $jml; $i++ ){
									$query = $db->prepare("UPDATE menuutama SET aktif=? WHERE id_main=?");
									$query->bind_param("si", $aktif,$id_main);
									$id_main = $id[$i];
									$aktif   = "T";
									$query->execute();
								}
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> '.$jml.' Menu Berhasil Dinonaktifkan ';
								echo '</div>';
							}
							
						} else if ( isset($_POST['aktif']) ){
							
							$id  = $_POST['id'];
							$jml = count($id);	
							
							if ( $jml <= 0 ){
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>Peringatan!</strong> Silahkan Tandai Terlebih Dahulu Menu Yang Akan Anda Aktifkan';
								echo '</div>';
							} else {
								for ( $i = 0; $i <= $jml; $i++ ){
									$query = $db->prepare("UPDATE menuutama SET aktif=? WHERE id_main=?");
									$query->bind_param("si", $aktif,$id_main);
									$id_main = $id[$i];
									$aktif   = "Y";
									$query->execute();
								}
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> '.$jml.' Menu Berhasil Diaktifkan ';
								echo '</div>';
							}
							
						} else if ( isset($_POST['hapus']) ){
							
							$id  = $_POST['id'];
							$jml = count($id);	
							
							if ( $jml <= 0 ){
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>Peringatan!</strong> Silahkan Tandai Terlebih Dahulu Menu Yang Akan Anda Hapus';
								echo '</div>';
							} else {
								for ( $i = 0; $i <= $jml; $i++ ){
									$query = $db->prepare("DELETE FROM menuutama WHERE id_main=?");
									$query->bind_param("i", $id_main);
									$id_main = $id[$i];
									$query->execute();
								}
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> '.$jml.' Menu Berhasil Hapus ';
								echo '</div>';
							}
							
						}
					?>
					<div class="table-responsive">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr class="bg-warning">
									<th><label><input type="checkbox" name="semua" id="semua" /></label> NO</th>
									<th>Nama Menu</th>
									<th>Ikon</th>
									<th>Link</th>
									<th>Urutan</th>
									<th>Aktif</th>
									<th>Letak</th>
									<th>Akses User</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$no     = 1;
									$query5 = $db->query("SELECT * FROM menuutama ORDER BY urutan ASC");
									while( $row    = $query5->fetch_assoc()){						
								?>
								<tr>
									<td><label><input type="checkbox" name="id[]" value="<?php echo $row['id_main']; ?>" /> <?php echo $no; ?></label></td>
									<td><?php echo $row['nama_menu']; ?></td>
									<td> <i class="<?php echo $row['icon']; ?>"></i></td>
									<td><?php echo $row['link']; ?></td>
									<td><?php echo $row['urutan']; ?></td>
									<td><?php echo ( $row['aktif'] == "Y" ) ? "Aktif" : "Tidak Aktif"; ?></td>
									<td><?php echo $row['lokasi']; ?></td>
									<td><?php echo ( $row['user'] == "Y" ) ? "Diakses" : "Tidak Diakses"; ?></td>
									<td><a href="?module=menuutama&act=ubahmenuutama&id=<?php echo $row['id_main']; ?>&token=<?php echo md5(md5($row['id_main']).md5('H3ndri@27')); ?>" class="btn btn-primary" data-toggle="tooltip"  title="Ubah" role="button"><i class="fa fa-pencil"></i></a></td>
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
				case "tambahmenuutama" :
			?>
			<style type="text/css">
				.the-icons li{
					list-style-type : none;
					font-size : 14px; 
				}
			</style>
			<form method="POST" action="" class="form-horizontal" enctype="multipart/form-data">
			<div class="row">
				<div class="col-sm-10">
				<span style="font-size : 30px;">Menu Utama</span> beranda / Menu Utama
				</div>
				<div class="col-sm-2">
					<p class="pull-right">
						<button class="btn btn-info" name="tambah" type="submit" data-toggle="tooltip" title="Simpan"><i class="fa fa-save"></i></button>
						<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=menuutama&act=tambahmenuutama';"><i class="fa fa-refresh"></i></button>
						<button type="button" class="btn btn-danger" data-toggle="tooltip" title="Kembali" onclick="window.location.href='?module=menuutama';"><i class="fa fa-share"></i></button>
					</p>
					
				</div>
			</div>
			
			<div class="row">
			<div class="panel-group">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><i class="glyphicon glyphicon-pencil"></i>   Tambah Menu Utama</h4>\
					
				</div>
				<div class="panel-body">	 
					<?php
						
						
						if ( isset($_POST['tambah']) ){
							
							$menu   = $_POST['nama_menu'];
							$url    = $_POST['url'];
							$urutan = $_POST['urutan'];
							$aktif  = $_POST['aktif'];
							$lokasi = $_POST['lokasi'];
							$akses  = $_POST['akses'];
							$ikon   = $_POST['ikon'];
							
							if ( !preg_match("/^[0-9]*$/",$urutan) ){
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATRANN!</strong> Urutan Harus Angka';
								echo '</div>';
							} else {
								
								$query = $db->prepare("INSERT INTO menuutama (nama_menu,link,aktif,lokasi,user,icon,urutan) VALUES (?,?,?,?,?,?,?)");
								$query->bind_param("ssssssi", $menu,$url,$aktif,$lokasi,$akses,$ikon,$urutan);
								$query->execute();
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> Data Berhasil Disimpan';
								echo '</div>';
								echo "<meta http-equiv='refresh' content='1; url=?module=menuutama&act=tambahmenuutama'>";
								
							}
							
						}	
					
					?>
						<div class="form-group">
							<label class="control-label col-sm-4">Nama Menu</label>
							<div class="col-sm-4">
								<input type="text" value="<?php echo isset( $menu ) ? $menu : ""; ?>" class="form-control" name="nama_menu" placeholder="Nama Menu" maxlength="50" required autofocus />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">URL Link</label>
							<div class="col-sm-5">
								<input type="text" value="<?php echo isset( $url ) ? $url : ""; ?>" class="form-control" name="url" placeholder="URL Link" maxlength="100" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Urutan</label>
							<div class="col-sm-1">
								<input type="text" value="<?php echo isset( $urutan ) ? $urutan : ""; ?>" class="form-control" name="urutan" placeholder="Urutan Menu" maxlength="5" required />
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
							<label class="control-label col-sm-4">Lokasi Menu</label>
							<div class="col-sm-6">
								<div class="radio">
									<label><input type="radio" name="lokasi" value="Admin" checked /> <b>Admin</b>, Maka Menu Hanya Muncul Pada Halaman Admin</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="lokasi" value="Public" /> <b>Public</b>, Maka Menu Hanya Muncul Pada Halaman Depan Website</label>
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
						<div class="form-group">
							<label class="control-label col-sm-4">Ikon Menu</label>
							<div class="col-sm-5">
								<input type="text" value="<?php echo isset( $ikon ) ? $ikon : ""; ?>" class="form-control" name="ikon" placeholder="Contoh fa fa-home atau glyphicon glyphicon-home" maxlength="50" />
								<p class="help-block"><i>Untuk icon yang lebih besar Anda bisa mengganti <b>fa fa-nama_icon</b> dengan <b>glyphicon glyphicon-nama_icon</b></i></p>
							</div>
						</div>
					
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading"><h4>Daftar Icon</h4></div>
				<div class="panel-body">
			<div class="row bs-icons">
			<div class="col-md-3">
				<ul class="the-icons">
					<li><i class="glyphicon glyphicon-glass"></i> glyphicon glyphicon-glass</li>
					<li><i class="glyphicon glyphicon-music"></i> glyphicon glyphicon-music</li>
					<li><i class="glyphicon glyphicon-search"></i> glyphicon glyphicon-search</li>
					<li><i class="glyphicon glyphicon-envelope"></i> glyphicon glyphicon-envelope</li>
					<li><i class="glyphicon glyphicon-heart"></i> glyphicon glyphicon-heart</li>
					<li><i class="glyphicon glyphicon-star"></i> glyphicon glyphicon-star</li>
					<li><i class="glyphicon glyphicon-star-empty"></i> glyphicon glyphicon-star-empty</li>
					<li><i class="glyphicon glyphicon-user"></i> glyphicon glyphicon-user</li>
					<li><i class="glyphicon glyphicon-film"></i> glyphicon glyphicon-film</li>
					<li><i class="glyphicon glyphicon-th-large"></i> glyphicon glyphicon-th-large</li>
					<li><i class="glyphicon glyphicon-th"></i> glyphicon glyphicon-th</li>
					<li><i class="glyphicon glyphicon-th-list"></i> glyphicon glyphicon-th-list</li>
					<li><i class="glyphicon glyphicon-ok"></i> glyphicon glyphicon-ok</li>
					<li><i class="glyphicon glyphicon-remove"></i> glyphicon glyphicon-remove</li>
					<li><i class="glyphicon glyphicon-zoom-in"></i> glyphicon glyphicon-zoom-in</li>
					<li><i class="glyphicon glyphicon-zoom-out"></i> glyphicon glyphicon-zoom-out</li>
					<li><i class="glyphicon glyphicon-off"></i> glyphicon glyphicon-off</li>
					<li><i class="glyphicon glyphicon-signal"></i> glyphicon glyphicon-signal</li>
					<li><i class="glyphicon glyphicon-cog"></i> glyphicon glyphicon-cog</li>
					<li><i class="glyphicon glyphicon-trash"></i> glyphicon glyphicon-trash</li>
					<li><i class="glyphicon glyphicon-home"></i> glyphicon glyphicon-home</li>
					<li><i class="glyphicon glyphicon-file"></i> glyphicon glyphicon-file</li>
					<li><i class="glyphicon glyphicon-time"></i> glyphicon glyphicon-time</li>
					<li><i class="glyphicon glyphicon-road"></i> glyphicon glyphicon-road</li>
					<li><i class="glyphicon glyphicon-download-alt"></i> glyphicon glyphicon-download-alt</li>
					<li><i class="glyphicon glyphicon-download"></i> glyphicon glyphicon-download</li>
					<li><i class="glyphicon glyphicon-upload"></i> glyphicon glyphicon-upload</li>
					<li><i class="glyphicon glyphicon-inbox"></i> glyphicon glyphicon-inbox</li>
					<li><i class="glyphicon glyphicon-play-circle"></i> glyphicon glyphicon-play-circle</li>
					<li><i class="glyphicon glyphicon-repeat"></i> glyphicon glyphicon-repeat</li>
					<li><i class="glyphicon glyphicon-refresh"></i> glyphicon glyphicon-refresh</li>
					<li><i class="glyphicon glyphicon-list-alt"></i> glyphicon glyphicon-list-alt</li>
					<li><i class="glyphicon glyphicon-lock"></i> glyphicon glyphicon-lock</li>
					<li><i class="glyphicon glyphicon-flag"></i> glyphicon glyphicon-flag</li>
					<li><i class="glyphicon glyphicon-headphones"></i> glyphicon glyphicon-headphones</li>
				</ul>
			</div>
			<div class="col-md-3">
				<ul class="the-icons">
					<li><i class="glyphicon glyphicon-volume-off"></i> glyphicon glyphicon-volume-off</li>
					<li><i class="glyphicon glyphicon-volume-down"></i> glyphicon glyphicon-volume-down</li>
					<li><i class="glyphicon glyphicon-volume-up"></i> glyphicon glyphicon-volume-up</li>
					<li><i class="glyphicon glyphicon-qrcode"></i> glyphicon glyphicon-qrcode</li>
					<li><i class="glyphicon glyphicon-barcode"></i> glyphicon glyphicon-barcode</li>
					<li><i class="glyphicon glyphicon-tag"></i> glyphicon glyphicon-tag</li>
					<li><i class="glyphicon glyphicon-tags"></i> glyphicon glyphicon-tags</li>
					<li><i class="glyphicon glyphicon-book"></i> glyphicon glyphicon-book</li>
					<li><i class="glyphicon glyphicon-bookmark"></i> glyphicon glyphicon-bookmark</li>
					<li><i class="glyphicon glyphicon-print"></i> glyphicon glyphicon-print</li>
					<li><i class="glyphicon glyphicon-camera"></i> glyphicon glyphicon-camera</li>
					<li><i class="glyphicon glyphicon-font"></i> glyphicon glyphicon-font</li>
					<li><i class="glyphicon glyphicon-bold"></i> glyphicon glyphicon-bold</li>
					<li><i class="glyphicon glyphicon-italic"></i> glyphicon glyphicon-italic</li>
					<li><i class="glyphicon glyphicon-text-height"></i> glyphicon glyphicon-text-height</li>
					<li><i class="glyphicon glyphicon-text-width"></i> glyphicon glyphicon-text-width</li>
					<li><i class="glyphicon glyphicon-align-left"></i> glyphicon glyphicon-align-left</li>
					<li><i class="glyphicon glyphicon-align-center"></i> glyphicon glyphicon-align-center</li>
					<li><i class="glyphicon glyphicon-align-right"></i> glyphicon glyphicon-align-right</li>
					<li><i class="glyphicon glyphicon-align-justify"></i> glyphicon glyphicon-align-justify</li>
					<li><i class="glyphicon glyphicon-list"></i> glyphicon glyphicon-list</li>
					<li><i class="glyphicon glyphicon-indent-left"></i> glyphicon glyphicon-indent-left</li>
					<li><i class="glyphicon glyphicon-indent-right"></i> glyphicon glyphicon-indent-right</li>
					<li><i class="glyphicon glyphicon-facetime-video"></i> glyphicon glyphicon-facetime-video</li>
					<li><i class="glyphicon glyphicon-picture"></i> glyphicon glyphicon-picture</li>
					<li><i class="glyphicon glyphicon-pencil"></i> glyphicon glyphicon-pencil</li>
					<li><i class="glyphicon glyphicon-map-marker"></i> glyphicon glyphicon-map-marker</li>
					<li><i class="glyphicon glyphicon-adjust"></i> glyphicon glyphicon-adjust</li>
					<li><i class="glyphicon glyphicon-tint"></i> glyphicon glyphicon-tint</li>
					<li><i class="glyphicon glyphicon-edit"></i> glyphicon glyphicon-edit</li>
					<li><i class="glyphicon glyphicon-share"></i> glyphicon glyphicon-share</li>
					<li><i class="glyphicon glyphicon-check"></i> glyphicon glyphicon-check</li>
					<li><i class="glyphicon glyphicon-move"></i> glyphicon glyphicon-move</li>
					<li><i class="glyphicon glyphicon-step-backward"></i> glyphicon glyphicon-step-backward</li>
					<li><i class="glyphicon glyphicon-fast-backward"></i> glyphicon glyphicon-fast-backward</li>
				</ul>
			</div>
			<div class="col-md-3">
				<ul class="the-icons">
					<li><i class="glyphicon glyphicon-backward"></i> glyphicon glyphicon-backward</li>
					<li><i class="glyphicon glyphicon-play"></i> glyphicon glyphicon-play</li>
					<li><i class="glyphicon glyphicon-pause"></i> glyphicon glyphicon-pause</li>
					<li><i class="glyphicon glyphicon-stop"></i> glyphicon glyphicon-stop</li>
					<li><i class="glyphicon glyphicon-forward"></i> glyphicon glyphicon-forward</li>
					<li><i class="glyphicon glyphicon-fast-forward"></i> glyphicon glyphicon-fast-forward</li>
					<li><i class="glyphicon glyphicon-step-forward"></i> glyphicon glyphicon-step-forward</li>
					<li><i class="glyphicon glyphicon-eject"></i> glyphicon glyphicon-eject</li>
					<li><i class="glyphicon glyphicon-chevron-left"></i> glyphicon glyphicon-chevron-left</li>
					<li><i class="glyphicon glyphicon-chevron-right"></i> glyphicon glyphicon-chevron-right</li>
					<li><i class="glyphicon glyphicon-plus-sign"></i> glyphicon glyphicon-plus-sign</li>
					<li><i class="glyphicon glyphicon-minus-sign"></i> glyphicon glyphicon-minus-sign</li>
					<li><i class="glyphicon glyphicon-remove-sign"></i> glyphicon glyphicon-remove-sign</li>
					<li><i class="glyphicon glyphicon-ok-sign"></i> glyphicon glyphicon-ok-sign</li>
					<li><i class="glyphicon glyphicon-question-sign"></i> glyphicon glyphicon-question-sign</li>
					<li><i class="glyphicon glyphicon-info-sign"></i> glyphicon glyphicon-info-sign</li>
					<li><i class="glyphicon glyphicon-screenshot"></i> glyphicon glyphicon-screenshot</li>
					<li><i class="glyphicon glyphicon-remove-circle"></i> glyphicon glyphicon-remove-circle</li>
					<li><i class="glyphicon glyphicon-ok-circle"></i> glyphicon glyphicon-ok-circle</li>
					<li><i class="glyphicon glyphicon-ban-circle"></i> glyphicon glyphicon-ban-circle</li>
					<li><i class="glyphicon glyphicon-arrow-left"></i> glyphicon glyphicon-arrow-left</li>
					<li><i class="glyphicon glyphicon-arrow-right"></i> glyphicon glyphicon-arrow-right</li>
					<li><i class="glyphicon glyphicon-arrow-up"></i> glyphicon glyphicon-arrow-up</li>
					<li><i class="glyphicon glyphicon-arrow-down"></i> glyphicon glyphicon-arrow-down</li>
					<li><i class="glyphicon glyphicon-share-alt"></i> glyphicon glyphicon-share-alt</li>
					<li><i class="glyphicon glyphicon-resize-full"></i> glyphicon glyphicon-resize-full</li>
					<li><i class="glyphicon glyphicon-resize-small"></i> glyphicon glyphicon-resize-small</li>
					<li><i class="glyphicon glyphicon-plus"></i> glyphicon glyphicon-plus</li>
					<li><i class="glyphicon glyphicon-minus"></i> glyphicon glyphicon-minus</li>
					<li><i class="glyphicon glyphicon-asterisk"></i> glyphicon glyphicon-asterisk</li>
					<li><i class="glyphicon glyphicon-exclamation-sign"></i> glyphicon glyphicon-exclamation-sign</li>
					<li><i class="glyphicon glyphicon-gift"></i> glyphicon glyphicon-gift</li>
					<li><i class="glyphicon glyphicon-leaf"></i> glyphicon glyphicon-leaf</li>
					<li><i class="glyphicon glyphicon-fire"></i> glyphicon glyphicon-fire</li>
					<li><i class="glyphicon glyphicon-eye-open"></i> glyphicon glyphicon-eye-open</li>
				</ul>
			</div>
			<div class="col-md-3">
				<ul class="the-icons">
					<li><i class="glyphicon glyphicon-eye-close"></i> glyphicon glyphicon-eye-close</li>
					<li><i class="glyphicon glyphicon-warning-sign"></i> glyphicon glyphicon-warning-sign</li>
					<li><i class="glyphicon glyphicon-plane"></i> glyphicon glyphicon-plane</li>
					<li><i class="glyphicon glyphicon-calendar"></i> glyphicon glyphicon-calendar</li>
					<li><i class="glyphicon glyphicon-random"></i> glyphicon glyphicon-random</li>
					<li><i class="glyphicon glyphicon-comment"></i> glyphicon glyphicon-comment</li>
					<li><i class="glyphicon glyphicon-magnet"></i> glyphicon glyphicon-magnet</li>
					<li><i class="glyphicon glyphicon-chevron-up"></i> glyphicon glyphicon-chevron-up</li>
					<li><i class="glyphicon glyphicon-chevron-down"></i> glyphicon glyphicon-chevron-down</li>
					<li><i class="glyphicon glyphicon-retweet"></i> glyphicon glyphicon-retweet</li>
					<li><i class="glyphicon glyphicon-shopping-cart"></i> glyphicon glyphicon-shopping-cart</li>
					<li><i class="glyphicon glyphicon-folder-close"></i> glyphicon glyphicon-folder-close</li>
					<li><i class="glyphicon glyphicon-folder-open"></i> glyphicon glyphicon-folder-open</li>
					<li><i class="glyphicon glyphicon-resize-vertical"></i> glyphicon glyphicon-resize-vertical</li>
					<li><i class="glyphicon glyphicon-resize-horizontal"></i> glyphicon glyphicon-resize-horizontal</li>
					<li><i class="glyphicon glyphicon-hdd"></i> glyphicon glyphicon-hdd</li>
					<li><i class="glyphicon glyphicon-bullhorn"></i> glyphicon glyphicon-bullhorn</li>
					<li><i class="glyphicon glyphicon-bell"></i> glyphicon glyphicon-bell</li>
					<li><i class="glyphicon glyphicon-certificate"></i> glyphicon glyphicon-certificate</li>
					<li><i class="glyphicon glyphicon-thumbs-up"></i> glyphicon glyphicon-thumbs-up</li>
					<li><i class="glyphicon glyphicon-thumbs-down"></i> glyphicon glyphicon-thumbs-down</li>
					<li><i class="glyphicon glyphicon-hand-right"></i> glyphicon glyphicon-hand-right</li>
					<li><i class="glyphicon glyphicon-hand-left"></i> glyphicon glyphicon-hand-left</li>
					<li><i class="glyphicon glyphicon-hand-up"></i> glyphicon glyphicon-hand-up</li>
					<li><i class="glyphicon glyphicon-hand-down"></i> glyphicon glyphicon-hand-down</li>
					<li><i class="glyphicon glyphicon-circle-arrow-right"></i> glyphicon glyphicon-circle-arrow-right</li>
					<li><i class="a icon-circle-arrow-left s s"></i> glyphicon glyphicon-circle-arrow-left</li>
					<li><i class="glyphicon glyphicon-circle-arrow-up"></i> glyphicon glyphicon-circle-arrow-up</li>
					<li><i class="glyphicon glyphicon-circle-arrow-down"></i> glyphicon glyphicon-circle-arrow-down</li>
					<li><i class="glyphicon glyphicon-globe"></i> glyphicon glyphicon-globe</li>
					<li><i class="glyphicon glyphicon-wrench"></i> glyphicon glyphicon-wrench</li>
					<li><i class="glyphicon glyphicon-tasks"></i> glyphicon glyphicon-tasks</li>
					<li><i class="glyphicon glyphicon-filter"></i> glyphicon glyphicon-filter</li>
					<li><i class="glyphicon glyphicon-briefcase"></i> glyphicon glyphicon-briefcase</li>
					<li><i class="glyphicon glyphicon-fullscreen"></i> glyphicon glyphicon-fullscreen</li>
				</ul>
			</div>
				</div>
			</div>
			
			</div>
			</div>
			</form>
			
			
			<?php
				break;
				case "ubahmenuutama" :
				$token  = $_GET['token'];
				$cek    = md5(md5($_GET['id']).md5('H3ndri@27'));
				if ( $cek == $token ){
			?>
			<style type="text/css">
				.the-icons li{
					list-style-type : none;
					font-size : 14px; 
				}
			</style>
			<form method="POST" action="" class="form-horizontal" enctype="multipart/form-data">
			<div class="row">
				<div class="col-sm-10">
				<span style="font-size : 30px;">Menu Utama</span> beranda / ubah menu utama
				</div>
				<div class="col-sm-2">
					<p class="pull-right">
						<button class="btn btn-info" name="ubah" type="submit" data-toggle="tooltip" title="Simpan"><i class="fa fa-save"></i></button>
						<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=menuutama&act=ubahmenuutama&id=<?php echo $_GET['id']; ?>&token=<?php echo $_GET['token']; ?>';"><i class="fa fa-refresh"></i></button>
						<button type="button" class="btn btn-danger" data-toggle="tooltip" title="Kembali" onclick="window.location.href='?module=menuutama';"><i class="fa fa-share"></i></button>
					</p>
					
				</div>
			</div>
			<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><i class="glyphicon glyphicon-edit"></i>   Ubah Menu Utama</h4>\
					
				</div>
				<div class="panel-body">	 
					<?php
						$query  = $db->prepare("SELECT nama_menu,link,lokasi,icon,urutan FROM menuutama WHERE id_main=?");
						$query->bind_param("i", $id);
						$id     = $_GET['id'];
						$query->execute();
						$result = $query->get_result();
						$row    = $result->fetch_assoc();
						
						//jika tombol simpan ditekan
						if ( isset($_POST['ubah']) ){							
							
							$menu   = $_POST['nama_menu'];
							$url    = $_POST['url'];
							$urutan = $_POST['urutan'];
							$lokasi = $_POST['lokasi'];
							$ikon   = $_POST['ikon'];
							$id_main= $_GET['id'];
							
							if ( !preg_match("/^[0-9]*$/",$urutan) ){
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATRANN!</strong> Urutan Harus Angka';
								echo '</div>';
							} else {
								
								$query = $db->prepare("UPDATE menuutama SET nama_menu=?,link=?,urutan=?,lokasi=?,icon=? WHERE id_main=?");
								$query->bind_param("ssissi", $menu,$url,$urutan,$lokasi,$ikon,$id_main);
								$query->execute();
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> Data Berhasil Diubah';
								echo '</div>';
								echo "<meta http-equiv='refresh' content='1; url=?module=menuutama&act=ubahmenuutama&id=$_GET[id]&token=$_GET[token]'>";
								
							}
							
							
						}
					
					?>
						<div class="form-group">
							<label class="control-label col-sm-4">Nama Menu</label>
							<div class="col-sm-4">
								<input type="text" value="<?php echo $row['nama_menu']; ?>" class="form-control" name="nama_menu" placeholder="Nama Menu" maxlength="50" required autofocus />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">URL Link</label>
							<div class="col-sm-5">
								<input type="text" value="<?php echo $row['link']; ?>" class="form-control" name="url" placeholder="URL Link" maxlength="100" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Urutan</label>
							<div class="col-sm-1">
								<input type="text" value="<?php echo $row['urutan']; ?>" class="form-control" name="urutan" placeholder="Urutan Menu" maxlength="5" required />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Lokasi Menu</label>
							<div class="col-sm-6">
								<div class="radio">
									<label><input type="radio" name="lokasi" value="Admin" <?php echo ( $row['lokasi'] == "Admin" ) ? "checked" : ""; ?> /> <b>Admin</b>, Maka Menu Hanya Muncul Pada Halaman Admin</label>
								</div>
								<div class="radio">
									<label><input type="radio" name="lokasi" value="Public" <?php echo ( $row['lokasi'] == "Public" ) ? "checked" : ""; ?> /> <b>Public</b>, Maka Menu Hanya Muncul Pada Halaman Depan Website</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Ikon Menu</label>
							<div class="col-sm-5">
								<input type="text" value="<?php echo $row['icon']; ?>" class="form-control" name="ikon" placeholder="Contoh fa fa-home atau glyphicon glyphicon-home" maxlength="50" />
								<p class="help-block"><i>Untuk icon yang lebih besar Anda bisa mengganti <b>fa fa-nama_icon</b> dengan <b>glyphicon glyphicon-nama_icon</b></i></p>
							</div>
						</div>
					
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading"><h4>Daftar Icon</h4></div>
				<div class="panel-body">
			<div class="row bs-icons">
			<div class="col-md-3">
				<ul class="the-icons">
					<li><i class="glyphicon glyphicon-glass"></i> glyphicon glyphicon-glass</li>
					<li><i class="glyphicon glyphicon-music"></i> glyphicon glyphicon-music</li>
					<li><i class="glyphicon glyphicon-search"></i> glyphicon glyphicon-search</li>
					<li><i class="glyphicon glyphicon-envelope"></i> glyphicon glyphicon-envelope</li>
					<li><i class="glyphicon glyphicon-heart"></i> glyphicon glyphicon-heart</li>
					<li><i class="glyphicon glyphicon-star"></i> glyphicon glyphicon-star</li>
					<li><i class="glyphicon glyphicon-star-empty"></i> glyphicon glyphicon-star-empty</li>
					<li><i class="glyphicon glyphicon-user"></i> glyphicon glyphicon-user</li>
					<li><i class="glyphicon glyphicon-film"></i> glyphicon glyphicon-film</li>
					<li><i class="glyphicon glyphicon-th-large"></i> glyphicon glyphicon-th-large</li>
					<li><i class="glyphicon glyphicon-th"></i> glyphicon glyphicon-th</li>
					<li><i class="glyphicon glyphicon-th-list"></i> glyphicon glyphicon-th-list</li>
					<li><i class="glyphicon glyphicon-ok"></i> glyphicon glyphicon-ok</li>
					<li><i class="glyphicon glyphicon-remove"></i> glyphicon glyphicon-remove</li>
					<li><i class="glyphicon glyphicon-zoom-in"></i> glyphicon glyphicon-zoom-in</li>
					<li><i class="glyphicon glyphicon-zoom-out"></i> glyphicon glyphicon-zoom-out</li>
					<li><i class="glyphicon glyphicon-off"></i> glyphicon glyphicon-off</li>
					<li><i class="glyphicon glyphicon-signal"></i> glyphicon glyphicon-signal</li>
					<li><i class="glyphicon glyphicon-cog"></i> glyphicon glyphicon-cog</li>
					<li><i class="glyphicon glyphicon-trash"></i> glyphicon glyphicon-trash</li>
					<li><i class="glyphicon glyphicon-home"></i> glyphicon glyphicon-home</li>
					<li><i class="glyphicon glyphicon-file"></i> glyphicon glyphicon-file</li>
					<li><i class="glyphicon glyphicon-time"></i> glyphicon glyphicon-time</li>
					<li><i class="glyphicon glyphicon-road"></i> glyphicon glyphicon-road</li>
					<li><i class="glyphicon glyphicon-download-alt"></i> glyphicon glyphicon-download-alt</li>
					<li><i class="glyphicon glyphicon-download"></i> glyphicon glyphicon-download</li>
					<li><i class="glyphicon glyphicon-upload"></i> glyphicon glyphicon-upload</li>
					<li><i class="glyphicon glyphicon-inbox"></i> glyphicon glyphicon-inbox</li>
					<li><i class="glyphicon glyphicon-play-circle"></i> glyphicon glyphicon-play-circle</li>
					<li><i class="glyphicon glyphicon-repeat"></i> glyphicon glyphicon-repeat</li>
					<li><i class="glyphicon glyphicon-refresh"></i> glyphicon glyphicon-refresh</li>
					<li><i class="glyphicon glyphicon-list-alt"></i> glyphicon glyphicon-list-alt</li>
					<li><i class="glyphicon glyphicon-lock"></i> glyphicon glyphicon-lock</li>
					<li><i class="glyphicon glyphicon-flag"></i> glyphicon glyphicon-flag</li>
					<li><i class="glyphicon glyphicon-headphones"></i> glyphicon glyphicon-headphones</li>
				</ul>
			</div>
			<div class="col-md-3">
				<ul class="the-icons">
					<li><i class="glyphicon glyphicon-volume-off"></i> glyphicon glyphicon-volume-off</li>
					<li><i class="glyphicon glyphicon-volume-down"></i> glyphicon glyphicon-volume-down</li>
					<li><i class="glyphicon glyphicon-volume-up"></i> glyphicon glyphicon-volume-up</li>
					<li><i class="glyphicon glyphicon-qrcode"></i> glyphicon glyphicon-qrcode</li>
					<li><i class="glyphicon glyphicon-barcode"></i> glyphicon glyphicon-barcode</li>
					<li><i class="glyphicon glyphicon-tag"></i> glyphicon glyphicon-tag</li>
					<li><i class="glyphicon glyphicon-tags"></i> glyphicon glyphicon-tags</li>
					<li><i class="glyphicon glyphicon-book"></i> glyphicon glyphicon-book</li>
					<li><i class="glyphicon glyphicon-bookmark"></i> glyphicon glyphicon-bookmark</li>
					<li><i class="glyphicon glyphicon-print"></i> glyphicon glyphicon-print</li>
					<li><i class="glyphicon glyphicon-camera"></i> glyphicon glyphicon-camera</li>
					<li><i class="glyphicon glyphicon-font"></i> glyphicon glyphicon-font</li>
					<li><i class="glyphicon glyphicon-bold"></i> glyphicon glyphicon-bold</li>
					<li><i class="glyphicon glyphicon-italic"></i> glyphicon glyphicon-italic</li>
					<li><i class="glyphicon glyphicon-text-height"></i> glyphicon glyphicon-text-height</li>
					<li><i class="glyphicon glyphicon-text-width"></i> glyphicon glyphicon-text-width</li>
					<li><i class="glyphicon glyphicon-align-left"></i> glyphicon glyphicon-align-left</li>
					<li><i class="glyphicon glyphicon-align-center"></i> glyphicon glyphicon-align-center</li>
					<li><i class="glyphicon glyphicon-align-right"></i> glyphicon glyphicon-align-right</li>
					<li><i class="glyphicon glyphicon-align-justify"></i> glyphicon glyphicon-align-justify</li>
					<li><i class="glyphicon glyphicon-list"></i> glyphicon glyphicon-list</li>
					<li><i class="glyphicon glyphicon-indent-left"></i> glyphicon glyphicon-indent-left</li>
					<li><i class="glyphicon glyphicon-indent-right"></i> glyphicon glyphicon-indent-right</li>
					<li><i class="glyphicon glyphicon-facetime-video"></i> glyphicon glyphicon-facetime-video</li>
					<li><i class="glyphicon glyphicon-picture"></i> glyphicon glyphicon-picture</li>
					<li><i class="glyphicon glyphicon-pencil"></i> glyphicon glyphicon-pencil</li>
					<li><i class="glyphicon glyphicon-map-marker"></i> glyphicon glyphicon-map-marker</li>
					<li><i class="glyphicon glyphicon-adjust"></i> glyphicon glyphicon-adjust</li>
					<li><i class="glyphicon glyphicon-tint"></i> glyphicon glyphicon-tint</li>
					<li><i class="glyphicon glyphicon-edit"></i> glyphicon glyphicon-edit</li>
					<li><i class="glyphicon glyphicon-share"></i> glyphicon glyphicon-share</li>
					<li><i class="glyphicon glyphicon-check"></i> glyphicon glyphicon-check</li>
					<li><i class="glyphicon glyphicon-move"></i> glyphicon glyphicon-move</li>
					<li><i class="glyphicon glyphicon-step-backward"></i> glyphicon glyphicon-step-backward</li>
					<li><i class="glyphicon glyphicon-fast-backward"></i> glyphicon glyphicon-fast-backward</li>
				</ul>
			</div>
			<div class="col-md-3">
				<ul class="the-icons">
					<li><i class="glyphicon glyphicon-backward"></i> glyphicon glyphicon-backward</li>
					<li><i class="glyphicon glyphicon-play"></i> glyphicon glyphicon-play</li>
					<li><i class="glyphicon glyphicon-pause"></i> glyphicon glyphicon-pause</li>
					<li><i class="glyphicon glyphicon-stop"></i> glyphicon glyphicon-stop</li>
					<li><i class="glyphicon glyphicon-forward"></i> glyphicon glyphicon-forward</li>
					<li><i class="glyphicon glyphicon-fast-forward"></i> glyphicon glyphicon-fast-forward</li>
					<li><i class="glyphicon glyphicon-step-forward"></i> glyphicon glyphicon-step-forward</li>
					<li><i class="glyphicon glyphicon-eject"></i> glyphicon glyphicon-eject</li>
					<li><i class="glyphicon glyphicon-chevron-left"></i> glyphicon glyphicon-chevron-left</li>
					<li><i class="glyphicon glyphicon-chevron-right"></i> glyphicon glyphicon-chevron-right</li>
					<li><i class="glyphicon glyphicon-plus-sign"></i> glyphicon glyphicon-plus-sign</li>
					<li><i class="glyphicon glyphicon-minus-sign"></i> glyphicon glyphicon-minus-sign</li>
					<li><i class="glyphicon glyphicon-remove-sign"></i> glyphicon glyphicon-remove-sign</li>
					<li><i class="glyphicon glyphicon-ok-sign"></i> glyphicon glyphicon-ok-sign</li>
					<li><i class="glyphicon glyphicon-question-sign"></i> glyphicon glyphicon-question-sign</li>
					<li><i class="glyphicon glyphicon-info-sign"></i> glyphicon glyphicon-info-sign</li>
					<li><i class="glyphicon glyphicon-screenshot"></i> glyphicon glyphicon-screenshot</li>
					<li><i class="glyphicon glyphicon-remove-circle"></i> glyphicon glyphicon-remove-circle</li>
					<li><i class="glyphicon glyphicon-ok-circle"></i> glyphicon glyphicon-ok-circle</li>
					<li><i class="glyphicon glyphicon-ban-circle"></i> glyphicon glyphicon-ban-circle</li>
					<li><i class="glyphicon glyphicon-arrow-left"></i> glyphicon glyphicon-arrow-left</li>
					<li><i class="glyphicon glyphicon-arrow-right"></i> glyphicon glyphicon-arrow-right</li>
					<li><i class="glyphicon glyphicon-arrow-up"></i> glyphicon glyphicon-arrow-up</li>
					<li><i class="glyphicon glyphicon-arrow-down"></i> glyphicon glyphicon-arrow-down</li>
					<li><i class="glyphicon glyphicon-share-alt"></i> glyphicon glyphicon-share-alt</li>
					<li><i class="glyphicon glyphicon-resize-full"></i> glyphicon glyphicon-resize-full</li>
					<li><i class="glyphicon glyphicon-resize-small"></i> glyphicon glyphicon-resize-small</li>
					<li><i class="glyphicon glyphicon-plus"></i> glyphicon glyphicon-plus</li>
					<li><i class="glyphicon glyphicon-minus"></i> glyphicon glyphicon-minus</li>
					<li><i class="glyphicon glyphicon-asterisk"></i> glyphicon glyphicon-asterisk</li>
					<li><i class="glyphicon glyphicon-exclamation-sign"></i> glyphicon glyphicon-exclamation-sign</li>
					<li><i class="glyphicon glyphicon-gift"></i> glyphicon glyphicon-gift</li>
					<li><i class="glyphicon glyphicon-leaf"></i> glyphicon glyphicon-leaf</li>
					<li><i class="glyphicon glyphicon-fire"></i> glyphicon glyphicon-fire</li>
					<li><i class="glyphicon glyphicon-eye-open"></i> glyphicon glyphicon-eye-open</li>
				</ul>
			</div>
			<div class="col-md-3">
				<ul class="the-icons">
					<li><i class="glyphicon glyphicon-eye-close"></i> glyphicon glyphicon-eye-close</li>
					<li><i class="glyphicon glyphicon-warning-sign"></i> glyphicon glyphicon-warning-sign</li>
					<li><i class="glyphicon glyphicon-plane"></i> glyphicon glyphicon-plane</li>
					<li><i class="glyphicon glyphicon-calendar"></i> glyphicon glyphicon-calendar</li>
					<li><i class="glyphicon glyphicon-random"></i> glyphicon glyphicon-random</li>
					<li><i class="glyphicon glyphicon-comment"></i> glyphicon glyphicon-comment</li>
					<li><i class="glyphicon glyphicon-magnet"></i> glyphicon glyphicon-magnet</li>
					<li><i class="glyphicon glyphicon-chevron-up"></i> glyphicon glyphicon-chevron-up</li>
					<li><i class="glyphicon glyphicon-chevron-down"></i> glyphicon glyphicon-chevron-down</li>
					<li><i class="glyphicon glyphicon-retweet"></i> glyphicon glyphicon-retweet</li>
					<li><i class="glyphicon glyphicon-shopping-cart"></i> glyphicon glyphicon-shopping-cart</li>
					<li><i class="glyphicon glyphicon-folder-close"></i> glyphicon glyphicon-folder-close</li>
					<li><i class="glyphicon glyphicon-folder-open"></i> glyphicon glyphicon-folder-open</li>
					<li><i class="glyphicon glyphicon-resize-vertical"></i> glyphicon glyphicon-resize-vertical</li>
					<li><i class="glyphicon glyphicon-resize-horizontal"></i> glyphicon glyphicon-resize-horizontal</li>
					<li><i class="glyphicon glyphicon-hdd"></i> glyphicon glyphicon-hdd</li>
					<li><i class="glyphicon glyphicon-bullhorn"></i> glyphicon glyphicon-bullhorn</li>
					<li><i class="glyphicon glyphicon-bell"></i> glyphicon glyphicon-bell</li>
					<li><i class="glyphicon glyphicon-certificate"></i> glyphicon glyphicon-certificate</li>
					<li><i class="glyphicon glyphicon-thumbs-up"></i> glyphicon glyphicon-thumbs-up</li>
					<li><i class="glyphicon glyphicon-thumbs-down"></i> glyphicon glyphicon-thumbs-down</li>
					<li><i class="glyphicon glyphicon-hand-right"></i> glyphicon glyphicon-hand-right</li>
					<li><i class="glyphicon glyphicon-hand-left"></i> glyphicon glyphicon-hand-left</li>
					<li><i class="glyphicon glyphicon-hand-up"></i> glyphicon glyphicon-hand-up</li>
					<li><i class="glyphicon glyphicon-hand-down"></i> glyphicon glyphicon-hand-down</li>
					<li><i class="glyphicon glyphicon-circle-arrow-right"></i> glyphicon glyphicon-circle-arrow-right</li>
					<li><i class="a icon-circle-arrow-left s s"></i> glyphicon glyphicon-circle-arrow-left</li>
					<li><i class="glyphicon glyphicon-circle-arrow-up"></i> glyphicon glyphicon-circle-arrow-up</li>
					<li><i class="glyphicon glyphicon-circle-arrow-down"></i> glyphicon glyphicon-circle-arrow-down</li>
					<li><i class="glyphicon glyphicon-globe"></i> glyphicon glyphicon-globe</li>
					<li><i class="glyphicon glyphicon-wrench"></i> glyphicon glyphicon-wrench</li>
					<li><i class="glyphicon glyphicon-tasks"></i> glyphicon glyphicon-tasks</li>
					<li><i class="glyphicon glyphicon-filter"></i> glyphicon glyphicon-filter</li>
					<li><i class="glyphicon glyphicon-briefcase"></i> glyphicon glyphicon-briefcase</li>
					<li><i class="glyphicon glyphicon-fullscreen"></i> glyphicon glyphicon-fullscreen</li>
				</ul>
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
