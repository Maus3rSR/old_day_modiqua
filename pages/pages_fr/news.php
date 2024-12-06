<?php 

$nombre = 10;  // on va afficher 10 résultats par page.
if (!isset($_POST['limite']) OR empty($_POST['limite'])){
	$limite = 0; // si on arrive sur la page pour la première fois on met limite à 0.
}else{
	$limite = bdd($_POST['limite']);
}
$total = Nb_enregistrement('id_news','news'); //nombre total d'enregistrement dans la table


// on récupère les news
$sql = "SELECT *
		FROM news
		WHERE id_website='1'";

if (isset($_GET['id_news']) && !empty($_GET['id_news'])){
	$id_news = bdd($_GET['id_news']);

	//on concatene dans la clause WHERE id_news = ??? //
	$sql = $sql." AND id_news=".$id_news;
}

$sql = $sql." ORDER BY id_news DESC LIMIT ".$limite.",".$nombre;

connect();
$req = mysql_query($sql) or die('Erreur SQL récupération des news!<br>'.$sql.'<br>'.mysql_error()); 
deconnect();

// on traite les résultats
while ($row = mysql_fetch_assoc($req)){

	$titre_news = html($row['titre_news']);
	$contenu_news = utf8_encode(nl2br($row['contenu_news']));
	$maj_news = html($row['maj_news']);
	
	
	?>
	<div class="news">
		<h1><?php echo $titre_news ?></h1>
		<p><?php echo $contenu_news ?></p>
		<span style="font-size:12px; display: block; margin-bottom: 10px;">Dernière édition le: <?php echo $maj_news ?></span>
	</div>
	<?php
}

// affichage des boutons precedent / suivant
displayNextPreviousButtons($limite,$total,$nombre,'news');


?>