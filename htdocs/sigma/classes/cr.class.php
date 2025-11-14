<?php
class CRS{
public function __construct()
	{
		$this->connexion=new PDO('mysql:host=localhost;dbname=sigma','root','');
	}

	public function getCRS($projet)
	{
	  $sql="select * from cr_visite where code='$projet'  ORDER BY date_cr DESC";
	  
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
	
	public function getCRSP($spprojet)
	{
	   $sql="select * from cr_visite where codesp='$spprojet'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function getCRSALL()
	{
	  $sql="select * from cr_visite  ORDER BY date_cr DESC";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	
	
	
	public function ajoutCR_visite($projet,$sp)
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
			  
		@  $sql="insert into cr_visite (`date_cr`, `emis_par`, `lot_cr`, `code`, `mdo`, `projet`, `reference`,`codesp`,user)values('".$_POST['date']."','".$_POST['emis_par']."','".$lot."','".$_POST['code']."','".$_POST['mdo']."','$projet','".$_FILES['reference']['name']."','$sp','".$_SESSION['user']."')";
		$req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	}
	public function detailCR($id)
	{
	  $sql="select * from cr_visite where id='$id'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function ModifierCR($id,$titre,$lien)
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
			  if(isset($_POST['user']))
	       {
			  
		   $sql="update cr_visite set date_cr='".$_POST['date']."',emis_par='".$_POST['emis_par']."',lot_cr='".$lot."',code='".$_POST['code']."',mdo='".$_POST['mdo']."',projet='$titre',reference='$lien',user='".$_SESSION['user']."' where id='$id'";
		  }
		  else
		  {
		   $sql="update cr_visite set date_cr='".$_POST['date']."',emis_par='".$_POST['emis_par']."',lot_cr='".$lot."',code='".$_POST['code']."',mdo='".$_POST['mdo']."',projet='$titre',reference='$lien' where id='$id'";
		  }
		$req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	}
	public function deleteCR($id)
	{
	 $sql="delete from cr_visite where id='$id'";
	 $req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	 
	}
	
	
	
}