<?php
ob_start();
session_start();
require_once('./includes/bdd.inc.php');
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

    <script type="text/javascript">
        var nomCategorie = 'Aliment';
        //fonction pour afficher les listes des sous categories 
        function listeSousCategories(niveau) {
            id = "superCategories" + niveau;
            var idCategorie = document.getElementById(id);
            nomCategorie = idCategorie.options[idCategorie.selectedIndex].text;

            xmlhttp = new XMLHttpRequest();
            var element = document.createElement("select");
            if (niveau == "0") {
                niveau = "1";
            } else if (niveau == "1") {
                niveau = "2";
            } else if (niveau == "2") {
                niveau = "3";
            } else if (niveau == "3") {
                niveau = "4";
            } else if (niveau == "4") {
                niveau = "5";
            } else if (niveau == "5") {
                niveau = "6";
            } else if (niveau == "6") {
                niveau = "7";
            } else if (niveau == "7") {
                niveau = "8";
            }

            var div = document.getElementById("sousCategorie" + niveau);
            //on affiche les listes contenant les sous catégories 
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4) {
                    console.log(this.responseText);
                    div.innerHTML = this.responseText;
                }
            };
            link = "sousCategorie.php?q=" + nomCategorie + "&id=" + niveau;
            console.log(link);
            xmlhttp.open("GET", link, true);
            xmlhttp.send();
        }
        //fonction pour reintialiser les listes de recherche 
        function resetRecherche() {
            for (let i = 1; i <= 8; i++) {
                var div = document.getElementById("sousCategorie" + i);
                div.innerHTML = "";

            }
        }

        //fonction pour mettre à jour l'affichage des recettes
        function lancerRecherche() {
            event.preventDefault();
            console.log(nomCategorie);


            var div = document.getElementById("listeDesRecettes");
            xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4) {
                    console.log(" rep " + this.responseText);
                    div.innerHTML = this.responseText;
                }
            };
            link = "listeRecettes.php?q=" + nomCategorie;
            console.log(link);
            xmlhttp.open("GET", link, true);
            xmlhttp.send();
        }
    </script>

</head>

<body>
    <!-- Navbar Section Starts Here -->
    <?php require_once('navBar.php'); ?>
    <!-- Navbar Section Ends Here -->



    <!-- CAtegories Section Starts Here -->
    <section class="food-search text-center">
        <div class="container"></div>
    </section>

    <section class="food-menu">
        <div class="container">

            <h2 class="text-center">Découvrez nos catégories ! </h2><br>
            <div>
                <form id="formulaire">
                    <select id="superCategories0" class='sexe-form' onChange="listeSousCategories('0')">
                        <option value='-1'> catégories </option>
                        <?php
                        $stmt = $bdd->prepare("SELECT DISTINCT nom FROM bdd.SuperCategorie where nomSuper= 'Aliment'");
                        if ($stmt->execute()) {
                            $result = $stmt->fetchAll(); //on récupère le resultat de la requete
                            foreach ($result as $key => $value) {
                        ?>
                                <div class="food-menu-box">

                                    <div>
                                        <h4><?php echo "<option  value='$key' >" . $value["nom"] . "\n</option>"; ?> </h4> <br>

                                    </div>

                                </div>
                        <?php   }
                        } else {
                            echo "0 résultats";
                        }
                        ?>
                    </select>
                    <div id="sousCategorie0"></div>
                    <div id="sousCategorie1"></div>
                    <div id="sousCategorie2"></div>
                    <div id="sousCategorie3"></div>
                    <div id="sousCategorie4"></div>
                    <div id="sousCategorie5"></div>
                    <div id="sousCategorie6"></div>
                    <div id="sousCategorie7"></div>
                    <div id="sousCategorie8"></div>
                    <button class="btn btn-primary" type="submit" onclick="resetRecherche()" id="submit"> Annuler la recherche</button>
                    <button class="btn btn-primary" type="submit" onclick="lancerRecherche()" id="lancer"> lancer la recherche</button>

                </form>

                <section>
                    <div id="listeDesRecettes">

                    </div>
                </section>
                <!-- Categories Section Ends Here -->

                <div class="clearfix"></div>
                <!-- footer Section Starts Here -->
                <section class="footer">
                    <div class="container text-center">
                        <p>Tous les droits réservés. </p>
                        <p>Site crée par Roxane Bernard et Reen Martini.</p>
                        <p>Template par Vijay Thapa.</p>
                        </p>
                    </div>
                </section>

                <!-- footer Section Ends Here -->
            </div>
        </div>
        </div>
</body>

</html>