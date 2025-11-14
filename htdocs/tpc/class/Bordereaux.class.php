<?php
include_once 'connexion.db.php';
class Bordereaux{
	private $cnx;
	public function __construct(){$this->cnx=connexion();}
	
	
	public function Ajout($numbordereau,$date,$num_fact,$piece_jointe,$type,$adresse){
		echo $sql="insert into bordereaux values('','$numbordereau','$date','$num_fact','$piece_jointe','$type','$adresse')";
		 $result=$this->cnx->exec($sql);
		 if($result)return true;
		 else return false;
		
	}
	
	public function getAll(){
		 $sql="SELECT * FROM facture ";
		$req=$this->cnx->query($sql);
		$resultat=$req->fetchAll();
		return $resultat;
	}
	
	public function getAllFacturesBordereaux($numBordereau){
		 $sql="SELECT * FROM bordereaux as bd where bd.num_fact='$numBordereau'";
		$req=$this->cnx->query($sql);
		$resultat=$req->fetchAll();
		return $resultat;
	}
	public function GetInfosBordereau($numBordereau){
		 $sql="SELECT * FROM bordereaux where num_bordereaux='$numBordereau'";
		$req=$this->cnx->query($sql);
		$resultat=$req->fetch();
		return $resultat;
	}
  public function Modifier($Idbordereau,$bordereau,$date,$type){
		echo $sql="UPDATE `bordereaux` SET pieces_jointe='$bordereau',date='$date',type='$type' where num_bordereaux ='$Idbordereau'  ";
		 $result=$this->cnx->exec($sql);
		 if($result)return true;
		 else return false;
		
	}
	
	public function ModifierBordereau($Idbordereau,$bordereau,$date,$type,$adresse,$facture,$num_bordereaux){
		  $sql="UPDATE `bordereaux` SET pieces_jointe='$bordereau',date='$date',type='$type',adresse_bordereaux='$adresse',num_fact='$facture',num_bordereaux='$num_bordereaux' where id ='$Idbordereau'  ";
		 $result=$this->cnx->exec($sql);
		 if($result)return true;
		 else return false;
		
	}
/******************************** Archive ::::: **************/
public function AjoutArchive($numbordereau,$date,$num_fact,$piece_jointe){
		  $sql="insert into archive_bordereaux values('','$numbordereau','$date','$num_fact','$piece_jointe')";
		 $result=$this->cnx->exec($sql);
		 if($result)return true;
		 else return false;
		
	}	
public function getAllARchive(){
		 $sql="SELECT * FROM archive_bordereaux as bd,archivefacture as f where bd.num_fact=f.num_fact";
		$req=$this->cnx->query($sql);
		$resultat=$req->fetchAll();
		return $resultat;
	}
	
public function detailBordereau($num){
		 $sql="SELECT * FROM bordereaux as b,facture as f,clients as clt where b.num_bordereaux='$num' and f.num_fact=b.num_bordereaux and f.client=clt.id    ";
		$req=$this->cnx->query($sql);
		$resultat=$req->fetchAll();
		return $resultat;
	}
public function detailBordereauById($id){
		 $sql="SELECT * FROM bordereaux where id='$id'  ";
		$req=$this->cnx->query($sql);
		$resultat=$req->fetch();
		return $resultat;
	}
}
$bordereau=new Bordereaux();


