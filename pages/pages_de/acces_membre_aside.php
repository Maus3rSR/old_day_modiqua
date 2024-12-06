<?php 
	if(isset($_GET['categ']) && !empty($_GET['categ'])){
		$categ = html($_GET['categ']);
	}else{
		$categ = 'login';
	}
	?><ul class="menu_aside"><?php
	if($categ == 'login'){ ?>
		<li><a rel="nofollow" href="http://modiqua.eu/index.php?page=acces_membre&amp;categ=demande">Devenir un partenaire</a></li> <?php
	}else if($categ == 'demande'){ ?>
		<li><a rel="nofollow" href="http://modiqua.eu/index.php?page=acces_membre&amp;categ=login">Se connecter</a></li> <?php
	}
	?>
		<li><a href="http://modiqua.eu/partenaire" target="_blank">Nos partenaires</a></li>
	</ul>
