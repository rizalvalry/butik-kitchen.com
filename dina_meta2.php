<?php
      $sql2 = $db->query("SELECT meta_keyword from profil");
      $j2   = $sql2->fetch_assoc();
		  echo "$j2[meta_keyword]";
?>
