<?php
    
         function sendMail($mail){
        
            if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn|congresfirstak@gmail.com).[a-z]{2,4}$#", $mail)) // 
            {
                $passage_ligne = "\r\n";
            }
            else
            {
                $passage_ligne = "\n";
            }
            //=====Déclaration des messages au format texte et au format HTML.
            $message_txt = "félicitation votre inscription a èté valildée";
            $message_html = "<html>
                                <head></head>
                                <body>
                                <h5>félicitation votre inscription a èté valildée.</h5>
                                  vous pouvez désormais accéder à votre espace et télécharger votre attestation d'inscription;
                                </body>
                                </html>";
            //==========

            //=====Création de la boundary
            $boundary = "-----=".md5(rand());
            //==========

            //=====Définition du sujet.
            $sujet = "validation";
            //=========

            //=====Création du header de l'e-mail.
            $header = "From: \"congresfirstak\"<congresfirstak@gmail.com>".$passage_ligne;
            $header.= "Reply-to: \"congresfirstak\" <congresfirstak@gmail.com>".$passage_ligne;
            $header.= "MIME-Version: 1.0".$passage_ligne;
            $header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
            //==========

            //=====Création du message.
            $message = $passage_ligne."--".$boundary.$passage_ligne;
            //=====Ajout du message au format texte.
            $message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
            $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
            $message.= $passage_ligne.$message_txt.$passage_ligne;
            //==========
            $message.= $passage_ligne."--".$boundary.$passage_ligne;
            //=====Ajout du message au format HTML
            $message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
            $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
            $message.= $passage_ligne.$message_html.$passage_ligne;
            //==========
            $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
            $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
            //==========

            //=====Envoi de l'e-mail.
            mail($mail,$sujet,$message,$header);         
    }
    
?>