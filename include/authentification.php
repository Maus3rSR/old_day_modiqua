<?php
	// VERIFIE LA CONNECTION D'UN MEMBRE PARTENAIRE //
	session_start(); 
	require("../include/fonctions.php");
	
	$login= bdd($_POST['login']);
	$pass= bdd($_POST['mdp']);
	
	$sql = "SELECT *
			FROM membre
			WHERE login_membre = '".$login."'
			AND pass_membre = '".$pass."'";
			
	connect();
	$req = mysql_query($sql) or die('Erreur SQL d\'authentification membre: '.mysql_error());
	deconnect();
	
	if($row = mysql_fetch_assoc($req)){
		$_SESSION['connected'] = true;
		$_SESSION['admin'] = false;
		$_SESSION['id_membre'] = $row['id_membre'];
		
		$login = $row['login_membre'];
		
		trace_historique($login." s'est authentifié avec succès sur l'accès partenaire. IP: ".$_SERVER["REMOTE_ADDR"]);
		header("Location: ../index.php?page=zone_partenaire");
	}else{
		trace_historique("Un inconnu a tenté de se connecter sans succes sur l'acces partenaire. IP: ".$_SERVER["REMOTE_ADDR"]);
		header("Location: ../index.php?page=acces_membre&categ=login&error=1");
	}
?>