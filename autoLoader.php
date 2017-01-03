<?php
namespace Marmiton;
/**
 * Class Autoloader
 * @package Marmiton
 */
class Autoloader{

    /**
     * Enregistre notre autoloader
     */
    static function register(){
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    /**
     * Inclue le fichier correspondant a notre classe
     * @param $class string Le nom de la classe a charger
     */
    static function autoload($class){
        if (strpos($class, __NAMESPACE__ . '\\') === 0){
            $class = str_replace(__NAMESPACE__ . '\\', '', $class);
            $class = str_replace('\\', '/', $class);
            require __DIR__ . '/' . $class . '.php';
        }
    }

    static function pdo() {
        try
        {
            $pdo = new \PDO('mysql:host=localhost;dbname=marmiton;charset=utf8', 'root', 'root');
        }
        catch (\Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
        }
        return $pdo;
    }
}