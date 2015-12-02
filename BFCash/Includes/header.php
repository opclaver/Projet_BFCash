<?php
/**
 * Created by IntelliJ IDEA.
 * User: pahima
 * Date: 11/11/15
 * Time: 12:12
 */
require "Includes/functions.php";
session_start();
 ?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
    <title><?php echo $page_title; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="description" content="<?php echo $page_description; ?>" />

    <link rel="stylesheet" type="text/css"  href="Ressources/bootstrap/css/bootstrap-select.min.css" />
    <link rel="stylesheet" type="text/css"  href="Ressources/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css"  href="Ressources/css/header.css" />
    <link rel="stylesheet" type="text/css"  href="Ressources/css/corps.css" />
    <link rel="stylesheet" type="text/css"  href="Ressources/css/footer.css" />


    <script type="text/javascript" src="Ressources/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="Ressources/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="Ressources/bootstrap/js/bootstrap-select.min.js"></script>
    <script type="text/javascript" src="Ressources/scripts/connexion.js"></script>
    <script type="text/javascript" src="Ressources/scripts/header.js"></script>

    <script type="text/javascript">
        var loginTime = '<?php if(isset($_SESSION['loggedin_time'])) echo $_SESSION["loggedin_time"]; ?>';
        var userSession = '<?php if(isset($_SESSION['nomUtilisateur'])) echo $_SESSION["nomUtilisateur"]; ?>';
        function isLoginSessionExpired() {
            var login_session_duration = 5;
            var current_time = '<?php echo time()?>';
            if(loginTime!="" && userSession!=""){
                if(((current_time - loginTime) > login_session_duration)){
                    return true;
                }
            }
            return false;
        }
        function chargerHeader(){
            if( !isLoginSessionExpired() && userSession!=''){
                $("#connexion").hide();
            }else if(isLoginSessionExpired()){
                //Redirection vers la page deconnexion
                <?php
                    $_SESSION['userExpire']= "Session expirée , reconnecter vous";
                    ?>
                //$("#msgSessionTimeOut").html("&nbsp;Session expirée , reconnecter vous");
                document.location.replace('deconnexion.php');



            }
        }
    </script>

</head>

<body onload="chargerHeader()">
<div id="header">
    <div id="entete-img">
        <div id="logo">
            <h1><a href="index.php"><span>BFCash</span></a></h1>
        </div>
    </div>
    <div id="menu">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-collapse-1">
                    <ul class="nav navbar-nav" id="navbar-nav-1">
                        <li><a href="index.php">Accueil <span class="sr-only"></span></a></li>
                        <li><a href="index.php">A propos</a></li>
                        <li><a href="offers.php">Nos offres</a></li>
                        <li><a href="index.php">Tarifs</a></li>
                        <li><a href="index.php">Estimer</a></li>
                        <li><a href="index.php">Contacter-nous</a></li>
                        <?php
                            //echo $_SESSION["nomUtilisateur"];
                            if(isset($_SESSION['nomUtilisateur'])) {
                                $var=$_SESSION["nomUtilisateur"];
                                print('<li class="dropdown" id="userHeader"><a href="#" class="dropdown-toggle" data-toggle="dropdown"> ' ."$var".'<b class="caret"></b></a> <ul class="dropdown-menu"> <li><a href="#">Mon compte</a></li> <li><a href="#">Mes info</a></li> <li><a href="#">Mes transactions</a></li> <li class="divider"></li> <li><a href="deconnexion.php">Se déconnecter</a></li> </ul></li>');
                            }else{

                            }

                        ?>

                    </ul>

                </div><!-- /.navbar-collapse -->


            </div><!-- /.container-fluid -->
        </nav>
    </div>

</div>
