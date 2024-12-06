<?php

if (is_admin() && is_connected()){
	if (isset($_GET['page']) && !empty($_GET['page'])){
		
			$page=$_GET['page'];
			$invalide = array('/','/\/',':','.'); //Tableau contenant des fautes de frappe que la personne pourrait saisir dans l'adresse
				
			$page = str_replace($invalide,'',$page);
				
			if(file_exists("./".$page."_aside.php")){
				include("./".$page."_aside.php");
			}
	}
}

?>