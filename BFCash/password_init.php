<?php
/**
 * Created by IntelliJ IDEA.
 * User: pahima
 * Date: 30/11/15
 * Time: 16:05
 */
$page_title="modification du mot de passe";
$page_description="Permettre à l'utilisateur de modifier son mot de passe";

require "Includes/header.php";
require_once "Includes/functions.php";
require "Includes/db.php";

if(!empty($_POST)) {
    $errors = array();

    if(empty($_POST['newPasswd'])|| $_POST['newPasswd'] != $_POST['confirm_newPasswd']){
        $errors['passwd']="Veuillez verifier le mot de passe et la confirmation";
    }

    if (empty($errors)) {
        if(isset($_GET['id']) && isset($_GET['token'])) {
            $req = $cnx->prepare('SELECT * FROM utilisateurs WHERE idUser =:idUser AND reset_token IS NOT NULL AND reset_token =:resetToken');
            $req->execute(['idUser'=>$_GET['id'], 'resetToken'=>$_GET['token']]);
            $user = $req->fetch();
            if (!empty($user)) {
                if (!empty($_POST)) {
                    if (!empty($_POST['newPasswd']) && $_POST['newPasswd'] == $_POST['confirm_newPasswd']) {
                        $password = password_hash($_POST['newPasswd'], PASSWORD_BCRYPT);
                        $req2=$cnx->prepare('UPDATE utilisateurs SET passwdUser = :passwdUser, reset_at = NULL, reset_token = NULL');
                        $req2->execute(['passwdUser'=>$password]);
                        session_start();
                        $_SESSION['flash']['success'] = 'Votre mot de passe a bien été modifié';
                        $_SESSION['auth'] = $user;
                        echo "<script type='text/javascript'>document.location.replace('index.php');</script>";
                        exit();
                    }
                }
            }else {
                $_SESSION['flash']['error'] = "Ce token n'est pas valide";
                echo "<script type='text/javascript'>document.location.replace('index.php');</script>";
                exit();
            }
        }
    }
}

?>


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

            <h2 align="center">Enregistrer nouveau mot de passe</h2></br>
            <form class="form-horizontal" role="form" action="" method="post">

                <div class="form-group">
                    <label class="control-label col-sm-3" for="newPasswd">&nbsp;&nbsp;Nouveau mot de passe:</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" name="newPasswd" placeholder="Veuillez Entrer votre nouveau mot de passe">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-3" for="confirm_newPasswd">&nbsp;&nbsp;Confirmer mot de passe:</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" name="confirm_newPasswd" placeholder="Confirmer votre nouveau mot de passe">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-ms-3">
                        <button type="submit" class="btn btn-success center-block">Modifier</button>
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
