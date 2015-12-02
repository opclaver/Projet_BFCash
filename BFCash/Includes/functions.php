<?php
/**
 * Created by IntelliJ IDEA.
 * User: pahima
 * Date: 11/11/15
 * Time: 20:39
 */

// Fonction pour debugger les erreurs
    function debug($var){

            echo '<pre>' . print_r($var,true) . '</pre>';
        }

// Fonction pour generer le token pour l'envoi de mail et l'activation du compte

    function str_random($length){
        $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
        return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
    }

function datefr2en($mydate){
    @list($jour,$mois,$annee)=explode('/',$mydate);
    return @date('Y/m/d');
}