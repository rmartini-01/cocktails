<?php
if(isset($_POST['submit'])){

    require_once('bdd.inc.php');
    $mdpVerification='';
    $verifMail = $bdd->prepare("SELECT mdp FROM bdd.Utilisateur where mail =:mailVerification OR id=:mailVerification");
    $verifMdp = $bdd->prepare("SELECT mail FROM bdd.Utilisateur where mail =:mailVerification OR id=:mailVerification AND mdp = SHA1(:mdpVerification)");
    $reqMdp = $bdd->prepare("SELECT mdp FROM bdd.Utilisateur where mail =:mailVerification OR id=:mailVerification");
    $shamdp = $bdd->prepare("SELECT SHA1(:mdp) AS mdp FROM bdd.Utilisateur");

    /*On test si le mail existe dans la base de données*/
    $mailVerification = $_POST['uid'];
    $verifMail->bindParam(':mailVerification', $mailVerification);
    $verifMail->execute();

    if ($donnees = $verifMail->fetch()) {
        /*Le mail est dans la base de données*/

        /*On teste si le mot de passe associé  ce mail est celui qui est entré*/
        $verifMdp->bindParam(':mailVerification', $mailVerification);
        $verifMdp->bindParam(':mdpVerification', $_POST["mdp"]);
        $verifMdp->execute();

        if($donnees = $verifMdp->fetch()){
            /*Le mot de passe correspond*/
            session_start();
            $_SESSION['login'] = $mailVerification;
            header("Location: ../");
        }
        else{
            /*Le mot de passe ne correspond pas au mail*/
            echo "<p class='error'>Mot de passe incorrect</p>";
            header("location: ../connexion.php?error=mdpIncorrect"); 
        }
    }
    else{
        /*Le mail n'est pas dans la base de données*/
        header("location: ../connexion.php?error=idInexistant"); 
    }
}
else{
    header("location: ../connexion.php"); 
}