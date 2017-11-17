<?php 
session_start(); 
if(isset($_SESSION['email']) && isset($_SESSION['password']) && $_SESSION['role']=="reviseur"){
    include'connexion.php';
    $stmt = $db->prepare("select * from user where status='en cours' and role='participant'");
    $stmt->execute(); 
    $rows = $stmt->fetchAll();  
header('Content-type: application/octet-stream',TRUE);
header("Cache-Control: no-cache");
header("Pragma: no-cache");
header('Content-Disposition: attachment; filename="participants.csv"');
?>"nom";"prenom";"titre de Communication";"grade";"structure de recherche";"universite";"type de support";"theme"
<?php  
foreach($rows as $row){
    echo "\n"."'".$row['nom']."'".";"."'".$row['prenom']."'".";"."'".$row['titre_communication']."'".";"."'".$row['grade']."'".";"."'".$row['structure_recherche']."'".";"."'".$row['universite']."'".";"."'".$row['type_support']."'".";"."'".$row['theme']."'";
}
    
}
?>