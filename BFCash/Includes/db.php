<?php
/**
 * Created by IntelliJ IDEA.
 * User: pahima
 * Date: 11/11/15
 * Time: 20:39
 */
// définition des variables de connexion à la base de données
try {
    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
    // INFORMATIONS DE CONNEXION
    $host = 'localhost';
    $dbname = 'dbBfCash';
    $user = 'root';
    $password = 'root';

    // FIN DES DONNEES
    $pdo = new PDO('mysql:host='.$host.';dbname='.$dbname.'', $user, $password, $pdo_options);
} catch (Exception $e) {
    die('Erreur de connexion : ' . $e->getMessage());
}

