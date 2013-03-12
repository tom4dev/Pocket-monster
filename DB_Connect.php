<?php
/*
Gestion de la connection à la base de donnée.
Thomas BRODUSCH
Test Stagiaire - SOIXANTECIRCUITS
Mars 2013
*/	

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
