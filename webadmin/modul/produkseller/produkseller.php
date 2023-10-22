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
				<span style="font-size : 30px;">Produk</span> beranda / produk
				</div>
				<div class="col-sm-4">
					<p class="pull-right">
					<button type="button" class="btn btn-info" data-toggle="tooltip" title="Tambah" onclick="window.location.href='?module=produkseller&act=tambahproduk';"><i class="glyphicon glyphicon-plus"></i></button>
					<button type="submit" class="btn btn-danger"  name="hapus"  data-toggle="tooltip" onClick="return confirm('Data yang sudah dihapus tidak bisa dikembalikan lagi. Apakah anda yakin ?')" title="Hapus"><i class="glyphicon glyphicon-trash"></i></button>
					<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=produkseller';"><i class="glyphicon glyphicon-refresh"></i></button>
					</p>
				</div>
			</div>
			<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><i class="glyphicon glyphicon-list"></i>   Data Produk</h4>
					
				</div>
				
				<div class="panel-body">	
					<?php
						if ( isset($_POST['hapus']) ){
							$id  = $_POST['id'];
							$jml = count($id);
							
							if ( $jml <= 0 ){
								
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>Peringatan!</strong> Silahkan Tandai Terlebih Dahulu Produk Yang Akan Anda Hapus';
								echo '</div>';
								
							} else {
								
								for ( $i = 0; $i <= $jml; $i++ ){
									$query1     = $db->prepare("DELETE FROM produk WHERE id_produk=?");
									$query2     = $db->prepare("SELECT produk.gambar, gambar_produk.gambar AS gambar_produk FROM gambar_produk, produk WHERE produk.id_produk=? AND gambar_produk.id_produk=produk.id_produk");
									$query3     = $db->prepare("DELETE FROM gambar_produk WHERE id_produk = ?");
									$query1->bind_param("i", $id_produk);
									$query2->bind_param("i", $id_produk);
									$query3->bind_param("i", $id_produk);
									$id_produk  = $id[$i];
									$query2->execute();
									$result2    = $query2->get_result();
									$row2       = $result2->fetch_assoc();
									unlink("../gambar/gambar_produk/$row2[gambar_produk]");
									$query3->execute();
									unlink("../gambar/produk/$row2[gambar]");
									unlink("../gambar/thumb_produk1/$row2[gambar]");
									$query1->execute();
									
								}
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> '.$jml.' Produk Berhasil Dihapus';
								echo '</div>';
								
							}
							
						}
						
					?>
					<div class="table-responsive">	
						<table  class="table table-bordered table-striped">
							<thead>
								<tr class="bg-warning">
									<th width="7%"><label><input type="checkbox" name="semua" id="semua" /></label> NO</th>
									<th>Gambar</th>
									<th>Nama Produk</th>
									<th>Berat (kg)</th>
									<th>Harga</th>
									<th>Diskon</th>
									<th>Stok</th>
									<th>Tanggal Masuk</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<?php
								include "../config/tgl_indo.php";
								$no             = 1;
								$query123       = $db->prepare("SELECT id_produk,gambar,nama_produk,berat,harga,diskon,stok,tgl_masuk FROM produk WHERE id_user = ? ORDER BY id_produk DESC");
								$query123->bind_param("i", $id_user);
								$id_user        = $_SESSION['id'];
								$query123->execute();
								$result123      = $query123->get_result();
								while ( $row123 = $result123->fetch_assoc() ){
									$harga123   = number_format($row123['harga'], 0,",",".");
									$tanggal    = tgl_indo( $row123['tgl_masuk'] );
									echo '<tr>';
									echo '<td><label><input type="checkbox" value="'.$row123['id_produk'].'" name="id[]"> '.$no.'</label></td>';
									echo '<td><img src="../gambar/thumb_produk1/'.$row123['gambar'].'" width="50%" height="50%" /></td>';
									echo '<td>'.$row123['nama_produk'].'</td>';
									echo '<td>'.$row123['berat'].' kg</td>';
									echo '<td>Rp. '.$harga123.'</td>';
									echo '<td>'.$row123['diskon'].' %</td>';
									echo '<td>'.$row123['stok'].'</td>';
									echo '<td>'.$tanggal.'</td>';
									echo '<td>';
									echo "<a href='?module=produkseller&act=ubahproduk&id=".$row123['id_produk']."&token=".md5(md5($row123['id_produk']).md5('H3ndri@27'))."' class='btn btn-primary' ><i class='fa fa-pencil'></i></a>";
									echo '</td>';
									echo '</tr>';
									$no++;
								}
								
							?>
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
				case "tambahproduk" :
				
			?>
			<form method="POST" action="" class="form-horizontal" enctype="multipart/form-data">
			<div class="row">
				<div class="col-sm-10">
				<span style="font-size : 30px;">Produk</span> beranda / tambah produk
				</div>
				<div class="col-sm-2">
					<p class="pull-right">
						<button class="btn btn-info" name="simpan" type="submit" data-toggle="tooltip" title="Simpan"><i class="fa fa-save"></i></button>
						<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=produkseller&act=tambahproduk';"><i class="fa fa-refresh"></i></button>
						<button type="button" class="btn btn-danger" data-toggle="tooltip" title="Kembali" onclick="window.location.href='?module=produkseller';"><i class="fa fa-share"></i></button>
					</p>
					
				</div>
			</div>
			<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><i class="glyphicon glyphicon-edit"></i>   Tambah Produk</h4>
					
				</div>
				<div class="panel-body">	 
					<?php
						
						if ( isset($_POST['simpan']) ){
							include "../config/seo.php";
							
							$kategori  = $_POST['kategori'];
							$produk    = $_POST['produk'];
							$seo       = seo($produk);
							$berat     = $_POST['berat'];
							$harga     = $_POST['harga'];
							$diskon    = $_POST['diskon'];
							$stok      = $_POST['stok'];
							$deskripsi = $_POST['deskripsi'];
							$foto      = $_FILES['foto']['name'];
							$tfoto     = $_FILES['foto']['type'];
							$tanggal   = date ("Y-m-d");
							$acak      = rand(1,99);
							$unik      = $acak.$foto;
							$id_user   = $_SESSION['id'];
							$aktif     = "T";
							
							
							
							if ( !preg_match("/^[0-9.]*$/",$berat) ){
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATRANN!</strong> Berat Barang Harus Angka';
								echo '</div>';
							} else if ( !preg_match("/^[0-9.]*$/",$harga) ){
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATRANN!</strong> Harga Barang Harus Angka';
								echo '</div>';
							} else if ( !preg_match("/^[0-9.]*$/",$stok) ){
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATRANN!</strong> Stok Barang Harus Angka';
								echo '</div>';
							} else if ( $tfoto != 'image/jpeg' AND $tfoto != 'image/jpg' AND $tfoto != 'image/png' ){
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATRANN!</strong> Gambar Barang Harus Berekstensi jpen/png';
								echo '</div>';
							} else {
								Uploadproduk($unik,$tfoto);
								$query  = $db->prepare("INSERT INTO produk (id_subkategori,id_user,nama_produk,produk_seo,deskripsi,harga,stok,berat,tgl_masuk,gambar,diskon,aktif) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
								$query->bind_param("iisssiisssis", $kategori,$id_user,$produk,$seo,$deskripsi,$harga,$stok,$berat,$tanggal,$unik,$diskon,$aktif);
								$query->execute();
								$id     = $db->insert_id;
								$file      = $_FILES['file']['name'];
								$jml       = count($file);
								for ($i = 0; $i <= ($jml-1); $i++){
									$rand      = rand(1,99);
									$file_name = $rand.$_FILES['file']['name'][$i];
									$tmp_name = $_FILES['file']['tmp_name'][$i];				
									move_uploaded_file($tmp_name, "../gambar/gambar_produk/".$file_name);				
									$query7 = $db->prepare("INSERT INTO gambar_produk (id_produk,gambar) VALUES (?,?)");
									$query7->bind_param("is", $id,$file_name);
									$query7->execute();
								}
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> Data Produk Anda Berhasil Disimpan. Produk Anda Akan Tampil Di Katalog Setelah Diperiksa Oleh Admin';
								echo '</div>';
								echo "<meta http-equiv='refresh' content='1; url=?module=produkseller&act=tambahproduk'>";
								
							}
						}
					?>
						<div class="form-group">
							<label class="control-label col-sm-3">Kategori Produk</label>
							<div class="col-sm-4">
								<select name="kategori" id="select4" class="form-control" required>
									<option value=""></option>
									<?php
										$query2 = $db->query("SELECT id_subkategori,nama_subkategori FROM subkategori_produk ORDER BY nama_subkategori ASC");
										while ( $row2 = $query2->fetch_assoc() ){
											echo '<option value='.$row2['id_subkategori'].'>'.$row2['nama_subkategori'].'</option>';
										}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Nama Produk</label>
							<div class="col-sm-4">
								<input type="text" value="<?php echo isset( $produk ) ? $produk : ""; ?>" name="produk" class="form-control" placeholder="Nama Produk" maxlength="100" required />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Berat (kg)</label>
							<div class="col-sm-2">
								<input type="text" value="<?php echo isset( $berat ) ? $berat : ""; ?>" name="berat" class="form-control" placeholder="Berat" maxlength="5" required />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Harga</label>
							<div class="col-sm-3">
								<input type="text" value="<?php echo isset( $harga ) ? $harga : ""; ?>" name="harga" class="form-control" placeholder="Harga" maxlength="20" required />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Diskon (%)</label>
							<div class="col-sm-2">
								<input type="text" value="<?php echo isset( $diskon ) ? $diskon : ""; ?>" name="diskon" class="form-control" placeholder="Diskon" maxlength="5" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Stok</label>
							<div class="col-sm-2">
								<input type="text" value="<?php echo isset( $stok ) ? $stok : ""; ?>" name="stok" class="form-control" placeholder="Stok" maxlength="5" required />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Deskripsi</label>
							<div class="col-sm-9">
								<textarea class="form-control" name="deskripsi" id="tinymce_basic" rows="10"><?php echo isset( $deskripsi ) ? $deskripsi : ""; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Gambar Depan</label>
							<div class="col-sm-4">
								<input type="file" name="foto" class="form-control" onchange="readURL(this);" required />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Gambar Lainnya</label>
							<div class="col-sm-4">
								<input name="file[]" class="form-control" type="file" id="file"/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3"></label>
							<div class="col-sm-4">
								<input type="button" id="add_more" class="btn btn-info btn-block" value="Tambah Gambar Lainnya"/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Preview Gambar Depan</label>
							<img id="preview_gambar" src="images/icon.png" class="img-thumbnail" />
						</div>
						
				</div>
			</div>
			</div>
			</form>
			<?php
				break;
				case "ubahproduk" :
				$token  = $_GET['token'];
				$cek    = md5(md5($_GET['id']).md5('H3ndri@27'));
				if ( $cek == $token ){
			?>
			<form method="POST" action="" class="form-horizontal" enctype="multipart/form-data">
			<div class="row">
				<div class="col-sm-10">
				<span style="font-size : 30px;">Produk</span> beranda / ubah produk
				</div>
				<div class="col-sm-2">
					<p class="pull-right">
						<button class="btn btn-info" name="ubah" type="submit" data-toggle="tooltip" title="Simpan"><i class="fa fa-save"></i></button>
						<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=produkseller&act=ubahproduk&id=<?php echo $_GET['id']; ?>&token=<?php echo $_GET['token']; ?>';"><i class="fa fa-refresh"></i></button>
						<button type="button" class="btn btn-danger" data-toggle="tooltip" title="Kembali" onclick="window.location.href='?module=produkseller';"><i class="fa fa-share"></i></button>
					</p>
					
				</div>
			</div>
			<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><i class="glyphicon glyphicon-edit"></i>   Ubah Produk</h4>
					
				</div>
				<div class="panel-body">	 
					<?php
						
						$query1 = $db->prepare("SELECT id_subkategori, nama_produk, deskripsi, harga, stok, berat, diskon, gambar FROM produk WHERE id_produk = ?");
						$query1->bind_param("i", $id_produk);
						$id_produk = $_GET['id'];
						$query1->execute();
						$result    = $query1->get_result();
						$row1      = $result->fetch_assoc();
						
						if ( isset($_POST['ubah']) ){
							include "../config/seo.php";
							$kategori  = $_POST['kategori'];
							$produk    = $_POST['produk'];
							$seo       = seo($produk);
							$berat     = $_POST['berat'];
							$harga     = $_POST['harga'];
							$diskon    = $_POST['diskon'];
							$stok      = $_POST['stok'];
							$deskripsi = $_POST['deskripsi'];
							$foto      = $_FILES['foto']['name'];
							$tfoto     = $_FILES['foto']['type'];
							$acak      = rand(1,99);
							$unik      = $acak.$foto;
							$id_produk = $_GET['id'];
							
							
							
							if ( !preg_match("/^[0-9.]*$/",$berat) ){
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATRANN!</strong> Berat Barang Harus Angka';
								echo '</div>';
							} else if ( !preg_match("/^[0-9.]*$/",$harga) ){
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATRANN!</strong> Harga Barang Harus Angka';
								echo '</div>';
							} else if ( !preg_match("/^[0-9.]*$/",$stok) ){
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATRANN!</strong> Stok Barang Harus Angka';
								echo '</div>';
							} else {								
								if ( empty($foto) ){
									$query5 = $db->prepare("UPDATE produk SET nama_produk = ?, produk_seo = ?, deskripsi = ?, berat = ?, harga = ?, diskon = ?, stok = ?, id_subkategori = ? WHERE id_produk = ?");
									$query5->bind_param("ssssiiiii", $produk, $seo, $deskripsi, $berat, $harga, $diskon, $stok, $kategori, $id_produk);
									$query5->execute();
								} else {
									if ( $tfoto != 'image/jpeg' AND $tfoto != 'image/jpg' AND $tfoto != 'image/png' ){
										echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
										echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
										echo '<strong>PERINGATRANN!</strong> Gambar Barang Harus Berekstensi jpen/png';
										echo '</div>';
									} else {
										Uploadproduk($unik,$tfoto);
										unlink("../gambar/thumb_produk1/$row1[gambar]");
										unlink("../gambar/produk/$row1[gambar]");
										$query5 = $db->prepare("UPDATE produk SET nama_produk = ?, produk_seo = ?, deskripsi = ?, berat = ?, harga = ?, diskon = ?, stok = ?, id_subkategori = ?, gambar = ? WHERE id_produk = ?");
										$query5->bind_param("ssssiiiisi", $produk, $seo, $deskripsi, $berat, $harga, $diskon, $stok, $kategori, $unik, $id_produk);
										$query5->execute();
									}
								}
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> Data Berhasil Diubah';
								echo '</div>';	
								echo "<meta http-equiv='refresh' content='1; url=?module=produkseller&act=ubahproduk&id=$_GET[id]&token=$_GET[token]'>";
							}
							
						}
					
					?>
						<div class="form-group">
							<label class="control-label col-sm-3">Kategori Produk</label>
							<div class="col-sm-4">
								<select name="kategori" id="select4" class="form-control" required>
									<option value=""></option>
									<?php
										$query2       = $db->query("SELECT id_subkategori,nama_subkategori FROM subkategori_produk ORDER BY nama_subkategori ASC");
										while ( $row2 = $query2->fetch_assoc() ){
											$pilih    = ( $row1['id_subkategori'] == $row2['id_subkategori'] ) ? "selected" : "";
											echo '<option value='.$row2['id_subkategori'].' '.$pilih.'>'.$row2['nama_subkategori'].'</option>';
										}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Nama Produk</label>
							<div class="col-sm-4">
								<input type="text" value="<?php echo $row1['nama_produk']; ?>" name="produk" class="form-control" placeholder="Nama Produk" maxlength="100" required />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Berat (kg)</label>
							<div class="col-sm-2">
								<input type="text" value="<?php echo $row1['berat']; ?>" name="berat" class="form-control" placeholder="Berat" maxlength="5" required />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Harga</label>
							<div class="col-sm-3">
								<input type="text" value="<?php echo $row1['harga']; ?>" name="harga" class="form-control" placeholder="Harga" maxlength="20" required />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Diskon (%)</label>
							<div class="col-sm-2">
								<input type="text" value="<?php echo $row1['diskon']; ?>" name="diskon" class="form-control" placeholder="Diskon" maxlength="5" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Stok</label>
							<div class="col-sm-2">
								<input type="text" value="<?php echo $row1['stok'];?>" name="stok" class="form-control" placeholder="Stok" maxlength="5" required />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Deskripsi</label>
							<div class="col-sm-9">
								<textarea class="form-control" name="deskripsi" id="tinymce_basic" rows="10"><?php echo $row1['deskripsi']; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Gambar Depan </label>
							<div class="col-sm-4">
								<img src="../gambar/thumb_produk1/<?php echo $row1['gambar']; ?>" width="40%" height="40%" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Ubah Gambar Depan</label>
							<div class="col-sm-4">
								<input type="file" name="foto" class="form-control" onchange="readURL(this);" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Preview Gambar Depan</label>
							<img id="preview_gambar" src="images/icon.png" class="img-thumbnail" />
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
