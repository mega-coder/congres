<?php 

    extract($_POST);
   // session_start();
  //  $_SESSION["login"]=$login;
    session_start();
    $_SESSION['email']=$email;
    $_SESSION['password']=$password;
    $_SESSION['role']=$role;
    echo "success";
?>