<style>

 table tr th{font-size:13px; text-align:center; font-weight:bold}
 table tr td{font-size:12px;width:400px;}

</style>
<?php
//$factures=$facture->getFacture();
$projets=$projet->AfficherProjet();

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
			  <b style="font-size:20px;position:relative;top:0px;left:-00px">FACTURATION</b></td>
              <?php  $TotalEnvoye=0;   $TotalRecouvre=0;$totalHonos=0; 			  ?>
                <table class="table table-bordered"  id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
					<th>Code Offre </th>
					<th>Code Projet</th>
					
					
                     <th>MDO</th>
					 <th>Titre_Projet</th>
					 <th width="50" style="paddin:0">Hono.</th>
					 <th>Dt.Facture..</th>
					   <th>Dt.Envoie..</th>
					  <th>D.Recouvre</th>
					  <th>Montant</th>
					 <th>Reste à facturé</th>
					 <th>Reste à Recouvré</th>
                      
					  
                      
                      
                    </tr>
                  </thead>
                  
                  <tbody>
				  <?php 
				  $rows=count($projets);
				  if($rows>0){
				  foreach($projets as $cle)
				  {
				   $recouvreProjet=$facture->getRecouvreProjet($cle['code_projet']);
				   if($recouvreProjet==null)
				   {
					   $recouvreProjet=$facture->getRecouvreProjetNews($cle['code_projet']);
					   
				   }
					   
				  ?>
                    <tr>
                      
                      <td>
					
					<b>OP</b><?php echo $cle['code_AO']?>
					  
					  </td>
					   <td>
					
					<b>C</b><?php echo $cle['code_projet']?>
					  
					  </td>
					  
					   <td>
					
					<?php echo $cle['mdo']?>
					  
					  </td>
					   <td>
					
					<?php
                     
					echo $cle['intitule'];
					
					?>
					  
					  </td>
					   <td style="width:50px;paddin:0">
					
					<?php 
					$mdos=$facture->getMDOAO($cle['code_AO']);
					if(count($mdos)>0)
					{
					foreach($mdos as $md)
					{
					echo $md['hono'];
					@$totalHonos=$totalHonos+$md['hono'];
					}
					}
					?>
					  
					  </td>
					  <td>
					  <?php
					  $table=null;
					  $factures=$projet->GetFacturesProjet($cle['code_projet']);
					
						$Autrefactures=$projet->GetFacturesNewsProjet($cle['code_projet']);
					  
					    $facturesTotal=$facture->getFacture();
						$totalMnt=0;	
						 $rowsF=count($facturesTotal);
					if($rowsF>0){
						foreach($facturesTotal as $ft)
						{
							$totalMnt=$totalMnt+$ft['mantant'];
							
						}
					}
					/************/
					 @ $rows=count($factures);
					 @ $rowsAutre=count($Autrefactures);
					 
					if($rows>0){
					
					$sommeMnt=0;
					foreach($factures as $fct)
					{ $sommeMnt=$sommeMnt+$fct['mantant'];
					
					 $Nfct=explode("/",$fct['numFacture']);
					 //echo '<u>'.$Nfct[0].'</u>';
					?>
					  <?php if($table=='factures') {?>
					<a href="?Param=facturation&Facture_Modifier&numFacture=<?php echo $fct['numFacture']?>&anneeFacture=<?php echo $fct['annee']?>&Facture=<?php echo $fct['facture']?>&recouvre=<?php echo $fct['recouvre']?>&envoye=<?php echo $fct['envoye']?>&id=<?php echo $fct['id']?>&codeP=<?php echo $fct['codeProjet']?>&etat=<?php echo $fct['avancement']?>&codeAO=<?php echo $fct['codeAO']?>&titre=<?php echo $fct['titre']?>&intitule=<?php echo $fct['intitule']?>&mdo=<?php echo $fct['mdo']?>">
					<?php echo 'F'.$Nfct[0].'/'.$fct['facture']?>
					  </a>
					  <?php } else if($table=='facturesNew'){
					  echo 'F'.$Nfct[0].'/'.$fct['facture'];
					   } ?>
					  
					  <br>
					   <?php } ?>
					  
	<!--Facture News------------------------------------->
	<?php
					}if($rowsAutre>0){
					
					
					$sommeMnt=0;
					foreach($Autrefactures as $Afct)
					{ $sommeMnt=$sommeMnt+$Afct['mantant'];
					
					 $Nfct=explode("/",$Afct['numFacture']);
					 //echo '<u>'.$Nfct[0].'</u>';
					?>
					  <?php if($table=='factures') {?>
					<a href="?Param=facturation&Facture_Modifier&numFacture=<?php echo $Afct['numFacture']?>&anneeFacture=<?php echo $Afct['annee']?>&Facture=<?php echo $Afct['facture']?>&recouvre=<?php echo $Afct['recouvre']?>&envoye=<?php echo $Afct['envoye']?>&id=<?php echo $Afct['id']?>&codeP=<?php echo $Afct['codeProjet']?>&etat=<?php echo $Afct['avancement']?>&codeAO=<?php echo $Afct['codeAO']?>&titre=<?php echo $Afct['titre']?>&intitule=<?php echo $Afct['intitule']?>&mdo=<?php echo $Afct['mdo']?>">
					<?php echo 'F'.$Nfct[0].'/'.$Afct['facture']?>
					  </a>
					  <?php } else if($table=='facturesNew'){
					  echo 'F'.$Nfct[0].'/'.$Afct['facture'];
					  
					   } ?>
					  
					  <br>
					   <?php } ?>
					
					  <a href="?Facture_Ajout&codeP=<?php echo $Afct['codeProjet']?>&etat=<?php echo $Afct['avancement']?>&codeAO=<?php echo $Afct['codeAO']?>&titre=<?php echo $Afct['titre']?>&intitule=<?php echo $Afct['intitule']?>&mdo=<?php echo $Afct['mdo']?>">Ajout Facture </a>
					 
					  </td>
					
					   <td >
					<?php 
					$sommeEnvoye=0;
					
					foreach($factures as $fct)
					{
                      $Nfct=explode("/",$fct['numFacture']);
					 if($fct['envoye']!=null){
					 $TotalEnvoye=$TotalEnvoye+$fct['mantant'];
					 }
					
					 if($fct['recouvre']!=null){
					 $TotalRecouvre=$TotalRecouvre+$fct['mantant'];}?>
					<?php echo 'F'.$Nfct[0].'/'.$fct['envoye']?><br>
					<?php }
					if($recouvreProjet!=null)
					{
                      foreach($recouvreProjet as $recP)
					{
					
					if($recP['envoye']!=null)
					{
					$sommeEnvoye=$sommeEnvoye+$recP['mantant'];}?><br>
					<?php }}
						echo '<hR>';
						echo $sommeEnvoye;
						
						
                     
					?>  
					  </td>
					  
					   <td >
					<?php foreach($factures as $fct)
					{ 
					 $Nfct=explode("/",$fct['numFacture']);
					 ?>
					<?php echo 'F'.$Nfct[0].'/'.$fct['recouvre']?>
					<br>
					<?php } 
					
					 $sommeMntRP=0;
					foreach($recouvreProjet as $recP)
					{
					if($recP['recouvre']!=null)
					{
					$sommeMntRP=$sommeMntRP+$recP['mantant'];
				
					}
					?>
					<br>
					<?php }
						echo '<hR>';
						echo $sommeMntRP;
                     
					?>  
					  </td>
					   <td >
					<?php foreach($factures as $fct)
					{ 
					  $Nfct=explode("/",$fct['numFacture']);
					?>
					<?php echo 'F'.$Nfct[0].'/'.$fct['mantant']?>
					<br>
					<?php }
					echo '<hr>';
						echo $sommeMnt;
					?>  
					  </td>
					   <td>
					<?php 
					$mdos=$facture->getMDOAO($cle['code_AO']);
					foreach($mdos as $md)
					{
					@$res=$md['hono']-$sommeMnt;
					echo  $res;
					}
					?>
					  </td>
					   <td>
					<?php
                     
						echo $sommeMnt-$sommeMntRP;

					?>  
					  </td>
					<?php }
					else { ?>
					<a href="?Facture_Ajout&codeP=<?php echo $cle['code_projet']?>&etat=<?php echo $cle['etat_p']?>&codeAO=<?php echo $cle['code_AO']?>&titre=<?php echo $cle['titre']?>&intitule=<?php echo $cle['intitule']?>&mdo=<?php echo $cle['mdo']?>">Ajout Facture </a>
					 </td>
					
					 <td></td>
					<td></td>	
					<td></td>	
					<td></td>
					<td></td>
					<?php }

					?>
                    </tr>
					<?php
										
					}
					}
					?>
              
                  </tbody>
				  <thead>
                    <tr>
					<th></th>
					<th></th>
					
					
                     <th></th>
					 <th></th>
					 <th>Tot.Hono</th>
					 <th></th>
					   <th>Tot.Envoyé</th>
					  <th>Tot.Recouvré</th>
					  <th>Tot.Facturé</th>
					 <th></th>
					 <th></th>
                      
					  
                      
                      
                    </tr>
                  </thead>
				    <tr><td></td><td></td><td></td><td></td><td><?php echo $totalHonos?></td><td></td><td><?php echo $TotalEnvoye?></td><td><?php echo $TotalRecouvre?></td><td><?php echo @$totalMnt?></td><td></td><td></td></tr>
                </table>
				
              </div>
            </div>
           
          </div>
		  

         