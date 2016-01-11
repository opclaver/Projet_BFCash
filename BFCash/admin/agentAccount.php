<?php
/**
 * Created by IntelliJ IDEA.
 * User: pahima
 * Date: 09/01/16
 * Time: 13:52
 */
//verification de l'authentification de l'utilisateur
session_start();
if(isset($_SESSION['typeUser']) && $_SESSION['typeUser']=="Agent"){

$page_title="Administration des transactions BFCash";
$page_description="Transfert d'argent moins cher vers le Burkina Faso";
    /* Inclusion de l'entete */
require "../Includes/admin/header.php";

?>
<div id="corps">
    <div id="corps-main">
       <?php echo $_SESSION['typeUser'];?>
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
</div>

<?php
/*Inclusion du pied de page*/
include("../Includes/admin/footer.php");
?>
</body>
</html>
<?php
}
else{
    echo "<script type='text/javascript'>document.location.replace('index.php');</script>";

}
?>


