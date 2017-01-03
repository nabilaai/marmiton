<?php

namespace Marmiton\Controller;

use Marmiton\Model\StepsRepository;

/**
 * Created by PhpStorm.
 * User: Nabila
 * Date: 17/01/2016
 * Time: 17:50
 */
class StepsClass
{
    private $id;
    private $steps = array();
    private $step_id = array();
    private $recette_id;
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

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }


    public function setSteps($steps)
    {
        $this->steps = $steps;
    }

    public function getSteps()
    {
        return $this->steps;
    }


    public function setStepId($step_id)
    {
        $this->step_id = $step_id;
    }



    public function setStepsById(\PDO $pdo, $step)
    {
        $stepsRepository = new StepsRepository($pdo);
        $this->id = $stepsRepository->setStepsById($step);
        return $this->getId();
    }


    public function getStepsById(\PDO $pdo, $id)
    {
        $stepsRepository = new StepsRepository($pdo);
        $this->steps = $stepsRepository->getStepsById($id);
        $jsonSteps = json_encode($this->steps);
        return $jsonSteps;
    }

    public function getAllSteps(\PDO $pdo)
    {
        $stepsRepository = new StepsRepository($pdo);
        $this->steps = $stepsRepository->getAllSteps();
        return $this->getSteps();
    }
}
