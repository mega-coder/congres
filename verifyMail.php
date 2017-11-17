<?php
    
    include'connexion.php';
    header('Content-Type: application/json');
    $sql = "select email from user where email ='";
    $stmt = $db->prepare($sql.$_GET['email']."'");
    $stmt->execute();
    $message =array();
    if($stmt ->fetch()){
        $message['message']="ok";
    }
                  
    else{
        
        $message['message']="ko";

    }

    echo json_encode($message);

?>