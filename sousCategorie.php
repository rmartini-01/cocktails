<?php
require_once('./includes/bdd.inc.php');
$cat = $_GET['q']; //on récupère le nom de la catégorie
$id = $_GET['id']; //on récupère le niveau de la catégorie

$stmt = $bdd->prepare("SELECT nom from bdd.SuperCategorie where nomSuper = '$cat'");
$stmt->execute();
$donnees = $stmt->fetchAll();
if(count($donnees)!= 0){ //pour ne pas ajouter de listes vides
    echo '<select id="superCategories'.$id.'" class="sexe-form" onChange="listeSousCategories(\''.$id.'\')">';
    echo '<option value="-1"> catégories </option>';
    
    foreach ($donnees as $key => $value) {
        # code...
        echo '<h4>';
        echo '<option  value="$key">' . $value["nom"] . '</option> </h4> <br>';
    }
    echo '</select>';
    
}
