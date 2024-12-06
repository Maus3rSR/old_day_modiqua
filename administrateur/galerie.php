<?php
if(isset($_GET['page'])){ //pour éviter une intrusion en tapant /news.php dans la barre d'adresse qui contournerait le test de l'admin dans redirection.php
	if (!isset($_GET['choix'])){ 
		if(!isset($_GET['img'])){?>
		<h1>GESTION DES GALERIES D'IMAGES</h1>
		<p>Choisissez une action sur le menu de gauche.<br/>Vous pouvez ajouter ou supprimer une image liée à une galerie.</p>
		<br/>
	<?php 
		}else if(!empty($_GET['img'])){
			$id = bdd($_GET['img']);
			
			$sql = "SELECT * FROM media WHERE id_media='".$id."'";
			connect();
			$req = mysql_query($sql) or die('Erreur récupération de l\image: '.mysql_error());
			deconnect();
			
			$row = mysql_fetch_assoc($req);
			$nom = $row['nom_media'];
			
			echo '<p>'.$nom.'</p><br/> <img alt="'.$nom.'" src="../media/media_galerie/'.$nom.'" ></img>';
		}
	}else if(!empty($_GET['choix'])){

		$choix = $_GET['choix'];
		
		// PARTIE SAISIE AJOUT EDITION SUPPRESSION //
		if($choix == 'add'){
		
			//On récupère les catégories du menu realisations
			$sql = "SELECT * FROM categorie WHERE id_menu='5'";
			connect();
			$req = mysql_query($sql) or die('Erreur de récupération des catégories (admin, galerie) : '.mysql_error());
			deconnect();
		
			if(!isset($_POST['submit_galerie'])){
			?>
				<h1>AJOUTER UNE IMAGE A UNE GALERIE</h1>
				
				<form  action="./administration.php?page=galerie&choix=add" method="post" enctype="multipart/form-data">
					<table border="0">
						<tr>
							<td>Choix de la galerie: </td>
							<td>
								<select name="select_galerie">
									<?php
										while($row = mysql_fetch_assoc($req)){
											$id = $row['id_categorie'];
											$nom = $row['nom_categorie'];
											echo '<option value='.$id.'>'.$nom.'</option>';
										}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td>Image à ajouter: <br/>(Ne pas dépasser 670x670)</td>
							<td><input type="file" name="image_galerie" required="required" /></td>
						</tr>
						<tr>
							<td>Nom de l'image: </td>
							<td><input type="text" required="required" name="nom"></input></td>
						</tr>
						<tr>
							<td>Description média: </td>
							<td><textarea required="required" name="description"></textarea></td>
						</tr>
						<tr>
							<td></td>
							<td><input type="submit" class="style_submit" name="submit_galerie" value="Ajouter"></input></td>
						</tr>
					</table>
				</form>
			
			<?php
			}else{ //VERIF IMAGE + STOCKAGE SERVEUR + ENREGISTREMENT BDD
				
				//on vérifie que l'image est correcte
				$extensions_valides = array( 'jpg' , 'jpeg' , 'png' );
				
				$res = verif_image(600000, 670, 670, 'image_galerie', $extensions_valides);
				
				if($res[0]){ // contient true si l'image est correcte, false sinon
				
					//on déplace le fichier et on enregistre dans la base de donnée
					$nom = str_replace(' ','_',$_POST['nom']);
					$description = $_POST['description'];
					$id = $_POST['select_galerie'];
					$url = "../media/media_galerie/".$nom.".".$res[2]; // $res[2] contient l'extension de l'image envoyée
					
					if(move_uploaded_file($_FILES['image_galerie']['tmp_name'],$url)){
						
						$sql = "INSERT INTO media VALUES('', '".$description."', '".$nom.".".$res[2]."', '".$id."')";
						connect();
						mysql_query("SET NAMES UTF8");
						mysql_query($sql) or die('Erreur lors de l\'ajout dans la base de donnée (ajout galerie) : '.mysql_error());
						deconnect();
						
						echo '<p>Votre image a bien été ajoutée!</p>';
						maj_website("galerie: ".$nom." ", "ajout");
						
					}else{
						echo '<p>Erreur lors du transfert de l\'image sur le serveur</p>';
					}
					
				
				}else{
					echo $res[1]; //res[1] contient l'erreur relevé si l'image est pas correcte
				}
				
			}
		}else if($choix == 'delete'){
			
				if(!isset($_POST['submit_galerie'])){
					//On récupère les catégories du menu realisations
					$sql = "SELECT * FROM categorie WHERE id_menu='5'";
					connect();
					$req = mysql_query($sql) or die('Erreur de récupération des catégories (admin, galerie) : '.mysql_error());
					deconnect();
					
					?>
					<h1>SUPPRIMER DES IMAGES A UNE GALERIE</h1>
				
					<form  action="./administration.php?page=galerie&choix=delete" method="post" >
					<table border='0'>
						<tr>
							<td>Choix de la galerie: </td>
							<td>
								<select name="select_galerie">
									<option value='NULL'></option>
									<?php
										while($row = mysql_fetch_assoc($req)){
											$id = $row['id_categorie'];
											$nom = $row['nom_categorie'];
											echo '<option value='.$id.' Onclick="get_galerie(this.value);">'.$nom.'</option>';
										}
									?>
								</select>
							</td>
						</tr>
						<tr id="liste_img">
							<?php //On ajoute la liste des médias avec une fonction en AJAX ?>
						</tr>
						<tr>
							<td><input type="submit" class="style_submit" name="submit_galerie" value="Supprimer" Onclick="return confirm('Êtes-vous sûr de vouloir supprimer ces enregistrements?');"></input></td>
						</tr>
					</table>
					</form>
				<?php
			}else{
				//On supprime les images sélectionnées
				$ids = $_POST['choix_suppr'];
			
				for ($i=0;$i<sizeof($ids);$i++){
					$ids[$i] = bdd($ids[$i]);
					
					$sql = "SELECT * FROM media WHERE id_media='".$ids[$i]."'";
					connect();
					$req = mysql_query($sql) or die('Erreur recup suppr galerie: '.mysql_error());
					deconnect();
					
					$row = mysql_fetch_assoc($req);
					$nom = html($row['nom_media']);
					
					unlink('../media/media_galerie/'.$nom);
					
					$sql = "DELETE
							FROM media
							WHERE id_media='".$ids[$i]."'";
							
					connect();
					mysql_query($sql) or die('Erreur de suppression des medias! '.mysql_error());
					deconnect();
				}
					
					maj_website("galerie", "suppression");
					echo '<h1>Succes</h1>Les images de la galerie ont bien été supprimés du site!';
			}
		}
	}
}
	?>