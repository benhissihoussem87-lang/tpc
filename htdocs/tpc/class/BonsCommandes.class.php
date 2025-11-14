<?php
include_once 'connexion.db.php';
class BonsCommandes{
	private $cnx;
	public function __construct(){$this->cnx=connexion();}
	
	
	public function Ajout($num_bon_commande,$date_bon_commande,$client,$piece_jointe,$num_bon_commandeClient){
	  	echo $sql="insert into bon_commande values('','$num_bon_commande','$date_bon_commande','$client','$piece_jointe','$num_bon_commandeClient')";
		 $result=$this->cnx->exec($sql);
		 if($result)return true;
		 else return false;
		
	}
	public function detailBC($BC){
	  	 $sql="select * from  bon_commande where num_bon_commande ='$BC'";
		$req=$this->cnx->query($sql);
		$resultat=$req->fetch();
		return $resultat;
		
	}
	public function Modifier($date_bon_commande,$piece_jointe,$num_bon_commandeClient,$client,$id){
	  	echo $sql="update  bon_commande set `date_bon_commande`='$date_bon_commande',`piecejointe`='$piece_jointe',`num_bon_commandeClient`='$num_bon_commandeClient',`client`='$client' where num_bon_commande ='$id'";
		 $result=$this->cnx->exec($sql);
		 if($result)return true;
		 else return false;
		
	}
	
	public function ModifierBonCommandeFacture($date_bon_commande,$piece_jointe,$num_bon_commandeClient,$id){
	  	echo $sql="update  bon_commande set `date_bon_commande`='$date_bon_commande',`piecejointe`='$piece_jointe',`num_bon_commandeClient`='$num_bon_commandeClient' where num_bon_commande ='$id'";
		 $result=$this->cnx->exec($sql);
		 if($result)return true;
		 else return false;
		
	}
	
	
	public function getAll(){
		 $sql="SELECT * FROM bon_commande as bd ";
		$req=$this->cnx->query($sql);
		$resultat=$req->fetchAll();
		return $resultat;
	}
	
	public function getBonCommandes_Client($client){
		 $sql="SELECT * FROM bon_commande where client='$client' ";
		$req=$this->cnx->query($sql);
		$resultat=$req->fetchAll();
		return $resultat;
	}
	
	public function getInfosFactureByBonCommande($facture){
		 $sql="SELECT * FROM facture as f,clients as clt where f.num_fact='$facture' and f.client=clt.id ";
		$req=$this->cnx->query($sql);
		$resultat=$req->fetchAll();
		//echo $resultat;
		return $resultat;
	}
	public function getInfosClient($idClient){
		 $sql="SELECT * FROM clients where id='$idClient' ";
		$req=$this->cnx->query($sql);
		$resultat=$req->fetch();
		//echo $resultat;
		return $resultat;
	}
/******************************** Archive ::::: **************/
public function AjoutArchive($num_bon_commande,$date_bon_commande,$client,$piece_jointe,$num_bon_commandeFournisseur){
		 $sql="insert into archivebon_commande values('','$num_bon_commande','$date_bon_commande','$client','$piece_jointe','$num_bon_commandeFournisseur')";
		 $result=$this->cnx->exec($sql);
		 if($result)return true;
		 else return false;
		
	}	
public function getAllARchive(){
		 $sql="SELECT * FROM archivebon_commande as ABC,clients as clt where ABC.client=clt.id ";
		$req=$this->cnx->query($sql);
		$resultat=$req->fetchAll();
		return $resultat;
	}
	
public function getDetailBonCommandeByNumFacture($numBonCommande){
		 $sql="SELECT * FROM bon_commande  where num_bon_commande ='$numBonCommande' ";
		$req=$this->cnx->query($sql);
		$resultat=$req->fetch();
		return $resultat;
	}
	
	public function deleteBonCommande($bc){
		echo $sql="delete from bon_commande where num_bon_commande  ='$bc' ";
		 $result=$this->cnx->exec($sql);
		 if($result)return true;
		 else return false;
		
	}
}
$bonCommande=new BonsCommandes();


