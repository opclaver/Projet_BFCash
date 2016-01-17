<?php
/**
 * Created by IntelliJ IDEA.
 * User: pahima
 * Date: 27/12/15
 * Time: 23:51
 */

$page_title="mise à jour des beneficiaires enregistrés";
$page_description="mise à jour des beneficiaires enregistres";

require "../Includes/admin/header.php";
require "../Includes/functions.php";
require_once "../Includes/db.php";

//Recuperation de l'identifiant de la transaction
$idTransact=$_GET['id'];
$req = $cnx->prepare("UPDATE transactions set etatTrans=:etatTrans,dateTraitmt=:dateTraitmt where idTrans=:idTrans");
$req->execute([
    ':etatTrans' => "VALIDE",
    ':dateTraitmt'=> datefr2en(time()),
    ':idTrans' => $idTransact,
]);
//Message de succes
$_SESSION['flash']['success'] = 'Transaction validée avec succès';

//Redirection vers transactions en cours
echo "<script type='text/javascript'>document.location.replace('transactionencours.php');</script>";

include("../Includes/admin/footer.php");

?>