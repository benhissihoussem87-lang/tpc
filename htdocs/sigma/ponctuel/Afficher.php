<style>

 table tr th{font-size:13px; text-align:center; font-weight:bold}
 table tr td{font-size:11px;}

</style>
<?php
if($_SESSION['user']=='Admin'  or $_SESSION['user']=='Admin2' or $_SESSION['user']=='utilisateur'  ){
$ponctuels=$ponct->getPonctuels();
}
/******Affiche User*********/
//$ponctuels=$ponct->getPonctuels();
if(isset($_GET['id_delete']))

{
//verification 
$detailPonct=$ponct->ModifierEtatOffre($_GET['id_delete']);
foreach($detailPonct as $cle);
if($cle['code_offre']!=null)
{
	  if(count($ponct->getCodeOffre($cle['code_offre']))>0){
	  
	      $ponct->EditEtatOffre($cle['code_offre']);
	  
	  }
  }
  
   if(isset($_GET['id_delete']))
		 {
		  $detailPonctD=$ponct->getDetailPonctuelD($_GET['id_delete']);
		  //echo count($detailPonctD);
		  //var_dump($detailPonctD);
		  foreach($detailPonctD as $pnct);
		 if($ponct->getDetailRecouvrement($pnct['code']) and $ponct->getDetailFacture($pnct['code']))
		   {$ponct->deletePonctuel($_GET['id_delete']);
		  // echo 'ok';
		   }
		//
		
		 echo "<script>document.location.href='sigma.php?AfficherPonctuel'</script>";
		 }
		 
  
  
}
 

