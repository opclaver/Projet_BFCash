<?php
/**
 * Created by IntelliJ IDEA.
 * User: pahima
 * Date: 27/12/15
 * Time: 23:50
 */

require_once "../Includes/db.php";
//Type de la transaction :(validation ou cloture)
$type=$_POST['type'];

if(!empty($_POST) && !empty($_POST['transactionId'])){

    $req=$cnx->prepare('SELECT t.idTrans,t.refTrans,t.dateExp,t.montantTrans,b.nomBenef,b.prenomBenef,b.numTelBenef,c.codeCanal FROM transactions t,beneficiaire b,canal c where t.idBenef=b.idBenef AND t.idCanal=c.idCanal AND etatTrans=:etatTrans AND t.idTrans=:idTrans');
    if($type=="validation")
        $req->execute(['etatTrans'=>'EC VALIDE','idTrans'=>$_POST['transactionId']]);
    else if($type=="cloture")
        $req->execute(['etatTrans'=>'VALIDE','idTrans'=>$_POST['transactionId']]);
    $transaction = $req->fetch();

    // On indique qu'il n'y a aucune erreur
    $json['error'] = '1';

    //Récuperation des données
    $json['dateExp']=$transaction['dateExp'];
    $json['montantTrans']=$transaction['montantTrans'];
    $json['codeCanal']=$transaction['codeCanal'];
    $json['nomBenef']=$transaction['nomBenef'];
    $json['prenomBenef']=$transaction['prenomBenef'];
    $json['numTelBenef']=$transaction['numTelBenef'];

}else{
    $json['error'] = '0';
}

// Encodage de la variable tableau json et affichage
echo json_encode($json);