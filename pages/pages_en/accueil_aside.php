<!-- page avec le contenu de l'accueil pour l'aside -->
<div id="media_sociaux">
	<a id="fb" href="http://www.facebook.com/pages/Modiqua/397099126992248" target="_blank"></a>
	<a id="tweet" href="https://twitter.com/Modiqua" target="_blank"></a>
</div>
<div id="postulation"><a href="./index.php?page=postulation"></a></div>

<ul class="menu_aside">
	<li><a rel="nofollow" href="http://modiqua.eu/index.php?page=acces_membre&amp;categ=login">Partner access</a></li>
	<li><a href="http://modiqua.eu/devis">Your quote online</a></li>
</ul>

<h1>NEWS</h1> <!-- LISTE NEWS SUR L'ASIDE -->
<div class="fieldset">
	<ul>
<?php 
	//connection à la BDD
	connect();

	//requête sql
	$sql = "SELECT *
			FROM news
			WHERE id_website='2'
			ORDER BY id_news DESC LIMIT 0,3";

	//éxécution de la requête
	$req = mysql_query($sql) or die('Erreur SQL récupération des news (aside)!<br>'.$sql.'<br>'.mysql_error()); 
	
	//deconnection de la BDD
	deconnect();

	//parcours de la liste
	while ($row = mysql_fetch_assoc($req)){
		$id_news = html($row['id_news']);
		$resume_news = html($row['resume_news']);
		
		//affichage
		?><li><?php echo $resume_news ?><br/><a href="http://modiqua.eu/news/news-<?php echo $id_news ?>">Read more</a></li> <?php
	}
?>
	</ul>
	<span class="lire_infos"><a href="http://modiqua.eu/news">See all news</a></span>
</div>

<br/>

<h1>MARKS</h1> <!-- LISTE DES TEMOIGNAGES SUR L'ASIDE -->
<div class="fieldset">
	<ul>
<?php 
	//connection à la BDD
	connect();
	
	//requête sql
	$sql = "SELECT *
			FROM temoignage
			WHERE id_website='2'
			ORDER BY id_temoignage DESC LIMIT 0,3";

	//éxécution de la requête
	$req = mysql_query($sql) or die('Erreur SQL récupération des temoignages (aside) !<br>'.$sql.'<br>'.mysql_error()); 
	
	
	//deconnection de la BDD
	deconnect();

	//parcours de la liste
	while ($row = mysql_fetch_assoc($req)){
		$id_temoignage = html($row['id_temoignage']);
		$resume_temoignage = html($row['resume_temoignage']);
		
		//affichage
		?><li><?php echo $resume_temoignage ?><br/><a href="./index.php?page=temoignage&amp;id_temoignage=<?php echo $id_temoignage ?>">Read more</a></li> <?php
	}
?>
	</ul>
	<span class="lire_infos"><a href="./index.php?page=temoignage">See all marks</a></span>
</div>