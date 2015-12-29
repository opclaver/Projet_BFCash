<?php
/**
 * Created by IntelliJ IDEA.
 * User: pierreclaverouedraogo
 * Date: 20/11/15
 * Time: 00:12
 */
require "Includes/header.php";
require 'Includes/db.php';



$user_id = $_GET['id'];
$token = $_GET['token'];

$req = $cnx->query("SELECT * FROM utilisateurs WHERE idUser = $user_id");
$user = $req->fetch();
$date1 = date("Y-m-d");
//$date=datefr2en($date1);


if($user && $user['token']== $token ){

    $cnx->query("UPDATE utilisateurs SET confirm_date ='$date1', token= null, statutCompte= true WHERE idUser = $user_id");
    // $_SESSION['flash']['success'] = 'Votre compte a bien été validé';
    $_SESSION['auth'] = $user;

    echo "<script type='text/javascript'>document.location.replace('compte.php');</script>";


}else{

    echo "<script type='text/javascript'>document.location.replace('index.php');</script>";
}