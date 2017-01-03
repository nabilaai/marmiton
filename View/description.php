<?php

namespace Marmiton\View;

use Marmiton\Autoloader;
use Marmiton\Controller\RecetteClass;
use Marmiton\Controller\IngredientClass;
use Marmiton\Controller\DataClass;
use Marmiton\Controller\StepsClass;

require '../autoloader.php';
Autoloader::register();
$pdo = Autoloader::pdo();
$id = $_GET['p'];

session_start();
$_SESSION['id'] = $id;

$recette = new RecetteClass();
$jsonRecettes = $recette->getRecette($pdo, $id);
$recettes = json_decode($jsonRecettes);

$ingredient = new IngredientClass();
$jsonIngredients = $ingredient->getIngredientsById($pdo, $id);
$ingredients = json_decode($jsonIngredients);

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
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
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

    <div class="container">
        <div class="row">

            <div class="col s12">
                <nav>
                    <div class="nav-wrapper orange darken-3 ">
                        <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
                        <ul id="nav-mobile" class="right hide-on-med-and-down">
                            <?php
                            foreach ($recettes as $recette) {
                                echo '<li class="listMenu"><a href="index.php">Acceuil</a></li>
                                <li class="listMenu"><a href="stepByStep.php?p=' . $recette->id . '">En cuisine</a></li>
                            <li class="listMenu"><a href="getComment.php?p=' . $recette->id . '">Commentaires</a></li>';
                            }
                            ?>
                        </ul>
                        <ul class="side-nav" id="mobile-demo">
                            <?php
                            foreach ($recettes as $recette) {
                                echo '<li class="listMenu"><a href="index.php">Acceuil</a></li>
                                <li class="listMenu"><a href="stepByStep.php?p=' . $recette->id . '">En cuisine</a></li>
                            <li class="listMenu"><a href="getComment.php?p=' . $recette->id . '">Commentaires</a></li>';
                            }
                            ?>
                        </ul>
                    </div>
                </nav>
            </div>

            <div class="col s12 card-panel orange lighten-5 z-depth-4">
                    <div id="note" class="deep-orange-text text-darken-4"></div>
                    <?php
                    foreach ($recettes as $recette) {
                        echo '<h1 class="deep-orange-text text-darken-4">' . $recette->libelle . '</h1>
        <img src="img/' . $recette->image . '" class="img1" alt="image"/></br></br>
        <p class="orange-text text-darken-3"><strong id="title">Catégorie : </strong>' . $recette->cat_libelle . '</p>
        <p class="orange-text text-darken-3"><strong id="title">Temps de préparation : </strong> ' . $recette->temps_preparation . ' minutes</p>
        <p class="orange-text text-darken-3"><strong id="title">Temps de cuisson : </strong>' . $recette->temps_cuisson . ' minutes  </p>';
                    } ?>

                    <div>
                        <p id="title" class="orange-text text-darken-3"><strong>Ingrédients :</strong></p>
                        <ul>
                            <?php
                            foreach ($ingredients as $ingredient) {
                                echo '<li class="ingredList">' . $ingredient->libelle . ' ' . $ingredient->quantite . ' ' . $ingredient->valeur . '</li>';
                            }; ?>
                        </ul>
                    </div>

                    <?php
                    foreach ($recettes as $recette) {
                        echo '<p id="title" class="orange-text text-darken-3"><strong>Préparation :</strong></p><p>' . $recette->preparation . '</p>
                <p id="authorRecette" class="right-align"><small> recette publiée par <i> ' . $recette->utilisateur . ' </i></small></p>';
                    }
                    ?>
            </div>
            <div class="col s12">
                <div id="formNote">
                    <form id="rateForm" method="post" action="rating.php?p=<?= $id; ?>">

                        <h5 id="title"><strong>Notez cette recette</strong></h5>

                        <input name="vote" class="vote" type="radio" id="rad1" value="1" />
                        <label for="rad1">1</label>

                        <input name="vote" class="vote" type="radio" id="rad2" value="2" />
                        <label for="rad2">2</label>

                        <input name="vote" class="vote" type="radio" id="rad3" value="3" />
                        <label for="rad3">3</label>

                        <input name="vote" class="vote" type="radio" id="rad4" value="4" />
                        <label for="rad4">4</label>

                        <input name="vote" class="vote" type="radio" id="rad5" value="5" />
                        <label for="rad5">5</label>


                        <div id="form">
                            <label id="title">Pseudo</label>
                            <input id="pseudo" type="text" class="form-control">

                            <label id="title">Commentaire</label>
                            <textarea id="comment" class="form-control" rows="5"></textarea></br>

                            <button id="rateValid" class="btn waves-effect waves-light orange darken-3"  type="submit" name="action">Votez!
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




</section>


<footer>
    <?php include 'Includes/Footer.php'; ?>
</footer>
</body>
</html>
