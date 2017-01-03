<?php
namespace Marmiton\Model;

class dataRepository
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

    public function setAllData($recette_id, $ingred_id, $tab)
    {
        $i = 0;
        $ingred_id = array_unique($ingred_id);

        while (isset($ingred_id[$i]))
        {

                $request = $this->pdo->prepare('INSERT INTO ingred_recette (recette_id, ingredient_id, quantite, valeur_id)
VALUES (:recette_id, :ingredient_id, :quantite, :valeur_id);');

                if ($tab['quantite'][$i] == 0) {
                    $request->execute(array(
                        'recette_id' => $recette_id,
                        'ingredient_id' => $ingred_id[$i],
                        'quantite' => NULL,
                        'valeur_id' => $tab['unite'][$i]

                    ));
                } else {
                    $request->execute(array(
                        'recette_id' => $recette_id,
                        'ingredient_id' => $ingred_id[$i],
                        'quantite' => $tab['quantite'][$i],
                        'valeur_id' => $tab['unite'][$i]
                    ));
                }

            $i++;
        }
        return true;
    }

    public function setAllStep($recette_id, $step_id)
    {
        $i = 0;

        while (isset($step_id[$i])){
            $request = $this->pdo->prepare('INSERT INTO etape_recette (recette_id, etape_id)
VALUES (:recette_id, :etape_id);');

                $request->execute(array(
                    'recette_id' => $recette_id,
                    'etape_id' => $step_id[$i]
                ));
            $i++;
        }
        return true;
    }

    public function setRate($recette_id, $data)
    {
        if (isset($data)){

                $request = $this->pdo->prepare('INSERT INTO note (recette_id, valeur, pseudo, commentaire)
VALUES (:id, :note, :pseudo, :commentaire);');
                $request->execute(array(
                    'id' => $recette_id,
                    'note' => $data->vote,
                    'pseudo' => $data->pseudo,
                    'commentaire' => $data->comment
                ));
        }
        return true;
    }

    public function getRate($recette_id)
    {
        $request = $this->pdo->prepare('SELECT ROUND(AVG(valeur), 1) AS moyenne
FROM note
WHERE recette_id = :id;');
        $request->execute(array('id' => $recette_id));

        $result = $request->fetch(\PDO::FETCH_ASSOC);
        $request->closeCursor();
        return $result;
    }

    public function getComment($recette_id)
    {
        $tabResult = array();
        $request = $this->pdo->prepare('SELECT pseudo, valeur, commentaire, recette.id
FROM note
INNER JOIN recette
ON note.recette_id = recette.id
WHERE recette.id = :id;');
        $request->execute(array('id' => $recette_id));
        while ($resultat = $request->fetch(\PDO::FETCH_ASSOC)) {
            $tabResult[] = $resultat;
        }
        $request->closeCursor();
        return $tabResult;
    }
}