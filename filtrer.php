<?php

    include 'connexion.php';
    extract($_POST);
    $stmt = $db->prepare('select * from user where status =:status');
    $stmt->bindParam('status',$status);
    $stmt->execute();
    if($status == "valide"){
?>
            <table class="table table-stripped">
                <thead>
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
<?php } else if($status == "en cours") { ?>
       
       
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
            
    <?php } ?>
        
        
        