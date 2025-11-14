<?php
class ponctuels{
public function __construct()
	{
		$this->connexion=new PDO('mysql:host=localhost;dbname=sigma','root','');
	}

	public function getponctuel()
	{
	$sql="select * from ponctuel";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	
	
		public function getMDOPONCTAjax()
	{
	if(isset($_GET['codeP']))
	{
	  $sql="select * from ponctuel where code='".$_GET['codeP']."'";
	  }
	  else if(isset($_GET['projetP']))
	{
	  $sql="select * from ponctuel where projet='".$_GET['projetP']."'";
	  }
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function getDernierponctuel()
	{
	 $sql="select * from ponctuel order By code Desc limit 1";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	public function VerifCodePonctuel($codeP)
	{
	   $sql="select * from ponctuel where code='$codeP' ";
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function getPonctuelsAjax()
	{
	if(isset($_GET['codeP']))
	{
	  $sql="select * from ponctuel where code='".$_GET['codeP']."'";
	  }
	  else if(isset($_GET['projetP']))
	{
	  $sql="select * from ponctuel where projet='".$_GET['projetP']."'";
	  }
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	public function AfficherArrivesPonctuel($code)
	{
	  @ $sql="select * from arrives where code='$code'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	public function getPonctuelOP($OP)
	{
	  $sql="select * from ponctuel where code_offre='$OP' ";
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function getInfosDetailAO($code)
	{
	   $sql="select * from ponctuel where code='$code'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function ModifierEtatOffre($id)
	{
	   $sql="select * from ponctuel where id='$id'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function getCodeOffre($code)
	{
	   $sql="select * from offres where code='$code'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function EditEtatOffre($code)
	{
	   $sql="update offres set etat='1' where code='$code'";
	  
		$req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	}
		public function getPonctuelsResultat()
	{
	   $sql="select * from ponctuel ";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	public function Partenaires()
	{
	   $sql="select * from partenaires where type='PARTICULIER'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function PartenairesVis_a_vis()
	{
	   $sql="select * from partenaires where type='vis_a_vis'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	
	public function getHonoAO($codeAO)
	{
	   $sql="select * from ponctuel where code='$codeAO'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function detailAO($id)
	{
	  $sql="select * from ponctuel where id='$id'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function getPonctuels()
	{
	  $sql="select * from ponctuel ORDER BY code DESC" ;
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	public function getRecouvrement()
	{
	   $sql="select * from rec_p ";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
public function getRecouvrementsRecp($code)
	{
		if(isset($_POST['AfficherFactureImpaye']))
				 { $sql="select * from rec_p where code='$code'and RECOUV=''  ";}
		else { $sql="select * from rec_p where code='$code' ";}
	  
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function ajout($projet)
	{
	 
		 $sql="insert into ponctuel(`num`, `code`, `mdo`, `projet`, `vis_a_vis`, `lot`, `honoraire`, `av`, `arr`, `mission`, `date`, `v_estime`, `dem`, `v_fait`) values('".$_POST['num']."','".$_POST['code']."','".$_POST['mdo']."','$projet','".$_POST['vis_a_vis']."','".$_POST['lot']."',
		'".$_POST['honoraire']."','".$_POST['av']."','".$_POST['arr']."','".$_POST['mission']."','".$_POST['Date_AVIS']."','".$_POST['V_ESTIMEES']."','".$_POST['dem']."','".$_POST['V_FAITES']."')";
		$req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	}
	public function ModifierPonctuel($id,$projet,$code)
	{
	   $sql="update ponctuel set code='$code', mdo='".$_POST['mdo']."',projet='$projet' , `vis_a_vis`='".$_POST['vis_a_vis']."',`lot`='".$_POST['lot']."',`av`='".$_POST['av']."',`arr`='".$_POST['arr']."',honoraire='".$_POST['honoraire']."',`mission`='".$_POST['mission']."',`date`='".$_POST['Date_AVIS']."',`v_estime`='".$_POST['V_ESTIMEES']."',`dem`='".$_POST['dem']."', 
	 `v_fait`='".$_POST['V_FAITES']."' where id='$id'";
	 // Pour Modifier Facture 
	  $sqlF="UPDATE `factures` SET `mdo`='".$_POST['mdo']."',`titre`='$projet',`intitule`='$projet' where
               codeProjet='$code'	  ";
		$reqF=$this->connexion->prepare($sqlF);
		$testF=$reqF->execute();
		$req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	}
	public function getDetailPonctuel($id)
	{
	  $sql="select * from ponctuel where id='$id'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	
	
	
	public function deletePonctuel($id)
	{
	 $sql="delete from ponctuel where id='$id'";
	 $req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	 
	}
	public function getDetailPonctuelD($id)
	{
	  $sql="select * from ponctuel where id='$id'";
	$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	 
	}
	public function getDetailRecouvrement($code)
	{
	 $sql="delete from rec_p where code='$code'";
	 $req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	 
	}
	public function getDetailFacture($code)
	{
	 $sql="delete from factures where codeProjet='$code'";
	 $req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	 
	}
	public function deleteBorderaux($AO)
	{
	 $sql="delete from bordero where code_op='$AO'";
	 $req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	 
	}
	
	public function getBorderoAO($OP)
	{
	 $sql="select * from bordero where code_op='$OP'";
	 $req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	 
	}
}