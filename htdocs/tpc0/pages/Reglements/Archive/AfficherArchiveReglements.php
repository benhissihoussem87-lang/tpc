<?php
include 'class/Reglements.class.php';

$ArchiveReglements=$reglement->getAllARchive();
	
 ?>
<!-- DataTales Example -->
                    <div class="card shadow mb-4">
                       <div style="width:100%;text-align:center" class="col-12">
                            <a href="?Reglements&Archive&Add" class="btn btn-primary active " style="position:relative; top:20px;"  >Ajout  Archive Reglement</a>
							</div>
                        
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr> 
										    <th >N° Facture</th>
											<th >Client</th>
											<th >Prix TTC</th>
											<th >Etat Reglement</th>
											<th >Type Reglement</th>
											<th >N° Cheque</th>
											<th >Date Cheque</th>
											<th >Date Retenue</th>
											<th >Modifier</th>
											
                                           
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
									<?php if(!empty($ArchiveReglements)){
										foreach($ArchiveReglements as $key){?>
											 <tr>
												<td>
												<?=$key['num_fact_archive']?>
												</td>
												 <td><?=$key['nom_client']?></td>
												<td><?=$key['prix_ttc']?></td>
												<td><?=$key['etat_reglement']?></td>
												<td><?=$key['TypeReglement']?></td>
												<td><?=$key['num_cheque']?></td>
												<td><?=$key['date_cheque']?></td>
												<td><?=$key['retenue_date']?></td>
												<td><a href="?Reglements&Archive&Modifier&Reglement=<?=$key['num_fact_archive']?>" class="btn btn-warning">Modifier</a></td>
												
												
												 
												  
											 </tr>
									<?php }}?>
									 </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
