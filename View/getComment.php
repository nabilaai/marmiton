<?php


namespace Marmiton\View;

use Marmiton\Autoloader;
use Marmiton\Controller\RecetteClass;
use Marmiton\Controller\DataClass;

require '../autoloader.php';
Autoloader::register();
$pdo = Autoloader::pdo();
$id = $_GET['p'];

session_start();
$_SESSION['id'] = $id;

$comment = new DataClass();
$jsonComment = $comment->getCommentById($pdo, $id);
$comments = json_decode($jsonComment);

$recette = new RecetteClass();
$jsonRecettes = $recette->getRecette($pdo, $id);
$recettes = json_decode($jsonRecettes);

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

<div>
    <?php
    foreach ($recettes as $recette) {
        echo '<h1 class="deep-orange-text text-darken-4">' . $recette->libelle . '</h1>
            <p class="center-align">Les commentaires sur la recette</p>';
    }
    ?>
</div>

<div class="container comments-container">

    <?php
    if (!empty($comments)) {
        foreach ($comments as $comment) {
            echo '
                <div class="row comments">
                <div class="col s1"><div class="chip orange darken-3">' . $comment->valeur . '/5</div></div>
                <div class="col s11"><b>' . $comment->pseudo . '</b><br />
                <i>' . $comment->commentaire . '</i></div>
                </div>';
        }
    } else {
        echo "<p>Il n'y a aucun commentaire pour cette recette.</p>";
    }
    ?>

    <div>
        <?php
        foreach ($recettes as $recette) {
            echo '<p class="right-align"><a href="description.php?p=' . $recette->id . '">Retour à la recette</a></p>';
        }
        ?>
    </div>
</div>


<footer>
    <?php include 'Includes/Footer.php'; ?>
</footer>
</body>
</html>
