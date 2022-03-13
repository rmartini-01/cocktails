<?php
include("../Donnees.inc.php");
require_once('./includes/bdd.inc.php'); 
$id = $_GET['q'];

$stmt = $bdd->prepare("select nom from bdd.Recettes where nom like '%".$id."%'");
if($stmt->execute()){
    $result = $stmt->fetchAll(); //on récupère le resultat de la requete
    foreach ($result as $key => $value) {
        echo $value["nom"]."\n"; // on affiche le nom pour tester
    }
}else{
    echo "0 résultats";
}; 
