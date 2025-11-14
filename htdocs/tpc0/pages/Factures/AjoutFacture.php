<?php
include 'class/client.class.php';
include 'class/Projet.class.php';
include 'class/Factures.class.php';
include 'class/OffresPrix.class.php';
include 'class/Reglements.class.php';
$clients=$clt->getAllClients();
$projets=$projet->getAllProjets();
$factures=$facture->AfficherFactures();
$anne=date('Y');
$Numfactures=$facture->GetNumFactures();
$NumfacturesArchive=$facture->GetNumFacturesArchive();
//var_dump($Numfactures);
if($Numfactures){

$numderniereFacture=explode('/',$Numfactures['num_fact']);
//echo '<h1> Num Facture '.$numderniereFacture[0].'</h1>';
$num_Facture=intval($numderniereFacture[0]+1).'/'.$anne;
}
else {
	$numderniereFactureArcive=explode('/',$NumfacturesArchive['num_fact']);
  $num_Facture=intval($numderniereFactureArcive[0]+1).'/'.$anne;
	}

$offres=$offre->AfficherOffres();
// Générer le numOffre

if($factures){$nb=count($factures);
              if((intval($nb+1))<10){$numFacture='0'.intval($nb+1).'/'.$anne;}
			 else{$numFacture=intval($nb+1).'/'.$anne;}
		     }
		  else {$numFacture='01/'.$anne;}
// Num Offre 
if($offres){$nb=count($offres);
              if((intval($nb+1))<10){$numOffre='0'.intval($nb+1).'/'.$anne;}
			 else{$numOffre=intval($nb+1).'/'.$anne;}
		     }
		  else {$numOffre='01/'.$anne;}
?>

 <?php
 // Ajout Facture non Forfitaire
 if(isset($_REQUEST['btnSubmitAjout'])){
		$Numero_Facture=$_POST['num_fact'];
	/********* Vérification statut facture  ************************/
	   // Si la meme facture 
	   $_SESSION['adresse']=$_POST['adresseClient'];
	  
	   if($_POST['statutFacture']=='Meme Facture'){
		  // Récupération Facture client
		  $factureClient=$facture->getLastFactureClient($_POST['client']);
		  $numFacture=$factureClient['num_fact'];
		 // echo '<h1>  Facture'.$numFacture.'</h1>';
		 // on ajoute seulement les projets de facture $numFacture
		    //************ Ajout Offre de Prix 
		//$offre->Ajout(@$_POST['num_fact'],@$_POST['date'],@$_POST['client']);
			// Ajout Projet Facture 
			for($i=0;$i<count($_POST['projet']);$i++){
			 if(!empty($_POST['prix_unit_htv'][$i])){
				 // Ajout Projet Facture
				$facture->AjoutProjets_Facture(@$numFacture,@$_POST['prix_unit_htv'][$i],
				@$_POST['qte'][$i],@$_POST['tva'][$i],@$_POST['remise'][$i],
				@$_POST['prixForfitaire'][$i],@$_POST['prixTTC'][$i],@$_POST['idProjet'][$i],@$_POST['adresseClient']
			  );
			  // Ajout Projet Offre
			  $offre->AjoutProjets_Offre(@$_POST['num_fact'],@$_POST['prix_unit_htv'][$i],@$_POST['qte'][$i],@$_POST['tva'][$i],@$_POST['remise'][$i],
				@$_POST['prixForfitaire'][$i],@$_POST['prixTTC'][$i],@$_POST['idProjet'][$i],@$_POST['adresseClient']
			  );
			 }
			 }
			
			 //$dateFacture=$_POST['date']; 
	   	echo "<script>document.location.href='main.php?Bordereaux&Add&Facture=$Numero_Facture'</script>";
	     }// Fin si Meme Facture
	else if($_POST['statutFacture']=='autre'){ 
		
		// Ajout Facture
 	if($facture->Ajout(@$_POST['num_fact'],@$_POST['client'],@$_POST['numboncommande'],@$_POST['date'],@$_POST['reglement']))
		{
	   //Ajout Reglement de facture 
	   if($_POST['reglement']=='non'){
			$reglement->Ajout(@$_POST['client'],@$_POST['num_fact'],'',@$_POST['reglement'],'','','','','','','');
				
		}
				// Ajout Offre de Prix 
		$offre->Ajout(@$_POST['num_fact'],@$_POST['date'],@$_POST['client']);
	// Ajout Projet Facture 
	for($i=0;$i<count($_POST['projet']);$i++){
	 if(!empty($_POST['prix_unit_htv'][$i])){
		 // Ajout Projet Facture
		$facture->AjoutProjets_Facture(@$_POST['num_fact'],@$_POST['prix_unit_htv'][$i],
		@$_POST['qte'][$i],@$_POST['tva'][$i],@$_POST['remise'][$i],
		@$_POST['prixForfitaire'][$i],@$_POST['prixTTC'][$i],@$_POST['idProjet'][$i],@$_POST['adresseClient']
	  );
	  // Ajout Projet Offre
	  
	  $offre->AjoutProjets_Offre(@$_POST['num_fact'],@$_POST['prix_unit_htv'][$i],
		@$_POST['qte'][$i],@$_POST['tva'][$i],@$_POST['remise'][$i],
		@$_POST['prixForfitaire'][$i],@$_POST['prixTTC'][$i],@$_POST['idProjet'][$i],@$_POST['adresseClient']
	  );
	 }
	 }
	/************ Redirection après l'ajout du facture *************/
	   // Redirection vers l'interface de l'ajout de bordereaux
	   $dateFacture=$_POST['date']; 
	   	echo "<script>document.location.href='main.php?Bordereaux&Add&Facture=$Numero_Facture'</script>";
	
	/********************* Fin redirection *************************/
	}
else {echo "<script>alert('Erreur !!! ')</script>";}
			
	}//Fin else if($_POST['statutFacture']=='autre')
	
	

 }


