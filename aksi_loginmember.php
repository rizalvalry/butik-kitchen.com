<?php
    error_reporting(0);
    session_start();
                    require "config/koneksi.php";
					if ( isset( $_POST['masuk'] ) ){
						$telpon    = $_POST['telpon'];
						$password = $_POST['password'];
						
						if ( empty( $telpon ) ){
							echo "<script> alert('Telepon Tidak Boleh Kosong');window.location='loginmember.html';</script>";
						} else if ( empty($password ) ) {
							echo "<script> alert('Password Tidak Boleh Kosong');window.location='loginmember.html';</script>";
						} else {
							$query72  = $db->prepare("SELECT id_kustomer, telpon, password, nama_lengkap, level, aktif FROM kustomer WHERE telpon = ?");
							$query72->bind_param("s", $telpon);
							$query72->execute();
							$result72 = $query72->get_result();
							$row72    = $result72->fetch_assoc();
							if ( $telpon <> $row72['telpon'] ){
								echo "<script> alert('Nomor Telepon Yang Anda Masukan Salah');window.location='loginmember.html';</script>";
							} else if ( $password <> password_verify($password,$row72['password']) ){
								echo "<script> alert('Password Yang Anda Masukan Salah');window.location='loginmember.html';</script>";
							} else if ( $row72['aktif'] != "Y" ){
								echo "<script> alert('Akun Anda Sudah Tidak Aktif');window.location='loginmember.html';</script>";
							} else {
								// $_SESSION['pbemail'] = $row72['email'];
								$_SESSION['pblevel'] = $row72['level'];
								$_SESSION['pbnama']  = $row72['nama_lengkap'];
								$_SESSION['pbid']    = $row72['id_kustomer'];

								echo "<meta http-equiv='refresh' content='0; url=home'>";
								
								
							}
						}
					}
				
				?>