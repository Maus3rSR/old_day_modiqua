<?php
if(isset($_GET['page'])){ //pour éviter une intrusion en tapant /news.php dans la barre d'adresse qui contournerait le test de l'admin dans redirection.php
	if (!isset($_GET['choix']) && !isset($_GET['action'])){ ?>
		<h1>GESTION DES TEMOIGNAGES</h1>
		<p>Choisissez une action sur le menu de gauche.<br/>Vous pouvez ajouter, modifier ou supprimer un témoignage.</p>
		<br/>
	<?php }else if(!empty($_GET['choix'])){

		$choix = $_GET['choix'];
		
		// PARTIE SAISIE AJOUT EDITION SUPPRESSION //
		if($choix == 'add'){
			?>
			<h1>AJOUTER UN TEMOIGNAGE</h1>
			<form method="post" action="./administration.php?page=temoignage&action=add" enctype="multipart/form-data">
				<table border="0">
					<tr>
						<td>Langue: </td>
						<td><select name="langue"><option value="1">Français</option><option value="3">Allemand</option><option value="2">Anglais</option></select></td>
					</tr>
					<tr>
						<td>Titre temoignage: </td>
						<td><INPUT type="text" name="titre_temoignage" required="required"></INPUT></td>
					</tr>
					<tr>
						<td>Resume temoignage: <br/>(qui sera affiché sur le fil d'actualité)</td>
						<td><INPUT type="text" name="resume_temoignage" required="required"></INPUT></td>
					</tr>
					<tr>
						<td>Nom temoignage:</td>
						<td><INPUT type="text" name="nom_temoignage" required="required"></INPUT></td>
					</tr>
					<tr>
						<td>Contenu: </td>
						<td><TEXTAREA rows="10" cols="50" name="contenu_temoignage"></TEXTAREA></td>
					</tr>
					<tr>
						<td>Description du logo: </td>
						<td><INPUT type="text" name="description_photo_temoignage" required="required"></TEXTAREA></td>
					</tr>
					<tr>
						<td>Importer une image pour le logo:<br>(JPG, PNG ou GIF - Max 30Ko <br/>- Taille max 150x150) </td>
						<td><input type="file" name="photo_temoignage" /></td>
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
			?><h1>MODIFIER UN TEMOIGNAGE</h1><?php
		
			if(!isset($_GET['id'])){
			
				$nombre = 10;  // on va afficher 10 résultats par page.
				if (!isset($_POST['limite']) OR empty($_POST['limite'])){
					$limite = 0; // si on arrive sur la page pour la première fois on met limite à 0.
				}else{
					$limite = bdd($_POST['limite']);
				}
				$total = Nb_enregistrement('id_temoignage','temoignage'); //nombre total d'enregistrement dans la table
			
				//on affiche la liste des news
				$sql = "SELECT * FROM temoignage ORDER BY id_temoignage DESC LIMIT ".$limite.",".$nombre;
				connect();
				$req = mysql_query($sql) or die('Erreur de récupération des temoignages: '.mysql_error());
				deconnect();
				
				while($row = mysql_fetch_assoc($req)){
					$nom_temoignage = html($row['nom_temoignage']);
					$id = html($row['id_temoignage']);
					$url = html($row['url_photo_temoignage']);
					$alt = html($row['description_photo_temoignage']);
				
					?>
					<h2><?php echo $nom_temoignage ?></h2>
					<a href="./administration.php?page=temoignage&amp;choix=edit&amp;id=<?php echo $id ?>">Modifier</a>
					<?php
				}
				
				// affichage des boutons precedent / suivant
				displayNextPreviousButtonsAdmin($limite,$total,$nombre,'temoignage','edit');
				
			}else{
				//on affiche LA news à modifier
				$id = bdd($_GET['id']);
				
				$sql = "SELECT * FROM temoignage WHERE id_temoignage='".$id."'";
				connect();
				$req = mysql_query($sql) or die('Erreur de récupération des temoignages: '.mysql_error());
				deconnect();
				
				$row = mysql_fetch_assoc($req);
				$titre_temoignage = html($row['titre_temoignage']);
				$resume_temoignage = html($row['resume_temoignage']);
				$contenu_temoignage = html($row['contenu_temoignage']);
				$nom_temoignage = html($row['nom_temoignage']);
				$description_photo_temoignage = html($row['description_photo_temoignage']);
				$url = html($row['url_photo_temoignage']);
				

				?>
				<form method="post" action="./administration.php?page=temoignage&action=edit" enctype="multipart/form-data">
				<table border="0">
					<tr>
						<td>Titre temoignage: </td>
						<td><INPUT type="text" name="titre_temoignage"  required="required" value="<?php echo $titre_temoignage ?>"></INPUT></td>
					</tr>
					<tr>
						<td>Nom temoignage:</td>
						<td><INPUT type="text" name="nom_temoignage" required="required" value="<?php echo $nom_temoignage ?>"></INPUT></td>
					</tr>
					<tr>
						<td>Resume temoignage: <br/> (qui sera affiché sur le fil d'actualité) </td>
						<td><INPUT type="text" name="resume_temoignage" required="required" value="<?php echo $resume_temoignage ?>"></INPUT></td>
					</tr>
					<tr>
						<td>Contenu: </td>
						<td><TEXTAREA rows="10" cols="50" name="contenu_temoignage" required="required"><?php echo $contenu_temoignage ?></TEXTAREA></td>
					</tr>
					<tr>
						<td>Description logo: </td>
						<td><INPUT name="description_photo_temoignage" type="text" required="required" value="<?php echo $description_photo_temoignage ?>"></INPUT></td>
					</tr>
					<tr>
						<td>Modifier le logo: <br>(JPG, PNG ou GIF - Max 30Ko <br/>- Taille max 150x150) </td>
						<td><INPUT name="upload_logo_temoignage" type="file"></INPUT></td>
					</tr>
					<tr>
						<td><INPUT type="hidden" name="id_temoignage" value="<?php echo $id ?>"></INPUT></td>
						<td><INPUT class="style_submit" type="submit" value="Modifier"></INPUT></td>
						<td><INPUT type="hidden" name="url_photo_temoignage" value="<?php echo $url ?>"></INPUT></td>
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
				$total = Nb_enregistrement('id_temoignage','temoignage'); //nombre total d'enregistrement dans la table
				
				//on affiche la liste des news
				$sql = "SELECT id_temoignage, nom_temoignage FROM temoignage ORDER BY id_temoignage DESC LIMIT ".$limite.",".$nombre;
				connect();
				$req = mysql_query($sql) or die('Erreur de récupération des temoignages: '.mysql_error());
				deconnect();
				
				?>
				<h1>SUPPRIMER UN TEMOIGNAGE</h1>
				<form method="post" action="./administration.php?page=temoignage&action=delete">
				<table border="0">
				<?php
				
				while($row = mysql_fetch_assoc($req)){
					$nom_temoignage = html($row['nom_temoignage']);
					$id = html($row['id_temoignage']);
				
					?>
					<tr>
						<td><input type="checkbox" name="choix_suppr[]" value="<?php echo $id ?>"></input></td>
						<td><h2><?php echo $nom_temoignage ?></h2></td>
					</tr>
					<tr>
						<td></td>
						<td><a href="./administration.php?page=temoignage&amp;choix=delete&amp;id=<?php echo $id ?>" target="_blank">Voir le temoignage</a></td>
					</tr>
					<?php
				}
				
				
				?> 
				</table>
				<br/>
				<INPUT class="style_submit" type="submit" value="Supprimer" Onclick="return confirm('Êtes-vous sûr de vouloir supprimer ces enregistrements?');"></INPUT>
				</form>
				<?php
				
				// affichage des boutons precedent / suivant
				displayNextPreviousButtonsAdmin($limite,$total,$nombre,'temoignage','delete');
				
			}else{
				//on affiche le temoignage
				$id = bdd($_GET['id']);
				
				$sql = "SELECT * FROM temoignage WHERE id_temoignage='".$id."'";
				connect();
				$req = mysql_query($sql) or die('Erreur de récupération des temoignages: '.mysql_error());
				deconnect();
				
				$row = mysql_fetch_assoc($req);
				$titre_temoignage = html($row['titre_temoignage']);
				$contenu_temoignage = html($row['contenu_temoignage']);
				$nom_temoignage = html($row['nom_temoignage']);
				$url_photo_temoignage = html($row['url_photo_temoignage']);
				$description_photo_temoignage = html($row['description_photo_temoignage']);
				?>
				<div style="clear: left;">
				<h1> <?php echo $titre_temoignage ?></h1>
				<img src="<?php echo $url_photo_temoignage ?>" alt="<?php echo $description_photo_temoignage ?>" style="float: left; margin-right: 10px;"></img>
				<h2> <?php echo $nom_temoignage ?></h2>
				<p> <?php echo $contenu_temoignage ?></p>
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
			$name = 'photo_temoignage';
			$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );

			$resultat = false;
			
			if(empty($_FILES['photo_temoignage']['tmp_name'])){
				$url = "../media/media_temoignage/default.png";
				$resultat = true;
			}else{
				$res = verif_image($maxsize, $maxLH, $maxLH, $name, $extensions_valides);
				
				if ($res[0]){ //on déplace le fichier si l'image est correcte
					$nom_logo = str_replace('.','',uniqid(rand(), true));
					$url = "../media/media_temoignage/".$nom_logo.".".$res[2];
					$resultat = move_uploaded_file($_FILES['photo_temoignage']['tmp_name'],$url);
				}else echo $res[1]; //sinon on affiche le message d'erreur correspondant
			}
				
				if ($resultat){
					//on ajoute dans la BdD
					$titre_temoignage = bdd($_POST['titre_temoignage']);
					$resume_temoignage = bdd($_POST['resume_temoignage']);
					$nom_temoignage = bdd($_POST['nom_temoignage']);
					$contenu_temoignage = bdd($_POST['contenu_temoignage']);
					$description_photo_temoignage = bdd($_POST['description_photo_temoignage']);
					$l = $_POST['langue'];
					
					$sql = "INSERT INTO temoignage VALUES ('','".$titre_temoignage."','".$resume_temoignage."','".$contenu_temoignage."','".$url."','".$description_photo_temoignage."' ,NOW(), '".$nom_temoignage."','".$l."')";
					connect();
					mysql_query("SET NAMES UTF8"); 
					mysql_query($sql) or die('Erreur d\'ajout du temoignage! '.mysql_error());
					deconnect();
					
					maj_website("temoignage", "ajout");
					echo '<h1>Succes</h1>Votre témoignage à bien été publié sur le site!';
				}
			
			
		}else if($action == 'edit'){
		
		$erreur = -1;
		$old_url = $_POST['url_photo_temoignage'];
			if($_FILES['upload_logo_temoignage']['size'] > 0){ // si une image est envoyé
				// vérification de l'image envoyé
				$maxsize=30720;
				$maxLH = 150;
				$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
				$extension_upload = strtolower(  substr(  strrchr($_FILES['upload_logo_temoignage']['name'], '.')  ,1)  );
				$image_sizes = getimagesize($_FILES['upload_logo_temoignage']['tmp_name']);
				
				if ($_FILES['upload_logo_temoignage']['error'] > 0) echo "Erreur lors du transfert";
				else if ( !in_array($extension_upload,$extensions_valides) ) echo "Extension incorrecte";
				else if ($_FILES['upload_logo_temoignage']['size'] > $maxsize) echo "Le poid de l'image est trop gros";
				else if($image_sizes[0] > $maxLH) echo "Image trop grande";
				else{ //tout est OK
					$erreur = 0;
					// on déplace le fichier
					$nom_logo = str_replace('.','',uniqid(rand(), true));
					$url = "../media/media_temoignage/".$nom_logo.".".$extension_upload;
					$resultat = move_uploaded_file($_FILES['upload_logo_temoignage']['tmp_name'],$url);
					
				//on supprime l'ancienne image
				unlink($old_url);
				}
			}else{
				$url = $old_url; //sinon on garde l'ancien url de l'image
				$erreur=0;
			}
			
			if ($erreur == 0){
				//on update dans la BdD
				$id = bdd($_POST['id_temoignage']);
				$titre_temoignage = bdd($_POST['titre_temoignage']);
				$nom_temoignage = bdd($_POST['nom_temoignage']);
				$resume_temoignage = bdd($_POST['resume_temoignage']);
				$contenu_temoignage = bdd($_POST['contenu_temoignage']);
				$description_photo_temoignage = bdd($_POST['description_photo_temoignage']);
							
				$sql = "UPDATE temoignage SET titre_temoignage='".$titre_temoignage."', nom_temoignage='".$nom_temoignage."', resume_temoignage='".$resume_temoignage."' ,contenu_temoignage='".$contenu_temoignage."', description_photo_temoignage='".$description_photo_temoignage."', url_photo_temoignage='".$url."', maj_temoignage=NOW() WHERE id_temoignage='".$id."'";
				connect();
				mysql_query("SET NAMES UTF8"); 
				mysql_query($sql) or die('Erreur de la modification du temoignage! '.mysql_error());
				deconnect();
							
				maj_website("temoignage", "modification");			
				echo '<h1>Succes</h1>Votre modification a bien été prise en compte!';
			}
			
		}else if($action == 'delete'){
			$ids = $_POST['choix_suppr'];
			
			for ($i=0;$i<sizeof($ids);$i++){
				$ids[$i] = bdd($ids[$i]);
				$sql = "SELECT url_photo_temoignage
						FROM temoignage
						WHERE id_temoignage='".$ids[$i]."'";
				connect();
				$req = mysql_query($sql) or die('Erreur selection temoignage! '.mysql_error());
				deconnect();
				$row = mysql_fetch_assoc($req);
				$url = $row['url_photo_temoignage'];
				
				if($url != '../media/media_temoignage/default.png'){
					unlink($url);
				}
				
				$sql = "DELETE
						FROM temoignage
						WHERE id_temoignage='".$ids[$i]."'";
						
				connect();
				mysql_query($sql) or die('Erreur de suppression des temoignages! '.mysql_error());
				deconnect();
			}
				
				maj_website("temoignage", "suppression");
				echo '<h1>Succes</h1>Les temoignages ont bien été supprimés du site!';
		}
		
	}
}
	?>