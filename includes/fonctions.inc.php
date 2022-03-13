<?php
function emptyInput($nom, $prenom, $uid, $mdp, $mail, $tel){
    $result = false; 
    if(empty($nom)|| empty($prenom) ||empty($uid) || empty($mdp) || empty($mail) || empty($tel) ){
        $result = true; 
    }
    return $result; 
}

function uidInvalide($uid){
    $result = false; 
    if(!preg_match("/^[a-zA-Z0-9]*$/" , $uid)){ // tester si le nom est correction : lettres et nombres seulement
        $result = true; 
    }
    return $result; 
}
function mailInvalide($mail){
    $result = false; 
    if(!filter_var($mail, FILTER_VALIDATE_EMAIL)){ // tester si le nom est correction : lettres et nombres seulement
        $result = true; 
    }
    return $result; 
}

function uidExists($bdd, $uid, $mail){
    $sql = "SELECT * from bdd.Utilisateur WHERE id=? OR mail = ?;"; 
    $stmt = $bdd->prepare("SELECT * FROM bdd.Utilisateur WHERE id= :uidInput OR mail= :mailInput)"); 
    $stmt->bindParam(':uidInput', $uid); 
    $stmt->bindParam(':mailInput', $mail);
    if($stmt->execute()){
        $result = $stmt->fetchAll(); //on récupère le resultat de la requete
        foreach ($result as $key => $value) {
            return $key; 
        }
    }else{
        echo "0 résultats";
        return false; 
    };

    $bdd->close(); 
}



function createUser($bdd, $nom, $prenom, $uid, $mdp, $mail, $tel){
  
    $stmt = $bdd->prepare("INSERT INTO bdd.Utilisateur (nom, prenom, if, mdp, numTelephone) VALUES (:nom, :prenom, :id, SHA1(:mdp), :numTelephone)");
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':login', $mail);
        $stmt->bindParam(':mdp', $mdp);
        $stmt->bindParam(':numTelephone', $tel);
        $stmt->execute();
        $_SESSION['login'] = $mail;
        if (isset($_SESSION['login'])){
            header("Location: ../");
        }
}