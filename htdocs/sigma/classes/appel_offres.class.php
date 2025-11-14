<?php
 class offres{
public function __construct()
	{
		$this->connexion=new PDO('mysql:host=localhost;dbname=sigma','root','');
	}

	public function getOffre()
	{
	   $sql="select * from offres ORDER BY id DESC limit 1";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	public function getTypeBorderaux($Ao)
	{
	  $sql="select * from bordero where code_op='$Ao' ";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function getTypeOffre($Ao)
	{
	  $sql="select * from offres where code='$Ao' ";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
		public function getMDOOffre($mdo)
	{
	  $sql="select * from partenaires where designation='$mdo'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
		public function getdetailOffre($id)
	{
	  $sql="select * from offres where id ='$id'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	public function getBorderoType()
	{
	  $sql="select * from bordero where code_op='00000'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	public function getInfosDetailAO($code)
	{
	   $sql="select * from offres where code='$code'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	public function getPartenairesMDO()
	{
	  $sql="select distinct(designation) from partenaires where type='MDO' or type='PARTICULIER'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function AfficherMDOoffre()
	{
	  $sql="select distinct(mdo) from offres ORDER BY code DESC";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function AfficherOffreMDO($mdo)
	{
	
	   $sql="select * from offres where mdo='$mdo' ORDER BY code DESC";
	  
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function getHonoAO($codeAO)
	{
	   $sql="select * from offres where code='$codeAO'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function detailAO($id)
	{
	  $sql="select * from offres where id='$id'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function detailBrd($op)
	{
	  $sql="select * from bordero where code_op='$op'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	public function getInfosAO($code)
	{
	  $sql="select * from offres where code='$code'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	public function getAppelOffre()
	{
	  $sql="select * from offres ORDER BY code DESC";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function getOffreEtat($etat)
	{
	  $sql="select * from offres where etat='$etat'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function getMaxCode()
	{
	  $sql="SELECT MAX(code) AS MaxCode FROM offres";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function getMaxCodeP()
	{
	  $sql="SELECT MAX(code_projet) AS MaxCodeP FROM projet";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function getAppelOffreStatistiqueAnne()
	{
	  $sql="select distinct(SUBSTR(code,1,2)) as code from offres";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function getAppelOffreStatistiqueTypeOffre()
	{
	  $sql="select distinct(type)from offres";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function getAppelOffreStatistiqueMois()
	{
	  $sql="select distinct(SUBSTR(date_limite,6,2)) as mois from offres";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function getAppelOffreStatistiqueMDO()
	{
	  $sql="select distinct(designation) from partenaires";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	public function getAppelOffrePonctuel($op)
	{
	  $sql="select * from  ponctuel where code_offre='$op' ";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	
	public function getProjetAO($AO)
	{
	  $sql="select * from projet where code_AO='$AO'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function DetailProjet($id)
	{
	  $sql="select * from offres where id='$id'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
		public function getOffreResultat()
	{
$sql="select * from offres where type='marche_public' or type='PUBLIC PONCTUEL'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	public function getOffreResultatHonoraireOffre()
	{
	$sql="select * from offres where etat='2'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	public function getOffreResultatEtat()
	{
	$sql="select * from offres where type='marche_public' or type='PUBLIC PONCTUEL'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function ResultatStatistique($anne,$mois,$mdo,$etat,$type)
	{
	 $sql="select * from offres where SUBSTR(code,1,2)='$anne' and SUBSTR(date_limite,6,2)='$mois' and mdo='$mdo' and etat='$etat' and type='$type'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}

	public function ajout($code,$type,$etat,$mdo,$titre,$date_limite,$date_decharge,$cout,$hono,$intitule,$pourcentage,$nb_vis,$rp_rd,$bordero,$observation,$vis_a_vis)
	{
	
	$sql="insert into offres values('','$code','$type','$etat','$mdo','$titre','$date_limite','$date_decharge','$cout','$hono','$intitule','$pourcentage','$nb_vis','$rp_rd','$bordero','$observation','".$_SESSION['user']."','$vis_a_vis')";
		$req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	}
	
	public function ModifierProjet($AO,$titre,$intitule,$mdo)
	{
	 $sql="update projet set titre='$titre',intitule='$intitule',`mdo`='$mdo' where code_AO='$AO'";
		$req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	}
	public function AjoutPonctuel($num, $code, $code_offre, $mdo, $projet, $vis_a_vis, $honoraire,$av,$arr, $v_estime)
	{
	 $sql="INSERT INTO `ponctuel`(`num`, `code`, `code_offre`, `mdo`, `projet`, `vis_a_vis`,  `honoraire`, `av`,`arr`,  `v_estime`) values('$num', '$code', '$code_offre', '$mdo', '$projet','$vis_a_vis',  '$honoraire','$av','$arr', '$v_estime')";
		$req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	}
	
	public function ModifierArrive($AO,$titre)
	{
	 $sql="update arrives set projet='$titre',`mdo`='".$_POST['mdo']."' where code='$AO'";
		$req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	}
	public function ModifierSortie($AO,$titre)
	{
	 $sql="update sortie set projet='$titre',`mdo`='".$_POST['mdo']."' where code='$AO'";
		$req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	}
	public function ModifierCRV($AO,$titre)
	{
	 $sql="update cr_visite set projet='$titre',`mdo`='".$_POST['mdo']."' where code='$AO'";
		$req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	}
	
	
	
	public function ModifierAO($id,$titre,$intitule,$vis_a_vis,$bordero)
	{

	if($_SESSION['user']=='utilisateur')
	 {
	  
	
		@  $sql="update offres set code='".$_POST['code']."',type='".$_POST['type']."',mdo='".$_POST['mdo']."',titre='$titre',date_limite='".$_POST['date_limite']."',date_decharge='".$_POST['date_decharge']."',cout='".$_POST['cout']."',bordero='$bordero',
		 hono='".$_POST['hono']."',intitule='$intitule',pourcentage='".$_POST['pourcentage']."',nb_vis='".$_POST['nb_vis']."',rp_rd='".$_POST['rp_rd']."',`Typeuser`='".$_SESSION['user']."',`vis_a_vis`='$vis_a_vis' where id='$id'";
		
		}
		else{
		
	  @ $sql="update offres set code='".$_POST['code']."',type='".$_POST['type']."',etat='".$_POST['etat']."',mdo='".$_POST['mdo']."',titre='$titre',date_limite='".$_POST['date_limite']."',date_decharge='".$_POST['date_decharge']."',cout='".$_POST['cout']."',bordero='$bordero',
		 hono='".$_POST['hono']."',intitule='$intitule',pourcentage='".$_POST['pourcentage']."',nb_vis='".$_POST['nb_vis']."',rp_rd='".$_POST['rp_rd']."',`Typeuser`='".$_SESSION['user']."',`vis_a_vis`='$vis_a_vis' where id='$id'";
		
		// Pour Modifier Facture 
	  $sqlF="UPDATE `factures` SET `mdo`='".$_POST['mdo']."',`titre`='$titre',`intitule`='$intitule' where
               codeAO='".$_POST['code']."'	  ";
		$reqF=$this->connexion->prepare($sqlF);
		$testF=$reqF->execute();
		
		}
		$req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	
	}
	
	public function deleteAO($id)
	{
	 $sql="delete from offres where id='$id'";
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