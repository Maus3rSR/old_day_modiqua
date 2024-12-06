<?php
if(isset($_GET['page'])){ //pour éviter une intrusion en tapant /news.php dans la barre d'adresse qui contournerait le test de l'admin dans redirection.php
	if (!isset($_GET['choix']) && !isset($_GET['action'])){ ?>
		<h1>GESTION DES PARTENARIATS</h1>
		<p>Choisissez une action sur le menu de gauche.<br/>Vous pouvez ajouter, modifier ou supprimer un partenariat.</p>
		<br/>
	<?php }else if(!empty($_GET['choix'])){

		$choix = $_GET['choix'];
		
		// PARTIE SAISIE AJOUT EDITION SUPPRESSION //
		if($choix == 'add'){
			?>
			<h1>AJOUTER UN PARTENARIAT</h1>
			<form method="post" action="./administration.php?page=partenaire&action=add" enctype="multipart/form-data">
				<table border="0">
					<tr>
						<td>Langue: </td>
						<td><select name="langue"><option value="1">Français</option><option value="3">Allemand</option><option value="2">Anglais</option></select></td>
					</tr>
					<tr>
						<td>Titre partenariat: </td>
						<td><INPUT type="text" name="titre_partenariat" required="required"></INPUT></td>
					</tr>
					<tr>
						<td>Nom partenariat:</td>
						<td><INPUT type="text" name="nom_partenariat" required="required"></INPUT></td>
					</tr>
					<tr>
						<td>Contenu: </td>
						<td><TEXTAREA rows="10" cols="50" name="contenu_partenariat"></TEXTAREA></td>
					</tr>
					<tr>
						<td>Description du logo: </td>
						<td><INPUT type="text" name="description_logo_partenariat" required="required"></TEXTAREA></td>
					</tr>
					<tr>
						<td>Importer une image pour le logo:<br>(JPG, PNG ou GIF - Max 30Ko <br/>- Taille max 150x150) </td>
						<td><input type="file" name="logo_partenariat" /></td>
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
			?><h1>MODIFIER UN PARTENARIAT</h1><?php
		
			if(!isset($_GET['id'])){
			
				$nombre = 10;  // on va afficher 10 résultats par page.
				if (!isset($_POST['limite']) OR empty($_POST['limite'])){
					$limite = 0; // si on arrive sur la page pour la première fois on met limite à 0.
				}else{
					$limite = bdd($_POST['limite']);
				}
				$total = Nb_enregistrement('id_partenariat','partenariat'); //nombre total d'enregistrement dans la table
			
				//on affiche la liste des news
				$sql = "SELECT * FROM partenariat ORDER BY id_partenariat DESC LIMIT ".$limite.",".$nombre;
				connect();
				$req = mysql_query($sql) or die('Erreur de récupération des partenariats: '.mysql_error());
				deconnect();
				
				while($row = mysql_fetch_assoc($req)){
					$titre_partenariat = html($row['nom_partenariat']);
					$id = html($row['id_partenariat']);
					$url = html($row['url_logo_partenariat']);
					$alt = html($row['description_logo_partenariat']);
				
					?>
					<h2><?php echo $titre_partenariat ?></h2>
					<a href="./administration.php?page=partenaire&amp;choix=edit&amp;id=<?php echo $id ?>">Modifier</a>
					<?php
				}
				
				// affichage des boutons precedent / suivant
				displayNextPreviousButtonsAdmin($limite,$total,$nombre,'partenariat','edit');
				
			}else{
				//on affiche LA news à modifier
				$id = bdd($_GET['id']);
				
				$sql = "SELECT * FROM partenariat WHERE id_partenariat='".$id."'";
				connect();
				$req = mysql_query($sql) or die('Erreur de récupération des partenariats: '.mysql_error());
				deconnect();
				
				$row = mysql_fetch_assoc($req);
				$titre_partenariat = html($row['titre_partenariat']);
				$contenu_partenariat = html($row['contenu_partenariat']);
				$nom_partenariat = html($row['nom_partenariat']);
				$description_logo_partenariat = html($row['description_logo_partenariat']);
				$url = html($row['url_logo_partenariat']);
				

				?>
				<form method="post" action="./administration.php?page=partenaire&action=edit" enctype="multipart/form-data">
				<table border="0">
					<tr>
						<td>Titre partenariat: </td>
						<td><INPUT type="text" name="titre_partenariat" value="<?php echo $titre_partenariat ?>"  required="required"></INPUT></td>
					</tr>
					<tr>
						<td>Nom partenariat:</td>
						<td><INPUT type="text" name="nom_partenariat" value="<?php echo $nom_partenariat ?>"  required="required"></INPUT></td>
					</tr>
					<tr>
						<td>Contenu: </td>
						<td><TEXTAREA rows="10" cols="50" name="contenu_partenariat"><?php echo $contenu_partenariat ?></TEXTAREA></td>
					</tr>
					<tr>
						<td>Description logo: </td>
						<td><INPUT name="description_logo_partenariat" type="text" required="required" value="<?php echo $description_logo_partenariat ?>"></INPUT></td>
					</tr>
					<tr>
						<td>Modifier le logo: <br>(JPG, PNG ou GIF - Max 30Ko <br/>- Taille max 150x150) </td>
						<td><INPUT name="upload_logo_partenariat" type="file"></INPUT></td>
					</tr>
					<tr>
						<td><INPUT type="hidden" name="id_partenariat" value="<?php echo $id ?>"></INPUT></td>
						<td><INPUT class="style_submit" type="submit" value="Modifier"></INPUT></td>
						<td><INPUT type="hidden" name="url_logo_partenariat" value="<?php echo $url ?>"></INPUT></td>
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
				$total = Nb_enregistrement('id_partenariat','partenariat'); //nombre total d'enregistrement dans la table
				
				//on affiche la liste des news
				$sql = "SELECT id_partenariat, nom_partenariat FROM partenariat ORDER BY id_partenariat DESC LIMIT ".$limite.",".$nombre;
				connect();
				$req = mysql_query($sql) or die('Erreur de récupération des partenaires: '.mysql_error());
				deconnect();
				
				?>
				<h1>SUPPRIMER UN PARTENARIAT</h1>
				<form method="post" action="./administration.php?page=partenaire&action=delete">
				<table border="0">
				<?php
				
				while($row = mysql_fetch_assoc($req)){
					$nom_partenariat = html($row['nom_partenariat']);
					$id = html($row['id_partenariat']);
				
					?>
					<tr>
						<td><input type="checkbox" name="choix_suppr[]" value="<?php echo $id ?>"></input></td>
						<td><h2><?php echo $nom_partenariat ?></h2></td>
					</tr>
					<tr>
						<td></td>
						<td><a href="./administration.php?page=partenaire&amp;choix=delete&amp;id=<?php echo $id ?>" target="_blank">Voir le partenariat</a></td>
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
				displayNextPreviousButtonsAdmin($limite,$total,$nombre,'partenariat','delete');
				
			}else{
				//on affiche le partenariat
				$id = bdd($_GET['id']);
				
				$sql = "SELECT * FROM partenariat WHERE id_partenariat='".$id."'";
				connect();
				$req = mysql_query($sql) or die('Erreur de récupération des partenariats: '.mysql_error());
				deconnect();
				
				$row = mysql_fetch_assoc($req);
				$titre_partenariat = html($row['titre_partenariat']);
				$contenu_partenariat = html($row['contenu_partenariat']);
				$nom_partenariat = html($row['nom_partenariat']);
				$url_logo_partenariat = html($row['url_logo_partenariat']);
				$description_logo_partenariat = html($row['description_logo_partenariat']);
				?>
				<div style="clear: left;">
				<h1> <?php echo $titre_partenariat ?></h1>
				<img src="<?php echo $url_logo_partenariat ?>" alt="<?php echo $description_logo_partenariat ?>" style="float: left; margin-right: 10px;"></img>
				<h2> <?php echo $nom_partenariat ?></h2>
				<p> <?php echo $contenu_partenariat ?></p>
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
			$name = 'logo_partenariat';
			$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );

			$resultat = false;
			
			if(empty($_FILES['logo_partenariat']['tmp_name'])){
				$url = "../media/media_partenariat/default.png";
				$resultat = true;
			}else{
				$res = verif_image($maxsize, $maxLH, $maxLH, $name, $extensions_valides);
				
				if ($res[0]){ //on déplace le fichier si l'image est correcte
					$nom_logo = str_replace('.','',uniqid(rand(), true));
					$url = "../media/media_partenariat/".$nom_logo.".".$res[2];
					$resultat = move_uploaded_file($_FILES['logo_partenariat']['tmp_name'],$url);
				}else echo $res[1];
			}
			
			if ($resultat){
				//on ajoute dans la BdD
				$nom_partenariat = bdd($_POST['nom_partenariat']);
				$titre_partenariat = bdd($_POST['titre_partenariat']);
				$contenu_partenariat = bdd($_POST['contenu_partenariat']);
				$description_logo_partenariat = bdd($_POST['description_logo_partenariat']);
				$l = $_POST['langue'];
				
				$sql = "INSERT INTO partenariat VALUES ('','".$titre_partenariat."','".$nom_partenariat."','".$contenu_partenariat."','".$url."','".$description_logo_partenariat."' ,NOW(),'".$l."')";
				connect();
				mysql_query("SET NAMES UTF8"); 
				mysql_query($sql) or die('Erreur d\'ajout du partenariat! '.mysql_error());
				deconnect();
					
				maj_website("partenariat", "ajout");
				echo '<h1>Succes</h1>Votre partenaire à bien été publié sur le site!';
			}
			
		}else if($action == 'edit'){
		
		$erreur = -1;
		$old_url = $_POST['url_logo_partenariat'];
			if($_FILES['upload_logo_partenariat']['size'] > 0){ // si une image est envoyé
				// vérification de l'image envoyé
				$maxsize=30720;
				$maxLH = 150;
				$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
				$extension_upload = strtolower(  substr(  strrchr($_FILES['upload_logo_partenariat']['name'], '.')  ,1)  );
				$image_sizes = getimagesize($_FILES['upload_logo_partenariat']['tmp_name']);
				
				if ($_FILES['upload_logo_partenariat']['error'] > 0) echo "Erreur lors du transfert";
				else if ( !in_array($extension_upload,$extensions_valides) ) echo "Extension incorrecte";
				else if ($_FILES['upload_logo_partenariat']['size'] > $maxsize) echo "Le poid de l'image est trop gros";
				else if($image_sizes[0] > $maxLH) echo "Image trop grande";
				else{ //tout est OK
					$erreur = 0;
					// on déplace le fichier
					$nom_logo = str_replace('.','',uniqid(rand(), true));
					$url = "../media/media_partenariat/".$nom_logo.".".$extension_upload;
					$resultat = move_uploaded_file($_FILES['upload_logo_partenariat']['tmp_name'],$url);
					
				//on supprime l'ancienne image
				unlink($old_url);
				}
			}else{
				$url = $old_url; //sinon on garde l'ancien url de l'image
				$erreur=0;
			}
			
			if ($erreur == 0){
				//on update dans la BdD
				$id = bdd($_POST['id_partenariat']);
				$titre_partenariat = bdd($_POST['titre_partenariat']);
				$nom_partenariat = bdd($_POST['nom_partenariat']);
				$contenu_partenariat = bdd($_POST['contenu_partenariat']);
				$description_logo_partenariat = bdd($_POST['description_logo_partenariat']);
							
				$sql = "UPDATE partenariat SET titre_partenariat='".$titre_partenariat."', nom_partenariat='".$nom_partenariat."', contenu_partenariat='".$contenu_partenariat."', description_logo_partenariat='".$description_logo_partenariat."', url_logo_partenariat='".$url."', maj_partenariat=NOW() WHERE id_partenariat='".$id."'";
				connect();
				mysql_query("SET NAMES UTF8"); 
				mysql_query($sql) or die('Erreur de la modification du partenariat! '.mysql_error());
				deconnect();
						
				maj_website("partenariat", "modification");
				echo '<h1>Succes</h1>Votre modification a bien été prise en compte!';
			}
			
		}else if($action == 'delete'){
			$ids = $_POST['choix_suppr'];
			
			for ($i=0;$i<sizeof($ids);$i++){
				$ids[$i] = bdd($ids[$i]);
				$sql = "SELECT url_logo_partenariat
						FROM partenariat
						WHERE id_partenariat='".$ids[$i]."'";
				connect();
				$req = mysql_query($sql) or die('Erreur selection partenariat! '.mysql_error());
				deconnect();
				$row = mysql_fetch_assoc($req);
				$url = $row['url_logo_partenariat'];
				
				if($url != '../media/media_partenariat/default.png'){
					unlink($url);
				}
				
				$sql = "DELETE
						FROM partenariat
						WHERE id_partenariat='".$ids[$i]."'";
						
				connect();
				mysql_query($sql) or die('Erreur de suppression des partenariats! '.mysql_error());
				deconnect();
			}
				
				maj_website("partenariat", "suppression");
				echo '<h1>Succes</h1>Les partenariats ont bien été supprimés du site!';
		}
		
	}
}
	?>