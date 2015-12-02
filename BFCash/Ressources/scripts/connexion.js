/**
 * Created by pahima on 17/11/15.
 */

$(document).ready( function () {
    $('#connexionForm').on('submit', function(e) {
        var postData="login="+$("#login").val()+"&passwd="+$("#passwd").val();
        $.ajax({
            type: 'POST',
            data: postData,
            dataType: 'json',
            url: 'http://localhost:8888/Projet_BFCash/BFCash/connexion.php',
            success: function (res) {
                var codErreur = res['error'];

                if (codErreur == "1") {
                    //Recuperation du nom et prenom de l'utilisateur
                    $nom=res['nom'];
                    $prenom=res['prenom'];

                   //raffraichir la page header.php
                    window.location.reload();
                   // $('#navbar-collapse-1').load('/Projet_BFCash/BFCash/Includes/h.php #navbar-collapse-1');

                } else if (codErreur = "0") {
                    $("#erreurConnexion").html("&nbsp;Nom d'utilisateur et/ou mot de passe incorrect");

                }
            },
            error: function (request, status, error) {
                alert(request.responseText);
                alert('User invalid');
            }
        });
        return false;
    });
});
