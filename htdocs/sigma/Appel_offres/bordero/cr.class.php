<?php
class CRS{
public function __construct()
	{
		$this->connexion=new PDO('mysql:host=localhost;dbname=sigma','root','');
	}

	public function getCRS($projet)
	{
	  $sql="select * from cr_visite where code='$projet'";
	  
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
	  $sql="select * from cr_visite";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	
	
	
	public function ajoutCR_visite()
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
			  
		echo $sql="insert into cr_visite values('','".$_POST['date']."','".$_POST['emis_par']."','".$lot."','".$_POST['code']."','".$_POST['mdo']."','".$_POST['projet']."','".$_FILES['reference']['name']."','".$_POST['codesousprojet']."')";
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
	
	public function ModifierCR($id)
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
		echo $sql="update cr_visite set date_cr='".$_POST['date']."',emis_par='".$_POST['emis_par']."',lot_cr='".$lot."',code='".$_POST['code']."',mdo='".$_POST['mdo']."',projet='".$_POST['projet']."',reference='".$_FILES['reference']['name']."' where id='$id'";
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