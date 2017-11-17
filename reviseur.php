<?php

    session_start();
    if(isset($_SESSION['email']) && isset($_SESSION['password']) && $_SESSION['role']=="reviseur"){
        include'connexion.php';
         $stmt = $db->prepare("select * from user where status='en cours' and role='participant'");
         $stmt->execute();       
?> 

    <html>
        <head>
               <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
               <link href="https://fonts.googleapis.com/css?family=Arimo" rel="stylesheet">
               <link rel="stylesheet" href="assets/css/reviseur.css">
        </head>
        <body>
        
        <div id="content"> 
            <div>
                <button class="btn btn-success" id="all">valider</button>
                <a href="generer_excel.php" style="float:right"><img style="width:10%;height:10%" src="assets/images/excel2.png"/>exporter en fichier excel</a>
            </div>
            <div id="table">
            <table class="table table-stripped">
                <thead>
                    <th>#</th>
                    <th>nom</th>
                    <th>prenom</th>
                    <th>votre Commentaire</th>
                    <th>titre de Communication</th>
                    <th>grade</th>
                    <th>structure de recherche</th>
                    <th>universite/centre</th>
                    <th>type de support</th>
                    <th>Theme</th>
                    <th>Formulaire</th>
                </thead>
                <tbody>
                <?php 
                    $i=0;
                    while ($row=$stmt->fetch()){
                ?>
                       <tr id="tr<?php echo $i;?>">
                         <td id="<?php echo $row['id'];?>">
                             <INPUT type= "radio" name="validation<?php echo $i; ?>" value="1">oui<br> 
                             <INPUT type= "radio" name="validation<?php echo $i; ?>"  value="2">non
                         </td>
                         <td><h6><?php echo $row['nom']; ?></h6></td>
                         <td><h6><?php echo $row['prenom']; ?></h6></td>
                         <td><textarea style="height:200px;"></textarea></td>                             
                         <?php if($row['participation']=="avec"){ ?>
                             <td><?php echo $row['titre_communication'];?></td>
                             <td><?php echo $row['grade'];?></td>
                             <td><?php echo $row['structure_recherche'];?></td>
                             <td><?php echo $row['universite']; ?></td>
                             <td><?php echo $row['type_support'];?></td>
                             <td><?php echo $row['theme'];?></td> 
                             <?php if($row['type_support']=="orale") {?>
                             <td><a href="Formulaires_Orales/<?php echo $row['fomulaire'];?>">
                             <?php echo $row['formulaire'];?></a></td>  
                             <?php } else { ?>
                              <td><a href="Formulaire_Posters/<?php echo $row['formulaire'];?>">
                             <?php echo $row['formulaire'];?></a></td>  
                             <?php } ?> 
                       </tr> 
                        <?php $i=$i+1; ?>
                         <?php } ?>
                                   
             <?php } ?>            
                </tbody>        
            </table>
            
            </div>                      
       </div>
        
        
        
        <script src="assets/js/jquery-3.2.1.min.js"></script>       
        <script src="assets/js/reviseur.js"></script>
        </body>
    </html>                   
<?php  
        
    }
        else{
        header('location:login.php');
    }
?>