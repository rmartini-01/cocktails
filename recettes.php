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
    <script type="text/javascript" src="./js/jquery-1.4.2.min_.js"></script>
    <script type="text/javascript" src="./js/jquery.autocomplete.js"></script>
    <script>
        jQuery(function(){
            $("#ingVoulu").autocomplete("filtreIngredientAvec.php");
        });
        jQuery(function(){
            $("#ingNonVoulu").autocomplete("filtreIngredientSans.php");
        });
    </script>
    <!-- liste de fonctions utiles pour la recherche d'ingrédients-->
    <script>
        var listeAvec = new Array(); 
        var listeSans = new Array(); 

        //fonction pour supprimer l'ajout d'un ingrédient ainsi que son bouton 
        function supprimerIngAvec(str){
            listeAvec.splice(listeAvec.indexOf(str), 1); 
            afficherRecette("") ;
            var bouton = document.getElementById(str); 
            bouton.remove(); 
            var titre = document.getElementById('resultats'); 
                titre.innerHTML= "" ; 

        }
        
        //fonction pour ajouter un ingrédient voulu et le bouton pour le retirer
        function ajouterIngAvec(str){
            if(listeAvec.indexOf(str) == -1){
                listeAvec.push(str);  //ajout de l'ingrédient à la liste des ingrédients voulus 
                var titre = document.getElementById('resultats'); 
                titre.innerHTML= "Résultats de votre recherche" ; 
                var form = document.getElementById('boutonsAjouter'); 
                var bouton = document.createElement("BUTTON"); 
                bouton.setAttribute("id", str); 
                bouton.setAttribute("class", "btn btn-primary");
                bouton.setAttribute("onclick", "supprimerIngAvec(this.id)");
                bouton.innerHTML = "<span>" + str + "</span>"; 
                form.insertBefore(bouton, null); 
            }
        }

       //fonction pour ajouter un ingrédient non voulu 
       function ajouterIngSans(str){
            //on l'ajoute seulement s'il n'est pas déjà dans la liste
            if(listeSans.indexOf(str)==-1){
                listeSans.push(str); 
                var titre = document.getElementById('resultats'); 
                titre.innerHTML= "Résultats de votre recherche" ; 
                var form = document.getElementById('boutonsSupprimer'); 
                var bouton = document.createElement("BUTTON"); 
                bouton.setAttribute("id", str); 
                bouton.setAttribute("class", "btn btn-primary");
                bouton.setAttribute("onclick", "supprimerIngSans(this.id)");
                bouton.innerHTML = "<span>" + str + "</span>"; 
                form.insertBefore(bouton, null); 

            }
        }
        //fonction pour supprimer d'un ingrédient non voulu ainsi que son bouton 

        function supprimerIngSans(str){
            listeSans.splice(listeSans.indexOf(str), 1); 
            afficherRecette(""); 
            var bouton = document.getElementById(str);
            bouton.remove(); 
            var titre = document.getElementById('resultats'); 
                titre.innerHTML= "" ;
        }
        //fonction pour afficher la liste des recettes en fonction des listes de recherche
        function afficherRecette(cond){
            if(cond == 'ajouter'){
                ajouterIngAvec(document.getElementById('ingVoulu').value); 
                console.log(listeAvec); 
            }else if(cond== 'supprimer'){
                ajouterIngSans(document.getElementById('ingNonVoulu').value); 
            }

            var str = "";
            var div = document.getElementById("listeRecettes"); 
            
            //on supprime les recettes déjà affichées
            div.innerHTML = ""; 

            var compteur = 0; 
            var strAjouter = ""; 
            var strSupprimer= ""; 
            compteur=0; 
            //on ajoute les ingrédients à la requete
            listeAvec.forEach(element =>{
                strAjouter += "nomRecette IN (SELECT nomRecette FROM bdd.liaison WHERE nomIngredient = \"" + element + "\")"; 
                if(compteur < listeAvec.length -1){
                    strAjouter+= " OR "; 
                }
                compteur +=1; 
            }); 

            compteur = 0; 
            listeSans.forEach(element =>{
                strSupprimer += "nomRecette NOT IN (Select nomRecette from bdd.liaison where nomIngredient = \""+element+"\")"; 
                if(compteur < listeSans.length -1){
                    strSupprimer+= " AND "; 
                }
                compteur +=1; 
            }); 
            
        
            //code pour les navigateurs IE7+, Firefox, Chrome, Opera, Safari
            //on lance le fichier getRecettes.php avec la bonne requete 
            xmlhttp = new XMLHttpRequest();
            
            var element = document.createElement("p");
            
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4) {
                    var liste = this.responseText.split("\n");
                    element.innerHTML = innerHTMLRecette(liste);
                    div.insertBefore(element, null);
                }
            };
            if (strAjouter != "") {
                str += "(" + strAjouter + ")";
                if (strSupprimer != "") {
                    str += " AND (" + strSupprimer + ")";
                }
            } else {
                if (strSupprimer != "") {
                    str += strSupprimer;
                }
            }

            xmlhttp.open("GET", "getRecettes.php?q="+str , true);
            xmlhttp.send();
            
        }

        //fonction pour afficher les la liste des recettes  
        function innerHTMLRecette(liste){
            var listeRecettes = String(liste).split("_");
            var strP = "<br><br>";
            var innerListe;
            for(var j=0; j<listeRecettes.length-1; j++) {
                innerListe = listeRecettes[j].split(",");
            
                strP += "<div class='food-menu-box'> <div><strong>Recette</strong> : " + innerListe[0];
                strP += "<br>";
                strP+="</h4> <br> <span class='buttons'><a href='recette.php?q="+ innerListe[0]+ "'class='btn btn-primary'> Consulter </a></span>";
                strP+= "<span class='buttons'><a href='addCookie.php?q="+innerListe[0]+ "'class='btn btn-primary'> Ajouter aux favoris </a> </span> </div> </div>";
            }
            return strP;
        }

    </script>
