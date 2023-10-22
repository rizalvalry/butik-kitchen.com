<?php
require_once('PHPMailer/PHPMailerAutoload.php');
function smtp_mail($to, $subject, $message, $from_name, $from, $cc, $bcc, $debug=false) {
  $mail = new PHPMailer;
  $mail->SMTPDebug = $debug; // Ubah menjadi true jika ingin menampilkan sistem debug SMTP Mailer
  $mail->isSMTP();
  
  // Hapus Semua Tujuan, CC dan BCC
  $mail->ClearAddresses();  
  $mail->ClearCCs();
  $mail->ClearBCCs();

  /* -------------------------- Konfigurasi Dasar SMTP ---------------------------------- */
 /* -------------------------- Konfigurasi Dasar SMTP ---------------------------------- */
  require "config/koneksi.php";
  $query111 =$db->query("SELECT host, port, email_pengelola, password, nama_toko FROM profil");
  $row = $query111->fetch_assoc();
  $mail->SMTPAuth 	= true;                        				
  $mail->Host   	  = $row['host'];  // Masukkan Server SMTP
  $mail->Port 		  = $row['port'];                                      // Masukkan Port SMTP
  $mail->SMTPSecure = 'ssl';                                    // Masukkan Pilihan Enkripsi ( `tls` atau `ssl` )
  $mail->Username 	= $row['email_pengelola'];               // Masukkan Email yang digunakan selama proses pengiriman email via SMTP
  $mail->Password 	= $row['password'];     						          // Masukkan Password dari Email tsb
  $default_email_from       = $row['email_pengelola'];        // Masukkan default from pada email
  $default_email_from_name  = $row['nama_toko'];           // Masukkan default nama dari from pada email
  
  /* -------------------------- Konfigurasi Dasar SMTP ---------------------------------- */
  
  if(empty($from)) $mail->From = $default_email_from;
  else $mail->From = $from;

  if(empty($from_name)) $mail->FromName = $default_email_from_name;
  else $mail->FromName = $from_name;
  
  // Set penerima email
  if(is_array($to)) {
    foreach($to as $k => $v) {
      $mail->addAddress($v);
    }
  } else {
    $mail->addAddress($to);
  }
  
  // Set email CC ( optional )
  if(!empty($cc)) {
    if(is_array($cc)) {
      foreach($cc as $k => $v) {
        $mail->addCC($v);
      }
    } else {
      $mail->addCC($cc);
    }
  }
  
  // Set email BCC ( optional )
  if(!empty($bcc)) {
    if(is_array($bcc)) {
      foreach($bcc as $k => $v) {
        $mail->addBCC($v);
      }
    } else {
      $mail->addBCC($bcc);
    }
  }
  
  // Set isi dari email
  $mail->isHTML(true);
  $mail->Subject 	= $subject;
  $mail->Body 	  = $message;
  $mail->AltBody	= $message;
  if(!$mail->send())
    return 1;
  else
    return 0;
}

?>