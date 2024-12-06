<?php
$nombre = 10;  // on va afficher 10 résultats par page.
if (!isset($_POST['limite']) OR empty($_POST['limite'])){
	$limite = 0; // si on arrive sur la page pour la première fois on met limite à 0.
}else{
	$limite = bdd($_POST['limite']);
}
$total = Nb_enregistrement('id_client','client'); //nombre total d'enregistrement dans la table


connect();
$sql = "SELECT *
		FROM client ORDER BY nom_client ASC LIMIT 0,10";
$req = mysql_query($sql) or die('Erreur SQL récupération des clients!<br>'.$sql.'<br>'.mysql_error()); 
deconnect();

while ($row = mysql_fetch_assoc($req)){

	$statut_client = html($row['statut_client']);
	$contenu_client = nl2br(html($row['contenu_client']));
	$maj_client = html($row['maj_client']);
	$url = html($row['url_logo_client']);
	$nom = strtoupper(html($row['nom_client']));
	$alt = html($row['description_logo_client']);
	
	
	?>
	<div class="news">
		<h1><?php echo $nom ?></h1>
		<img style="float: left; padding: 5px;" src="<?php echo $url; ?>" alt="<?php echo $alt; ?>" />
		<p style="color: #c70000"><?php echo $statut_client ?></p>
		<p><br/><?php echo $contenu_client ?></p>
		<span class="edition">Dernière édition le: <?php echo $maj_client ?></span>
	</div>
	<?php
}

// affichage des boutons precedent / suivant
displayNextPreviousButtons($limite,$total,$nombre,'client');

?>