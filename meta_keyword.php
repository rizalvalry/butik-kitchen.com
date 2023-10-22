<?php
    $query22 = $db->query("SELECT meta_keyword FROM profil");
	$row22   = $query22->fetch_assoc();
	echo $row22['meta_keyword'];
?>
