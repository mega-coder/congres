<?php
    session_start();
    include 'connexion.php';
    if(isset($_SESSION['email']) && isset($_SESSION['password']) && $_SESSION['role']=="participant"){    
    $stmt = $db->prepare("select * from user where email=:email and password=:password");
    $stmt->bindParam(':email',$_SESSION['email']);
    $stmt->bindParam(':password',$_SESSION['password']);
    $stmt->execute();
    $row = $stmt->fetch();
    $stmt = $db->prepare("select * from activites");
    $stmt->execute();
    $activites =$stmt->fetchAll();
?>
    
    
    
<html>
    <head>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
      <link href="https://fonts.googleapis.com/css?family=Arimo" rel="stylesheet">
      <link rel="stylesheet" href="assets/css/participant.css">  
    </head>
    <body>       
        <div id="content">
            <div id="condidature">
                <div class="nom_prenom">
                   <div style="float:left">
                       <span><span style="color:limegreen;margin-right:10px;">Nom et prénom:</span><?php echo $row['nom'];?>  <span></span><span><?php echo $row['prenom'];?></span></span>
                    </div>
                    <div id="x" style="float:right">
                        <img src="assets/images/login.png" alt='fff'/>
                        <div><span style="margin-left:20px"><span style="color:limegreen">Date</span>: 12-12-2017</span></div>
                        <?php if($row['status'] == "valide" && $row['periode'] == ""){ ?>
                        <span>Veuillez Remplir ce formulaire</span>
                        <form class="form-group" name="form" id="form"> 
                          <label>la période</label>
                          <select class="form-control" id="periode" style="margin-bottom:3%" required>
                               <option>1 jours</option>
                               <option>tout le congrés</option>
                           </select>
                           <input type="checkbox" class="activite" value="activité1" >activité1<br>  
                           <input type="checkbox" class="activite" value="acticite2" >activité2<br>
                           <input type="checkbox" class="activite" value="activite3" >activité3 <br> 
                           <input type="submit" class="form-control btn btn-success" value="envoyer"/>
                        </form>                         
                        <?php } ?>       
                    </div>
                </div>
                <div>
                    <span><span style="color:limegreen;margin-right:10px;">Email:</span><?php echo $row['email'];?></span> 
                </div>
                <div>
                    <span><span style="color:limegreen;margin-right:10px;">Pays:</span> <?php echo $row['pays'];?></span> 
                </div>
                  <div>
                      <span><?php if($row['status'] =='en cours') { ?><span style="color:limegreen;margin-right:10px;">status de la condidature:</span ><span style="background:orange;color:white;padding:5px 10px;"><?php echo $row['status'];?>
                      </span>
                      <?php } else{ ?>
                      <span style="color:limegreen;margin-right:10px;">status de la condidature:</span><span style="background:green;color:white;padding:5px 10px;"><?php echo $row['status'];?>
                      </span>
                      </span>
                   
                    <div id="attestation" style="margin-top:3%; <?php if($row['status'] == "valide" && $row['periode'] !=""){ ?>display:block;<?php } else {?>display:none;<?php } ?>">
                        <img src="assets/images/pdf-icon.png" style="width:5%;height:15%"/><a href="generer_pdf.php" style="text-decoration">Télécharger votre attestation d'inscription</a>        
                    </div>
                      <?php } ?>
                 </div>
                
                
            </div>
        </div>
        <script src="assets/js/jquery-3.2.1.min.js"></script>
        <script src="assets/js/participant.js"></script>
    </body>
</html>               
<?php
        
    }
    else{
        header('location:login.php');
    }

?>