<?php
/**
 * Created by IntelliJ IDEA.
 * User: pahima
 * Date: 10/11/15
 * Time: 15:45
 */
//session_start();
include "../../include.php";
$page_title="Transfert d'argent vers l'Afrique et services mobiles associés";
$page_description="Transfert d'argent moins cher vers le Burkina Faso";
$array = array();
$payline = new paylineSDK(MERCHANT_ID, ACCESS_KEY, PROXY_HOST, PROXY_PORT, PROXY_LOGIN, PROXY_PASSWORD, ENVIRONMENT);
/* Inclusion de l'entete */
require "../../../BFCash/Includes/header.php";
require_once "../../../BFCash/Includes/db.php";
?>
    <div id="corps">

    <div id="corps-main">
        <?php
        //taux d'échange
        $taux=655.99986544;
        // Affichage
        $array['token'] = $_GET['token'];
        $response = $payline->getWebPaymentDetails($array);
          /*  if(isset($response)){

                echo '<H3 align="center">RESULTAT DE LA TRANSACTION</H3>';
                print_a($response, 0, true);

*/
        // Récuperation bénéficiare
        $id=$_SESSION['id_benef'];
        $req=$cnx->prepare('SELECT * FROM beneficiaire where idBenef= ?');
        $req->execute(array($id));
        $beneficiaire= $req->fetch();

        // Récuperation Expéditeur
        $id=$_SESSION['idUser'];
        $req=$cnx->prepare('SELECT * FROM utilisateurs where idUser= ?');
        $req->execute(array($id));
        $expediteur= $req->fetch();

   ?>
        <br/>
        <div class="alert alert-success">
            <H5 align="center"> <?php echo $response['result']['shortMessage']; ?></H5>
        </div>

    <div class="panel panel-default">
        <div class="panel-heading" style="text-align: center"><h4>Détails de la transaction</h4></div><br/>
        <div class="panel-body">
            <form class="form-horizontal">
            <div class="form-group">
                <label class="control-label col-sm-3" for="date"> Date :</label>
                <output class="col-sm-6" id="date" style="float:right"><?php echo $response['transaction']['date']; ?></output>
            </div>
             <div class="form-group">
                <label class="control-label col-sm-3" for="montant"> Montant :</label>
                 <output class="col-sm-6" id="montant" style="float:right"><?php echo ($response['payment']['amount']/100) - $_SESSION['frais']; echo "&nbsp;&nbsp;"; echo "EUR";?></output>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="fraisTransf"> Frais de transfert :</label>
                <output class="col-sm-6" id="fraisTransf" style="float:right"><?php  echo $_SESSION['frais'];echo "&nbsp;&nbsp;";echo "EUR"; ?></output>

            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="montanttotal"> Montant total :</label>
               <output class="col-sm-6" id="montanttotal" style="float:right"><?php   echo $response['payment']['amount']/100;echo "&nbsp;&nbsp;"; echo "EUR";?></output>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="tauxchange"> Taux de change :</label>
                <output class="col-sm-6" id="tauxchange" style="float:right"><?php  echo $taux; echo "&nbsp;&nbsp;";echo "XOF"; ?></output>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-3" for="montantenvoye"> Montant envoyé :</label>
                <output class="col-sm-6" id="montantenvoye" style="float:right"><?php  echo (($response['payment']['amount']/100) - $_SESSION['frais'])* $taux;echo "&nbsp;&nbsp;"; echo "XOF"; ?></output>
            </div>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="canal"> Canal d'envoi :</label>
                    <output class="col-sm-6" id="canal" style="float:right"><?php  echo $_SESSION['canal']; ?></output>
                </div>

            </form>
        </div>
    </div>
            <div class="form-group">
                    <div class="col-sm-6"><b><u>Expéditeur</u></b>
                        <div class="form-horizontal">
                            <div class="form-group">
                            <div class="col-sm-12">
                                <output class="col-sm-9" id="nomexpediteur"><?php echo $expediteur['nomUser'];echo "&nbsp;&nbsp;"; echo $expediteur['prenomUser'];?></output>
                            </div>
                        </div>
                            <div class="form-group">
                            <div class="col-sm-12">
                                    <output id="adresseexpediteur"><?php echo $expediteur['villeUser'];echo "&nbsp;&nbsp;"; echo $expediteur['paysUser']; //$response['transaction']['date']; ?></output>
                                </div>
                            </div>
                            <div class="form-group">
                            <div class="col-sm-12">
                                    <output id="adressemailexpediteur"><?php echo $expediteur['adresseMailUser']; ?></output>
                                </div>
                            </div>
                    </div>
                    </div>

                    <div class="col-sm-6">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><u>Bénéficiaire</u></b>
                              <div class="form-horizontal">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <output id="nombeneficiaire"><?php echo $beneficiaire['nomBenef'];echo "&nbsp;&nbsp;";echo $beneficiaire['prenomBenef'];?></output>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <output id="numerotelbeneficiaire"><?php echo $beneficiaire['numTelBenef'];?></output>
                                    </div>
                                </div>
                                  <div class="form-group">
                                      <div class="col-sm-12">
                                          <output id="mailbeneficiaire"><?php echo $beneficiaire['AdresseMailBenef'];?></output>
                                      </div>
                                  </div>

                            </div>
                        </div>


                </div>

    </div>
        <div id="corps-right">
            </p>
            <?php //require("../../../BFCash/Includes/login.php");?>
        </div>
    </div>
<?php
/*Inclusion du pied de page*/
include("../../../BFCash/Includes/footer.php");
