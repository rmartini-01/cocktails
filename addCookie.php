<?php
session_start();
$recette= $_GET['q']; 
if(isset($_SESSION['login'])){

    $id= $_SESSION['login']; 

    require_once('./includes/bdd.inc.php');

    //on vérifie que la recette n'est pas déja dans la base de données: 
    $stmt= $bdd->prepare("SELECT count(nomRecette) as nb FROM bdd.Panier WHERE nomRecette='$recette'");
    $stmt->execute(); 
    $result= $stmt->fetchAll(); 
     
    foreach ($result as $row) {
       
        if($row["nb"]=="0"){
            $stmt=$bdd->prepare("INSERT INTO bdd.Panier (utilisateur, nomRecette) VALUES (:uid , :nomR)");
            $stmt->bindParam(':uid', $id);
            $stmt->bindParam(':nomR', $recette);
            if($stmt->execute()){
                include_once("favoris.php"); 
                exit(); 
            }else{
                header("location: favoris.php?error=probleme");
            }
        }else{
            header("location: favoris.php?error=existDeja");
        }
    } 
  
}else{
    if(empty($_SESSION['panier'])){
        $_SESSION['panier']= array(); 
        $_SESSION['panier'][$recette] = 1; 
    }else{
        
        foreach ($_SESSION['panier'] as $key => $value) {
            # code...
            //si la recette n'est pas deja dans le panier,
            if($key != $recette){
                
                $_SESSION['panier'][$recette] = 1;
            } else{
                //sinon on affiche un message 
                header("location: favoris.php?error=existDeja");
                exit(); 
            }
        }
    
    }

    
   
    include_once("favoris.php"); 
}



