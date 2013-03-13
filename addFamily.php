<!--
Ajout d'une Famille.
Thomas BRODUSCH
Test Stagiaire - SOIXANTECIRCUITS
Mars 2013
-->
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>PocketMonster: Ajouter Famille</title>


	  <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
    
	<script src="http://code.jquery.com/jquery-1.9.1.min.js" type="text/javascript"></script>
	
	
	
</head>
<body>
	<?php include('include/menu.php'); ?>

	<form id="form" method="POST" action="#">
		<label>Nom:</label> <input type="text" name="name" />  <br/>
		<label>Monde:</label>  <input type="text" name="world" /> <br/>
		<label>Nombre Max:</label> <input type="text" name="nbMax" /> <br/>
		
		
	<input type="submit" class="btn btn-success btn-large" id="button" value="Ajouter une famille !"/>
		
		
	</form>
	<hr />
	<div id="result"></div>
	
<script type="text/javascript">
	//Gestion du formulaire.
	$("#form").submit(function(event) {
		// Modifie le comportement normal du formulaire (stop l'envoi).
  		event.preventDefault();
 
  		// Variables composants la requête ajax, issues du formulaire.
 		 var $form = $( this ),
		fonction = 'add_family',
      		name = $form.find( 'input[name="name"]' ).val(),
	 	world = $form.find( 'input[name="world"]' ).val(),
 		nbMax = $form.find( 'input[name="nbMax"]' ).val(),
      		url = 'fonctions.php';
 
  		//Envoi de la requête ajax.
  		var posting = $.post( url, { fonction:fonction, name:name, world:world, nbMax:nbMax } );
 
  		//Renvoi le resultat de la requete ajax dans le div #result.
  		posting.done(function(data) {
			var content = data;
			$("#result").empty().append(content);
	
  		});
	});//Fin gestion du formulaire.
	/*____________________________________________________*/
	
	</script>
	
</body>
</html>
