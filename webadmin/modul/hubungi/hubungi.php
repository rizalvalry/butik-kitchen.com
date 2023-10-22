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
				<span style="font-size : 30px;">Hubungi</span> beranda / Hubungi
				</div>
				<div class="col-sm-4">
					<p class="pull-right">
					<button type="submit" class="btn btn-danger"  name="hapus"  data-toggle="tooltip" onClick="return confirm('Data yang sudah dihapus tidak bisa dikembalikan lagi. Apakah anda yakin ?')" title="Hapus"><i class="glyphicon glyphicon-trash"></i></button>
					<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=hubungi';"><i class="glyphicon glyphicon-refresh"></i></button>
					</p>
				</div>
			</div>
			<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><i class="glyphicon glyphicon-list"></i> Hubungi</h4>
					
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
									$query2 = $db->prepare("DELETE FROM hubungi WHERE id_hubungi=?");
									$query2->bind_param("i", $id_hubungi);
									$id_hubungi = $id[$i];
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
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr class="bg-warning">
									<th><label><input type="checkbox" name="semua" id="semua" /></label> NO</th>
									<th>Nama</th>
									<th>E-Mail</th>
									<th>Subjek</th>
									<th>Status</th>
									<th>Tanggal</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
									include "../config/tgl_indo.php";
									$no            = 1;
									$query5        = $db->query("SELECT id_hubungi, nama, email, subjek, dibuka, tanggal FROM hubungi ORDER BY id_hubungi DESC");
									while( $row    = $query5->fetch_assoc()){
									$tanggal       = tgl_indo($row['tanggal']);
								?>
								<tr>
									<td><label><input type="checkbox" name="id[]" value="<?php echo $row['id_hubungi']; ?>" /> <?php echo $no; ?></label></td>
									<td><?php echo $row['nama']; ?></td>
									<td><a href="?module=hubungi&act=balashubungi&id=<?php echo $row['id_hubungi']; ?>&token=<?php echo md5(md5($row['id_hubungi']).md5('H3ndri@27')); ?>"><?php echo $row['email']; ?></a></td>
									<td><?php echo $row['subjek'];?></td>
									<td><?php echo ( $row['dibuka'] == "Y" ) ? "Sudah Dibaca" : "Belum Dibaca"; ?></td>
									<td><?php echo $tanggal;?></td>
									<td><a href="?module=hubungi&act=balashubungi&id=<?php echo $row['id_hubungi']; ?>&token=<?php echo md5(md5($row['id_hubungi']).md5('H3ndri@27')); ?>" class="btn btn-primary" data-toggle="tooltip"  title="Lihat Pesan" role="button"><i class="fa fa-pencil"></i></a></td>
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
				case "balashubungi" :
				$token  = $_GET['token'];
				$cek    = md5(md5($_GET['id']).md5('H3ndri@27'));
				if ( $cek == $token ){
				 $db->query("UPDATE hubungi SET dibuka = 'Y' WHERE id_hubungi = '$_GET[id]'");
			?>
			<form method="POST" action="" class="form-horizontal" enctype="multipart/form-data">
			<div class="row">
				<div class="col-sm-10">
				<span style="font-size : 30px;">Balas Hubungi</span> beranda / Balas Hubungi
				</div>
				<div class="col-sm-2">
					<p class="pull-right">
						<button class="btn btn-info" name="balas" type="submit" data-toggle="tooltip" title="Kirim"><i class="fa fa-save"></i></button>
						<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=hubungi&act=balashubungi&id=<?php echo $_GET['id']; ?>&token=<?php echo $_GET['token']; ?>';"><i class="fa fa-refresh"></i></button>
						<button type="button" class="btn btn-danger" data-toggle="tooltip" title="Kembali" onclick="window.location.href='?module=hubungi';"><i class="fa fa-share"></i></button>
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
						
						$query1     = $db->prepare("SELECT email, subjek, pesan FROM hubungi WHERE id_hubungi=?");
						$query1->bind_param("i", $id_hubungi);
						$id_hubungi = $_GET['id'];
						$query1->execute();
						$result     = $query1->get_result();
						$row        = $result->fetch_assoc();
						
						if ( isset($_POST['balas']) ){
							$query9 = $db->query("SELECT email_pengelola,email_protokol FROM profil");
							$row9   = $query9->fetch_assoc();
							$balas  = $_POST['balas'];
							if ( empty($balas) ){
								echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>PERINGATAN!</strong> Balas Pesan Tidak Boleh Kosong';
								echo '</div>';
							} else {
								$subjek = 'Re :'.$row['subjek'].'';
								$dari   = 'From: '.$row9['email_pengelola'].'';
								if ( $row9['email_protokol'] == "Surat" ){
									mail ( $row['email'], $subjek, $balas, $dari  );
								} else {
									include "../config/php-mail/function.php";
									smtp_mail($row['email'], $subjek, $balas);
								}
								echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
								echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
								echo '<strong>SUKSES!</strong> Pesan Berhail Dibalas';
								echo '</div>';
								echo "<meta http-equiv='refresh' content='1; url=?module=hubungi'>";
							}
						}
					
					?>
						<div class="form-group">
							<label class="control-label col-sm-4">E-Mail</label>
							<div class="col-sm-5">
								<input type="text"  class="form-control" value="<?php echo $row['email']; ?>" name="metode" maxlength="100" readonly />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Subjek</label>
							<div class="col-sm-5">
								<input type="text"  class="form-control" value="<?php echo $row['subjek']; ?>" name="metode" maxlength="100" readonly />
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Pesan</label>
							<div class="col-sm-8">
								<textarea rows="10" class="form-control" readonly><?php echo $row['pesan']; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-4">Balas Pesan</label>
							<div class="col-sm-8">
								<textarea rows="10" class="form-control" name="balas" required></textarea>
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
