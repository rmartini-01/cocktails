<?php require_once('navBar.php'); ?> 
    <!-- Navbar Section Ends Here -->
    <section >
        
        <div class="description text-center">
        <h2> Inscrivez-vous </h2>
            <form class ="formInscription" action="includes/inscription.inc.php" method="post">
<?php
                //gestion des erreurs
                if(isset($_GET["error"])){
                    if($_GET["error"]== "mailExistant"){
                        ?><br> <strong><p style="color:#E83235; "> Le mail <?$_POST["mail"]?> existe déjà!</p></strong>
                        <?php 
                    }else if($_GET["error"]== "idExistant"){
                        ?><br> <strong><p style="color:#E83235; "> L'identifiant <?$_POST["id"]?> existe déjà!</p></strong>
                        <?php  
                    }else if($_GET["error"] =="none"){
                        ?><br> <strong><p style="color:green; "> Votre compte a été crée!</p></strong>
                        <?php  
                    }
                }   
            ?>
            <label class="input-label">Votre nom : </label>
            <input class="input" type="text" name ="nom" placeholder="Votre nom..">

            <label class="input-label">Votre prénom : </label>
            <input class="input" type="text" name ="prenom" placeholder="Votre prenom..">
            <br>
            <label class="input-label">Votre sexe : </label>
            <select class ="sexe-form" name="sexe">
						<option value="N" name="aucun">Non renseigné</option>
						<option value="F" name="homme">Femme</option>
						<option value="H" name="femme">Homme</option>
						<option value="A" name="aucun">Autre</option>
			</select><br>
            <label class="input-label">Votre date de naissance: </label>            
            <input type="date" name="naissance">
            <label class="input-label">Votre identifiant *: </label>
            <input class="input" type="text" name ="uid" placeholder="example123" required>

            <label class="input-label">Votre adresse mail *: </label>
            <input class="input" type="text" name ="mail" placeholder="example@example.fr" pattern="[aA0-zZ9]+[.]?[aA0-zZ9]*@[aA-zZ]*[.]{1}[aA-zZ]+"> <!-- mail de la bonne forme--> 
            
            <label class="input-label">Votre mot de passe *:</label>
            <input class="input" type="password" name ="mdp" placeholder="xxxxxxx" pattern =".{6,}" required> <!-- mdp de au moins 6 caractères--> 
            
            <label class="input-label">Votre numéro de téléphone: </label>
            <input class="input" type="text" name ="tel" placeholder="0712345678" pattern="0[3, 6, 9, 7, 2][0-9]{8}"> <!-- numéro de tel français valide--> 
 
            <label class="input-label">Votre adresse : </label>
            <input class="input" type="text" name="adresse" placeholder="Boulevard des Aiguillettes">

            <label class="input-label">Votre code postal : </label>
            <input class="input" type="text" name="cp" placeholder="54506" pattern="[0-9]{5}">

            <label class="input-label">Votre ville : </label>
            <input class="input" type="text" name="ville" placeholder="Vandoeuvres-lès-Nancy">
            <br><p>* : Champs obligatoires</p><br>
            <button class="btn btn-primary" type="submit" name="submit"> Inscrivez-vous </button>
            </form>
            
        </div>
    </section>

    
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