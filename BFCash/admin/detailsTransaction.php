<?php
/**
 * Created by IntelliJ IDEA.
 * User: pahima
 * Date: 27/12/15
 * Time: 23:50
 */
$page_title="Ajouter un nouveau béneficiaire";
$page_description="Page permettant d'ajouter un nouvel beneficiaire";

/* Inclusion de l'entete */
require "../Includes/admin/header.php";
require_once "../Includes/db.php";

?>

<div id="corps">
    <h2 align="center">Transaction en cours </h2>
    </br>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Reférence</th>
            <th style="text-align: center">Montant à transferer</th>
            <th style="text-align: center">Canal d'envoi</th>
            <th style="text-align: center">Date transfert</th>
            <th>Bénéficiaire</th>
            <th style="text-align: center">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $req=$cnx->prepare('SELECT t.idTrans,t.refTrans,t.dateExp,t.montantTrans,b.nomBenef,b.prenomBenef,c.codeCanal FROM transactions t,beneficiaire b,canal c where t.idBenef=b.idBenef AND t.idCanal=c.idCanal AND etatTrans=:etatTrans');
        $req->execute(['etatTrans'=>'valide']);

        while($transaction= $req->fetch()):
            $idTransac=$transaction['idTrans'];?>
            <tr>
                <td><?php echo $transaction['refTrans']?></td>
                <td style="text-align: center"><?php echo $transaction['montantTrans']?></td>
                <td style="text-align: center"><?php echo $transaction['codeCanal']?></td>
                <td style="text-align: center"><?php echo $transaction['dateExp']?></td>
                <td><?php echo $transaction['nomBenef'].'  '.$transaction['prenomBenef']?></td>
                <td><a role="button" class="btn btn-primary btn-sm" href="detailsTransaction.php?id=<?php echo $idTransac?>">Details  </a><a style="float: right" role="button" class="btn btn-success btn-sm" href="validerTransaction.php?id=<?php echo $idTransac?>"> Valider</a> </td>
            </tr>
        <?php endwhile; ?>

        </tbody>
    </table>

</div>

<?php
/*Inclusion du pied de page*/
include("../Includes/admin/footer.php");

