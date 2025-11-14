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
              <?php  $TotalEnvoye=0;  $TotalEnvoyeA=0;  $TotalRecouvre=0;$TotalRecouvreA=0;$totalHonos=0; 			  ?>
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
				   
				  $recouvreProjetAutre=$Autresfacture->getRecouvreProjetNews($cle['code_projet']);
					   
				 
					   
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
					if(@count($mdos)>0)
					{
					foreach($mdos as $md)
					{
					echo $md['hono'];
					@$totalHonos=$totalHonos+$md['hono'];
					}
					}
					?>
					  
					  </td>
					  <td><!--Debut de Date Facture-->
					  <?php
					  // 
					    $factures=$projet->GetFacturesProjet($cle['code_projet']);
						$Autrefactures=$projet->GetFacturesNewsProjet($cle['code_projet']);
						// Table Facture
						 $facturesTotal=$facture->getFacture();
						$totalMnt=0;	
						 $rowsF=count($facturesTotal);
					if($rowsF>0){foreach($facturesTotal as $ft){
							@$totalMnt=$totalMnt+$ft['mantant'];
							}}
					// Table Facture_News
						 $facturesTotalA=$Autresfacture->getAutreFacture();
						$totalMntA=0;	
						 $rowsFA=count($facturesTotalA);
					if($rowsFA>0){foreach($facturesTotalA as $ftA){
							$totalMntA=$totalMntA+$ftA['mantant'];
							}}
				/****************************/
				if(!empty($factures)){@$rows=count($factures);}
				else{$rows=0;}
				if(!empty($Autrefactures)){$rowsA=count($Autrefactures);}
				else{$rowsA=0;}
				
				 // Table Facture
				 $sommeMnt=0;
				 if($rows>0){
						
						
						foreach($factures as $fct)
						{ $sommeMnt=$sommeMnt+$fct['mantant'];
						
						 $Nfct=explode("/",$fct['numFacture']);
						 //echo '<u>'.$Nfct[0].'</u>';
						
						 if($_SESSION['user']=='Admin'){  ?>
						<a href="?factures&Param=facturation&Facture_Modifier&numFacture=<?php echo $fct['numFacture']?>&anneeFacture=<?php echo $fct['annee']?>&Facture=<?php echo $fct['facture']?>&recouvre=<?php echo $fct['recouvre']?>&envoye=<?php echo $fct['envoye']?>&id=<?php echo $fct['id']?>&codeP=<?php echo $fct['codeProjet']?>&etat=<?php echo $fct['avancement']?>&codeAO=<?php echo $fct['codeAO']?>&titre=<?php echo $fct['titre']?>&intitule=<?php echo $fct['intitule']?>&mdo=<?php echo $fct['mdo']?>">
						<?php echo 'F'.$Nfct[0].'/'.$fct['facture']?>
						  </a>
						 <?php }else {?>
						 <?php echo 'F'.$Nfct[0].'/'.$fct['facture'];}?>
						 
						  
						  <br>
				<?php }
					} // Fin Facture
				 
					 // Table FactureNews
					 $sommeMntA=0;
				 if($rowsA>0){
						
						foreach($Autrefactures as $fctA)
						{ $sommeMntA=$sommeMntA+$fctA['mantant'];
						
						 $NfctA=explode("/",$fctA['numFacture']);
						 //echo '<u>'.$Nfct[0].'</u>';
						?>
						   <?php if($_SESSION['user']=='Admin'){  ?>
						<a hrefd="?FactureNews&Param=facturation&Facture_Modifier&numFacture=<?php echo @$fctA['numFacture']?>&anneeFacture=<?php echo @$fctA['annee']?>&Facture=<?php echo @$fct['facture']?>&recouvre=<?php echo @$fctA['recouvre']?>&envoye=<?php echo @$fctA['envoye']?>&id=<?php echo $fctA['id']?>&codeP=<?php echo @$fctA['codeProjet']?>&etat=<?php echo @$fctA['avancement']?>&codeAO=<?php echo @$fctA['codeAO']?>&titre=<?php echo $fctA['titre']?>&intitule=<?php echo @$fctA['intitule']?>&mdo=<?php echo $fctA['mdo']?>" style="border:1px solid black;color:green">
						<?php echo 'F'.$NfctA[0].'/'.$fctA['facture']?>
						  </a>
						 <?php }else {?>
						 <a style="border:1px solid black;color:green"><?php echo 'F'.$NfctA[0].'/'.$fctA['facture'];?></a>
						 <?php }?>
						  
						  <br>
						<?php }
					} // Fin FactureNews
					?>
			<a href="?Facture_Ajout&codeP=<?php echo $cle['code_projet']?>&etat=<?php echo @$fct['avancement']?>&codeAO=<?php echo $cle['code_AO']?>&titre=<?php echo @$fct['titre']?>&intitule=<?php echo @$fct['intitule']?>&mdo=<?php echo @$fct['mdo']?>" class="btn btn-outline-info" style="padding:2px 8px;font-size:12px">Ajout Facture  </a>
			<?php //echo '<h1>'.$cle['code_projet'].'</h1>';?>

					  </td><!--Fin Date Facture-->
					 <td>
					 <?php 
					 // Table Facture
					$sommeEnvoye=0;
						if($factures!=null){
					foreach($factures as $fct)
					{
                      $Nfct=explode("/",$fct['numFacture']);
					 if($fct['envoye']!=null){
					 $TotalEnvoye=$TotalEnvoye+$fct['mantant'];
					 }
					
					 if($fct['recouvre']!=null){
					 $TotalRecouvre=$TotalRecouvre+$fct['mantant'];}?>
					<?php echo $fct['envoye']?><br>
				  <?php } }
					if($recouvreProjet!=null)
					{
                      foreach($recouvreProjet as $recP)
					{
					
					if($recP['envoye']!=null)
					{
					$sommeEnvoye=$sommeEnvoye+$recP['mantant'];}?>
					<?php }}
					// Fin table Facture
					/*******Facture News******/
						$sommeEnvoyeA=0;
						if($Autrefactures!=null){
					foreach($Autrefactures as $fctAS)
					{
                      $NfctAS=explode("/",$fctAS['numFacture']);
					 if($fctAS['envoye']!=null){
					 $TotalEnvoyeA=$TotalEnvoyeA+$fctAS['mantant'];
					 }
					
					 if($fctAS['recouvre']!=null){
					 $TotalRecouvreA=$TotalRecouvreA+$fctAS['mantant'];}?>
					<?php echo $fctAS['envoye']?><br>
				  <?php } }
					if($recouvreProjetAutre!=null)
					{
                      foreach($recouvreProjetAutre as $recPA)
					{
					
					if($recPA['envoye']!=null)
					{
					$sommeEnvoyeA=$sommeEnvoyeA+$recPA['mantant'];}?><br>
					<?php }}
					/*******Fin Facture News******/
						echo '<hR>';
						echo $sommeEnvoye+$sommeEnvoyeA;
						
						
                     
					?>
					 </td>
					<td>
					<!--Table Facture-->
						<?php 
						if($factures!=null){
						foreach($factures as $fct)
					{ 
					 $Nfct=explode("/",$fct['numFacture']);
					 ?>
					<?php echo $fct['recouvre']?>
					<br>
				  <?php }  }
					
					 $sommeMntRP=0;
					 if($recouvreProjet!=null){
					foreach($recouvreProjet as $recP)
					{
					if($recP['recouvre']!=null)
					{
					$sommeMntRP=$sommeMntRP+$recP['mantant'];
				
					}
				  } }
					?>
					<!--Fin table Facture-->
					<!--Table Facture New-->
						<?php 
						if($Autrefactures!=null){
						foreach($Autrefactures as $fctA)
					{ 
					 $NfctA=explode("/",$fctA['numFacture']);
					 ?>
					<?php echo $fctA['recouvre']?>
					<br> 
				  <?php }  }
					
					 $sommeMntRPA=0;
					  if($recouvreProjetAutre!=null){
					foreach($recouvreProjetAutre as $recPA)
					{
					if($recPA['recouvre']!=null)
					{
					$sommeMntRPA=$sommeMntRPA+$recPA['mantant'];
				
					}
					?>
					<!--Fin table Facture News-->
					<br>
					  <?php } }
						echo '<hR>';
						echo $sommeMntRP+$sommeMntRPA;
                     
					?>  
                  </td>	
					<td>
					<?php
					// Facture
					if($factures!=null){
					foreach($factures as $fct)
					{ 
					  $Nfct=explode("/",$fct['numFacture']);
					?>
					<?php echo $fct['mantant'].'<br>';
					}}
					else
					{
						
					}
					// Facture New
					if($Autrefactures!=null){
					foreach($Autrefactures as $fctA)
					{ 
					  $NfctA=explode("/",$fctA['numFacture']);
					?>
					<?php echo $fctA['mantant']?>
					<br>
					<?php }}
					echo '<hr>';
					@$sommes=$sommeMnt+$sommeMntA;
						echo $sommes;
					?>  
					
					</td>	
					<td>
					  <?php 
					$mdos=$facture->getMDOAO($cle['code_AO']);
					if($mdos!=null)
					{
					foreach($mdos as $md)
					{
						
					@$res=$md['hono']-($sommeMnt+$sommeMntA);
					echo  $res;
					}
					}
					?>
					</td>
					<td>
					<?php
                    /* echo $sommeMnt;echo '<br>';echo $sommeMntA;echo '<br>';echo $sommeMntRP;echo '<br>';echo $sommeMntRPA;echo '<br>';*/
					 
						echo ($sommeEnvoye+$sommeEnvoyeA)-($sommeMntRP+$sommeMntRPA);

					?>  
					
					</td>
					<?php }

					?>
                    </tr>
					<?php
										
					
					}
					?>
              
                  </tbody>
				  <?php if($_SESSION['user']=='Admin'){?>
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
				  <?php }?>
                </table>
				
              </div>
            </div>
           
          </div>
		  

         