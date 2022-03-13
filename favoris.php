<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
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
    <?php require_once('navBar.php')?>
    <!-- Navbar Section Ends Here -->
    <section class="food-search text-center">
        <div class="container">
        
        </div>
    </section>
    <!-- Recipe Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Recettes préférées</h2>

            
            <!-- Affichage des recettes-->
            <?php 
            //si l'utilisateur n'es pas connecté : 
            if(!isset($_SESSION['login'])){
                if(isset($_GET['error'])){
                     if ($_GET['error']== "existDeja"){
                        ?><br> <strong><p style="color:#E83235; "> La recette est déjà dans vos favoris !</p></strong>
                        <?php  
                    }
                }
                foreach ($_SESSION['panier'] as $key => $value) {
                    # code...
                    ?><div>
                    <div class="food-menu-box">
                    <div class="">
                        <h4><?php echo $key."\n";?> </h4>
                
                    <br>
                    <span class="buttons" >
                        <a href="recette.php?q=<?php echo $key?>" class="btn btn-primary"> Consulter </a></span>
                    <span class ="buttons" >
                        <a href="removeCookie.php?q=<?php echo $key?>" class="btn btn-primary"> Supprimer des favoris</a>
                    </span>                
                </div>        
                </div><?php
                }

                
            }else{
                require_once('./includes/bdd.inc.php'); 
                ?> <div class="text-center"><?php
                    if(isset($_GET['error'])){
                        if($_GET['error']== "problème"){
                        ?><br> <strong><p style="color:#E83235; "> Un problème a eu lieu, merci de réessayer ultérieurement.</p></strong>
                            <?php  
                        }else if ($_GET['error']== "existDeja"){
                            ?><br> <strong><p style="color:#E83235; "> La recette est déjà dans vos favoris !</p></strong>
                            <?php  
                        }
                    }
                    ?>
                   </div><?php
                //on affiche les valeurs de la bdd 
                $stmt = $bdd->prepare("SELECT DISTINCT * FROM bdd.Panier"); 
                if($stmt->execute()){
                    $result = $stmt->fetchAll(); //on récupère le resultat de la requete
                    foreach ($result as $key => $value) {
                    ?>
                    <div class="food-menu-box">
                    <div>
                        <h4><?php echo $value["nomRecette"]."\n";?> </h4>            
                    <br>
                    <span class="buttons" >
                        <a href="recette.php?q=<?php echo $value["nomRecette"]?>" class="btn btn-primary"> Consulter </a></span>
                    <span class ="buttons" >
                        <a href="removeCookie.php?q=<?php echo $value["nomRecette"]; ?>" class="btn btn-primary"> Supprimer des favoris </a>
                    </span>                
                </div>
                    </div>
                    <?php   }
                }else{
                    echo "0 résultats";
                };

                
            }?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <!-- footer Section Starts Here -->
    <section class="footer">
        <div class="container text-center">
            <p>Tous les droits réservés. </p>
            <p>Site crée par Roxane Bernard et Reen Martini.</p>
            <p>Template par Vijay Thapa.</p></p>
        </div>
    </section>
    <!-- footer Section Ends Here -->

</body>
</html>