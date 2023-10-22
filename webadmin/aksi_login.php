<?php
							    error_reporting(0);
								session_start();
								require "../config/koneksi.php";
								date_default_timezone_set('Asia/Jakarta'); // PHP 6 mengharuskan penyebutan timezone.
								$tahun  = date("Y");
								
								if( isset($_POST['login']) ){
									$user = $_POST['username'];
									$pass = $_POST['password'];
									
									$eror = array();
									
									if ( empty($user) ){
										echo "<script> alert('Username atau E-Mail Tidak Boleh Kosong');window.location='index.php';</script>";
									} else if ( empty($pass) ) {
										echo "<script> alert('Password Tidak Boleh Kosong');window.location='index.php';</script>";
									} else {
										$sql    = "SELECT email,password,nama_lengkap,level,foto,id_session,blokir,id_user FROM user WHERE email=?";
										$query  = $db->prepare($sql);
										$query->bind_param("s", $user);
										$query->execute();
										$result = $query->get_result();
										$row    = $result->fetch_assoc();
										
										if( $user <> $row['email'] ){
											echo "<script> alert('Username atau E-Mail Yang Anda Masukan Salah');window.location='index.php';</script>";
										} else if ( $pass<>password_verify($pass,$row['password']) ) {
											echo "<script> alert('Password Yang Anda Masukan Salah');window.location='index.php';</script>";
										} else if ( $row['blokir']=="Y" ){
											echo "<script> alert('Akun Anda Sudah Tidak Aktif');window.location='index.php';</script>";
										} else {
											
											$_SESSION['level'] = $row['level'];
											$_SESSION['email'] = $row['email'];
											$_SESSION['id']    = $row['id_user'];
											$_SESSION['login'] = 1;
											$sid_lama = session_id();
											session_regenerate_id();
											$sid_baru = session_id();
											
											$db->query("UPDATE user SET id_session='$sid_baru' WHERE email='$user'");
											header("location:media.php?module=home");
										}
									}
								}
							?>