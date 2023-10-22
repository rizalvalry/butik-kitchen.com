<?php
error_reporting (0);

$domain= $_POST['domain'];

include "pm211/class.phpmailer.php";
include "koneksi.php";
$mail = new PHPMailer;
// $mail->IsSMTP();
$mail->Mailer = "mail";
$mail->SMTPSecure = "ssl";
$mail->Host = "srv36.niagahoster.com"; //hostname masing-masing provider email
$mail->SMTPDebug = 0;
$mail->Port = 465;
$mail->SMTPAuth = true;
$mail->Username = "info@valryhouse.com"; //user email
$mail->Password = "Admin12345"; //password email
$mail->SetFrom("info@valryhouse.com","Valry House Services"); //set email pengirim
$mail->Subject = "Info Tagihan"; //subyek email
$mail->AddAddress($email); //tujuan email
$isiEmail = '<td style="font-weight: bold; font-size: 12px; padding: 10px 0px; border-bottom: 1px solid #d9d9d9; vertical-align: top; line-height: 1.6em; width: 19%; text-align: center;">'.$domain.'</td>
<td style="font-weight: bold; font-size: 12px; padding: 10px 0px; border-bottom: 1px solid #d9d9d9; vertical-align: top; line-height: 1.6em; width: 12.2877%; text-align: center;">'.$layanan.'</td>
<td style="font-weight: bold; font-size: 12px; padding: 10px 0px; border-bottom: 1px solid #d9d9d9; vertical-align: top; line-height: 1.6em; width: 13.7123%; text-align: center;">'.$harga.'</td>
<td style="font-weight: bold; font-size: 12px; padding: 10px 0px; border-bottom: 1px solid #d9d9d9; vertical-align: top; line-height: 1.6em; width: 13.7123%; text-align: center;">'.$periode.'</td>
<td style="font-weight: bold; font-size: 12px; padding: 10px 0px; border-bottom: 1px solid #d9d9d9; vertical-align: top; line-height: 1.6em; width: 11%; text-align: center;">'.$diskon.'</td>
<td style="font-weight: bold; font-size: 12px; padding: 10px 0px; border-bottom: 1px solid #d9d9d9; vertical-align: top; line-height: 1.6em; width: 20%; text-align: center;">'.$total.'</td>';
$mail->MsgHTML($isiEmail);
// echo $isiEmail;
 if($mail->Send()) echo "";
 else echo "Failed to sending message";
?>