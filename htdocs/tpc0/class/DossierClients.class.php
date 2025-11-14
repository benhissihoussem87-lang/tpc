<?php
include_once 'connexion.db.php';
class DossierClients{
	private $cnx;
	public function __construct(){$this->cnx=connexion();}
	
	// Ajout Dossier
	public function Ajout($dossierTechnique,$dossierFournie,$typePiecesDossierFournie,$client){
		
	  echo	$sql="insert into dossiersclients values('','$dossierTechnique','$dossierFournie','$typePiecesDossierFournie','$client')";
		
		 $result=$this->cnx->exec($sql);
		 if($result) return true;
		 else return false;
	}
	// Afficher Dossier 
	public function getAllDossierClients(){
		$sql="SELECT * FROM dossiersclients as dclient,clients as clt where dclient.client_id=clt.id";
		$req=$this->cnx->query($sql);
		$resultat=$req->fetchAll();
		return $resultat;
	}
}
$dossierClient=new DossierClients();


