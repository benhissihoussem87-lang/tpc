<?php
class Borderos{
public function __construct()
	{
		$this->connexion=new PDO('mysql:host=localhost;dbname=sigma','root','');
	}

	public function getborderos()
	{
	  $sql="select * from  bordero";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function getdetailBorderau($op)
	{
	  $sql="select * from  bordero where code_op='$op' ";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function getborderosAO($AO)
	{
	   $sql="select * from  bordero where code_op='$AO'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	public function deleteBorderoFacture($facture,$autre)
	{
	  $sql="delete from  bordero where code_op='$facture' and AutreFacture='$autre'";
	  
		$req=$this->connexion->prepare($sql);
		$res=$req->execute();
		if($res) return true;
		else return false;
	}
	
	public function getFactureAO($id,$AO)
	{
	  $sql="select * from  factures where id='$id' and codeAO='$AO'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function getAutreFactureAO($id,$AO)
	{
	 $sql="select * from  factures_news where id='$id' and codeAO='$AO'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	
	
	public function ajoutBordero($mdo,$code,$bordero_type,$article1,$prix1,$article2,$prix2,$article3,$prix3,$article4,$prix4,$article5,$prix5,$article6,$prix6,$article7,$prix7,$article8,$article9,$article10,$article11,$article12,$article13,$article14,$article15,$article16,$article17,$article18,$article19,$article20,$qt1,$qt2,$qt3,$qt4,$qt5,$qt6,$qt7,$qt8,$qt9,$qt10,$qt11,$qt12,$qt13,$qt14,$qt15,$qt16,$qt17,$qt18,$qt19,$qt20)
	{
	  
	 $sql="insert into  bordero values('','$mdo','$code','$bordero_type','$article1','$prix1','$article2','$prix2','$article3','$prix3','$article4','$prix4','$article5','$prix5','$article6','$prix6','$article7','".$_POST['prix7']."','$article8','".$_POST['prix8']."','$article9','".$_POST['prix9']."','$article10','".$_POST['prix10']."','$article11','".$_POST['prix11']."','$article12','".$_POST['prix12']."','$article13','".$_POST['prix13']."','$article14','".$_POST['prix14']."','$article15','".$_POST['prix15']."','$article16','".$_POST['prix16']."','$article17','".$_POST['prix17']."','$article18','".$_POST['prix18']."','$article19','".$_POST['prix19']."','$article20','".$_POST['prix20']."','".$_POST['qte1']."','".$_POST['qte2']."','".$_POST['qte3']."','".$_POST['qte4']."','".$_POST['qte5']."','".$_POST['qte6']."','".$_POST['qte7']."','".$_POST['qte8']."','".$_POST['qte9']."','".$_POST['qte10']."','".$_POST['qte11']."','".$_POST['qte12']."','".$_POST['qte13']."','".$_POST['qte14']."','".$_POST['qte15']."','".$_POST['qte16']."','".$_POST['qte17']."','".$_POST['qte18']."','".$_POST['qte19']."','".$_POST['qte20']."','Null')";
		$req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	}
	
	
	public function ajoutBorderoFacture($mdo,$code,$bordero_type,$article1,$prix1,$article2,$prix2,$article3,$prix3,$article4,$prix4,$article5,$prix5,$article6,$prix6,$article7,$prix7,$autre)
	{
	  
		 $sql="insert into  bordero(`mdo`,`code_op`, `type`, `article1`, `prix1`, `article2`, `prix2`, `article3`, `prix3`, `article4`, `prix4`, `article5`, `prix5`, `article6`, `prix6`, `article7`, `prix7`,AutreFacture)
  		values('$mdo','$code','$bordero_type','$article1','$prix1','$article2','$prix2','$article3','$prix3','$article4','$prix4','$article5','$prix5','$article6','$prix6','$article7','$prix7','$autre')";
          $req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	}
	public function ajoutBorderoFactureAutre($mdo,$code,$bordero_type,$article1,$prix1,$article2,$prix2,$article3,$prix3,$article4,$prix4,$article5,$prix5,$article6,$prix6,$article7,$prix7)
	{
	  
		 $sql="insert into  bordero(`mdo`,`code_op`, `type`, `article1`, `prix1`, `article2`, `prix2`, `article3`, `prix3`, `article4`, `prix4`, `article5`, `prix5`, `article6`, `prix6`, `article7`, `prix7`,`AutreFacture`)
  		values('$mdo','$code','$bordero_type','$article1','$prix1','$article2','$prix2','$article3','$prix3','$article4','$prix4','$article5','$prix5','$article6','$prix6','$article7','$prix7','AutreF')";
          $req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	}
		public function ModifierBorderaux($article1,$article2,$article3,$article4,$article5,$article6,$article7,$article8,$article9,$article10,$article11,$article12,$article13,$article14,$article15,$article16,$article17,$article18,$article19,$article20,$AO,$id)
	{
		@ $sql="UPDATE `bordero` SET `mdo`='".$_POST['mdo']."' , `type`='".$_POST['bordero_type']."', `article1`='$article1', `prix1`='".$_POST['prix1']."', `article2`='$article2', `prix2`='".$_POST['prix2']."', `article3`='$article3', `prix3`='".$_POST['prix3']."', `article4`='$article4',  `prix4`='".$_POST['prix4']."', `article5`='$article5', `prix5`='".$_POST['prix5']."', `article6`='$article6', `prix6`='".$_POST['prix6']."', `article7`='$article7', `prix7`='".$_POST['prix7']."', `article8`='$article8',`prix8`='".$_POST['prix8']."', `article9`='$article9', `prix9`='".$_POST['prix9']."',`article10`='$article10', `prix10`='".$_POST['prix10']."',`article11`='$article11',`prix11`='".$_POST['prix11']."',`article12`='$article12',`prix12`='".$_POST['prix12']."',`article13`='$article13',`prix13`='".$_POST['prix13']."',`article14`='$article14',`prix14`='".$_POST['prix14']."',`article15`='$article15',`prix15`='".$_POST['prix15']."',`article16`='$article16',`prix16`='".$_POST['prix16']."',`article17`='$article17',`prix17`='".$_POST['prix17']."',`article18`='$article18',`prix18`='".$_POST['prix18']."',`article19`='$article19',`prix19`='".$_POST['prix19']."',`article20`='$article20',`prix20`='".$_POST['prix20']."',`qte1`='".$_POST['qte1']."',`qte2`='".$_POST['qte2']."',`qte3`='".$_POST['qte3']."',`qte4`='".$_POST['qte4']."',`qte5`='".$_POST['qte5']."',`qte6`='".$_POST['qte6']."',`qte7`='".$_POST['qte7']."',`qte8`='".$_POST['qte8']."',`qte9`='".$_POST['qte9']."',`qte10`='".$_POST['qte10']."',`qte11`='".$_POST['qte11']."',`qte12`='".$_POST['qte12']."',`qte13`='".$_POST['qte13']."',`qte14`='".$_POST['qte14']."',`qte15`='".$_POST['qte15']."',`qte16`='".$_POST['qte16']."',`qte17`='".$_POST['qte17']."',`qte18`='".$_POST['qte18']."',`qte19`='".$_POST['qte19']."',`qte20`='".$_POST['qte20']."' ,`code_op`='$AO' where id='$id'";
		$req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	}
	
	public function ModifierBorderauxFacture($mdo,$code,$bordero_type,$article1,$prix1,$article2,$prix2,$article3,$prix3,$article4,$prix4,$article5,$prix5,$article6,$prix6,$article7,$prix7,$facture,$autre)
	{
		echo $sql="UPDATE `bordero` SET `mdo`='$mdo' , `type`='$bordero_type', `article1`='$article1', `prix1`='$prix1', `article2`='$article2', `prix2`='$prix2', `article3`='$article3', `prix3`='$prix3', `article4`='$article4',  `prix4`='$prix4', `article5`='$article5', `prix5`='$prix5', `article6`='$article6', 
		`prix6`='$prix6', `article7`='$article7', `prix7`='$prix7',AutreFacture='$autre' where code_op='$facture'";
		$req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	}
	public function detailbordero($id)
	{
	  $sql="select * from bordero where id='$id'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function getborderoOP($op)
	{
	  $sql="select * from bordero where code_op='$op'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	

	public function deleteSortie($id)
	{
	 $sql="delete from sortie where id='$id'";
	 $req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	 
	}
	
	public function getborderosAjax($mdo)
	{
	
	$sql="select * from bordero where mdo='$mdo' and type='consultation' and code_op!='00000' order By id Desc limit 1";
	  $req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	  
	  }
	  public function getborderosAjaxExpertise($mdo)
	{
	
	  $sql="select * from bordero where mdo='$mdo' and type='expertise' and code_op!='00000' order By id Desc limit 1";
	  $req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	  
	  }
	  
	  	public function getborderosPonct($test)
	{
	
	    $sql="select * from bordero where code_op='$test' limit 7";
	  $req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	  
	  }
	  
	  	public function VerifborderosPonct($facture)
	{
	
	  $sql="select * from bordero where code_op='$facture' limit 7";
	  $req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	  
	  }
	  
	  public function getborderosAjaxPonctuel($code)
	{
	
	  $sql="select * from bordero where code_op='$code'";
	  $req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	  
	  }
	
	
}