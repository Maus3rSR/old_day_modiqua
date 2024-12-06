<?php 
$nombre = 10;  // on va afficher 10 résultats par page.
if (!isset($_POST['limite']) OR empty($_POST['limite'])){
	$limite = 0; // si on arrive sur la page pour la première fois on met limite à 0.
}else{
	$limite = bdd($_POST['limite']);
}
$total = Nb_enregistrement('id_temoignage','temoignage'); //nombre total d'enregistrement dans la table

$sql = "SELECT *
		FROM temoignage
		WHERE id_website='3'";

if (isset($_GET['id_temoignage']) && !empty($_GET['id_temoignage'])){
	$id_temoignage = bdd($_GET['id_temoignage']);

	//on rajoute dans la clause WHERE id_news = ??? //
	$sql = $sql." AND id_temoignage=".$id_temoignage;
}

connect();
$sql = $sql." ORDER BY id_temoignage DESC LIMIT 0,10";
$req = mysql_query($sql) or die('Erreur SQL récupération des témoignages!<br>'.$sql.'<br>'.mysql_error()); 
deconnect();

while ($row = mysql_fetch_assoc($req)){

	$titre_temoignage = html($row['titre_temoignage']);
	$contenu_temoignage = nl2br(html($row['contenu_temoignage']));
	$maj_temoignage = html($row['maj_temoignage']);
	$url = html($row['url_photo_temoignage']);
	$nom = html($row['nom_temoignage']);
	$alt = html($row['description_photo_temoignage']);	
	
	
	?>
	<div class="news">
		<h1><?php echo $titre_temoignage ?></h1>
		<img style="float: left; padding: 5px;" src="<?php echo $url ?>" alt="<?php echo $alt ?>"></img>
		<p style="color: #c70000"><?php echo $nom ?></p>
		<p><br/><?php echo $contenu_temoignage ?></p>
		<span class="edition">Letzte Ausgabe: <?php echo $maj_temoignage ?></span>
	</div>
	<?php
}

// affichage des boutons precedent / suivant
displayNextPreviousButtons($limite,$total,$nombre,'temoignage');

?>