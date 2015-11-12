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
?>

<div id="corps">
    <div id="corps-main">

    </div>
    <div id="corps-right">
        </p>
        <div id="connexion">
            <div id="connexion-title">
                <label class="control-label">CONNEXION</label>
                </br>
            </div>
            </p></br>
            <form class="form-horizontal" role="form">
                <div class="form-group">
                    <label class="control-label col-sm-3" for="email">&nbsp;&nbsp;Email:</label>
                    <div class="col-sm-8">
                        <input type="email" class="form-control" id="email" placeholder="Entrer email">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3" for="pwd">&nbsp;&nbsp;Password:</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="pwd" placeholder="Entrer password">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-8">
                        <div class="checkbox">
                            <label><input type="checkbox"> Se souvenir de moi ?</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-ms-6">
                        <button type="submit" class="btn btn-success center-block">Connecter</button>
                    </div>
                </div>

            </form>
            <div class="form-group">
                <a href="register.php"> Creer un compte</a>
            </div>

        </div>
    </div>
</div>

<?php
    /*Inclusion du pied de page*/
    include("Includes/footer.php");
?>

</body>
</html>
