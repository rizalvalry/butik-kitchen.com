<?php
      $sql3 = $db->query("SELECT meta_tag from profil");
      $j3   = $sql3->fetch_assoc();
		  echo "$j3[meta_tag]";
?>
