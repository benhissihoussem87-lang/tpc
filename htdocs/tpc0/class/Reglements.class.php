<?php
include_once 'connexion.db.php';
class Reglements{
	private $cnx;
	public function __construct(){$this->cnx=connexion();}
	
	
	public function Ajout($client,$facture,$prix_ttc,$etat_reglement,$num_cheque,$date_cheque,$retenue_cheque,$reglementEspece,$montant,$dateReglement,$pieceRs){
		 $sql="insert into reglement values('','$client','$facture','$prix_ttc','$etat_reglement','$num_cheque','$date_cheque','$retenue_cheque','$reglementEspece','$montant','$dateReglement','$pieceRs')";
		 $result=$this->cnx->exec($sql);
		 if($result)return true;
		 else return false;
	}	
	
	public function getReglementByFacture($facture){
	   $sql="SELECT * FROM reglement  where id_reglement='$facture' or num_fact='$facture'";
		$req=$this->cnx->query($sql);
		$resultat=$req->fetch();
		return $resultat;
	}
	
	public function getAllReglement($reglement){
	   $sql="SELECT * FROM reglement  where num_fact='$reglement'";
		$req=$this->cnx->query($sql);
		$resultat=$req->fetchAll();
		return $resultat;
	}
	
	
	public function Modifier($facture,$prix_ttc,$etat_reglement,$num_cheque,$date_cheque,$retenue_cheque,$TypeReglement,$montant,$dateReglement,$pieceRs){
		@  $sql="UPDATE `reglement` SET prix_ttc='$prix_ttc',etat_reglement='$etat_reglement',num_cheque='$num_cheque',date_cheque='$date_cheque',retenue_date='$retenue_cheque',TypeReglement='$TypeReglement',montant='$montant',dateReglement='$dateReglement',pieceRs='$pieceRs' where num_fact ='$facture'  ";
		 $result=$this->cnx->exec($sql);
		 if($result)return true;
		 else return false;
		
	}
	
	
	public function getAll(){
		 $sql="SELECT * FROM facture as RG,clients as clt where RG.client=clt.id ";
		$req=$this->cnx->query($sql);
		$resultat=$req->fetchAll();
		return $resultat;
	}
/******************************** Archive ::::: **************/
public function AjoutArchive($client,$facture,$prix_ttc,$etat_reglement,$num_cheque,$date_cheque,$retenue_cheque,$reglementEspece,$pieceRs){
		echo $sql="insert into archive_reglement values('','$client','$facture','$prix_ttc','$etat_reglement','$num_cheque','$date_cheque','$retenue_cheque','$reglementEspece','$pieceRs')";
		 $result=$this->cnx->exec($sql);
		 if($result)return true;
		 else return false;
	}	
public function ModifierArchive($facture,$prix_ttc,$etat_reglement,$num_cheque,$date_cheque,$retenue_cheque,$TypeReglement,$pieceRs){
		@ $sql="UPDATE `archive_reglement` SET prix_ttc='$prix_ttc',etat_reglement='$etat_reglement',num_cheque='$num_cheque',date_cheque='$date_cheque',retenue_date='$retenue_cheque',TypeReglement='$TypeReglement',pieceRs='$pieceRs' where num_fact_archive ='$facture'  ";
		 $result=$this->cnx->exec($sql);
		 if($result)return true;
		 else return false;
		
	}
public function getAllARchive(){
		 $sql="SELECT * FROM archive_reglement as AR,clients as clt where AR.client=clt.id ";
		$req=$this->cnx->query($sql);
		$resultat=$req->fetchAll();
		return $resultat;
	}
	
	public function getArchiveReglementByFacture($facture){
	  	 $sql="SELECT * FROM archive_reglement  where  num_fact_archive ='$facture'";
		$req=$this->cnx->query($sql);
		$resultat=$req->fetch();
		return $resultat;
	}
}
$reglement=new Reglements();


