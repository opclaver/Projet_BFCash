<?php
/**
 * Created by IntelliJ IDEA.
 * User: pahima
 * Date: 11/11/15
 * Time: 12:22
 */
include "../Payline/include.php";
$page_title="Nos offres";
$page_description="Toutes nos offres de services";
$array = array();
$payline = new paylineSDK(MERCHANT_ID, ACCESS_KEY, PROXY_HOST, PROXY_PORT, PROXY_LOGIN, PROXY_PASSWORD, ENVIRONMENT);

/* Inclusion de l'entete */
require "Includes/header.php";

?>
<div id="offres">
    <span>Corps des offres</span>
    <?php
    // Affichage
    $array['token'] = $_GET['token'];
    if (isset($array['token'])){


        $response = $payline->getWebPaymentDetails($array);
        echo "nous sommes ici";
        echo $array['token'];
        echo "nous sommes la ";
        if(isset($response)){

            echo '<H3>RESPONSE</H3>';
            print_a($response, 0, true);

        }

        echo "ok ok";
        echo $response['result']['code'];
        echo NOTIFICATION_URL;

    }
    else
    {
        echo "token absent";
        echo NOTIFICATION_URL;
    }
    ?>
</div>

<?php
/* Inclusion du pied de page */
require "Includes/footer.php";

    