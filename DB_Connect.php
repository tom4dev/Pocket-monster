<?php
	
$login = 'root';
$mdp = 'root';
$bdd = 'mysql:host=localhost;dbname=pocketMonster';
try {
	$cnx = new PDO($bdd, $login, $mdp);
}
catch (PDOException $error) {
	die("Erreur de connexion : " . $error->getMessage() );
}


 
?>
