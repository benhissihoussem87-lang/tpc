<?php
include_once 'connexion.db.php';
class Factures{
	private $cnx;
	public function __construct(){$this->cnx=connexion();}
	
	
	public function Ajout($num_fact,$client,$numboncommande,$date,$reglement){
		 $sql="insert into facture values('','$num_fact','$client','$numboncommande','$date','$reglement')";
		 $result=$this->cnx->exec($sql);
		 if($result)return true;
		 else return false;
		
	}
	public function getTypeFacture($facture){
		  $sql="SELECT * FROM facture_projets  where facture='$facture'";
		$req=$this->cnx->query($sql);
		$resultat=$req->fetchAll();
	
		return $resultat;
	}
	
	public function VerifFacturedansFacturesProjet($facture,$adresse){
		  $sql="SELECT * FROM facture_projets  where facture='$facture' and adresseClient='$adresse' ";
		$req=$this->cnx->query($sql);
		$resultat=$req->fetch();
	
		return $resultat;
	}
	
	public function getAdresseFactureByNumFacture($facture){
		  $sql="SELECT distinct(adresseClient) FROM facture_projets  where facture='$facture'";
		$req=$this->cnx->query($sql);
		$resultat=$req->fetchAll();
	
		return $resultat;
	}
/************ Modifier Adresse Facture ***************/
public function ModifierAdresseFacture($adresse,$nouveauAdresse,$numFacture){
		
		 $sql="update facture_projets set `adresseClient`='$nouveauAdresse' where adresseClient='$adresse' and facture='$numFacture'";
		 $result=$this->cnx->exec($sql);
		 if($result)return true;
		 else return false;
		
	}
	/************Ajout Archive Facture****/
	public function AjoutArchive($num_fact,$client,$date,$facture,$reglement,$typeReglement, $numcheque, $datecheque, $retenu,$projets){
		 $sql="insert into archivefacture values('','$num_fact','$client','$date','$facture','$reglement','$typeReglement', '$numcheque', '$datecheque', '$retenu','$projets')";
		 $result=$this->cnx->exec($sql);
		 if($result)return true;
		 else return false;
		
	}
	/*************** Modifier Facture  ***********************/
	public function Modifier($num_fact,$client,$numboncommande,$date,$reglement){
		
		 $sql="update facture set `client`='$client', `numboncommande`='$numboncommande',`date`='$date', `reglement`='$reglement' where num_fact='$num_fact'";
		 $result=$this->cnx->exec($sql);
		 if($result)return true;
		 else return false;
		
	}
	// Ajout Projets Factures
	public function AjoutProjets_Facture($facture,$prix_unitaire,$qte,$tva,$remise,$prixForfitaire,$prixTTC,$projet,$adresseClient){
		echo $sql="insert into  facture_projets values('','$facture','$prix_unitaire','$qte','$tva','$remise','$prixForfitaire','$prixTTC','$projet','$adresseClient')";
		 $result=$this->cnx->exec($sql);
		 if($result)return true;
		 else return false;
		
	}
	
	public function ModifierProjets_Facture($facture,$prix_unitaire,$qte,$tva,$remise,$prixForfitaire,$prixTTC,$projet,$adresseClient){
		 $sql="insert into  facture_projets values('','$facture','$prix_unitaire','$qte','$tva','$remise','$prixForfitaire','$prixTTC','$projet','$adresseClient')";
		 // Insert Offre Projet avec offre=$facture
		   $sqlAddOffreProjet="insert into  offres_projets values('','$facture','$prix_unitaire','$qte','$tva','$remise','$prixForfitaire','$prixTTC','$projet','$adresseClient')";
		   $this->cnx->exec($sqlAddOffreProjet);
		 $result=$this->cnx->exec($sql);
		 if($result)return true;
		 else return false;
		
	}
/******** Add Projet Pour Facture Archive **************/
public function AddProjetFactureArchive($id,$projets){
		
		 $sql="update archivefacture set `Projets`='$projets' where num_fact='$id'";
		 $result=$this->cnx->exec($sql);
		 if($result)return true;
		 else return false;
		
	}
	public function AfficherFactures(){
		 //$sql="SELECT * FROM facture as f,clients as clt,reglement as re where f.client=clt.id and re.num_fact =f.num_fact ";
		$sql="SELECT * FROM facture as f,clients as clt where f.client=clt.id ";
		$req=$this->cnx->query($sql);
		$resultat=$req->fetchAll();
		return $resultat;
	}
	
	public function GetReglementByFacture($facture){
		$sql="SELECT * FROM reglement where num_fact ='$facture' ";
		$req=$this->cnx->query($sql);
		$resultat=$req->fetch();
		return $resultat;
	}
	public function GetBonCommandeByFacture($facture){
		$sql="SELECT * FROM bon_commande where num_bon_commande  ='$facture' ";
		$req=$this->cnx->query($sql);
		$resultat=$req->fetch();
		return $resultat;
	}
	public function AfficherAllFactures(){
		 $sql="SELECT * FROM facture";
		$req=$this->cnx->query($sql);
		$resultat=$req->fetchAll();
		return $resultat;
	}
	
	public function GetNumFactures(){
		 $sql="SELECT * FROM facture order by num_fact desc limit 1";
		$req=$this->cnx->query($sql);
		$resultat=$req->fetch();
		return $resultat;
	}
	
