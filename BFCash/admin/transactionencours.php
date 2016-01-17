<?php
/**
 * Created by IntelliJ IDEA.
 * User: pahima
 * Date: 27/12/15
 * Time: 23:50
 */
$page_title="Admin: Validation des transactions en cours";
$page_description="Page permettant d'ajouter un nouvel beneficiaire";

/* Inclusion de l'entete */
require "../Includes/admin/header.php";
require_once "../Includes/db.php";

?>

<div id="corps">
    <script>
        jQuery(document).ready(function()
        {
            jQuery('.BtnValid').click(function()
            {
                var taux=655.99986544;
                var transactionId = $(this).data('id');
                var postData="transactionId="+transactionId+"&type=validation";
                $.ajax({
                    type:'POST',
                    data: postData,
                    dataType: 'json',
                    url: 'http://localhost:8888/Projet_BFCash/BFCash/admin/ajaxDetailsTransaction.php',
                    success: function (res) {
                        var codErreur = res['error'];
                        if (codErreur == "1") {
                            //Afficher resultat dans le modal
                            $("#dateTransaction").html(res['dateExp']);
                            $("#montantTransaction").html(res['montantTrans']*taux +" FCFA");
                            $("#canalTransaction").html(res['codeCanal']);
                            $("#benefTransaction").html(res['nomBenef']+" "+res['prenomBenef']);
                            $("#telTransaction").html(res['numTelBenef']);
                            //Affichage du modal
                            jQuery('#myModal').modal().$backdrop.set(true);
                        } else if (codErreur == "0") {
                            //Afficher erreur
                            alert('ERROR AJAX');
                        }
                    },
                    error: function (request, status, error) {
                        //Afficher erreur
                        alert('ERROR');
                    }
                });

            });
        });

    </script>

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
        $req=$cnx->prepare('SELECT t.idTrans,t.refTrans,t.dateExp,t.montantTrans,b.nomBenef,b.prenomBenef,b.numTelBenef,c.codeCanal FROM transactions t,beneficiaire b,canal c where t.idBenef=b.idBenef AND t.idCanal=c.idCanal AND etatTrans=:etatTrans');
        $req->execute(['etatTrans'=>'EC VALIDE']);

        while($transaction= $req->fetch()):
            $idTransac=$transaction['idTrans'];?>
            <tr>
                <td><?php echo $transaction['refTrans']?></td>
                <td style="text-align: center"><?php echo $transaction['montantTrans']?></td>
                <td style="text-align: center"><?php echo $transaction['codeCanal']?></td>
                <td style="text-align: center"><?php echo $transaction['dateExp']?></td>
                <td><?php echo $transaction['nomBenef'].'  '.$transaction['prenomBenef']?></td>
                <td><a data-toggle="modal" data-target="#myModal" data-id="<?php echo $idTransac;?>" role="button" class="btn btn-primary btn-sm BtnValid" href="#">Details  </a><a style="float: right" role="button" class="btn btn-success btn-sm" href="validerTransaction.php?id=<?php echo $idTransac?>"> Valider</a> </td>
            </tr>
        <?php endwhile; ?>

        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="vertical-alignment-helper">
            <div class="modal-dialog vertical-align-center">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>

                        </button>
                        <h4 class="modal-title" id="myModalLabel">Details de la transaction</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal">
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="dateTransaction"> Date :</label>
                                <output class="col-sm-6" id="dateTransaction" style="float:right"></output>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="montantTransaction"> Montant :</label>
                                <output class="col-sm-6" id="montantTransaction" style="float:right"></output>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-3" for="canalTransaction"> Canal d'envoi :</label>
                                <output class="col-sm-6" id="canalTransaction" style="float:right"></output>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-3" for="benefTransaction"> Bénéficiaire :</label>
                                <output class="col-sm-6" id="benefTransaction" style="float:right"></output>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="telTransaction"> Téléphone :</label>
                                <output class="col-sm-6" id="telTransaction" style="float:right"></output>
                            </div>

                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                        <button type="button" class="btn btn-primary">Valider</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

<?php
/*Inclusion du pied de page*/
include("../Includes/admin/footer.php");

