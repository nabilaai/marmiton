<?php

namespace Marmiton\Model;


/**
 * Created by PhpStorm.
 * User: Nabila
 * Date: 17/01/2016
 * Time: 17:49
 */
class StepsRepository
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

    public function setStepsById($etape)
    {
        $request = $this->pdo->prepare('INSERT INTO etapes (libelle)
VALUES (:etape);');
        $request->execute(array('etape' => $etape));
        $lastId = $this->pdo->lastInsertId();

        $request->closeCursor();

        return $lastId;
    }

    public function getStepsById($id)
    {
        $tabResult = array();
        $step = $this->pdo->prepare('SELECT DISTINCT etapes.libelle
FROM etapes
JOIN etape_recette
ON etapes.id = etape_recette.etape_id
JOIN recette
ON etape_recette.recette_id = :id;');
        $step->execute(array('id' => $id));

        while ($steps = $step->fetch(\PDO::FETCH_ASSOC)) {
            $tabResult[] = $steps;
        }
        $step->closeCursor();
        return $tabResult;
    }

    public function getAllSteps()
    {
        $tabResult = array();
        $resultats = $this->pdo->query('SELECT id, libelle FROM etapes');

        while ($resultat = $resultats->fetch(\PDO::FETCH_ASSOC)) {
            $tabResult[] = $resultat;
        }
        $resultats->closeCursor();

        //faire la gestion du json dans le controller.
        //$jsonResult = json_encode($tabResult);
        return $tabResult;
    }


}