<?php
/**
 * Created by IntelliJ IDEA.
 * User: pahima
 * Date: 11/11/15
 * Time: 20:39
 */

// Fonction pour debugger les erreurs
   function debug($var){

            echo '<pre>' . print_r($var,true) . '</pre>';
        }

// Fonction pour generer le token pour l'envoi de mail et l'activation du compte

    function str_random($length){
        $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
        return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
    }

function datefr2en($mydate){
    @list($jour,$mois,$annee)=explode('-',$mydate);
    return @date('Y/m/d');
}
 function connect_bd(){
     try {
         $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
         // INFORMATIONS DE CONNEXION
         $host = 'localhost';
         $dbname = 'dbbfcash';
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
    session_start();
    session_destroy();
}
//Verifier l'expiration de la session
function isLoginSessionExpired() {
    $login_session_duration = 60;
    $current_time = time();
    if(isset($_SESSION['loggedin_time']) and isset($_SESSION["nomUtilisateur"])){
        if(((time() - $_SESSION['loggedin_time']) > $login_session_duration)){
            return true;
        }
    }
    return false;
}

function calculFrais($mt){

          if ($mt<= 38.50){

              $commision=2.50;

          }
          elseif ($mt > 38.50 && $mt <= 76.50){

            $commision=3.75;

            }

          elseif ($mt > 76.50 && $mt <= 152.50){

              $commision=6;

          }
          else {
              $commision=($mt*2.5)/100;
          }

    return $commision;
}