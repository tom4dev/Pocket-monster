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
	
<script src="js/jquery-1.9.1.min.js" type="text/javascript"></script>
	
	
</head>
<body>
	<?php include('include/menu.php'); ?>

	<form id="form" method="POST" action="#">
		
	<div class="containForm"> <label>Nom:</label> <input type="text" name="name" />  </div><br/>
	<div class="containForm"> <label>Taille:</label> <input type="text" name="size" /> </div><br/>
	<div class="containForm"> <label>Age:</label>	<input type="text" name="age" /> </div><br/>
	<div class="containForm"> <label>Famille:</label> <div id="select"> <!-- Requête AJAX--> </div> </div><br/>
		
	
	<div class="center"> <input type="submit" class="center btn btn-primary btn-large" id="button"  value="Ajouter un monstre !"/></div>
		
		
	</form>

	
	<hr />
	<div id="result" class="center"></div>


<script type="text/javascript">	
	$(document).ready(function(){
		listingFamily();
	});
	
	/*Listing de toutes les familles dans SELECT.
	*__________________________________________________________*/
		function listingFamily() {
		var fonction = 'get_family',
      		url = 'functions_get.php';
 		var posting = $.post( url, { fonction:fonction, } );
 		 
  		 posting.done(function(data) {
			 var content = data;
			$("#select").empty().append(content);
	
  			});
		}
	
	/*Gestion du formulaire, ajout du monstre
	*__________________________________________________________*/
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
		
     		url = 'functions_add.php';
 
  		//Envoi de la requête ajax.
  		var posting = $.post( url, { fonction:fonction, name:name, size:size, age:age, family:family	 } );
 
  		//Renvoi le resultat de la requete ajax dans le div #result.
  		posting.done(function(data) {

			//On rafraichi la liste des familles.
			listingFamily();
			var content = data;
			$("#result").empty().append(content);
			
  		});
	});
	
</script>

</body>
</html>
