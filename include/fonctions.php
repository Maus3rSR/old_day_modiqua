<?php 
/*****************/
/* FONCTIONS BDD */
/*****************/
function connect(){

	 /*$db = 'modiqua_1qtk';
	$host = 'localhost';
	$user = 'root';
	$mdp = ''; */
	
	$db = 'modiqua_1qtk';
	$host = '10.2.0.129';
	$user = 'modiqua_1qtk';
	$mdp = '613iynbT';
	
	$connect = mysql_connect($host,$user,$mdp) or die("erreur de connection au serveur! ".mysql_error());
	mysql_select_db($db,$connect) or die("erreur de connection a la BDD ! ".mysql_error());
}

function deconnect(){
	mysql_close();
}

function Nb_enregistrement($id,$table){ // retourne le nombre d'enregistrement d'une table
	$select = 'SELECT count('.$id.') FROM '.$table.'';
	
	connect();
	$result = mysql_query($select) or die ('Erreur recupération du nombre d\'enregistrement: '.mysql_error() );
	deconnect();
	
	$row = mysql_fetch_row($result);

	return $row[0];

}

function trace_historique($nature){ //laisse une trace d'une action dans l'historique
	$sql = "INSERT INTO historique VALUES('','".bdd($nature)."', NOW(), 1)";

	connect();
	mysql_query("SET NAMES UTF8");
	mysql_query($sql) or die("Erreur dans l'enregistrement d'un historique: ".mysql_error());
	deconnect();
}

function maj_website($contenu, $action){ //dès qu'une action administrative est effectué (ajout/modification/suppression d'un contenu), on met à jour dans la dernière date de mise à jour du site web
	$sql = "UPDATE website SET maj_website = NOW()";
	
	connect();
	mysql_query($sql) or die("Erreur dans la mise à jour du site: ".mysql_error());
	deconnect();
	
	trace_historique("Changement de contenu: ".bdd($action)." ".bdd($contenu)." a été effectuée, update de la maj du site web");
}

function getCategs($page){ // RETOURNE LES CATEGORIES D'UN MENU DANS UN RESULTAT SQL
	
	$l = $_SESSION['langue'];
	if($l == 'fr') $l=1;
	else if($l == 'en') $l=2;
	else if($l == 'de') $l=3;
	
	$sql = "SELECT *
			FROM categorie c, menu m
			WHERE c.id_menu = m.id_menu
			AND fichier_php_menu = '".$page."'
			AND id_website ='".$l."'";
	
	connect();
	$req = mysql_query($sql) or die('Erreur de recupération des catégories: '.mysql_error());
	deconnect();
	
	return $req;
}
//-------------------------------------------------------------------------------------------------------------------------------------------------------------//



/***************************************************************************/
/* FONCTIONS PERMETTANT DE SECURISER LES DONNEES E/S DE LA BASE DE DONNEES */
/***************************************************************************/
	// Données entrantes
	function bdd($string){
		// On regarde si le type de string est un nombre entier (int)
		if(ctype_digit($string)){
			$string = intval($string); // convertir les nombres en entier en utilisant la base 10
		}
		// Pour tous les autres types on échappe les caractères susceptibles d'être des injections SQL pirates
		else{
			connect();
			$string = mysql_real_escape_string($string);
			$string = addcslashes($string, '%_');
			deconnect();
		}
			
		return $string;
	}
		
	// Données sortantes
	function html($string){
		// On transforme les balises html dans l'adresse http susceptibles d'être des injections HTML pirates
		return htmlentities($string);
	}

	
