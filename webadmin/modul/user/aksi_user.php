<?php
                    error_reporting(0);
                    if ( isset($_POST['tambah']) ){
                   
                    $link = mysqli_connect("localhost", "root", "root", "pijar");
 
                        // Check connection
                        if($link === false){
                            die("ERROR: Could not connect. " . mysqli_connect_error());
                        }

                    // Escape user inputs for security
                    $email = mysqli_real_escape_string($link, $_REQUEST['email']);
                    $password = mysqli_real_escape_string($link, $_REQUEST['password']);
                    $nama_lengkap = mysqli_real_escape_string($link, $_REQUEST['nama_lengkap']);
                    $no_telp = mysqli_real_escape_string($link, $_REQUEST['no_telp']);
                    $level = mysqli_real_escape_string($link, $_REQUEST['level']);
                    $perusahaan = "";
                    $alamat = "";
                    $nama_web = "";
                    $foto = "74315117 - Copy.jpg";
                    $id_session = "cebibkals01jpupd21836t12qu";
                    
                    
                    
                    // Attempt insert query execution
                    $sql = "INSERT INTO user (email, password, perusahaan, alamat, nama_web, foto, id_session, nama_lengkap, no_telp, level) VALUES ('$email', '$password', '$perusahaan', '$alamat', '$nama_web', '$foto', '$id_session', '$nama_lengkap', '$no_telp', '$level')";
                    if(mysqli_query($link, $sql)){
                        echo "Records added successfully.";
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }

					// Close connection
                    mysqli_close($link);
                }
				
				?>