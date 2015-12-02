<?php
/**
 * Created by IntelliJ IDEA.
 * User: pahima
 * Date: 13/11/15
 * Time: 16:45
 */
require "Includes/db.php";

if(!empty($_POST) && !empty($_POST['login']) && !empty($_POST['passwd'])){
    $req = $cnx->prepare('SELECT * FROM utilisateurs WHERE adresseMailUser = :login AND passwdUser= :passwd');
    $req->execute(['login' => $_POST['login'],'passwd' => $_POST['passwd']]);
    $countUser = $req->rowCount();


    if($countUser==1){
        // On indique qu'il n'y a aucune erreur
        $json['error'] = '1';
        while ($data = $req->fetch()){
            $json['nom'] = $data['nomUser'];
            $json['prenom'] = $data['prenomUser'];

            //Creation de la session
            session_start();
            $_SESSION['nomUtilisateur'] = $json['nom'].' '.$json['prenom'];
            $_SESSION['loggedin_time'] = time();
            $json['user'] = $_SESSION['nomUtilisateur'];
        }
    }else{
        $json['error'] = $cnx;
    }
}

$req->closeCursor();

// Encodage de la variable tableau json et affichage
echo json_encode($json);