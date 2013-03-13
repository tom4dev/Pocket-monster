<!--
Ajout d'un Monstre.
Thomas BRODUSCH
Test Stagiaire - SOIXANTECIRCUITS
Mars 2013
-->
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>PocketMonster: Ajouter Monstre</title>
	 <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	
<script src="http://code.jquery.com/jquery-1.9.1.min.js" type="text/javascript"></script>
	
	
</head>
<body>
	<?php include('include/menu.php'); ?>

	<form id="form" method="POST" action="#" enctype="multipart/form-data">
		
	<label>Nom:</label> <input type="text" name="name" />  <br/>
	<label>Taille:</label> <input type="text" name="size" /> <br/>
	<label>Age:</label>	<input type="text" name="age" /> <br/>
	<label>Famille:</label> <select> </select> <br/>
		
	
	<input type="submit" class="btn btn-primary btn-large" id="button"  value="Ajouter un monstre !"/>
		
		
	</form>
	<hr />
	<div id="result"></div>


<script type="text/javascript">
	// Ajout des options dans le select.
	$(document).ready(function() {
		
 		 var $form = $( this ),
		fonction = 'get_family',
      		url = 'fonctions.php';
 		 var posting = $.post( url, { fonction:fonction } );
 		 
  		posting.done(function(data) {
			var content = data;
			$("select").append(content);
	
  		});
	});
	/*__________________________________________________________*/
	// Ajout du monstre.
	
	//Gestion du formulaire.
	$("#form").submit(function(event) {
		// Modifie le comportement normal du formulaire (stop l'envoi).
  		event.preventDefault();
 
  		// Variables composants la requête ajax, issues du formulaire.
  		var $form = $( this ),
		fonction = 'add_monster',
      		name = $form.find( 'input[name="name"]' ).val(),
		size = $form.find( 'input[name="size"]' ).val(),
 		age = $form.find( 'input[name="age"]' ).val(),
		family = $form.find( 'select' ).val(),
		
     		url = 'fonctions.php';
 
  		//Envoi de la requête ajax.
  		var posting = $.post( url, { fonction:fonction, name:name, size:size, age:age, family:family, } );
 
  		//Renvoi le resultat de la requete ajax dans le div #result.
  		posting.done(function(data) {
			var content = data;
			$("#result").empty().append(content);
	
  		});
	});

	/*__________________________________________________________*/
	// image.

   	 
  
	
	</script>
</body>
</html>
