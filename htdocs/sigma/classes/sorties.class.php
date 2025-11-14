<?php
class SOrties{
public function __construct()
	{
		$this->connexion=new PDO('mysql:host=localhost;dbname=sigma','root','');
	}

	public function getSorties()
	{
	  $sql="select * from sortie ORDER BY date_sortie DESC";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	// *************************/

	/**********************************/
	public function getArrives_ST($projet)
	{
	   $sql="select * from sortie where lot_sortie='ST' and code='$projet'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function getArrives_EL($projet)
	{
	  $sql="select * from sortie where lot_sortie='EL' and code='$projet'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function getArrives_SI($projet)
	{
	  $sql="select * from sortie where lot_sortie='SI' and code='$projet'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function getArrives_FL($projet)
	{
	  $sql="select * from sortie where lot_sortie='FL' and code='$projet'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function getArrives_Autre($projet)
	{
	  $sql="select * from sortie where lot_sortie!='EL' and lot_sortie!='ST' and lot_sortie!='SI' and lot_sortie!='FL' and code='$projet'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	
	public function ajoutSortie($projet,$code,$codeSP)
	{
	  if($_POST['lot']=='Autre')
	  {
	    if(empty($_POST['autre']))
		{
		$lot=$_POST['lot'];
		}
		else
		{
	    $lot=$_POST['autre'];
		}
	  }
	  else 
	  {
	  $lot=$_POST['lot'];
	  
	  }
	  
	  if(isset($_GET['SP']))
	  {@$sp=$_GET['SP'];	  }
	  else if(isset($_GET['SRPonct']))
	  {$sp='ponct';
	  }
	  else
	  {
	  @$sp=$_POST['codesousprojet'];
	  }
	  if(isset($_POST['codeP']))
	  {@$sp='ponct';
	  }
	  else {
		 @ $sp=$_POST['codeSP'];
	  }
		@ $sql="insert into sortie values('','".$_POST['date']."','".$_POST['emis_par']."','".$lot."','".$_POST['phse']."','".$_POST['miss']."','$code','".$_POST['mdo']."','$projet','".$_FILES['reference']['name']."','$codeSP','".$_SESSION['user']."')";
		$req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	}
	public function detailSortie($id)
	{
	  $sql="select * from sortie where id='$id'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function GetIntituleProjet($code)
	{
	   $sql="select * from projet where code_projet='$code'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	public function ModifierSortie($id,$projet,$lien)
	{
	if($_SESSION['user']=='utilisateur')
	 {
		@ $sql="update sortie set date_sortie='".$_POST['date']."',emis_par='".$_POST['emis_par']."',lot_sortie='".$_POST['lot']."',phse='".$_POST['phse']."',miss='".$_POST['miss']."',code='".$_POST['code']."',mdo='".$_POST['mdo']."',projet='$projet',reference='".$_POST['reference']."' where id='$id'";
		}
		else
		{
		  
		 $sql="update sortie set date_sortie='".$_POST['date']."',emis_par='".$_POST['emis_par']."',lot_sortie='".$_POST['lot']."',phse='".$_POST['phse']."',miss='".$_POST['miss']."',code='".$_POST['code']."',mdo='".$_POST['mdo']."',projet='$projet',reference='$lien',`user`='".$_SESSION['user']."' where id='$id'";
		
		}
		$req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	}
	public function deleteSortie($id)
	{
	 $sql="delete from sortie where id='$id'";
	 $req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	 
	}
	
	
	
}