/*********************************************************************/
/* FONCTION QUI AFFICHE UNE BARRE DE RECHERCHE POUR UNE TABLE DONNEE */
/*********************************************************************/
function search_tool($table,$choix){ // $table est la table de la BdD concerne, $choix et le choix d'action sur la table (modifier/supprimer/valider)
	?>
	<form action="" method="POST">
		<input type="text" size="30" name="search_<?php echo $table ?>"></input>
		<input type="button" class="style_submit" value="Rechercher" Onclick="search_ajax('<?php echo $table ?>', '<?php echo $choix ?>');"></input>
	</form>
	<?php
}	
	
	
/****************************************************************************/	
/* FONCTION QUI AFFICHE BOUTON PRECEDENT / SUIVANT  - SYSTEME DE PAGINATION */
/****************************************************************************/
function displayNextPreviousButtons($limite,$total,$nb,$page){
	$limiteSuivante = $limite + $nb;
	$limitePrecedente = $limite - $nb;
	echo  '<table class="displayNextPrevButtons"><tr>'."\n";
	if($limite != 0) {
			echo  '<td valign="top">'."\n";
			echo  '<form action="./index.php?page='.$page.'" method="post">'."\n";
			echo  '<input type="image" src="../images/precedent.png" value="submit">'."\n";
			echo  '<input type="hidden" value="'.$limitePrecedente.'" name="limite">'."\n";
			echo  '</form>'."\n";
			echo  '</td>'."\n";
	}
	if($limiteSuivante < $total) {
			echo  '<td valign="top">'."\n";
			echo  '<form action="./index.php?page='.$page.'" method="post">'."\n";
			echo  '<input type="image" src="../images/suivant.png" value="submit">'."\n";
			echo  '<input type="hidden" value="'.$limiteSuivante.'" name="limite">'."\n";
			echo  '</form>'."\n";
			echo  '</td>'."\n";
				
	}
	echo  '</tr></table>'."\n";
}


function displayNextPreviousButtonsAdmin($limite,$total,$nb,$page,$choix){ //même que précédemment mais renseigne en plus le choix d'action fait par l'administrateur
	$limiteSuivante = $limite + $nb;
	$limitePrecedente = $limite - $nb;
	echo  '<table class="displayNextPrevButtons"><tr>'."\n";
	if($limite != 0) {
			echo  '<td valign="top">'."\n";
			echo  '<form action="./administration.php?page='.$page.'&choix='.$choix.'" method="post">'."\n";
			echo  '<input type="image" src="../images/precedent.png" value="submit">'."\n";
			echo  '<input type="hidden" value="'.$limitePrecedente.'" name="limite">'."\n";
			echo  '</form>'."\n";
			echo  '</td>'."\n";
	}
	if($limiteSuivante < $total) {
			echo  '<td valign="top">'."\n";
			echo  '<form action="./administration.php?page='.$page.'&choix='.$choix.'" method="post">'."\n";
			echo  '<input type="image" src="../images/suivant.png" value="submit">'."\n";
			echo  '<input type="hidden" value="'.$limiteSuivante.'" name="limite">'."\n";
			echo  '</form>'."\n";
			echo  '</td>'."\n";
				
	}
	echo  '</tr></table>'."\n";
}
//----------------------------------------------------------------------------------------------------------------------------//


/****************************************************/
/* FONCTION QUI TESTE SI UNE PERSONNE EST CONNECTEE */
/****************************************************/
function is_connected(){
	if (!isset($_SESSION['connected']) or $_SESSION['connected'] == false)
		return false;
	else
		return true;
}


/***********************************************************/	
/* FONCTION QUI TESTE SI LA PERSONNE CONNECTE EST UN ADMIN */
/***********************************************************/
function is_admin(){
	if (isset($_SESSION['admin']) && ($_SESSION['admin'] == true))
		return true;
	else
		return false;
}


/********************************************/
/* FONCTION QUI CONVERTIT UNE DATE FR -> US */
/********************************************/
function dateFRtoUS($date_fr){
	$array_date_fr=explode("/",$date_fr); //explode en un array
	$date_us= $array_date_fr[2].'-'.$array_date_fr[0].'-'.$array_date_fr[1];// annee, jour, mois 
	
	return $date_us;
}


