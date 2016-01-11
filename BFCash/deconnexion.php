<?php
/**
 * Created by IntelliJ IDEA.
 * User: pahima
 * Date: 22/11/15
 * Time: 20:03
 */
require("Includes/functions.php");
session_start();
if($_SESSION['typeUser']=="Internaute"){
 deconecter();
 echo "<script type='text/javascript'>document.location.replace('index.php');</script>";
}else if($_SESSION['typeUser']=="Agent"){
 deconecter();
 echo "<script type='text/javascript'>document.location.replace('../BFCash/admin/index.php');</script>";
}

