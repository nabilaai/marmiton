<?php

namespace Marmiton\Model;

use \Marmiton\Controller\ORM;

/**
 * Created by PhpStorm.
 * User: Nabila
 * Date: 17/01/2016
 * Time: 17:49
 */
class recetteRepository extends ORM
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
     * @return array
     */
    public function getLastRecettes($debut)
    {
        $tabResult = [];
        $resultats = $this->pdo->query('SELECT libelle, image, id FROM recette ORDER BY id DESC LIMIT ' . $debut . ', 6;');

        while ($resultat = $resultats->fetch(\PDO::FETCH_ASSOC)) {
            $tabResult[] = $resultat;
        }
        $resultats->closeCursor();

        return $tabResult;
    }

    /**
     * @param $id
     * @return array
     */
    public function getRecette($id)
    {
        $resultats = $this->pdo->prepare('SELECT recette.id, recette.libelle, preparation, temps_cuisson,
temps_preparation, utilisateur, email, image, categorie.libelle AS cat_libelle
FROM recette
INNER JOIN categorie
ON recette.id_categorie = categorie.id
WHERE recette.id = :id');
        $resultats->execute(array('id' => $id));
        $tabResult[] = $resultats->fetch(\PDO::FETCH_ASSOC);
        $resultats->closeCursor();

        //faire la gestion du json dans le controller.
        //$jsonResult = json_encode($tabResult);
        return $tabResult;
    }


    /**
     * @param $tab
     * @param $file
     * @return bool|string
     */
    public function setRecette($tab, $file)
    {
        if ($file['image']['name'] != "") {
            $dossier = '../View/img/';
            $fichier = basename($file['image']['name']);
            $taille_maxi = 300000;
            $taille = filesize($file['image']['tmp_name']);
            $extensions = array('.png', '.jpg', '.jpeg');
            $extension = strrchr($file['image']['name'], '.');
//Début des vérifications de sécurité...
            if (!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
            {
                $erreur = false;
            }
            if ($taille > $taille_maxi) {
                $erreur = false;
            }
            if (!isset($erreur)) //S'il n'y a pas d'erreur, on upload
            {
                //On formate le nom du fichier ici...
                $fichier = strtr($fichier,
                    'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
                    'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
                if (move_uploaded_file($file['image']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie true, c'est que l'upload a fonctionné
                {
                    $request = $this->pdo->prepare('INSERT INTO recette (libelle, preparation, temps_cuisson, temps_preparation,
utilisateur, email, image, id_categorie) VALUES (:libelle, :preparation, :temps_cuisson, :temps_preparation, :utilisateur,
:email, :image, :id_categorie)');
                    $request->execute(array(
                        'libelle' => $tab['libelle'],
                        'preparation' => $tab['preparation'],
                        'temps_cuisson' => $tab['temps_cuisson'],
                        'temps_preparation' => $tab['temps_preparation'],
                        'utilisateur' => $tab['utilisateur'],
                        'email' => $tab['email'],
                        'image' => $fichier,
                        'id_categorie' => $tab['id_categorie']
                    ));

                    $id = $this->pdo->lastInsertId();
                    return $id;

                } else { //Sinon (la fonction renvoie false), on n'insère pas l'image, l'image chef sera prise par défaut
                    $request = $this->pdo->prepare('INSERT INTO recette (libelle, preparation, temps_cuisson, temps_preparation,
utilisateur, email, image, id_categorie) VALUES (:libelle, :preparation, :temps_cuisson, :temps_preparation, :utilisateur,
:email, :image, :id_categorie)');
                    $request->execute(array(
                        'libelle' => $tab['libelle'],
                        'preparation' => $tab['preparation'],
                        'temps_cuisson' => $tab['temps_cuisson'],
                        'temps_preparation' => $tab['temps_preparation'],
                        'utilisateur' => $tab['utilisateur'],
                        'email' => $tab['email'],
                        'id_categorie' => $tab['id_categorie']
                    ));

                    $id = $this->pdo->lastInsertId();
                    return $id;
                }
            } else { // si il y a des erreurs on renvoi false
                return $erreur;
            }
        } else { // si aucune image n'a été envoyé, on n'insère pas l'image, l'image chef sera prise par défaut
            $request = $this->pdo->prepare('INSERT INTO recette (libelle, preparation, temps_cuisson, temps_preparation,
utilisateur, email, id_categorie) VALUES (:libelle, :preparation, :temps_cuisson, :temps_preparation, :utilisateur,
:email, :id_categorie)');
            $request->execute(array(
                'libelle' => $tab['libelle'],
                'preparation' => $tab['preparation'],
                'temps_cuisson' => $tab['temps_cuisson'],
                'temps_preparation' => $tab['temps_preparation'],
                'utilisateur' => $tab['utilisateur'],
                'email' => $tab['email'],
                'id_categorie' => $tab['id_categorie']
            ));
            $id = $this->pdo->lastInsertId();
            return $id;
        }
    }


    /**
     * @param $tab
     * @return array|bool
     */
    public function searchRecette($tab)
    {
        // $tab = preg_replace("#[^a-zA-Z ?0-9]i#", "", $tab);
        if (isset($tab['search']) and !empty($tab['search'])) {

            $request = $this->pdo->prepare('SELECT DISTINCT recette.id, recette.libelle, recette.preparation, recette.temps_cuisson, recette.temps_preparation, recette.utilisateur, recette.email, recette.image
    FROM ingredients
    INNER JOIN ingred_recette
    ON ingredients.id = ingred_recette.ingredient_id
    INNER JOIN recette
    ON ingred_recette.recette_id = recette.id
    WHERE ingredients.libelle LIKE :search
    OR recette.libelle LIKE :search');

            $request->execute(array(
                ':search' => "%" . $tab['search'] . "%"));


            while ($resultat = $request->fetch(\PDO::FETCH_ASSOC)) {
                $tabResult[] = $resultat;
            }
            if (isset($tabResult) and !empty($tabResult)) {
                $request->closeCursor();
                return $tabResult;

            } else {
                return false;
            }

        } else {
            $resultats = $this->pdo->query('SELECT * FROM recette ORDER BY id DESC;');
            $tabResult = [];

            while ($resultat = $resultats->fetch(\PDO::FETCH_ASSOC)) {
                $tabResult[] = $resultat;
            }
            $resultats->closeCursor();

            //faire la gestion du json dans le controller.
            //$jsonResult = json_encode($tabResult);
            return $tabResult;
        }
    }

    /**
     * @return array
     */
    public function getRecetteByRate()
    {
        $tabResult = array();
        $resultats = $this->pdo->query('SELECT recette.id, recette.libelle, recette.image, ROUND(AVG(valeur), 1) AS moyenne
FROM note
INNER JOIN recette
ON note.recette_id = recette.id
GROUP BY recette_id
ORDER BY moyenne DESC
LIMIT 3');
        while ($resultat = $resultats->fetch(\PDO::FETCH_ASSOC)) {
            $tabResult[] = $resultat;
        }
        $resultats->closeCursor();
        return $tabResult;
    }

}