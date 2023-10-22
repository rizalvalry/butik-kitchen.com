<?php
include "parser-php-version.php"; //Konversi dan migrasi PHP version


$servername = "localhost";
$database = "n1602061_n1116126_live_butikkitchen";
$username ="n1602061_elshanum";
$password = "P@ssw0rd12345";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
      die("Pesan Gagal Dikirim - Database tidak terhubung!: " . mysqli_connect_error());
}

 
// $sql = "INSERT INTO payment (domain, email, layanan, dari, sampai, periode, harga, diskon, total) VALUES ('domain', 'email', 'layanan', 'dari', 'sampai', 'periode', 'harga', 'diskon', 'total')";
// if (mysqli_query($conn, $sql)) {
//       echo "Pesan Berhasil Dikirim";
// } else {
//       echo "Error: " . $sql . "<br>" . mysqli_error($conn);
// }
mysqli_close($conn);
