	<!--breadcrumbs-->
	<section class="breadcrumb">
    <div class="container-fluid padding-fixed">
        <ul class="list-inline text-capitalize">
            <li><a href="home" title="Retailer - Multipurpose Responsive Shopify Theme/Template">Home<i class="fa fa-angle-right"></i></a></li>


            <li>Lupa kata Sandi ?</li>

        </ul>
    </div>
</section>
	<!--//breadcrumbs-->
	<!--login-->
	<div class="container">
	<div class="reset-page col-md-12">
		<div class="title-info wow fadeInUp animated" data-wow-delay=".5s">
			<h3 class="title">Reset<span> Kata Sandi</span></h3>
		</div>
		<div class="widget-shadow">
			<div class="login-top wow fadeInUp animated" data-wow-delay=".7s">
				<h4>Silahkan masukan E-mail akun Anda</h4>
			</div>
			<div class="login-body wow fadeInUp animated" data-wow-delay=".7s">
				<form method="POST" action="">
				<?php
if (isset($_POST['masuk'])) {
    $email41 = $_POST['email'];
    $query41 = $db->prepare("SELECT email FROM kustomer WHERE email = ?");
    $query41->bind_param("s", $email41);
    $query41->execute();
    $result41 = $query41->get_result();
    $row41 = $result41->fetch_assoc();

    if (empty($email41)) {
        echo '<div class="alert alert-danger alert-login" role="alert">';
        echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
        echo '<strong>PERINGATAN!</strong> E-Mail Tidak Boleh Kosong';
        echo '</div>';
    } else if ($email41 != $row41['email']) {
        echo '<div class="alert alert-danger alert-login" role="alert">';
        echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
        echo '<strong>PERINGATAN!</strong> E-Mail Yang Anda Masukan Salah';
        echo '</div>';
    } else {
        $ksbaru41 = substr(md5(uniqid(rand(), 1)), 3, 10);
        $cost = ['cost' => 10];
        $hash = password_hash($ksbaru41, PASSWORD_BCRYPT, $cost);
        $query42 = $db->prepare("UPDATE kustomer SET password = ? WHERE email = ?");
        $query42->bind_param("ss", $hash, $email41);
        $query42->execute();

        $subjek42 = 'Kata Sandi Baru';
        $pesan42 = 'Kata sandi baru Anda ' . $ksbaru41 . '';
        $dari = 'From: ' . $row00['email_pengelola'] . '\r\n';
        $dari .= "Content-type: text/html\r\n";
        $email = $_POST['email'];

        include "pm211/class.phpmailer.php";
        include 'config/koneksi.php';
        $mail = new PHPMailer;
        $query111 = $db->query("SELECT host, port, email_pengelola, password, nama_toko FROM profil");
        $row = $query111->fetch_assoc();
// $mail->IsSMTP();
        $mail->Mailer = "mail";
        $mail->SMTPSecure = "ssl";
        $mail->Host = $row['host']; //hostname masing-masing provider email
        $mail->SMTPDebug = 0;
        $mail->Port = $row['port'];
        $mail->SMTPAuth = true;
        $mail->Username = $row['email_pengelola']; //user email
        $mail->Password = $row['password']; //password email
        $mail->SetFrom($row['email_pengelola'], "Tanama Services"); //set email pengirim
        $mail->Subject = "Informasi Perubahan Password"; //subyek email
        $mail->AddAddress($email); //tujuan email
        $isiEmail = $pesan42;
        $mail->MsgHTML($isiEmail);
// echo $isiEmail;
        if ($mail->Send()) {
			echo '<div class="alert alert-info" role="alert">';
			echo '<button type="button" class="close" data-dismiss="alert">&times;</button>';
			echo '<strong>SUKSES!</strong> Kata sandi Anda telah direset, silahkan buka E-mail Anda untuk melihat kata sandi baru';
			echo '</div>';
			echo "<meta http-equiv='refresh' content='2'; url=index.php'>";
        } else {
            echo "Failed to sending message";
        }

    }

}

?>
					<input type="email" class="form-control margin-bottom-10" name="email" placeholder="E-Mail" required="">
					<input type="submit" class="btn btn-default pull-left margin-top-10" name="masuk" value="Kirim Kata Sandi Baru">
					<div class="forgot-grid">
						<div class="clearfix"> </div>
					</div>
				</form>
			</div>
		</div>
		<div class="login-page-bottom">
		</div>
	</div>
	</div>
	<!--//login-->