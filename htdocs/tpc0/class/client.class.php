<?php
include_once 'connexion.db.php';
class Clients{
	private $cnx;
	public function __construct(){$this->cnx=connexion();}
	
	// Ajout Client
	public function Ajout($type,$convention,$pieceConvention,$nom,$code,$adresse,$matriculeFiscale,$exonoration,$pieceExonoration,$tel,$email,$numExonoration,$ValiditeExonoration){
		
	   	$sql="insert into clients values('','$type','$convention','$pieceConvention','$nom','$code','$adresse','$matriculeFiscale','$exonoration','$pieceExonoration','$tel','$email','$numExonoration','$ValiditeExonoration')";
		
		 $result=$this->cnx->exec($sql);
		 if($result) return true;
		 else return false;
		
	}
	
	// Afficher Clients 
	public function getAllClients(){
		$sql="SELECT * FROM clients";
		$req=$this->cnx->query($sql);
		$resultat=$req->fetchAll();
		return $resultat;
	}
	
	
	// Afficher code dernier client  
	public function getDernierCodeClient(){
		 $sql="SELECT * FROM clients order By id desc limit 1";
		$req=$this->cnx->query($sql);
		$resultat=$req->fetch();
		return $resultat;
	}
	// delete Client 
	public function deleteClient($id){
		$sql="delete FROM clients where id='$id'";
		 $result=$this->cnx->exec($sql);
		 if($result) return true;
		 else return false;
	}

    // Client By Id
	public function getClient($id){
		  $sql="SELECT * FROM clients where id='$id' ";
		$req=$this->cnx->query($sql);
		$resultat=$req->fetch();
		return $resultat;
	}
	
	
  // Modifier Client
    
	public function Modifier($type,$convention,$piececonvention,$nom,$code,$adresse,$matriculeFiscale,$exonoration,$pieceExonoration,$tel,$email,$numexonoration,$ValiditeExonoration,$id){
		
   $sql="update clients  SET `type_client`='$type' ,`convention`='$convention',
 `pieceConvention`='$piececonvention',`nom_client`='$nom', `code_client`='$code', `adresse`='$adresse', `matriculeFiscale`='$matriculeFiscale', `exonoration`='$exonoration', `pieceExonoration`='$pieceExonoration',`tel`='$tel',`email`='$email',`numexonoration`='$numexonoration',`ValiditeExonoration`='$ValiditeExonoration' WHERE id='$id'";
		
		 $result=$this->cnx->exec($sql);
		 if($result) return true;
		 else return false;
		
	}  
	
	// Get Mes Offres  
	
	public function getOffresClient($client){
		  $sql="SELECT * FROM offre_prix as ofP where  Ofp.client='$client'";
		$req=$this->cnx->query($sql);
		$resultat=$req->fetchAll();
		return $resultat;
	}
	// Afficher Projets 
	public function getAllProjetsByOffre($offre){
		$sql="SELECT * FROM offres_projets as OP,projet as p where OP.offre='$offre' and p.id=OP.projet";
		$req=$this->cnx->query($sql);
		$resultat=$req->fetchAll();
		return $resultat;
	}
	
 public function getClientByNom($nom){
		$sql="SELECT * FROM clients where nom_client ='$nom' ";
		$req=$this->cnx->query($sql);
		$resultat=$req->fetch();
		return $resultat;
	}
	// Afficher Clients 
	public function RapportClient($client){
		 $sql="SELECT * FROM facture as f, facture_projets as FP,projet as p where f.client=$client  and FP.facture=f.num_fact and p.id=FP.projet";
		$req=$this->cnx->query($sql);
		$resultat=$req->fetchAll();
		return $resultat;
	}
	
	public function RapportClientArchive($client){
		 $sql="SELECT * FROM archivefacture as f where f.client=$client ";
		$req=$this->cnx->query($sql);
		$resultat=$req->fetchAll();
		return $resultat;
	}
	
 
}
$clt=new Clients();


