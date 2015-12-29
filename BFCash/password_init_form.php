<?php
/**
 * Created by IntelliJ IDEA.
 * User: pahima
 * Date: 30/11/15
 * Time: 15:00
 */

/* Inclusion de l'entete */
$page_title="BFCash:Récuperation du mot de passe";
$page_description="recuperation du mot de passe ";

require "Includes/header.php";
require_once "Includes/functions.php";
require "Includes/db.php";

if(!empty($_POST)) {
    $errors = array();

    if (empty($_POST['mailRecup']) || !filter_var($_POST["mailRecup"], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = " Veuillez entrer un email valide";
    }

    if (empty($errors)) {

        //On recupere l'utilisateur dans la base de données
        $req = $cnx->prepare('SELECT * FROM utilisateurs WHERE adresseMailUser = :mailUser');
        $req->execute(['mailUser' => $_POST['mailRecup']]);
        $user = $req->fetch();

        if (!empty($user)) {
            //echo "<script>alert(\"la variable est nulle\")</script>";
            $reset_token = str_random(60);
            $req2 = $cnx->prepare('UPDATE utilisateurs SET reset_token = :resetToken, reset_at = NOW() WHERE idUser = :idUser');
            $req2->execute(['resetToken' => $reset_token, 'idUser' => $user['idUser']]);
            $user_id = $user['idUser'];
            $_SESSION['flash']['success'] = 'Les instructions du rappel de mot de passe vous ont été envoyées par emails';
            mail($_POST['mailRecup'], 'Réinitialisation de votre mot de passe', "Afin de réinitialiser votre mot de passe merci de cliquer sur ce lien\n\nhttp://localhost:8888/Projet_BFCash/BFCash/password_init.php?id=$user_id&token=$reset_token");

            echo "<script type='text/javascript'>document.location.replace('index.php');</script>";
            exit();
        }else{
            $_SESSION['flash']['danger'] = 'Aucun compte ne correspond à cette adresse';
        }
    }
}

?>


<div id="corps">
    <div id="corps-main">
        <?php
        if(!empty($_SESSION['flash']['danger'])){
            ?>

            <div class="alert alert-danger">
                <?php
                echo $_SESSION['flash']['danger'];
                $_SESSION['flash']['danger'] ="";
                ?>
            </div>
        <?php }
        else{
            $_SESSION['flash']['danger'] ="";
        }

        ?>

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

        <h2 align="center">Recuperation du mot de passe</h2></br>
        <form class="form-horizontal" role="form" action="" method="post">
            <div class="form-group">
                <label class="control-label col-sm-3" for="mailRecup">&nbsp;&nbsp;Mail:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="mailRecup" placeholder="Veuillez Entrer votre email">
                </div>
            </div>
            <div class="form-group">
                <div class="col-ms-3">
                    <button type="submit" class="btn btn-success center-block">Valider</button>
                </div>
            </div>
        </form>

    </div>
    <div id="corps-right">
        </p>
        <?php require("Includes/login.php");?>
    </div>

</div>
<?php
/*Inclusion du footer */
include("Includes/footer.php");

