<?php

    include'connexion.php';
    header('Content-Type: application/json');   
    $stmt = $db->prepare("select role from user where email=:email and password=:password");
    $stmt->bindParam(':email',$_POST["email"]);
    $stmt->bindParam(':password',$_POST["password"]);
    $stmt->execute();
    $message =array();
    if($stmt ->rowCount()>0){    
    
        $message['message']="ok";
        $message['email']=$_POST["email"];
        $message['password']=$_POST["password"];
        $row = $stmt->fetch();
        $message['role']=$row['role'];
    }
                  
    else{
        
        $message['message']="ko";
        
    }


    echo json_encode($message);
?>