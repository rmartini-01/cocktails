<?php  
ob_start();
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
    <script type="text/javascript" src="./js/jquery-1.4.2.min_.js"></script>
    <script type="text/javascript" src="./js/jquery.autocomplete.js"></script>
    <script>
        jQuery(function(){
            $("#search").autocomplete("search.php");
        });
    </script>

</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="images/Logo.png" alt="cocktail Logo" class="img-responsive">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="index.php">Accueil</a>
                    </li>
                    <li>
                        <a href="listeCategories.php">Catégories</a>
                    </li>
                    <li>
                        <a href="recettes.php">Recettes</a>
                    </li>
                    <li> <a href="favoris.php">Favoris</a></li>

                    <?php if(isset($_SESSION['login'])){
                         echo "<li> <a href='espaceClient.php'>Mon compte</a></li>";

                        echo "<li> <a href='includes/deconnexion.inc.php'>Se déconnecter</a></li>"; 
                        
                    }else{
                        echo "<li> <a href='inscription.php'> S'inscrire</a></li>"; 
                        echo "<li> <a href='connexion.php'>Se connecter </a></li>"; 
                    }?>
                    
                    
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>

    <!-- Navbar Section Ends Here -->

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="recette.php">
                <input type="search" name="q" id="search" placeholder="Rechercher des recettes.." required>
                <input type="submit" name="submit" value="Rechercher" class="btn btn-primary">
            </form>
            <br>
            <?php
                if(isset($_GET["error"])){
                    if($_GET["error"]== "recetteInexistante"){
                        ?><br> <strong><p style="background-color: #E83235; color: #2A243D; width: 50%; margin-left: 21%; border-radius:5px; "> La recette que vous cherchez n'existe pas!</p></strong>
                        <?php 
                    }
                }
                ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->


    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Recettes</h2>

            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="Photos/Margarita.jpg" alt="Margarita" class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4>Margarita</h4>
                    <p class="food-price"></p>
                    <p class="food-detail">
                        5 cl de tequila | 3 cl de triple sec | 2 cl de jus de citrons verts | sel
                    </p>
                    <br>

                    <span class="buttons" >
                        <a href="recette.php?q=Margarita" class="btn btn-primary"> Consulter </a></span>
                    <span class ="buttons" >
                        <a href="addCookie.php?q=Margarita" class="btn btn-primary"> Ajouter aux favoris </a>
                    </span>                
                </div>
            </div>

            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="Photos/Cuba_libre.jpg" alt="Cuba-libre" class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4>Cuba libre</h4>
                    <p class="food-price"></p>
                    <p class="food-detail">
                        6 cl de rhum blanc | 1/2 citron vert | 15 cl de coca-cola|glaçons                    </p>
                    <br>

                    <span class="buttons" >
                        <a href="recette.php?q=Cuba libre" class="btn btn-primary"> Consulter </a></span>
                    <span class ="buttons" >
                        <a href="addCookie.php?q=Cuba libre" class="btn btn-primary"> Ajouter aux favoris </a>
                    </span>                </div>
            </div>

            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="Photos/Tequila_sunrise.jpg" alt="Tequila-sunrise" class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4>Tequila-Sunrise</h4>
                    <p class="food-price"></p>
                    <p class="food-detail">
                        6 cl de tequila | 12 cl de jus d'orange | 2 cl de sirop de grenadine                    </p>
                    <br>

                    <span class="buttons" >
                        <a href="recette.php?q=Tequila Sunrise" class="btn btn-primary"> Consulter </a></span>
                    <span class ="buttons" >
                        <a href="addCookie.php?q=Tequila Sunrise" class="btn btn-primary"> Ajouter aux favoris </a>
                    </span>                </div>
            </div>

            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="Photos/Mojito.jpg" alt="Mojito" class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4>Mojito</h4>
                    <p class="food-price"></p>
                    <p class="food-detail">
                        6 cl de rhum cubain | 1/2 citron vert | 8 feuilles de menthe | eau gazeuse | 2 cuillères à café de sucre
                    </p>
                    <br>

                    <span class="buttons" >
                        <a href="recette.php?q=Mojito" class="btn btn-primary"> Consulter </a></span>
                    <span class ="buttons" >
                        <a href="addCookie.php?q=Mojito" class="btn btn-primary"> Ajouter aux favoris </a>
                    </span>                </div>
            </div>

            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="Photos/Coconut_kiss.jpg" alt="Coconut-kiss" class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4>Coconut-kiss</h4>
                    <p class="food-price"></p>
                    <p class="food-detail">
                        3 cl de jus d'ananas | 4 cl de jus d'oranges | 2 cl de sirop de noix de coco | 3 cl de crème fraîche | 1 tranche d'ananas | 1 morceau d'orange                    </p>
                    <br>

                    <span class="buttons" >
                        <a href="recette.php?q=Coconut kiss" class="btn btn-primary"> Consulter </a></span>
                    <span class ="buttons" >
                        <a href="addCookie.php?q=Coconut kiss" class="btn btn-primary"> Ajouter aux favoris </a>
                    </span>                </div>
            </div>

            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="Photos/Le_vandetta.jpg" alt="Le vandetta" class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4>Le vandetta</h4>
                    <p class="food-price"></p>
                    <p class="food-detail">
                        15 cl de jus d'ananas | 2 cl de sirop d'orgeat | 2 cl de sirop de fraises | 5 fraises                    
                    </p>
                    <br>
                    <span class="buttons" >
                        <a href="recette.php?q=le vandetta" class="btn btn-primary"> Consulter </a></span>
                    <span class ="buttons" >
                        <a href="addCookie.php?q=le vandetta" class="btn btn-primary"> Ajouter aux favoris </a>
                    </span>
                </div>
            </div>


            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="recettes.php">Voir toutes les recettes</a>
        </p>
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