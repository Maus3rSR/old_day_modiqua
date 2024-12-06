<?php
if(isset($_GET['page'])){ //pour éviter une intrusion en tapant /news.php dans la barre d'adresse qui contournerait le test de l'admin dans redirection.php
	if (!isset($_GET['choix']) && !isset($_GET['action'])){ ?>
		<h1>GESTION DES MEMBRES</h1>
		<p>Choisissez une action sur le menu de gauche.<br/>Vous pouvez ajouter, modifier ou supprimer un membre.</p>
		<br/>
	<?php }else if(!empty($_GET['choix'])){

		$choix = $_GET['choix'];
		
		// PARTIE SAISIE AJOUT EDITION SUPPRESSION //
		if($choix == 'add'){
			?>
			<h1>AJOUTER UN MEMBRE</h1>
			<form method="post" action="./administration.php?page=membre&action=add">
				<table border="0">
					<tr>
						<td>Nom membre: </td>
						<td><INPUT type="text" name="nom_membre" required="required"></INPUT></td>
					</tr>
					<tr>
						<td>Email membre: </td>
						<td><INPUT type="text" name="email_membre" required="required"></INPUT></td>
					</tr>
					<tr>
						<td>Login:</td>
						<td><INPUT type="text" name="login_membre" maxlength="8" required="required"></INPUT></td>
						<td>(8 caractères max.)</td>
					</tr>
					<tr>
						<td>Mot de passe: </td>
						<td><INPUT type="text" name="mdp_membre" readonly="readonly" value="" required="required"></INPUT></td>
						<td><INPUT type="button" value="Générer" Onclick="Genpass('mdp_membre');"></INPUT></td>
					</tr>
					<tr>
						<td></td>
						<td><INPUT class="style_submit" type="submit" value="Ajouter"></INPUT></td>
					</tr>
				</table>
			</form>
			<?php
		}else if ($choix == 'edit'){
			?><h1>MODIFIER UN MEMBRE</h1><?php
			
			if(!isset($_GET['id'])){
				search_tool('membre','edit');
			
				$nombre = 10;  // on va afficher 10 résultats par page.
				if (!isset($_POST['limite']) OR empty($_POST['limite'])){
					$limite = 0; // si on arrive sur la page pour la première fois on met limite à 0.
				}else{
					$limite = bdd($_POST['limite']);
				}
				$total = Nb_enregistrement('id_membre','membre'); //nombre total d'enregistrement dans la table
				
				?><div class="gestion_content"><?php
				//on affiche la liste des membres
				$sql = "SELECT * FROM membre ORDER BY id_membre DESC LIMIT ".$limite.",".$nombre;
				connect();
				$req = mysql_query($sql) or die('Erreur de récupération des membres: '.mysql_error());
				deconnect();
				
				while($row = mysql_fetch_assoc($req)){
					$nom_membre = html($row['nom_membre']);
					$id = html($row['id_membre']);
				
					?>
					<h2><?php echo $nom_membre ?></h2>
					<a href="./administration.php?page=membre&amp;choix=edit&amp;id=<?php echo $id ?>">Modifier</a>
					<?php
				}
				echo '</div>';
				
				// affichage des boutons precedent / suivant
				displayNextPreviousButtonsAdmin($limite,$total,$nombre,'membre','edit');
				
			}else{
				//on affiche LA news à modifier
				$id = bdd($_GET['id']);
				
				$sql = "SELECT * FROM membre WHERE id_membre='".$id."'";
				connect();
				$req = mysql_query($sql) or die('Erreur de récupération du membre: '.mysql_error());
				deconnect();
				
				$row = mysql_fetch_assoc($req);
				$nom_membre = html($row['nom_membre']);
				$email_membre = html($row['email_membre']);
				$login_membre = html($row['login_membre']);
				$pass_membre = html($row['pass_membre']);

				?>
				<form method="post" action="./administration.php?page=membre&action=edit">
				<table border="0">
					<tr>
						<td>Nom du membre: </td>
						<td><INPUT type="text" name="nom_membre" required="required" value="<?php echo $nom_membre ?>"></INPUT></td>
					</tr>
					<tr>
						<td>Email membre:</td>
						<td><INPUT type="text" name="email_membre" required="required" value="<?php echo $email_membre ?>"></INPUT></td>
					</tr>
					<tr>
						<td>Login membre:</td>
						<td><INPUT type="text" name="login_membre" maxlength="8" required="required" value="<?php echo $login_membre ?>"></INPUT></td>
						<td>(8 caractères max.)</td>
					</tr>
					<tr>
						<td>Mot de passe membre:</td>
						<td><INPUT type="text" name="pass_membre" required="required" readonly="readonly" value="<?php echo $pass_membre ?>"></INPUT></td>
						<td><INPUT type="button" value="Générer" Onclick="Genpass('pass_membre');"></INPUT></td>
					</tr>
					<tr>
						<td><INPUT type="hidden" name="id_membre" value="<?php echo $id ?>"></INPUT></td>
						<td><INPUT class="style_submit" type="submit" value="Modifier"></INPUT></td>
					</tr>
				</table>
				</form>
				<?php
			}
			
		}else if($choix == 'delete'){	
			if(!isset($_GET['id'])){
				?><h1>SUPPRIMER UN MEMBRE</h1><?php	
				
				$nombre = 10;  // on va afficher 10 résultats par page.
				if (!isset($_POST['limite']) OR empty($_POST['limite'])){
					$limite = 0; // si on arrive sur la page pour la première fois on met limite à 0.
				}else{
					$limite = bdd($_POST['limite']);
				}
				$total = Nb_enregistrement('id_membre','membre'); //nombre total d'enregistrement dans la table
				
				
				//on affiche la liste des membres
				$sql = "SELECT * FROM membre ORDER BY id_membre DESC LIMIT ".$limite.",".$nombre;
				connect();
				$req = mysql_query($sql) or die('Erreur de récupération des membres: '.mysql_error());
				deconnect();
				
				?>
				<?php search_tool('membre','delete'); ?>
			
				<div class="gestion_content">
				<form method="post" action="./administration.php?page=membre&action=delete">
				<table border="0">
				<?php
				while($row = mysql_fetch_assoc($req)){
					$nom_membre = html($row['nom_membre']);
					$id = html($row['id_membre']);
				
					?>
					<tr>
						<td><input type="checkbox" name="choix_suppr[]" value="<?php echo $id ?>"></input></td>
						<td><h2><?php echo $nom_membre ?></h2></td>
					</tr>
					<tr>
						<td></td>
						<td><a href="./administration.php?page=membre&amp;choix=delete&amp;id=<?php echo $id ?>" target="_blank">Voir le membre</a></td>
					</tr>
					<?php
				}
				
				?> 
				</table>
				<br/>
				<INPUT class="style_submit" type="submit" value="Supprimer" Onclick="return confirm('Êtes-vous sûr de vouloir supprimer ces enregistrements?');"></INPUT>
				</form>
				</div>
				<?php
				
				// affichage des boutons precedent / suivant
				displayNextPreviousButtonsAdmin($limite,$total,$nombre,'membre','delete');
				
			}else{
				//on affiche le membre
				$id = bdd($_GET['id']);
				
				$sql = "SELECT * FROM membre WHERE id_membre='".$id."'";
				connect();
				$req = mysql_query($sql) or die('Erreur de récupération du membre: '.mysql_error());
				deconnect();
				
				$row = mysql_fetch_assoc($req);
				$nom_membre = html($row['nom_membre']);
				$email_membre = html($row['email_membre']);
				?>
				<h1> <?php echo $nom_membre ?></h1>
				<p> <?php echo $email_membre ?></p><?php
			}			
		}
	}

	
	
	// PARTIE SQL AJOUT EDITION SUPPRESSION //
	if (isset($_GET['action']) && !empty($_GET['action'])){
		$action = $_GET['action'];
		
		if($action == 'add'){
			$nom_membre = bdd($_POST['nom_membre']);
			$email_membre = bdd($_POST['email_membre']);
			$login_membre = bdd($_POST['login_membre']);
			$mdp_membre =  bdd($_POST['mdp_membre']);
		
			$sql = "INSERT INTO membre VALUES ('','".$nom_membre."','".$login_membre."','".$mdp_membre."','".$email_membre."',1)";
			connect();
			mysql_query("SET NAMES UTF8"); 
			mysql_query($sql) or die('Erreur d\'ajout du membre! '.mysql_error());
			deconnect();
			
			maj_website("membre", "ajout");
			echo '<h1>Succes</h1>Votre membre a bien été enregistré sur le site!';
			
		}else if($action == 'edit'){
			$id = bdd($_POST['id_membre']);
			$nom_membre = bdd($_POST['nom_membre']);
			$email_membre = bdd($_POST['email_membre']);
			$login_membre = bdd($_POST['login_membre']);
			$mdp_membre =  bdd($_POST['pass_membre']);
			
			$sql = "UPDATE membre SET nom_membre='".$nom_membre."', email_membre='".$email_membre."', login_membre='".$login_membre."', pass_membre='".$mdp_membre."' WHERE id_membre='".$id."'";
			connect();
			mysql_query($sql) or die('Erreur de modification du membre! '.mysql_error());
			deconnect();
			
			maj_website("membre", "modification");
			echo '<h1>Succes</h1>Votre modification a bien été prise en compte!';
			
		}else if($action == 'delete'){
			$ids = $_POST['choix_suppr'];
			
			for ($i=0;$i<sizeof($ids);$i++){
				$ids[$i] = bdd($ids[$i]);				
				
				$sql = "DELETE
						FROM membre
						WHERE id_membre='".$ids[$i]."'";
						
				connect();
				mysql_query($sql) or die('Erreur de suppression des membres! '.mysql_error());
				deconnect();
			}
				
			echo '<h1>Succes</h1>Les membres ont bien été supprimés du site!';
			
		}
		
	}
}