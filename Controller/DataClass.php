<?php

namespace Marmiton\Controller;

use Marmiton\Model\dataRepository;

/**
 * Created by PhpStorm.
 * User: Nabila
 * Date: 07/02/2016
 * Time: 13:47
 */
class DataClass
{
    /**
     * @var array
     */
    private $recette_id;
    private $ingred_id = array();
    private $valeur_id = array();
    private $quantité = array();
    // private $rate = array();

    /**
     * @return array
     */
    public function getRecetteId()
    {
        return $this->recette_id;
    }

    /**
     * @param array $recette_id
     */
    public function setRecetteId($recette_id)
    {
        $this->recette_id = $recette_id;
    }

    /**
     * @return array
     */
    public function getQuantité()
    {
        return $this->quantité;
    }

    /**
     * @param array $quantité
     */
    public function setQuantité($quantité)
    {
        $this->quantité = $quantité;
    }

    /**
     * @return array
     */
    public function getValeurId()
    {
        return $this->valeur_id;
    }

    /**
     * @param array $valeur_id
     */
    public function setValeurId($valeur_id)
    {
        $this->valeur_id = $valeur_id;
    }

    /**
     * @return array
     */
    public function getIngredId()
    {
        return $this->ingred_id;
    }

    /**
     * @param array $ingred_id
     */
    public function setIngredId($ingred_id)
    {
        $this->ingred_id = $ingred_id;
    }



    public function setStepsByRecette(\PDO $pdo, $recette_id, $step_id = array())
    {
        $dataRepository = new dataRepository($pdo);
        $result = $dataRepository->setAllStep($recette_id, $step_id);
        return $result;
    }


    public function setDataByRecette(\PDO $pdo, $recette_id, $ingred_id = array(), $tab = array())
    {
        $dataRepository = new dataRepository($pdo);
        $result = $dataRepository->setAllData($recette_id, $ingred_id, $tab);
        return $result;
    }


    public function setRateById(\PDO $pdo, $recette_id, $jsonData)
    {
        $dataRepository = new dataRepository($pdo);
        $data = json_decode($jsonData);

            $result = $dataRepository->setRate($recette_id, $data);
            if ($result == true) {
                $message = "Votre vote a été pris en compte, merci !";
                return $message;
            } else {
                $message = "La requête n'a pas fonctionné";
                return $message;
            }
    }

    public function getRateById(\PDO $pdo, $recette_id)
    {
        $dataRepository = new dataRepository($pdo);
        $result = $dataRepository->getRate($recette_id);
        $jsonResult = json_encode($result);
        return $jsonResult;
    }

    public function getCommentById(\PDO $pdo, $recette_id)
    {
        $dataRepository = new dataRepository($pdo);
        $result = $dataRepository->getComment($recette_id);
        $jsonResult = json_encode($result);
        return $jsonResult;
    }


}