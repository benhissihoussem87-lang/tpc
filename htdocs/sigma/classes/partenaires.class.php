<?php
class Partenaires{
public function __construct()
	{
		$this->connexion=new PDO('mysql:host=localhost;dbname=sigma','root','');
	}

	public function AfficherPartenaires()
	{
	  $sql="select * from partenaires";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function getPartenaires()
	{
	  $sql="select * from partenaires where type='ARCHITECTE'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function getAllPartenaires()
	{
	  $sql="select * from partenaires where type='ARCHITECTE' ";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	public function getAllPartenairesMDO()
	{
	  $sql="select * from partenaires where type='MDO' ";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function getPartenairesMDO()
	{
	  $sql="select distinct(designation) from partenaires where type='MDO'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	public function PartenaireArchi()
	{
	  $sql="select distinct(designation) from partenaires where type='ARCHITECTE'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function ajoutPartenaire($type,$client,$designantion,$date,$adresse,$fax,$tel,$email,$contact,$user)
	{
	
		 $sql="insert into partenaires(`type`,`client`, `designation`, `date_decharge`, `Adresse`, `fax`, `tel`, `email`, `contact`, `typeuser`) values('$type','$client','$designantion','$date','$adresse','$fax','$tel','$email','$contact','$user')";
		$req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	}
	
	public function ajoutPartenaireArchitecte($type,$client)
	{
	
		  $sql="insert into partenaires(`type`,`client`) values('$type','$client')";
		$req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	}
	public function detailPartenaire($id)
	{
	  $sql="select * from partenaires where id='$id'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	public function VerifExistePartenaire($designation,$type)
	{
	  $sql="select * from partenaires where designation='$designation' and type='$type'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function VerifExistePartenaireParticulier($designation)
	{
	  $sql="select * from partenaires where designation='$designation' and type='PARTICULIER'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function VerifExistePartenaireVis_A_VIS($designation)
	{
	  $sql="select * from partenaires where designation='$designation' and type='vis_a_vis'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	
	public function ModidifierPartenaire($id,$client,$designantion,$date,$adresse,$fax,$tel,$email,$contact,$type,$user)
	{
	if(isset($_POST['user']))
	{
	$sql="update partenaires set `client`='$client', `designation`='$designantion', `date_decharge`='$date', `Adresse`='$adresse', `fax`='$fax', `tel`='$tel',`type`='$type',
		`email`='$email', `contact`='$contact',`typeuser`='$user' where id='$id'";
	}
else{
$sql="update partenaires set `client`='$client', `designation`='$designantion', `date_decharge`='$date', `Adresse`='$adresse', `fax`='$fax', `tel`='$tel',`type`='$type',
		`email`='$email', `contact`='$contact' where id='$id'";
}	
		
		$req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	}
	
	public function deletePartenaire($id)
	{
	  $sql="delete from partenaires where id ='$id'";
	  $req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	}
	
}