</head>


<body>
    <!-- Navbar Section Starts Here -->
    <?php require_once('navBar.php'); ?>
    <!-- Navbar Section Ends Here -->
    <section class="food-search text-center">
        <div class="container">
        
        </div>
    </section>
    <!-- Recipe Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Recettes</h2>
            <div class="filtres">
            
            <div class="formulaires">
        
                <h4 style="margin-left:3%" >Ingrédients souhaités dans votre cocktail</h4> </br>
                <input id="ingVoulu" type="search" name="ingVoulu" type="text"required/>
                
                <button id="validerAjout" class="btn btn-primary" name="Valider" onclick="return afficherRecette('ajouter')">Ajouter</button>
                <div id="boutonsAjouter"></div>
                </br>
                <h4 style="margin-left:3%" >Ingrédients non souhaités dans votre cocktail</h4> </br>
                <input id="ingNonVoulu" type="search" name="ingNonVoulu" type="text"required/>
                
                <button id="validerAjout" class="btn btn-primary" name="Valider" onclick="return afficherRecette('supprimer')">Enlever</button>
                <div id="boutonsAjouter"></div>
      </div>
            <div id="boutonsSupprimer"></div>
            </div>
            <!-- Affichage des recettes-->
            <h2 class="text-center" id="resultats"></h2>
            <div id="listeRecettes"></div>
            <div class="clearfix"></div>
            <h2 class="text-center"> Toutes nos recettes</h2>
            <?php
            require_once('./includes/bdd.inc.php'); 
                $stmt= $bdd->prepare("select * from bdd.Recettes");
                if($stmt->execute()){
                    $result = $stmt->fetchAll(); //on récupère le resultat de la requete
                    foreach ($result as $key => $value) {
                    ?>
                    <div class="food-menu-box">
                    <div> 
                        <div class="food-menu-img">
                            <span style="font-size: 0.73em">
		                    <img src="Photos/<?php require_once('photos.php');echo photo_nom($value['nom']);?>.jpg" alt="image" onerror="this.style.display='none'" class="img-responsive img-curve">
		                   </span>
		                </div>
                        <h4><?php echo $value["nom"]."\n";?> </h4>            
                    <br>
                    <span class="buttons" >
                        <a href="recette.php?q=<?php echo $value["nom"]?>" class="btn btn-primary"> Consulter </a></span>
                    <span class ="buttons" >
                        <a href="addCookie.php?q=<?php echo $value["nom"]; ?>" class="btn btn-primary"> Ajouter aux favoris </a>
                    </span>   
                                 
                </div>
                    </div>
                    <?php   }
                }else{
                    echo "0 résultats";
                };

            ?> 
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