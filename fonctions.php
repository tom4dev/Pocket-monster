<?php
/*
Fonctions de traitement, et d'interaction avec la base de donnees.
Thomas BRODUSCH
Test Stagiaire - SOIXANTECIRCUITS
Mars 2013
*/

//Connection à la Base de donnée.
include('DB_Connect.php');

//Récuperation du nom de la fonction à traiter.
$fonction = $_POST['fonction'];

/*================================================ Obtenir les familles */

if( $fonction === "get_family" ){
	

		$req="SELECT * FROM family;";
		$result=$cnx->query($req);
		$count = $result->rowCount(); 
		
		if($count>0){

			while($family = $result-> fetch(PDO::FETCH_ASSOC)){
				echo '<option value="'.$family['fam_id'].'">'.ucfirst($family['fam_name']).' ('.ucfirst($family['fam_world']).')</option>';
			}
			
		}else{ echo'<option value="no_family">Veuillez créer au moins une famille </option>';}
		
		
		$result->closeCursor();
		$cnx = null; // Fermeture de la connexion
}



/*================================================ Ajout famille */
if( $fonction === "add_family"){
	
	
	$name = $_POST['name'];
	$world =$_POST['world'];
	$nbMax = $_POST['nbMax'];

	//Test pour vérifier que le formulaire est complet
	
	if( (!empty($name)) && (!empty($world)) && (!empty($nbMax)) ){
		
			//On teste si une famille portant le même nom et résidant dans le même monde existe déja.
			$req="SELECT * FROM family WHERE fam_name = '".$name."' AND fam_world = '".$world."'";
			$result=$cnx->query($req);
			$count = $result->rowCount(); 
			
			if($count>0){
				echo'Une famille existe déja sous ce nom: <b>'.$name.'</b> dans ce monde (<b>'.$world.'</b>).';
			}else{
				//Si elle n'existe pas on insere alors la nouvelle famille.
				$req="INSERT INTO family (fam_name,fam_world,fam_nbMax) VALUES ('".$name."','".$world."','".$nbMax."');";
				$result=$cnx->exec($req);
				echo'La famille <b>"' .$name .'"</b> pouvant contenir <b>'.$nbMax.' membre(s)</b>, à été ajouté dans le monde <b>"'.$world.'"</b>.';
			}
	}
	else{echo'Formulaire incomplet !';}
	$cnx = null; // Fermeture de la connexion

}


/*================================================ Ajout monstre */
if( $fonction === "add_monster"){

	$name = $_POST['name'];
	$size =$_POST['size'];
	$age = $_POST['age'];
	$family = $_POST['family'];//Contient un fam_id

	/*Image.
	$_FILES['image']['name']     //Le nom original du fichier, comme sur le disque du visiteur (exemple : mon_icone.png).
	$_FILES['image']['type']     //Le type du fichier. Par exemple, cela peut être « image/png ».
	$_FILES['image']['size']     //La taille du fichier en octets.
	$_FILES['image']['tmp_name'] //L'adresse vers le fichier uploadé dans le répertoire temporaire.
	$_FILES['image']['error']    //Le code d'erreur, qui permet de savoir si le fichier a bien été uploadé.
	
	*/
	  

	//Monstre.
	if( $family === "no_family"){
		echo'Veuillez <a href="addFamily.php">créer une famille</a>.';
	}

	if( (!empty($name)) && (!empty($size)) && (!empty($age)) && (!empty($family)) && ($family != "no_family") ){
		//On teste si un monstre portant le même nom, la même famille et résidant dans le même monde existe déja.
			$req="SELECT * FROM monsters WHERE mo_name = '".$name."' AND mo_familyID ='".$family."'";
			$result=$cnx->query($req);
			$count = $result->rowCount(); 
			
			if($count>0){
				echo  getFamilyName($family);
				echo'Un monstre existe déja sous ce nom: <b>'.$name.'</b> dans cette famille (<b>'.$family.'</b>).';
			}else{
				//Si il n'existe pas on l'insere alors dans la famille.
				$req="INSERT INTO monsters VALUES ('".$name."','".$family."','".$size."','".$age."');";
				$result=$cnx->exec($req);
				echo'Le monstre <b>"' .$name .'"</b> , à été ajouté dans la famille <b>"'.$family.'"</b>.';
			}
	}else{echo'Formulaire incomplet !';}
	$cnx = null; // Fermeture de la connexion
}

/*================================================ Get family ID */
function getFamilyID($family_name,$world_name){
	
		$req="SELECT * FROM family WHERE fam_name = '".$family_name."' AND fam_world = '".$world_name."' ;";
		$result=$cnx->query($req);
		$count = $result->rowCount(); 
		
		if($count>0){

			while($family = $result-> fetch(PDO::FETCH_ASSOC)){
				return $family['fam_id'];
			}
			
		}else{ echo'Aucune famille ne correspond à la recherche.';}
		
		
		$result->closeCursor();
		$cnx = null; // Fermeture de la connexion
}
/*================================================ Get family Name */
function getFamilyName($family_id){
	
		$req="SELECT * FROM family WHERE fam_id = '".$family_id."' ;";
		$result=$cnx->query($req);
		$count = $result->rowCount(); 
		
		if($count>0){

			while($family = $result-> fetch(PDO::FETCH_ASSOC)){
				return $family['fam_name'];
			}
			
		}else{ echo'Aucune famille ne correspond à la recherche.';}
		
		
		$result->closeCursor();
		$cnx = null; // Fermeture de la connexion
}
?>
