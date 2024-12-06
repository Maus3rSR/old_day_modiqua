<?php
if(isset($_GET['page'])){ //pour éviter une intrusion en tapant /news.php dans la barre d'adresse qui contournerait le test de l'admin dans redirection.php
	if (!isset($_GET['choix']) && !isset($_GET['action'])){ ?>
		<h1>GESTION DES NEWS</h1>
		<p>Choisissez une action sur le menu de gauche.<br/>Vous pouvez ajouter, modifier ou supprimer une news.</p>
		<br/>
	<?php }else if(!empty($_GET['choix'])){

		$choix = $_GET['choix'];
		
		// PARTIE SAISIE AJOUT EDITION SUPPRESSION //
		if($choix == 'add'){
			?>
			<h1>AJOUTER UNE NEWS</h1>
			<form method="post" action="./administration.php?page=news&action=add">
				<table border="0">
					<tr>
						<td>Langue: </td>
						<td><select name="langue"><option value="1">Français</option><option value="3">Allemand</option><option value="2">Anglais</option></select></td>
					</tr>
					<tr>
						<td>Titre de la news: </td>
						<td><INPUT type="text" name="titre_news" required="required"></INPUT></td>
					</tr>
					<tr>
						<td>Résumé de la news: </br>(qui sera affiché sur le fil d'actualité)</td>
						<td><INPUT type="text" name="resume_news" required="required"></INPUT></td>
					</tr>
					<tr>
						<td>Contenu: </td>
						<td><TEXTAREA rows="10" cols="50" name="contenu_news" required="required"></TEXTAREA></td>
					</tr>
					<tr>
						<td></td>
						<td><INPUT class="style_submit" type="submit" value="Publier"></INPUT></td>
					</tr>
				</table>
			</form>
			<?php
		}else if ($choix == 'edit'){
			?><h1>MODIFIER UNE NEWS</h1><?php
		
			if(!isset($_GET['id'])){
			
				$nombre = 10;  // on va afficher 10 résultats par page.
				if (!isset($_POST['limite']) OR empty($_POST['limite'])){
					$limite = 0; // si on arrive sur la page pour la première fois on met limite à 0.
				}else{
					$limite = bdd($_POST['limite']);
				}
				$total = Nb_enregistrement('id_news','news'); //nombre total d'enregistrement dans la table
			
				//on affiche la liste des news
				$sql = "SELECT id_news, titre_news FROM news ORDER BY id_news DESC LIMIT ".$limite.",".$nombre;
				connect();
				$req = mysql_query($sql) or die('Erreur de récupération des news: '.mysql_error());
				deconnect();
				
				while($row = mysql_fetch_assoc($req)){
					$titre_news = html($row['titre_news']);
					$id = html($row['id_news']);
				
					?>
					<h2><?php echo $titre_news ?></h2>
					<a href="./administration.php?page=news&amp;choix=edit&amp;id=<?php echo $id ?>">Modifier</a>
					<?php
				}
				
				// affichage des boutons precedent / suivant
				displayNextPreviousButtonsAdmin($limite,$total,$nombre,'news','edit');
				
			}else{
			//on affiche LA news à modifier
				$id = bdd($_GET['id']);
				
				$sql = "SELECT * FROM news WHERE id_news='".$id."'";
				connect();
				$req = mysql_query($sql) or die('Erreur de récupération de la news: '.mysql_error());
				deconnect();
				
				$row = mysql_fetch_assoc($req);
				$titre_news = html($row['titre_news']);
				$contenu_news = html($row['contenu_news']);
				$resume_news = html($row['resume_news']);

				?>
				<form method="post" action="./administration.php?page=news&action=edit">
				<table border="0">
					<tr>
						<td>Titre de la news: </td>
						<td><INPUT type="text" name="titre_news" value="<?php echo $titre_news ?>" required="required"></INPUT></td>
					</tr>
					<tr>
						<td>Résumé de la news: </br>(qui sera affiché sur le fil d'actualité)</td>
						<td><INPUT type="text" name="resume_news" value="<?php echo $resume_news ?>" required="required"></INPUT></td>
					</tr>
					<tr>
						<td>Contenu: </td>
						<td><TEXTAREA rows="10" cols="50" name="contenu_news" required="required"><?php echo $contenu_news ?></TEXTAREA></td>
					</tr>
					<tr>
						<td><INPUT type="hidden" name="id_news" value="<?php echo $id ?>"></INPUT></td>
						<td><INPUT class="style_submit" type="submit" value="Modifier"></INPUT></td>
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
				$total = Nb_enregistrement('id_news','news'); //nombre total d'enregistrement dans la table
			
				//on affiche la liste des news
				$sql = "SELECT id_news, titre_news FROM news ORDER BY id_news DESC LIMIT ".$limite.",".$nombre;
				connect();
				$req = mysql_query($sql) or die('Erreur de récupération des news: '.mysql_error());
				deconnect();
				
				?>
				<h1>SUPPRIMER UN MEMBRE</h1>
				<form method="post" action="./administration.php?page=news&action=delete">
				<table border="0">
				<?php
				
				while($row = mysql_fetch_assoc($req)){
					$titre_news = html($row['titre_news']);
					$id = html($row['id_news']);
				
					?>
					<tr>
						<td><input type="checkbox" name="choix_suppr[]" value="<?php echo $id ?>"></input></td>
						<td><h2><?php echo $titre_news ?></h2></td>
					</tr>
					<tr>
						<td></td>
						<td><a href="./administration.php?page=news&amp;choix=delete&amp;id=<?php echo $id ?>" target="_blank">Voir la news</a></td>
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
				displayNextPreviousButtonsAdmin($limite,$total,$nombre,'news','delete');
				
			}else{
				//on affiche la news
				$id = bdd($_GET['id']);
				
				$sql = "SELECT * FROM news WHERE id_news='".$id."'";
				connect();
				$req = mysql_query($sql) or die('Erreur de récupération de la news: '.mysql_error());
				deconnect();
				
				$row = mysql_fetch_assoc($req);
				$titre_news = html($row['titre_news']);
				$contenu_news = html($row['contenu_news']);
				$resume_news = html($row['resume_news']);
				?>
				<h1> <?php echo $titre_news ?></h1>
				<p> <?php echo $contenu_news ?></p>
				<?php
			}
		}
	}

	// PARTIE SQL AJOUT EDITION SUPPRESSION //
	if (isset($_GET['action']) && !empty($_GET['action'])){
		$action = $_GET['action'];
		
		if($action == 'add'){
			$titre_news = bdd($_POST['titre_news']);
			$resume_news = bdd($_POST['resume_news']);
			$contenu_news = str_replace('"','\"',$_POST['contenu_news']);
			$l = $_POST['langue'];
			
			$sql = "INSERT INTO news VALUES ('',\"".$titre_news."\",\"".$contenu_news."\",\"".$resume_news."\",NOW(),\"".$l."\")";
			connect();
			mysql_query("SET NAMES UTF8"); 
			mysql_query($sql) or die('Erreur d\'ajout de la news! '.mysql_error());
			deconnect();
			
			maj_website("news", "ajout");
			echo '<h1>Succes</h1>Votre news à bien été publié sur le site!';
			
		}else if($action == 'edit'){
			$id = bdd($_POST['id_news']);
			$titre_news = bdd($_POST['titre_news']);
			$resume_news = bdd($_POST['resume_news']);
			$contenu_news = str_replace('"','\"',$_POST['contenu_news']);
			
			$sql = "UPDATE news SET titre_news=\"".$titre_news."\", resume_news=\"".$resume_news."\", contenu_news=\"".$contenu_news."\", maj_news=NOW() WHERE id_news=\"".$id."\"";
			connect();
			mysql_query("SET NAMES UTF8"); 
			mysql_query($sql) or die('Erreur de la modification de la news! '.mysql_error());
			deconnect();
			
			maj_website("news", "modification");
			echo '<h1>Succes</h1>Votre modification a bien été prise en compte!';
			
		}else if($action == 'delete'){
			$ids = $_POST['choix_suppr'];
			
			for ($i=0;$i<sizeof($ids);$i++){
				$ids[$i] = bdd($ids[$i]);
				$sql = "DELETE
						FROM news
						WHERE id_news='".$ids[$i]."'";
						
				connect();
				mysql_query($sql) or die('Erreur de suppression des news! '.mysql_error());
				deconnect();
			}
				
				maj_website("news", "suppression");
				echo '<h1>Succes</h1>Les news ont bien été supprimés du site!';
		}
		
	}
}
	?>