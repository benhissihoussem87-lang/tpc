<?php
class Rec_ponctuel{
public function __construct()
	{
		$this->connexion=new PDO('mysql:host=localhost;dbname=sigma','root','');
	}

	public function afficher()
	{
	  $sql="select * from rec_p ORDER BY id DESC limit 1";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	public function deletefacturesRecP($id,$numFacture) 
	{
	 
		  $sql="delete from `factures`  where `numFacture`='$numFacture' ";
		    $sqlRecp="delete from `rec_p`  where `id`='$id' ";
		$req=$this->connexion->prepare($sql);
		$test=$req->execute();
		$reqRecp=$this->connexion->prepare($sqlRecp);
		$reqRecp->execute();
		if($test) return true;
		else return false;
	}
	public function deleteAutrefacturesRecP($id,$numFacture) 
	{
	 
		  $sql="delete from `factures_news`  where `numFacture`='$numFacture' ";
		    $sqlRecp="delete from `rec_p`  where `id`='$id' ";
		$req=$this->connexion->prepare($sql);
		$test=$req->execute();
		$reqRecp=$this->connexion->prepare($sqlRecp);
		$reqRecp->execute();
		if($test) return true;
		else return false;
	}
	public function getRec_PonctuelsResultat()
	{
	  $sql="select * from rec_p ";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	public function getRecouvImpayes()
	{
	/**where codeAO!='Ponct'***/
	  $sql="select * from rec_p where RECOUV=''";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	public function getRecP_Projet($id,$numFacture)
	{
	    $sql="select * from rec_p where id='$id' and num='$numFacture' ";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	public function getMdo()
	{
	  $sql="select * from partenaires where type='PARTICULIER'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
        }
		return @$data;
	}
	public function getFacture()
	{
	 $sql="select * from factures ORDER BY annee DESC,numFacture DESC limit 1";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
        }
		return @$data;
	}
	public function getAutreFacture()
	{
	  $sql="select * from factures_news ORDER BY annee DESC,numFacture DESC limit 1";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
        }
		return @$data;
	}
	
	public function getponctuel($code)
	{
	    $sql="select * from ponctuel where code='$code'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function getHonoAO($codeAO)
	{
	   $sql="select * from rec_p where code='$codeAO'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	public function getRecouvrement($codeR)
	{
	   $sql="select * from rec_p where code='$codeR'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	public function detailRecouvrement($id)
	{
	  $sql="select * from rec_p where id='$id'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	public function getRecouvrementPonctuel($code)
	{
	    $sql="select * from rec_p where code='$code'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	public function getrec_ps()
	{
	  $sql="select * from rec_p";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}

	
	public function ajout($projet,$num,$annee)
	{
	   if($_POST['facture']!='non')
	  {
		  $op=$_GET['OP'];
		  if($op==null)
		  {
			  $op='Ponct';
		  }
		  else{
			 $op= $_GET['OP'];
		  }
		  if(isset($_POST['btnfacture'])){
		 if($_POST['btnfacture']=='oui')
		  { 
		  if(!empty($_POST['date'])){$dateF=$_POST['date'];$ing='T.S';}
		  else {$dateF=date('Y-m-d');$ing='';}
	   $sqlR="insert into factures(`numFacture`,`annee`, `codeAO`, `codeProjet`, `mdo`, `titre`, `intitule`,  `recouvre`,`facture`, `envoye`,`mantant`) values('$num','$annee','$op','".$_POST['code']."','".$_POST['mdo']."', '$projet','$projet','".$_POST['date']."','$dateF','$dateF','".$_POST['recouv']."')"; 
	  
	    $sql="insert into rec_p values('','".$_POST['num']."','".$_POST['code']."','".$_POST['mdo']."','$projet','".$_POST['vis_a_vis']."','".$_POST['honoraire']."','".$_POST['comm']."','$ing','".$_POST['facture']."','".$_POST['recouv']."','".$_POST['date']."')";
		  }
		  else if($_POST['btnfacture']=='ouiAutre')
		  { 
	  $ftAutre=$_POST['Autrefacture'].'Autre';
	   $sqlR="insert into factures_news(`numFacture`,`annee`, `codeAO`, `codeProjet`, `mdo`, `titre`, `intitule`, `mantant`, `facture`, `envoye`) values('$num','$annee','$op','".$_POST['code']."',
	  '".$_POST['mdo']."','$projet','$projet','".$_POST['recouv']."','".$_POST['date']."','".$_POST['date']."')"; 
	  
	   @$sql="insert into rec_p values('','".$_POST['num']."','".$_POST['code']."','".$_POST['mdo']."','$projet','".$_POST['vis_a_vis']."','".$_POST['honoraire']."','".$_POST['comm']."','".$_POST['ing']."','$ftAutre','".$_POST['recouv']."','".$_POST['date']."')";
		  }
	  } // Fin isset $_POST['btnfacture']
	  else 
	  {
		 @ $sql="insert into rec_p values('','".$_POST['num']."','".$_POST['code']."','".$_POST['mdo']."','$projet','".$_POST['vis_a_vis']."','".$_POST['honoraire']."','".$_POST['comm']."','".$_POST['ing']."','".$_POST['Autrefacture']."','".$_POST['recouv']."','".$_POST['date']."')"; 
	  }
	    }
		
		@$req=$this->connexion->prepare($sql);
		@$recouv=$this->connexion->prepare($sqlR);
		$recouv->execute();
		$test=$req->execute();
		if($test) return true;
		else return false;
	}
	
	public function ajoutRecPPonct($num,$code,$mdo,$projet,$vis_a_vis,$honoraire)
	{
	 @ $sql="INSERT INTO `rec_p`(`num`, `code`, `mdo`, `projet`, `vis_a_vis`, `HONORAIRE`) values('$num','$code','$mdo','$projet','$vis_a_vis','$honoraire')";
		$req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	}
	
	public function Modifierrec_p($id)
	{
	 @ $sql="update rec_p set `COMM`=null, `ing`=null, `FACTURE`=null, `RECOUV`=null,`date`=null where id='$id'";
		$req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	}
	public function ModifierRecP($id,$comm,$ing,$recouv,$date)
	{
		$factureRecp=explode("/",$_POST['facture']);
		$numF=$factureRecp[0];$AnneeF=$factureRecp[1];
		//echo '<h1> '.$numF.' / // '.$AnneeF.'</h1>';
	$sql="update rec_p set `COMM`='$comm', `ing`='$ing', `RECOUV`='$recouv',`date`='$date' where id='$id'";
		$req=$this->connexion->prepare($sql);
		$test=$req->execute();
		// Modifier Facture
		$sqlF="update  factures set `recouvre`='$date' where numFacture='$numF' and  annee='$AnneeF'";
		$reqF=$this->connexion->prepare($sqlF);
		$testF=$reqF->execute();
		if($test) return true;
		else return false;
	}
	
	public function deleteFactureRec($code)
	{
	 $sql="delete from factures where codeProjet='$code'";
	 $req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	 
	}
	public function deleteAutreFactureRec($code)
	{
	 $sql="delete from  factures_news where codeProjet='$code'";
	 $req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	 
	}
	public function getDetailrec_p($id)
	{
	  $sql="select * from rec_p where id='$id'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	
	
	
	public function deleterec_p($id)
	{
	 $sql="delete from rec_p where id='$id'";
	 $req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	 
	}
	public function deleteBorderauxRecP($facture)
	{
	 $sql="delete from bordero where code_op='$facture'";
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