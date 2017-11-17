<?php
require('fpdf.php');
require ('connexion.php');
session_start();

    if(isset($_SESSION['email']) && isset($_SESSION['password']) && $_SESSION['role']=="participant"){    
    $stmt = $db->prepare("select * from user where email=:email and password=:password");
    $stmt->bindParam(':email',$_SESSION['email']);
    $stmt->bindParam(':password',$_SESSION['password']);
    $stmt->execute();
    $row = $stmt->fetch();
    $activites= utf8_decode($row['activites']); 
    $activite = utf8_decode("Activités");
    $periode =utf8_decode($row['periode']);  
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont("Arial","B",20);
    $pdf->Cell(0,30,"Attestation d'inscription",1,1,'C'); 
    $pdf->SetFont("Arial","",16);   
    $pdf->Cell(180,30,"Nom :   {$row['nom']}",0,1,'C'); 
    $pdf->Cell(180,0,"Prenom :     {$row['prenom']}",0,1,'C'); 
    $pdf->Cell(180,30,"Email :     {$row['email']}",0,1,'C');
    $pdf->Cell(180,0,"Periode :     {$periode}",0,1,'C');
    $pdf->Cell(180,30,"{$activite}". ":    ".$activites,0,1,'C');
    $pdf->output();
    }
?>