<?php
/**
 * Created by IntelliJ IDEA.
 * User: pahima
 * Date: 11/11/15
 * Time: 12:12
 */

/* Inclusion  de fucntion */

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

    <link rel="stylesheet" href="style.css" type="text/css" media="all" />
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/themes/base/jquery-ui.css" type="text/css" media="all" />
    <link rel="stylesheet" href="http://static.jquery.com/ui/css/demo-docs-theme/ui.theme.css" type="text/css" media="all" />

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js" type="text/javascript"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/jquery-ui.min.js" type="text/javascript"></script>



</head>

<body>
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
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="index.php">Accueil <span class="sr-only"></span></a></li>
                        <li><a href="index.php">A propos</a></li>
                        <li><a href="offers.php">Nos offres</a></li>
                        <li><a href="index.php">Tarifs</a></li>
                        <li><a href="index.php">Estimer</a></li>
                        <li><a href="index.php">Contacter-nous</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
    </div>

</div>

    <?php if(isset($_SESSION['flash'])):?>
        <?php foreach($_SESSION['flash'] as $type => $message): ?>

            <div class="lert alert-<?=$type; ?>">

                <?= $message; ?>

            </div>
        <?php endforeach; ?>

        <?php unset($_SESSION['flash']); ?>

    <?php endif; ?>
