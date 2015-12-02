
<div id="connexion">
    <div id="connexion-title">
        <label class="control-label">CONNEXION</label>
        </br>
    </div>
    <?php
    session_start(); echo "Session:".$_SESSION['nomUtilisateur']; if(isset($_SESSION['userExpire'])) {$var= $_SESSION['userExpire']; echo "Test".$var;} ?>
    <span id="msgSessionTimeOut"><?php echo $var ?><br/></span>
    <form action="connexion2.php" id="connexionForm" class="form-horizontal" method="POST">
        <div class="form-group">
            <label class="control-label col-sm-3" for="login">&nbsp;&nbsp;Email:</label>
            <div class="col-sm-8">
                <input type="email" class="form-control" id="login" placeholder="Entrer email">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="passwd">&nbsp;&nbsp;Password:</label>
            <div class="col-sm-8">
                <input type="password" class="form-control" id="passwd" placeholder="Entrer password">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-8">
                <a href="password_init_form.php"><label>Mot de passe oublié ?</label></a>
            </div>
        </div>
        <span id="erreurConnexion"><br/></span>
        <div class="form-group">
            <div class="col-ms-6">
                <button type="submit" class="btn btn-success center-block" >Connecter</button>
            </div>
        </div>

    </form>

    <div class="form-group">
        <a href="register.php"> Creer un compte</a>
    </div>

</div>