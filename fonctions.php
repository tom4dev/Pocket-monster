<?php
//Connection à la Base de donnée.
include('DB_Connect.php');

//Récuperation du nom de la fonction à traiter.
$fonction = $_POST['fonction'];

/*###### Obtenir les familles ######*/

if( $fonction === "get_family" ){
	

		$req="SELECT * FROM family;";
		$result=$cnx->query($req);

		

		if($result){
			while($family = $result-> fetch(PDO::FETCH_ASSOC)){
				echo '<option value="'.$family['fam_name'].'">'.ucfirst($family['fam_name']).'</option>';
			}
			
		}else{ echo'<option value="no_family"> Pas de famille </option>';}
		
		
		$result->closeCursor();
		$cnx = null; // Fermeture de la connexion
}



/*###### Ajout famille ######*/
if( $fonction === "add_family"){
	
	
	$name = $_POST['name'];
	$world =$_POST['world'];
	$nbMax = $_POST['nbMax'];

	//Test pour vérifier que le formulaire est complet
	if( (!empty($name)) && (!empty($world)) && (!empty($nbMax)) ){
		
			//On teste si une famille portant le même nom et résidant dans le même monde existe déja.
			$req="SELECT * FROM family WHERE fam_name = '".$name."'";
			$result=$cnx->query($req);
			$count = $result->rowCount(); 
			
			if($count>0){
				echo'Une famille existe déja sous ce nom: <b>'.$name.'</b> dans ce monde (<b>'.$world.'</b>).';
			}else{
				//Si elle n'existe pas on insere alors la nouvelle famille.
				$req="INSERT INTO family VALUES ('".$name."','".$world."','".$nbMax."');";
				$result=$cnx->exec($req);
				echo'La famille <b>"' .$name .'"</b> pouvant contenir <b>'.$nbMax.' membres</b>, à été ajouté dans le monde <b>"'.$world.'"</b>.';
			}
	}
	else{echo'Formulaire incomplet !';}
	$cnx = null; // Fermeture de la connexion

}


/*###### Ajout monstre ######*/
if( $fonction === "add_monster"){

	$name = $_POST['name'];
	$size =$_POST['size'];
	$age = $_POST['age'];
	$family = $_POST['family'];

	if( (!empty($name)) && (!empty($size)) && (!empty($age)) && (!empty($family)) ){
		//On teste si un monstre portant le même nom, de la même famille et résidant dans le même monde existe déja.
			$req="SELECT * FROM monsters WHERE mo_name = '".$name."' AND mo_family ='".$family."'";
			$result=$cnx->query($req);
			$count = $result->rowCount(); 
			
			if($count>0){
				echo'Une monstre existe déja sous ce nom: <b>'.$name.'</b> dans cette famille (<b>'.$family.'</b>).';
			}else{
				//Si il n'existe pas on l'insere alors dans la famille.
				$req="INSERT INTO monsters VALUES ('".$name."','".$family."','".$size."','".$age."');";
				$result=$cnx->exec($req);
				echo'Le monstre <b>"' .$name .'"</b> , à été ajouté dans la famille <b>"'.$family.'"</b>.';
			}
	}else{echo'Formulaire incomplet !';}
	$cnx = null; // Fermeture de la connexion
}

?>
