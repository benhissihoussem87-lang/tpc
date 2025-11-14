<?php
class Projets{
public function __construct()
	{
		$this->connexion=new PDO('mysql:host=localhost;dbname=sigma','root','');
	}

	public function getProjets()
	{
	  $sql="select * from projet ORDER BY id DESC limit 1";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function getProjetsINfo($projet)
	{
	  $sql="select * from projet where code_projet='$projet'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function getDernierSousProjet($projet)
	{
	  $sql="select * from  sous_projet ORDER BY id DESC limit 1";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function getSousProjets($projet)
	{
	if($projet!=null)
	{
	 $sql="select * from  sous_projet where codeP='$projet'";
	  }
	  else{
	  	 $sql="select * from  sous_projet";
	  }
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	public function getSousProjetsModif($projet)
	{
	 $sql="select * from  sous_projet";
	 
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function getSOUSProjetsAjax()
	{
	if(isset($_GET['code']))
	{
	  $sql="select * from projet where code_projet='".$_GET['code']."'";
	  $req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	}
	  
	  public function RechercheAjaxSP()
	{
	if(isset($_GET['code_sp']))
	{
	  $sql="select * from sous_projet where code_sous_P='".$_GET['code_sp']."'";
	  $req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	}
	
	public function getProjetsAjax()
	{
	if(isset($_GET['code']))
	{
	  $sql="select * from projet where code_projet='".$_GET['code']."'";
	  }
	  else if(isset($_GET['projet']))
	{
	  $sql="select * from projet where titre='".$_GET['projet']."'";
	  }
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	public function getProjetsAjaxSP()
	{
	if(isset($_GET['code']))
	{
	  $sql="select * from sous_projet where codeP='".$_GET['code']."'";
	  }
	 
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function AfficherProjet()
	{
	  $sql="select * from projet ORDER BY code_projet DESC";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	public function AfficherProjetSP($code)
	{
	  $sql="select * from projet where code_projet='$code' ORDER BY code_projet DESC ";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function AfficherMDOProjet()
	{
	  $sql="select distinct(mdo) from projet ";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function AfficherProjetMDO($mdo)
	{
	
	  $sql="select * from projet where mdo='$mdo' ORDER BY code_projet DESC";
	  
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	//Afficher Sous Projet
	
	public function SousProjet($projet)
	{
	  $sql="select * from sous_projet where  codeP='$projet'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function ARVSP($sp)
	{
	  $sql="select * from arrives where  code_sousprojet='$sp'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	public function AfficherSPProjets($code_sp)
	{
	  $sql="select * from sous_projet where  code_sous_P='$code_sp'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function AfficherArrivesProjet($code)
	{
	  @$sql="select * from arrives where code='$code'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	public function AfficherDernierArrivesProjet($code)
	{
	  $sql="select * from arrives where code='$code' ORDER BY id DESC limit 1";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	public function AfficherCR_visiteProjet($code)
	{
	  $sql="select * from cr_visite where code='$code'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function AfficherSortiesProjet($code)
	{
	  $sql="select * from sortie where code='$code'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function AfficherSortiesSP($sp)
	{
	  $sql="select * from sortie where codesp='$sp'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function getInfosProjet($code)
	{
	  $sql="select * from projet where code_projet='$code' ORDER BY code_projet DESC";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function getInfosProjets($titre)
	{
	 $sql="select * from projet where titre='$titre' ORDER BY code_projet DESC";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	public function AfficherProjets()
	{
	  $sql="select * from projet ORDER BY code_projet DESC";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	

	public function getProjetsOP($OP)
	{
	  $sql="select * from projet where code_AO='$OP' ORDER BY code_projet DESC ";
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function ajoutProjet($code_AO,$type,$mdo,$titre,$date_limite,$date_decharge,$cout,$hono,$intitule,$pourcentage,$rp_rd,$code_projet,$etat)
	{
		 $sql="insert into projet (`code_AO`, `type`,  `mdo`, `titre`, `date_limite`, `date_decharge`, `cout`, `hono`, `intitule`, `pourcentage`, `rp_rd`, `code_projet`,`etat_p`)
		values('$code_AO','$type','$mdo','$titre','$date_limite','$date_decharge','$cout','$hono','$intitule','$pourcentage','$rp_rd','$code_projet','$etat')";
		$req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	}
	public function detailProjet($id)
	{
	  $sql="select * from projet where id='$id'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	
	public function getNBVSOP($op)
	{
	  $sql="select * from offres where code='$op'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function getNBVSP($sp)
	{
	  $sql="select * from cr_visite where codesp='$sp'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	
	public function ModifierProjet($id,$titre,$intitule,$bc)
	{
	  $sql="update projet set code_projet='".$_POST['code_projet']."',etat_p='".$_POST['etat_p']."' ,titre='$titre',intitule='$intitule', `dem`='".$_POST['dem']."', 
		`mdo`='".$_POST['mdo']."',`date_B_C`='".$_POST['date_BC']."',`date_receptionBC`='".$_POST['date_receptionBC']."',`BC`='$bc',`rp`='".$_POST['rp']."',`rd`='".$_POST['rd']."' ,observation='".$_POST['observation']."' where id='$id'";
		$req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	}
	public function deleteProjet($id)
	{
	 $sql="delete from projet where id='$id'";
	 $req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	 
	}
	
	public function deleteSousProjet($codesp)
	{
	  $sqlSP="delete from sous_projet where code_sous_P='$codesp'";
	   $sqlAR="delete from arrives where code_sousprojet='$codesp'";
	   $sqlSR="delete from sortie where codesp='$codesp'";
	     $sqlCRE="delete from cr_visite where codesp='$codesp'";
		
	 $req1=$this->connexion->prepare($sqlSP);
	 $req2=$this->connexion->prepare($sqlAR);
	 $req3=$this->connexion->prepare($sqlSR);
	 $req4=$this->connexion->prepare($sqlCRE);
		$test1=$req1->execute();
		$test2=$req2->execute();
		$test3=$req3->execute();
		$test4=$req4->execute();
		if($test1 and $test2 and $test3 and $test4)
		return true;
		else return false;
	 
	}
	
	public function AjoutSousProjet($codeP,$code_sous_P,$mdo,$titre,$etat,$titre_sous_projet,$date_rp,$date_rd,$demarrage,$observation)
	{
	
	 $sql="INSERT INTO `sous_projet`(`codeP`, `code_sous_P`, `mdo`, `titre`, `etat`, `titre_sous_projet`, `date_rp`, `date_rd`, `demarrage`, `observation`) values ('$codeP','$code_sous_P','$mdo','$titre','$etat','$titre_sous_projet','$date_rp','$date_rd','$demarrage','$observation')";
	
	$req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	 
	}
	
	public function deleteArrive($projet)
	{
	 $sql="delete from arrives where code='$projet'";
	 
	 $req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	 
	}
	public function deleteSPProjet($projet)
	{
	 $sql="delete from sous_projet where codeP='$projet'";
	 
	 $req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	 
	}
	public function deleteFactureProjet($projet)
	{
	 $sql="delete from  factures where codeProjet='$projet'";
	 
	 $req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	 
	}
	public function deleteSortie($projet)
	{
	 $sql="delete from sortie where code='$projet'";
	 
	 $req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	 
	}
	
	public function ViderCodeProjet_AO($codeAO)
	{
	 $sql="update offres set etat='1'  where code='$codeAO'";
	 
	 $req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	 
	}
	public function deleteCRV($projet)
	{
	 $sql="delete from cr_visite where code='$projet'";
	 
	 $req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	}
	
	public function GetFacturesProjet($code_projet)
	{
	  $sql="select * from factures where  codeProjet='$code_projet'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	public function GetFacturesNewsProjet($code_projet)
	{
	   $sql="select * from factures_news where  codeProjet='$code_projet'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	
}