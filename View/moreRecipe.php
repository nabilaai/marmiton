<?php
/**
 * Created by PhpStorm.
 * User: Nabila
 * Date: 18/02/2016
 * Time: 05:59
 */
namespace Marmiton\View;

use Marmiton\Autoloader;
use Marmiton\Controller\RecetteClass;

require '../autoloader.php';
Autoloader::register();
$pdo = Autoloader::pdo();

$debut = $_POST['debut'];

$recette = new RecetteClass();
$jsonRecettes = $recette->getLastRecettes($pdo, $debut);
$recettes = json_decode($jsonRecettes);

if (isset($recette)) {

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
    return false;
}