?>
<!--  Détail ****-->



 <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                       <div style="width:100%;text-align:center" class="col-12">
                            <a href="?Factures" class="btn btn-primary active " style="position:relative; top:20px;" >Afficher Factures</a>
							</div>
		

                          <div class="card-body">
						  <!-- ************ Scrolling *****************************---->
<div class="accordion col-12" id="accordionExample">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Facture non Forfitaire
        </button>
      </h2>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
					<!--Form Add Facture-->
					<form method="post"   >
		  <div class="modal-body row">
			<div class="mb-3 col-3">
				<label for="num_fact " class="col-form-label">N° Facture:</label>
				<input type="text" value="<?=$num_Facture?>"  class="form-control" id="num_fact " name="num_fact"/> 
			</div>
			  <div class="mb-3 col-5">
				<label for="client" class="col-form-label">Client:</label>
				<select class="form-control" id="client" name="client">
				 <?php if(!empty($clients)){
						foreach($clients as $key){?>
				 <option value="<?=$key['id']?>"><?=$key['nom_client']?></option>
				 <?php }} ?>				 
										
				</select>
				   
			  </div>
			  <div class="mb-3 col-4">
			<label for="adresse" class="col-form-label">Adresse:</label>
				<input type="text"  class="form-control" id="adresse"
				name="adresseClient"/>
				   
			</div>
			 <div class="mb-3 col-4">
			<label for="adresse" class="col-form-label">Statut Facture:</label><br>
				<div class="form-check form-check-inline">
  <input class="form-check-input" required type="radio" name="statutFacture" id="inlineRadio1" value="Meme Facture" >
  <label class="form-check-label" for="inlineRadio1">Meme Facture</label>
</div>
<div class="form-check form-check-inline">
  <input class="form-check-input" required checked  type="radio" name="statutFacture" id="inlineRadio2" value="autre">
  <label class="form-check-label" for="inlineRadio2">Autre</label>
</div>
				   
			</div>
			  <div class="mb-3 col-3">
			<label for="numboncommande  " class="col-form-label">N° Bon de commande:</label>
				<input type="text"  class="form-control" id="numboncommande"
				name="numboncommande"/>
				   
			</div>
			  
			  <div class="mb-3 col-3" >
				<label for="date" class="col-form-label">Date Facture:</label>
				<input type="date" value="<?=date('Y-m-d')?>" required  class="form-control" id="date" name="date"/>
				   
			</div>
			 <div class="mb-3 col-2" >
				<label for="reglement" class="col-form-label">Reglement:</label>
				<select class="form-control" id="reglement" name="reglement">
			  <option value="oui"  >Oui</option>
			   <option value="Avance"  >Avance</option>
			  <option value="non" selected  >Non</option>
			</select>
				   
			</div>
			
			 <div class="mb-3 col-3">
				<label for="projet" class="col-form-label">Projets:</label>
			</div>
			<div class="mb-3 col-2">
				<label for="projet" class="col-form-label">Prix Unitaire H.TVA:</label>
			</div>
			<div class="mb-3 col-2">
				<label for="projet" class="col-form-label">Qte:</label>
			</div>
			<div class="mb-3 col-1">
				<label for="projet" class="col-form-label">TVA:</label>
			</div>
			<div class="mb-3 col-2">
				<label for="projet" class="col-form-label">Remise:</label>
			</div>
			
			<div class="mb-3 col-2">
				<label for="projet" class="col-form-label">Prix TTC:</label>
			</div>
			<table width=100% id="FormAddFacture">
				
				 <?php if(!empty($projets)){
						foreach($projets as $cle){?>
	<tr>					
 
<div class="mb-3 col-3">
<input type="hidden" name="idProjet[]" multiple value="<?=$cle['id']?>" readOnly size="4"  />
	<input type="text" value="<?=$cle['classement']?>" readOnly multiple class="form-control"  name="projet[]"/>
</div>
<div class="mb-3 col-2">
	<input type="text" multiple class="form-control"  name="prix_unit_htv[]"/>
</div>
<div class="mb-3 col-2">
				
	<input type="number" min="1" value=1 multiple class="form-control"  name="qte[]"/>
	  
</div>
<div class="mb-3 col-1">
				
	<input type="text" class="form-control" value=19 multiple name="tva[]"/>
	  
			</div>
			<div class="mb-3 col-2">
				
			   <input type="text" class="form-control" multiple name="remise[]"/>
	  
			</div>
  
			
  <div class="mb-3 col-2">
				
		<input type="text" class="form-control" multiple name="prixTTC[]"/>
	  </div>
</tr>				 
				 <?php }} ?>				 
										
				
	</table>	




		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
			<button type="submit" class="btn btn-primary" name="btnSubmitAjout" >Ajouter</button>
		  </div>
		  </form>
		
					<!--Fin Form Add Facture-->
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h2 class="mb-0">
        <a href="?Factures&AddFactureForfitaire" class="btn btn-link btn-block text-left collapsed" >
          Facture Forfitaire
        </a>
      </h2>
    </div>
   <?php //include 'FactureForfitaire.php';?>
   </div>
 
</div>
		
<!-- *********** Fin Scrolling **********************--------->
					
						  </div>
                     
                    </div>
