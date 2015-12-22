<?php
/**
 * Created by IntelliJ IDEA.
 * User: pahima
 * Date: 30/11/15
 * Time: 16:05
 */
$page_title="Transfert d'argent vers l'Afrique et services mobiles associés";
$page_description="Transfert d'argent moins chers vers le Burkina Faso";

if(!empty($_POST) && !empty($_POST['mail']) ){
    $mail=$_POST['mail'];

    //Fonction d'envoie de mail
    mail($mail, 'Modification du mot de passe', "Afin de modifier votre mot de passe merci de cliquer sur ce lien\n\nhttp://localhost:8888/Projet_BFCash/BFCash/password_recover_form.php?");

}
header("Location: index.php");
