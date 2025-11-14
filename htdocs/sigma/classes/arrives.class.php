<?php
class Arrives{
public function __construct()
	{
		$this->connexion=new PDO('mysql:host=localhost;dbname=sigma','root','');
	}

	public function getArrives()
	{
	  $sql="select * from arrives ORDER BY date DESC";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function AfficherArrivesMDO($mdo)
	{
	
	   $sql="select * from arrives where mdo='$mdo' ORDER BY id DESC";
	  
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	
	public function getArrives_ST($projet)
	{
	  $sql="select * from arrives where lot='ST' and code='$projet'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function getArrives_EL($projet)
	{
	  $sql="select * from arrives where lot='EL' and code='$projet'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function getIntituleProjet($projet)
	{
	  $sql="select * from projet where code_projet='$projet'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function getArrives_SI($projet)
	{
	  $sql="select * from arrives where lot='SI' and code='$projet'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function getArrives_FL($projet)
	{
	  $sql="select * from arrives where lot='FL' and code='$projet'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function getArrives_Autre($projet)
	{
	  $sql="select * from arrives where lot!='EL' and lot!='ST' and lot!='SI' and lot!='FL' and code='$projet'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	
	public function ajoutArrive($projet,$code,$codeSP)
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
		  $sql="insert into arrives values('','".$_POST['date']."','".$_POST['affaire']."','".$_POST['emis_par']."','".$lot."','".$_POST['phse']."','".$_POST['miss']."','$code','$codeSP','".$_POST['mdo']."',
		'$projet','".$_POST['architecte']."','".$_SESSION['user']."')";
		$req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	}
	
	
	//Afficher Sous Projet
	
	public function SousProjet($projet)
	{
	  $sql="select * from arrives as ar, sous_projet as sprj where  ar.code_sousprojet=sprj.code_sous_P and ar.code_sousprojet='$projet' and sprj.code_sous_P='$projet'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	/****************Arrive Sous Projet************/
	
	public function ajoutArriveSousProjet($projet,$code,$codeSP)
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
		@ $sql="insert into arrives values('','".$_POST['date']."','','".$_POST['emis_par']."','".$lot."','".$_POST['phse']."','".$_POST['miss']."','$code','$codeSP','".$_POST['mdo']."','$projet','".$_POST['architecte']."','".$_SESSION['user']."')";
		$req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	}
	
	
	public function detailArrive($id)
	{
	  $sql="select * from arrives where id='$id'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function ModifierArrive($id,$projet)
	{
	if(isset($_POST['user']))
	{
		@ $sql="update arrives set date='".$_POST['date']."',affaire='".$_POST['affaire']."',code_sousprojet='".$_POST['codeSP']."',emis_par='".$_POST['emis_par']."',lot='".$_POST['lot']."',phse='".$_POST['phse']."',miss='".$_POST['miss']."',code='".$_POST['code']."',mdo='".$_POST['mdo']."',projet='$projet',architecte='".$_POST['architecte']."',`typeuser`='".$_SESSION['user']."' where id='$id'";
	}
	else{
	 @ $sql="update arrives set date='".$_POST['date']."',affaire='".$_POST['affaire']."',code_sousprojet='".$_POST['codeSP']."',emis_par='".$_POST['emis_par']."',lot='".$_POST['lot']."',phse='".$_POST['phse']."',miss='".$_POST['miss']."',code='".$_POST['code']."',mdo='".$_POST['mdo']."',projet='$projet',architecte='".$_POST['architecte']."' where id='$id'";
	}
		$req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	}
	public function deleteArrive($id)
	{
	 $sql="delete from arrives where id='$id'";
	 $req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	 
	}
	
	
	
	
	
}