<?php
session_start();
require_once('./includes/bdd.inc.php'); 

$nomRecette = $_GET['q'];
$stmt = $bdd->prepare("SELECT nom from bdd.Recettes where nom= '$nomRecette'"); 
$stmt->execute(); 
$res = $stmt->fetchAll(); 
if(count($res)==0){
    header("location: ./index.php?error=recetteInexistante"); 
    exit(); 
}
           
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recettes</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Navbar Section Starts Here -->
     <?php require_once('navBar.php');?>
    <!-- Navbar Section Ends Here -->
    <section class="food-search text-center">
        <div class="container">
        
        </div>
    </section>
   <!-- Recipe card starts here-->
    <section class="categories">
        <div class="container-center">
            
            <h2 class="text-center">Découvrez la recette</h2>

            <div class="float-container-center">
                <!-- <img src="images/alcohol.png" alt="Alcohol" class="img-responsive img-curve"> -->
                <h3 class="nomRec"><?php echo $_GET['q']?></h3>
                
            </div>

            
            </div>

                <div class="description" >
                    <!-- Ingrédients --> 
                    <h4 class="description text-center"> Ingrédients : </h4></br>
                    <?php
                        $id = $_GET['q'];
                        
                        $stmt = $bdd->prepare("select distinct nomIngredient from bdd.liaison where nomRecette like '%".$id."%'");
                        if($stmt->execute()){
                            $result = $stmt->fetchAll(); //on récupère le resultat de la requete
                            
                            foreach ($result as $key => $value) {
                                ?> <p class='text-center'> <?php echo $value["nomIngredient"]."\n";  ?> </p> <?php
                            }
                        }else{
                            echo "0 résultats";
                        }; 
                    ?>

                    <!-- préparation --> 
                    </br><h4 class="description text-center"> Préparation : </h4></br>
                    <?php
                        
                        $id = $_GET['q'];

                        $stmt = $bdd->prepare("select preparation from bdd.Recettes where nom like '%".$id."%'");
                        if($stmt->execute()){
                            $result = $stmt->fetchAll(); //on récupère le resultat de la requete
                            foreach ($result as $key => $value) {
                                ?> 
                                <p class='text-center'> <?php echo $value["preparation"]."\n";  ?> </p> 
                                <?php
                            }
                        }else{
                            echo "0 résultats";
                        };
                        
                        ?>
                        <br>
                        <span class ="buttons" >
                        <a href="addCookie.php?q=<?php echo "$id"?>" class="btn btn-primary"> Ajouter aux favoris </a>
                    </span>  <?php
                    ?>
                     
                </div>
            </div>
        </section>
    <!-- Reciepe card ends here-->

    <!-- footer Section Starts Here -->
    <section class="footer">
        <div class="container text-center">
            <p>Tous les droits réservés. Template par Vijay Thapa.</p>
            <p>Site crée par Roxane Bernard et Reen Martini.</p>
        </div>
    </section>
    <!-- footer Section Ends Here -->

</body>
</html>