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
    <span>Nos offres</span>
</div>

<?php
/* Inclusion du pied de page */
require "Includes/footer.php";

    