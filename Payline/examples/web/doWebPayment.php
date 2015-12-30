<?php
// INITIALIZE
//require_once("../../include.php");
$array = array();
$payline = new paylineSDK(MERCHANT_ID, ACCESS_KEY, PROXY_HOST, PROXY_PORT, PROXY_LOGIN, PROXY_PASSWORD, ENVIRONMENT);
$payline->returnURL = RETURN_URL;
$payline->cancelURL = CANCEL_URL;
$payline->notificationURL = NOTIFICATION_URL;

//VERSION
$array['version'] = WS_VERSION;

// PAYMENT
$array['payment']['amount'] = $_POST['amount'];
$array['payment']['currency'] = $_POST['currency'];
$array['payment']['action'] = PAYMENT_ACTION;
$array['payment']['mode'] = PAYMENT_MODE;

// ORDER
$array['order']['ref'] = $_POST['ref'];
$array['order']['amount'] = $_POST['amount'];
$array['order']['currency'] = $_POST['currency'];

// CONTRACT NUMBERS
$array['payment']['contractNumber'] = CONTRACT_NUMBER;
$contracts = explode(";",CONTRACT_NUMBER_LIST);
$array['contracts'] = $contracts;
$secondContracts = explode(";",SECOND_CONTRACT_NUMBER_LIST);
$array['secondContracts'] = $secondContracts;

// EXECUTE
$response = $payline->doWebPayment($array);
if(isset($response) && $response['result']['code'] == '00000'){
 //header("location:".$response['redirectURL']);
 // echo "<script type='text/javascript'>document.location.replace('http://localhost:8888/Projet_BFCash/BFCash/simuler_frais.php');</script>";
  $var=$response['redirectURL'];
 // echo "<script type='text/javascript'>document.location.replace('https://homologation-webpayment.payline.com/webpayment/step2.do?reqCode=prepareStep2&token=2WKhnSbI8FNuUOuuw2561451406571989');</script>";
  echo "<script type='text/javascript'>document.location.replace('$var');</script>";


  exit();
}elseif(isset($response)) {
	echo 'ERROR : '.$response['result']['code']. ' '.$response['result']['longMessage'].' <BR/>';
}

?>
