<?php
/**
 * Created by PhpStorm.
 * User: Nabila
 * Date: 13/02/2016
 * Time: 18:59
 */

namespace Marmiton\View;

use Marmiton\Autoloader;
use Marmiton\Controller\DataClass;

require '../autoloader.php';
session_start();
$id = $_SESSION['id'];
Autoloader::register();
$pdo = Autoloader::pdo();

$note = new DataClass();
$jsonRecette_note = $note->getRateById($pdo, $id);
$recette_note = json_decode($jsonRecette_note);

if (isset($recette_note->moyenne)) {
    echo "<p>Cette recette est notée {$recette_note->moyenne} / 5</p>";
} else {
    echo "<p>Cette recette nest pas notée</p>";
}
