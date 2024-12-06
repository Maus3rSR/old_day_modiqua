<?php
// PAGE DE LA ZONE D'ECHANGE MEMBRE

if(!isset($_POST['submit_upload']) && !isset($_POST['submit_download'])){
	if(is_connected() && !is_admin()){
			?>
		
		<p>Vous êtes situé sur la zone d'échange privée du site Modiqua. Vous pouvez faire partager des fichiers sur le site. <br/>
		Quand vous partagerez un fichier, une clé aléatoire sera générée et permettra à toutes les personnes qui connaitrons cette clé de télécharger le fichier. <br/><br/>
		<b style="color:red;">ATTENTION: Cette clé est unique et ne peut en aucun cas être changée. Si vous perdez la clé, veuillez contacter l'administrateur du site.</b></p><br/>
		
		<h1>Upload d'un fichier (32Mo max)</h1>
		
		<form method="post" action="http://modiqua.eu/index.php?page=zone_partenaire" enctype="multipart/form-data">
			<input type="file" name="u_file" required="required"></input><br/><br/>
			<input class="style_submit" type="submit" name="submit_upload" Value="Uploader"></input>
		</form>
		
		<br/><br/><br/>
		
		<h1>Download d'un fichier</h1>
		<form method="post" action="/include/download.php">
			<p>Clé de téléchargement: <input type="text" name="key" required="required"></input></p>
			<input class="style_submit" type="submit" name="submit_download" Value="Télécharger"></input>
		</form>
		
		<?php
	}else{
		echo '<p>Cette page est un accès privé, veuillez vous connecter pour y accéder.</p>';
	}
}else{ //traitement du formulaire

	if(isset($_POST['submit_upload'])){ //partie upload

		$nom = str_replace(' ', '_', bdd($_FILES['u_file']['name'])); //en enregistrant le nom, on enlève aussi les espaces qui posent problème pour le download
		
		//on enregistre le fichier sur le serveur
		$OK = move_uploaded_file($_FILES['u_file']['tmp_name'], "./telechargements/prive/".$nom);
		if($OK){
			//on créé la clé de téléchargement
			$key = substr(str_replace('.','',uniqid(rand(), true)),8,16);
			
			//on enregistre dans la base de données
			$sql = "INSERT INTO telechargement VALUES('', '".$nom."', '".$key."', '".$_SESSION['id_membre']."', '1')";
			connect();
			mysql_query($sql) or die('Erreur lors de l\'ajout d\'un upload bdd: '.mysql_error());
			deconnect();
			
			echo '<p>Upload effectué avec succès! <br/> <b style="color=red">/!\ Clé de téléchargement:</b> '.$key.'</p><br/><a href=http://modiqua.eu/index.php?page=zone_partenaire>REFAIRE UN UPLOAD/DOWNLOAD</a>';
			
		}else{
			echo '<p>Erreur survenu lors de l\'enregistrement du fichier sur le serveur.</p>';
		}
		
	}
}
?>