<?php
/**
 * Created by IntelliJ IDEA.
 * User: pahima
 * Date: 09/01/16
 * Time: 12:54
 *
 */
$page_title="Page d'administration BFCash";
$page_description="Page permettant à l'administrateur de gerer les transactions";

/* Inclusion de l'entete */
require_once "../Includes/functions.php";
require_once "../Includes/db.php";

if(!empty($_POST)) {
    $errors = array();

    $req = $cnx->prepare('SELECT * FROM utilisateurs WHERE adresseMailUser = :login AND typeUser=:typeUser ');
    $req->execute(['login' => $_POST['mailAgent'],'typeUser'=>'Agent' ]);
    $user = $req->fetch();

    if(!password_verify($_POST['mtpasseAgent'], $user['passwdUser'])){
        $errors['login'] = "Email ou mot de passe incorrect";
    }

    if (empty($errors)) {
        //Creation de la session de l'utilisateur
        session_start();
        $_SESSION['nomUtilisateur'] = $user['nomUser'].' '.$user['prenomUser'];
        $_SESSION['idUser']=$user['idUser'];
        $_SESSION['loggedin_time'] = time();

        // On redirige l'utilisateur vers la page d'accueil
        echo "<script type='text/javascript'>document.location.replace('agentAccount.php');</script>";

        exit();
    }
}

?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <title><?php echo $page_title; ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="description" content="<?php echo $page_description; ?>" />

        <link rel="stylesheet" type="text/css"  href="/Projet_BFCash/BFCash/Ressources/bootstrap/css/bootstrap-select.min.css" />
        <link rel="stylesheet" type="text/css"  href="/Projet_BFCash/BFCash/Ressources/bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" type="text/css"  href="/Projet_BFCash/BFCash/Ressources/css/header.css" />
        <link rel="stylesheet" type="text/css"  href="/Projet_BFCash/BFCash/Ressources/css/corps.css" />
        <link rel="stylesheet" type="text/css"  href="/Projet_BFCash/BFCash/Ressources/css/footer.css" />


        <script type="text/javascript" src="/Projet_BFCash/BFCash/Ressources/scripts/adminAgent.js"></script>
        <script type="text/javascript" src="/Projet_BFCash/BFCash/Ressources/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="/Projet_BFCash/BFCash/Ressources/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/Projet_BFCash/BFCash/Ressources/bootstrap/js/bootstrap-select.min.js"></script>
        <script type="text/javascript" src="/Projet_BFCash/BFCash/Ressources/scripts/header.js"></script>

        <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/themes/base/jquery-ui.css" type="text/css" media="all" />
        <link rel="stylesheet" href="http://static.jquery.com/ui/css/demo-docs-theme/ui.theme.css" type="text/css" media="all" />

        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js" type="text/javascript"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/jquery-ui.min.js" type="text/javascript"></script>
        <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
    </head>

    <body>
        <script>
            jQuery(document).ready(function() {
                $('#connexionAgentForm').validate({
                    // Specify the validation rules
                    rules: {
                        mailAgent: "required",
                        mtpasseAgent: "required"
                    },
                    // Specify the validation error messages
                    messages: {
                        mailAgent: "Veuillez entrer un email valide",
                        mtpasseAgent: "Veuillez entrer un mot de passe valide"
                    },
                    submitHandler: function (form) {
                        form.submit();
                    },
                    highlight: function (element) {
                        $(element).closest('.form-group').addClass('has-error');
                    },
                    unhighlight: function (element) {
                        $(element).closest('.form-group').removeClass('has-error');
                    },
                    errorElement: 'span',
                    errorClass: 'help-block',
                    errorPlacement: function (error, element) {
                        if (element.parent('.input-group').length) {
                            error.insertAfter(element.parent());
                        } else {
                            error.insertAfter(element);
                        }
                    }
                });
            });
        </script>
        <div id="connexionAgent">
            <div class="panel panel-default">
                <div class="panel-heading" style="text-align: center"><h4>Authentification</h4></div>
                <div class="panel-body">
                    <?php
                    // Affichage des erreurs
                    if(!empty($errors)):?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php foreach($errors as $error): ?>
                                    <li><?php echo $error; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form id="connexionAgentForm" data-toggle="validator" class="form-horizontal" role="form" action="#" method="post">
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="mailAgent">&nbsp;&nbsp;Mail:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="mailAgent" placeholder="Veuillez Entrer votre email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="mtpasseAgent">&nbsp;&nbsp;Mot de passe:</label>
                            <div class="col-sm-6">
                                <input type="password" class="form-control" name="mtpasseAgent" placeholder="Veuillez Entrer votre mot de passe">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-8">
                                <a href="#"><label>Mot de passe oublié ?</label></a>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-ms-3">
                                <button type="submit" class="btn btn-success center-block">Se connecter</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

        </div>

    </body>

</html>