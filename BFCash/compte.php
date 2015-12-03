<?php
/**
 * Created by IntelliJ IDEA.
 * User: pierreclaverouedraogo
 * Date: 20/11/15
 * Time: 00:31
 */
session_start();
/* Inclusion de l'entete */
require "Includes/header.php";
?>

    <div id="corps">
        <div id="corps-main">
            <?php
            if(!empty($_SESSION['flash']['success'])){

                ?>

                <div class="alert alert-success">
                    <?php
                    echo $_SESSION['flash']['success']='Votre compte a bien été validé et vous etes maintenant connecté';
                    $_SESSION['flash']['success'] ="";
                    ?>
                </div>
            <?php }
            else{
                $_SESSION['flash']['success'] ="";
            }

            ?>


        </div>
        <div id="corps-right">
            </p>

        </div>
    </div>

<?php
/* Inclusion du pied de page */
require "Includes/footer.php";

