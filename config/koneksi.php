<?php

// $host = "localhost";
// $dbs = "n1602061_n1116126_live_butikkitchen";
// $user = "n1602061_elshanum";
// $pass = "P@ssw0rd12345";

$host = "localhost";
$dbs = "n1602061_kitchen";
$user = "n1602061_elshanum";
$pass = "P@ssw0rd12345";

$db = new mysqli($host, $user, $pass, $dbs);
if(!$db) {
  die( print_r( $db));
} else {
    echo "berhasilkah";
}