<?php 
if (!isset($_POST['submit_contact'])){ ?>
	<h1>Nous contacter</h1>

	<p>Modiqua SAS <br/>
	55 rue Hohl - 57620 GOETZENBRUCK</p>

	<p><b>Standard téléphonique</b>: +33 (0)3 87 96 94 94  <br/>
	<b>Fax</b>: +33 (0)3 87 96 96 81 <br/>
	<b>Email</b>: contact@modiqua.eu
	</p>

	<p><b>Direction générale / Service commercial</b><br/>
	WALTER René
	</p>
	
	<p><b>Assistante de direction</b><br/>
	WALTER Nathalie - +33 (0)3 87 96 94 94 
	</p>
	
	<p><b>Responsable atelier</b><br/>
	FELDER Christian - +33 (0)3 87 96 82 61
	</p>
	
	<p><b>Bureau d'études</b>: <br/>
	BACH Denis - +33 (0)3 87 96 63 29<br/>
	CALCATERRA Steve - +33 (0)3 87 96 63 30<br/>
	JONAS Robert - +33 (0)3 87 96 63 33<br/>
	SCHNEPP Jimmy - +33 (0)3 87 96 63 34
	</p>

	<p><b>Achats/Qualité</b>: <br/>
	WEISKIRCHER-SCHAAFF Roselyne - +33 (0)3 87 96 63 35
	</p>
	
	<br/>
	
	<h1>OU VIA CE FORMULAIRE</h1>

	<form method="post" action="./index.php?page=contact">
		<TABLE id="form_contact">
			<tr>
				<td>* Votre nom:</td>
				<td><INPUT type="text" name="nom"  required="required" /></td>
			</tr>
			<tr>
				<td>* Votre email:</td>
				<td><INPUT type="email" name="email"  required="required" /></td>
			</tr>
			<tr>
				<td>* Votre numéro de téléphone:</td>
				<td><INPUT type="text" name="telephone"  required="required" /></td>
			</tr>
			<tr>
				<td>* Sujet:</td>
				<td><INPUT type="text" name="sujet"  required="required" /></td>
			</tr>
			<tr>
				<td>* Votre message:</td>
				<td><TEXTAREA cols="30" rows="5" name="message"  required="required"></textarea></td>
			</tr>
			<tr>
				<td>(* Obligatoire)</td>
				<td><INPUT type="submit" class="style_submit" name="submit_contact" value="Envoyer"/></td>
			</tr>
		</table>
	</form>

	<br/><br/>
	<h1>NOUS SITUER</h1>

	<p><iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.fr/maps?f=q&amp;source=s_q&amp;hl=fr&amp;geocode=&amp;q=Goetzenbruck+55+rue+Hohl&amp;aq=t&amp;sll=46.75984,1.738281&amp;sspn=10.011056,26.784668&amp;ie=UTF8&amp;hq=&amp;hnear=55+Rue+Hohl,+57620+Goetzenbruck,+Moselle,+Lorraine&amp;ll=48.985828,7.381667&amp;spn=0.018729,0.052314&amp;t=m&amp;z=14&amp;output=embed"></iframe><br /><small><a href="http://maps.google.fr/maps?f=q&amp;source=embed&amp;hl=fr&amp;geocode=&amp;q=Goetzenbruck+55+rue+Hohl&amp;aq=t&amp;sll=46.75984,1.738281&amp;sspn=10.011056,26.784668&amp;ie=UTF8&amp;hq=&amp;hnear=55+Rue+Hohl,+57620+Goetzenbruck,+Moselle,+Lorraine&amp;ll=48.985828,7.381667&amp;spn=0.018729,0.052314&amp;t=m&amp;z=14" target="_blank">Agrandir le plan</a></small></p>
	
<?php 
}else{

	$nom = html($_POST['nom']);
	$email = html($_POST['email']);
	$tel = html($_POST['telephone']);
	$sujet = html($_POST['sujet']);
	$message = html($_POST['message']);
	
	$msg_send = "Provenant du SITE MODIQUA <br/><br/> Message envoyé par: ".$nom." <br/> Numéro de téléphone: ".$tel."<br/><br/> Via formulaire de contact <br/><br/> Message: <br/>".$message;
	
	sendmail($email, $sujet, $msg_send, '');
}
?>