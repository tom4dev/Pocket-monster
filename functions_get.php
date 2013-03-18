<?php
/*
Fonctions de traitement, et d'interaction avec la base de donnees.
Thomas BRODUSCH
Test Stagiaire - SOIXANTECIRCUITS
Mars 2013
*/

//Connection à la Base de donnée.
include_once('DB_Connect.php');

//Récuperation du nom de la fonction à traiter.
$fonction = $_POST['fonction'];

/*================================================ Obtenir les familles (pour SELECT) */

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

/*================================================ Obtenir description monstre*/
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

/*================================================ Obtenir Image monstre*/
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

/*================================================ Ajout monde */ 
if( $fonction === "add_world"){

	$name = $_POST['name'];
	

	if( !empty($name) ){
		

			//On teste si un monde portant le même nom existe déja.
			$req="SELECT * FROM world WHERE wo_name = '".$name."' ;";
			$result=$cnx->query($req);
			$count = $result->rowCount(); 

			if($count>0){
				
				echo'Un monde existe déja sous ce nom: <b>'.$name.'</b>.<br/> Veuillez choisir un autre nom.';
			}else{
				//Si il n'existe pas on l'insere alors dans la base de donnee.
				$req="INSERT INTO world VALUES ('".$name."');";
				$result=$cnx->exec($req);
				echo'Le monde <b>"' .$name .'"</b> , à été ajouté dans la base de donnee.';
				
			}
		$result->closeCursor();
		$cnx = null; //Fermeture de la connexion
	}else{echo'Formulaire incomplet !';}
	
} 
/*================================================ Ajout famille */
if( $fonction === "add_family"){

	$name = $_POST['name'];
	$world = $_POST['world'];
	$nbMax = $_POST['nbMax'];
	$famID = ucfirst($name).ucfirst($world) ;

	if( $world === "no_world"){
		echo'Veuillez <a href="addWorld.php">créer un monde</a>.';
	}
	//Test pour vérifier que le formulaire est complet
	
	if( (!empty($name)) && (!empty($world)) && (!empty($nbMax)) && ($world != "no_world") ){

			//On teste si une famille portant le même nom et résidant dans le même monde existe déja.
			$req="SELECT * FROM family WHERE fam_id = '".$famID."' ;";
			$result=$cnx->query($req);
			$count = $result->rowCount(); 

			if($count>0){
				echo'Une famille existe déja sous ce nom: <b>'.$name.'</b> dans ce monde (<b>'.$world.'</b>).';
			}else{
				//Si elle n'existe pas on insere alors la nouvelle famille.
				$req="INSERT INTO family (fam_id,fam_name,fam_world,fam_nbMax) VALUES ('".$famID."','".$name."','".$world."','".$nbMax."');";
				$result=$cnx->exec($req);
				echo'La famille <b>"' .$name .'"</b> pouvant contenir <b>'.$nbMax.' membre(s)</b>, à été ajouté dans le monde <b>"'.$world.'"</b>.';
			}
			$result->closeCursor();
			$cnx = null; //Fermeture de la connexion
	}
	else{echo'Formulaire incomplet !';}
	
	
}


/*================================================ Ajout monstre */
if( $fonction === "add_monster"){

	$name = $_POST['name'];
	$size =$_POST['size'];
	$age = $_POST['age'];
	$family = $_POST['family'];//Contient un fam_id
	$image = 'default.jpg';

		
	//Monstre.
	if( $family === "no_family"){
		echo'Veuillez <a href="addFamily.php">créer une famille</a>.';
	}

	if( (!empty($name)) && (!empty($size)) && (!empty($age)) && (!empty($family)) && ($family != "no_family") ){
		

			//On teste si il reste de la place dans la famille choisi.
		 if( isFamilyComplete($family) ){
				echo'Cette famille est déjà complete. <br/> Veuillez choisir une autre famille non-compléte.';
		}else{
			//On teste si un monstre portant le même nom, la même famille et résidant dans le même monde existe déja.
			$req="SELECT * FROM monsters WHERE mo_name = '".$name."' AND mo_family ='".$family."' ;";
			$result=$cnx->query($req);
			$count = $result->rowCount(); 

			if($count>0){
				
				echo'Un monstre existe déja sous ce nom: <b>'.$name.'</b> dans cette famille (<b>'.$family.'</b>).';
			}else{
				//Si il n'existe pas on l'insere alors dans la famille.
				$req="INSERT INTO monsters VALUES ('".$name."','".$family."','".$size."','".$age."','".$image."');";
				
				$result=$cnx->exec($req);
				echo 'Le monstre <b>"' .$name .'"</b> , à été ajouté dans la famille <b>"'.$family.'"</b>.';
			}
		}
	}else{echo'Formulaire incomplet !';}	
	$cnx = null; // Fermeture de la connexion 	
}

/*=========================================================================================
==========================================================================================*/
function get_NbFamilyMembers($familyID)	{
	include('DB_Connect.php');

	$req="SELECT * FROM monsters WHERE mo_family = '".$familyID."' ;";
	$result=$cnx->query($req);
	$count = $result->rowCount(); 
				
		 return $count;

}

function  get_NbMaxFamily($familyID)	{
	include('DB_Connect.php');

	$req="SELECT * FROM family WHERE fam_id ='".$familyID."' ;";
	$result=$cnx->query($req);
		
	while($family = $result->fetch(PDO::FETCH_ASSOC)){
		$nbMaxFamily = $family['fam_nbMax'];
		return $nbMaxFamily;		
	}
	
	
}

function isFamilyComplete($familyID) {



		include('DB_Connect.php');
		
		if( get_NbFamilyMembers($familyID) < get_NbMaxFamily($familyID) ){
			return false;
		}
		if (get_NbFamilyMembers($familyID) == get_NbMaxFamily($familyID) ){
			
			return true;
			
		}
		
		


}
?>
