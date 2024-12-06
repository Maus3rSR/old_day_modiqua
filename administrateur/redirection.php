<?php
	if(!is_admin()){
		//redirection sur l'authentification
		$page='login';   
	}else{

		$page=$home='accueil';
		if (isset($_GET['page']) && !empty($_GET['page'])){
		
			$page=$_GET['page'];
			$invalide = array('/','/\/',':','.'); //Tableau contenant des fautes de frappe que la personne pourrait saisir dans l'adresse
				
			$page = str_replace($invalide,'',$page);
				
			if(!file_exists("./".$page.".php")){
				$page = $home;
			}
		}
	}

	include("./$page.php");
?>