/**
 * Created by pahima on 17/11/15.
 */

$(document).ready( function () {
    $("#connexionForm").submit(function(e){
        var postData="login="+$("#login").val()+"&passwd="+$("#passwd").val();
        $.ajax({
            type: 'POST',
            data: postData,
            dataType: 'json',
            url: 'http://localhost:8888/Projet_BFCash/BFCash/connexion.php',
            success: function (res) {

                var codErreur = res['error'];
                if (codErreur == "1") {
                   //raffraichir la page header.php
                    window.location.reload();
                } else if (codErreur == "0") {
                    $("#erreurConnexion").html("&nbsp;Nom d'utilisateur et/ou mot de passe incorrect");
                }else if (codErreur == "-1") {
                    $("#erreurConnexion").html("&nbsp;Ce compte n'est pas activé");
                }
            },
            error: function (request, status, error) {
                $("#erreurConnexion").html("&nbsp;Veuillez remplir tous les champs");
            }
        });
        return false;
    });
});
