<?php
//SCRIPT PHP POUR LE DOWNLOAD D'UN FICHIER SUR LE SERVEUR
	require_once("../include/fonctions.php");
		
	if(isset($_POST['submit_download'])){ //partie download
		$key = bdd($_POST['key']);
		
		$sql = "SELECT * FROM telechargement WHERE key_telechargement ='".$key."'";
		connect();
		$req = mysql_query($sql) or die('Impossible de récupérer le nom du fichier pour cette clé! : '.mysql_error());
		deconnect();
		
		$row = mysql_fetch_assoc($req);
		$nom = $row['nom_telechargement'];
		$url = '../telechargements/prive/'.$nom;
		$type = typeMime($nom);
		
		ini_set('zlib.output_compression', 0);
		$date = gmdate(DATE_RFC1123);
		
		header("Content-disposition: attachment; filename=".$nom);
		header("Content-Type: application/force-download");
		header("Content-Transfer-Encoding: $type\n"); // Surtout ne pas enlever le \n
		header("Content-Length: ".filesize($url));
		header("Pragma: no-cache");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0, public");
		header("Expires: 0");
		
		session_write_close();
		readfile($url); 
		exit();
	}
?>