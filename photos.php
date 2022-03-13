<?php
function photo_nom($nom){
	$nomScinde=explode(" ",$nom);
	if(empty($nomScinde)){
		$nomPhoto="";
	}else{
		$nomPhoto=$nomScinde[0];
		for ($i = 1; $i < sizeof($nomScinde); $i++) {

    			$nomPhoto.="_".$nomScinde[$i]; //ajoute le mot suivant apres un _ au nom
		}
	}
	return ucfirst($nomPhoto); //met la premiere lettre en majuscule
}

