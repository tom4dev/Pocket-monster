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
	<br/><br/><br/>
	
	<form id="form" method="POST" action="#">
		<label>Nom:</label> <input type="text" name="name" />  <br/>
		
		
	<input type="submit" class="btn btn-success btn-large" id="button" value="Ajouter un monde !"/>
		
		
	
	<hr />
	<div id="result"></div>
	
<script type="text/javascript">
	/* attach a submit handler to the form */
	$("#form").submit(function(event) {
	
 
  /* stop form from submitting normally */
  event.preventDefault();
 
  /* get some values from elements on the page: */
  var $form = $( this ),
	fonction = 'add_world',
      	name = $form.find( 'input[name="name"]' ).val(),
     	url = 'fonctions.php';
 
  /* Send the data using post */
  var posting = $.post( url, { fonction:fonction, name:name} );
 
  /* Put the results in a div */
  posting.done(function(data) {
	var content = data;
	$("#result").empty().append(content);
	
  });
});
	
	</script>
	
</body>
</html>
