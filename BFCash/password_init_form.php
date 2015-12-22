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
require_once "Includes/db.php";


    if (empty($_POST['mail']) || !filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL)) {
        $errors = " Veuillez entrer un email valide";
    }

    if (empty($errors)) {
        $req = $cnx->prepare('SELECT * FROM utilisateurs WHERE adresseMailUser = ?');
        $req->execute([$_POST['mail']]);
        $user = $req->fetch();
        if ($user) {
            session_start();
            $reset_token = str_random(60);
            $cnx->prepare('UPDATE utilisateurs SET reset_token = ?, reset_at = NOW() WHERE id = ?')->execute([$reset_token, $user['idUser']]);
            $_SESSION['flash']['success'] = 'Les instructions du rappel de mot de passe vous ont été envoyées par emails';
            mail($_POST['mail'], 'Réinitiatilisation de votre mot de passe', "Afin de réinitialiser votre mot de passe merci de cliquer sur ce lien\n\nhttp://local.dev/Lab/Comptes/reset.php?id={$user->id}&token=$reset_token");
            header('Location: index.php');
            exit();
        } else {
            $_SESSION['flash']['danger'] = 'Aucun compte ne correspond à cette adresse';
        }

    }

?>

<div id="corps">
    <div id="corps-main">
        <div id="corps-header">
            <?php
            // Affichage des erreurs
            if(!empty($errors)){?>
                <div class="alert alert-danger">
                    <p><?php echo $errors;?></p>
                </div>
            <?php }?>

            <span><b>Recupération de votre mot de passe</b></span>
            </p>
            <div class="panel panel-default">
                <div class="panel-body">
                    <form class="form-horizontal" role="form" action="password_init_form.php" method="post">
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="mail">&nbsp;&nbsp;Mail:</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="mail" placeholder="Entrer email" placeholder="Veuillez Entrer votre email">
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
