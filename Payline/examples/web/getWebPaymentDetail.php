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
        // Affichage
        $array['token'] = $_GET['token'];
        $response = $payline->getWebPaymentDetails($array);
            if(isset($response)){

                echo '<H3 align="center">RESULTAT DE LA TRANSACTION</H3>';
                print_a($response, 0, true);
                ?>
                <div class="form-group">
                      <fieldset>
                            <legend align="center"><?php echo $response['result']['shortMessage'];?></legend><br/>
                          <label class="control-label col-sm-3" for="reference">&nbsp;&nbsp;REF COMMANDE:</label>
                          <div class="col-sm-8">
                              <output id="reference"><?php echo $response['transaction']['id']; ?></output>
                          </div>
                          <label class="control-label col-sm-3" for="date">&nbsp;&nbsp;DATE COMMANDE:</label>
                          <div class="col-sm-8">
                              <output id="date"><?php echo $response['transaction']['date']; ?></output>
                          </div>
                            <label class="control-label col-sm-3" for="modePaiement">&nbsp;&nbsp;PAR :</label>
                            <div class="col-sm-8">
                                <output id="modePaiement"><?php echo $response['payment']['mode']; ?></output>
                            </div>
                            <label class="control-label col-sm-3" for="montant">&nbsp;&nbsp;MONTANT TTC:</label>
                            <div class="col-sm-8">
                                <output id="montant"><?php echo $response['payment']['amount']/100; ?> &nbsp;&nbsp;EUR</output>
                            </div>

                          <label class="control-label col-sm-3" for="fraisTransf">&nbsp;&nbsp;fraisTransf:</label>
                          <div class="col-sm-8">
                              <output id="fraisTransf"><?php echo  $_SESSION['frais']; ?> &nbsp;&nbsp;EUR</output>
                          </div>
                          <label class="control-label col-sm-3" for="user">&nbsp;&nbsp;User:</label>
                          <div class="col-sm-8">
                              <output id="uer"><?php echo $_SESSION['idUser']; ?></output>
                          </div>
                          <label class="control-label col-sm-3" for="beneficiaire">&nbsp;&nbsp;Beneficiaire:</label>
                          <div class="col-sm-8">
                              <output id="beneficiaire"><?php echo $_SESSION['id_benef'];?></output>
                          </div>
                          <label class="control-label col-sm-3" for="canal">&nbsp;&nbsp;canal:</label>
                          <div class="col-sm-8">
                              <output id="canal"><?php echo $_SESSION['canal']; ?> &nbsp;&nbsp;</output>
                          </div>
                        </fieldset>

                    </div>

            <?php  } ?>
    </div>
        <div id="corps-right">
            </p>
            <?php //require("../../../BFCash/Includes/login.php");?>
        </div>
</div>
<?php
/*Inclusion du pied de page*/
include("../../../BFCash/Includes/footer.php");
