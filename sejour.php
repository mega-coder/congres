<?php

    include "connexion.php";
    session_start();
    $stmt = $db->prepare('select id from user where email=:email and password=:password');
    $stmt->bindParam('email',$_SESSION['email']);
    $stmt->bindParam('password',$_SESSION['password']);
    $stmt->execute();
    $row = $stmt->fetch();  
    $id =$row['id'];
    extract($_POST);

    $stmt = $db->prepare('update user set activites=:activites,periode=:periode where id=:id');
    $stmt->bindParam("id",$id);
    $stmt->bindParam("activites",$activites);
    $stmt->bindParam("periode",$periode);
    $stmt->execute();
    console.log('success');


    

?>