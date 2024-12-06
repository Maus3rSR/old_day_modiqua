<?php //PAGE DU MENU

//fonction qui retourne le menu
function bdd_menu(){
	$sql = "SELECT * FROM menu m, website w WHERE m.id_website=w.id_website AND langue_website='".$_SESSION['langue']."' ";
	connect();
	$req = mysql_query($sql) or die('Erreur de récupération du menu: '.mysql_error());
	deconnect();
	
	return $req;
}

//fonction qui affiche le menu
function affiche_menu(){
	if(isset($_GET['page']) && !empty($_GET['page'])){
		$page = html($_GET['page']);
	}else{
		$page = 'accueil';
	}
	
	$menu = bdd_menu();
	
	?><ul id="navigation"><li id="bourrage"></li><?php
	
	while($row = mysql_fetch_assoc($menu)){
		$nom = html($row['nom_menu']);
		$php = html($row['fichier_php_menu']);
		
		if($php == $page)
			$classname="li_current";
		else
			$classname="li_normal";
		
		?><li class="<?php echo $classname ?>" ><a href="http://modiqua.eu/<?php echo $php ?>" title="Accéder à la page: <?php echo $nom ?>"><?php echo $nom ?></a></li><?php
	}
	
	?></ul><?php
}


?>