<?php
include("../Donnees.inc.php");
define( 'DB_NAME', 'coming_soon');
$username='root';
$pwd='';
$db='bdd';


try{
    $bdd=new PDO('mysql:host=localhost;charset=utf8','root','');
}catch (Exception $e){
    die('Erreur :'.$e->getMessage());
}