<style>

 table tr th{font-size:13px; text-align:center; font-weight:bold}
 table tr td{font-size:11px;}

</style>
<?php
$tabSP=$projet->SousProjet($_GET['sp']);
if(isset($_GET['sp_delete']))

{
 if($projet->deleteSousProjet($_GET['sp_delete']))
 {
// header("location:sigma.php?SPAffiche&sp=".$_GET['sp']);
 ?>
 <script>document.location.href="sigma.php?SPAffiche&sp=<?php echo $_GET['sp'];?>"</script>
 <?php
 }
}
?>
          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Les Sous-Projets : <?php echo $_GET['sp'] ?>
			  <?php if($_SESSION['user']=='Admin'  or $_SESSION['user']=='Admin2' )
					{ ?>
			 <a href="?P_Ajout&sp=<?php echo $_GET['sp'] ?>" style="width:220px; ; margin:auto;position:relative; top:-30px;"   class="btn btn-primary btn-block" >
			 Ajout SP</a>
               <?php } ?>			 
			 </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      
                      <th>Code SP</th>
                      <th>Titre SP</th>
                          <th>MDO</th>
					   <th>Av.</th>
					    <th>Arrivé</th>
					  <th>Sortie</th>
					  <th>CRV</th>
					  <th>Date<br>Dem</th>
					   <th>Date<br> RP</th>
					    <th>Date<br> RD</th>
						 <?php if($_SESSION['user']=='Admin'  or $_SESSION['user']=='Admin2' )
					{ ?><th>Del</th><?php } ?>
					     
                    </tr>
                  </thead>
                  
                  <tbody>
				  <?php 
				  $row=count($tabSP);
				  if($row>0)
				  {
				  foreach($tabSP as $cle)
				  {?>
                    <tr>
                    <td><?php echo $cle['code_sous_P']?></td>
					   <td style="width:125px"><?php echo $cle['titre_sous_projet']?></td>
					 
                      <td><?php echo $cle['mdo']?></td>
					    <td><?php echo $cle['etat']?></td>
						<td>
						      <?php 
							  $ARVSP=$projet->ARVSP($cle['code_sous_P']);
							  @$nbspar=count($ARVSP);
							      if($nbspar>0)
								  { foreach($ARVSP as $clesp){
								   if($_SESSION['user']=='Admin'  or $_SESSION['user']=='Admin2' ){
								 ?>
								   <a href="?ARPModif&redirect=sp&Arrive_Ajout&arrive=<?php echo $clesp['date']?>&affaire=<?php echo $clesp['affaire']?>&designation=<?php echo $clesp['emis_par']?>&lot=<?php echo $clesp['lot']?>&code_projet=<?php echo $clesp['code']?>&projet=<?php echo $clesp['projet']?>&SP_projet=<?php echo $clesp['code_sousprojet']?>&mdo=<?php echo $clesp['mdo']?>&id=<?php echo $clesp['id']?>">
								   <?php echo $clesp['date'].' | '.$clesp['lot'].' - '.$clesp['phse'].'<br>';?>
								   
								   </a> 
								  <?php
								   }
								   
								   else
								   {
								   echo $clesp['date'].' | '.$clesp['lot'].' - '.$clesp['phse'].'<br>';
								   }
								   
								  
								  
								} }?>
						
						<?php echo $cle['arrive']?><br>
						 <?php if($_SESSION['user']=='Admin'  or $_SESSION['user']=='Admin2' ){?>
						   <a href="?ARP&Arrive_Ajouter&code_projet=<?php echo $cle['codeP']?>&codeSP=<?php echo $cle['code_sous_P']?>&projet=<?php echo $cle['titre']?>&mdo=<?php echo $cle['mdo']?>">Ajouter Arrive</a>
						   <?php } ?>
						</td>
						<td>
						<?php
                        $sorties=$projet->AfficherSortiesSP($cle['code_sous_P']);
					  @$nb_sorties=count($sorties);
					  //echo '<h1>'.$nb_arrives.'</h1>';
					  if($nb_sorties>0)
					  {
						  foreach($sorties as $srt)
						  {
						  ?>
						    <?php if($_SESSION['user']=='Admin'  or $_SESSION['user']=='Admin2' ){?> <a href="Sortie/references/<?php echo $srt['reference']?>"><?php } ?>
							<?php echo $srt['date_sortie']?> | <?php echo $srt['lot_sortie'].'-'.$srt['phse'].'<br>';?></a>
							
							
						<?php   
						  }
					  }
					  else
					  {
					    echo '';
					  }
					  ?>
					  <?php echo $cle['sortie']?><br>
					   <?php if($_SESSION['user']=='Admin'  or $_SESSION['user']=='Admin2' ){?>
					       <a href="?redirect=PS&SRP&Sortie_Ajouter&code_projet=<?php echo $cle['codeP']?>&SP=<?php echo $cle['code_sous_P']?>&projet=<?php echo $cle['titre']?>&mdo=<?php echo $cle['mdo']?>">Ajouter Sortie</a>
						   <?php } ?>
					  </td>
						<td>
						 <?php
					  $nbsSP=$projet->getNBVSP($cle['code_sous_P']);
					  @$nb_v=count($nbsSP);
					  ?>
					  <a href="?CR_Afficher&SPprojet=<?php echo $cle['code_sous_P']?>" class="btn btn-outline-info" style="padding:2px;font-size:12px">
					  <?php
					  echo $nb_v.' Visite';
					  ?>
					  </a><br>
					   <?php if($_SESSION['user']=='Admin'  or $_SESSION['user']=='Admin2' ){?>
					  <a href="?CR_Ajout&codep=<?php echo $cle['codeP']?>&projet=<?php echo $cle['titre']?>&mdo=<?php echo $cle['mdo']?>&codeSP=<?php echo $cle['code_sous_P']?>">Ajouter CRV</a>
					  <?php }?>
					  </td>
					    
					  
					  <td><?php echo $cle['demarrage']?></td> 
					 <td><?php echo $cle['date_rp']?></td> 
                     <td><?php echo $cle['date_rd']?></td>
                      
					 <?php if($_SESSION['user']=='Admin'  or $_SESSION['user']=='Admin2' )
					{ ?> <td><a href="?SPAffiche&sp=<?php echo $_GET['sp']?>&sp_delete=<?php echo $cle['code_sous_P']?>"><img src="images/delete.jpg" width="25" height="25"></a></td><?php } ?>
                     
                    </tr>
					<?php 
					}
					}
					?>
                
                  </tbody>
                </table>
              </div>
            </div>
            
          </div>

         