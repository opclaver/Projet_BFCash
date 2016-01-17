<?php
/**
 * Created by IntelliJ IDEA.
 * User: pahima
 * Date: 13/11/15
 * Time: 16:45
 *
 * Valeur de CodeErreur:
 *  1: succes
 *  0: nomuser ou mt passe incorrect
 *  -1: compte non activé
 */
require "Includes/db.php";

if(!empty($_POST) && !empty($_POST['login']) && !empty($_POST['passwd'])){
    //$password=password_hash($_POST['passwd'], PASSWORD_BCRYPT);
    //$password=$_POST['passwd'];
    $req = $cnx->prepare('SELECT * FROM utilisateurs WHERE adresseMailUser = :login AND typeUser=:typeUser ');
    $req->execute(['login' => $_POST['login'],'typeUser'=>'Internaute' ]);
    $user = $req->fetch();
    //$countUser = $req->rowCount();
    $json['passwd'] = $user['passwdUser'];
    if(password_verify($_POST['passwd'], $user['passwdUser'])){
        if($user['statutCompte']=='1'){
            // On indique qu'il n'y a aucune erreur
            $json['error'] = '1';

            //Creation de la session
            session_start();
            $_SESSION['nomUtilisateur'] = $user['nomUser'].' '.$user['prenomUser'];
            $_SESSION['idUser']=$user['idUser'];
            $_SESSION['typeUser']=$user['typeUser'];
            $_SESSION['adresseMailUser']=$user['adresseMailUser'];
            $_SESSION['loggedin_time'] = time();
            $json['user'] = $_SESSION['nomUtilisateur'];
        }else{
            //Utilisateur non activé
            $json['error'] = '-1';
        }

    }else{
        //Nom d'utilisateur ou mt passe incorrect
        $json['error'] = '0';

    }
}



// Encodage de la variable tableau json et affichage
echo json_encode($json);