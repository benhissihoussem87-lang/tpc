<?php
include 'class/Reglements.class.php';
include 'class/client.class.php';
include 'class/Factures.class.php';
$clients=$clt->getAllClients();
$facturesArchive=$facture->AfficherFacturesArchives();
/*******Détail Reglement *************/
 $detailReglement=$reglement->getArchiveReglementByFacture($_GET['Reglement']);
 //var_dump($detailReglement);
//echo '<h1> Etat Reglement '.$detailReglement['etat_reglement'].'</h1>';

/*******Fin détail Reglement ********/
 if(isset($_REQUEST['btnSubmitModifier'])){

 	if($reglement->ModifierArchive(@$_GET['Reglement'],@$_POST['prixTTC'],@$_POST['etatReglement'],@$_POST['numCheque'],@$_POST['dateCheque'],@$_POST['retenueCheque'],@$_POST['typeReglement'],@$_FILES['pieceRs']['name']))
		 {
			 	 if($_FILES['pieceRs']['name']!=''){
	@copy($_FILES['pieceRs']['tmp_name'],'pages/Reglements/Archive/PiecesRS_Archive/'.$_FILES['pieceRs']['name']);
		}
	  echo "<script>document.location.href='main.php?Reglements&Archive'</script>";	
	 //echo 'Modifier OK';
	 }
	 

	
else {echo "<script>alert('Erreur !!! ')</script>";}
			
	}
?>
<!--  Détail ****-->
<!-- DataTales Example -->
                    <div class="card shadow mb-4">
                       <div style="width:100%;text-align:center;margin-bottom:20px" class="col-12">
                            <a href="?Reglements&Archive" class="btn btn-primary active " style="position:relative; top:20px;" >Afficher Archive Reglements</a>
							</div>
				<div class="card-body">
						  <!-- ************ Scrolling *****************************---->
<div class="accordion col-12" id="accordionExample">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
         Modifier Archive Reglements
        </button>
      </h2>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
					<!--Form Add Facture-->
					<form method="post" enctype="multipart/form-data" id="formBordereau"   >
		  <div class="modal-body row">
			
			
			 
			  <div class="mb-3 col-3" >
				<label for="prixTTC" class="col-form-label">Prix TTC :</label>
				<input type="text" value="<?=$detailReglement['prix_ttc']?>"   class="form-control" id="prixTTC" name="prixTTC"/>
				   
			</div>
			<div class="mb-3 col-2" >
				<label for="etatReglement" class="col-form-label">Etat Reglement:</label>
				<select class="form-control" id="etatReglement" value="<?=$detailReglement['prix_ttc']?>" name="etatReglement">
				<option <?php if($detailReglement['etat_reglement']=='Oui'){?> selected <?php } ?>>Oui</option>
				<option <?php if($detailReglement['etat_reglement']=='non'){?> selected <?php } ?>>Non</option>
				</select>
				   
			</div>
			<div class="mb-3 col-2" >
				<label for="typeReglement" class="col-form-label">Type Reglement :</label>
				<input list="typesReglement" value="<?=$detailReglement['TypeReglement']?>" class="form-control"  id="typeReglement" name="typeReglement"  />
				<datalist id="typesReglement">
					  <option value="Chèque"></option>
					  <option value="Espèce"></option>
					  
					</datalist>
				
				   
			</div>
			<div class="mb-3 col-2" >
				<label for="numCheque" class="col-form-label">N° Cheque :</label>
				<input type="text" value="<?=$detailReglement['num_cheque']?>" class="form-control" id="numCheque" name="numCheque"/>
				   
			</div>
			
			<div class="mb-3 col-3" >
				<label for="dateCheque" class="col-form-label">Date Cheque:</label>
				<input type="date" class="form-control" value="<?=$detailReglement['date_cheque']?>" id="dateCheque" name="dateCheque"/>
				   
			</div>
			<div class="mb-3 col-3" >
				<label for="retenueCheque" class="col-form-label">Retenue Date:</label>
				<input type="date" class="form-control" value="<?=$detailReglement['retenue_date']?>" id="retenueCheque" name="retenueCheque"/>
				   
			</div>
		   
		    <div class="mb-3 col-2" >
				<label for="pieceRs" class="col-form-label">Piece RS :</label>
				<input type="file"  class="form-control" id="pieceRs" name="pieceRs"/>
				   
			</div>

		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
			<button type="submit" class="btn btn-primary" name="btnSubmitModifier" >Modifier</button>
		  </div>
		  </form>
		
					<!--Fin Form Add Facture-->
      </div>
    </div>
  </div>
  
 
</div>
		
<!-- *********** Fin Scrolling **********************--------->
					
						  </div>
                     
                    </div>
