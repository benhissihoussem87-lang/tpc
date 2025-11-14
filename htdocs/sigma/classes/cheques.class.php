<?php
class Cheques{
public function __construct()
	{
		$this->connexion=new PDO('mysql:host=localhost;dbname=sigma','root','');
	}

	 public function getNumCH($banque)
	{
	  $sql="select * from cheques where autre='$banque' ORDER BY id DESC limit 1";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	public function getcheques()
	{
	  $sql="select * from cheques";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function getchequesEtatEncour()
	{
	  $sql="select * from cheques where etat='EN COURS'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	public function Modifiercheques($id)
	{
	if(isset($_POST['user']))
	 {
		@ $sql="update cheques set ordre_de='".$_POST['ordre_de']."',date_sortie='".$_POST['date_sortie']."',montant='".$_POST['montant']."',date_echeance='".$_POST['date_echeance']."',etat='".$_POST['etat']."',date_payement='".$_POST['date_payement']."',soldes='".$_POST['soldes']."',`typeuser`='".$_SESSION['user']."' where id='$id'";
		}
		else
		{
				@ $sql="update cheques set ordre_de='".$_POST['ordre_de']."',date_sortie='".$_POST['date_sortie']."',montant='".$_POST['montant']."',date_echeance='".$_POST['date_echeance']."',etat='".$_POST['etat']."',date_payement='".$_POST['date_payement']."',soldes='".$_POST['soldes']."' where id='$id'";

		}
		$req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	}
	
	public function ajoutcheques()
	{
		$banque=null;
		if(isset($_GET['STB']))
		{$banque="STB";}
	   else if(isset($_GET['BARAKA']))
		{$banque="BARAKA";}
	  $sql="insert into cheques values('','".$_POST['num']."','".$_POST['ordre_de']."','".$_POST['date_sortie']."','".$_POST['montant']."','".$_POST['date_echeance']."','".$_POST['etat']."','".$_POST['date_payement']."','".$_POST['soldes']."','".$_SESSION['user']."','$banque')";
		$req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	}
	public function detailcheques($id)
	{
	  $sql="select * from cheques where id='$id'";
	  
		$req=$this->connexion->query($sql);
		while($res=$req->fetch(PDO::FETCH_ASSOC))
		{
			@$data[]=$res;
			
		}
		return @$data;
	}
	
	
	public function deletecheques($id)
	{
	 $sql="delete from cheques where id='$id'";
	 $req=$this->connexion->prepare($sql);
		$test=$req->execute();
		if($test) return true;
		else return false;
	 
	}
	
	
	
}