<?php 
if (isset($_GET['categ']) && !empty($_GET['categ'])){
	$categ = $_GET['categ'];
	
	if ($categ == 'societe'){ /* ***************SOUSMENU SOCIETE*********************** */
		?>
		<img src="/media/media_galerie/Modiqua1.jpg" alt="Batiment société modiqua" />
		
		<h1>La societe</h1>
		 
		<p>Créée en <b>1988</b>, la société MODIQUA s'est spécialisée dans trois activités complémentaires:</p>
		
		<ul>
			<li>Le <b>développement</b> et la <b>réalisation</b> de machines spéciales automatisées, de gabarits divers (contrôle, mesure, vissage, soudure...), d'équipements de découpe et de poinçonnage.</li>
			<li>L'<b>usinage de précision</b> de pièces unitaires complexes ou petites séries.</li>
			<li>La <b>réalisation</b> d'outillage et la <b>réparation</b> et <b>maintenance</b> de moules pour injection plastique.</li>
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
			
			<p>Notre bureau d’étude est composé d’une équipe multi-compétente et expérimentée de 5 techniciens, qui développe les machines à l’aide d’une CAO 3D sur la base de cahiers des charges fournis par nos clients. Leur disponibilité et leur proximité avec les clients permettent de répondre au mieux à leurs attentes </p>

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
			
			<p>Nous disposons d'un parc de machines en électroérosion fil et enfonçage et en tournage et fraisage traditionnel. Une fraiseuse CN ainsi qu'une nouvelle machine en électroérosion par enfoçage sont prévues dans les prochaines semaines</p>

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
		<!-- SLIDER MOYENS -->
		
		<h1>Nos moyens</h1>
		 	
		<ul>
			
		<h1>Bureau d'Etudes</h1>
		
		<ul>
		<li> Solidworks - AutoCad - Inventor
		<li> SolidCam
		
		
		<h1>Atelier</h1>
		
			<li> 6 Machines électro-érosion à fil jusqu'à 1050x820x305</li>
			<li> 2 Machines électro-érosion en enfonçage</li>
			<li> 1 Tour conventionnel</li>
			<li> 5 Fraiseuses conventionnelles
			<li> 1 Fraiseuses CN 5 axes
			<li> 1 Rectifieuse plane
			<li> 1 Rectifieuse cylindrique
			<li> 1 Machine pour perçage fin
			<li> 1 Four pour traitement
		</ul>
		
		
		<?php
	}
	
	
	
}else{
	 print("<script type=\"text/javascript\">setTimeout('location=(\"http://modiqua.eu/entreprise/societe\")' ,0000);</script>");
 } ?>