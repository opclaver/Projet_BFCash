<?php
/**
 * Created by IntelliJ IDEA.
 * User: pahima
 * Date: 28/12/15
 * Time: 02:39
 */

$page_title="suppression des beneficiaires enregistrés";
$page_description="suppression d'un beneficiaire";

require('Includes/header.php');
require('Includes/db.php');

//Suppression du beneficiaire
$idBenef=$_GET['id'];
$req=$cnx->prepare("Delete from beneficiaire where idBenef=:idBenef");
$req->execute([':idBenef' => $idBenef]);
?>

<div id="corps">
    <div id="corps-main">

    </div>
    <div id="corps-right">
        </p>
        <?php require("Includes/login.php");?>
    </div>

</div>

<?php
//Message de succes
$_SESSION['flash']['success'] = 'Beneficiaire supprimé avec succès';

echo "<script type='text/javascript'>document.location.replace('listerBeneficiaire.php');</script>";

require('Includes/footer.php');



