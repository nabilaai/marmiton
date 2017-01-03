/**
 * Created by Nabila on 19/02/2016.
 */

$(window).load(function reset() {
    $('#limit').val("6");
    });

$(document).ready(function () {

    $('#moreRecipe').click(function () {
        var debut = $('#limit').val();
        $.post('moreRecipe.php',
            {
                debut: debut
            },
            function (message, status) {  // retour d'appel ajax qui ajoute les nouvelles recettes supplementaire sur la page et incrémente la value de #limite
                if (status == "success") {
                    var newValue = parseInt(debut) + 6;
                    $('#allRecipes').append(message);
                    $('#limit').val(newValue);
                }
            });
    })
});
