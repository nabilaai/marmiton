<?php

namespace Marmiton\View;

use Marmiton\Autoloader;
use Marmiton\Controller\DataClass;
use Marmiton\Controller\ingredientClass;
use Marmiton\Controller\RecetteClass;
use Marmiton\Controller\StepsClass;

require '../autoloader.php';
Autoloader::register();
$pdo = Autoloader::pdo();

$data = $_POST;
//$jsonData = json_encode($data);

$recette = new RecetteClass();
$jsonRecetteid = $recette->setRecette($pdo, $data, $_FILES);
$recette_id = json_encode($jsonRecetteid);


if ($recette_id != false) {
    $ingredient = new IngredientClass();
    $step = new StepsClass();

    $ingred_id = array();
    $step_id = array();
    $i = 0;
    $j = 0;
    $k = 0;

    while (isset($_POST['ingredient'][$i])) {
        $all_ingredients = $ingredient->getAllIngredients($pdo);
        if (isset($all_ingredients[$j])) {
            if ($_POST['ingredient'][$i] == $all_ingredients[$j]['libelle']) {
                $ingred_id[] = $all_ingredients[$j]['id'];
                $i++;
                $j = 0;
            } else {
                $j++;
            }
        } else {
            $ingred_id[] = $ingredient->setIngredientsById($pdo, $_POST['ingredient'][$i]);
            $i++;
            $j = 0;
        }
    }

    $data = new DataClass();
    $data->setDataByrecette($pdo, $recette_id, $ingred_id, $_POST);

    while (isset($_POST['etape'][$k])) {
        $step_id[] = $step->setStepsById($pdo, $_POST['etape'][$k]);
        $k++;
    }
    $data->setStepsByRecette($pdo, $recette_id, $step_id);

   header('location: index.php');
} else {
    header('location: index.php');
}