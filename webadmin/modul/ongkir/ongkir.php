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
				<span style="font-size : 30px;">Ongkos Kirim</span> beranda / ongkos kirim
				</div>
				<div class="col-sm-4">
					<p class="pull-right">
					<button type="button" class="btn btn-success" data-toggle="tooltip" title="Upload Excel" onclick="window.location.href='?module=ongkir&act=uploadongkir';"><i class="glyphicon glyphicon-upload"></i></button>
					<button type="button" class="btn btn-warning" data-toggle="tooltip" title="Update Excel" onclick="window.location.href='?module=ongkir&act=updateongkir';"><i class="glyphicon glyphicon-upload"></i></button>
					<button type="submit" class="btn btn-danger"  name="hapus"  data-toggle="tooltip" onClick="return confirm('Data yang sudah dihapus tidak bisa dikembalikan lagi. Apakah anda yakin ?')" title="Hapus"><i class="glyphicon glyphicon-trash"></i></button>
					<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=ongkir';"><i class="glyphicon glyphicon-refresh"></i></button>
					</p>
				</div>
			</div>
			<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><i class="glyphicon glyphicon-list"></i>Ongkos Kirim</h4>
					
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
									$query2 = $db->prepare("DELETE FROM ongkos_kirim WHERE id_ongkir=?");
									$query2->bind_param("i", $id_ongkir);
									$id_ongkir = $id[$i];
									$query2->execute();
									
								}
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> '.$jml.' Data Berhasil Dihapus';
								echo '</div>';
								
							}
						}
					?>
					<div class="table-responsive">
						<table id="ongkir" class="table table-bordered table-striped">
							<thead>
								<tr class="bg-warning">
									<th><label><input type="checkbox" name="semua" id="semua" /></label> NO</th>
									<th>Metode Pengiriman</th>
									<th>Provinsi</th>
									<th>Kabupaten/Kota</th>
									<th>Kecamatan</th>
									<th>Ongkos Kirim</th>
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
				case "uploadongkir" :
			?>
			<form method="POST" action="" class="form-horizontal" onSubmit="return validateForm()" enctype="multipart/form-data">
			<div class="row">
				<div class="col-sm-10">
				<span style="font-size : 30px;">Ongkos Kirim</span> beranda / upload ongkos kirim
				</div>
				<div class="col-sm-2">
					<p class="pull-right">
						<button class="btn btn-info" name="tambah" type="submit" data-toggle="tooltip" title="Simpan"><i class="fa fa-save"></i></button>
						<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=ongkir&act=uploadongkir';"><i class="fa fa-refresh"></i></button>
						<button type="button" class="btn btn-danger" data-toggle="tooltip" title="Kembali" onclick="window.location.href='?module=ongkir';"><i class="fa fa-share"></i></button>
					</p>
					
				</div>
			</div>
			
			<div class="row">
			<div class="panel-group">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><i class="glyphicon glyphicon-pencil"></i> Upload Ongkos Kirim</h4>
					
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
							$metode    = $_POST['metode'];
							$sukses1    = 0;
							$gagal2     = 0;
							for ($i = 2; $i <= $baris; $i++){
								//membaca data (kolom ke-1 sd terakhir)
								$id_kec        = $data->val($i, 5);
								$ongkir        = $data->val($i, 7);
								
								$query2 = $db->prepare("INSERT INTO ongkos_kirim (id_kec,id_pengiriman,ongkos_kirim) VALUES (?,?,?)");
								$query2->bind_param("iii", $id_kec,$metode,$ongkir);
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
							<label class="control-label col-sm-4">Metode Pengiriman</label>
							<div class="col-sm-3">
								<select name="metode" class="form-control" id="select3">
									<option value=""></option>
									<?php
										$query = $db->query("SELECT id_pengiriman,metode_pengiriman FROM pengiriman WHERE aktif='Y' ORDER BY metode_pengiriman ASC");
										while ( $row = $query->fetch_assoc() ){
											echo '<option value="'.$row['id_pengiriman'].'">'.$row['metode_pengiriman'].'</option>';
										}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">File Excel (.xls)</label>
							<div class="col-sm-4">
								<input type="file" name="data" class="form-control" id="data" required />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Download Format Excel</label>
							<div class="col-sm-4">
							    <a href="../file/ongkir.zip" class="btn btn-success"><i class="glyphicon glyphicon-download"></i>Download</a>
							</div>
						</div>
						
				</div>
			</div>
			</div>
			</form>
			<?php
				break;
				case "updateongkir" :
			?>
			<form method="POST" action="" class="form-horizontal" onSubmit="return validateForm()" enctype="multipart/form-data">
			<div class="row">
				<div class="col-sm-10">
				<span style="font-size : 30px;">Ongkos Kirim</span> beranda / update ongkos kirim
				</div>
				<div class="col-sm-2">
					<p class="pull-right">
						<button class="btn btn-info" name="tambah" type="submit" data-toggle="tooltip" title="Simpan"><i class="fa fa-save"></i></button>
						<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=ongkir&act=updateongkir';"><i class="fa fa-refresh"></i></button>
						<button type="button" class="btn btn-danger" data-toggle="tooltip" title="Kembali" onclick="window.location.href='?module=ongkir';"><i class="fa fa-share"></i></button>
					</p>
					
				</div>
			</div>
			
			<div class="row">
			<div class="panel-group">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><i class="glyphicon glyphicon-pencil"></i> Update Ongkos Kirim</h4>
					
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
							$metode    = $_POST['metode'];
							$sukses1    = 0;
							$gagal2     = 0;
							for ($i = 2; $i <= $baris; $i++){
								//membaca data (kolom ke-1 sd terakhir)
								$id_kec        = $data->val($i, 5);
								$ongkir        = $data->val($i, 7);
								
								$query2 = $db->prepare("UPDATE ongkos_kirim SET ongkos_kirim=? WHERE id_kec=? AND id_pengiriman=?");
								$query2->bind_param("iii", $ongkir,$id_kec,$metode);
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
							echo '<p>'.$sukses1.' Data Berhasil Diupdate</p>';
							echo '</div>';
																			
						}	
					
					?>
						<div class="form-group">
							<label class="control-label col-sm-4">Metode Pengiriman</label>
							<div class="col-sm-3">
								<select name="metode" class="form-control" id="select3">
									<option value=""></option>
									<?php
										$query = $db->query("SELECT id_pengiriman,metode_pengiriman FROM pengiriman WHERE aktif='Y' ORDER BY metode_pengiriman ASC");
										while ( $row = $query->fetch_assoc() ){
											echo '<option value="'.$row['id_pengiriman'].'">'.$row['metode_pengiriman'].'</option>';
										}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">File Excel (.xls)</label>
							<div class="col-sm-4">
								<input type="file" name="data" class="form-control" id="data" required />
							</div>
						</div>
						
				</div>
			</div>
			</div>
			</form>
			
			<?php
				break;
				case "ubahongkir" :
				$token  = $_GET['token'];
				$cek    = md5(md5($_GET['id']).md5('H3ndri@27'));
				if ( $cek == $token ){
			?>
			<form method="POST" action="" class="form-horizontal" enctype="multipart/form-data">
			<div class="row">
				<div class="col-sm-10">
				<span style="font-size : 30px;">Ongkos Kirim</span> beranda / ubah ongkos kirim
				</div>
				<div class="col-sm-2">
					<p class="pull-right">
						<button class="btn btn-info" name="ubah" type="submit" data-toggle="tooltip" title="Simpan"><i class="fa fa-save"></i></button>
						<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=ongkir&act=ubahongkir&id=<?php echo $_GET['id']; ?>&token=<?php echo $_GET['token']; ?>';"><i class="fa fa-refresh"></i></button>
						<button type="button" class="btn btn-danger" data-toggle="tooltip" title="Kembali" onclick="window.location.href='?module=ongkir';"><i class="fa fa-share"></i></button>
					</p>
					
				</div>
			</div>
			<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><i class="glyphicon glyphicon-edit"></i>   Ubah Ongkos kirim</h4>
					
				</div>
				<div class="panel-body">	 
					<?php
						$query     = $db->prepare("SELECT pengiriman.metode_pengiriman,kec.nama_kec,ongkos_kirim.ongkos_kirim FROM ongkos_kirim LEFT JOIN pengiriman ON ongkos_kirim.id_pengiriman=pengiriman.id_pengiriman LEFT JOIN kec ON ongkos_kirim.id_kec=kec.id_kec WHERE ongkos_kirim.id_ongkir=?");
						$query->bind_param("i", $id_ongkir);
						$id_ongkir = $_GET['id'];
						$query->execute();
						$result    = $query->get_result();
						$row       = $result->fetch_assoc();
						
						if( isset($_POST['ubah']) ){
							$ongkir    = $_POST['ongkir'];
							if ( !preg_match("/^[0-9]*$/",$ongkir) ){
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATAN!</strong> Ongkos Kirim Harus Angka';
								echo '</div>';
							} else {
								$query = $db->prepare("UPDATE ongkos_kirim SET ongkos_kirim=? WHERE id_ongkir=?");
								$query->bind_param("ii", $ongkir,$id_ongkir);
								$query->execute();
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> Data Berhasil Diubah';
								echo '</div>';
								echo "<meta http-equiv='refresh' content='1; url=?module=ongkir&act=ubahongkir&id=$_GET[id]&token=$_GET[token]'>";
							}
							
							
						}
					
					?>
						<div class="form-group">
							<label class="control-label col-sm-4">Metode Pengiriman</label>
							<div class="col-sm-4">
								<input type="text"  class="form-control" value="<?php echo $row['metode_pengiriman']; ?>" name="metode" maxlength="100" disabled />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Nama Kecamatan</label>
							<div class="col-sm-5">
								<input type="text"  class="form-control" value="<?php echo $row['nama_kec']; ?>" name="urutan" maxlength="100" disabled />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Ongkos Kirim</label>
							<div class="col-sm-3">
								<input type="text"  class="form-control" value="<?php echo $row['ongkos_kirim']; ?>" name="ongkir" maxlength="11" required />
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
