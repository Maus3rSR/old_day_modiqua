<div id="login">
<form method="post" action="./authentification.php">

	<fieldset>
	<LEGEND>Authentification</LEGEND> 
	
	<table>
	<tr>
		<td>Login* :</td>
		<td><INPUT type="text" name="login" /></td>
	</tr>
	<tr>
		<td>Mot de passe* :</td>
		<td><INPUT type="password" name="mdp" /></td>
	</tr>
	<tr>
		<td>(* Obligatoire)</td>
		<td><input class="style_submit" type="submit" value="Connecter" /></td>
	</tr>
	</table>
	
	</fieldset>
	
	<?php if(isset($_GET['error']) && !empty($_GET['error'])){
			?> <span style="color: red;"><em><b>Login et/ou mot de passe incorrect</b></em></span>	<?php
		} ?>

</form>
</div>