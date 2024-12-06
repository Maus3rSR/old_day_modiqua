<?php
	session_start(); 
	require_once("../include/fonctions.php");
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="icon" type="image/x-icon" href="./images/favicon.ico"/>
		
		<link rel="stylesheet" type="text/css" href="../css/stylesheet_admin.css"/>
		<link rel="stylesheet" href="../css/ui-darkness/jquery-ui-1.8.20.custom.css" type="text/css" />
		
		<script type="text/javascript" src="../js/jquery-1.7.js"></script>
		<script type="text/javascript" src="../js/jquery-ui-1.8.20.custom.min.js"></script>
		<script type="text/javascript" src="../js/fonctions.js"></script>
		<script>
			$(document).ready(function() {
				$("#date_picker").datepicker();
			});
		</script>

		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<!--[if IE]>
			<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<![endif]-->
		<!--[if lt IE 9]>
            <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
		<!-- Permet d'utiliser des balises HTML5 non reconnu par IE -->
		<title>Modiqua - Administration</title>
	</head>
	<body>
		<header>
			<div style="margin-top: 15px; float: left; margin-right: 100px;">
				<p>MODIQUA</p>
				<p>ADMINISTRATION</p>
			</div>
			<?php if(is_admin() && is_connected()){ ?>
			<ul id="menu">
				<li><a href="./administration.php?page=news">News</a></li>
				<li><a href="./administration.php?page=clients">Client</a></li>
				<li><a href="./administration.php?page=partenaire">Partenaire</a></li>
				<li><a href="./administration.php?page=temoignage">Temoignage</a></li>
				<li><a href="./administration.php?page=galerie">Galeries</a></li>
				<li><a href="./administration.php?page=membre">Membres</a></li>
				<li><a href="./administration.php?page=historique">Historique</a></li>				
				<li><a href="../index.php" target="_blank">Voir le site</a></li>
				<li><a href="./logout.php">Logout</a></li>
			</ul>
			<?php } ?>
		</header>
		<aside>
			<?php include('./redirection_aside.php'); ?>
		</aside>
		<section>
			<article>
				<?php	
					include('./redirection.php');
				?>
			</article>
		</section>
	</body>
</html>