<?php
include("../Donnees.inc.php");
define( 'DB_NAME', 'coming_soon');
$username='root';
$pwd='';
$db='bdd';

try{
    $bdd=new PDO('mysql:host=localhost;charset=utf8','root','');
}catch (Exception $e){
    die('Erreur :'.$e->getMessage());
}
$id = $_GET['q'];
$stmt = $bdd->prepare("select * from bdd.Ingredients where nomIngredient like '%".$id."%'");
if($stmt->execute()){
    $result = $stmt->fetchAll(); //on récupère le resultat de la requete
    foreach ($result as $key => $value) {
        echo $value["nomIngredient"]."\n"; // on affiche le nom pour tester
    }
}else{
    echo "0 résultats";
}; 
?>
