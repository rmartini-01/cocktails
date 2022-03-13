<?php 
    require_once('./includes/bdd.inc.php'); 
    $sql = "SELECT DISTINCT nomRecette FROM bdd.liaison WHERE"; 
    
    $listeIng = $_GET['q']; 
    $sql .= $listeIng; 
    
    $recette = $bdd->prepare($sql);
    if(!$recette->execute()){
        echo "Erreur"; 
    };
