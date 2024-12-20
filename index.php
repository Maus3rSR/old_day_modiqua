<?php 
	session_start(); 
	
	//affectation de la langue
	if(!isset($_SESSION['langue'])){
		$_SESSION['langue'] = 'fr';
	}
	if(isset($_GET['lang']) && !empty($_GET['lang'])){
		$_SESSION['langue'] = $_GET['lang'];
	}
	if($_SESSION['langue'] != 'fr' && $_SESSION['langue'] != 'en' && $_SESSION['langue'] != 'de'){
		$_SESSION['langue'] = 'fr';
	}
	//-----------------------//
	
	require_once("./include/fonctions.php");
	require_once("./include/menu.php");
?> 
<!DOCTYPE html>
<html lang="<?php echo $_SESSION['langue']; ?>">
	<head>
		<link rel="icon" type="image/x-icon" href="/images/favicon.ico"/>
		<link rel="stylesheet" type="text/css" href="/css/stylesheet.css"/>
		<link rel="stylesheet" href="/css/coin-slider-styles.css" type="text/css" />
		<script type="text/javascript" src="/js/jquery-1.7.js"></script>
		<script type="text/javascript" src="/js/coin-slider.min.js"></script>
		<script type="text/javascript" src="/js/fonctions.js"></script>
		<script type="text/javascript">
		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-32561731-1']);
		  _gaq.push(['_trackPageview']);

		  (function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();
		</script>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="usinage de précision, réparation moules, machines spéciales, étude, réalisation" />
		<meta name="description" content="La société MODIQUA est spécialisée dans l'étude, la réalisation de pièces mécaniques, l'usinage de précision, la création de machines spéciales, la réparation de moules pour injection plastique" />
		
		<!--[if IE]>
			<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<![endif]-->
		<!--[if lt IE 9]>
            <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
		<!-- Permet d'utiliser des balises HTML5 non reconnu par IE -->
		
		<title>Modiqua - Etude, réalisation, usinage de précision & réparation</title>
	</head>
	<body>
		<div id="bloc_page">
			<header>
				<ul id="flags">
					<li><a rel="nofollow" href="/index.php?lang=fr" title="Français"><img alt='langue_française' src="/images/fr.png" /></a></li>
					<!--<li><a rel="nofollow" href="/index.php?lang=en" title="English"><img alt='english_language' src="/images/en.png" /></a></li>-->
					<!--<li><a rel="nofollow" href="/index.php?lang=de" title="Deutschland"><img alt='deutschland_sprache' src="/images/de.png" /></a></li>-->
				</ul>
				<div id="logo"><a href="http://modiqua.eu" title="Page d'accueil"><img alt='logo modiqua' src="/images/modiqua3.png" /></a></div>
				<nav>
					<?php affiche_menu(); ?>
				</nav>
			</header>
			
			<section>
				<div id="faux_bordure">
					<div id="faux_fond">
						<div id="content">
							<div id="ariane">
								<?php //AFFICHAGE DU FIL D'ARIANE
								$page = getPage();
								if(!empty($page)){
									if(isset($_GET['categ']) && !empty($_GET['categ'])){
									$categ = html($_GET['categ']);
										?><a href="http://modiqua.eu" title="Page d'accueil">Accueil</a> > <a title="Accéder à la page: <?php echo $page ?>" href="http://modiqua.eu/<?php echo $page ?>"><?php echo $page ?></a> > <?php echo $categ;									
									}else{
										?><a href="http://modiqua.eu" title="Accéder à la page: Accueil">Accueil</a> > <?php echo $page;
									
									}
								}else{
									?><a href="http://modiqua.eu" title="Accéder à la page: Accueil">Accueil</a> > Accueil<?php
								}
								?>
							</div>
							
							<!-- UNE DIV PREVENANT LES PERSONNES AYANT UNE VERSION EN DESSOUS DE INTERNET EXPLORER 8 DE PRENDRE UNE NOUVELLE VERSION DE NAVIGATEUR -->

							  <!--[if lt IE 7]>
							  <div style='border: 1px solid #F7941D; background: #FEEFDA; text-align: center; clear: both; height: 75px; position: relative;'>
								<div style='position: absolute; right: 3px; top: 3px; font-family: courier new; font-weight: bold;'><a href='#' onclick='javascript:this.parentNode.parentNode.style.display="none"; return false;'><img src='http://www.ie6nomore.com/files/theme/ie6nomore-cornerx.jpg' style='border: none;' alt='Close this notice'/></a></div>
								<div style='width: 640px; margin: 0 auto; text-align: left; padding: 0; overflow: hidden; color: black;'>
								  <div style='width: 75px; float: left;'><img src='http://www.ie6nomore.com/files/theme/ie6nomore-warning.jpg' alt='Warning!'/></div>
								  <div style='width: 275px; float: left; font-family: Arial, sans-serif;'>
									<div style='font-size: 14px; font-weight: bold; margin-top: 12px;'>Vous utilisez un navigateur dépassé depuis près de 8 ans!</div>
									<div style='font-size: 12px; margin-top: 6px; line-height: 12px;'>Pour une meilleure expérience web, prenez le temps de mettre votre navigateur à jour.</div>
								  </div>
								  <div style='width: 75px; float: left;'><a href='http://fr.www.mozilla.com/fr/' target='_blank'><img src='http://www.ie6nomore.com/files/theme/ie6nomore-firefox.jpg' style='border: none;' alt='Get Firefox 3.5'/></a></div>
								  <div style='width: 75px; float: left;'><a href='http://www.microsoft.com/downloads/details.aspx?FamilyID=341c2ad5-8c3d-4347-8c03-08cdecd8852b&DisplayLang=fr' target='_blank'><img src='http://www.ie6nomore.com/files/theme/ie6nomore-ie8.jpg' style='border: none;' alt='Get Internet Explorer 8'/></a></div>
								  <div style='width: 73px; float: left;'><a href='http://www.apple.com/fr/safari/download/' target='_blank'><img src='http://www.ie6nomore.com/files/theme/ie6nomore-safari.jpg' style='border: none;' alt='Get Safari 4'/></a></div>
								  <div style='float: left;'><a href='http://www.google.com/chrome?hl=fr' target='_blank'><img src='http://www.ie6nomore.com/files/theme/ie6nomore-chrome.jpg' style='border: none;' alt='Get Google Chrome'/></a></div>
								</div>
							  </div>
							  <![endif]-->
  
							<?php include("./include/redirection.php"); ?>
						</div>
						<aside>
							<?php include("./include/redirection_aside.php"); ?>
						</aside>
					</div>
				</div>
			</section>
			
			<footer>
			<?php //FOOTER FR
			if($_SESSION['langue'] == 'fr'){
			?>
				<ul id="left_liens">
					<li><a href="http://modiqua.eu/news" title="Accéder à la page: News">News</a></li>
					<li><a href="http://modiqua.eu/temoignage" title="Accéder à la page: Témoignages">Temoignages</a></li>
					<li><a href="http://modiqua.eu/devis" title="Accéder à la page: Devis en ligne">Devis en ligne</a></li>
					<li><a href="http://modiqua.eu/documentation" title="Accéder à la page: Documentation">Documentations</a></li>
				</ul>
				<ul id="right_liens">
					<li><a href="http://modiqua.eu/partenaire" title="Accéder à la page: Partenaires">Partenariats</a></li>
					<li><a href="http://modiqua.eu/postulation" title="Accéder à la page: Recrutement">Recrutement</a></li>
					<li><a href="http://modiqua.eu/plan_site" title="Accéder à la page: Plan du site">Plan du site</a></li>
					<li><a href="http://modiqua.eu/mentions_legales" title="Accéder à la page: Mentions légales">Mentions legales</a></li>
				</ul>
				
				<p class="separateur">- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -</p>
				<p id="copyright">Copyright © 2012 - Tous droits reserves Modiqua SAS</p>
				<p id="admin"><a href="http://modiqua.eu/administrateur/administration.php" target="_blank" title="Espace réservé à l'administrateur">ADMINISTRATION</a></p>	
			<?php //FOOTER DE
			}else if($_SESSION['langue'] == 'de'){
			?>
				<ul id="left_liens">
					<li><a href="http://modiqua.eu/news">News</a></li>
					<li><a href="http://modiqua.eu/temoignage">Zeugnis</a></li>
					<li><a href="http://modiqua.eu/devis">Online-Angebot</a></li>
					<li><a href="http://modiqua.eu/documentation">Dokumentation</a></li>
				</ul>
				<ul id="right_liens">
					<li><a href="http://modiqua.eu/partenaire">Partnerschaften</a></li>
					<li><a href="http://modiqua.eu/postulation">Rekrutierung</a></li>
					<li><a href="http://modiqua.eu/plan_site">Sitemap</a></li>
					<li><a href="http://modiqua.eu/mentions_legales">Rechtliche Informationen</a></li>
				</ul>
				
				<p class="separateur">- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -</p>
				<p id="copyright">Copyright © 2012 - Alle Rechte vorbehalten Modiqua SAS</p>
				<p id="admin"><a href="http://modiqua.eu/administrateur/administration.php" target="_blank">ADMINISTRATION</a></p>

			<?php //FOOTER EN
			}else if($_SESSION['langue'] == 'en'){
			?>
				<ul id="left_liens">
					<li><a href="http://modiqua.eu/news">News</a></li>
					<li><a href="http://modiqua.eu/temoignage">Marks</a></li>
					<li><a href="http://modiqua.eu/devis">Quote online</a></li>
					<li><a href="http://modiqua.eu/documentation">Documentation</a></li>
				</ul>
				<ul id="right_liens">
					<li><a href="http://modiqua.eu/partenaire">Partnerships</a></li>
					<li><a href="http://modiqua.eu/postulation">Recruitment</a></li>
					<li><a href="http://modiqua.eu/plan_site">Sitemap</a></li>
					<li><a href=".http://modiqua.eu/mentions_legales">Legal informations</a></li>
				</ul>
				
				<p class="separateur">- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -</p>
				<p id="copyright">Copyright © 2012 - All rights reserved Modiqua SAS</p>
				<p>Réalisation <a href="http://www.linkedin.com/in/kevinunfricht" target="_blank">Kevin UNFRICHT</a></p>
				<p id="admin"><a rel="nofollow" href="http://modiqua.eu/administrateur/administration.php" target="_blank">ADMINISTRATION</a></p>
			<?php
			}
			?>
				<p class="separateur">- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -</p>
				<ul id="pub">
					<li><a href="http://validator.w3.org/check?uri=http%3A%2F%2Fmodiqua.eu%2F" target="_blank" title="Site de validation du W3C"><img alt='Valide HTML5 W3C' src="/images/html5v.png" /></a></li>
					<li><a href="http://modiqua.eu/news/news-6" target="_blank" title="L'offre équilibre"><img alt='edf_equilibre' src="/images/EQ_ENT_KWH_RGB_300.png" /></a></li>
				</ul>
			</footer>
			<div id="footer_ombre"></div>
		</div>
	</body>
</html>