<!--
Ajout d'une Famille.
Thomas BRODUSCH
Test Stagiaire - SOIXANTECIRCUITS
Mars 2013
-->
<?php

function showWorld(){
	require('DB_connect.php');
	require('class/ClassWorld.php');

		$req="SELECT * FROM world;";
		$result=$cnx->query($req);
		$count = $result->rowCount(); 

		if($count>0){

			while($world = $result-> fetch(PDO::FETCH_ASSOC)){

				//Creation de l'objet world.
				$worldObjet = new world($world['wo_name']);
				//Affichage: voir "ClassWorld.php".
				$worldObjet->show_select();
			}
		
		}else{ echo'<p>Pas de monde ! Veuillez <a href="addWorld.php">créer un monde</a></p>';}

		$result->closeCursor();
		$cnx = null; // Fermeture de la connexion
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>PocketMonster: Ajouter Famille</title>


	  <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
    
	<script src="js/jquery-1.9.1.min.js" type="text/javascript"></script>
	
	
	
</head>
<body>
	<?php include('include/menu.php'); ?>

	<form id="form" method="POST" action="#">
		<label>Nom:</label> <input type="text" name="name" />  <br/>
		<label>Monde:</label> <select> <?php showWorld(); ?></select> <br/>
		<label>Nombre Max:</label> <input type="text" name="nbMax" /> <br/>
		
		
	<input type="submit" class="btn btn-success btn-large" id="button" value="Ajouter une famille !"/>
		
		
	</form>
	<hr />
	<div id="result"></div>
	
<script type="text/javascript">

	/*Gestion du formulaire, ajout d'une Famille.
	*__________________________________________________________*/
	$("#form").submit(function(event) {
		// Modifie le comportement normal du formulaire (stop l'envoi).
  		event.preventDefault();
 
  		// Variables composants la requête ajax, issues du formulaire.
 		 var $form = $( this ),
		fonction = 'add_family',
      		name = $form.find( 'input[name="name"]' ).val(),
	 	world = $form.find('select').val(),
 		nbMax = $form.find( 'input[name="nbMax"]' ).val(),
      		url = 'functions_add.php';
 
  		//Envoi de la requête ajax.
  		var posting = $.post( url, { fonction:fonction, name:name, world:world, nbMax:nbMax } );
 
  		//Renvoi le resultat de la requete ajax dans le div #result.
  		posting.done(function(data) {
			var content = data;
			$("#result").empty().append(content);
		});
	});
	
	</script>
	
</body>
</html>
