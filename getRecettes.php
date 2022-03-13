<?php 
 require_once('./includes/bdd.inc.php'); 
 
    $sql = "SELECT DISTINCT nomRecette FROM bdd.liaison WHERE "; 
    
    $listeIng = $_GET['q']; 
    $sql .= $listeIng; 

    $recette = $bdd->prepare($sql);
    if(!$recette->execute()){
        echo "Erreur"; 
    }else{
        $ingredients = $bdd->prepare("SELECT nomIngredient FROM bdd.liaison WHERE nomRecette = :recette");
        while ($donnees = $recette->fetch()) {
            
            echo $donnees['nomRecette']."\n";
            $ingredients->bindParam(":recette", $donnees['nomRecette']);
            $ingredients->execute();
            while($ing = $ingredients->fetch()){
                print_r($ing['nomIngredient']);
                echo "\n";
            }
            echo "_";
        }
        
    };
$recette->closeCursor(); // Termine le traitement de la requête