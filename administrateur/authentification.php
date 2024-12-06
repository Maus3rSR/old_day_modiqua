<?php
	// VERIFIE LA CONNECTION D'UN ADMIN //
	session_start(); 
	require_once("../include/fonctions.php");
	
	$login= bdd($_POST['login']);
	$pass= bdd($_POST['mdp']);
	
	$sql = "SELECT *
			FROM administrateur
			WHERE login_admin = '".$login."'
			AND pass_admin = '".$pass."'";
			
	connect();
	$req = mysql_query($sql) or die('Erreur d\'authentification admin: '.mysql_error());
	deconnect();
	
	if($row = mysql_fetch_assoc($req)){
		$_SESSION['connected'] = true;
		$_SESSION['admin'] = true;
		$login = $row['login_admin'];
		
		trace_historique($login.' s\'est connecte avec succes sur le module d\'administration. IP: '.$_SERVER["REMOTE_ADDR"]);
		header("Location: ./administration.php");
	}else{
		trace_historique('Un inconnu a essaye de se connecter sur le module d\'administration, sans succes. IP: '.$_SERVER["REMOTE_ADDR"]);
		header("Location: ./administration.php?page=login&error=1&login=".$login."&pass=".$pass);
	}
?>