/**************************************************/
/* FONCTION QUI RETOURNE LA PAGE / CATEG COURANTE */
/**************************************************/
function getPage(){ //retourne la page courante
	if(isset($_GET['page']) && !empty($_GET['page'])){
		return html($_GET['page']);
	}else return false;
}

function getCateg(){
	if(isset($_GET['categ']) && !empty($_GET['categ'])){
		return html($_GET['categ']);
	}else return false;	
}


/*************/
/* SOUS MENU */
/**** ********/
function getSousMenu(){ // AFFICHE LE SOUS MENU D'UN MENU ( ses catégories ) ?>
	<ul class="menu_aside">
		<?php
		$page = getPage();
		$categs = getCategs($page);
		
		while($row = mysql_fetch_assoc($categs)){
			$nom = html($row['nom_categorie']);
			$lien = html($row['fichier_php_categorie']);
		?>
		<li><a title="Accéder à la section <?php echo $nom; ?> de la page <?php echo $page; ?>" href="http://modiqua.eu/<?php echo $page; ?>/<?php echo $lien; ?>"><?php echo $nom; ?></a></li>
		<?php
		}
		?>
	</ul> <?php
}



/******************************************/
/* FONCTION QUI PERMET D'ENVOYER UN EMAIL */
/******************************************/
function sendmail($mail_expediteur, $subject, $message, $fic_temp){

	// set sur le fichier de configuration php.ini
	ini_set('SMTP', 'smtp.auth.orange.business.com');
	ini_set('smtp_port', 587);
	
	$mail = "contact@modiqua.eu"; // Déclaration de l'adresse de destination.
	if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui présentent des bogues.
	{
		$passage_ligne = "\r\n";
	}
	else
	{
		$passage_ligne = "\n";
	}
	//=====Déclaration des messages au format texte et au format HTML.
	$message_txt = $message;
	$message_html = "<html><head></head><body>".$message."</body></html>";
	//==========
	 
	if (!empty($fic_temp)){
		//=====Lecture et mise en forme de la pièce jointe.
		$fichier   = fopen($_FILES[$fic_temp]['tmp_name'], "r");
		$attachement = fread($fichier, filesize($_FILES[$fic_temp]['tmp_name']));
		$attachement = chunk_split(base64_encode($attachement));
		fclose($fichier);
		//==========
	}
	 
	//=====Création de la boundary.
	$boundary = "-----=".md5(rand());
	$boundary_alt = "-----=".md5(rand());
	//==========
	 
	//=====Définition du sujet.
	$sujet = $subject;
	//=========
	//=====Création du header de l'e-mail.
	$header = "From: <".$mail_expediteur.">".$passage_ligne;
	$header.= "Return-path: <".$mail_expediteur.">".$passage_ligne;
	$header.= "Reply-to: <".$mail_expediteur.">".$passage_ligne;
	$header.= "MIME-Version: 1.0".$passage_ligne;
	$header.= "Content-Type: multipart/mixed;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
	//==========
	 
	//=====Création du message.
	$message = $passage_ligne."--".$boundary.$passage_ligne;
	$message.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary_alt\"".$passage_ligne;
	$message.= $passage_ligne."--".$boundary_alt.$passage_ligne;
	//=====Ajout du message au format texte.
	$message.= "Content-Type: text/plain; charset=\"UTF-8\"".$passage_ligne;
	$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
	$message.= $passage_ligne.$message_txt.$passage_ligne;
	//==========
	 
	$message.= $passage_ligne."--".$boundary_alt.$passage_ligne;
	 
	//=====Ajout du message au format HTML.
	$message.= "Content-Type: text/html; charset=\"UTF-8\"".$passage_ligne;
	$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
	$message.= $passage_ligne.$message_html.$passage_ligne;
	//==========
	 
	//=====On ferme la boundary alternative.
	$message.= $passage_ligne."--".$boundary_alt."--".$passage_ligne;
	//==========
	 
	 
	 
	$message.= $passage_ligne."--".$boundary.$passage_ligne;
	 
	 if(!empty($fic_temp)){
		$typeFichier=typeMime($_FILES[$fic_temp]['name']);
		//=====Ajout de la pièce jointe.
		$message.= "Content-Type: ".$typeFichier."; name=".$_FILES[$fic_temp]['name'].$passage_ligne;
		$message.= "Content-Transfer-Encoding: base64".$passage_ligne;
		$message.= "Content-Disposition: attachment; filename= ".$_FILES[$fic_temp]['name'].$passage_ligne;
		$message.= $passage_ligne.$attachement.$passage_ligne.$passage_ligne;
		$message.= $passage_ligne."--".$boundary."--".$passage_ligne; 
		//========== 
	}
	
	//=====Envoi de l'e-mail.
	if(mail($mail,$sujet,$message,$header)){
		echo 'Votre mail a bien été envoyé!';
	}else{
		echo 'Un problème est survenu lors de l\'envoi du mail! ';
	}
	 
	//==========
}


