<?php
/**
 * Created by IntelliJ IDEA.
 * User: pahima
 * Date: 11/11/15
 * Time: 20:39
 */
 function connect_bd(){
     try {
         $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
         // INFORMATIONS DE CONNEXION
         $host = 'localhost';
         $dbname = 'dbBfCash';
         $user = 'root';
         $password = 'root';

         // FIN DES DONNEES
         $pdo = new PDO('mysql:host='.$host.';dbname='.$dbname.'', $user, $password, $pdo_options);

         return $pdo;
     } catch (Exception $e) {
         die('Erreur de connexion : ' . $e->getMessage());
     }
 }


//Fonction de deconnexion de la session
function deconecter() {

    // Détruisez les variables de session
    $_SESSION = array();

    // Retournez les paramètres de session
    $params = session_get_cookie_params();
    // Effacez le cookie.
    setcookie(session_name(),
        '', time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]);

    // Détruisez la session
    session_destroy();
}
//Verifier l'expiration de la session
function isLoginSessionExpired() {
    $login_session_duration = 10;
    $current_time = time();
    if(isset($_SESSION['loggedin_time']) and isset($_SESSION["nomUtilisateur"])){
        if(((time() - $_SESSION['loggedin_time']) > $login_session_duration)){
            return true;
        }
    }
    return false;
}