?>
          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
			
              <i class="fas fa-table"></i>
			
             <table style="position:relative;left:120px; top:-30px"  width=90%>
			 
			  <tr  >
			  <td>  <b style="font-size:20px;position:relative;top:30px;left:-20px">Ponctuel</b></td>
			   <?php if($_SESSION['user']=='Admin'  or $_SESSION['user']=='Admin2' ){?>
			  <td><a href="?ponctuel_Ajout" style="width:220px; margin:auto;position:relative;top:30px;left:-150px;z-index:1000"   class="btn btn-primary btn-block" >Ajout</a></td>
			  <?php } ?>
			  
			  <td>

			  </table>
			  </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="position:relative;left:0px">
                  <thead>
                    <tr>
                      <?php if($_SESSION['user']=='Admin' ){?> 
                      <th style="font-size:10px;width:20px;margin:0;padding:0">N°</th>
					  <?php }?>
                      <th style="font-size:10px">Code</th>
                     <th style="font-size:10px;width:100px;">MDO</th>
					   <th style="width:250px;line-height:40px" >Projet</th>
					    <?php if($_SESSION['user']!='utilisateur' ){?> 
					    <th style="font-size:10px">vis.à.vis</th>
						 <?php }?>
					  <th style="font-size:10px" style="width:10px;padding:0;">LOT</th>
					  <th style="font-size:10px">AV</th>
					  <th style="font-size:10px">ARRIVEES_PONCTS</th>
					   <th style="font-size:10px" style="width:10px;padding:0;">MISS</th>
					    <th style="font-size:10px;" >SORTIES_PONCTS</th>
						<?php if($_SESSION['user']=='Admin'){?> 
					     <th style="font-size:10px">Hono</th>
						<?php } ?>
						   <th style="font-size:10px">ARR</th>
						     <th style="font-size:10px">VISITES FAITES</th>
							 <?php if($_SESSION['user']=='Admin'  or $_SESSION['user']=='Admin2' ){?> <th>Actions</th><?php }?>
                    </tr>
                  </thead>
                  
                  <tbody>
				  <?php 
				  @$row=count($ponctuels);
				  if($row>0)
				  {
				  foreach($ponctuels as $cle)
				  {
					 @ $nbarrives=count($ponct->AfficherArrivesPonctuel($cle['code'])); 
					 $arrives=$ponct->AfficherArrivesPonctuel($cle['code']);
					 $nbArive=0;
					  @$nb_arrives=count($arrives);
					  if($nb_arrives>0)
					  { foreach($arrives as $arv)
						  {
							 $nbArive=$nbArive+1;
						  }
						  
						  
					  }
					  
					  ?>
                    <tr>
                     <?php if($_SESSION['user']=='Admin' ){?>
					 <td><?php echo $cle['num']?><b><?php echo $nbarrives?></td><?php }?>
					   <td>
					   <b>PP</b><?php echo $cle['code']?>
					   <?php if($cle['code_offre']!=null)
					   {?>
					   <br>
					   <b>OP</b><?php echo $cle['code_offre']?>
					   <?php } ?>
					   </td>
					 
                      <td><?php echo $cle['mdo']?></td>
					    <td><?php echo $cle['projet']?></td>
						<?php if($_SESSION['user']!='utilisateur' ){?>
						<td><?php  echo $cle['vis_a_vis']?></td>
						 <?php }?>
						<td style="width:10px;padding:0;"><?php  echo $cle['lot']?></td>
						<td><?php  echo $cle['av']?></td>
					  <td>
					  <?php
					  if($_SESSION['user']=='Admin'  or $_SESSION['user']=='Admin2'  ){?>
					  <?php 
					if($nb_arrives>0)
					  { foreach($arrives as $arvA)
						  {?>
					<a style="float:left;" href="?ARPonctuel&redirect=ponct&Arrive_Ajout&arrive=<?php echo $arv['date']?>&mission=<?php echo $arv['miss']?>&phase=<?php echo $arv['phse']?>&affaire=<?php echo $arv['affaire']?>&designation=<?php echo $arv['emis_par']?>&lot=<?php echo $arv['lot']?>&code_projet=<?php echo $arv['code']?>&projet=<?php echo $arv['projet']?>&SP_projet=<?php echo $arv['code_sousprojet']?>&mdo=<?php echo $arv['mdo']?>&id=<?php echo $arv['id']?>"  ><?php echo $arvA['date'].' | '.$arvA['lot'].'<br>';?> </a>
					
						<?php	
						  }
						  
						  
					  }
					
					
					?>
					
									 <?php } else {
					 if($nb_arrives>0)
					  { foreach($arrives as $arvAU)
						  {
							echo $arvAU['date'].' | '.$arvAU['lot'].'<br>';
						  }
						  
						  
					  }
									 }
					   ?>
					  <!--Lien-->
					  <?php
					  if($_SESSION['user']=='Admin'  or $_SESSION['user']=='Admin2' )
					  {
					  ?>
					   <br><b class="btn btn-secondary" style="padding:2px 8px;font-size:12px;color:white">
					   <?php echo $nb_arrives?> Arrivés</b>
					  
					  <br>
					  <a href="?ARPonctuel&Arrive_Ajouter&code_projet=<?php echo $cle['code']?>&projet=<?php echo $cle['projet']?>&mdo=<?php echo $cle['mdo']?>" class="btn btn-outline-info" style="padding:2px 8px;font-size:12px">Ajout Arrive</a>
					  <?php } ?>
					  <!-- Fin Lien -->
					  </td> 
					 <td style="width:10px;padding:0;"><?php  echo $cle['mission']?></td> 
                     <td style="width:200px"><!--Debut Sortie-->
					 
					 <?php  
					  //si connecté Admin
					   $sorties=$projet->AfficherSortiesProjet($cle['code']);
					  @$nb_sorties=count($sorties);
					  //echo '<h1>'.$nb_arrives.'</h1>';
					  $nbSorties=0;
					  if($nb_sorties>0)
					  {
						  foreach($sorties as $srt)
						  {
									  if($_SESSION['user']=='Admin'  or $_SESSION['user']=='Admin2'  ){?>
			<a  href="?Sortie_Ajout&sortie=<?php echo $srt['date_sortie']?>&lot=<?php echo $srt['lot_sortie']?>&phase=<?php echo $srt['phse']?>&emis=<?php echo $srt['emis_par']?>&document=<?php echo $srt['miss']?>&code_projet=<?php echo $srt['code']?>&projet=<?php echo $srt['projet']?>&mdo=<?php echo $srt['mdo']?>&idS=<?php echo $srt['id']?>&redirect=SRPonct">
				<?php 
				echo $srt['date_sortie']?> | <?php echo $srt['lot_sortie'].'<br>';
				
				?>
				
				</a>
				<?php if($srt['reference']!=''){?>
				<a href="Sortie/references/<?php echo $srt['reference']?>" target="_blank">
				<?php echo $srt['reference'].'<br>';?>
				</a>
				<?php }?>
				
									 <?php } else {
										 
							 echo $srt['date_sortie']?> | <?php echo $srt['lot_sortie'].'<br>';
							
										 }//Fin si connecté Admin
					 /*****/
					  
                       
							  $nbSorties=$nbSorties+1;
					  }}
					 
					 /******/
					  if($_SESSION['user']=='Admin'  or $_SESSION['user']=='Admin2' or $_SESSION['user']=='utilisateur' )
					  {
					  ?>
					   <br><b class="btn btn-secondary" style="padding:2px 8px;font-size:12px;color:white">
					   <?php echo $nbSorties?> Sorties</b>
					  
					  <br>
					 
					  <a href="?SRPonct&Sortie_Ajouter&code_projet=<?php echo $cle['code']?>&projet=<?php echo $cle['projet']?>&mdo=<?php echo $cle['mdo']?>&redirect=SRPonct" class="btn btn-outline-info" style="padding:2px 8px;font-size:12px">Ajout Sortie</a>
					  <?php }  ?>
					 </td><!--Fin Sortie-->
					 <?php if($_SESSION['user']=='Admin'){?>
					 <td><?php  echo $cle['honoraire']?></td>
					 <?php } ?>
                       <td><?php  echo $cle['arr']?></td>
					   <td><?php  echo $cle['v_estime']?></td>
					    <?php if($_SESSION['user']=='Admin'  or $_SESSION['user']=='Admin2' ){?>
					 <td><a href=""><a href="?AfficherPonctuel&id_delete=<?php echo $cle['id']?>"><img src="images/delete.jpg" width="25" height="25"></a>
                 <a href="?ModifierPonctuel&id_modifier=<?php echo $cle['id']?>">
				 <img src="images/update.jpg" width="25" height="25"></a></td>
                     <?php }?>
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

         