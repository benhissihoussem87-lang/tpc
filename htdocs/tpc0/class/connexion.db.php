<?php 
function connexion($user='root',$mdp=''){
		try {
	$dbh = new PDO('mysql:host=localhost;dbname=tpc',$user, $mdp) ;
	$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	//$this->connexionDb=$dbh;
	return $dbh;
	 }
	catch (PDOException $e) {
	echo "<h1>Erreur: ".$e->getMessage()."</h1>" ;
	die() ;
	}
		
	}
