<?php 
if (isset($_GET['categ']) && !empty($_GET['categ'])){
	$categ = $_GET['categ'];
	
	if ($categ == 'machines_et_gabarits'){ /* ***************SOUSMENU MACHINES SPECIALES ET GABARITS*********************** */
		?>
		
		<p><strong>Nous accompagnons nos clients de la définition du cahier des charges jusqu'à la mise en service sur site des machines et équipements réalisés. 
		Nos responsables projets sont en liaison permanente avec nos clients garantissant ainsi des solutions parfaitement adaptées à leurs contraintes et leurs exigences.</strong></p>
		
		<p><strong>Nous avons notamment développé un savoir faire reconnu dans le développement et la réalisation:</strong></p>
		
		<p>-De <strong>machines spéciales automatisées</strong> de petites et de moyennes tailles</p>
		<p>-De <strong>gabarits de contrôle</strong> divers notamment pour l'industrie électrique(tirelire, contrôle dimensionnel, contrôle de force, contrôle de déformation, présence pièces...)</p>
		<p>-De <strong>gabarits de soudure</strong> divers (soudure par résistance et par laser) pour petites pièces nécessitant un positionnement très précis.</p> 
		<p>-De <strong>bancs de test</strong> divers </p>
		<p>-De <strong>l'intégration de systèmes</strong> divers (laser/technologies ultrason…)</p>
		<p>-De <strong>poste de découpe et de poinçonnage</strong></p>
		<p>-Et la <strong>re-conception</strong> de machines, d'équipements et de pièces diverses</p>
		
		<?php
	}else if($categ == 'usinage_et_electroerosion'){ /* *************SOUSMENU USINAGE DE PRECISION / ELECTROEROSION******************* */
		?>
		
		<p> Nous usinons des pièces mécaniques précises et complexes (unitaires ou petites séries). Certaines pièces nécessitent l'intervention de notre bureau d'étude, soit pour réaliser les plans non existants (pièces de rechange de machines spéciales par exemple), soit pour apporter une amélioration fonctionnelle à la pièce. 
		<p><strong>Notre savoir-faire en terme d'usinage concerne notamment: </strong></p>
		
		<p>-<strong>L'usinage par électroérosion à fil.</strong> Ce procédé permet l'usinage de formes complexes débouchantes nécessitant une grande précision et dans des matériaux conducteurs d'une durété importante (>60Hrc)</p>
		<p>-<strong>L'usinage par électroérosion en enfonçage.</strong> Ce procédé permet l'usinage de formes complexes non débouchantes nécessitant une grande précision et dans des matériaux conducteurs d'une durété importante (>60Hrc)</p>
		<p>-<strong>Le fraisage traditionnel et par commande numérique 2 + 3 axes.</strong></p>
		<p>-<strong>Le tournage traditionnel</strong></p>
		
		<?php 
	}else if($categ='outillages_reparations'){ /* ***********SOUS MENU OUTILLAGES ET REPARATIONS DE MOULES POUR INJECTION PLASTIQUE *************** */
		?>
	
		<p>Nous réparons des moules pour injection plastique avec ou sans dessins de définition. Reconstruction de formes par rechargement soudure ou mise en place d'inserts. L'association du bureau d'étude et de nos moyens de production, notamment de l'électroérosion (fil et enfonçage), nous permet une réactivité impotante.</p>
	
		<?php
	}
	
}else{
?>
<p> En 25 ans MODIQUA a développé et acquis un savoir-faire reconnu dans ses 3 activités principales et complémentaires:

<li><p><strong>L'étude et la réalisation de machines spéciales automatisées et de gabarits divers</li></p></strong> 
<li><p><strong>L'usinage de précision et l'électroérosion</li></p></strong>
<li><p><strong>La réparation de moules pour injection plastique et d'outillages divers</li></p></strong>

</p>L’association et la complémentarité de ces 3 activités sont des avantages indéniables pour nos clients : les processus et les techniques utilisées sont entièrement maîtrisés, les coûts sont optimisés, les délais raccourcis et le nombre d’interlocuteurs est limité. Ceci fait de MODIQUA un partenaire de proximité incontournable et fiable pour assister vos services et vos entreprises dans leur développement à long terme !</p>

</p>Avantages pour nos clients : 	<li><p><strong>Une solution technique parfaitement adaptée 
									<li><p><strong>Un interlocuteur unique
									<li><p><strong>Une qualité, un coût et un délai maîtrisés</li></strong><p>
<p>De plus amples informations sont disponibles dans les rubriques dédiées à nos activitées dans le menu à droite.</p>
<?php
}