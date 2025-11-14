<?php
class Factures{
public function __construct()
	{
		$this->connexion=new PDO('mysql:host=localhost;dbname=sigma','root','');
	}
	
	public function getdernierFacture()
	{
	  $sql="select * from factures ORDER BY annee DESC,numFacture DESC limit 1";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	
	/**Factures New ****/
	/**factures_news New ****/
	public function getdernierFactureNew()
	{
	   $sql="select * from factures_news ORDER BY annee DESC,numFacture DESC limit 1";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	/**factures_news New ****/
	public function getQtes($codeAO)
	{
	   $sql="select * from factures where codeAO='$codeAO'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	public function getQtesFNews($codeAO)
	{
	   $sql="select * from factures_news where codeAO='$codeAO'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	// Suppression de Facture et ajout dans table factures_news
	public function deplacerFacture($titre,$intitule,$num,$annee)
	{
	
		
	if(isset($_POST['tva']))
		{
		$tva=1;
		}
		else
		{
		$tva=1.13;
		}
	@ $mantant=(($_POST['prix1']*$_POST['qte1'])+($_POST['prix2']*$_POST['qte2'])+($_POST['prix3']*$_POST['qte3'])+($_POST['prix4']*$_POST['qte4'])+($_POST['prix5']*$_POST['qte5'])
	 +($_POST['prix6']*$_POST['qte6'])+($_POST['prix7']*$_POST['qte7'])+($_POST['prix8']*$_POST['qte8'])+($_POST['prix9']*$_POST['qte9'])+($_POST['prix10']*$_POST['qte10'])+
	 ($_POST['prix11']*$_POST['qte11'])+($_POST['prix12']*$_POST['qte12'])+
	 ($_POST['prix13']*$_POST['qte13'])+($_POST['prix14']*$_POST['qte15'])+
	 ($_POST['prix16']*$_POST['qte16'])+($_POST['prix17']*$_POST['qte17'])+
	 ($_POST['prix18']*$_POST['qte18'])+($_POST['prix19']*$_POST['qte19'])+
	 ($_POST['prix20']*$_POST['qte20']))*$tva;
 $sql="INSERT INTO `factures_news`( `numFacture`,`annee`,`codeAO`, `codeProjet`, `mdo`, `titre`, `intitule`, `mantant`, `avancement`, `facture`, `envoye`, `recouvre`, `qte1`, `qte2`, `qte3`, `qte4`, `qte5`, `qte6`, `qte7`, `qte8`, `qte9`, `qte10`, `qte11`, `qte12`, `qte13`, `qte14`, `qte15`, `qte16`, `qte17`, `qte18`, `qte19`,`qte20`, `lien`, `observation`)
		 VALUES('$num','$annee','".$_POST['code']."','".$_POST['code_projet']."','".$_POST['mdo']."','$titre','$intitule','".$mantant."','".$_POST['etat']."','".$_POST['dateFacture']."','".$_POST['dateEnvoi']."','".$_POST['dateRecouvrement']."','".$_POST['qte1']."','".$_POST['qte2']."','".$_POST['qte3']."','".$_POST['qte4']."','".$_POST['qte5']."','".$_POST['qte6']."','".$_POST['qte7']."','".$_POST['qte8']."','".$_POST['qte9']."','".$_POST['qte10']."','".$_POST['qte11']."','".$_POST['qte12']."','".$_POST['qte13']."','".$_POST['qte14']."','".$_POST['qte15']."','".$_POST['qte16']."','".$_POST['qte17']."','".$_POST['qte18']."','".$_POST['qte19']."','".$_POST['qte20']."','".$_FILES['facture']['name']."','".$_POST['observation']."')";
		$req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	}
	
	
	
	/*******Fin Traitement Facture News******/
		public function getResFacture()
	{
	  $sql="select * from factures ";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	public function VerifAO($Ao)
	{
	    $sql="select * from offres where type='$Ao' ";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	public function VerifTypeAO($Ao)
	{
	   $sql="select * from offres where code='$Ao' ";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function AfficherFactureMDO($mdo)
	{
	
	   $sql="select * from factures where mdo='$mdo' ORDER BY id DESC";
	  
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function VerifFacturesExistes($num,$annee)
	{
	
	   $sql="select * from factures where numFacture='$num' and annee='$annee'";
	  
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	public function getRecouvreProjet($projet)
	{
	  $sql="select * from factures where codeProjet='$projet'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	public function getRecouvreProjetNews($projet)
	{
	  $sql="select * from factures_news where codeProjet='$projet'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function AjoutFacture($titre,$intitule) 
	{
		$nums=explode("/",$_POST['numfacture']);
		$num=$nums[0];$annee=$nums[1];
		// TVA Calcul selon annee
		if($annee<2023){$tva=1.13;}
		else if($annee>=2023){$tva=1.19;}
	// Fin Calcul dselon annee
		if(empty($_POST['pourcentage'])){
	
	@ $mantant=(($_POST['prix1']*$_POST['qte1'])+($_POST['prix2']*$_POST['qte2'])+($_POST['prix3']*$_POST['qte3'])+($_POST['prix4']*$_POST['qte4'])+($_POST['prix5']*$_POST['qte5'])
	 +($_POST['prix6']*$_POST['qte6'])+($_POST['prix7']*$_POST['qte7'])+($_POST['prix8']*$_POST['qte8'])+($_POST['prix9']*$_POST['qte9'])+($_POST['prix10']*$_POST['qte10'])+
	 ($_POST['prix11']*$_POST['qte11'])+($_POST['prix12']*$_POST['qte12'])+
	 ($_POST['prix13']*$_POST['qte13'])+($_POST['prix14']*$_POST['qte14'])+($_POST['prix15']*$_POST['qte15'])+
	 ($_POST['prix16']*$_POST['qte16'])+($_POST['prix17']*$_POST['qte17'])+
	 ($_POST['prix18']*$_POST['qte18'])+($_POST['prix19']*$_POST['qte19'])+
	 ($_POST['prix20']*$_POST['qte20']))*$tva;
@$sql="INSERT INTO `factures`( `numFacture`,`annee`,`codeAO`, `codeProjet`, `mdo`, `titre`, `intitule`, `mantant`, `avancement`, `facture`, `envoye`, `recouvre`, `qte1`, `qte2`, `qte3`, `qte4`, `qte5`, `qte6`, `qte7`, `qte8`, `qte9`, `qte10`, `qte11`, `qte12`, `qte13`, `qte14`, `qte15`, `qte16`, `qte17`, `qte18`, `qte19`,`qte20`, `lien`, `observation`)
		 VALUES('$num','$annee','".$_POST['code']."','".$_POST['code_projet']."','".$_POST['mdo']."','$titre','$intitule','".$mantant."','".$_POST['etat']."','".$_POST['dateFacture']."','".$_POST['dateEnvoi']."','".$_POST['dateRecouvrement']."','".$_POST['qte1']."','".$_POST['qte2']."','".$_POST['qte3']."','".$_POST['qte4']."','".$_POST['qte5']."','".$_POST['qte6']."','".$_POST['qte7']."','".$_POST['qte8']."','".$_POST['qte9']."','".$_POST['qte10']."','".$_POST['qte11']."','".$_POST['qte12']."','".$_POST['qte13']."','".$_POST['qte14']."','".$_POST['qte15']."','".$_POST['qte16']."','".$_POST['qte17']."','".$_POST['qte18']."','".$_POST['qte19']."','".$_POST['qte20']."','".$_FILES['facture']['name']."','".$_POST['observation']."')";
	}
	// si le pourcentage est rempli
	else {
		$pourcentage=$_POST['pourcentage']/100;
		$montant=$_POST['montantFacturePourcentage']*$tva;
		@$sql="INSERT INTO `factures`( `numFacture`,`annee`,`codeAO`, `codeProjet`, `mdo`, `titre`, `intitule`, `mantant`, `avancement`, `facture`, `envoye`, `recouvre`, `designation`,`pourcentage`, `lien`, `observation`)
		 VALUES('$num','$annee','".$_POST['code']."','".$_POST['code_projet']."','".$_POST['mdo']."','$titre','$intitule','".$montant."','".$_POST['etat']."','".$_POST['dateFacture']."','".$_POST['dateEnvoi']."','".$_POST['dateRecouvrement']."','".$_POST['designation']."','".$_POST['pourcentage']."','".$_FILES['facture']['name']."','".$_POST['observation']."')";
	}
		$req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	}
public function ModifierFacture($id,$numFacture,$annee,$date,$recouvrement,$envoye,$lien,$observation) 
	{
	/*if(isset($_POST['tva']))
		{
		$tva=1;
		}
		else
		{
		$tva=1.13;
		}*/
	if($annee<2023){$tva=1.13;}
	else if($annee>=2023){$tva=1.19;}
		
	 @ $mantant=(($_POST['prix1']*$_POST['qte1'])+($_POST['prix2']*$_POST['qte2'])+($_POST['prix3']*$_POST['qte3'])+($_POST['prix4']*$_POST['qte4'])+($_POST['prix5']*$_POST['qte5'])
	 +($_POST['prix6']*$_POST['qte6'])+($_POST['prix7']*$_POST['qte7'])+($_POST['prix8']*$_POST['qte8'])+($_POST['prix9']*$_POST['qte9'])+($_POST['prix10']*$_POST['qte10'])+
	 ($_POST['prix11']*$_POST['qte11'])+($_POST['prix12']*$_POST['qte12'])+
	 ($_POST['prix13']*$_POST['qte13'])+($_POST['prix14']*$_POST['qte14'])+($_POST['prix15']*$_POST['qte15'])+
	 ($_POST['prix16']*$_POST['qte16'])+($_POST['prix17']*$_POST['qte17'])+
	 ($_POST['prix18']*$_POST['qte18'])+($_POST['prix19']*$_POST['qte19'])+
	 ($_POST['prix20']*$_POST['qte20']))*$tva;
	// if(empty($_POST['pourcentage'])){
		  $sql="UPDATE `factures` SET `numFacture`='$numFacture',`annee`='$annee',`mantant`='$mantant',`facture`='$date',`envoye`='$envoye',`recouvre`='$recouvrement',`qte1`='".$_POST['qte1']."',`qte2`='".$_POST['qte2']."',`qte3`='".$_POST['qte3']."',`qte4`='".$_POST['qte4']."',`qte5`='".$_POST['qte5']."',`qte6`='".$_POST['qte6']."',`qte7`='".$_POST['qte7']."',`qte8`='".$_POST['qte8']."',`qte9`='".$_POST['qte9']."',
		`qte10`='".$_POST['qte10']."',`qte11`='".$_POST['qte11']."',`qte12`='".$_POST['qte12']."',`qte13`='".$_POST['qte13']."',`qte14`='".$_POST['qte14']."' ,`qte15`='".$_POST['qte15']."',`qte16`='".$_POST['qte16']."',`qte17`='".$_POST['qte17']."',`qte18`='".$_POST['qte18']."',`qte19`='".$_POST['qte19']."' ,`qte20`='".$_POST['qte20']."',`lien`='$lien', `designation`='".$_POST['designation']."' ,`pourcentage`='".$_POST['pourcentage']."',`observation`='$observation' where `id`='$id' ";
	/* }
	 else {
		 $montant=$_POST['montantFacturePourcentage']*1.13;
		 $sql="UPDATE `factures` SET `numFacture`='$numFacture',`annee`='$annee',`mantant`='$montant',`facture`='$date',`envoye`='$envoye',`recouvre`='$recouvrement',`designation`='".$_POST['designation']."' ,`pourcentage`='".$_POST['pourcentage']."',`lien`='$lien' where `id`='$id' ";
	 }*/
		$req=$this->connexion->prepare($sql);
		$test=$req->execute();
  // ***************  Modification RecpFacture **************** //
     if(!empty($_POST['dateRecouvrement'])){$ing='T.S';}
		  else {$ing='';}
	 $sqlRecp="update rec_p set  ing='$ing',`RECOUV`='$mantant',`date`='".$_POST['dateRecouvrement']."' where FACTURE='".$_POST['numfacture']."'";
		$reqRecp=$this->connexion->prepare($sqlRecp);
		$testRecp=$reqRecp->execute();
		if($test) return true;
		else return false;
	}
	
public function getFacture()
	{
	/**where codeAO!='Ponct'***/
	  $sql="select * from factures ORDER BY annee DESC,numFacture DESC";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function getFactureImpayes()
	{
	/**where codeAO!='Ponct'***/
	  $sql="select * from factures where recouvre=''";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	public function getQtesFacturesPonctuel($num,$annee)
	{
	/**where codeAO!='Ponct'***/
	  $sql="select * from factures where numFacture='$num' and annee='$annee'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	public function getdetailFacture($id)
	{
	 $sql="select * from factures where id='$id'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	public function getClientMdoFacture($mdo)
	{
	 $sql="select * from partenaires where designation='$mdo'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function getdetailBrdFacture($AO,$facture)
	{
	  $sql="select * from bordero where code_op='$AO' or code_op='$facture'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	public function getMDOFacture($mdo)
	{
	  $sql="select * from partenaires where designation='$mdo' and type='MDO'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
		public function getBCFacture($projet)
	{
	  $sql="select * from projet where code_projet='$projet'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function getInfosFacture($id)
	{
	  $sql="select * from factures where id='$id'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function getInfosFactureNews($id)
	{
	  $sql="select * from factures_news where id='$id'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
		
	public function getInfosFactureRC($rcp)
	{
	  $sql="select * from rec_p where code='$rcp'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function getMDOAO($ao)
	{
	  $sql="select * from offres where code='$ao'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	

	public function deletefactures($id,$numFacture) 
	{
	 
		  $sql="delete from `factures`  where `id`='$id' ";
		    $sqlRecp="delete from `rec_p`  where `FACTURE`='$numFacture' ";
		$req=$this->connexion->prepare($sql);
		$test=$req->execute();
		$reqRecp=$this->connexion->prepare($sqlRecp);
		$reqRecp->execute();
		if($test) return true;
		else return false;
	}
	
	
	public function deleteBorderoFacture($codeOP) 
	{
	 
		  $sql="delete from `bordero`  where `code_op`='$codeOP' ";
		$req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	}
	public function deleteRCP($facture) 
	{
	 
		
		  $sql="delete from `rec_p`  where `FACTURE`='$facture' ";
		$req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	}
	public function deleteBordereauxfactures($facture) 
	{
	 
		  $sql="delete from `bordero`  where `code_op`='$facture' ";
		$req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	}
	
	public function ModifierRecPFacture($facture,$recouv,$date)
	{
	echo $sql="update rec_p set  `RECOUV`='$recouv',`date`='$date' where FACTURE='$facture'";
		$req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	}
	
	
}