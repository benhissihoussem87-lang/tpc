<?php
class Deps{
public function __construct()
	{
		$this->connexion=new PDO('mysql:host=localhost;dbname=sigma','root','');
	}

	public function getdep()
	{
	  $sql="select * from dep ORDER BY DATE DESC limit 1";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function getRec_Deps()
	{
	  $sql="select * from dep where RAISON='Salaire' or RAISON='Frais'  ";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	public function getInfosDetailAO($code)
	{
	   $sql="select * from dep where code='$code'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function getHonoAO($codeAO)
	{
	   $sql="select * from dep where code='$codeAO'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function detailAO($id)
	{
	  $sql="select * from dep where id='$id'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function getdeps()
	{
	  //$sql="select * from dep order by DATE desc";
	  $sql = "SELECT `id`,`DATE`,`DATE` as `DATE_dep`,`Montant`,`Beneficiare`,`RAISON`,`typeuser`, (select sum(IF(`RAISON`='Alimentation Caisse', `Montant`, -`Montant`)) from `dep` where `DATE` <= `DATE_dep`) as `journal_caisse` FROM `dep` order by DATE desc";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	public function getdepsSommePermanent($date)
	{
	  $sql="select DATE,SUM(permanent)  AS sommeP from dep where TIMEDIFF(DATE,$date)<0";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	public function getTotaldeps()
	{
	  $sql="select DATE,journal_caisse,MAX(DATE) AS Maxdate from dep GROUP BY DATE desc  ";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function getdepsUtilisateur()
	{
	  $sql="select * from dep where typeuser='utilisateur'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}

	
	public function ajout_dep($journal_caisse)
	{
		 $sql="insert into dep(`DATE`, `Montant`, `Beneficiare`, `RAISON`, `typeuser`,`journal_caisse`) values('".$_POST['DATE']."','".$_POST['montant']."', '".$_POST['BENEFICIARE']."','".$_POST['RAISON']."','".$_SESSION['user']."','$journal_caisse')";
		$req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	}
	public function Modifierdep($id)
	{
	 if(isset($_POST['user']))
	{
	 $sql="update dep set DATE='".$_POST['DATE']."',montant='".$_POST['montant']."' , `Beneficiare`='".$_POST['BENEFICIARE']."',`num_CHQ`='".$_POST['num_CHQ']."',`RAISON`='".$_POST['RAISON']."',`typeuser`='".$_SESSION['user']."' where id='$id'";
	}
	else{
	$sql="update dep set DATE='".$_POST['DATE']."',montant='".$_POST['montant']."' , `Beneficiare`='".$_POST['BENEFICIARE']."',`num_CHQ`='".$_POST['num_CHQ']."',`RAISON`='".$_POST['RAISON']."' where id='$id'";
	}


	$req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	}
	public function ModifierJournalCaisse($id,$journal)
	{
	
	 $sql="update dep set permanent='$journal' where id='$id'";
	

	$req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	}
	public function getDetaildep($id)
		{
		  $sql="select * from dep where id='$id'";
		  
			$req=$this->connexion->query($sql);
			while($res=$req->fetch(PDO::FETCH_ASSOC))
			{
				@$data[]=$res;
				
			}
			return @$data;
		}

   public function deletedep($id)
	{
	 $sql="delete from dep where id='$id'";
	 $req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	 
	}
	
	
}