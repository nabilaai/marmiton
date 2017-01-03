<?php
/**
 * Created by PhpStorm.
 * User: Nabila
 * Date: 07/02/2016
 * Time: 20:00
 */

namespace Marmiton\View;

use Marmiton\Autoloader;
use Marmiton\Controller\DataClass;

require '../autoloader.php';
Autoloader::register();
$pdo = Autoloader::pdo();

$recette_id = $_GET['p'];
$data = $_POST;

$jsonData = json_encode($data);
$vote = new DataClass();
$message = $vote->setRateById($pdo, $recette_id, $jsonData);

echo $message;
