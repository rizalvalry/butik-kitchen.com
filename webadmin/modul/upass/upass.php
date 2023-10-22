<?php
	if( $_SESSION['email']=="" AND $_SESSION['level']=="" ){
		header('location:blank.php?eror='.md5('hendri@27').'');
	} else {
?>
<form method="POST" action="" class="form-horizontal" enctype="multipart/form-data">
			<div class="row">
				<div class="col-sm-10">
				<span style="font-size : 30px;">Ubah Password</span> beranda / ubah password
				</div>
				<div class="col-sm-2">
					<p class="pull-right">
					<button type="submit" class="btn btn-info" name="simpan"  data-toggle="tooltip"  title="Simpan"><i class="fa fa-save"></i></button>
					<button type="button" class="btn btn-default" data-toggle="tooltip" title="Refresh" onclick="window.location.href='?module=upass';"><i class="glyphicon glyphicon-refresh"></i></button>
					</p>
				</div>
			</div>
			<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4><i class="glyphicon glyphicon-pencil"></i>   Ubah Password</h4>\
					
				</div>
				<div class="panel-body">	
				<?php
					$query = $db->prepare("SELECT password,foto FROM user WHERE email=?");
					$query->bind_param("s", $email);
					$email = $_SESSION['email'];
					$query->execute();
					$result= $query->get_result();
					$row   = $result->fetch_assoc();
					
					if ( isset($_POST['simpan']) ){
						
						$lpass = $_POST['lpass'];
						$bpass = $_POST['bpass'];
						$upass = $_POST['upass'];
						
						$cost  = ['cost' => 10,];
						$hash  = password_hash($upass, PASSWORD_BCRYPT,$cost);
						
						$eror  = array();
						$css   = "border : 1px solid red;";
						
						if ( empty($lpass) ){
							$eror['lpass'] = $css;
							echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
							echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
							echo '<strong>PERINGATRANN!</strong> Password Lama Tidak Boleh Kosong';
							echo '</div>';
						} else if ( $lpass <> password_verify($lpass,$row['password']) ){
							$eror['lpass'] = $css;
							echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
							echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
							echo '<strong>PERINGATRANN!</strong> Password Lama Salah';
							echo '</div>';
						} else if ( empty($bpass) ) {
							$eror['bpass'] = $css;
							echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
							echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
							echo '<strong>PERINGATRANN!</strong> Password Baru Tidak Boleh Kosong';
							echo '</div>';
						} else if ( empty($upass) ){
							$eror['upass'] = $css;
							echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
							echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
							echo '<strong>PERINGATRANN!</strong> Konfirmasi Password Tidak Boleh Kosong';
							echo '</div>';
						} else if ( $bpass <> $upass ){
							$eror['upass'] = $css;
							$eror['bpass'] = $css;
							echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
							echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
							echo '<strong>PERINGATRANN!</strong> Password Baru dan Konfirmasi Password Tidak Sama';
							echo '</div>';
						} else if ( strlen($bpass) < 6 OR strlen($upass) < 6){
							$eror['upass'] = $css;
							$eror['bpass'] = $css;
							echo '<div class="alert alert-danger" role="alert" style="font-size : 12px; padding : 5px;">';
							echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
							echo '<strong>PERINGATRANN!</strong> Password Minimal 6 Karakter';
							echo '</div>';
						} else {
							$query = $db->prepare("UPDATE user SET password=? WHERE email=?");
							$query->bind_param("ss", $hash,$_SESSION['email']);
							$query->execute();
							echo '<div class="alert alert-success" role="alert" style="font-size : 12px; padding : 5px;">';
							echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
							echo '<strong>SUKSES!</strong> Password Berhasil Diubah';
							echo '</div>';
							echo "<meta http-equiv='refresh' content='1; url=?module=upass'>";
						}
							
						
						
					}
				
				?>
					<div class="widget_middle">
					<div class="col-sm-6">
						<img src="../gambar/user/<?php echo $row['foto']; ?>" class="img-thumbnail" />
					</div>
					<div class="col-sm-6">
						<h4 align="center">Ubah Password</h4>
						<form class="form-horizontal">
							<div class="form-group">
								<label class="control-label col-sm-4">Password Lama</label>
								<div class="col-sm-6">
									<input type="text" class="form-control" name="lpass" value="<?php echo isset( $lpass ) ? $lpass : "";?>" style="<?php echo ( $eror['lpass'] ) ? $eror['lpass'] : ""; ?>" required />
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4">Password Baru</label>
								<div class="col-sm-6">
									<input type="password" class="form-control" name="bpass" value="<?php echo isset( $bpass ) ? $bpass : "";?>" style="<?php echo ( $eror['bpass'] ) ? $eror['bpass'] : ""; ?>" required />
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-4">Konfirmasi Password</label>
								<div class="col-sm-6">
									<input type="password" class="form-control" name="upass" value="<?php echo isset( $upass ) ? $upass : "";?>" style="<?php echo ( $eror['upass'] ) ? $eror['upass'] : ""; ?>" required />
								</div>
							</div>
						</form>
					</div>
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>
			</form>
<?php
	}
?>