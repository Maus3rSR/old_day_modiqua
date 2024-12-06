<?php
if(isset($_GET['page'])){ //pour éviter une intrusion en tapant /news.php dans la barre d'adresse qui contournerait le test de l'admin dans redirection.php
	if (!isset($_GET['choix']) && !isset($_GET['action'])){ ?>
		<h1>GESTION DES CLIENTS</h1>
		<p>Choisissez une action sur le menu de gauche.<br/>Vous pouvez ajouter, modifier ou supprimer un client.</p>
		<br/>
	<?php }else if(!empty($_GET['choix'])){

		$choix = $_GET['choix'];
		
		// PARTIE SAISIE AJOUT EDITION SUPPRESSION //
		if($choix == 'add'){
			?>
			<h1>AJOUTER UN CLIENT</h1>
			<form method="post" action="./administration.php?page=clients&action=add" enctype="multipart/form-data">
				<table border="0">
					<tr>
						<td>Nom client: </td>
						<td><INPUT type="text" name="nom_client"></INPUT></td>
					</tr>
					<tr>
						<td>Statut client:</td>
						<td><INPUT type="text" name="statut_client"></INPUT></td>
					</tr>
					<tr>
						<td>Contenu: </td>
						<td><TEXTAREA rows="10" cols="50" name="contenu_client"></TEXTAREA></td>
					</tr>
					<tr>
						<td>Description du logo: </td>
						<td><INPUT type="text" name="description_logo_client"></TEXTAREA></td>
					</tr>
					<tr>
						<td>Importer une image pour le logo:<br>(JPG, PNG ou GIF - Max 30Ko <br/>- Taille max 150x150) </td>
						<td><input type="file" name="logo_client" /></td>
					</tr>
					<tr>
						<td></td>
						<td><INPUT class="style_submit" type="submit" value="Publier"></INPUT></td>
					</tr>
				</table>
			</form>
			<p>Si vous ne renseignez pas de photos, une photo par défaut sera affichée sur le site.</p>
			<?php
		}else if ($choix == 'edit'){
			?><h1>MODIFIER UN CLIENT</h1><?php
		
			if(!isset($_GET['id'])){
				
				$nombre = 10;  // on va afficher 10 résultats par page.
				if (!isset($_POST['limite']) OR empty($_POST['limite'])){
					$limite = 0; // si on arrive sur la page pour la première fois on met limite à 0.
				}else{
					$limite = bdd($_POST['limite']);
				}
				$total = Nb_enregistrement('id_client','client'); //nombre total d'enregistrement dans la table
			
				//on affiche la liste des clients
				$sql = "SELECT * FROM client ORDER BY nom_client ASC LIMIT ".$limite.",".$nombre;
				connect();
				$req = mysql_query($sql) or die('Erreur de récupération des clients: '.mysql_error());
				deconnect();
				
				while($row = mysql_fetch_assoc($req)){
					$nom_client = html($row['nom_client']);
					$id = html($row['id_client']);
					$url = html($row['url_logo_client']);
					$alt = html($row['description_logo_client']);
				
					?>
					<h2><?php echo $nom_client ?></h2>
					<a href="./administration.php?page=clients&amp;choix=edit&amp;id=<?php echo $id ?>">Modifier</a>
					
					<?php
					
				}
				
				// affichage des boutons precedent / suivant
				displayNextPreviousButtonsAdmin($limite,$total,$nombre,'client','edit');
			}else{
				//on affiche LA news à modifier
				$id = bdd($_GET['id']);
				
				$sql = "SELECT * FROM client WHERE id_client='".$id."'";
				connect();
				$req = mysql_query($sql) or die('Erreur de récupération de la news: '.mysql_error());
				deconnect();
				
				$row = mysql_fetch_assoc($req);
				$nom_client = html($row['nom_client']);
				$contenu_client = html($row['contenu_client']);
				$statut_client = html($row['statut_client']);
				$description_logo_client = html($row['description_logo_client']);
				$url = html($row['url_logo_client']);
				

				?>
				<form method="post" action="./administration.php?page=clients&action=edit" enctype="multipart/form-data">
				<table border="0">
					<tr>
						<td>Nom du client: </td>
						<td><INPUT type="text" name="nom_client" value="<?php echo $nom_client ?>"></INPUT></td>
					</tr>
					<tr>
						<td>Statut_client:</td>
						<td><INPUT type="text" name="statut_client" value="<?php echo $statut_client ?>"></INPUT></td>
					</tr>
					<tr>
						<td>Contenu: </td>
						<td><TEXTAREA rows="10" cols="50" name="contenu_client"><?php echo $contenu_client ?></TEXTAREA></td>
					</tr>
					<tr>
						<td>Description logo: </td>
						<td><INPUT name="description_logo_client" type="text" value="<?php echo $description_logo_client ?>"></INPUT></td>
					</tr>
					<tr>
						<td>Modifier le logo: <br>(JPG, PNG ou GIF - Max 30Ko <br/>- Taille max 150x150) </td>
						<td><INPUT name="upload_logo_client" type="file"></INPUT></td>
					</tr>
					<tr>
						<td><INPUT type="hidden" name="id_client" value="<?php echo $id ?>"></INPUT></td>
						<td><INPUT class="style_submit" type="submit" value="Modifier"></INPUT></td>
						<td><INPUT type="hidden" name="url_logo_client" value="<?php echo $url ?>"></INPUT></td>
					</tr>
				</table>
				</form>
				<?php
			}
			
		}else if($choix == 'delete'){
			if(!isset($_GET['id'])){
			
				$nombre = 10;  // on va afficher 10 résultats par page.
				if (!isset($_POST['limite']) OR empty($_POST['limite'])){
					$limite = 0; // si on arrive sur la page pour la première fois on met limite à 0.
				}else{
					$limite = bdd($_POST['limite']);
				}
				$total = Nb_enregistrement('id_client','client'); //nombre total d'enregistrement dans la table			
			
				//on affiche la liste des news
				$sql = "SELECT id_client, nom_client FROM client ORDER BY id_client DESC LIMIT ".$limite.",".$nombre;
				connect();
				$req = mysql_query($sql) or die('Erreur de récupération des clients: '.mysql_error());
				deconnect();
				
				?>
				<h1>SUPPRIMER UN CLIENT</h1>
				
				<form method="post" action="./administration.php?page=clients&action=delete">
				<table border="0">
				<?php
				
				while($row = mysql_fetch_assoc($req)){
					$nom_client = html($row['nom_client']);
					$id = html($row['id_client']);
				
					?>
					<tr>
						<td><input type="checkbox" name="choix_suppr[]" value="<?php echo $id ?>"></input></td>
						<td><h2><?php echo $nom_client ?></h2></td>
					</tr>
					<tr>
						<td></td>
						<td><a href="./administration.php?page=clients&amp;choix=delete&amp;id=<?php echo $id ?>" target="_blank">Voir le client</a></td>
					</tr>
					<?php
				}
				
				
				?> 
				</table>
				<br/>
				<INPUT class="style_submit" type="submit" value="Supprimer" Onclick="return confirm('Êtes-vous sûr de vouloir supprimer ces enregistrements?');"></INPUT>
				</form><br/>
				<?php
				
				// affichage des boutons precedent / suivant
				displayNextPreviousButtonsAdmin($limite,$total,$nombre,'client','delete');
				
			}else{
				//on affiche le client
				$id = bdd($_GET['id']);
				
				$sql = "SELECT * FROM client WHERE id_client='".$id."'";
				connect();
				$req = mysql_query($sql) or die('Erreur de récupération des clients: '.mysql_error());
				deconnect();
				
				$row = mysql_fetch_assoc($req);
				$nom_client = html($row['nom_client']);
				$contenu_client = html($row['contenu_client']);
				$statut_client = html($row['statut_client']);
				$url_logo_client = html($row['url_logo_client']);
				$description_logo_client = html($row['description_logo_client']);
				?>
				<div style="clear: left;">
				<h1> <?php echo $nom_client ?></h1>
				<img src="<?php echo $url_logo_client ?>" alt="<?php echo $description_logo_client ?>" style="float: left; margin-right: 10px;"></img>
				<h2> <?php echo $statut_client ?></h2>
				<p> <?php echo $contenu_client ?></p>
				</div>
				<?php
			}
		}
	}

	
	
	// PARTIE SQL AJOUT EDITION SUPPRESSION //
	if (isset($_GET['action']) && !empty($_GET['action'])){
		$action = $_GET['action'];
		
		if($action == 'add'){
			// vérification de l'image envoyée
			$maxsize=30720;
			$maxLH = 150;
			$name = 'logo_client';
			$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );

			$resultat = false;
			
			if(empty($_FILES['logo_client']['tmp_name'])){
				$url = "../media/media_client/default.png";
				$resultat = true;
			}else{
				$res = verif_image($maxsize, $maxLH, $maxLH, $name, $extensions_valides);
				
				if ($res[0]){ //on déplace le fichier si l'image est correcte
					$nom_logo = str_replace('.','',uniqid(rand(), true));
					$url = "../media/media_client/".$nom_logo.".".$res[2];
					$resultat = move_uploaded_file($_FILES['logo_client']['tmp_name'],$url);
				}else echo $res[1];
			}
			
			if ($resultat){
				//on ajoute dans la BdD
				$nom_client = bdd($_POST['nom_client']);
				$statut_client = bdd($_POST['statut_client']);
				$contenu_client = bdd($_POST['contenu_client']);
				$description_logo_client = bdd($_POST['description_logo_client']);
				
				$sql = "INSERT INTO client VALUES ('','".$nom_client."','".$statut_client."','".$contenu_client."','".$url."','".$description_logo_client."' ,NOW(),1)";
				connect();
				mysql_query("SET NAMES UTF8"); 
				mysql_query($sql) or die('Erreur d\'ajout du client! '.mysql_error());
				deconnect();
					
				maj_website("client", "ajout");
				echo '<h1>Succes</h1>Votre client à bien été publié sur le site!';
			}
			
		}else if($action == 'edit'){
		
		$erreur = -1;
		$old_url = $_POST['url_logo_client'];
			if($_FILES['upload_logo_client']['size'] > 0){ // si une image est envoyé
				// vérification de l'image envoyé
				$maxsize=30720;
				$maxLH = 150;
				$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
				$extension_upload = strtolower(  substr(  strrchr($_FILES['upload_logo_client']['name'], '.')  ,1)  );
				$image_sizes = getimagesize($_FILES['upload_logo_client']['tmp_name']);
				
				if ($_FILES['upload_logo_client']['error'] > 0) echo "Erreur lors du transfert";
				else if ( !in_array($extension_upload,$extensions_valides) ) echo "Extension incorrecte";
				else if ($_FILES['upload_logo_client']['size'] > $maxsize) echo "Le poid de l'image est trop gros";
				else if($image_sizes[0] > $maxLH) echo "Image trop grande";
				else{ //tout est OK
					$erreur = 0;
					// on déplace le fichier
					$nom_logo = str_replace('.','',uniqid(rand(), true));
					$url = "../media/media_client/".$nom_logo.".".$extension_upload;
					$resultat = move_uploaded_file($_FILES['upload_logo_client']['tmp_name'],$url);
					
				//on supprime l'ancienne image
				$old_url = str_replace('../media/media_client/','',$old_url);
				unlink('../media/media_client/'.$old_url);
				}
			}else{
				$url = $old_url; //sinon on garde l'ancien url de l'image
				$erreur=0;
			}
			
			if ($erreur == 0){
				//on update dans la BdD
				$id = bdd($_POST['id_client']);
				$nom_client = bdd($_POST['nom_client']);
				$statut_client = bdd($_POST['statut_client']);
				$contenu_client = bdd($_POST['contenu_client']);
				$description_logo_client = bdd($_POST['description_logo_client']);
							
				$sql = "UPDATE client SET nom_client='".$nom_client."', statut_client='".$statut_client."', contenu_client='".$contenu_client."', description_logo_client='".$description_logo_client."', url_logo_client='".$url."', maj_client=NOW() WHERE id_client='".$id."'";
				connect();
				mysql_query("SET NAMES UTF8"); 
				mysql_query($sql) or die('Erreur de la modification du client! '.mysql_error());
				deconnect();
						
				maj_website("client", "modification");
				echo '<h1>Succes</h1>Votre modification a bien été prise en compte!';
			}
			
		}else if($action == 'delete'){
			$ids = $_POST['choix_suppr'];
			
			for ($i=0;$i<sizeof($ids);$i++){
				$ids[$i] = bdd($ids[$i]);
				$sql = "SELECT url_logo_client
						FROM client
						WHERE id_client='".$ids[$i]."'";
				connect();
				$req = mysql_query($sql) or die('Erreur selection clients! '.mysql_error());
				deconnect();
				$row = mysql_fetch_assoc($req);
				$url = $row['url_logo_client'];
				
				if($url != '../media/media_client/default.png'){
					unlink($url);
				}
				
				
				$sql = "DELETE
						FROM client
						WHERE id_client='".$ids[$i]."'";
						
				connect();
				mysql_query($sql) or die('Erreur de suppression des news! '.mysql_error());
				deconnect();
			}
				maj_website("client", "suppression");
				echo '<h1>Succes</h1>Les clients ont bien été supprimés du site!';
		}
		
	}
}
	?>