
    <!-- Navbar Section Starts Here -->
    <?php require_once('navBar.php');?>
    <!-- Navbar Section Ends Here -->
    <section >
        
        <div class="description text-center">
        <h2> Connectez-vous </h2>
            <form class ="formInscription" action="includes/connexion.inc.php" method="post">
            <?php
                //gestion des erreurs
                if(isset($_GET["error"])){
                    if($_GET["error"]== "mailInexistant"){
                        ?><br> <strong><p style="color:#E83235; "> Le mail <?$_POST["mail"]?> n'existe pas!</p></strong>
                        <?php 
                    }else if($_GET["error"]== "idInexistant"){
                        ?><br> <strong><p style="color:#E83235; "> L'identifiant <?$_POST["id"]?> n'existe pas!</p></strong>
                        <?php  
                    }else if($_GET["error"]== "mdpIncorrect"){
                        ?><br> <strong><p style="color:#E83235; "> Mot de passe incorrect</p></strong>
                        <?php  
                    }
                }   
            ?>
            <input class="input" type="text" name ="uid" placeholder="Votre adresse mail ou identifiant..">
            <input class="input" type="password" name ="mdp" placeholder="Votre mot de passe..">  

            <button class="btn btn-primary" type="submit" name="submit"> Connectez-vous </button>

            
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