<?php


/* Classe family.
* par Thomas BRODUSCH
*Test Stagiaire - SOIXANTECIRCUITS
* Mars 2013
*/



class family{

	var $name;
	var $world;
	var $nbMax;

//////////////	Constructeur.
function family($name,$world,$nbMax) {  
  		$this->name = $name; 
		$this->world = $world;  
		$this->nbMax = $nbMax;    
 		 
	 }  

function getName(){
	return $this->name;
}

function getID(){
	return ucfirst($this->getName()).ucfirst($this->getWorld());
}

function getWorld(){
	return $this->world;


}
function get_NbFamilyMembers()	{
	include('DB_Connect.php');

	$req="SELECT * FROM monsters WHERE mo_family = '".$this->getID()."' ;";
	$result=$cnx->query($req);
	$count = $result->rowCount(); 
				
		 return $count;

}

function  get_NbMaxFamily()	{
	include('DB_Connect.php');

	$req="SELECT * FROM family WHERE fam_id ='".$this->getID()."' ;";
	$result=$cnx->query($req);
		
	while($family = $result->fetch(PDO::FETCH_ASSOC)){
		$nbMaxFamily = $family['fam_nbMax'];
		return $nbMaxFamily;		
	}
	
	
}


function getDescription(){
	echo '<div class="span5" id="family"> 
				<img src="http://www.sacre-coeur-tourcoing.net/divers/media/blogs/LittSoc2/Famille%20monstre.JPG" width=50% height=50%/>
				<p>'.ucfirst($this->getName()).'</p>
				
				</div>';
}

function getSelect(){
	echo' <option value="'.$this->getID().'">'.ucfirst($this->getName()).' - '.ucfirst($this->getWorld()).' ( '.$this->get_NbFamilyMembers().'/'.$this->get_NbMaxFamily().' )</option>';
		
	

}
}




?>

