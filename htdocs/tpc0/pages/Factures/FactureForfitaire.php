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

/*************** Facture Forfitaire  *********************/
 if(isset($_REQUEST['btnSubmitAjoutFactureForfitaire'])){
$Numero_Facture=$_POST['num_fact'];
	// Ajout Facture
 	if($facture->Ajout(@$_POST['num_fact'],@$_POST['client'],@$_POST['numboncommande'],@$_POST['date'],@$_POST['reglement']))
	{
		
		// Ajout Offre de Prix 
		$offre->Ajout(@$_POST['num_fact'],@$_POST['date'],@$_POST['client']);
	// Ajout Projet Facture Forfitaire
	// Ajout Projet Facture
		$facture->AjoutProjets_Facture(@$_POST['num_fact'],'',
		'ENS','','',@$_POST['prixForfitaire'][0],'',@$_POST['projet'][0],@$_POST['adresseClient']
	  );
	  
	   $offre->AjoutProjets_Offre(@$_POST['num_fact'],'','', '','',
	   @$_POST['prixForfitaire'][0],'',@$_POST['projet'][0],@$_POST['adresseClient']
	  );
	  /*********** Ajout Reglement Facture Forfitaire ********************/ 
		$reglement->Ajout(@$_POST['client'],@$_POST['num_fact'],@implode(" ",$_POST['prixForfitaire']),@$_POST['reglement'],'','','','','','','');
   /************ Fin Ajout Facture Forfitaire       ********************/
	for($i=1;$i<count($_POST['projet']);$i++){
		
	 // Ajout Projet Facture
		$facture->AjoutProjets_Facture(@$_POST['num_fact'],'',
		'','','',@$_POST['prixForfitaire'][$i],'',@$_POST['projet'][$i],@$_POST['adresseClient']
	  );
	  // Ajout Projet Offre
	  
	  $offre->AjoutProjets_Offre(@$_POST['num_fact'],'','ENS', '','',
	   '',@$_POST['prixForfitaire'][$i],@$_POST['projet'][$i],@$_POST['adresseClient']
	  );
		 
	}
	 // Redirection vers l'interface de l'ajout de bordereaux
	   $dateFacture=$_POST['date']; 
	   	echo "<script>document.location.href='main.php?Bordereaux&Add&Facture=$Numero_Facture'</script>";

	}
else {echo "<script>alert('Erreur !!! ')</script>";}
 }
 ?>
 <div class="accordion col-12" id="accordionExample">
 <div class="card">
    <div class="card-header" id="headingTwo">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Facture Forfitaire
        </button>
      </h2>
    </div>
 
 <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body">
       	<!--Form Add Facture-->
					<form method="post"   >
		  <div class="modal-body row">
			<div class="mb-3 col-3">
			
				<label for="num_fact " class="col-form-label">N° Facture:</label>
				<input type="text" value="<?=$num_Facture?>" readOnly class="form-control" id="num_fact " name="num_fact"/>
				   
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
			  <div class="mb-3 col-3">
			<label for="numboncommande  " class="col-form-label">N° Bon de commande:</label>
				<input type="text"  class="form-control" id="numboncommande"
				name="numboncommande"/>
				
				</div>
			  <div class="mb-3 col-3">
			<label for="numboncommande  " class="col-form-label">N° exonoration:</label>
				<input type="text"  class="form-control" id="numexonoration"
				name="numexonoration"/>
				   
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
			 <div class="mb-3 col-4">
			<label for="adresse" class="col-form-label">Adresse:</label>
				<input type="text"  class="form-control" id="adresse"
				name="adresseClient"/>
				   
			</div>
			<div class="mb-3 col-12">
				<label for="projet" class="col-form-label col-12">Projets:</label>
				<?php if(!empty($projets)){
						foreach($projets as $cle){?>
					<div class="form-check form-check-inline col-3" >
				  <input class="form-check-input" name="projet[]" multiple type="checkbox" id="inlineCheckbox<?=$cle['id']?>" value="<?=$cle['id']?>">
				  <label class="form-check-label" for="inlineCheckbox<?=$cle['id']?>"><?=$cle['classement']?></label>
				</div>
			 
				 <?php }} ?>				 
	
			</div>	
		<!-- Champs Forfitaire **************-->
		     <div class="mb-3 col-12" style="display:flex">
	<label for="projet" class="col-form-label col-2">Prix Forfitaire:</label>
	
	<div class="mb-3 col-2">
      <input type="text" class="form-control" multiple name="prixForfitaire[]"/>
	  
	</div>
	<div class="mb-3 col-2">
      <input type="text" class="form-control" multiple name="prixForfitaire[]"/> 
	</div>
	<div class="mb-3 col-2">
      <input type="text" class="form-control" multiple name="prixForfitaire[]"/>
	 </div>
  <div class="mb-3 col-2">
      <input type="text" class="form-control" multiple name="prixForfitaire[]"/>
	</div>
   <div class="mb-3 col-2">
      <input type="text" class="form-control" multiple name="prixForfitaire[]"/>
	</div>	
</div>	
		<!-- End Forfitaire --------------------->
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
			<button type="submit" class="btn btn-primary" name="btnSubmitAjoutFactureForfitaire" >Ajouter</button>
		  </div>
		  </form>
		
					<!--Fin Form Add Facture-->
      </div>
    </div>
 
 
 </div>