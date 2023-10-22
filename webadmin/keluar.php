<?php
     session_start();
    if ( $_SESSION['level'] == "Admin" ){
         session_destroy();
         header('location:index.php'); 
     } else {
        session_destroy();
        header('location:../index.php'); 
    }
  
?>
