<!--
Ajout d'un Monde.
Thomas BRODUSCH
Test Stagiaire - SOIXANTECIRCUITS
Mars 2013
-->
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>PocketMonster: Ajouter Monde</title>


	  <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
    	<link rel="stylesheet" href="css/jquery.fileupload-ui.css">

	<script src="js/jquery-1.9.1.min.js" type="text/javascript"></script>
	
	 
	
</head>
<body>
	<?php include('include/menu.php'); ?>
	
	<form id="form" method="POST" action="#">
		<div class="containForm"> <label>Nom:</label> <input type="text" name="name" />  </div><br/>
		
		
	<div class="center"><input type="submit" class="btn btn-success btn-large" id="button" value="Ajouter un monde !"/></div>
		
		
	
	<hr />
	<div id="result" class="center"></div>
	
<script type="text/javascript">

	/*Gestion du formulaire, ajout d'un Monde.
	*__________________________________________________________*/
	$("#form").submit(function(event) {
	
 
 		 // Modifie le comportement normal du formulaire (stop l'envoi).
  		event.preventDefault();
 
  		// Variables composants la requête ajax, issues du formulaire.
  		var $form = $( this ),
		fonction = 'add_world',
      		name = $form.find( 'input[name="name"]' ).val(),
     		url = 'functions_add.php';
 
 		//Envoi de la requête ajax.
  		var posting = $.post( url, { fonction:fonction, name:name} );
 
		//Renvoi le resultat de la requete ajax dans le div #result.
  		posting.done(function(data) {
			var content = data;
			$("#result").empty().append(content);
		});
	});
	
	</script>
	
</body>
</html>
