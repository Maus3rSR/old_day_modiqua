
<?php 
if(!is_connected() or is_admin()){
	if(isset($_GET['categ']) && !empty($_GET['categ']) && ($_GET['categ'] == 'login')){ ?>
				<div class="form">
				<form method="post" action="./include/authentification.php">

					<fieldset>
					<LEGEND align=top>Authentification</LEGEND> 
					
					<table border="0px">
					<tr>
						<td>Login* :</td>
						<td><INPUT type="text" name="login" required="required"></INPUT></td>
					</tr>
					<tr>
						<td>Mot de passe* :</td>
						<td><INPUT type="password" name="mdp" required="required"></INPUT></td>
					</tr>
					<tr>
						<td>(* Obligatoire)</td>
						<td><input class="style_submit" type="submit" value="Connecter"></input></td>
					</tr>
					</table>
					
					</fieldset>
					
					<?php if(isset($_GET['error']) && !empty($_GET['error'])){
							?> <span style="color: red;"><em><b>Login et/ou mot de passe incorrect</b></em></span>	<?php
						} ?>

				</form>
				</div> <?php
		}else if(isset($_GET['categ']) && !empty($_GET['categ']) && ($_GET['categ'] == 'demande')){ 
			if (!isset($_POST['submit_demande'])){ ?>
					<div class="form">
					<form method="post" action="./index.php?page=acces_membre&categ=demande">

						<fieldset>
						<LEGEND align=top>Demande d'adhesion</LEGEND> 
						
						<table border="0px">
						<tr>
							<td>Nom* :</td>
							<td><INPUT type="text" name="nom" required="required"></INPUT></td>
						</tr>
						<tr>
							<td>Email* :</td>
							<td><INPUT type="text" name="email" required="required"></INPUT></td>
						</tr>
						<tr>
							<td>Téléphone* :</td>
							<td><INPUT type="text" name="telephone" required="required"></INPUT></td>
						</tr>
						<tr>
							<td>Raison* : <br/>(Expliquez nous pourquoi vous voulez devenir notre partenaire)</td>
							<td><textarea name="message" rows='7' cols='25' required="required"></textarea></td>
						</tr>
						<tr>
							<td>(* Obligatoire)</td>
							<td><input class="style_submit" name="submit_demande" type="submit" value="Envoyer"></input></td>
						</tr>
						</table>
						
						</fieldset>
						
						<?php if(isset($_GET['error']) && !empty($_GET['error']) && ($_GET['error'] == 1)){
								?> <span style="color: red;"><em><b>Un des champs n'a pas été remplit correctement!</b></em></span>	<?php
							} ?>

					</form>
					</div> <?php
			}else{

				$nom = html($_POST['nom']);
				$email = html($_POST['email']);
				$tel = html($_POST['telephone']);
				$message = html($_POST['message']);
				
				$msg_send = "Provenant du SITE MODIQUA <br/><br/> Message envoyé par: ".$nom." <br/> Numéro de téléphone: ".$tel."<br/><br/> Via formulaire d'adhésion membre <br/><br/> Message: <br/>".$message;
				
				sendmail($email, 'Demande d\'adhésion au site Modiqua', $msg_send, '');

			}
		}else header("location: ./index.php?page=acces_membre&categ=login"); 

}else{
	print("<script type=\"text/javascript\">setTimeout('location=(\"../index.php?page=zone_partenaire\")' ,0000);</script>"); 
}		

?>