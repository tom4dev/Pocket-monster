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
			echo'<select>';
			while($world = $result-> fetch(PDO::FETCH_ASSOC)){

				//Creation de l'objet world.
				$worldObjet = new world($world['wo_name']);
				//Affichage: voir "ClassWorld.php".
				$worldObjet->show_select();
			}
			echo'</select>';
		}else{ echo'<p>Veuillez <a href="addWorld.php">créer un monde</a></p>';}

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
		<div class="containForm"> <label>Nom:</label> <input type="text" name="name" /> </div>  <br/>
		<div class="containForm"> <label>Monde:</label>  <div id="listWorld"><?php showWorld(); ?></div> </div><br/>
		<div class="containForm"> <label>Nombre Max:</label> <input type="text" name="nbMax" /> </div><br/>
		
		
	<div class="center"><input type="submit" class="btn btn-success btn-large center" id="button" value="Ajouter une famille !"/></div>
		
		
	</form>
	<hr />
	<div id="result" class="center"></div>
	
<script type="text/javascript">
$("document").ready(function() {	
	/*Listing des mondes dans SELECT, au chargement de la page.
	*___________________________________________________________________
		var fonction = 'get_world',
      		url = 'functions_get.php';
 		var posting = $.post( url, { fonction:fonction } );
 		 
  		 posting.done(function(data) {
			 var content = data;
			$("#listWorld").empty().append(content);
	
  			});	*/

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
});
	
	</script>
	
</body>
</html>