	public function GetNumFacturesById($idFacture){
		  $sql="SELECT * FROM facture where id='$idFacture'";
		$req=$this->cnx->query($sql);
		$resultat=$req->fetch();
		return $resultat;
	}
	
	
	
	public function AfficherProjets_By_Facture($facture){
		  $sql="SELECT * FROM facture_projets as fP,projet as p where fP.projet=p.id and fP.facture='$facture'";
		$req=$this->cnx->query($sql);
		$resultat=$req->fetchAll();
		return $resultat;
	}
	
	
	 
	public function getAllFactures(){
		 $sql="SELECT * FROM facture as f,clients as clt,projet as p where f.client=clt.id";
		$req=$this->cnx->query($sql);
		$resultat=$req->fetchAll();
		return $resultat;
	}
	
	 
	public function getAllFacturesClient($client){
		 $sql="SELECT * FROM facture as f where  f.client='$client'";
		$req=$this->cnx->query($sql);
		$resultat=$req->fetchAll();
		return $resultat;
	}
	
	public function getLastFactureClient($client){
		 $sql="SELECT * FROM facture as f where  f.client='$client' Order by id desc limit 1";
		$req=$this->cnx->query($sql);
		$resultat=$req->fetch();
		return $resultat;
	}
	
	public function get_AllProjets_ByFacture($facture){
		 $sql="SELECT * FROM facture_projets as fP,projet as p where  fP.facture='$facture' and fP.projet=p.id order by fP.id_Projets_Facture ";
		$req=$this->cnx->query($sql);
		$resultat=$req->fetchAll();
		return $resultat;
	}
	
	public function get_All_AdressesClient_ProjetsFacture($facture){
		$sql="SELECT distinct(adresseClient) FROM facture_projets as fP where  fP.facture='$facture'  ";
		$req=$this->cnx->query($sql);
		$resultat=$req->fetchAll();
		return $resultat;
	}
// Delete Facture 

	public function deleteFacture($facture){
		 $sql="delete from facture where num_fact ='$facture'";
		 //Requete Delete Offre
		  $sqlDeleteOffre="delete from offre_prix where num_offre  ='$facture'";
		 $this->cnx->exec($sqlDeleteOffre);
		 $result=$this->cnx->exec($sql);
		 
		 if($result)return true;
		 else return false;
		
	}
	public function deleteFactureArchive($facture){
		 $sql="delete from archivefacture where num_fact ='$facture'";
		 //Requete Delete Offre
		  $sqlDeleteOffre="delete from offre_prix where num_offre  ='$facture'";
		 $this->cnx->exec($sqlDeleteOffre);
		 $result=$this->cnx->exec($sql);
		 
		 if($result)return true;
		 else return false;
		
	}
// Delete Projet Facture 

	public function deleteProjetFacture($id){
		  $sql="delete from facture_projets where id_Projets_Facture ='$id'";
		 $result=$this->cnx->exec($sql);
		 if($result)return true;
		 else return false;
		
	}
	
// Delete Facture By Adresse 

	public function deleteFactureByAdresse($facture,$adresse){
		  $sql="delete from facture_projets where facture ='$facture' and adresseClient='$adresse'";
		 $result=$this->cnx->exec($sql);
		 if($result)return true;
		 else return false;
		
	}
	
// Delete All Projet By Facture 

	public function delete_All_Projets_By_Facture($facture){
		  $sql="delete from facture_projets where facture='$facture'";
		// delete Offres_Projet by numFacture
		  $deleteOffreProjet="delete from offres_projets where offre='$facture'";
		$this->cnx->exec($deleteOffreProjet);
		 $result=$this->cnx->exec($sql);
		 if($result)return true;
		 else return false;
		
	}
	
	public function delete_All_Projets_By_FactureAndMultiAdress($facture,$adresse){
		echo  $sql="delete from facture_projets where facture='$facture' and adresseClient='$adresse'";
		// delete Offres_Projet by numFacture
		 echo $deleteOffreProjet="delete from offres_projets where offre='$facture' and adresseClient='$adresse'";
		$this->cnx->exec($deleteOffreProjet);
		 $result=$this->cnx->exec($sql);
		 if($result)return true;
		 else return false;
		
	}
// detail Facture 
public function detailFacture($numFacture){
		 $sql="SELECT * FROM facture as f,clients as clt where f.client=clt.id and f.num_fact='$numFacture'";
		$req=$this->cnx->query($sql);
		$resultat=$req->fetch();
		return $resultat;
	}
/*********** ******   Archive Facture :::::      *********/
/****************  Get Facture Archive******************/
		
			public function GetNumFacturesArchive(){
		 $sql="SELECT * FROM archivefacture order by id desc limit 1";
		$req=$this->cnx->query($sql);
		$resultat=$req->fetch();
		return $resultat;
	}
	public function AfficherFacturesArchives(){
		 $sql="SELECT * FROM archivefacture as f,clients as clt where f.client=clt.id";
		$req=$this->cnx->query($sql);
		$resultat=$req->fetchAll();
		return $resultat;
	}
	
/******** Facture reglement non**********************/
public function AfficherFacturesNonRegle(){
	 $sql="SELECT * FROM reglement as rg, facture as f,clients as clt where rg.client=clt.id  and rg.num_fact=f.num_fact and rg.etat_reglement='non' ";
		$req=$this->cnx->query($sql);
		$resultat=$req->fetchAll();
		return $resultat;
	}

}
$facture=new Factures();


