<?php
// INITIALIZE
require_once("../../include.php");
require_once "../../../BFCash/Includes/functions.php";
$array = array();
global $typeBenef;
$payline = new paylineSDK(MERCHANT_ID, ACCESS_KEY, PROXY_HOST, PROXY_PORT, PROXY_LOGIN, PROXY_PASSWORD, ENVIRONMENT);
$payline->returnURL = RETURN_URL;
$payline->cancelURL = CANCEL_URL;
$payline->notificationURL = NOTIFICATION_URL;

//VERSION
$array['version'] = WS_VERSION;

// PAYMENT
$array['payment']['amount'] = ($_POST['montantTransf']+calculFrais($_POST['montantTransf']))*100;
$array['payment']['currency'] ='978';
$array['payment']['action'] = PAYMENT_ACTION;
$array['payment']['mode'] = PAYMENT_MODE;

// ORDER
$array['order']['ref'] = 'PHP-'.time();
$array['order']['amount'] = ($_POST['montantTransf']+calculFrais($_POST['montantTransf']))*100;
$array['order']['currency'] ='978';

// CONTRACT NUMBERS
$array['payment']['contractNumber'] = CONTRACT_NUMBER;
$contracts = explode(";",CONTRACT_NUMBER_LIST);
$array['contracts'] = $contracts;
$secondContracts = explode(";",SECOND_CONTRACT_NUMBER_LIST);
$array['secondContracts'] = $secondContracts;

//RECUPERATION INFOS FORMULAIRE
session_start();
$_SESSION['id_benef']=$_POST['beneficiaireTransf'];
$_SESSION['canal']=$_POST['canalTransf'];
$_SESSION['frais']=calculFrais($_POST['montantTransf']);
$_SESSION['ref']=$array['order']['ref'];
$_SESSION['mailBenef']=$_POST['mailBenef'];

if(!empty($_POST['typeBenef'])){
    $_SESSION['typeBenef']=true;
  }else{
    $_SESSION['typeBenef']=false;
  }

if(!empty($_POST['nomBenef'])){
  $_SESSION['nomBenef']=$_POST['nomBenef'];
}
if(!empty($_POST['prenomBenef'])){
  $_SESSION['prenomBenef']=$_POST['prenomBenef'];
}
if(!empty($_POST['telBenef'])){
  $_SESSION['telBenef']=$_POST['telBenef'];
}
if(!empty($_POST['typeBenef'])){
  $_SESSION['typeBenef']=$_POST['typeBenef'];
}

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
