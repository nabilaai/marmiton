<?php

namespace Marmiton\View;

use Marmiton\Autoloader;
use Marmiton\Controller\RecetteClass;

require '../autoloader.php';
Autoloader::register();
$pdo = Autoloader::pdo();

$recette = new RecetteClass();
$jsonRecettes = $recette->getLastRecettes($pdo, 0);
$recettes = json_decode($jsonRecettes);

$jsonTopRecettes = $recette->getRecetteByRate($pdo);
$topRecettes = json_decode($jsonTopRecettes);

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="Content-Language" content="fr"/>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"/>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>
        Marmiton
    </title>
</head>

<body>

<header>
    <?php include 'Includes/Header.php'; ?>
</header>

<section id="main">
    <div class="container-fluid index">

        <div id="topRecette">
            <h3 class="titre2 animated deep-orange-text text-darken-4">Notre Top 3</h3>

            <ul>
                <?php

                foreach ($topRecettes as $topRecette) {
                    echo '<li class="toplist">
                    <a href="description.php?p=' . $topRecette->id . '">
                        <div class="image">
                            <img src="img/' . $topRecette->image . '" class="img" alt="image" />
                        </div>

                        <div id="recipe">
                            <p class="animated">' . $topRecette->libelle . '</p>
                        </div>
                    </a>
                 </li>';
                }
                ?>
            </ul>
        </div>

        <div id="recetteList">
            <h3 class="deep-orange-text text-darken-4">Les dernières recettes marmiton !</h3>
            <ul id="allRecipes">
                <?php

                foreach ($recettes as $recette) {
                    echo '<li class="list">
                    <a href="description.php?p=' . $recette->id . '">
                        <div class="image">
                            <img src="img/' . $recette->image . '" class="img" alt="image" />
                        </div>

                        <div id="recipe">
                            <p class="animated">' . $recette->libelle . '</p>
                        </div>
                    </a>
                 </li>';
                }
                ?>
            </ul>
        </div>

    </div>

    <div>
        <input id="limit" type="hidden" value="6">
        <a id="moreRecipe" class="btn-floating btn-large waves-effect waves-light orange darken-3">
            <i class="material-icons">add</i></a>
    </div>

</section>

<footer>
    <?php include 'Includes/Footer.php'; ?>
</footer>

</body>
</html>
