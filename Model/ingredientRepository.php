<?php

namespace Marmiton\Model;


/**
 * Created by PhpStorm.
 * User: Nabila
 * Date: 17/01/2016
 * Time: 17:49
 */
class ingredientRepository
{

    /**
     * @var \PDO
     */
    private $pdo;

    /**
     * @param \PDO $pdo
     */
    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @return \PDO
     */
    public function getPdo()
    {
        return $this->pdo;
    }

    /**
     * @param \PDO $pdo
     */
    public function setPdo($pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @return mixed
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param mixed $count
     */
    public function setCount($count)
    {
        $this->count = $count;
    }

    public function getIngredientsById($id)
    {
        $tabResult = array();
        $ingredient = $this->pdo->prepare('SELECT DISTINCT ingredients.libelle, ingred_recette.quantite, valeur.libelle AS valeur
FROM ingredients
JOIN ingred_recette
ON ingredients.id = ingred_recette.ingredient_id
JOIN valeur
ON ingred_recette.valeur_id = valeur.id
JOIN recette
ON ingred_recette.recette_id = :id');
        $ingredient->execute(array('id' => $id));

        while ($ingredients = $ingredient->fetch(\PDO::FETCH_ASSOC)) {
            $tabResult[] = $ingredients;
        }
        $ingredient->closeCursor();
        return $tabResult;
    }

    public function setIngredientsById($ingred)
    {
        $request = $this->pdo->prepare('INSERT INTO ingredients (libelle)
VALUES (:ingredient);');
        $request->execute(array('ingredient' => $ingred));
        $lastId = $this->pdo->lastInsertId();

        $request->closeCursor();

        return $lastId;
    }

    public function getAllIngredients()
    {
        $tabResult = array();
        $resultats = $this->pdo->query('SELECT id, libelle FROM ingredients');

        while ($resultat = $resultats->fetch(\PDO::FETCH_ASSOC)) {
            $tabResult[] = $resultat;
        }
        $resultats->closeCursor();

        //faire la gestion du json dans le controller.
        //$jsonResult = json_encode($tabResult);
        return $tabResult;
    }


}