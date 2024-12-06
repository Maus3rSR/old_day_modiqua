<?php	
	$page=$home='accueil';
	if (isset($_GET['page']) && !empty($_GET['page'])){
		
		$page=$_GET['page'];
		$invalide = array('/','/\/',':','.'); //Tableau contenant des fautes de frappe que la personne pourrait saisir dans l'adresse
				
		$page = str_replace($invalide,'',$page);
				
		if(!file_exists("./pages/pages_".$_SESSION['langue']."/".$page.".php")){
			$page = $home;
		}
	}

	include("./pages/pages_".$_SESSION['langue']."/$page.php");
?>