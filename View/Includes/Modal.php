<?php

$form = new \Marmiton\Controller\bootstrapForm();

?>

<!-- Modal Trigger -->


<!-- Modal Structure -->
<div id="modal1" class="modal bottom-sheet">
    <div class="modal-content">
        <h4 class="orange-text text-darken-3 animated fadeInRightBig"> Créer votre recette </h4>
        <form id="recipeForm" method="post" action="recipe_create.php" enctype="multipart/form-data">
            <div class="modal-body container">

                <div class="row">
                    <?php
                    echo $form->inputSizedText('Nom de la recette', 'libelle', 4);
                    echo $form->inputSizedText('Votre nom', 'utilisateur', 2);
                    echo $form->inputSizedMail('Votre email', 'email', 3); ?>
                </div>
                <div class="row">
                    <?php
                    echo $form->inputSizedTime('Temps de préparation', 'temps_preparation', 3);
                    echo $form->inputSizedTime('Temps de cuisson', 'temps_cuisson', 3);
                    echo $form->selectSized('Catégorie', 'id_categorie', 3, ['Entrée', 'Plat', 'Dessert', 'Sucré',
                        'Salé', 'Sucré / Salé', 'Cuisine française', 'Cuisine du monde']);

                    echo $form->inputSizedTextarea('Préparation', 'preparation', 7, 9); ?>
                </div>
                <div id="target">
                    <div id="form" class="row">
                        <?php
                        echo $form->inputSizedTextInTabQuantite('Quantité', 'quantite', 1);
                        echo $form->selectSizedInTab('Unité', 'unite', 2, ['grammes', 'kilo(s)', 'litre(s)', 'centilitre(s)',
                            'cuillère(s) à café', 'cuillère(s) à soupe', 'tasse(s)', 'aucun']);
                        echo $form->inputSizedTextInTabRequired('Ingrédient', 'ingredient', 4);
                        echo $form->buttonInfo('Ajouter', 'ajouter', '+', 1);
                        echo $form->buttonDanger('Supprimer', 'supprimer', '-', 1); ?>
                    </div>
                </div>
                <div id="target2">
                    <div id="form2" class="row">
                        <?php
                        echo $form->inputSizedTextInTab('Etapes', 'etape', 7);
                        echo $form->buttonInfo('Ajouter', 'ajouter', '+', 1);
                        echo $form->buttonDanger('Supprimer', 'supprimer', '-', 1); ?>
                    </div>
                </div>
                <div class="row">
                    <input type="hidden" name="MAX_FILE_SIZE" value="300000">
                    <?php
                    echo $form->inputSizedFile('Photo', 'image', 2); ?>
                    <span id="photo">.jpg, .jpeg, .png - 300 Ko maximum</span>
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-warning orange darken-3">Enregistrer ma recette</button>
            </div>

    </div>
    </form>
</div>

