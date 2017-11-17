<?php

    include 'connexion.php';
    $stmt=$db->prepare("update user set theme=:theme,modified=1 where id=:id");
    $stmt->bindParam('theme',$_POST['theme']);
    $stmt->bindParam('id',$_POST['id']);
    $stmt->execute();


?>