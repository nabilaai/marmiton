/**
 * Created by Nabila on 13/02/2016.
 */

$(document).ready(function () {


    function getRate() {
        var url = "getRating.php";

        $.get(url,  // Fonction qui recupere la note en base au chargement de la page
            false,

            function (reponse, status) {
                if (status == "success") {
                    $("#note").html(reponse);
                }
            });
    }

    getRate();


    $("#rateForm").submit(function (e) {  // Fonction qui insert la note en base
        (e).preventDefault();

        var note = $('input[type=radio]:checked').val();
        var pseudo = $('#pseudo').val();
        var comment = $('#comment').val();
        var url = $(this).attr('action');


        if (note == undefined) {
            toastr.remove();
            toastr.warning('Vous devez choisir une note !');
        } else if (pseudo == "") {
            toastr.remove();
            toastr.warning('Vous devez rentrer un pseudo !');
        } else {
            $.post(url,
                {
                    vote: note,
                    pseudo: pseudo,
                    comment: comment
                },
                function (message, status) {  // retour d'appel ajax qui affiche une notif et recupere la nouvelle note en base
                    if (status == "success") {
                        toastr.success(message);
                        getRate();
                    }
                });
        }
    });

});
