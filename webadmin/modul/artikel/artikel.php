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
				<span style="font-size : 30px;">Artikel</span> beranda / artikel
				</div>
				<div class="col-sm-4">
					<p class="pull-right">
					<button type="button" class="btn btn-info" data-toggle="tooltip" title="Tambah" onclick="window.location.href='?module=artikel&act=tambahartikel';"><i class="glyphicon glyphicon-plus"></i></button>
					<button type="button" class="btn btn-success" data-toggle="tooltip" title="Impor" onclick="window.location.href='?module=artikel&act=imporartikel';"><i class="glyphicon glyphicon-upload"></i></button>
					<button type="submit" class="btn btn-danger"  name="hapus"  data-toggle="tooltip" onClick="return confirm('Data yang sudah dihapus tidak bisa dikembalikan lagi. Apakah anda yakin ?')" title="Hapus"><i class="glyphicon glyphicon-trash"></i></button>
					<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=artikel';"><i class="glyphicon glyphicon-refresh"></i></button>
					</p>
				</div>
			</div>
			<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><i class="glyphicon glyphicon-list"></i>   Data Artikel</h4>
					
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
									$query1     = $db->prepare("DELETE FROM artikel WHERE id_artikel=?");
									$query2     = $db->prepare("SELECT gambar FROM artikel WHERE id_artikel = ?");
									$query3     = $db->prepare("DELETE FROM komentar WHERE id_artikel = ?");
									$query1->bind_param("i", $id_artikel);
									$query2->bind_param("i", $id_artikel);
									$query3->bind_param("i", $id_artikel);
									$id_artikel  = $id[$i];
									$query2->execute();
									$result2    = $query2->get_result();
									$row2       = $result2->fetch_assoc();
									unlink("../gambar/artikel/$row2[gambar]");
									unlink("../gambar/thumb_artikel/$row2[gambar]");
									$query3->execute();
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
						<table id="artikel" class="table table-bordered table-striped">
							<thead>
								<tr class="bg-warning">
									<th width="7%"><label><input type="checkbox" name="semua" id="semua" /></label> NO</th>
									<th>Judul Artikel</th>
									<th>Tanggal Posting</th>
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
				case "tambahartikel" :
				
			?>
			<form method="POST" action="" class="form-horizontal" enctype="multipart/form-data">
			<div class="row">
				<div class="col-sm-10">
				<span style="font-size : 30px;">Artikel</span> beranda / tambah artikel
				</div>
				<div class="col-sm-2">
					<p class="pull-right">
						<button class="btn btn-info" name="simpan" type="submit" data-toggle="tooltip" title="Simpan"><i class="fa fa-save"></i></button>
						<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=artikel&act=tambahartikel';"><i class="fa fa-refresh"></i></button>
						<button type="button" class="btn btn-danger" data-toggle="tooltip" title="Kembali" onclick="window.location.href='?module=artikel';"><i class="fa fa-share"></i></button>
					</p>
					
				</div>
			</div>
			<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><i class="glyphicon glyphicon-edit"></i>   Tambah Artikel</h4>
					
				</div>
				<div class="panel-body">	 
					<?php
						
						if ( isset($_POST['simpan']) ){
							include "../config/seo.php";
							date_default_timezone_set('Asia/Jakarta'); // PHP 6 mengharuskan penyebutan timezone.
							$hari        = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
							$kategori    = $_POST['kategori'];
							$judul       = $_POST['judul'];
							$judul_seo   = seo($judul);
							$isi         = $_POST['isi'];
							$foto        = $_FILES['foto']['name'];
							$tfoto       = $_FILES['foto']['type'];
							$tanggal     = date("Y-m-d");
							$jam         = date("H:i:s");
							$hari_ini    = date("w");
							$simpan_hari = $hari[$hari_ini];
							$id_user     = $_SESSION['id'];
							$acak        = rand (1,99);
							$unik        = $acak.$foto;
							$tag         = $_POST['tag'];
							$jumlah_tag  = count($tag);
							if ( !empty($tag) ){
								$tag_seo = implode(",", $tag);
							}
							if ( empty($judul) ){
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATRANN!</strong> Judul Artikel Tidak Boleh Kososng';
								echo '</div>';
							} else if ( empty($kategori) ){
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATRANN!</strong> Kategori Artikel Tidak Boleh Kososng';
								echo '</div>';
							} else if ( empty($isi) ){
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATRANN!</strong> Isi Artikel Tidak Boleh Kososng';
								echo '</div>';
							} else if ( empty($foto) ){
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATRANN!</strong> Gambar Artikel Tidak Boleh Kososng';
								echo '</div>';
							} else if ( $tfoto != 'image/jpg' AND $tfoto != 'image/jpeg' AND $tfoto != 'image/png' ){
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATRANN!</strong> Gambar Harus Berekstensi jpg/png';
								echo '</div>';
							} else {
								Uploadartikel($unik,$tfoto);
								$query7 = $db->prepare("INSERT INTO artikel (id_user, id_kategori, judul_artikel, judul_seo, isi_artikel, hari, tanggal, jam, gambar, tag) VALUES (?,?,?,?,?,?,?,?,?,?)");
								$query7->bind_param("sissssssss", $id_user, $kategori, $judul, $judul_seo, $isi, $simpan_hari, $tanggal, $jam, $unik, $tag_seo);
								$query7->execute();
								for ( $i = 0; $i <= $jumlah_tag; $i++ ){
									$db->query("UPDATE tag_artikel SET count = count + 1 WHERE tag_seo = '$tag[$i]'");
								}
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> Data Berhasil Disimpan';
								echo '</div>';
								echo "<meta http-equiv='refresh' content='1; url=?module=artikel&act=tambahartikel'>";
							}
							
						}
					?>
						<div class="form-group">
							<label class="control-label col-sm-3">Kategori Artikel</label>
							<div class="col-sm-4">
								<select name="kategori" id="select6" class="form-control" required>
									<option value=""></option>
									<?php
										$query2 = $db->query("SELECT id_kategori,nama_kategori FROM kategori_artikel ORDER BY nama_kategori ASC");
										while ( $row2 = $query2->fetch_assoc() ){
											echo '<option value="'.$row2['id_kategori'].'">'.$row2['nama_kategori'].'</option>';
										}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Judul Artikel</label>
							<div class="col-sm-4">
								<input type="text" value="<?php echo isset( $judul ) ? $judul : ""; ?>" name="judul" class="form-control" placeholder="Judul Artikel" maxlength="100" required />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Isi Artikel</label>
							<div class="col-sm-9">
								<textarea class="form-control" name="isi" id="tinymce_basic" rows="10"><?php echo isset( $isi ) ? $isi : ""; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Gambar Artikel</label>
							<div class="col-sm-4">
								<input type="file" name="foto" class="form-control" onchange="readURL(this);" required/>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Tag Artikel</label>
							<div class="col-sm-8">
								<?php
									$query8 = $db->query("SELECT nama_tag, tag_seo FROM tag_artikel ORDER BY nama_tag ASC");
									while ( $row8 = $query8->fetch_assoc() ){
										echo '<label class="checkbox-inline"> <input type="checkbox" name="tag[]" value="'.$row8['tag_seo'].'"/> '.$row8['nama_tag'].' </label>';
									}
								?>								
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Preview Gambar</label>
							<img id="preview_gambar" src="images/icon.png" class="img-thumbnail" />
						</div>
						
				</div>
			</div>
			</div>
			</form>
			<?php
				break;
				case "imporartikel" :
				
			?>
			<form method="POST" action="" class="form-horizontal" enctype="multipart/form-data">
			<div class="row">
				<div class="col-sm-10">
				<span style="font-size : 30px;">Artikel</span> beranda / impor artikel
				</div>
				<div class="col-sm-2">
					<p class="pull-right">
						<button class="btn btn-info" name="tambah" type="submit" data-toggle="tooltip" title="Simpan"><i class="fa fa-save"></i></button>
						<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=artikel&act=imporartikel';"><i class="fa fa-refresh"></i></button>
						<button type="button" class="btn btn-danger" data-toggle="tooltip" title="Kembali" onclick="window.location.href='?module=artikel';"><i class="fa fa-share"></i></button>
					</p>
					
				</div>
			</div>
			<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><i class="glyphicon glyphicon-edit"></i>   Impor Artikel</h4>
					
				</div>
				<div class="panel-body">	 
					<?php
						if ( isset($_POST['tambah']) ){
							require "../config/excel.php";
							$target = basename($_FILES['data']['name']) ;
							move_uploaded_file($_FILES['data']['tmp_name'], $target);
							$data = new Spreadsheet_Excel_Reader($_FILES['data']['name'],false);   
							//menghitung jumlah baris file xls
							$baris = $data->rowcount($sheet_index=0);
							//import data excel mulai baris ke-2 (karena tabel xls ada header pada baris 1)
							$sukses1    = 0;
							$gagal2     = 0;
							for ($i = 2; $i <= $baris; $i++){
								//membaca data (kolom ke-1 sd terakhir)
								$id_kategori        = $data->val($i, 1);
								$id_user        = $data->val($i, 2);
								$judul_artikel        = $data->val($i, 3);
								$judul_seo        = $data->val($i, 4);
								$headline        = $data->val($i, 5);
								$isi_artikel        = $data->val($i, 6);
								$hari        = $data->val($i, 7);
								$tanggal        = $data->val($i, 8);
								$jam        = $data->val($i, 9);
								$dibaca        = $data->val($i, 10);
								
								$query2 = $db->prepare("INSERT INTO artikel (id_kategori,id_user,judul_artikel,judul_seo,headline,isi_artikel,hari,tanggal,jam,dibaca) VALUES (?,?,?,?,?,?,?,?,?,?)");
								$query2->bind_param("iisssssssi", $id_kategori,$id_user,$judul_artikel,$judul_seo,$headline,$isi_artikel,$hari,$tanggal,$jam,$dibaca); 
								$save   = $query2->execute();
								if ( $save ){
									$sukses1++;
								} else {
									$gagal1++;
								}
								
							}
													
							//hapus file xls yang udah dibaca
							unlink($_FILES['data']['name']);
							echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
							echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
							echo '<strong>SUKSES!</strong>';
							echo '<p>'.$sukses1.' Data Berhasil Diimport</p>';
							echo '</div>';
																			
						}
					?>
						<div class="form-group">
							<label class="control-label col-sm-4">File Excel (.xls)</label>
							<div class="col-sm-4">
								<input type="file" name="data" class="form-control" id="data" required />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Download Format Excel</label>
							<div class="col-sm-4">
								<a href="../file/format artikel.xls" class="btn btn-success" role="button"><i class="glyphicon glyphicon-download"></i> Download</a>
							</div>
						</div>
						
				</div>
			</div>
			</div>
			</form>
			<?php
				break;
				case "ubahartikel" :
				$token  = $_GET['token'];
				$cek    = md5(md5($_GET['id']).md5('H3ndri@27'));
				if ( $cek == $token ){
			?>
			<form method="POST" action="" class="form-horizontal" enctype="multipart/form-data">
			<div class="row">
				<div class="col-sm-10">
				<span style="font-size : 30px;">Artikel</span> beranda / ubah artikel
				</div>
				<div class="col-sm-2">
					<p class="pull-right">
						<button class="btn btn-info" name="ubah" type="submit" data-toggle="tooltip" title="Simpan"><i class="fa fa-save"></i></button>
						<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=artikel&act=ubahartikel&id=<?php echo $_GET['id']; ?>&token=<?php echo $_GET['token']; ?>';"><i class="fa fa-refresh"></i></button>
						<button type="button" class="btn btn-danger" data-toggle="tooltip" title="Kembali" onclick="window.location.href='?module=artikel';"><i class="fa fa-share"></i></button>
					</p>
					
				</div>
			</div>
			<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><i class="glyphicon glyphicon-edit"></i>   Ubah Atikel</h4>
					
				</div>
				<div class="panel-body">	 
					<?php
						
						$query1     = $db->prepare("SELECT id_kategori, judul_artikel, isi_artikel, gambar, tag FROM artikel WHERE id_artikel = ?");
						$query1->bind_param("i", $id_artikel);
						$id_artikel = $_GET['id'];
						$query1->execute();
						$result     = $query1->get_result();
						$row1       = $result->fetch_assoc();
						$tag        = explode(",", $row1['tag']);
						
						if ( isset($_POST['ubah']) ){
							include "../config/seo.php";
							$id_artikel      = $_GET['id'];
							$judul           = $_POST['judul'];
							$judul_seo       = seo($judul);
							$kategori        = $_POST['kategori'];
							$isi             = $_POST['isi'];
							$tag             = $_POST['tag'];
							if ( !empty($tag) ){
								$tag_artikel = implode(",", $tag);
							}
							$foto            = $_FILES['foto']['name'];
							$tfoto           = $_FILES['foto']['type'];
							$acak            = rand(1,99);
							$unik            = $acak.$foto;
							if ( empty($judul) ){
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATRANN!</strong> Judul Artikel Tidak Boleh Kososng';
								echo '</div>';
							} else if ( empty($kategori) ){
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATRANN!</strong> Kategori Artikel Tidak Boleh Kososng';
								echo '</div>';
							} else if ( empty($isi) ){
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATRANN!</strong> Isi Artikel Tidak Boleh Kososng';
								echo '</div>';
							} else {
								if ( empty($foto) ){
									$query27 = $db->prepare("UPDATE artikel SET judul_artikel = ?, judul_seo = ?, isi_artikel = ?, tag = ?, id_kategori = ? WHERE id_artikel = ?");
									$query27->bind_param("ssssii", $judul, $judul_seo, $isi, $tag_artikel, $kategori, $id_artikel);
									$query27->execute();
									echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
									echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
									echo '<strong>SUKSES!</strong> Data Berhasil Diubah';
									echo '</div>';
									echo "<meta http-equiv='refresh' content='1; url=?module=artikel&act=ubahartikel&id=$_GET[id]&token=$_GET[token]'>";
								} else {
									if ( $tfoto != 'image/jpg' AND $tfoto != 'image/jpeg' AND $tfoto != 'image/png' ){
										echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
										echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
										echo '<strong>PERINGATRANN!</strong> Gambar Harus Berekstensi jpg/png';
										echo '</div>';
									} else {
										Uploadartikel($unik,$tfoto);
										unlink("../gambar/artikel/$row1[gambar]");
										unlink("../gambar/thumb_artikel/$row1[gambar]");
										$query27 = $db->prepare("UPDATE artikel SET judul_artikel = ?, judul_seo = ?, isi_artikel = ?, tag = ?, id_kategori = ?, gambar = ? WHERE id_artikel = ?");
										$query27->bind_param("ssssisi", $judul, $judul_seo, $isi, $tag_artikel, $kategori, $unik, $id_artikel);
										$query27->execute();
										echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
										echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
										echo '<strong>SUKSES!</strong> Data Berhasil Diubah';
										echo '</div>';
										echo "<meta http-equiv='refresh' content='1; url=?module=artikel&act=ubahartikel&id=$_GET[id]&token=$_GET[token]'>";
									}
								}
							}
							
							
						}
					
					?>
						<div class="form-group">
							<label class="control-label col-sm-3">Kategori Artikel</label>
							<div class="col-sm-4">
								<select name="kategori" id="select6" class="form-control" required>
									<option value=""></option>
									<?php
										$query2 = $db->query("SELECT id_kategori,nama_kategori FROM kategori_artikel ORDER BY nama_kategori ASC");
										while ( $row2 = $query2->fetch_assoc() ){
											$pilih    = ( $row1['id_kategori'] == $row2['id_kategori'] ) ? "selected" : "";
											echo '<option value="'.$row2['id_kategori'].'" '.$pilih.'>'.$row2['nama_kategori'].'</option>';
										}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Judul Artikel</label>
							<div class="col-sm-4">
								<input type="text" value="<?php echo $row1['judul_artikel']; ?>" name="judul" class="form-control" placeholder="Judul Artikel" maxlength="100" required />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Isi Artikel</label>
							<div class="col-sm-9">
								<textarea class="form-control" name="isi" id="tinymce_basic" rows="10"><?php echo $row1['isi_artikel']; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Gambar Artikel</label>
							<div class="col-sm-4">
								<img src="../gambar/thumb_artikel/<?php echo $row1['gambar']; ?>" width="40%" height="40%" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Ganti Gambar Artikel</label>
							<div class="col-sm-4">
								<input type="file" name="foto" class="form-control" onchange="readURL(this);" />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Tag Artikel</label>
							<div class="col-sm-8">
								<?php
									$query8 = $db->query("SELECT nama_tag, tag_seo FROM tag_artikel ORDER BY nama_tag ASC");
									while ( $row8 = $query8->fetch_assoc() ){
										$pilih = in_array( $row8['tag_seo'], $tag ) ? "checked" : "";
										echo '<label class="checkbox-inline"> <input type="checkbox" name="tag[]" value="'.$row8['tag_seo'].'" '.$pilih.'/> '.$row8['nama_tag'].' </label>';
									}
								?>								
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Preview Gambar</label>
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
