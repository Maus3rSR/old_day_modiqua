/* ------------------------------------------------------------ */
/* FICHIER JAVASCRIPT CONTENANT TOUTES LES FONCTIONS JAVASCRIPT */
/* ------------------------------------------------------------ */

// fonction qui retourne l'objet Xhr permettant de faire de l'ajax
function Get_xhr(){
	var xhr;
	if (window.XMLHttpRequest){ //objet stantard
		xhr = new XMLHttpRequest();
	} 
	else  if (window.ActiveXObject){ //objet IE
		xhr = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	return xhr;
}


//fonction ajax qui génère un mot de passe aléatoire dans une page php et la récupère pour l'afficher
function Genpass(name){
	var xhr = Get_xhr(); //création de la variable permettant l'ajax

	xhr.open("POST","../include/ajax.php",true); //on ouvre le fichier php qui va traiter l'envoie des données
	//Choix encodage
	xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	
	xhr.send("generate=1"); //envoi des données
	
	// On défini ce qu'on va faire quand on aura la réponse
	xhr.onreadystatechange = function(){
		// Reception et serveur ok
		if(xhr.readyState == 4 && xhr.status == 200){
			var rep = xhr.responseText; //réponse de fonctions.php en format texte
			//traitement de la réponse
			var mdp = rep.substring(8,16);
			var input = document.getElementsByName(name);
			input[0].value = mdp;
		}
	}
}

//fonction ajax pour la barre de recherche
function search_ajax(table,choix){
	var xhr = Get_xhr();
	var input_content = document.getElementsByName('search_'+table)[0].value;
	
	xhr.open("POST","../include/ajax.php",true);
	xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	xhr.send("table="+table+"&search="+input_content+"&choix="+choix);
	
	// On défini ce qu'on va faire quand on aura la réponse
	xhr.onreadystatechange = function(){
		// Reception et serveur ok
		if(xhr.readyState == 4 && xhr.status == 200){
			var rep = xhr.responseText; //réponse de fonctions.php en format texte
			//traitement de la réponse
			document.getElementsByClassName('gestion_content')[0].innerHTML = rep;
		}
	}
}

//fonction ajax qui récupère une galerie d'images
function get_galerie(id){
	
	var xhr = Get_xhr();
	
	xhr.open("POST","../include/ajax.php",true);
	xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	xhr.send("id_galerie="+id);
	
	// On défini ce qu'on va faire quand on aura la réponse
	xhr.onreadystatechange = function(){
		// Reception et serveur ok
		if(xhr.readyState == 4 && xhr.status == 200){
			var rep = xhr.responseText; //réponse de fonctions.php en format texte
			//traitement de la réponse
			document.getElementById("liste_img").innerHTML = rep;
		}
	}
}