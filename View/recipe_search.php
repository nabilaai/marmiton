<?php

namespace Marmiton\View;

use Marmiton\Autoloader;
use Marmiton\Controller\RecetteClass;
use Marmiton\Controller\IngredientClass;

require '../autoloader.php';
Autoloader::register();
$pdo = Autoloader::pdo();

$recette = new RecetteClass();
$jsonRecettes = $recette->searchRecette($pdo, $_POST);
$recettes = json_decode($jsonRecettes);

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
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
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
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
    <div class="container-fluid recetteList index">
        <h3 class="deep-orange-text text-darken-4">Votre recherche</h3>
        <ul id="allRecipe">
            <?php
            if ($recettes != false) {
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
            } else {
                echo '<p>Aucun résultat ne correspond à votre recherche</p>';
            }
            ?>
        </ul>
    </div>
</section>

<footer>
    <?php include 'Includes/Footer.php'; ?>
</footer>

</body>
</html>
