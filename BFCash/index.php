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
        if(!empty($_SESSION['flash']['success'])){

            ?>

            <div class="alert alert-success">
                <a href="index.php" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php
                echo $_SESSION['flash']['success'];
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
        <?php require("Includes/login.php");?>
    </div>
    <?php
  ?>

</div>

<?php
    /*Inclusion du pied de page*/
    include("Includes/footer.php");
?>

</body>
</html>
