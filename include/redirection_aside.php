<?php
/* PAGE PHP QUI PERMET D'INCLURE LE BON CONTENU EN FONCTION DE CE QUE LA PERSONNE A CLIQUE */
	$page=$home='accueil';
	if (isset($_GET['page']) && !empty($_GET['page'])){
	
		$page=$_GET['page'];
		$invalide = array('/','/\/',':','.'); //Tableau contenant des fautes de frappe que la personne pourrait saisir dans l'adresse
			
		$page = str_replace($invalide,'',$page);
			
		if(!file_exists("./pages/pages_".$_SESSION['langue']."/".$page."_aside.php")){
			$page = $home;
		}
	}

	include("./pages/pages_".$_SESSION['langue']."/".$page."_aside.php");
?>