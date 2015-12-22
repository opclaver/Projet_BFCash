<?php
/**
 * Created by IntelliJ IDEA.
 * User: pahima
 * Date: 22/11/15
 * Time: 20:03
 */

require("Includes/functions.php");
deconecter();
session_start();
$_SESSION['userExpire']= "Session expirée , reconnecter vous";
header('Location:index.php');
?>