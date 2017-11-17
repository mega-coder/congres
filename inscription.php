<?php
      
            $message = array();
            $message["message"] = "success";
            include 'connexion.php';
            include 'chainealeatoire.php';
            include 'nomdedomaine.php';
            include 'sendmail.php';
            $password=generer(12);
            $nom = $_POST["nom"];
            $prenom = $_POST["prenom"];
            $email = $_POST["email"];
            $pays = $_POST["pays"];
            $type="";
            $telephone = $_POST["telephone"];
            $target_dir="";
            $target_file="";
            $path="";
            $formulaire="";
            $participation=$_POST["participation"];
            $status="en cours";
            $role="participant";
            $theme="";
            $grade="";
            $titre_communication="";
            $structure_recherche="";
            $universite="";
            $date=date("Y-m-d"); 
            $stmt="";



            if($_FILES["formulaire"]["name"]!=null){
              /*  $target_dir = "Documents/";
                $target_file = $target_dir.basename($_FILES["document"]["name"]);
                $_FILES["document"]["name"]=$_POST["nom"]."_".$_POST["prenom"]."_".$date.".".pathinfo($target_file,PATHINFO_EXTENSION);
                move_uploaded_file($_FILES["document"]["tmp_name"], $target_dir.basename($_FILES["document"]["name"]));
                $path= $_FILES["document"]["name"];*/
                $theme=$_POST["theme"];
                $type=$_POST["type"];
                if($type=="orale")
                {
                        $target_dir = "Formulaires_Orales/";

                }
                
                else{
                    $target_dir = "Formulaires_Posters/";    
                }
                
                $target_file = $target_dir.basename($_FILES["formulaire"]["name"]);
                $_FILES["formulaire"]["name"]=$_POST["nom"]."_".$_POST["prenom"]."_".$date.".".pathinfo($target_file,PATHINFO_EXTENSION);
                move_uploaded_file($_FILES["formulaire"]["tmp_name"], $target_dir.basename($_FILES["formulaire"]["name"]));
                $formulaire= $_FILES["formulaire"]["name"];
                $grade=$_POST["grade"];                
                $titre_communication=$_POST["titre_communication"];
                $structure_recherche=$_POST["structure_recherche"];                
                $universite=$_POST["universite"];
                
                  $stmt = $db->prepare("INSERT INTO user (nom,prenom,email,telephone,password,pays,participation,type_support,theme,status,role,grade,titre_communication,structure_recherche,universite,date_creation,formulaire) VALUES (:nom,:prenom,:email,:telephone,:password,:pays,:participation,:type_support,:theme,:status,:role,:grade,:titre_communication,:structure_recherche,:universite,:date_creation,:formulaire)");
                  $stmt->bindParam(':nom',$nom);
                  $stmt->bindParam(':prenom',$prenom);
                  $stmt->bindParam(':email', $email);
                  $stmt->bindParam(':password', $password); 
                  $stmt->bindParam(':telephone',$telephone); 
                  $stmt->bindParam(':pays',$pays);  
                  $stmt->bindParam(':participation',$participation); 
                  $stmt->bindParam(':type_support',$type);
                  $stmt->bindParam(':theme',$theme); 
                  $stmt->bindParam(':status',$status); 
                  $stmt->bindParam(':grade',$grade);
                  $stmt->bindParam(':titre_communication',$titre_communication); 
                  $stmt->bindParam(':structure_recherche',$structure_recherche); 
                  $stmt->bindParam(':universite',$universite); 
                  $stmt->bindParam(':date_creation',$date);
                  $stmt->bindParam(':role',$role);
                  $stmt->bindParam(':formulaire',$formulaire); 
            }

            else{
                
                 $stmt = $db->prepare("INSERT INTO user (nom,prenom,email,telephone,password,pays,participation,status,role,date_creation) VALUES (:nom,:prenom,:email,:telephone,:password,:pays,:participation,:status,:role,:date_creation)");
                  $stmt->bindParam(':nom',$nom);
                  $stmt->bindParam(':prenom',$prenom);
                  $stmt->bindParam(':email', $email);
                  $stmt->bindParam(':password', $password); 
                  $stmt->bindParam(':telephone',$telephone); 
                  $stmt->bindParam(':pays',$pays); 
                  $stmt->bindParam(':participation',$participation); 
                  $stmt->bindParam(':status',$status); 
                  $stmt->bindParam(':role',$role); 
                  $stmt->bindParam(':date_creation',$date); 
              
            }

                $stmt->execute(); 
                sendMail($email,$password,$nom_de_domaine);
                $message["message"] =$path;
                echo json_encode($message);

?>





