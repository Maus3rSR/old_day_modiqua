<?php if(!isset($_POST['submit_devis'])){ ?>

<h1>Demande de devis</h1>

<div class="form">
	<form action="./index.php?page=devis" method="POST" enctype="multipart/form-data">
	<fieldset>
	<table>

		<tr>
			<td>* Nom: </td>
			<td><input required="required" name="nom_devis" /></td>
		</tr>
		
		<tr>
			<td>* Email: </td>
			<td><input type="email" required="required" name="email_devis" /></td>
		</tr>
		
		<tr>
			<td>* Téléphone: </td>
			<td><input maxlength="14" required="required" name="phone_devis" /></td>
		</tr>
		
		<tr>
			<td>* Objet: </td>
			<td><input required="required" name="objet_devis" /></td>
		</tr>

		<tr>
			<td>Pièce jointe : </td>
			<td><input type="file" name="piece_jointe" /></td>
		</tr>
		
		<tr>
			<td>* Votre demande: </td>
			<td><textarea cols="25" rows="8" name="message_devis"></textarea></td>
		</tr>

		<tr>
			<td>(* Obligatoire)</td>
			<td><input type="submit" class="style_submit" name="submit_devis" value="Envoyer" /></td>
		</tr>

	</table>
	</fieldset>
	<?php if(isset($_GET['error']) && !empty($_GET['error'])){
						?> <span style="color: red;"><em><b>Une des informations n'a pas été correctement remplit!</b></em></span>	<?php
					} ?>
	</form>
</div>

<?php }else{

	$nom = html($_POST['nom_devis']);
	$email = html($_POST['email_devis']);
	$tel = html($_POST['phone_devis']);
	$sujet = html($_POST['objet_devis']);
	$message = html($_POST['message_devis']);
	$piece_jointe = '';
	
	if(!empty($_FILES['piece_jointe']['tmp_name'])){
		$piece_jointe = 'piece_jointe';
	}
	
	$msg_send = "Provenant du SITE MODIQUA <br/><br/> Message envoyé par: ".$nom." <br/> Numéro de téléphone: ".$tel."<br/><br/> Via formulaire demande de devis <br/><br/> Message: <br/>".$message;
	
	sendmail($email, $sujet, $msg_send, $piece_jointe);
}