<?php


/* Classe monstre.
* par Thomas BRODUSCH
*Test Stagiaire - SOIXANTECIRCUITS
* Mars 2013
*/



class monster{

	var $name;
	var $family;
	var $size;
	var $age;
	var $image;
//////////////	Constructeur.
function monster($name,$family,$size,$age,$image) {  
  		$this->name = $name;
		$this->image = $image; 
		$this->family = $family;  
		$this->size = $size; 
		$this->age = $age;   
 		 
	 }  


function getName(){
	return $this->name;
}

function getImage(){
	echo '<img src="../img/monsters/'.$this->image.'" width=200px height=200px />';
}
function getThumbnail(){
	return '<img src="../img/monsters/'.$this->image.'" width=50px height=50px />';
}
function getFamily(){
	return $this->family;
}

function getSize(){
	return $this->size;
}

function getAge(){
	return $this->age;
}


function getDescription(){
	echo '<h3>Infos Monstre:</h3><p> <b> Famille:</b> '.ucfirst($this->getFamily()).'<br/>
		<b> Nom:</b> '.ucfirst($this->getName()).'<br/>
		<b> Taille:</b> '.ucfirst($this->getSize()).' cm<br/>
		<b> Age:</b> '.ucfirst($this->getAge()).' ans<br/>
		
	</p>';
}
function show(){
	echo '<div class="span4" id="monster"> <p>'.$this->getThumbnail().'</p><p>'.$this->getName().'</p>
				
				</div>';
}
}

?>
