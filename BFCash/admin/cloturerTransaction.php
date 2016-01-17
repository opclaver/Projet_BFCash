<?php
/**
 * Created by IntelliJ IDEA.
 * User: pahima
 * Date: 27/12/15
 * Time: 23:51
 */

$page_title="Admin: Cloture transaction";
$page_description="mise à jour des beneficiaires enregistres";

require "../Includes/admin/header.php";
require "../Includes/functions.php";
require_once "../Includes/db.php";

//Recuperation de l'identifiant de la transaction
$idTransact=$_GET['id'];
$req = $cnx->prepare("UPDATE transactions set etatTrans=:etatTrans,dateCloture=:dateCloture where idTrans=:idTrans");
$req->execute([
    ':etatTrans' => "CLOTURE",
    ':dateCloture'=>datefr2en(time()),
    ':idTrans' => $idTransact,
]);
//Message de succes
$_SESSION['flash']['success'] = 'Transaction cloturée avec succès';

//Redirection vers transactions en cours
echo "<script type='text/javascript'>document.location.replace('transactionacloturer.php');</script>";

include("../Includes/admin/footer.php");

?>