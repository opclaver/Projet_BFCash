<?php
/**
 * Created by IntelliJ IDEA.
 * User: pahima
 * Date: 09/01/16
 * Time: 13:52
 */
session_start();
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


    <script type="text/javascript" src="/Projet_BFCash/BFCash/Ressources/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="/Projet_BFCash/BFCash/Ressources/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/Projet_BFCash/BFCash/Ressources/bootstrap/js/bootstrap-select.min.js"></script>
    <script type="text/javascript" src="/Projet_BFCash/BFCash/Ressources/scripts/adminAgent.js"></script>
    <script type="text/javascript" src="/Projet_BFCash/BFCash/Ressources/scripts/header.js"></script>

    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/themes/base/jquery-ui.css" type="text/css" media="all" />
    <link rel="stylesheet" href="http://static.jquery.com/ui/css/demo-docs-theme/ui.theme.css" type="text/css" media="all" />

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js" type="text/javascript"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/jquery-ui.min.js" type="text/javascript"></script>
    <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>




    <script type="text/javascript">
        var loginTime = '<?php if(isset($_SESSION['loggedin_time'])) echo $_SESSION["loggedin_time"]; ?>';
        var userSession = '<?php if(isset($_SESSION['nomUtilisateur'])) echo $_SESSION["nomUtilisateur"]; ?>';
        function isLoginSessionExpired() {
            var login_session_duration =1200;
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
                document.location.replace('deconnexion_automatic.php');

            }
        }

        $(document).ready(function() {
            $('a[href="' + this.location.pathname + '"]').parent().addClass('active');
            
        });

    </script>

</head>

<body onload="chargerHeader()">
<div id="headers">
    <div id="entete-img">
        <div id="logo">
            <a href="/Projet_BFCash/BFCash/admin/agentAccount.php"><img src="/Projet_BFCash/BFCash/Ressources/img/logo2.png"></a>
        </div>
    </div>
    <div id="menu">
        <div class="navbar navbar-default">
            <!-- Collect the nav links, forms, and other content for toggling -->
            <ul class="nav navbar-nav">
                <li><a href="/Projet_BFCash/BFCash/admin/agentAccount.php" style="height: 50px">Accueil</a></li>
                <li><a href="/Projet_BFCash/BFCash/admin/transactionencours.php" style="height: 50px">Transactions en cours</a></li>
                <li><a href="/Projet_BFCash/BFCash/admin/transactionacloturer.php" style="height: 50px">Transactions à cloturer</a></li>
                <li><a href="/Projet_BFCash/BFCash/admin/recherche.php" style="height: 50px">Recherche</a></li>
                <?php
                    //echo $_SESSION["nomUtilisateur"];
                    if(isset($_SESSION['nomUtilisateur'])) {
                        $var=$_SESSION["nomUtilisateur"];
                        print('<li class="dropdown" id="userHeader"><a href="#" class="dropdown-toggle" data-toggle="dropdown" style="height: 50px"> ' ."$var".'<b class="caret"></b></a> <ul class="dropdown-menu"> <li><a href="#">Mon compte</a></li> <li><a href="#">Mes info</a></li> <li><a href="#">Mes transactions</a></li><li><a href="/Projet_BFCash/BFCash/listerBeneficiaire.php">Mes beneficiares</a></li> <li class="divider"></li> <li><a href="/Projet_BFCash/BFCash/deconnexion.php">Se déconnecter</a></li> </ul></li>');
                    }else{

                    }
                ?>

            </ul>
        </div>
    </div>

</div>

