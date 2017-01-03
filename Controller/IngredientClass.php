<?php

namespace Marmiton\Controller;

use Marmiton\Model\ingredientRepository;

/**
 * Created by PhpStorm.
 * User: Nabila
 * Date: 17/01/2016
 * Time: 17:50
 */
class IngredientClass
{
    private $id;
    private $ingredients = array();

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return array
     */
    public function getIngredients()
    {
        return $this->ingredients;
    }

    /**
     * @param array $ingredients
     */
    public function setIngredients($ingredients)
    {
        $this->ingredients = $ingredients;
    }

    public function getIngredientsById(\PDO $pdo, $id)
    {
        $ingredientRepository = new ingredientRepository($pdo);
        $this->ingredients = $ingredientRepository->getIngredientsById($id);
        $jsonIngredients = json_encode($this->ingredients);
        return $jsonIngredients;
    }

    public function setIngredientsById(\PDO $pdo, $ingred)
    {
        $ingredientRepository = new ingredientRepository($pdo);
        $this->id = $ingredientRepository->setIngredientsById($ingred);
        return $this->getId();
    }

    public function getAllIngredients(\PDO $pdo)
    {
        $ingredientRepository = new ingredientRepository($pdo);
        $this->ingredients = $ingredientRepository->getAllIngredients();
        return $this->getIngredients();
    }

}