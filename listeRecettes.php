<?php
//on se connecte à la bdd
require_once('./includes/bdd.inc.php');
$nomCategorie = $_GET['q'];
$stmt = $bdd->prepare("SELECT nomRecette from bdd.liaison where nomIngredient = '$nomCategorie'");
if ($stmt->execute()) {
    //echo "executed";
    $donnees = $stmt->fetchAll();
    //print_r ($donnees); 
    foreach ($donnees as $key => $value) {
        echo '<div class="food-menu-box">';

        echo '<div>';
        echo '<h4>' . $value["nomRecette"] . "\n" . ' </h4><br>';
        echo '<span class="buttons" >';
        echo '<a href="recette.php?q=' . $value["nomRecette"] . '" class="btn btn-primary"> Consulter </a></span>';
        echo '<span class ="buttons" >';
        echo '<a href="addCookie.php?q=' . $value["nomRecette"] . ' " class="btn btn-primary"> Ajouter aux favoris </a>';
        echo '</span> </div></div>';
        //echo $value['nomRecette'] . "\n";
    }
} else {
    echo "problème";
}
