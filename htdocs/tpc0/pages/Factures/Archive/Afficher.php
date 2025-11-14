<?php
include 'class/client.class.php';
include 'class/Projet.class.php';
include 'class/Factures.class.php';
$clients=$clt->getAllClients();
$projets=$projet->getAllProjets();
$factures=$facture->AfficherFacturesArchives();
// Générer le numOffre
$anne=date('Y');
		if($factures){
			$nb=count($factures);
			
		$numFacture=intval($nb+1).'/'.$anne;
		}
		else {$numFacture='1/'.$anne;}
/*********** delete Facture ***************/
 if(isset($_GET['deleteFacture'])){
	 if($facture->deleteFactureArchive($_GET['deleteFacture'])){
		 echo "<script>document.location.href='main.php?ArchivesFacture'</script>";
	 }
 }
/*********Add Project***********/	

if(isset($_REQUEST['ModifierProjetFacture'])){
	
 	if($facture->AddProjetFactureArchive(@$_POST['idFactureArchive'],@$_POST['projets']))
	{
		
	//echo '<h1> OKO</h1>';
	echo "<script>document.location.href='main.php?ArchivesFacture&Afficher'</script>";
	}
else {echo "<script>alert('Erreur !!! ')</script>";}

 }
	
 ?>
<!-- DataTales Example -->
                    <div class="card shadow mb-4">
                       <div style="width:100%;text-align:center" class="col-12">
                            <a href="?ArchivesFacture&Add" class="btn btn-primary active " style="position:relative; top:20px;"  >Ajouter Archive Facture</a>
							</div>
                        
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
											<th >Num Facture</th>
											<th >Date Facture</th>
											<th >Client</th>
                         
											<th >Supprimer</th>
											<th >Imprimer</th>
                                            
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
									<?php if(!empty($factures)){
										foreach($factures as $key){?>
					<!-------- Modal Ajouter Projets ------>
<div class="modal fade" id="AddProjets<?=$key['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajouter Projet</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  <form method="post" enctype="multipart/form-data">
      <div class="modal-body">
        <input type="text" name="idFactureArchive" value="<?=$key['num_fact']?>"/>
		 <div class="form-group">
		 
            <label for="libelle" class="col-form-label">Projets:</label>
            <textarea class="form-control" rows="15" required id="libelle" name="projets"><?=@$key['Projets']?></textarea>
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="ModifierProjetFacture" class="btn btn-primary">Valider</button>
      </div>
	  </form>
    </div>
  </div>
</div>
		<!------- Fin Modal ------->

											 <tr>
												<td>
												<a href="?Factures&Projets=<?=$key['num_fact']?>" class="btn btn-success"><?=$key['num_fact']?></a>
												</td>
												 <td><?=$key['date']?></td>
												<td><?=$key['nom_client']?></td>
												
												
												  <td><a href="?Factures&deleteFacture=<?=$key['num_fact']?>" class="btn btn-danger">Supp</a>
												   <a href="#" data-toggle="modal" data-target="#AddProjets<?=$key['id']?>" class="btn btn-warning"> Ajouter Projets</a></td>
												   <td>
												   <?php if(!empty($key['joindre'])){?>
												   <a href="pages/Factures/Factures_Archive/<?=$key['joindre']?>">Imprimer</a>
												   <?php } ?>
												   </td>
											 </tr>
									<?php }}?>
									 </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
