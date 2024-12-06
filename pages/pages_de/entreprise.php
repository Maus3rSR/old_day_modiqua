<?php 
if (isset($_GET['categ']) && !empty($_GET['categ'])){
	$categ = $_GET['categ'];
	
	if ($categ == 'societe'){ /* ***************SOUSMENU SOCIETE*********************** */
		?>
		<img src="/media/media_galerie/Modiqua1.jpg" alt="Batiment société modiqua" />
		
		<h1>La societe</h1>
		 
		<p>Créée en <b>1988</b>, la société MODIQUA s'est spécialisée dans trois activités complémentaires:</p>
		
		<ul>
			<li>Le <b>développement</b> et la réalisation de machines spéciales, de bancs de test, de gabarits de confection et appareillages de contrôle.</li>
			<li>L'<b>usinage</b> de précision.</li>
			<li>La <b>réalisation</b> d'outillage et la <b>réparation</b> de moules pour injection plastique.</li>
		</ul>
		 
		<p>Notre équipe, composée d'une vingtaine de personnes, a acquis au fil des années un savoir-faire reconnu et apporte à nos clients des solutions rapides et astucieuses répondant parfaitement à leurs exigences.
		Le but étant d'être un partenaire réactif et fiable, ceci pour garantir notre succès à long terme.</p>
		
		<h1>Nos secteurs d'activites</h1>
		<ul>
			<li>Industrie éléctrique</li>
			<li>Automobile</li>
			<li>Aéronautique</li>
			<li>Médical</li>
			<li>Industries diverses</li>
		</ul>
		<?php
	}else if($categ == 'batiments'){ /* *************SOUSMENU BATIMENTS******************* */
		?>
		
		<!-- SLIDER BUREAU ETUDE -->
		<div>
			<h1>Le bureau d'etude</h1>
			<div id='slider_BE'>
					<img alt="Bureau d'étude" src='/media/media_galerie/BE1.jpg' />
					<img alt="Bureau d'étude" src='/media/media_galerie/BE2.jpg' />
					<img alt="Bureau d'étude" src='/media/media_galerie/BE3.jpg' />
					<img alt="Bureau d'étude" src='/media/media_galerie/BE4.jpg' />
			</div>
			
			<p>Ici un petit paragraphe qui présentera le bureau d'étude, son fonctionnement, son utilité, à l'entreprise.</p>

			<script type="text/javascript"> <!-- Script du slider batiments -->
				$(document).ready(function() {
					$('#slider_BE').coinslider({ width: 400, height: 300, navigation: true, delay: 3000, hoverPause: true });
				});
			</script>
		</div>
		
		<!-- SLIDER ATELIER -->
		<div style="clear: both;">
			<h1>L'atelier</h1>
			<div id='slider_atelier'>
					<img alt="Atelier" src='/media/media_galerie/atelier1.jpg' />
					<img alt="Atelier" src='/media/media_galerie/atelier2.jpg' />
					<img alt="Atelier" src='/media/media_galerie/atelier3.jpg' />
					<img alt="Atelier" src='/media/media_galerie/atelier4.jpg' />
			</div>
			
			<p>Ici un petit paragraphe qui présentera l'atelier, son fonctionnement, son utilité, ses machines. Bref sa présentation générale quoi!</p>

			<script type="text/javascript"> <!-- Script du slider batiments -->
				$(document).ready(function() {
					$('#slider_atelier').coinslider({ width: 400, height: 300, navigation: true, delay: 3000, hoverPause: true });
				});
			</script>
		</div>
		
		
		<?php 
	}else if($categ='organigramme'){ /* ***********SOUS MENU ORGANIGRAMME *************** */
	?>

	<?php
	}else if($categ='nos_moyens'){ /* *************SOUS MENU NOS MOYENS ***************** */
	?>
	
	<?php
	}
	
	
	
}else{
	 print("<script type=\"text/javascript\">setTimeout('location=(\"http://modiqua.eu/entreprise/societe\")' ,0000);</script>");
 } ?>