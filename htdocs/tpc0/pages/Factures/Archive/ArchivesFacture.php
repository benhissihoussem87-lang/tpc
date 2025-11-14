<?php
include 'class/client.class.php';
include 'class/Projet.class.php';
include 'class/Factures.class.php';
include 'class/OffresPrix.class.php';
$clients=$clt->getAllClients();
$projets=$projet->getAllProjets();
$factures=$facture->AfficherFacturesArchives();
$offres=$offre->AfficherOffres();
// Générer le numOffre
$anne=date('Y');
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
	 if(isset($_POST['reglement'])){$reglement=$_POST['reglement'];}
	 else{$reglement='';}
	// Ajout Facture
 	if($facture->AjoutArchive(@$_POST['num_fact'],@$_POST['client'],@$_POST['date'],@$_FILES['facture']['name'],$reglement,@$_POST['typereglement'],@$_POST['numcheque'],@$_POST['datecheque'],	@$_POST['retenu']))
		 {
			 if($_FILES['facture']['name']!=''){
	@copy($_FILES['facture']['tmp_name'],'pages/Factures/Factures_Archive/'.$_FILES['facture']['name']);
		}
			echo "<script>document.location.href='main.php?ArchivesFacture&Afficher'</script>";		
	     }
	 

	
else {echo "<script>alert('Erreur !!! ')</script>";}
			
	}//Fin else if($_POST['statutFacture']=='autre')
	
		


?>
 <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                       <div style="width:100%;text-align:center" class="col-12">
                            <a href="?ArchivesFacture&Afficher" class="btn btn-primary active " style="position:relative; top:20px;" >Afficher Archive Factures</a>
							</div>
		

                          <div class="card-body">
						  <!-- ************ Scrolling *****************************---->
<div class="accordion col-12" id="accordionExample">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Archive Facture
        </button>
      </h2>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
					<!--Form Add Facture-->
		<form method="post" method="post" enctype="multipart/form-data">
		  <div class="modal-body row">
			<div class="mb-3 col-3">
				<label for="num_fact " class="col-form-label">N° Facture:</label>
				<input type="text" value="<?=$numFacture?>" readOnly  class="form-control" id="num_fact " name="num_fact"/> 
			</div>
			  <div class="mb-3 col-3">
				<label for="client" class="col-form-label">Client:</label>
				<select class="form-control" id="client" name="client">
				 <?php if(!empty($clients)){
						foreach($clients as $key){?>
				 <option value="<?=$key['id']?>"><?=$key['nom_client']?></option>
				 <?php }} ?>				 
										
				</select>
				   
			  </div>
			
			  
			  <div class="mb-3 col-3" >
				<label for="date" class="col-form-label">Date Facture:</label>
				<input type="date"  required  class="form-control" id="date" name="date"/>
				   
			</div>
			<div class="mb-3 col-3" >
				<label for="facture" class="col-form-label">Joindre Facture:</label>
				<input type="file"    class="form-control" id="facture" name="facture"/>
				   
			</div>
			 <div class="mb-3 col-1" >
				<label for="reglement" class="col-form-label">Reglement:</label>
				<input type="text"    class="form-control" id="reglement" name="reglement"/>
				   
			</div>
			<div class="mb-3 col-2" >
				<label for="typereglement" class="col-form-label">Type Reglement:</label>
				<input type="text"    class="form-control" id="typereglement" name="typereglement"/>
				   
			</div>
			<div class="mb-3 col-2" >
				<label for="cheque" class="col-form-label">Num cheque:</label>
				<input type="text"    class="form-control" id="cheque" name="numcheque"/>
				   
			</div>
			<div class="mb-3 col-2" >
				<label for="datecheque" class="col-form-label">Date Cheque:</label>
				<input type="date"    class="form-control" id="datecheque" name="datecheque"/>
				   
			</div>
			<div class="mb-3 col-2" >
				<label for="retenu" class="col-form-label">Retenu:</label>
				<input type="date"    class="form-control" id="retenu" name="retenu"/>
				   
			</div>
			 
			
		
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
 
 
</div>
		
<!-- *********** Fin Scrolling **********************--------->


                     
                    </div>
