<?php

$nombre = 10;  // on va afficher 10 résultats par page.
if (!isset($_POST['limite']) OR empty($_POST['limite'])){
	$limite = 0; // si on arrive sur la page pour la première fois on met limite à 0.
}else{
	$limite = bdd($_POST['limite']);
}
$total = Nb_enregistrement('id_partenariat','partenariat'); //nombre total d'enregistrement dans la table

connect();
$sql = "SELECT *
		FROM partenariat WHERE id_website='1' ORDER BY id_partenariat DESC LIMIT 0,10";
$req = mysql_query($sql) or die('Erreur SQL récupération des partenariats!<br>'.$sql.'<br>'.mysql_error()); 
deconnect();

while ($row = mysql_fetch_assoc($req)){

	$titre_partenariat = html($row['titre_partenariat']);
	$contenu_partenariat = nl2br(html($row['contenu_partenariat']));
	$maj_partenariat = html($row['maj_partenariat']);
	$url = html($row['url_logo_partenariat']);
	$nom = html($row['nom_partenariat']);
	$alt = html($row['description_logo_partenariat']);
	
	
	?>
	<div class="news">
		<h1><?php echo $titre_partenariat ?></h1>
		<img style="float: left; padding: 5px;" src="<?php echo $url ?>" alt="<?php echo $alt ?>" />
		<p style="color: #c70000"><?php echo $nom ?></p>
		<p><br/><?php echo $contenu_partenariat ?></p>
		<span class="edition">Dernière édition le: <?php echo $maj_partenariat ?></span>
	</div>
	<?php
}

// affichage des boutons precedent / suivant
displayNextPreviousButtons($limite,$total,$nombre,'partenaire');

?>