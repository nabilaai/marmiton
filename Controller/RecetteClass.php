<?php

namespace Marmiton\Controller;

use Marmiton\Model\recetteRepository;

/**
 * Created by PhpStorm.
 * User: Nabila
 * Date: 17/01/2016
 * Time: 17:50
 */
class RecetteClass
{
    private $id;
    private $libelle;
    private $preparation;
    private $temps_cuisson;
    private $temps_preparation;
    private $username;
    private $email;
    private $id_categorie;
    private $image;

    /**
     * @return mixed
     */
    public function getIdCategorie()
    {
        return $this->id_categorie;
    }

    /**
     * @param mixed $id_categorie
     */
    public function setIdCategorie($id_categorie)
    {
        $this->id_categorie = $id_categorie;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }


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
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @param mixed $libelle
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }

    /**
     * @return mixed
     */
    public function getTempsPreparation()
    {
        return $this->temps_preparation;
    }

    /**
     * @param mixed $temps_preparation
     */
    public function setTempsPreparation($temps_preparation)
    {
        $this->temps_preparation = $temps_preparation;
    }

    /**
     * @return mixed
     */
    public function getPreparation()
    {
        return $this->preparation;
    }

    /**
     * @param mixed $preparation
     */
    public function setPreparation($preparation)
    {
        $this->preparation = $preparation;
    }

    /**
     * @return mixed
     */
    public function getTempsCuisson()
    {
        return $this->temps_cuisson;
    }

    /**
     * @param mixed $temps_cuisson
     */
    public function setTempsCuisson($temps_cuisson)
    {
        $this->temps_cuisson = $temps_cuisson;
    }

    /**
     * @param \PDO $pdo
     * @param $debut
     * @return array
     */
    public function getLastRecettes(\PDO $pdo, $debut)
    {
        $recetteRepository = new recetteRepository($pdo);
        $recettes = $recetteRepository->getLastRecettes($debut);
        $jsonRecettes = json_encode($recettes);
        return $jsonRecettes;
    }

    /**
     * @param \PDO $pdo
     * @param $id
     * @return array
     */
    public function getRecette(\PDO $pdo, $id)
    {
        $recetteRepository = new recetteRepository($pdo);
        $recette = $recetteRepository->getRecette($id);
        $jsonRecette = json_encode($recette);
        return $jsonRecette;
    }

    /**
     * @param \PDO $pdo
     * @param array $tab
     * @param array $file
     * @return bool|string
     */
    public function setRecette(\PDO $pdo, $tab = array(), $file = array())
    {
        $recetteRepository = new recetteRepository($pdo);
        $add_recette = $recetteRepository->setRecette($tab, $file);
        $jsonRecette = json_decode($add_recette);
        return $jsonRecette;
    }

    /**
     * @param \PDO $pdo
     * @param array $tab
     * @return array|bool
     */
    public function searchRecette(\PDO $pdo, $tab = array())
    {
        $recetteRepository = new recetteRepository($pdo);
        $searchRecette = $recetteRepository->searchRecette($tab);
        $jsonSearchRecette = json_encode($searchRecette);
        return $jsonSearchRecette;
    }

    /**
     * @param \PDO $pdo
     * @return array
     */
    public function getRecetteByRate(\PDO $pdo)
    {
        $recetteRepository = new recetteRepository($pdo);
        $topRecette = $recetteRepository->getRecetteByRate();
        $jsonTopRecette = json_encode($topRecette);
        return $jsonTopRecette;
    }

}

