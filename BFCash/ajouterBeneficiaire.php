<?php
/**
 * Created by IntelliJ IDEA.
 * User: pahima
 * Date: 27/12/15
 * Time: 23:50
 */
$page_title="Ajouter un nouveau béneficiaire";
$page_description="Page permettant d'ajouter un nouvel beneficiaire";

/* Inclusion de l'entete */
require "Includes/header.php";
require_once "Includes/functions.php";
require_once "Includes/db.php";


if(!empty($_POST)) {
    $errors = array();

    if (empty($_POST['nomBenef']) || !preg_match('/^[a-zA-Z-9_]+$/', $_POST['nomBenef'])) {

        $errors['nom'] = "Veuillez entrer un nom correct";
    }
    if (empty($_POST['prenomBenef'])) {
        $errors['prenom'] = "Veuillez entrer un prenom correct";
    }

    if (empty($_POST['telBenef'])) {
        $errors['telephone'] = "Veuillez entrer un numero de telephone correct";

    }

    if (empty($_POST['emailBenef']) || !filter_var($_POST["emailBenef"], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = " Veuillez entrer un email valide";
    }

    if (empty($errors)) {
        // On enregistre les informations dans la base de données
        $req = $cnx->prepare("INSERT INTO beneficiaire (nomBenef,prenomBenef,numTelBenef,AdresseMailBenef,typeBenef,idUser) values (:nomBenef,:prenomBenef,:numTelBenef,:AdresseMailBenef,:typeBenef,:idUser)");
        $req->execute([
            ':nomBenef' => $_POST['nomBenef'],
            ':prenomBenef' => $_POST['prenomBenef'],
            ':numTelBenef' => $_POST['telBenef'],
            ':AdresseMailBenef' => $_POST['emailBenef'],
            ':typeBenef' => '1',
            ':idUser' => $_SESSION['idUser']
        ]);

        // Insertion de l'ajout du beneficiaire dans l'historique
        $dateHist=datefr2en(date("d-m-Y"));
        $req = $cnx->prepare("INSERT INTO historique (dateHist,idUser,idTach) values (:dateHist,:idUser,:idTach)");
        $req->execute([
            ':dateHist' => $dateHist,
            ':idUser' => $_SESSION['idUser'],
            ':idTach' => '1'
        ]);

        // On redirige l'utilisateur vers la page de liste des beneficiaires avec un message flash
        $_SESSION['flash']['success'] = 'Beneficiaire ajouté avec succès';

        echo "<script type='text/javascript'>document.location.replace('listerBeneficiaire.php');</script>";

        exit();
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

        <h2 align="center">Ajout de bénéficiaire</h2>
        <form class="form-horizontal" role="form" action="" method="post">
            <div class="form-group">
                <label class="control-label col-sm-3" for="nomBenef">&nbsp;&nbsp;Nom:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nomBenef" placeholder="Veuillez Entrer son nom">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-3" for="prenomBenef">&nbsp;&nbsp;Prénom:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="prenomBenef" placeholder="Veuillez Entrer son prénom">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-3" for="emailBenef">&nbsp;&nbsp;Adresse email:</label>
                <div class="col-sm-6">
                    <input type="email" class="form-control" name="emailBenef" placeholder="Veuillez Entrer son adresse email">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-3" for="telBenef">&nbsp;&nbsp;Téléphone:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="telBenef" placeholder="Veuillez Entrer son numero de telephone ">
                </div>
            </div>

            <div class="form-group">
                <div class="col-ms-3">
                    <button type="submit" class="btn btn-success center-block">Ajouter</button>
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

