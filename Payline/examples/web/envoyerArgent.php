<?php
/**
 * Created by IntelliJ IDEA.
 * User: pahima
 * Date: 30/12/15
 * Time: 10:30
 */

$page_title="Faire transfert";
$page_description="Page permettant de renseigner les informations sur le paiement";

include "../../include.php";
/* Inclusion de l'entete */
require "../../../BFCash/Includes/header.php";
require_once "../../../BFCash/Includes/db.php";

global $montant;
global $frais;
global $montantttc;

/*
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
    if(empty($_POST['beneficaire'])){
        $errors['benef']="Veuillez séléctetionner un bénéficiaire";
    }
    if($_POST['benef']=="newBenef"){
        if(empty($_POST['nomBenef'])){
            $errors['nomBenef']="Veuillez renseigner le nom du  bénéficiaire";
        }
        if(empty($_POST['prenomBenef'])){
            $errors['prenomBenef']="Veuillez renseigner le prenom du bénéficiaire";
        }
        if(empty($_POST['telBenef'])){
            $errors['telBenef']="Veuillez renseigner le téléphone du bénéficiaire";
        }


    }
}
*/
?>
<script>
    function calculFrais(mt){
        if (mt<= 38.50){
            commision=2.50;
        }else if (mt > 38.50 && mt <= 76.50){
            commision=3.75;
        }
        else if (mt > 76.50 && mt <= 152.50){
            commision=6;
        }
        else{
                commision=(mt*2.5)/100;
            }
        return commision;
    }

    jQuery(document).ready(function()
    {
        // On cache le formulaire
        jQuery('#montantttcTransfOut').hide();
        jQuery('#fraisTransfOut').hide();

        jQuery('#formNouveauBenef').hide();
        // toggle() lorsque le lien avec l'ID #toggler est cliqué
        jQuery('#choixNewBenef').click(function()
        {
            if(!jQuery('#choixNewBenef').checked){
                jQuery('#formNouveauBenef').toggle(400);
                jQuery('#choixNewBenef').checked();
            return false;
            }
        });
        jQuery('#choixListBenef').click(function()
        {
            jQuery('#formNouveauBenef').hide();
            jQuery('#choixListBenef').checked();
            return false;
        });

        //Gestion du focus sur la saisie du montant
        jQuery('#montantTransf').focusout(function() {
            var montantTransf = $('#montantTransf').val();
            montantTransf = parseFloat(montantTransf);
            if (montantTransf){
                var frais = calculFrais(montantTransf);
                var montanttotal = montantTransf + frais;

                $('#fraisTransfOut').empty().prepend(frais + " &nbsp;&nbsp;&nbsp;&nbsp; Euros");
                $('#montantttcTransfOut').empty().prepend(montanttotal + " &nbsp;&nbsp;&nbsp;&nbsp; Euros");
                jQuery('#montantttcTransfOut').show();
                jQuery('#fraisTransfOut').show();
            }else{
                $('#fraisTransfOut').empty();
                $('#montantttcTransfOut').empty();
            }

        });

        //Validation du formulaire
        $('#transferArgentForm').validate({
            // Specify the validation rules
            rules: {
                canalTransf: "required",
                montantTransf: "required",
                beneficiaireTransf: "required",
                nomBenef: "required",
                prenomBenef: "required",
                telBenef: "required"
            },

            // Specify the validation error messages
            messages: {
                canalTransf: "Veuillez preciser le canal d'envoi",
                montantTransf: "Veuillez entrer le montant du transfert",
                beneficiaireTransf: "Veuillez selectionner le bénéficiaire",
                nomBenef: "Veuillez entrer le nom du bénéficiaire",
                prenomBenef: "Veuillez entrer le prénom du bénéficiaire",
                telBenef: "Veuillez entrer le téléphone du bénéficiaire"
            },
            submitHandler: function(form) {
                form.submit();
            },
            highlight: function(element) {
                $(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function(element) {
                $(element).closest('.form-group').removeClass('has-error');
            },
            errorElement: 'span',
            errorClass: 'help-block',
            errorPlacement: function(error, element) {
                if(element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            }
        });
    });

</script>
<div id="corps">
    <div id="corps-main">

        <?php
        // Affichage des erreurs
        if(!empty($errors)):?>
            <div class="alert alert-danger">
                <p> Vous n'avez pas bien rempli le formulaire</p>
                <ul>
                    <?php foreach($errors as $error): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <div class="panel panel-default">
            <h2 align="center">Envoyer de l'argent</h2>
            <div class="panel-body">
                <form id="transferArgentForm" data-toggle="validator" class="form-horizontal" role="form" action="../web/doWebPayment.php" method="post">
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="paysTransf">&nbsp;&nbsp;Pays:</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="paysTransf" disabled>
                                <option value="">Choisissez votre pays</option>
                                <option value="Barbade">Barbade </option>
                                <option value="Bahrein">Bahrein </option>
                                <option value="Belgique">Belgique </option>
                                <option value="Belize">Belize </option>
                                <option value="Benin">Benin </option>
                                <option value="Bermudes">Bermudes </option>
                                <option value="Bielorussie">Bielorussie </option>
                                <option value="Bolivie">Bolivie </option>
                                <option value="Botswana">Botswana </option>
                                <option value="Bhoutan">Bhoutan </option>
                                <option value="Boznie_Herzegovine">Boznie_Herzegovine </option>
                                <option value="Bresil">Bresil </option>
                                <option value="Brunei">Brunei </option>
                                <option value="Bulgarie">Bulgarie </option>
                                <option value="Burkina_Faso" selected>Burkina Faso </option>
                                <option value="Burundi">Burundi </option>
                                <option value="Caiman">Caiman </option>
                                <option value="Cambodge">Cambodge </option>
                                <option value="Cameroun">Cameroun </option>
                                <option value="Canada">Canada </option>
                                <option value="Canaries">Canaries </option>
                                <option value="Cap_vert">Cap_Vert </option>
                                <option value="Chili">Chili </option>
                                <option value="Chine">Chine </option>
                                <option value="Chypre">Chypre </option>
                                <option value="Colombie">Colombie </option>
                                <option value="Comores">Colombie </option>
                                <option value="Congo">Congo </option>
                                <option value="Congo_democratique">Congo_democratique </option>
                                <option value="Cook">Cook </option>
                                <option value="Coree_du_Nord">Coree_du_Nord </option>
                                <option value="Coree_du_Sud">Coree_du_Sud </option>
                                <option value="Costa_Rica">Costa_Rica </option>
                                <option value="Cote_d_Ivoire">CÃ´te_d_Ivoire </option>
                                <option value="Croatie">Croatie </option>
                                <option value="Cuba">Cuba </option>
                                <option value="Danemark">Danemark </option>
                                <option value="Djibouti">Djibouti </option>
                                <option value="Dominique">Dominique </option>
                                <option value="Egypte">Egypte </option>
                                <option value="Emirats_Arabes_Unis">Emirats_Arabes_Unis </option>
                                <option value="Equateur">Equateur </option>
                                <option value="Erythree">Erythree </option>
                                <option value="Espagne">Espagne </option>
                                <option value="Estonie">Estonie </option>
                                <option value="Etats_Unis">Etats_Unis </option>
                                <option value="Ethiopie">Ethiopie </option>
                                <option value="Falkland">Falkland </option>
                                <option value="Feroe">Feroe </option>
                                <option value="Fidji">Fidji </option>
                                <option value="Finlande">Finlande </option>
                                <option value="France">France </option>
                                <option value="Gabon">Gabon </option>
                                <option value="Gambie">Gambie </option>
                                <option value="Georgie">Georgie </option>
                                <option value="Ghana">Ghana </option>
                                <option value="Gibraltar">Gibraltar </option>
                                <option value="Grece">Grece </option>
                                <option value="Grenade">Grenade </option>
                                <option value="Groenland">Groenland </option>
                                <option value="Guadeloupe">Guadeloupe </option>
                                <option value="Guam">Guam </option>
                                <option value="Guatemala">Guatemala</option>
                                <option value="Guernesey">Guernesey </option>
                                <option value="Guinee">Guinee </option>
                                <option value="Jan Mayen">Jan Mayen </option>
                                <option value="Japon">Japon </option>
                                <option value="Jersey">Jersey </option>
                                <option value="Jordanie">Jordanie </option>

                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3" for="canalTransf">&nbsp;&nbsp;Canal:</label>
                        <div class="col-sm-6">
                            <select class="form-control" name="canalTransf" id="canalTransf">
                                <option value="">Choisissez le canal d'envoi</option>
                                <option value="airtelMoney">Airtel Money </option>
                                <option value="mobiCash">MobiCash </option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3" for="montantTransf">&nbsp;&nbsp;Montant:</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="montantTransf" id="montantTransf" placeholder="Montant en euro compris entre 0 et 1000">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3" for="fraisTransf">&nbsp;&nbsp;Frais:</label>
                        <div class="col-sm-3">
                            <b id="fraisTransfOut" style="color:red"></b>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-3" for="montantttcTransf">&nbsp;&nbsp;Montant Total:</label>
                        <div class="col-sm-3">
                            <b id="montantttcTransfOut" name="montantttcTransfOut" style="color:red"></b>
                        </div>
                    </div>

                    <div class="form-group">
                        <fieldset>
                            <legend align="center">Informations bénéficiaire</legend>
                            <div class="form-group">
                                <label class="control-label col-sm-3">&nbsp;&nbsp;Bénéficiaire:</label>
                                <label class="radio-inline"><input type="radio" name="optradio" id="choixListBenef" checked>
                                    <div class="col-sm-12">
                                        <select class="form-control" name="beneficiaireTransf" id="beneficiaireTransf">

                                            <option value=""> Choisir un bénéficiaire</option>
                                            <?php
                                            $id=$_SESSION['idUser'];
                                            $req=$cnx->prepare('SELECT * FROM beneficiaire where typeBenef= true and idUser= ?');
                                            $req->execute(array($id));
                                            $beneficiaire= $req->fetch();
                                            do {
                                                ?>
                                                <option value="<?php echo $beneficiaire['idBenef']?>"><?php echo $beneficiaire['nomBenef'].'  '.$beneficiaire['prenomBenef']?></option>
                                                <?php
                                            } while($beneficiaire= $req->fetch());
                                            ?>
                                        </select>

                                    </div>
                                </label>
                                <label class="radio-inline"><input type="radio" name="optradio" id="choixNewBenef">Ajouter un bénéficiaire</label>
                                <div id="formNouveauBenef">
                                    </br>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3" for="nomBenef">&nbsp;&nbsp;Nom:</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="nomBenef" id="nomBenef" placeholder="Veuillez Entrer le nom du bénéficiaire">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3" for="prenomBenef">&nbsp;&nbsp;Prénom:</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="prenomBenef" id="prenomBenef" placeholder="Veuillez Entrer le prénom du bénéficiaire">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3" for="telBenef">&nbsp;&nbsp;Téléphone:</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="telBenef" id="telBenef" placeholder="Veuillez Entrer le téléphone du bénéficiaire">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3" for="mailBenef">&nbsp;&nbsp;Mail:</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="mailBenef" id="mailBenef" placeholder="Veuillez Entrer le mail du bénéficiaire">
                                        </div>
                                    </div>
                                    <div class="form-group" style="margin-left:90px">
                                        <label class="checkbox-inline"><input type="checkbox" value="">Ajouter ce bénéficiaire au repertoire</label>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>

                    <div class="form-group">
                        <div class="col-ms-3">
                            <button type="submit" class="btn btn-success center-block">Proceder au paiement</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <div id="corps-right">
        </p>
    </div>
</div>

<?php
/*Inclusion du pied de page*/
include("../../../BFCash/Includes/footer.php");
