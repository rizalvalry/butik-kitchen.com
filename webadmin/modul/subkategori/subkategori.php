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
				<span style="font-size : 30px;">Sub-Kategori Produk</span> beranda / sub-kategori produk
				</div>
				<div class="col-sm-4">
					<p class="pull-right">
					<button type="button" class="btn btn-info" data-toggle="tooltip" title="Tambah" onclick="window.location.href='?module=subkategori&act=tambahsubkategori';"><i class="glyphicon glyphicon-plus"></i></button>
					<button type="submit" class="btn btn-success"  name="aktif"  data-toggle="tooltip"  title="Aktfkan"><i class="glyphicon glyphicon-ok"></i></button>
					<button type="submit" class="btn btn-warning"  name="nonaktif"  data-toggle="tooltip"  title="Nonaktifkan"><i class="glyphicon glyphicon-remove"></i></button>
					<button type="submit" class="btn btn-danger"  name="hapus"  data-toggle="tooltip" onClick="return confirm('Data yang sudah dihapus tidak bisa dikembalikan lagi. Apakah anda yakin ?')" title="Hapus"><i class="glyphicon glyphicon-trash"></i></button>
					<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=subkategori';"><i class="glyphicon glyphicon-refresh"></i></button>
					</p>
				</div>
			</div>
			<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><i class="glyphicon glyphicon-list"></i>   Data Sub-Kategori Produk</h4>
					
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
									
									$query = $db->prepare("DELETE FROM subkategori_produk WHERE id_subkategori=?");
									$query->bind_param("i", $id_subkategori);
									$id_subkategori = $id[$i];
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
									
									$query = $db->prepare("UPDATE subkategori_produk SET aktif=? WHERE id_subkategori=?");
									$query->bind_param("si", $aktif,$id_subkategori);
									$id_subkategori = $id[$i];
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
									
									$query = $db->prepare("UPDATE subkategori_produk SET aktif=? WHERE id_subkategori=?");
									$query->bind_param("si", $aktif,$id_subkategori);
									$id_subkategori = $id[$i];
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
									<th>Nama Kategori Produk</th>
									<th>Nama Sub-Kategori Produk</th>
									<th>Aktif</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$no     = 1;
									$query5 = $db->query("SELECT kategori_produk.nama_kategori,subkategori_produk.id_subkategori,subkategori_produk.nama_subkategori,subkategori_produk.aktif FROM subkategori_produk LEFT JOIN kategori_produk ON subkategori_produk.id_kategori=kategori_produk.id_kategori");
									while( $row    = $query5->fetch_assoc()){
								?>
								<tr>
									<td><label><input type="checkbox" name="id[]" value="<?php echo $row['id_subkategori']; ?>" /> <?php echo $no; ?></label></td>
									<td><?php echo $row['nama_kategori']; ?></td>
									<td><?php echo $row['nama_subkategori']; ?></td>
									<td><?php echo ( $row['aktif'] == "Y" ) ? "Aktif" : "Tidak Aktif"; ?></td>
									<td><a href="?module=subkategori&act=ubahsubkategori&id=<?php echo $row['id_subkategori']; ?>&token=<?php echo md5(md5($row['id_subkategori']).md5('H3ndri@27')); ?>" class="btn btn-primary" data-toggle="tooltip"  title="Ubah" role="button"><i class="fa fa-pencil"></i></a></td>
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
				case "tambahsubkategori" :
			?>
			
			<form method="POST" action="" class="form-horizontal" enctype="multipart/form-data">
			<div class="row">
				<div class="col-sm-10">
				<span style="font-size : 30px;">Sub-Kategori Produk</span> beranda / tambah sub-kategori produk
				</div>
				<div class="col-sm-2">
					<p class="pull-right">
						<button class="btn btn-info" name="tambah" type="submit" data-toggle="tooltip" title="Simpan"><i class="fa fa-save"></i></button>
						<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=subkategori&act=tambahsubkategori';"><i class="fa fa-refresh"></i></button>
						<button type="button" class="btn btn-danger" data-toggle="tooltip" title="Kembali" onclick="window.location.href='?module=subkategori';"><i class="fa fa-share"></i></button>
					</p>
					
				</div>
			</div>
			
			<div class="row">
			<div class="panel-group">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><i class="glyphicon glyphicon-pencil"></i>   Tambah Sub-Kategori Produk</h4>\
					
				</div>
				<div class="panel-body">	 
					<?php
						
						
						if ( isset($_POST['tambah']) ){
							include "../config/seo.php";
							
							$kategori    = $_POST['kategori'];
							$subkategori = $_POST['subkategori'];
							$seo     	 = seo($subkategori);
							$aktif       = $_POST['aktif'];
							
							$query    = $db->prepare("INSERT INTO subkategori_produk (id_kategori,nama_subkategori,subkategori_seo,aktif) VALUES (?,?,?,?)");
							$query->bind_param("isss", $kategori,$subkategori,$seo,$aktif);
							$query->execute();
							
							echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
							echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
							echo '<strong>SUKSES!</strong> Data Berhasil Disimpan';
							echo '</div>';
							echo "<meta http-equiv='refresh' content='1; url=?module=subkategori&act=tambahsubkategori'>";
							
																			
						}	
					
					?>
						
						<div class="form-group">
							<label class="control-label col-sm-4">Kategori Produk</label>
							<div class="col-sm-4">
								<select name="kategori" class="form-control" id="select2" >
									<option value=""></option>
									<?php
										$query2 = $db->query("SELECT id_kategori,nama_kategori FROM kategori_produk ORDER BY nama_kategori ASC");
										while( $row2 = $query2->fetch_assoc() ){
											echo '<option value="'.$row2['id_kategori'].'">'.$row2['nama_kategori'].'</option>';
										}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Sub-Kategori Produk</label>
							<div class="col-sm-4">
								<input type="text"  class="form-control" name="subkategori" placeholder="Sub-Kategori Produk" maxlength="50" required autofocus />
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
						
				</div>
			</div>
			</div>
			</form>
			
			
			<?php
				break;
				case "ubahsubkategori" :
				$token  = $_GET['token'];
				$cek    = md5(md5($_GET['id']).md5('H3ndri@27'));
				if ( $cek == $token ){
			?>
			<form method="POST" action="" class="form-horizontal" enctype="multipart/form-data">
			<div class="row">
				<div class="col-sm-10">
				<span style="font-size : 30px;">Sub-Kategori Produk</span> beranda / ubah sub-kategori produk
				</div>
				<div class="col-sm-2">
					<p class="pull-right">
						<button class="btn btn-info" name="ubah" type="submit" data-toggle="tooltip" title="Simpan"><i class="fa fa-save"></i></button>
						<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=subkategori&act=ubahsubkategori&id=<?php echo $_GET['id']; ?>&token=<?php echo $_GET['token']; ?>';"><i class="fa fa-refresh"></i></button>
						<button type="button" class="btn btn-danger" data-toggle="tooltip" title="Kembali" onclick="window.location.href='?module=subkategori';"><i class="fa fa-share"></i></button>
					</p>
					
				</div>
			</div>
			<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><i class="glyphicon glyphicon-edit"></i>   Ubah Sub-Kategori Produk</h4>
					
				</div>
				<div class="panel-body">	 
					<?php
						
						$query1 = $db->prepare("SELECT id_kategori,nama_subkategori FROM subkategori_produk WHERE id_subkategori=?");
						$query1->bind_param("i", $id_kategori);
						$id_kategori = $_GET['id'];
						$query1->execute();
						$result = $query1->get_result();
						$row    = $result->fetch_assoc();
						
						if ( isset($_POST['ubah']) ){
							
							include "../config/seo.php";
							
							$kategori       = $_POST['kategori'];
							$subkategori    = $_POST['subkategori'];
							$seo            = seo($subkategori);
							$id_subkategori = $_GET['id'];
							
							$query    = $db->prepare("UPDATE subkategori_produk SET id_kategori=?,nama_subkategori=?,subkategori_seo=? WHERE id_subkategori=? ");
							$query->bind_param("issi", $kategori,$subkategori,$seo,$id_subkategori);
							$query->execute();
							
							echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
							echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
							echo '<strong>SUKSES!</strong> Data Berhasil Diubah';
							echo '</div>';
							echo "<meta http-equiv='refresh' content='1; url=?module=subkategori&act=ubahsubkategori&id=$_GET[id]&token=$_GET[token]'>";
							
						}
					
					?>
						<div class="form-group">
							<label class="control-label col-sm-4">Kategori Produk</label>
							<div class="col-sm-4">
								<select name="kategori" class="form-control" id="select2" >
									<option value=""></option>
									<?php
										$query2 = $db->query("SELECT id_kategori,nama_kategori FROM kategori_produk ORDER BY nama_kategori ASC");
										while( $row2 = $query2->fetch_assoc() ){
											$pilih   = ( $row['id_kategori'] == $row2['id_kategori'] ) ? "selected" : "";
											echo '<option value="'.$row2['id_kategori'].'"'.$pilih.'>'.$row2['nama_kategori'].'</option>';
										}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Sub-Kategori Produk</label>
							<div class="col-sm-4">
								<input type="text" value="<?php echo $row['nama_subkategori']; ?>" class="form-control" name="subkategori" maxlength="50" required />
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
