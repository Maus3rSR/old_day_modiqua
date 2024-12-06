<?php
require_once("../include/fonctions.php");

/* FICHIER PHP CONTENANT TOUTES LES FONCTIONNALITES AJAX */


//------------------------------//
//ajax génération de mot de passe
//-----------------------------//
if (isset($_POST['generate']) && ($_POST['generate']==1)){
	$mdp = str_replace('.','',uniqid(rand(), true));
	echo $mdp; //renvoi de la réponse à la fonction javascript
}

//-----------------------------------------------//
//ajax barre de recherche dans l'administration
//-----------------------------------------------//
if (isset($_POST['table']) && !empty($_POST['table'])){
	$table = bdd($_POST['table']);
	$like = bdd($_POST['search']);
	$choix = bdd($_POST['choix']);
	$chaine = '';
	
	//multitudes de tests parce qu'on doit différencier membre/client/news/partenaire/temoignage (à cause de leur nom dans la BDD) et aussi l'action (modifier/supprimer/en cours de validation)
	if ($table == 'membre'){
		if ($choix == 'edit'){
			$sql = "SELECT * FROM membre WHERE nom_membre LIKE '%".$like."%'";
			connect();
			$req = mysql_query($sql) or die('Erreur select membre ajax: '.mysql_error());
			deconnect();
			
			while($row = mysql_fetch_assoc($req)){
				$nom_membre = html($row['nom_membre']);
				$id = html($row['id_membre']);
				$chaine = $chaine.'<h2>'.$nom_membre.'</h2><a href="./administration.php?page=membre&amp;choix=edit&amp;id='.$id.'">Modifier</a>';
			}
			
			
		}else if($choix == 'delete'){
		
			$sql = "SELECT * FROM membre WHERE nom_membre LIKE '%".$like."%'";
			connect();
			$req = mysql_query($sql) or die('Erreur select membre ajax: '.mysql_error());
			deconnect();
			
			$chaine = $chaine.'<form method="post" action="./administration.php?page=membre&action=delete">
				<table border="0">';
			
			while($row = mysql_fetch_assoc($req)){
				$nom_membre = html($row['nom_membre']);
				$id = html($row['id_membre']);
				$chaine = $chaine.'<tr>
						<td><input type="checkbox" name="choix_suppr[]" value="'.$id.'"></input></td>
						<td><h2>'.$nom_membre.'</h2></td>
					</tr>
					<tr>
						<td><a href="./administration.php?page=membre&amp;choix=delete&amp;id='.$id.'" target="_blank">Voir le membre</a></td>
						<td></td>
					</tr>';
			}
			
			$chaine = $chaine.'</table><br/>
				<INPUT class="style_submit" type="submit" value="Supprimer" Onclick="return confirm(\'êtes-vous sûr de vouloir supprimer ces enregistrements?\');"></INPUT>
				</form>';
				
				
		}
	}
	
	echo $chaine; //renvoi de la réponse (code HTML brut) à la fonction javascript
}



//-----------------------------------------------//
//ajax récupération d'une galerie d'images
//-----------------------------------------------//
if(isset($_POST['id_galerie']) && !empty($_POST['id_galerie'])){

	$id = bdd($_POST['id_galerie']);
	
	//On récupère la galerie
	$sql = "SELECT * FROM media WHERE id_categorie='".$id."'";
	connect();
	$req = mysql_query($sql);
	deconnect();
	$chaine = ''; //chaine HTML brut à retourner à la fonction JS-AJAX get_galerie
	$i = 0;
	
	
	while($row = mysql_fetch_assoc($req)){
		$i = $i+1;
	
		$nom = html($row['nom_media']);
		$id = html($row['id_media']);
		
		$chaine = $chaine.'<td><input type="checkbox" name="choix_suppr[]" value="'.$id.'"></input> <p>'.$nom.'</p> <br/> <a href="./administration.php?page=galerie&img='.$id.'" target="_blank">Voir l\'image</a></td>';
	
		if($i == 5){
			$chaine = $chaine.'<br/><br/>';
			$i = 0;
		}
	}
	
	echo $chaine; //return à la fonction js-ajax get_galerie
}

?>