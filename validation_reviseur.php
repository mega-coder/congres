<?php
include 'connexion.php';
 $participants =$_POST['participants'];

 foreach($participants as $participant){    
     $stmt = $db->prepare('update user set reviseur_validation=:validation,commentaire=:commentaire where id=:id');
     $stmt->bindParam('id',$participant['id']);
     $stmt->bindParam('validation',$participant['validation']);
     $stmt->bindParam('commentaire',$participant['commentaire']);
     $stmt->execute();     
 }

 echo "success";

    
   /*$stmt = $db->prepare("select * from user where status='en cours'");
   $stmt->execute();*/
?>