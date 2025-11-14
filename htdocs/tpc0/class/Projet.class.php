<?php
include_once 'connexion.db.php';
class Projets{
	private $cnx;
	public function __construct(){$this->cnx=connexion();}
	
	
	
	// Afficher Projets 
	public function getAllProjets(){
		$sql="SELECT * FROM projet";
		$req=$this->cnx->query($sql);
		$resultat=$req->fetchAll();
		return $resultat;
	}
	
	
}
$projet=new Projets();


