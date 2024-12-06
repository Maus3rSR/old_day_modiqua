<?php 
if($categ = getCateg()){ 
	$sql = "SELECT * FROM media m, categorie c WHERE m.id_categorie=c.id_categorie AND fichier_php_categorie = '".$categ."'";
	connect();
	$req = mysql_query($sql) or die("Erreur lors de la récupération des medias: ".mysql_error());
	deconnect();
	
	?>
	
	<div id="slider_galerie">
		<?php
		while($row = mysql_fetch_assoc($req)){
			$nom = html($row['nom_media']);
			$desc = html($row['description_media']);
		
			echo '<img alt="'.$nom.'" src="/media/media_galerie/'.$nom.'" /><span>'.$desc.'</span>';
		}
		?>
	</div>

	<script type="text/javascript"> <!-- Script du slider de l'accueil -->
	$(document).ready(function() {
		$('#slider_galerie').coinslider({width: 670, height: 670, navigation: true, delay: 4000, hoverPause: true });
	});
	</script>
	
<?php
}else{
	?><p>Ici, nous présentons notre savoir-faire en images. Pour voir ces réalisations, choisissez une galerie à droite.</p><?php
} ?>