/**************************************************/
/* FONCTION QUI VERIFIE SI UNE IMAGE EST CORRECTE */
/**************************************************/
function verif_image($size, $height, $width, $name, $extensions_valides){

	$erreur = array(false,'none',''); //résultat qui sera retourné à la fin, 
											   //$erreur[0] contient le boolean permettant de savoir si l'image et correcte ou non
											   //$erreur[1] contient la nature de l'erreur
											   //$erreur[2] contient l'extension si l'image est correcte
	$extension_upload = strtolower(  substr(  strrchr($_FILES[$name]['name'], '.')  ,1)  );
	
	if ($_FILES[$name]['error'] > 0){
		$erreur[1] = 'Erreur lors du transfert';
	}else if ( !in_array($extension_upload,$extensions_valides)){
		$erreur[1] = 'Extension invalide';
	}else if ($_FILES[$name]['size'] > $size){
		$erreur[1] ="Le poid de l'image est trop gros";
	}
	
	if ($image_sizes = getimagesize($_FILES[$name]['tmp_name'])){
		if(($image_sizes[0] > $width) or ($images_sizes[1] > $height)) $erreur[1]= "Image trop grande";
	}else{
		$erreur[1] = "Le fichier envoyé n'est pas une image";
	}
	
	if($erreur[1] == 'none'){ //l'image est correcte
		$erreur[0] = true;
		$erreur[2] = $extension_upload;
	}
	
	return $erreur;
}


/***************************************/
/* RECUPERER LE TYPE MIME D'UN FICHIER */
/***************************************/
function typeMime($nomFichier)
/* retourne le type MIME à partir de l'extension de fichier contenu dans $nomFichier
Exemple : $nomFichier = "fichier.pdf" => type renvoyé : "application/pdf" */
{
   // on détecte d'abord le navigateur, ça nous servira plus tard
   if(preg_match("@Opera(/| )([0-9].[0-9]{1,2})@", $_SERVER['HTTP_USER_AGENT'], $resultats))
      $navigateur="Opera";
   elseif(preg_match("@MSIE ([0-9].[0-9]{1,2})@", $_SERVER['HTTP_USER_AGENT'], $resultats))
      $navigateur="Internet Explorer";
   else $navigateur="Mozilla";

   // on récupère la liste des extensions de fichiers et leurs types Mime associés
   $mime=parse_ini_file("./mime.ini");
   $extension=substr($nomFichier, strrpos($nomFichier, ".")+1);
   
   /* on affecte le type Mime si on a trouvé l'extension sinon le type par défaut (un flux d'octets).
   Attention : Internet Explorer et Opera ne supporte pas le type MIME standard */
   if(array_key_exists($extension, $mime)) $type=$mime[$extension];
   else $type=($navigateur!="Mozilla") ? 'application/octetstream' : 'application/octet-stream';

   return $type;
}

?>