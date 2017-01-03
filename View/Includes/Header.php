<div class="container">

    <div class="row">

        <div class="col-md-4">
            <a href="index.php"><img src="img/logo.png" class="logo" alt="logo"/></a>
        </div>
        <!-- Recherche -->

        <div class="col-md-4 head_button">
            <form method="post" action="recipe_search.php" class="form-inline">
                <input placeholder="Rechercher un plat" name="search" id="first_name" type="text" class="validate">
                <button class="btn waves-effect waves-light  orange darken-3" type="submit" name="action">Rechercher
                </button>
            </form>
        </div>


        <!-- bouton Modal -->
        <div class="col-md-4 head_button modal-button">
            <a class="waves-effect waves-light btn modal-trigger  orange darken-3" href="#modal1">Créer une nouvelle recette</a><br/>
        </div>

    </div>
</div>



<?php include 'Modal.php'; ?>