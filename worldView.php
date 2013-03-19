<!--
Visualisation des monstres en fonction d'un monde et d'une famille selectionné.
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
				$worldObjet->show_radio();
			}
	
		}else{ echo'<p>Veuillez <a href="addWorld.php">créer un monde</a></p>';}

		$result->closeCursor();
		$cnx = null; // Fermeture de la connexion
}

function showMonsters(){
	require('DB_connect.php');
	require('class/ClassMonster.php');
	
	$family = $_POST['family'];
		echo $world;
		$req="SELECT * FROM monsters WHERE mo_family ='".$family."';";
		$result=$cnx->query($req);
		$count = $result->rowCount(); 

		if($count>0){
	
			
			while($monster = $result-> fetch(PDO::FETCH_ASSOC)){
				//Creation de l'objet monster.
				$monsterObjet = new monster($monster['mo_name'],$monster['mo_family'],$monster['mo_size'],$monster['mo_age'],$monster['mo_image']);
				//Affichage: thumbnail + nom. Voir "ClassMonster.php".
				$monsterObjet->show();
				
			}
			
		}

		$result->closeCursor();
		$cnx = null; 
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>PocketMonster: Ajouter Monde</title>


	  <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">

	<script src="js/jquery-1.9.1.min.js" type="text/javascript"></script>
	
	 
	
</head>
<body>
	<?php include('include/menu.php'); ?>
	<br/><br/><br/>
	
	<form id="formFamily" method="POST" action="#">
		<p>
			<strong>Monde: </strong> <!-- Affichage des Mondes: boutons radio --> <?php showWorld(); ?>
		 <br/> <br/><strong>Famille: </strong> <div id="select"> <!-- Requête AJAX--> </div>
		<input type="submit" class="btn btn-success btn-normal" id="button" value="Visualiser !"/>
		</p>
	</form>

	<hr /> 
	<!-- Description du monstre: image + infos -->			
	<div class="row" id="description">
     	<div class="span3" id="photo" ></div>
     	<div class="span8" id="infos"></div>
   </div>
	
	<div id="world" class="terre">
		
		<div class="row" id="listMonsters"> 
			<!-- Listing des monstres -->
			<?php showMonsters(); ?> 
		</div>
	</div>
			
	<hr />
			

<script type="text/javascript">
	
	$("document").ready(function() {

	/*Listing de toutes les familles dans SELECT, au chargement de la page.
	*___________________________________________________________________*/
		var fonction = 'get_family',
		world = $('input[name="world"]:checked').val(),
      		url = 'functions_get.php';
 		var posting = $.post( url, { fonction:fonction, world:world } );
 		 
  		 posting.done(function(data) {
			 var content = data;
			$("#select").empty().append(content);
	
  			});

	/*Rafraichissement du Listing de toutes les familles dans SELECT, si clic utilisateur sur un Monde (input[type=radio]).
	*___________________________________________________________________________________________________________________*/
		$('input[type="radio"]').click(function(){
		
		var fonction = 'get_family',
		world = $('input[name="world"]:checked').val(),
      		url = 'functions_get.php';
 		var posting = $.post( url, { fonction:fonction, world:world } );
 		 
  		 posting.done(function(data) {
			 var content = data;
			$("#select").empty().append(content);
	
  			});
		});

	
	/*Gestion clic "description" Monstre: se ferme au clic.
	*__________________________________________________________*/
		$("div#description").click(function() {
				$(this).hide("fast");
		});
	
	/*Gestion clic sur un Monstre.
	*__________________________________________________________*/
	 $("div#monster").click(function() {
		
		$("div#description").hide("fast");
		$nom = $(this).text();
		
		
		$("div#photo").empty();
		$("div#infos").empty();
		
		
		//Get IMAGE MONSTRE.
		var fonction = 'get_monster_image',
		monster = $nom,
      		url = 'functions_get.php';
 		var posting = $.post( url, { fonction:fonction, monster:monster } );
 		 
  		 posting.done(function(data) {
			 var content = data;
			$("div#photo").append(content);
	
  			});	
				
		
		//Get INFOS MONSTRE.
		var fonction = 'get_monster_description',
		monster = $nom,
      		url = 'functions_get.php';
 		var posting = $.post( url, { fonction:fonction, monster:monster } );
 		 
  		 posting.done(function(data) {
			 var content = data;
			$("div#infos").append(content);
	
  			});	
				
		//Affichage description: image + infos du monstre.
		$("div#description").show("slow"); 
	}); 

});//END 
	
</script>
	
</body>
</html>
