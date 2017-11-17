<?php
    session_start();
    $_SESSION['email']=null;
    $_SESSION['password']=null;
    $_SESSION['role']=null;
    session_destroy();
?>