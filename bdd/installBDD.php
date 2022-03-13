<?php
include("../Donnees.inc.php");
define( 'DB_NAME', 'coming_soon');
$username='root';
$pwd='';
$db='bdd';
//création de la requête sql
//on teste avant si elle existe ou pas (par sécurité)
$sql= " CREATE DATABASE IF NOT EXISTS $db;
        ALTER DATABASE $db DEFAULT CHARACTER SET UTF8 COLLATE utf8_general_ci;
        USE $db;
        CREATE TABLE Utilisateur(nom VARCHAR(50) DEFAULT NULL,
                                prenom VARCHAR(50) DEFAULT NULL,
                                id VARCHAR(50)NOT NULL,
                                mdp VARCHAR(50) NOT NULL,
                                sexe VARCHAR(1) DEFAULT NULL,
                                mail VARCHAR(50) DEFAULT NULL,
                                ddn VARCHAR (50) DEFAULT NULL,
                                numTelephone VARCHAR(10) DEFAULT NULL,
                                adresse VARCHAR(50) DEFAULT NULL,
                                codePostal INTEGER(5) DEFAULT NULL,
                                ville VARCHAR(50) DEFAULT NULL,
                                PRIMARY KEY (id)
        );

                               
        CREATE TABLE Recettes(
            nom VARCHAR(200),
            ingredients VARCHAR(1000),
            preparation VARCHAR(1000),
            PRIMARY KEY (nom)
        );

        CREATE TABLE Ingredients(
            nomIngredient VARCHAR(200),
            PRIMARY KEY (nomIngredient)
        );
      
        CREATE TABLE SuperCategorie (
          nom VARCHAR(200),
          nomSuper VARCHAR(200),
          PRIMARY KEY (nom, nomSuper),
          FOREIGN KEY (nom) REFERENCES Ingredients(nomIngredient),
          FOREIGN KEY (nomSuper) REFERENCES Ingredients(nomIngredient)
        );

        CREATE TABLE liaison (
          nomIngredient VARCHAR(200),
          nomRecette VARCHAR(200),
          PRIMARY KEY (nomIngredient, nomRecette),
          FOREIGN KEY (nomIngredient) REFERENCES Ingredients(nomIngredient),
          FOREIGN KEY (nomRecette) REFERENCES Recettes(nom)
        );

        CREATE TABLE Panier (
          utilisateur VARCHAR(100),
          nomRecette VARCHAR(200),
          PRIMARY KEY (utilisateur, nomRecette),
          FOREIGN KEY (utilisateur) REFERENCES Utilisateur(id),
          FOREIGN KEY (nomRecette) REFERENCES Recettes(nom)
        )";
try{
    $bdd=new PDO('mysql:host=localhost;charset=utf8','root','');
}catch (Exception $e){
    die('Erreur :'.$e->getMessage());
}
foreach (explode(';',$sql) as $requete){
    $bdd->exec($requete);  
}
//Remplissage de la table Recettes
echo "ici"; 
$stmt = $bdd->prepare("INSERT INTO Recettes (nom, ingredients, preparation) VALUES (:nom, :ingredients, :preparation)");
$stmt->bindParam(':nom', $nom);
$stmt->bindParam(':ingredients', $ingredients);
$stmt->bindParam(':preparation', $preparation);

foreach ($Recettes as $titre) {
  $nom = array_values($titre)[0];
  $ingredients = array_values($titre)[1];
  $preparation = array_values($titre)[2];
  if(!$stmt->execute()){
    echo $stmt->error; 
}; 
}
echo "dfghj"; 
//Remplissage de la table ingrédients 
$stmt=$bdd->prepare("INSERT INTO Ingredients (nomIngredient) values(:nom)"); 
$stmt->bindParam(':nom', $nom); 
foreach($Hierarchie as $key=>$aliment){
    $nom = $key;
    if(!$stmt->execute()){
        echo $stmt->error; 
    }; 
}

//Remplissage de la table Liaison
$stmt=$bdd->prepare("INSERT INTO liaison (nomIngredient, nomRecette) VALUES (:nomIng,:nomRec)");
$stmt->bindParam(':nomIng', $nomIng);
$stmt->bindParam(':nomRec', $nomRec);
//
foreach($Recettes as $recette){
    $nomRec = $recette['titre']; 
    foreach($recette['index'] as $aliment){
        $nomIng = $aliment; 
        //
        $query = $bdd->prepare("SELECT count(*) AS nbr FROM liaison WHERE nomIngredient=:nomIng AND nomRecette = :nomRec"); 
        $query->bindParam(':nomIng', $nomIng); 
        $query->bindParam(':nomRec', $nomRec); 
        $query->execute(); 
        $donnees = $query->fetch();
        if($donnees['nbr']==0){
            $stmt->execute(); 
        }
    }
}

$stmt = null; 

//Remplissage de la table SuperCatégorie
$stmt = $bdd->prepare("INSERT INTO SuperCategorie (nom, nomSuper) VALUES (:nomIng,:nomSuperCat)"); 
$stmt->bindParam(':nomIng', $nom); 
$stmt->bindParam(':nomSuperCat', $nomSuper);
foreach ($Hierarchie as $aliment =>$tab){
    
    if(array_key_exists('super-categorie' , $tab)){
        foreach ($tab['super-categorie'] as $super){
            $nom = $aliment; 
            $nomSuper = $super;
            try {
                $stmt->execute(); 
              } catch(Exception $e) {
                  echo $e; 
                  echo "</br>"; 
                }
        }
        
    }

}