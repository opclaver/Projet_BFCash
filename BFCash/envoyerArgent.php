<?php
/**
 * Created by IntelliJ IDEA.
 * User: pahima
 * Date: 30/12/15
 * Time: 10:30
 */

$page_title="Faire transfert";
$page_description="Page permettant de renseigner les informations sur le paiement";

/* Inclusion de l'entete */
require "Includes/header.php";
require_once "Includes/functions.php";
require_once "Includes/db.php";

?>
<script>
    jQuery(document).ready(function()
    {
        // On cache le formulaire

        jQuery('#formNouveauBenef').hide();
        // toggle() lorsque le lien avec l'ID #toggler est cliqué
        jQuery('#choixNewBenef').click(function()
        {
            jQuery('#formNouveauBenef').toggle(400);
            jQuery('#choixNewBenef').checked();
            return false;
        });
        jQuery('#choixListBenef').click(function()
        {
            jQuery('#formNouveauBenef').hide();
            jQuery('#choixListBenef').checked();
            return false;
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

        <h2 align="center">Envoyer de l'argent</h2>
        <form class="form-horizontal" role="form" action="" method="post">
            <div class="form-group">
                <label class="control-label col-sm-3" for="civilite">&nbsp;&nbsp;Pays:</label>
                <div class="col-sm-6">
                    <select class="form-control" name="pays">
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
                        <option value="Burkina_Faso">Burkina_Faso </option>
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
                <label class="control-label col-sm-3" for="canal">&nbsp;&nbsp;Canal:</label>
                <div class="col-sm-6">
                    <select class="form-control" name="canal">
                        <option value="">Choisissez le canal d'envoi</option>
                        <option value="airtelMoney">Airtel Money </option>
                        <option value="mobiCash">MobiCash </option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-3" for="montant">&nbsp;&nbsp;Montant:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="montant" placeholder="euro">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-3" for="canal">&nbsp;&nbsp;Frais:</label>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-3" for="canal">&nbsp;&nbsp;Montant Total:</label>
            </div>

            <div class="form-group">
                <fieldset>
                    <legend align="center">Informations bénéficiaire</legend>
                    <div class="form-group">
                        <label class="control-label col-sm-3" for="canal">&nbsp;&nbsp;Bénéficiaire:</label>
                        <label class="radio-inline"><input type="radio" name="optradio" id="choixListBenef" checked>
                            <div class="col-sm-12">
                                <select class="form-control" name="canal">
                                    <option value="">Séléctionnez un bénéficiaire</option>
                                    <option value="airtelMoney">Airtel Money </option>
                                    <option value="mobiCash">MobiCash </option>
                                </select>
                            </div>
                        </label>
                        <label class="radio-inline"><input type="radio" name="optradio" id="choixNewBenef">Ajouter un bénéficiaire</label>
                        <div id="formNouveauBenef">
                            </br>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="nomBenef">&nbsp;&nbsp;Nom:</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="nomBenef" placeholder="Veuillez Entrer le nom du bénéficiaire">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="prenomBenef">&nbsp;&nbsp;Prénom:</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="prenomBenef" placeholder="Veuillez Entrer le prénom du bénéficiaire">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="telBenef">&nbsp;&nbsp;Téléphone:</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="telBenef" placeholder="Veuillez Entrer le téléphone du bénéficiaire">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="mailBenef">&nbsp;&nbsp;Mail:</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="mailBenef" placeholder="Veuillez Entrer le mail du bénéficiaire">
                                </div>
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
    <div id="corps-right">
        </p>
    </div>
</div>

<?php
/*Inclusion du pied de page*/
include("Includes/footer.php");
