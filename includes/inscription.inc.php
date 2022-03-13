<?php 

if(isset($_POST['submit'])){
    //Tous les champs non obligatoires peuvent être null
    $nom = "null";
    $prenom = "null";
    $telephone = 0;
    $sexe=""; 
    $adresse=""; 
    $cp=""; 
    $ville=""; 
    require_once('bdd.inc.php');
    $results = $bdd->prepare('SELECT * FROM bdd.Utilisateur where mail = :mailVerification');
    $mailVerification = $_POST['mail'];
    $results->bindParam(':mailVerification', $mailVerification);
    $results->execute();
        if ($donnees = $results->fetch()){
            //on le renvoie à la page d'inscription
            header("location: ../inscription.php?error=mailExistant"); 
        
        }
              //Le mail n'est pas utilisé par quelqu'un d'autre
        else{

            //vérifier que l'id est unique : 
                $results = $bdd->prepare('SELECT * FROM bdd.Utilisateur where id = :identifiant');
                $idVerification = $_POST['uid'];
                $results->bindParam(':identifiant', $idVerification);
                $results->execute();
                if ($donnees = $results->fetch()){
                    //on le renvoie à la page d'inscription
                    header("location: ../inscription.php?error=idExistant"); 

                }

            //Si les champs obligatoires ne sont pas vides, on enregistre leur valeur
            if (!empty($_POST["nom"])){
                $nom = $_POST["nom"];
            }
            if (!empty($_POST["prenom"])){
                $prenom = $_POST["prenom"];
            }
            if (!empty($_POST["sexe"])){
                $sexe = $_POST["sexe"];
            }
            if (!empty($_POST["naissance"])){
                $naissance = $_POST["naissance"];
            }
            
            if(!empty($_POST["mail"])){
                $mail = $_POST["mail"];
            }
            if(!empty($_POST["mdp"])){
                $mdp = $_POST["mdp"];
            }
            if(!empty($_POST["uid"])){
                $uid = $_POST["uid"]; 
            }

            if(!empty($_POST["tel"])){
                $tel = $_POST["tel"];
            }

            if (!empty($_POST["adresse"])){
                $adresse = $_POST["adresse"];
            }
            if (!empty($_POST["cp"])){
                $cp = $_POST["cp"];
            }
            if (!empty($_POST["ville"])){
                $ville = $_POST["ville"];
            }
            print_r($_POST); 
            $stmt = $bdd->prepare("INSERT INTO bdd.Utilisateur (nom, prenom, id, mdp,  sexe, mail, ddn, numTelephone, adresse, codePostal,ville) VALUES (:nomInput, :prenomInput, :idInput, SHA1(:mdpInput), :sexeInput,:mailInput, :naissanceInput, :numTelephoneInput, :adresseInput, :cpInput, :villeInput )");
            //le mdp stocké dans la bdd est crypté 
            $stmt->bindParam(':nomInput', $nom);
            $stmt->bindParam(':prenomInput', $prenom);
            $stmt->bindParam(':idInput', $uid);
            $stmt->bindParam(':mdpInput', $mdp);
            $stmt->bindParam(':mailInput', $mail);
            $stmt->bindParam(':naissanceInput', $naissance);
            $stmt->bindParam(':sexeInput', $sexe);
            $stmt->bindParam(':adresseInput', $adresse);
            $stmt->bindParam(':cpInput', $cp);
            $stmt->bindParam(':villeInput', $ville); 
            $stmt->bindParam(':numTelephoneInput', $tel);
            if(!$stmt->execute()){
                echo $stmt->debugDumpParams(); 
            };
            
            header("location: ../inscription.php?error=none"); 
                 
        
    }

    
}else{
    header("location: ../inscription.php"); 
}