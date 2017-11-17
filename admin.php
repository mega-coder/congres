<?php

    include 'connexion.php';
    session_start();
    if(isset($_SESSION['email']) && isset($_SESSION['password']) && $_SESSION['role']=="admin")
    {
        $stmt = $db->prepare("select * from user where status='en cours' and role='participant' ");
        $stmt->execute();
?>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Arimo" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/admin.css">
    </head>
    <body>
        <div id="content">
        
            <div style="background:white;margin-bottom:0.5%;padding:1% 2%">
                <form class="form-group" style="width:50%;">
                   <label style="color:limegreen">filtrage par le status des participants</label>
                    <select name="status" class="form-control" id="status" style="display:inline">
                        <option value="0">veuillez selectionner le status des participants</option>
                        <option value="valide">inscription validées</option>
                        <option value="en cours">inscription en cours</option>
                    </select>
                </form>
            </div>        
           <div id="table">     
            <table class="table table-stripped">
                <thead>
                    <th>#</th>
                    <th>nom</th>
                    <th>prenom</th>
                    <th>Email</th>
                    <th>Pays</th>
                    <th>telephone</th>
                    <th>validation du réviseur</th>
                    <th>avis du réviseur</th>
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
                       <tr id="<?php echo $i; ?>">
                         <td><input type="checkbox" class="participant" value="<?php echo $row['id'];?>"></td>
                         <td><h6><?php echo $row['nom']; ?></h6></td>
                         <td><h6><?php echo $row['prenom']; ?></h6></td>
                         <td class="email"><h6><?php echo $row['email']; ?></h6></td>
                         <td><h6><?php echo $row['pays']; ?></h6></td>
                         <td><h6><?php echo $row['telephone']; ?></h6></td>
                         <td>
                         <?php if($row['reviseur_validation']==0) {?>
                         <span style="background:orange;color:white;padding:2x 5px;">en cours</span>
                         <?php } else if($row['reviseur_validation']==1){ ?>
                         <span style="background:green;color:white;padding:1% 3%;">oui</span>  
                         <?php } else { ?>
                         <span style="background:red;color:white;padding:1% 3%;">non</span>  
                         <?php }?>
                         </td>
                         <td><?php echo $row['commentaire']; ?></td>
                         <?php if($row['participation']=="avec"){ ?>
                             <td><?php echo $row['titre_communication']; ?></td>
                             <td><?php echo $row['grade']; ?></td>
                             <td><?php echo $row['structure_recherche']; ?></td>
                             <td><?php echo $row['universite']; ?></td>
                             <td><?php echo $row['type_support']; ?></td>
                           <td><div><span><?php echo $row['theme']; if($row['modified']==0) {?></span><img src="assets/images/edit.jpg" style="width:20;height:20px" class="edit"><?php } ?></div>
                            <select class="change">
                                <option>change</option>
                                <option value="theme1">theme1</option>
                                <option value="theme2">theme2</option>
                                <option value="theme3">theme3</option>
                            </select>
                            </td>
                             <?php if($row['type_support']=="orale") {?>
                             <td><a href="Formulaires_Orales/<?php echo $row['formulaire'];?>">
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
                         
            <div>
                <button class="btn btn-success" id="all">valider tout</button>
            </div>
                          
       </div>
        
        
        <script src="assets/js/jquery-3.2.1.min.js"></script>
        <script src="assets/js/admin.js"></script>
    </body>
    
</html>


<?php } else{
        
            header('location:login.php');
    }


