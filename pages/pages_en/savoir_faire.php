<?php 
if (isset($_GET['categ']) && !empty($_GET['categ'])){
	$categ = $_GET['categ'];
	
	if ($categ == 'machines_et_gabarits'){ /* ***************SOUSMENU MACHINES SPECIALES ET GABARITS*********************** */
		?>
		
		<p>En construction /!\</p>
		
		<?php
	}else if($categ == 'usinage_et_electroerosion'){ /* *************SOUSMENU USINAGE DE PRECISION / ELECTROEROSION******************* */
		?>
		
		<p>En construction /!\</p>
		
		<?php 
	}else if($categ='outillages_reparations'){ /* ***********SOUS MENU OUTILLAGES ET REPARATIONS DE MOULES POUR INJECTION PLASTIQUE *************** */
		?>
	
		<p>En construction /!\</p>
	
		<?php
	}
	
}else{
?>
<p>Nous présentons ici notre savoir faire reconnu depuis de nombreuses années chez nos clients et partenaires!</p>
<p>Pour le découvrir, choisissez une catégorie dans le menu de droite.</p>
<?php
}