/**
 * Created by Nabila on 13/02/2016.
 */
function valid(){
    $('#recipeForm').unbind('submit');
    $('#recipeForm').trigger('submit')
}

// Fonction qui vérifié les données du formulaire et renvoi un message d'erreur ou le submit
$(document).ready(function () {
    $("#recipeForm").submit(function (e) {
        e.preventDefault();

        var file = document.querySelector('input[name="image"]');
        var extension = ['jpg', 'jpeg', 'png'];


        if (file.value != "")
        {
            var tab = file.value.split(".");
            var i = tab.length - 1;
            var size = file.files[0].size;

            if (tab[i] != extension[0] && tab[i] != extension[1] && tab[i] != extension[2])
            {
                toastr.remove();
                toastr.error("Le fichier choisi n'est pas de\ntype .jpg .jpeg .png");
            }
            else if (size > 300000)
            {
                toastr.remove();
                toastr.error("Le fichier choisi dépasse la taille autorisée");
            }
            else
            {
                toastr.success("Votre recette a été crée !");
                setTimeout(valid, 2300);
            }
        } else {
            toastr.success("Votre recette a été crée !");
            setTimeout(valid, 2300);
        }
});

    $('.time').keyup(function() {  // Fonction qui vérifie si les champs temps sont des nombres entiers
        var input = $(this).val();
        var regex = new RegExp("^[0-9]+$");
        if (regex.test(input)) {
            $(this).attr("style", "background-color :#DDFFDA;");
        } else {
            $(this).val(input.substr(0, input.length-1));
            $(this).attr("style", "background-color :#FFBFB6;");
        }
    });


    $('.quantite').keyup(function() {  // Fonction qui vérifie si les champs quantite sont des nombres ou des virgules/points
        var input = $(this).val();
        var regex = new RegExp("^[0-9|,|.]+$");
        if (regex.test(input)) {
            $(this).attr("style", "background-color :#DDFFDA;");
        } else {
            $(this).val(input.substr(0, input.length-1));
            $(this).attr("style", "background-color :#FFBFB6;");
        }
    });

    $('.quantite').blur(function() {
        $(this).removeAttr("style")
    });

    $('.time').blur(function() {
        $(this).removeAttr("style")
    });

});
