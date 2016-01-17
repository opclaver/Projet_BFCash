<?php
/**
 * Created by IntelliJ IDEA.
 * User: pahima
 * Date: 27/12/15
 * Time: 23:51
 */

$page_title="listes des beneficiaires enregistrés";
$page_description="Listes des beneficiaires enregistres";

/* Inclusion de l'entete */
require "Includes/header.php";
require_once "Includes/functions.php";
require_once "Includes/db.php";
?>

<div id="corps">
    <div id="corps-main">
        <?php
        if(!empty($_SESSION['flash']['success'])){

            ?>
            <div class="alert alert-success">
                <a href="index.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php
                echo $_SESSION['flash']['success'];
                $_SESSION['flash']['success'] ="";
                ?>
            </div>
        <?php }
        else{
            $_SESSION['flash']['success'] ="";
        }
        ?>
        <h2 align="center">Liste des bénéficiaires</h2>
        &nbsp;&nbsp;<a href="ajouterBeneficiaire.php" class="btn btn-primary" role="button">Ajouter bénéficiaire</a>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Nom et Prenom(s)</th>
                <th style="text-align: center">Email</th>
                <th>Téléphone</th>
                <th style="text-align: center">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
                $req=$cnx->prepare('SELECT * FROM beneficiaire where idUser=:idUser');
                $req->execute(['idUser'=>$_SESSION['idUser']]);

                while($beneficiaire= $req->fetch()):
                    $idBenef=$beneficiaire['idBenef'];?>
                    <tr>
                        <td><?php echo $beneficiaire['nomBenef'].'  '.$beneficiaire['prenomBenef']?></td>
                        <td><?php echo $beneficiaire['AdresseMailBenef']?></td>
                        <td><?php echo $beneficiaire['numTelBenef']?></td>
                        <td><a role="button" class="btn btn-primary btn-sm" href="modifierBeneficiaire.php?id=<?php echo $idBenef?>">Modifier</a><a style="float: right;" role="button" class="btn btn-danger btn-sm" href="supprimerBeneficiaire.php?id=<?php echo $idBenef?>"> Supprimer</a> </td>
                    </tr>
                <?php endwhile; ?>

            </tbody>
        </table>
    </div>
    <div id="corps-right">
        </p>
    </div>
</div>

<?php
/*Inclusion du pied de page*/
include("Includes/footer.php");