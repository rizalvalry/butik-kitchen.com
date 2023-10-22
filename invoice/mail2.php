<?php
error_reporting (0);


$domain= $_POST['domain'];
$email= $_POST['email'];
$layanan= $_POST['layanan'];
$dari= $_POST['dari'];
$sampai= $_POST['sampai'];
$periode= $_POST['periode'];
$harga= $_POST['harga'];
$diskon= $_POST['diskon'];
$total= $_POST['total'];


// $servername = "localhost";
// $database = "u4920924_tagihan";
// $username = "u4920924_rizal";
// $password = "12345";
// // Create connection
// $conn = mysqli_connect($servername, $username, $password, $database);
// // Check connection
// if (!$conn) {
//       die("Connection failed: " . mysqli_connect_error());
// }
 
// echo "Connected successfully";
 
// $sql = "INSERT INTO payment (domain, email, layanan, dari, sampai, periode, harga, diskon, total) VALUES ('$domain', '$email', '$layanan', '$dari', '$sampai', '$periode', '$harga', '$diskon', '$total')";
// if (mysqli_query($conn, $sql)) {
//       echo "New record created successfully";
// } else {
//       echo "Error: " . $sql . "<br>" . mysqli_error($conn);
// }
// mysqli_close($conn);


include "pm211/class.phpmailer.php";
// include ('koneksi.php');
$mail = new PHPMailer;
$mail->Mailer = 'mail';
$mail->IsSMTP();
$mail->SMTPSecure = "ssl";
$mail->Host = "srv44.niagahoster.com"; //hostname masing-masing provider email
$mail->SMTPDebug = 0;
$mail->Port = 465;
$mail->SMTPAuth = true;
$mail->Username = "rizal@elshanum.com"; //user email
$mail->Password = "P@ssw0rdRZL"; //password email
$mail->SetFrom("rizal@elshanum.com","Valry House Services"); //set email pengirim
$mail->Subject = "Info Tagihan"; //subyek email
$mail->AddAddress("cawangbsi@gmail.com"); //tujuan email
$isiEmail = '<table style="border-collapse: collapse; background-color: #ffffff;" border="0" width="auto" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td style="padding: 15px 20px 10px;" bgcolor="#D9EDF7">
<table style="border-collapse: collapse; color: #ffffff;" width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="font-size: 20px; color: #51708f;" align="center" width="280">Valry House</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td style="padding: 30px 20px 20px; color: #4e4e4e;"><span style="font-size: 16px; font-weight: bold;">Kepada Yth,</span> <br /><span style="font-size: 14px;">Bapak/Ibu Pemilik Website. </span> <br /><br /><span style="font-size: 14px;">Bersama email ini kami sampaikan bahwa hosting dan domain website Bapak/Ibu sudah mendekati masa tenggang pemakaian. Agar Bapak/Ibu dapat terus menikmati pelayanan kami, berikut kami lampirkan detail tagihan dari bulan '.$dari.' hingga&nbsp; '.$sampai.' .</span><br /><br /></td>
</tr>
</tbody>
<tbody>
<tr>
<td style="padding: 10px 20px 10px; font-size: 14px; color: #51708f;" align="left" bgcolor="#D9EDF7" width="280">Detail Tagihan :</td>
</tr>
</tbody>
<tbody>
<tr>
<td style="padding: 10px 20px;">
<table style="border-collapse: collapse; color: #4f4f4f; font-size: 9px; margin-left: auto; margin-right: auto;" border="0" width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="font-weight: bold; font-size: 12px; padding: 10px 0px; border-bottom: 1px solid #d9d9d9; vertical-align: top; line-height: 1.6em; width: 16%; text-align: center;">No</td>
<td style="font-weight: bold; font-size: 12px; padding: 10px 0px; border-bottom: 1px solid #d9d9d9; vertical-align: top; line-height: 1.6em; width: 19%; text-align: center;">Primary Domain</td>
<td style="font-weight: bold; font-size: 12px; padding: 10px 0px; border-bottom: 1px solid #d9d9d9; vertical-align: top; line-height: 1.6em; width: 12.2877%; text-align: center;">Jenis Layanan</td>
<td style="font-weight: bold; font-size: 12px; padding: 10px 0px; border-bottom: 1px solid #d9d9d9; vertical-align: top; line-height: 1.6em; width: 13.7123%; text-align: center;">Harga</td>
<td style="font-weight: bold; font-size: 12px; padding: 10px 0px; border-bottom: 1px solid #d9d9d9; vertical-align: top; line-height: 1.6em; width: 13.7123%; text-align: center;">Periode</td>
<td style="font-weight: bold; font-size: 12px; padding: 10px 0px; border-bottom: 1px solid #d9d9d9; vertical-align: top; line-height: 1.6em; width: 11%; text-align: center;">Diskon</td>
<td style="font-weight: bold; font-size: 12px; padding: 10px 0px; border-bottom: 1px solid #d9d9d9; vertical-align: top; line-height: 1.6em; width: 20%; text-align: center;">Total</td>
</tr>
<tr>
<td style="padding: 10px 0px; font-size: 12px; border-bottom: 1px solid #d9d9d9; vertical-align: top; line-height: 1.6em; width: 16%; text-align: center;">1</td>
<td style="font-weight: bold; font-size: 12px; padding: 10px 0px; border-bottom: 1px solid #d9d9d9; vertical-align: top; line-height: 1.6em; width: 19%; text-align: center;">'.$domain.'</td>
<td style="font-weight: bold; font-size: 12px; padding: 10px 0px; border-bottom: 1px solid #d9d9d9; vertical-align: top; line-height: 1.6em; width: 12.2877%; text-align: center;">'.$layanan.'</td>
<td style="font-weight: bold; font-size: 12px; padding: 10px 0px; border-bottom: 1px solid #d9d9d9; vertical-align: top; line-height: 1.6em; width: 13.7123%; text-align: center;">'.$harga.'</td>
<td style="font-weight: bold; font-size: 12px; padding: 10px 0px; border-bottom: 1px solid #d9d9d9; vertical-align: top; line-height: 1.6em; width: 13.7123%; text-align: center;">'.$periode.'</td>
<td style="font-weight: bold; font-size: 12px; padding: 10px 0px; border-bottom: 1px solid #d9d9d9; vertical-align: top; line-height: 1.6em; width: 11%; text-align: center;">'.$diskon.'</td>
<td style="font-weight: bold; font-size: 12px; padding: 10px 0px; border-bottom: 1px solid #d9d9d9; vertical-align: top; line-height: 1.6em; width: 20%; text-align: center;">'.$total.'</td>
</tr>
</tbody>
</table>
<p>Pembayaran dapat dilakukan melalui salah satu rekening a/n<br /><strong>MUHAMAD RIZAL</strong>&nbsp;berikut ini :</p>
<table style="margin-left: auto; margin-right: auto;" width="100%" cellspacing="20" cellpadding="0px 20px">
<tbody>
<tr>
<td><center></center><center><img class="CToWUd" src="https://pngimage.net/wp-content/uploads/2018/06/logo-bank-bca-png-2.png" height="40px" />
<p><strong>4360 1496 47</strong></p>
</center></td>
<td><center><img class="CToWUd" src="https://ci6.googleusercontent.com/proxy/nI96RqGOU5LJnNMsZtbBaIsFoi-IkQUZDmWk2LVaSeVJbBEWUi_VKY3pcha8j16NHs2e0jNRoA29wxY8UmaGOTeftfWaz9lwW-f4km59TXRNKojtzCZ82zlNnlwF=s0-d-e1-ft#https://panel.niagahoster.co.id/bb-uploads/tinymce/logoBank/1510279792.png" height="40px" />
<p><strong>1250 0131 04856</strong></p>
</center></td>
</tr>
</tbody>
</table>
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<p>Apabila Bapak/Ibu ingin bertanya kepada kami, silakan hubungi nomor telepon <a href="tel:+6221-7941-443">021-7941-443</a> / <a href="tel:+62857-8157-1742">0857-8157-1742</a> atau email ke <a href="mailto:rizal@valryhouse.com?Subject=Pertanyaan%20Tagihan">rizal@valryhouse.com</a>.</p>
<p>Atas perhatian Bapak/Ibu kami ucapkan terima kasih.</p>
</div>
</div>
<p>&nbsp;</p>
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<p>Hormat Kami,</p>
<strong>DTH(Development Team House) Customer Care</strong></div>
</div>
<p>&nbsp;</p>
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<p style="font-size: 10px;">Bapak/Ibu tidak perlu membalas email ini karena email dikirim dengan secara otomatis oleh komputer.</p>
</div>
</div>
</td>
</tr>
</tbody>
<tbody>
<tr>
<td style="line-height: 25px; color: #4f4f4f;">Terima kasih</td>
</tr>
</tbody>
</table>';
$mail->MsgHTML($isiEmail);
// echo $isiEmail;
 if($mail->Send()) echo "berhasil terkirim";
 else echo "Failed to sending message";
?>