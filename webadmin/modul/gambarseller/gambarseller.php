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
				<span style="font-size : 30px;">Gambar Produk</span> beranda / gambar produk
				</div>
				<div class="col-sm-4">
					<p class="pull-right">
					<button type="button" class="btn btn-info" data-toggle="tooltip" title="Tambah" onclick="window.location.href='?module=gambarseller&act=tambahgambarproduk';"><i class="glyphicon glyphicon-plus"></i></button>
					<button type="submit" class="btn btn-danger"  name="hapus"  data-toggle="tooltip" onClick="return confirm('Data yang sudah dihapus tidak bisa dikembalikan lagi. Apakah anda yakin ?')" title="Hapus Kustomer"><i class="glyphicon glyphicon-trash"></i></button>
					<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=gambarseller';"><i class="glyphicon glyphicon-refresh"></i></button>
					</p>
				</div>
			</div>
			<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><i class="glyphicon glyphicon-list"></i>   Data Gambar Produk</h4>
					
				</div>
				
				<div class="panel-body">	
					<?php
						
						if ( isset($_POST['hapus']) ){
							$id  = $_POST['id'];
							$jml = count($id);
							
							if ( $jml <= 0 ){
								
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>Peringatan!</strong> Silahkan Tandai Terlebih Dahulu kustomer Yang Akan Anda Hapus';
								echo '</div>';
								
							} else {
								
								for ( $i = 0; $i <= $jml; $i++ ){
									$query     = $db->prepare("DELETE FROM gambar_produk WHERE id_gambar=?");
									$query1    = $db->prepare("SELECT gambar FROM gambar_produk WHERE id_gambar = ?");
									$query->bind_param("i", $id_gambar);
									$query1->bind_param("i", $id_gambar);
									$id_gambar = $id[$i];
									$query1->execute();
									$result1   = $query1->get_result();
									$row11     = $result1->fetch_assoc();
									unlink("../gambar/gambar_produk/$row11[gambar]");									
									$query->execute();
								}
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> '.$jml.' Gambar Produk Berhasil Dihapus';
								echo '</div>';
								
							}
							
						}
						
					?>
					<div class="table-responsive">	
						<table class="table table-bordered table-striped">
							<thead>
								<tr class="bg-warning">
									<th width="7%"><label><input type="checkbox" name="semua" id="semua" /></label> NO</th>
									<th>Nama Produk</th>
									<th>Gambar</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$no              = 1;
								$query1234       = $db->query("SELECT gambar_produk.id_gambar, gambar_produk.gambar, produk.nama_produk FROM gambar_produk INNER JOIN produk ON gambar_produk.id_produk=produk.id_produk WHERE produk.id_user = '$_SESSION[id]' ORDER BY produk.nama_produk ASC");
								while ( $row1234 = $query1234->fetch_assoc() ){
									echo '<tr>';
									echo '<td><label><input type="checkbox" value="'.$row1234['id_gambar'].'" name="id[]"> '.$no.'</label></td>';
									echo '<td>'.$row1234['nama_produk'].'</td>';
									echo '<td><img src="../gambar/gambar_produk/'.$row1234['gambar'].'" width="15%" height="15%" /></td>';
									echo '<td>';
									echo "<a href='?module=gambarseller&act=ubahgambarproduk&id=".$row1234['id_gambar']."&token=".md5(md5($row1234['id_gambar']).md5('H3ndri@27'))."' class='btn btn-primary' ><i class='fa fa-pencil'></i></a>";
									echo '</td>';
									echo '</tr>';
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
				case "tambahgambarproduk" :
			?>
			<form method="POST" action="" class="form-horizontal" enctype="multipart/form-data">
			<div class="row">
				<div class="col-sm-10">
				<span style="font-size : 30px;">Gambar Produk</span> beranda / tambah gambar
				</div>
				<div class="col-sm-2">
					<p class="pull-right">
						<button class="btn btn-info" name="tambah" type="submit" data-toggle="tooltip" title="Simpan"><i class="fa fa-save"></i></button>
						<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=gambarseller&act=tambahgambarproduk';"><i class="fa fa-refresh"></i></button>
						<button type="button" class="btn btn-danger" data-toggle="tooltip" title="Kembali" onclick="window.location.href='?module=gambarseller';"><i class="fa fa-share"></i></button>
					</p>
					
				</div>
			</div>
			<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><i class="glyphicon glyphicon-edit"></i>   Tambah Gambar</h4>
					
				</div>
				<div class="panel-body">	 
					<?php						
						if ( isset($_POST['tambah']) ){
							$foto   = $_FILES['foto']['name'];
							$tfoto  = $_FILES['foto']['type'];
							$lfoto  = $_FILES['foto']['tmp_name'];
							$produk = $_POST['produk'];
							$folder = "../gambar/gambar_produk/";
							$acak   = rand(1,99);
							$unik   = $acak.$foto;
							
							if ( empty($produk) ){
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATRANN!</strong>Produk Tidak Boleh Kosong';
								echo '</div>';
							} else if ( empty($foto) ){
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATRANN!</strong> Gambar Produk Tidak Boleh Kosong';
								echo '</div>';
							} else if ( $tfoto != 'image/jpg' AND $tfoto != 'image/jpeg' AND $tfoto != 'image/png' ){
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATRANN!</strong> Gambar Produk Harus Berekstensi jpen/png';
								echo '</div>';
							} else {
								move_uploaded_file($lfoto, $folder.$unik);
								$query7 = $db->prepare("INSERT INTO gambar_produk (gambar, id_produk) VALUES (?,?)");
								$query7->bind_param("si", $unik, $produk);
								$query7->execute();
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSESS!</strong> Data Berhasil Disimpan';
								echo '</div>';
								echo "<meta http-equiv='refresh' content='1; url=?module=gambarseller&act=tambahgambarproduk'>";
							}
							
						}
					
					?>
						<div class="form-group">
							<label class="control-label col-sm-4">Nama Produk</label>
							<div class="col-sm-4">
								<select name="produk" class="form-control" id="select5">
									<option value=""></option>
									<?php
										$query5       = $db->query("SELECT id_produk, nama_produk FROM produk WHERE id_user = '$_SESSION[id]' ORDER BY nama_produk ASC");
										while ( $row5 = $query5->fetch_assoc() ){
											echo '<option value="'.$row5['id_produk'].'">'.$row5['nama_produk'].'</option>';
										}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Gambar Produk</label>
							<div class="col-sm-5">
								<input type="file" class="form-control" name="foto" required />
							</div>
						</div>
				</div>
			</div>
			</div>
			</form>
			<?php
				break;
				case "ubahgambarproduk" :
				$token  = $_GET['token'];
				$cek    = md5(md5($_GET['id']).md5('H3ndri@27'));
				if ( $cek == $token ){
			?>
			<form method="POST" action="" class="form-horizontal" enctype="multipart/form-data">
			<div class="row">
				<div class="col-sm-10">
				<span style="font-size : 30px;">Gambar Produk</span> beranda / ubah gambar
				</div>
				<div class="col-sm-2">
					<p class="pull-right">
						<button class="btn btn-info" name="ubah" type="submit" data-toggle="tooltip" title="Simpan"><i class="fa fa-save"></i></button>
						<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=gambarseller&act=ubahgambarproduk&id=<?php echo $_GET['id']; ?>&token=<?php echo $_GET['token']; ?>';"><i class="fa fa-refresh"></i></button>
						<button type="button" class="btn btn-danger" data-toggle="tooltip" title="Kembali" onclick="window.location.href='?module=gambarseller';"><i class="fa fa-share"></i></button>
					</p>
					
				</div>
			</div>
			<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><i class="glyphicon glyphicon-edit"></i>   Ubah Gambar</h4>
					
				</div>
				<div class="panel-body">	 
					<?php
						
						$query1    = $db->prepare("SELECT id_produk, gambar FROM gambar_produk WHERE id_gambar = ?");
						$query1->bind_param("i", $id_gambar);
						$id_gambar = $_GET['id'];
						$query1->execute();
						$result    = $query1->get_result();
						$row1      = $result->fetch_assoc();
						
						if ( isset($_POST['ubah']) ){
							$foto      = $_FILES['foto']['name'];
							$tfoto     = $_FILES['foto']['type'];
							$lfoto     = $_FILES['foto']['tmp_name'];
							$produk    = $_POST['produk'];
							$folder    = "../gambar/gambar_produk/";
							$acak      = rand(1,99);
							$unik      = $acak.$foto;
							$id_produk = $_GET['id'];
							
							if ( empty($produk) ){
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATRANN!</strong>Produk Tidak Boleh Kosong';
								echo '</div>';
							} else if ( empty($foto) ){
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATRANN!</strong> Gambar Produk Tidak Boleh Kosong';
								echo '</div>';
							} else if ( $tfoto != 'image/jpg' AND $tfoto != 'image/jpeg' AND $tfoto != 'image/png' ){
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATRANN!</strong> Gambar Produk Harus Berekstensi jpen/png';
								echo '</div>';
							} else {
								move_uploaded_file($lfoto, $folder.$unik);
								unlink("../gambar/gambar_produk/$row1[gambar]");
								$query7 = $db->prepare("UPDATE gambar_produk SET id_produk = ?, gambar = ? WHERE id_gambar = ?");
								$query7->bind_param("isi", $produk, $unik, $id_produk);
								$query7->execute();
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSESS!</strong> Data Berhasil Diubah';
								echo '</div>';
								echo "<meta http-equiv='refresh' content='1; url=?module=gambarseller&act=ubahgambarproduk&id=$_GET[id]&token=$_GET[token]'>";
							}
						}
					
					?>
						<div class="form-group">
							<label class="control-label col-sm-4">Nama Produk</label>
							<div class="col-sm-4">
								<select name="produk" class="form-control" id="select5">
									<option value=""></option>
									<?php
										$query5       = $db->query("SELECT id_produk, nama_produk FROM produk WHERE id_user = '$_SESSION[id]' ORDER BY nama_produk ASC");
										while ( $row5 = $query5->fetch_assoc() ){
											$pilih    = ( $row1['id_produk'] == $row5['id_produk'] ) ? "selected" : "";
											echo '<option value="'.$row5['id_produk'].'"'.$pilih.' >'.$row5['nama_produk'].'</option>';
										}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Gambar Produk</label>
							<div class="col-sm-5">
								<img src="../gambar/gambar_produk/<?php echo $row1['gambar']; ?>" width="30%" height="30%" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Ubah Gambar Produk</label>
							<div class="col-sm-5">
								<input type="file" class="form-control" name="foto" required />
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
