<?php
/**
 * Created by IntelliJ IDEA.
 * User: pahima
 * Date: 10/11/15
 * Time: 15:45
 */
 $page_title="Transfert d'argent vers l'Afrique et services mobiles associés";
 $page_description="Transfert d'argent moins cher vers le Burkina Faso";

/* Inclusion de l'entete */
require "Includes/header.php";
require_once "Includes/functions.php";
global $montant;
global $frais;
global $montantttc;

if(!empty($_POST)){
        $errors=array();

        if(empty($_POST['montant'])){

            $errors['montant']="Veuillez entrer le montant";

        }

        if($_POST['montant']> 1000 || $_POST['montant']<= 0){

            $errors['montant']="Veuillez entrer un montant inférieur à 1000 euros et supérieur à 0 euro";

        }
        if(empty($_POST['canal'])){

            $errors['canal']="Veuillez choisir un canal de transfert mobile";

        }

if(empty($errors)){
    $montant=$_POST['montant'];

    $frais=calculFrais($montant);

    $montantttc=($frais + $montant);
}



      }

?>

<div id="corps">
    <div id="corps-main">
        <?php
        // Affichage des erreurs
        if(!empty($errors)):?>
            <div class="alert alert-danger">

                <p> VÉRIFIER LES DONNÉES SAISIES</p>

                <ul>
                    <?php foreach($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>

                </ul>

            </div>

        <?php endif; ?>

        <div class="panel panel-default">
            <h2 align="center">Calculateur de Frais</h2>
            <div class="panel-body">
                <form class="form-horizontal" role="form" action="" method="post" name="form1" id="form1">
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="montant">&nbsp;&nbsp;MONTANT:</label>
                        <div class="col-sm-8">
                            <input type="number"  class="form-control" id="montant" name="montant"  size="10" placeholder="Veuillez Entrer un montant en euro compris entre 0 et 1000">
                        </div><br/><br/><br/>
                        <label class="control-label col-sm-3" for="canal">&nbsp;&nbsp;CANAL:</label>
                        <div class="col-sm-8">
                            Airtel Money &nbsp;&nbsp;<input type="radio" name="canal" value="1" >
                            &nbsp;&nbsp; MobiCash &nbsp;&nbsp; <input type="radio" name="canal" value="2" >
                        </div><br/><br/>

                        <fieldset>
                            <legend align="center">Récapitulatif de l'estimation</legend>
                            <label class="control-label col-sm-3" for="mt">&nbsp;&nbsp;MONTANT SAISI:</label>
                            <div class="col-sm-8">
                                <output id="mt" color="red"><?php echo $montant; ?> &nbsp;&nbsp; &nbsp;&nbsp;Euros</output>
                            </div>
                            <label class="control-label col-sm-3" for="frais">&nbsp;&nbsp;FRAIS:</label>
                            <div class="col-sm-8">
                                <output id="frais"><?php echo $frais; ?> &nbsp;&nbsp;&nbsp;&nbsp; Euros</output>
                            </div>
                            <label class="control-label col-sm-3" for="montantttc">&nbsp;&nbsp;MONTANT TTC:</label>
                            <div class="col-sm-8">
                                <output id="montantttc"> <?php  echo $montantttc; ?> &nbsp;&nbsp;&nbsp;&nbsp; Euros</output>
                            </div>
                        </fieldset>

                    </div>
                    <div class="form-group">
                        <div class="col-ms-6">
                            <button type="submit" class="btn btn-success center-block" >Calculer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="corps-right">
        </p>
        <?php require("Includes/login.php");?>
    </div>
</div>

<?php
    /*Inclusion du pied de page*/
    include("Includes/footer.php");
?>

</body>
</html>
