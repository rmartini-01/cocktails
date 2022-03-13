<?php
session_start();

$recette = $_GET['q'];

if(isset($_SESSION['login'])){
    require_once('./includes/bdd.inc.php'); //on établie la connexion avec la bdd
    $stmt=$bdd->prepare("DELETE FROM bdd.Panier WHERE nomRecette='$recette';");
    if($stmt->execute()){
        include_once("favoris.php"); 
    }else{
        echo "Un problème est survenu\n"; 
    }
}else{
    unset($_SESSION['panier'][$recette]);
    include_once("favoris.php"); 
}

?>
