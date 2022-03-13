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
            $("#search").autocomplete("search.php");
        });
    </script>

</head>

<body>
    <!-- Navbar Section Starts Here -->
    <?php require_once('navBar.php');?>
    <!-- Navbar Section Ends Here -->
    
    <!--Data section starts here-->
    <section>
    <div class="description text-center">
    	<h2>Mes informations </h2>
    	<h4>Saisissez <u>uniquement</u> les champs que vous souhaitez modifier!<br><br> </h4>
    	<?php
                //gestion des erreurs
                if(isset($_GET["error"])){ 
                    if($_GET["error"]== "idExistant"){
                        ?><br> <strong><p style="color:#E83235; "> L'identifiant <?$_POST["id"]?> existe déjà!</p></strong>
                        <?php  
                    }else if($_GET["error"] =="none"){
                        ?><br> <strong><p style="color:green; "> Vos informations ont bien été changées!</p></strong>
                        <?php  
                    }
                }   
            ?>
    	<form class ="formInscription" action="includes/espaceClient.inc.php" method="post">
    	
    	<label class="input-label">Votre Nom : </label>
    	<input class="input" type="text" name ="nom" placeholder="<?php echo $_SESSION["nom"]; ?>">
    	
    	<label class="input-label">Votre Prénom : </label>
    	<input class="input" type="text" name ="prenom" placeholder="<?php echo $_SESSION["prenom"]; ?>">
    	
    	
    	<label class="input-label">Votre Identifiant : </label>
        <input class="input" type="text" name ="uid" placeholder="<?php echo $_SESSION["login"]; ?>">
        
        <label class="input-label">Votre Adresse mail : </label>
            <input class="input" type="text" name ="mail" placeholder="<?php echo $_SESSION["mail"]; ?>" pattern="[aA0-zZ9]+[.]?[aA0-zZ9]*@[aA-zZ]*[.]{1}[aA-zZ]+">
        
        <label class="input-label">Votre Mot de passe : </label>
        <input class="input" type="password" name ="mdp" placeholder="<?php echo $_SESSION["mdp"]; ?>"pattern =".{6,}">
        
        <label class="input-label">Votre sexe :   <?php echo $_SESSION["sexe"]; ?></label>
            <select class ="sexe-form" name="sexe">
						<option value="N" name="aucun">Non renseigné</option>
						<option value="F" name="homme">Femme</option>
						<option value="H" name="femme">Homme</option>
						<option value="A" name="aucun">Autre</option>
			</select><br>
        <label class="input-label">Votre date de naissance:   <?php echo $_SESSION["ddn"]; ?></label>            
        <input type="date" name="ddn">
        
        <label class="input-label">Votre numéro de téléphone: </label>
        <input class="input" type="text" name ="tel" placeholder="<?php echo $_SESSION["tel"]; ?>" pattern="0[3, 6, 9, 7, 2][0-9]{8}">
        
        <label class="input-label">Votre adresse : </label>
        <input class="input" type="text" name="adresse" placeholder="<?php echo $_SESSION["adresse"]; ?>">

        <label class="input-label">Votre code postal : </label>
        <input class="input" type="text" name="cp" placeholder="<?php echo $_SESSION["cp"]; ?>" pattern="[0-9]{5}">

        <label class="input-label">Votre ville : </label>
        <input class="input" type="text" name="ville" placeholder="<?php echo $_SESSION["ville"]; ?>">
        
    	</br>
	</br>
    	<button class="btn btn-primary" type="submit" name="submit"> Modifier mes informations </button>
	
    	</form>
    	
    </div>
    </section>
    <!--Data section ends here-->
    
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
