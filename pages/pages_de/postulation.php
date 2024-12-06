<?php 
if(!isset($_POST['submit_postulation'])){ 

	if(!isset($_GET['poste'])){
	
		if(isset($_GET['fonction'])){
			$f = html($_GET['fonction']);
		}else{
			$f = 'Candidature spontanée';
		}
?>
<h1><?php if($f == 'Candidature spontanée') echo 'Candidature spontanee'; else echo 'Poste a pourvoir'; ?></h1>

<div class="form">
	<form action="http://modiqua.eu/index.php?page=postulation" method="POST" enctype="multipart/form-data">
	<fieldset>
	<table>

		<tr>
			<td>* Nom: </td>
			<td><input required="required" name="nom" /></td>
		</tr>
		
		<tr>
			<td>* Email: </td>
			<td><input type="email" required="required" name="email" /></td>
		</tr>
		
		<tr>
			<td>* Téléphone: </td>
			<td><input maxlength="14" required="required" name="phone" /></td>
		</tr>
		
		<tr>
			<td>* Fonction: </td>
			<td>
				<?php if($f == 'Candidature spontanée') echo '<input name="fonction" type="text" />'; 
				else echo '<input name="fonction" readonly="true" type="text" value="'.$f.'" />';?>
			</td>
		</tr>
		
		<tr>
			<td>* Raison: </td>
			<td><textarea required="required" cols="25" rows="8" name="message"></textarea></td>
		</tr>

		<tr>
			<td>* Joindre CV : </td>
			<td><input required="required" type="file" name="cv" /></td>
		</tr>
		
		<tr>
			<td>(* Obligatoire)</td>
			<td><input type="submit" class="style_submit" name="submit_postulation" value="Envoyer" /></td>
		</tr>

	</table>
	</fieldset>
	<?php 
		if(isset($_GET['error']) && !empty($_GET['error'])){
			?> <span style="color: red;"><em><b>Une des informations n'a pas été correctement remplit!</b></em></span>	<?php
		} ?>
	</form>
</div>

<?php 
	}else{
		$poste = $_GET['poste'];
		
		if($poste == 'techBE'){
			//TEXTE DE PRESENTATION TECHNICIEN BUREAU D'ETUDE
			?>
			<p>TEXTE PRESENTATION TECHNICIEN BUREAU D'ETUDE</p>
			<a rel="nofollow" href="http://modiqua.eu/index.php?page=postulation&amp;fonction=technicien bureau etude">POSTULER</a>
			<?php
			
			
		}else if($poste == 'techAT'){
			//TEXTE DE PRESENTATION TECHNICIEN ATELIER
			?>
			<p>TEXTE PRESENTATION TECHNICIEN ATELIER</p>
			<a rel="nofollow" href="./index.php?page=postulation&amp;fonction=technicien atelier">POSTULER</a>
			
			
			<?php
		}else if($poste == 'auto'){
			//TEXTE DE PRESENTATION AUTOMATICIEN
			?>
			<p>TEXTE PRESENTATION AUTOMATICIEN</p>
			<a rel="nofollow" href="./index.php?page=postulation&amp;fonction=automaticien">POSTULER</a>
			<?php		
		}
		
	}
}else{

	$nom = html($_POST['nom']);
	$email = html($_POST['email']);
	$tel = html($_POST['phone']);
	$fonction = html($_POST['fonction']);
	$message = html($_POST['message']);
	$cv = '';
	
	if(!empty($_FILES['cv']['tmp_name'])){
		$cv = 'cv';
	}
	
	$msg_send = "Provenant du SITE MODIQUA <br/><br/> Message envoyé par: ".$nom." <br/> Numéro de téléphone: ".$tel."<br/><br/> Via formulaire de recrutement, fonction demandée: ".$fonction." <br/><br/> Message: <br/>".$message;
	
	sendmail($email, 'Candidature pour la fonction '.$fonction, $msg_send, $cv);
}