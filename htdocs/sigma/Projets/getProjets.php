<style>

 table tr th{font-size:13px; text-align:center; font-weight:bold}
 table tr td{font-size:12px;width:400px;}

</style>
<?php

$mdoProjets=$projet->AfficherMDOProjet();
if(isset($_POST['btnrechercheMDO']))
{ 
		if($_POST['rechercheMDO']=='All')
		{
		$projets=$projet->AfficherProjet();
		}
		else{
		
		
		$projets=$projet->AfficherProjetMDO($_POST['rechercheMDO']);
		}
		
		$_SESSION['mdo']=$_POST['rechercheMDO'];
		
}//Fin isset($_POST['btnrechercheMDO']
else if(isset($_SESSION['mdo']))
			{
			  if($_SESSION['mdo']=='All')
			  {
			  $projets=$projet->AfficherProjet();
			  }
			  else{
			$projets=$projet->AfficherProjetMDO($_SESSION['mdo']);
			}
			}

	else	{ 
		$projets=$projet->AfficherProjet();
		}
if(isset($_GET['id_sous']))
{
 if($projet->deleteSousProjet($_GET['id_sous']))
 {
 
  echo "<script>document.location.href='sigma.php?P_Affiche'</script>";
 }
}
if(isset($_GET['codeP']))
{
$arrive_ST=$arrive->getArrives_ST($_GET['codeP']);
$arrive_EL=$arrive->getArrives_EL($_GET['codeP']);
$arrive_SI=$arrive->getArrives_SI($_GET['codeP']);
$arrive_FL=$arrive->getArrives_FL($_GET['codeP']);
$arrive_Autre=$arrive->getArrives_Autre($_GET['codeP']);
$arrive_Autres=$arrive->getArrives_Autre($_GET['codeP']);

$crv_projet=$projet->AfficherCR_visiteProjet($_GET['codeP']);

////////////sortie

$sortie_ST=$sortie->getArrives_ST($_GET['codeP']);
$sortie_EL=$sortie->getArrives_EL($_GET['codeP']);
$sortie_SI=$sortie->getArrives_SI($_GET['codeP']);
$sortie_FL=$sortie->getArrives_FL($_GET['codeP']);
$sortie_Autre=$sortie->getArrives_Autre($_GET['codeP']);
$sortie_Autres=$sortie->getArrives_Autre($_GET['codeP']);
}
	if(isset($_GET['P_delete']))
	{
	if($projet->deleteProjet($_GET['P_delete']))
	{
	 $projet->deleteSPProjet($_GET['projet']);
	 $projet->deleteFactureProjet($_GET['projet']);
	 $projet->deleteArrive($_GET['projet']);
	 $projet->deleteSortie($_GET['projet']);
	 $projet->deleteCRV($_GET['projet']);
	 $projet->ViderCodeProjet_AO($_GET['codeAO']);
	 
	 
	echo "<script>document.location.href='sigma.php?P_Affiche'</script>";
	}
}
?>
          <!-- DataTables Example -->
          <div class="card mb-3" >
            <div class="card-header">
              <i class="fas fa-table"></i>
              <?php
			  if(isset($_GET['codeP']))
                 {
				 ?>
				 Détail du projet de Code  <b><u><I style="color:blue"><?php echo $_GET['codeP']?></i></u></b>
                 <?php
				 }
				 else
				 {
				 ?><b style="font-size:20px;position:relative;top:0px;left:-00px">LES PROJETS</b></td>
				 
				 <?php }  if(!isset($_GET['codeP']))
		 {?>
				 <form method="post" style="width:220px;">
				
				 <select class="form-control" name="rechercheMDO">
				 <?php if(isset($_SESSION['mdo'])){?>
				      <option selected><?php echo $_SESSION['mdo']?></option>
				 <?php } ?>
				 
				  <option>All</option>
				  <?php if(count($mdoProjets)>0){


                     foreach($mdoProjets as $md){
				  ?>
				  
				  <option>  <?php echo $md['mdo'] ?></option>
				  
				  
				  <?php }} ?>
				 
				 </select>
				 <input type="submit" name="btnrechercheMDO" value="Recherche MDO" class="btn btn-primary btn-block" >
				
				 </form>
			  <?php } if($_SESSION['user']=='Admin'  or $_SESSION['user']=='Admin2')
		{ 
		 if(!isset($_GET['codeP']))
		 {
		
		?>  <a href="?P_Ajout" style="width:220px; ; margin:auto;position:relative; top:-30px;"   class="btn btn-primary btn-block" >Ajout Sous-projet</a><?php }} ?>
			  
			  </div>
            <div class="card-body">
              <div class="table-responsive" >
			  <?php
			  if(!isset($_GET['codeP']) and !isset($_GET['codeAO']))
                 {
				 ?>
                <table class="table table-bordered"  id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
					<th>Code Projet</th>
                     
					  <th>Titre_Projet</th>
					  <th>Maitre D'Ouvrage</th>
                      <th style="width:50px;padding:0;">Av. </th>
                      <th>Les Arrivés</th>
                       <th>Les Sorties</th>
					   <th>Recep.BC</th>
					  <th style="width:80px;padding:0;">n.vis</th>
					 <th>Les_CRV</th>
					 <?php if($_SESSION['user']=='Admin'  or $_SESSION['user']=='Admin2' )
		             { ?>
                     <th style="width:50px;padding:0;">Mod</th>
					  <th  style="width:50px;padding:0;">Supp</th>
					  <?php } ?>
					  
                      
                      
                    </tr>
                  </thead>
                  
                  <tbody>
				  <?php 
				  @$rows=count($projets);
				  if($rows>0){
				  foreach($projets as $cle)
				  {?>
                    <tr>
                      
                      <td>
					 <?php if($_SESSION['user']=='Admin'  or $_SESSION['user']=='Admin2' )
					{ ?>
					<a href="?P_Affiche&codeP=<?php echo $cle['code_projet']?>" class="btn btn-outline-info" style="padding:2px 8px;font-size:12px">
					<?php echo'<b>C</b>'. $cle['code_projet']?></a>
					
					<?php } else {
					echo '<b>C</b>'.$cle['code_projet'];
					 }?>
					 <br>
					   <b>OP</b><?php echo $cle['code_AO']?>
					  <hr>
					  <?php 
					 $res_sousprojet=$projet->SousProjet($cle['code_projet']);
					 if(!empty($res_sousprojet)){@$nbsps=count($res_sousprojet);}
					else { @$nbsps=0;}
               if($nbsps>0)
              {
			  ?>
			  <a href="?SPAffiche&sp=<?php echo $cle['code_projet']?>" class="btn btn-outline-info" style="padding:2px 8px;font-size:12px">
				   <?php echo $nbsps.' S-Projet'?></a>
				   <?php
			     foreach($res_sousprojet as $sp)
				 { ?>
				   
             <?php	   }
				 
			     
			  }			   
					 
					 ?>
					
					  </td>
					 
                         <td>
						 <p style="float:left; width:125px">
						 <?php echo $cle['intitule']?>
						 </p>
						 
						 
						 </td>
                      <td><?php echo $cle['mdo']?></td>
					  <td style="padding:2" >
					  <?php echo $cle['etat_p'].'<br>';?>
					 <?php if($cle['type']=='prive'){ echo '<b>'.$cle['type'].'</b>';}?>
					  
					  </td>
                      <td style="width:850px;padding:0" >
					  <?php
					  $arrives=$projet->AfficherArrivesProjet($cle['code_projet']);
					    $arrivesDernier=$projet->AfficherDernierArrivesProjet($cle['code_projet']);
						if(!empty($arrivesDernier)){@$nbsArrives=count($arrivesDernier);}
						else{@$nbsArrives=0;}
						$nbArive=0;
						if($nbsArrives>0)
						{
						   foreach($arrivesDernier as $arvder);
						}
						if(!empty($arrives)){@$nb_arrives=count($arrives);}
					  else{@$nb_arrives=0;}
					  //echo '<h1> NB : '.$nb_arrives.'</h1></br>';
					 
					  //echo '<h1>'.$nb_arrives.'</h1>';
					  if($nb_arrives>0)
					  {
					  $spd=null;
					  $i=0;
					  $color="";
						  foreach($arrives as $arv)
						  {
							  
							 $nbArive=$nbArive+1; 
							
								
						  if($arv['code_sousprojet']==null)
						  {
						     //verification selon typeuser
							 if($arv['typeuser']=='utilisateur' ){?>
				<a style="float:left;background:yellow" href="?redirect=p&Arrive_Ajout&arrive=<?php echo $arv['date']?>&mission=<?php echo $arv['miss']?>&phase=<?php echo $arv['phse']?>&affaire=<?php echo $arv['affaire']?>&designation=<?php echo $arv['emis_par']?>&lot=<?php echo $arv['lot']?>&code_projet=<?php echo $arv['code']?>&projet=<?php echo $arv['projet']?>&SP_projet=<?php echo $arv['code_sousprojet']?>&mdo=<?php echo $arv['mdo']?>&id=<?php echo $arv['id']?>"  style="width:115px; float:left;position:relative;left:-10px;">
                  <?php echo $arv['date'].' | '.$arv['lot'].'-'. $arv['phse'].'<br>';?>
				</a>
								 
							<?php } else {
								      //si connecté Admin
									  if($_SESSION['user']=='Admin'  or $_SESSION['user']=='Admin2'  ){?>
					<a style="float:left;" href="?ARPModif&redirect=p&Arrive_Ajout&arrive=<?php echo $arv['date']?>&mission=<?php echo $arv['miss']?>&phase=<?php echo $arv['phse']?>&affaire=<?php echo $arv['affaire']?>&designation=<?php echo $arv['emis_par']?>&lot=<?php echo $arv['lot']?>&code_projet=<?php echo $arv['code']?>&projet=<?php echo $arv['projet']?>&SP_projet=<?php echo $arv['code_sousprojet']?>&mdo=<?php echo $arv['mdo']?>&id=<?php echo $arv['id']?>"  >
					
                  <?php 
				  
				  echo $arv['date'].' | '.$arv['lot'].'-'. $arv['phse'].'<br>';
				 
				  
				  ?>
				</a>
									 <?php } else {
										 
										 echo $arv['date'].' | '.$arv['lot'].'-'. $arv['phse'].'<br>';
										 }//Fin si connecté Admin
								
								
							}
						  }
						  else 
						  {
						  $i=$i+1;
						 
						    $spd=$arvder['date'].' | '.$arvder['lot'].'-'. $arv['phse'].'<br>';
							 break;
						   
						 
						  }
					  }
					   echo $spd;
					  }
					 
					  
					  else
					  {
					    echo '';
					  }
					  if($_SESSION['user']=='Admin'  or $_SESSION['user']=='Admin2'  )
					  {
					  ?>
					   <br><b class="btn btn-secondary" style="padding:2px 8px;font-size:12px;color:white">
					   <?php echo $nb_arrives?> Arrivés</b>
					  
					  <br>
					  <a href="?ARP&Arrive_Ajouter&code_projet=<?php echo $cle['code_projet']?>&projet=<?php echo $cle['titre']?>&mdo=<?php echo $cle['mdo']?>" class="btn btn-outline-info" style="padding:2px 8px;font-size:12px">Ajout Arrive</a>
					  <?php } ?>
					  
					  
					  
					  
					  </td>
					  <td style="width:850px;padding:0">
					  <?php
                       @ $sorties=$projet->AfficherSortiesProjet($cle['code_projet']);
					   if(!empty($sorties)){
					  @$nb_sorties=count($sorties);
					   }
					   else{  $nb_sorties=0;      }
					  //echo '<h1>'.$nb_arrives.'</h1>';
					  $nbSorties=0;
					  if($nb_sorties>0)
					  {
						  foreach($sorties as $srt)
						  {
							  $nbSorties=$nbSorties+1;
							  if($nbsps==0)
							  {
							  
							 
						  //verification selon typeuser
							 if($srt['user']=='utilisateur' ){?>
			<a style="background:yellow" href="?Sortie_Ajout&sortie=<?php echo $srt['date_sortie']?>&lot=<?php echo $srt['lot_sortie']?>&phase=<?php echo $srt['phse']?>&emis=<?php echo $srt['emis_par']?>&document=<?php echo $srt['miss']?>&code_projet=<?php echo $srt['code']?>&projet=<?php echo $srt['projet']?>&mdo=<?php echo $srt['mdo']?>&idS=<?php echo $srt['id']?>&redirect=PS"  style="width:115px; float:left;position:relative;left:-10px;">
                  <?php  echo $srt['date_sortie']?> | <?php echo $srt['lot_sortie'].'-'. $srt['phse'].'<br>';?>
				</a>
				
								 
							<?php  }
                               
							else {
								      //si connecté Admin
									  if($_SESSION['user']=='Admin'  or $_SESSION['user']=='Admin2'  ){?>
			<a  href="?Sortie_Ajout&sortie=<?php echo $srt['date_sortie']?>&lot=<?php echo $srt['lot_sortie']?>&phase=<?php echo $srt['phse']?>&emis=<?php echo $srt['emis_par']?>&document=<?php echo $srt['miss']?>&code_projet=<?php echo $srt['code']?>&projet=<?php echo $srt['projet']?>&mdo=<?php echo $srt['mdo']?>&idS=<?php echo $srt['id']?>&redirect=PS">
				<?php echo $srt['date_sortie']?> | <?php echo $srt['lot_sortie'].'-'. $srt['phse'].'<br>';?>
				</a>
				
									 <?php } else {
										 
							 echo $srt['date_sortie']?> | <?php echo $srt['lot_sortie'].'-'. $srt['phse'].'<br>';
							
										 }//Fin si connecté Admin
								
								
							}
							  }// Fin if($nbsps==0)
									
						  }// Fin foreach
						  ?>
						 <br><b class="btn btn-secondary" style="padding:2px 8px;font-size:12px;color:white"><?php echo $nbSorties?> Sorties</b>
					  <br>
					 <?php }
					  else
					  {
					    echo '';
					  }
					  if( $_SESSION['user']=='Admin'  or $_SESSION['user']=='Admin2' )
					  {
					  ?>
					  
					  <a style="float:left;padding:2px 8px;font-size:12px;" class="btn btn-outline-info" href="?SRP&Sortie_Ajouter&code_projet=<?php echo $cle['code_projet']?>&projet=<?php echo $cle['titre']?>&mdo=<?php echo $cle['mdo']?>&redirect=PS">Ajout Sortie</a>
					  <?php }

						
					  ?>
					  </td>
                      
                     <td>
					 <?php echo $cle['date_receptionBC']?>
					 <?php
					  if( $_SESSION['user']=='Admin'  or $_SESSION['user']=='Admin2' )
					  {
						   if($cle['BC']!=null){
					  ?>
					  <br><a href="Projets/bc/<?php echo $cle['BC']?>" target="_blank">B.Commande</a>
					  
						   <?php }}?>
					 
					
					 
					 </td>
					   
                      <td>
					  <?php
					  $nbsOP=$projet->getNBVSOP($cle['code_AO']);
					  @$nb_v=count($nbsOP);
					  if($nb_v>0)
					  {
					  foreach($nbsOP as $nbres);
					  echo $nbres['nb_vis'];
					  }
					  
					  ?></td>
					    <td>
						<?php
					  $crs=$projet->AfficherCR_visiteProjet($cle['code_projet']);
					 if(!empty($crs)){
					  @$nb_crs=count($crs);
					   }
					   else{ @$nb_crs=0;}
					  
					  ?>
					  <a href="?CR_Afficher&code_projet=<?php echo $cle['code_projet']?>&projet=<?php echo $cle['titre']?>&mdo=<?php echo $cle['mdo']?>&crv" class="btn btn-outline-info" style="padding:2px 8px;font-size:12px">
					  <?php echo $nb_crs.' Visite';?>
					  </a><br>
					  
					  <?php
					  if($nb_crs>0)
					  {
					  
						  foreach($crs as $cr)
						  {
						  ?>
						  
							 <?php
						   
						  }
					  }
					  else
					  {
					    echo '';
					  }
					   if( $_SESSION['user']=='Admin'  or $_SESSION['user']=='Admin2' )
					  {
					  ?>
						 <a href="?CR_Ajout&code_projet=<?php echo $cle['code_projet']?>&projet=<?php echo $cle['titre']?>&mdo=<?php echo $cle['mdo']?>&crv" class="btn btn-outline-info" style="padding:2px 8px;font-size:12px">Ajout C.R.V</a>
						<?php } ?>
						</td>
						<?php if($_SESSION['user']=='Admin'  or $_SESSION['user']=='Admin2' )
							{ ?>
                     <td style="width:50px;padding:0"><a href="?P_Affiche&P_modifier=<?php echo $cle['id']?>">
					 <img src="images/update.jpg" width="25" height="25"></a>
					 </td>
					  <td style="width:50px;padding:0">
					 <a href="?P_Affiche&P_delete=<?php echo $cle['id']?>&projet=<?php echo $cle['code_projet']?>&codeAO=<?php echo $cle['code_AO']?>"><img src="images/delete.jpg" width="25" height="25"></a>
					 </td>
					 <?php } ?>
                     
                    </tr>
					<?php 
					}
					}
					?>
                
                  </tbody>
				  
                </table>
				<?php }
				//detail Projet
		  else if(isset($_GET['codeP'])){
		  $projets=$projet->getInfosProjet($_GET['codeP']);
		  foreach($projets as $code){
		  ?>
		  <table border=1 class="table " id="dataTable" width="100%" style="position:relative;top:50px" cellspacing="0">
		  <tr>
		  <th>Code Projet</td><td><b>C</b><?php echo $code['code_projet']?></td>
		 <th>MDO</th><td><?php echo $code['mdo']?></td>
		  </tr>
		  <tr>
		  <th>Code Offre</td><td><b>OP</b><?php echo $code['code_AO']?></td>
		  <th>Titre</td><td><?php echo $code['titre']?></td>
		  
		  </tr>
		  <tr> <th>Bon de Commande</th><th><a href="Projets/bc/<?php echo $code['BC']?>"><?php echo $code['BC']?> </th>
		    <th>Date RP</td><td><?php echo $code['rp']?></td>
		  </tr>
		  <tr><th>Avancement</td><td><?php echo $code['etat_p']?></td>
		  <th>Date RD</td><td><?php echo $code['rd']?></td>
		  </tr>
		  
             <tr><th>Date Reception B.C</td><td><?php echo $code['date_receptionBC']?></td> <td></td> <td></td></tr>
			  <tr><th>Date B.C</td><td><?php echo $code['date_B_C']?></td> <td></td> <td></td></tr>
			  
		  <tr >
		    <th colspan=2>
			<table border=1 width=100% >
			<tr><th >Documents Arrivés</th></tr>
		  <tr><th>ST</td><td><?php 
		 @ $row_st=count($arrive_ST);
		  if($row_st>0)
		  {
		  foreach($arrive_ST as $st)
					{
					echo $st['date'].'<br>';
					}
			}
					
					?>
					</td></tr>
		  <tr><th>EL</td><td><?php 
		  @$row_el=count($arrive_EL);
		  if($row_el>0)
		  {
		       foreach($arrive_EL as $el)
					{
					echo $el['date'].'<br>';
					}
					
			}		
					
					?></td></tr>
		  <tr><th>SI</td><td><?php 
		  @$row_si=count($arrive_SI);
		  if($row_el>0)
		  {
		       foreach($arrive_SI as $si)
					{
					echo $si['date'].'<br>';
					}
					
			}		
					
					?></td></tr>
		  <tr><th>FL</td><td><?php 
		  @$row_fl=count($arrive_FL);
		  if($row_fl>0)
		  {
		       foreach($arrive_FL as $fl)
					{
					echo $fl['date'].'<br>';
					}
					
			}		
					
					?></td></tr>
		  <tr>
		  <th>
		  <?php 
		 @ $row_autres=count($arrive_Autres);
		  if($row_autres>0)
		  {
		       foreach($arrive_Autres as $autres)
					{
					echo $autres['lot'].'<br>';
					}
					
			}		
					
					?>
		  </td>
		  
		  <td>
		  
		  <?php 
		 @ $row_autre=count($arrive_Autre);
		  if($row_autre>0)
		  {
		       foreach($arrive_Autre as $autre)
					{
					echo $autre['date'].'<br>';
					}
					
			}		
					
					?>
					</table>
			
			
		  </td>
		  <!-------------------Sortie-------------->
		  <th>
			<table border=1 width=100% >
			<tr><th colspan=3>Documents Sorties</th></tr>
		  <tr><th>ST</td><td><?php 
		@  $rows_st=count($sortie_ST);
		  if($rows_st>0)
		  {
		  foreach($sortie_ST as $st_sortie)
					{
					?>
					<a href="Sortie/references/<?php echo $st_sortie['reference']?>"  target="_blank">
					<?php
					echo $st_sortie['date_sortie'];
					?>
					</a><br>
					<?php
					}
			}
					
					?>
					</td></tr>
		  <tr><th>EL</td><td><?php 
		  @$rows_el=count($sortie_EL);
		  if($rows_el>0)
		  {
		       foreach($sortie_EL as $els)
					{
					?>
					<a href="#">
					<?php
					echo $els['date_sortie'];
					?>
					</a><br>
					<?php
					}
					
			}		
					
					?></td></tr>
		  <tr><th>SI</td><td><?php 
		  @$rows_si=count($sortie_SI);
		  if($rows_si>0)
		  {
		       foreach($sortie_SI as $sis)
					{
					?>
					<a href="#">
					<?php
					echo $sis['date_sortie'];
					?>
					</a><br>
					<?php
					}
					
			}		
					
					?></td></tr>
		  <tr><th>FL</td><td><?php 
		  @$rows_fl=count($sortie_FL);
		  if($rows_fl>0)
		  {
		       foreach($sortie_FL as $fls)
					{
					?>
					<a href="#">
					<?php
					echo $fls['date_sortie'];
					?>
					</a><br>
					<?php
					}
					
			}		
					
					?></td></tr>
		  <tr>
		  <th>
		  <?php 
		 @ $rows_autres=count($sortie_Autres);
		  if($rows_autres>0)
		  {
		       foreach($sortie_Autres as $autress)
					{
					echo $autress['lot_sortie'].'<br>';
					}
					
			}		
					
					?>
		  </td>
		  
		  <td>
		  
		  <?php 
		 @ $rows_autre=count($sortie_Autre);
		  if($rows_autre>0)
		  {
		       foreach($sortie_Autre as $autres)
					{
					?>
					<a href="#">
					<?php
					echo $autres['date_sortie'];
					?>
					</a><br>
					<?php
					}
					
			}		
					
					?>
					</table>
			
			
		  </td>
		  <td>
		  <!----Debut CRV------->
		  <table >
			 <tr><th>CR Visite</th></tr>
		  <?php
           @ $crv_cnt=count($crv_projet);
			if($crv_cnt>0)
			{
			
			 foreach($crv_projet as $cle){
			 ?>
			 <tr><th><a href="CR_Visite/references/<?php echo $cle['reference']?>">
					  <?php echo $cle['date_cr'].' '.$cle['lot_cr']?></a></th></tr>
			
			 <?php
			 }
			}
		  ?>
		   </table>
		  <!----Fin CRV------->
		  </td>
		  <!--------------Fin sortie----------------->
		  </tr>
		  </table>
		  <?php } 
		  } 
		  //Fin detail Projet
		  
		  /******Debut détail Offre prix********/
		  else if(isset($_GET['codeAO']))
		  {
		  
		   $ofres=$AO->getInfosDetailAO($_GET['codeAO']);
				  foreach($ofres as $cdAO){
				  ?>
		  <table border=1 class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
		  <tr>
		  <th>Code Offre de Prix</td><td><?php echo $cdAO['code']?></td>
		  <th>MDO</td><td><?php echo $cdAO['mdo']?></td>
		  </tr>
		 
		  <tr><th>Titre</td><td><?php echo $cdAO['titre']?></td>
		   <th>Type</td><td><?php echo $cdAO['type']?></td></tr>
		    <tr><th>Etat</td><td><?php echo $cdAO['etat']?></td>
			<th>Date limite</td><td><?php echo $cdAO['date_limite']?></td>
			</tr>
			
			 <tr><th>Date décharge</td><td><?php echo $cdAO['date_decharge']?></td>
			 <th>Cout</td><td><?php echo $cdAO['cout']?></td>
			 </tr>
			 
		  <tr><th>Honoraire</td><td><?php echo $cdAO['hono']?></td>
		  <th>Pourcentage</td><td><?php echo $cdAO['pourcentage']?></td>
		  </tr>
		  
		   <tr><th>Honoraire Etude</td><td><?php echo $cdAO['honoetude']?></td>
		   <th>Honoraire Visite</td><td><?php echo $cdAO['honovisite']?></td>
		   </tr>
		  
		      <tr><th>Nombre de Visite</td><td><?php echo $cdAO['nb_vis']?></td>
			  <th>RP-RD</td><td><?php echo $cdAO['rp_rd']?></td>
			  </tr>
			       
					     <tr><th>Date bon de commande</td><td><?php echo $cdAO['date_B_C']?></td>
						 <th>Date Reception Bon de commande</td><td><?php echo $cdAO['date_receptionBC']?></td>
						 </tr>
						  
					     <tr><th>Observation</td><td><?php echo $cdAO['observation']?></td></tr>
			</table>		
		  
		  
		  
		  
		  <?php
		  }
		  }
             /*********Fin detail Offre Prix***********************/
		  ?>
              </div>
            </div>
           
          </div>
		  

         