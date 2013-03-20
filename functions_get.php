<?php
/*
Fonctions relatives au traitement, interrogation de la base de donnees.
Thomas BRODUSCH
Test Stagiaire - SOIXANTECIRCUITS
Mars 2013
*/

//Connection à la Base de donnée.
include_once('DB_Connect.php');

//Récuperation du nom de la fonction à traiter.
$fonction = $_POST['fonction'];



/*=========================================================================================
====================================================== Obtenir les familles -> select */

if( $fonction === "get_family" ){
		require('class/ClassFamily.php');
		$world= $_POST['world'];
		
		if( !empty($world) ){
			$req="SELECT * FROM family WHERE fam_world ='".$world."';";
		}else{ $req="SELECT * FROM family;"; }
		
		$result=$cnx->query($req);
		$count = $result->rowCount(); 

		if($count>0){
			echo'<select name="family">';
			while($family = $result-> fetch(PDO::FETCH_ASSOC)){
				//Creation de l'objet famille.
				$familleObjet = new family($family['fam_name'],$family['fam_world'],$family['fam_nbMax']);
				//Affichage. Voir "ClassFamily.php".
				$familleObjet->getSelect();
				
			}
			echo'</select>';
		}else{ echo'Veuillez <a href="addFamily.php">créer une famille</a>.';}


		$result->closeCursor();
		$cnx = null; // Fermeture de la connexion
}
/*=========================================================================================
====================================================== Obtenir les mondes -> select */

if( $fonction === "get_world" ){
		require('class/ClassFamily.php');
		
		$req="SELECT * FROM world;";
		$result=$cnx->query($req);
		$count = $result->rowCount(); 


		if($count>0){
			echo'<select name="listWorld">';
			while($world = $result-> fetch(PDO::FETCH_ASSOC)){

				//Creation de l'objet world.
				$worldObjet = new world($world['wo_name']);
				//Affichage: voir "ClassWorld.php".
				$worldObjet->show_select();
			}
		
			echo'</select>';
		}else{ echo'Veuillez <a href="addWorld.php">créer un monde</a>.';}


		$result->closeCursor();
		$cnx = null; // Fermeture de la connexion
}
/*=========================================================================================
============================================================= Obtenir description monstre*/
if( $fonction === "get_monster_description" ){

include('DB_connect.php');
	include('class/ClassMonster.php');				

	

	$famille= $_POST['family'];
	$monster =$_POST['monster']; 

		//Permet d'enlever les espaces avant et apres le nom.
		$monster = preg_replace('/\s+/', '',$monster);
		
		$req="SELECT * FROM monsters WHERE mo_name ='".$monster."';";
		
		$result=$cnx->query($req);
		$count = $result->rowCount(); 
	
		if($count>0){
	
			
			while($monster = $result-> fetch(PDO::FETCH_ASSOC)){
				//Creation de l'objet famille.
				$monstreObjet = new monster($monster['mo_name'],$monster['mo_family'],$monster['mo_size'],$monster['mo_age'],$monster['mo_image']);
				//Affichage.
				$monstreObjet->getDescription();
				
			}
			
		}
 
		$result->closeCursor();
		$cnx = null; // Fermeture de la connexion
			

}
/*=========================================================================================
==================================================================== Obtenir Image monstre*/
if( $fonction === "get_monster_image" ){

include('DB_connect.php');
	include('class/ClassMonster.php');				

	

	$famille= $_POST['family'];
	$monster =$_POST['monster']; 

		//Permet d'enlever les espaces avant et apres le nom.
		$monster = preg_replace('/\s+/', '',$monster);
		
		$req="SELECT * FROM monsters WHERE mo_name ='".$monster."';";
		
		$result=$cnx->query($req);
		$count = $result->rowCount(); 
	
		if($count>0){
	
			
			while($monster = $result-> fetch(PDO::FETCH_ASSOC)){
				//Creation de l'objet famille.
				$monstreObjet = new monster($monster['mo_name'],$monster['mo_family'],$monster['mo_size'],$monster['mo_age'],$monster['mo_image']);
				//Affichage.
				$monstreObjet->getImage();
				
			}
			
		}
 
		$result->closeCursor();
		$cnx = null; // Fermeture de la connexion
			

}

?>
