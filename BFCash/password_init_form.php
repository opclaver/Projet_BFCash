<?php
/**
 * Created by IntelliJ IDEA.
 * User: pahima
 * Date: 30/11/15
 * Time: 15:00
 */
/* Inclusion de l'entete */
$page_title="BFCash:Récuperation du mot de passe";
$page_description="Transfert d'argent moins chers vers le Burkina Faso";
require "Includes/header.php";
?>

<div id="corps">
    <div id="corps-main">
        <div id="corps-header">
            <span><b>Recupération de votre mot de passe</b></span>
            </p></br>
            <div class="panel panel-default">
                <div class="panel-body">
                    <form action="password_forgot.php" class="form-horizontal" method="POST">
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="mail">&nbsp;&nbsp;Mail:</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="mail" placeholder="Entrer email">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-ms-6">
                                <button type="submit" class="btn btn-success center-block" >Valider</button>
                            </div>
                        </div>
                   </form>
                </div>
            </div>
        </div>

    </div>
    <div id="corps-right">
        </p>
        <?php require("Includes/login.php");?>
    </div>
</div>

<?php
/*Inclusion du footer */
include("Includes/footer.php");
?>
