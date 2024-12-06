<?php
if(isset($_GET['page'])){ //pour éviter une intrusion en tapant /news.php dans la barre d'adresse qui contournerait le test de l'admin dans redirection.php
	if (!isset($_GET['choix']) && !isset($_GET['action'])){ ?>
		<h1>GESTION DE L'HISTORIQUE</h1>
		<p>Choisissez une action sur le menu de gauche.<br/>Vous pouvez afficher l'historique, tout supprimer ou supprimer en indiquant les dates.</p>
		<br/>
	<?php }else if(!empty($_GET['choix'])){

		$choix = $_GET['choix'];
		
		// PARTIE VUE SUPPRESSION //
		if($choix == 'see'){
			?><h1>VISUALISATION DE L'HISTORIQUE</h1>
			
			<form action="./administration.php?page=historique&choix=see" method="post">
				<label for="date_picker">Trier par une date:</label> 
				<input readonly="readonly" type="text" name="date_picker" id="date_picker" Onclick="this.value='';"></input> 
				<input class="style_submit" type="submit" value="Rechercher"></input>
			</form><br/>
			
			<?php
			
			$nombre = 8;  // on va afficher 8 résultats par page.
			if (!isset($_POST['limite']) OR empty($_POST['limite'])){
				$limite = 0; // si on arrive sur la page pour la première fois on met limite à 0.
			}else{
				$limite = bdd($_POST['limite']);
			}
			$total = Nb_enregistrement('id_historique','historique'); //nombre total d'enregistrement dans la table
			
			$sql = "SELECT * FROM historique ";

			if(isset($_POST['date_picker']) && !empty($_POST['date_picker'])){
				$date = $_POST['date_picker'];
				$date = dateFRtoUS($date);
				$sql = $sql."WHERE DATE(date_historique)='".bdd($date)."' ";
			}
			
			$sql = $sql." ORDER BY id_historique DESC LIMIT ".$limite.",".$nombre;
			
			connect();
			$req = mysql_query($sql) or die('Erreur récupération de l\'historique: '.mysql_error());
			deconnect();
			
			while($row = mysql_fetch_assoc($req)){
				$nature = html($row['nature_historique']);
				$date = html($row['date_historique']);
				
				echo '<p><b>'.$nature.'</b></p>';
				echo '<p>enregistré le: '.$date.'</p><br/>';
			}
			
			// affichage des boutons precedent / suivant
			displayNextPreviousButtonsAdmin($limite,$total,$nombre,'historique','see');
			
		}else if ($choix == 'delete'){			
			?><h1>SUPPRESSION DE L'HISTORIQUE</h1>
			<form action="./administration.php?page=historique&choix=delete" method="post">
				<label for="date_picker">Trier par une date:</label> 
				<input readonly="readonly" type="text" name="date_picker" id="date_picker" Onclick="this.value='';"></input> 
				<input class="style_submit" type="submit" value="Rechercher"></input>
			</form><br/>
			
			<form action="./administration.php?page=historique" method="post">
				<input type="submit" class="style_submit" value="Tout supprimer" name="suppr_historique" Onclick="return confirm('Êtes-vous sûr de vouloir supprimer tout l\'historique?');"></input>
			</form>
			
			<br/>
			<form action="./administration.php?page=historique" method="post">
			<table border="0"> <?php
				$nombre = 8;  // on va afficher 8 résultats par page.
				if (!isset($_POST['limite']) OR empty($_POST['limite'])){
					$limite = 0; // si on arrive sur la page pour la première fois on met limite à 0.
				}else{
					$limite = bdd($_POST['limite']);
				}
				$total = Nb_enregistrement('id_historique','historique'); //nombre total d'enregistrement dans la table
				
				$sql = "SELECT * FROM historique ";

				if(isset($_POST['date_picker']) && !empty($_POST['date_picker'])){
					$date = $_POST['date_picker'];
					$date = dateFRtoUS($date);
					$sql = $sql."WHERE DATE(date_historique)='".bdd($date)."' ";
				}
				
				$sql = $sql." ORDER BY id_historique DESC LIMIT ".$limite.",".$nombre;
				
				connect();
				$req = mysql_query($sql) or die('Erreur récupération de l\'historique: '.mysql_error());
				deconnect();
				
				while($row = mysql_fetch_assoc($req)){
					$nature = html($row['nature_historique']);
					$date = html($row['date_historique']);
					$id = html($row['id_historique']);
					?>
					<tr>
						<td><input type="checkbox" name="choix_suppr[]" value="<?php echo $id ?>"></input></td>
						<td><b><?php echo $nature; ?></b> <br/> enregistré le: <?php echo $date; ?></td>
					</tr>
					<?php
				}
				 ?>
				<tr>
					<td></td>
					<td><input type="submit" class="style_submit" value="Supprimer" Onclick="return confirm('Êtes-vous sûr de vouloir supprimer ces enregistrements?');"></input></td>
				</tr>
			</table>
			</form>
			<br/>
			<?php
			// affichage des boutons precedent / suivant
			displayNextPreviousButtonsAdmin($limite,$total,$nombre,'historique','delete');
		}
	}

	
	
	// PARTIE SQL SUPPRESSION//
	if (isset($_POST['suppr_historique'])){
		$sql = "DELETE FROM historique";
		
		connect();
		mysql_query($sql) or die('Erreur de suppression de l\'historique: '.mysql_error());
		deconnect();
		
		maj_website("historique (IP: ".$_SERVER["REMOTE_ADDR"].")", "suppression totale");
		echo '<h1>Succes</h1>L\'historique a bien été vidé complètement!';
	}
	
	if(isset($_POST['choix_suppr']) && !empty($_POST['choix_suppr'])){
		$ids = $_POST['choix_suppr'];
			
		for ($i=0;$i<sizeof($ids);$i++){
			$ids[$i] = bdd($ids[$i]);
			$sql = "DELETE
					FROM historique
					WHERE id_historique='".$ids[$i]."'";
						
			connect();
			mysql_query($sql) or die('Erreur de suppression des historiques! '.mysql_error());
			deconnect();
		}
				
		maj_website("historique (IP: ".$_SERVER["REMOTE_ADDR"].")", "suppression");
		echo '<h1>Succes</h1>Les historique ont bien été supprimés!';
	}
}