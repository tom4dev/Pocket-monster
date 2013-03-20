<?php
/*
Gestion de l'installation de la base de donnée.
Thomas BRODUSCH
Test Stagiaire - SOIXANTECIRCUITS
Mars 2013
*/


include('DB_Connect.php');

		$req1="CREATE TABLE IF NOT EXISTS  `essai`.`monsters` (
`mo_name` VARCHAR( 20 ) NOT NULL ,
`mo_family` VARCHAR( 40 ) NOT NULL ,
`mo_size` INT( 10 ) NOT NULL ,
`mo_age` INT( 10 ) NOT NULL ,
`mo_image` VARCHAR( 40 ) NOT NULL 
);";


		$req2="CREATE TABLE IF NOT EXISTS `essai`.`family` (
`fam_id` VARCHAR( 40 ) NOT NULL ,
`fam_name` VARCHAR( 20 ) NOT NULL,
`fam_world` VARCHAR( 20 ) NOT NULL,
`fam_nbMax` INT( 11 ) NOT NULL
);";

		$req3="CREATE TABLE IF NOT EXISTS `essai`.`world` (
`wo_name` VARCHAR( 40 ) NOT NULL
);";
		
	try{
	$cnx->exec($req1);
	//echo'- [INFOS]table monster installed - <br/>';
	$cnx->exec($req2);
	//echo'- [INFOS]table family installed - <br/>';
	$cnx->exec($req3);
	//echo'- [INFOS]table world installed - <br/><br/>';
	
	echo '</strong>La base de donnée est opérationnelle !</strong>';
	}
	catch (PDOException $error) {
	die("- Erreur lors de l'installation de la base de données: " . $error->getMessage() );
}	

?>
