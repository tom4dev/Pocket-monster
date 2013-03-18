<?php


/* Classe world.
* par Thomas BRODUSCH
*Test Stagiaire - SOIXANTECIRCUITS
* Mars 2013
*/



class world{

	var $name;
	
	
//////////////	Constructeur.
function world($name) {  
  		$this->name =$name; 
		
		
}

function getName() {
	return $this->name;
}




function show_radio(){
	echo ucfirst($this->getName()).'<input type="radio" name="world" value="'.$this->getName().'"/> ';
}

function show_select(){
	echo '<option value="'.$this->getName().'">'.ucfirst($this->getName()).'</option>';
}
}

	
?>
