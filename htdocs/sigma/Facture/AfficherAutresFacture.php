<style>

 table tr th{font-size:13px; text-align:center; font-weight:bold}
 table tr td{font-size:11px;}

</style>
<?php
 if(!isset($_POST['AfficherFactureImpaye']))
 {
	 $check="0";
$tabfacture=$Autresfacture->getFacture();
 }
 else 
 {
	if($_POST['fact']=='impaye'){
		$check="1";
 $tabfacture=$Autresfacture->getFactureImpayes(); 
	 }
 }
if($_SESSION['user']=='utilisateur')
{
$tabfacture=$Autresfacture->getFactureImpayes(); 	
}

$mdoFactures=$AO->AfficherMDOoffre();
/********Recherche MDO Offre***********/

if(isset($_POST['btnrechercheMDO']))
{ 
		if($_POST['rechercheMDO']=='All')
		{
		$tabfacture=$Autresfacture->getFacture();
		}
		else{
		
		
		$tabfacture=$Autresfacture->AfficherFactureMDO($_POST['rechercheMDO']);
		}
		
		$_SESSION['mdoFacture']=$_POST['rechercheMDO'];
		
}//Fin isset($_POST['btnrechercheMDO']
else if(isset($_SESSION['mdoFacture']))
			{
					  if($_SESSION['mdoFacture']=='All')
					  {
					 $tabfacture=$Autresfacture->getFacture();
					  }
					  else{
					@$tabfacture=$Autresfacture->AfficherFactureMDO($_SESSION['mdoFacture']);
					}
			}

	/*else	{ 
		 $tabfacture=$facture->getFacture();
		}*/



/*******Fin Recherche MDO Offre**********/

if(isset($_GET['id_delete']))
{
 $infosfacture=$Autresfacture->getInfosFacture($_GET['id_delete']);
 foreach($infosfacture as $vlF);
// echo '<h1>'.$vlF['numFacture'].'</h1>';
 $Autresfacture->deleteRCP($vlF['numFacture']);
 if($Autresfacture->deletefactures($_GET['id_delete']))
 {

 $facturesBRD=$_GET['facture'].'/'.$_GET['Datefacture'];
 $borderos->deleteBorderoFacture($facturesBRD);
 
echo "<script>document.location.href='sigma.php?AfficherFacture'</script>";
 }
}
?>
          <!-- DataTables Example -->
          <div class="card mb-3">
		  <table width=100%>
		  <tr><td width=20%>
            <div class="card-header">
              <i class="fas fa-table"></i>
              <b style="font-size:20px;position:relative;top:-20px;left:-00px;float:left">Autres FACTURES</b>
			 
			  </div>
			   </td>
			   <?php if($_SESSION['user']!='utilisateur'){?>
			   <td width=30%>
			   <form method="post" style="padding-left:20px">
			  <table width="80%">
			  <tr>
			  <td><input type="radio" name="fact" value="impaye" <?php if($check=='1'){echo 'checked';}?> style="width:20px;height:20px" >
			   <b style="font-size:20px">IMPAYE   </b></td>
			    
			   <td> <input type="submit" value="Afficher" name="AfficherFactureImpaye" class="btn btn-primary btn-block"></td>
			   </tr>
			   </table>
			   </form>
			   
			   </td>
			   <?php 
			   }
			   ?>
			  
			     <td width=50% > 
			  <!--debut Recherche-->
			  <form method="post" style="width:220px;position:relative;top:0px;margin-bottom:30px" >
				 <input type="submit" name="btnrechercheMDO" value="Recherche MDO" class="btn btn-primary btn-block" >
				 <select class="form-control" name="rechercheMDO">
				 <?php if(isset($_SESSION['mdoFacture'])){?>
				      <option selected><?php echo $_SESSION['mdoFacture']?></option>
				 <?php } ?>
				 
				  <option>All</option>
				  <?php if(count($mdoFactures)>0){


                     foreach($mdoFactures as $md){
				  ?>
				  
				  <option>  <?php echo $md['mdo'] ?></option>
				  
				  
				  <?php }} ?>
				 
				 </select>
				
				
				 </form>
			   <!--Fin Recherche-->
			    </td>
			  </table>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      
                      <th>Num Facture</th>
					  <th>Code Offre</th>
                      <th>Code Projet</th>
					  <th>MDO</th>
                      <th>Titre_Projet</th>
					  <th>Montant</th>
					   <th>D.Facture</th>
                      <th>D.Envoi</th>
                      <th>D.Recouvre</th>
					  <th>Lien</th>
					
					  <th>Sup</th>
                    </tr>
                  </thead>
                  
                  <tbody>
				  <?php 
				  $totImp=0;
				  $row=count($tabfacture);
				  if($row>0)
				  {
				 
				  foreach($tabfacture as $cle)
				  {
					 
					 
					  
					  
					  ?>
                    <tr  <?php if($cle['recouvre']==null){ $totImp=$totImp+$cle['mantant']; ?>bgcolor="yellow" <?php }?>  >
                      <td>
					  <?php
					   if($_SESSION['user']=='utilisateur'){?>
						   <span class="btn btn-outline-info" style="padding:2px 8px;font-size:12px">
						   <?php echo $cle['numFacture'].'/'.$cle['annee'];?></span>
					  <?php }
					   if($_SESSION['user']=='Admin'){
						   ?>
		<a href="?FactureNews&Param=facture&Facture_Modifier&numFacture=<?php echo $cle['numFacture']?>&anneeFacture=<?php echo $cle['annee']?>&Facture=<?php echo $cle['facture']?>&recouvre=<?php echo $cle['recouvre']?>&envoye=<?php echo $cle['envoye']?>&id=<?php echo $cle['id']?>&codeP=<?php echo $cle['codeProjet']?>&etat=<?php echo $cle['avancement']?>&codeAO=<?php echo $cle['codeAO']?>&titre=<?php echo $cle['titre']?>&intitule=<?php echo $cle['intitule']?>&mdo=<?php echo $cle['mdo']?>" class="btn btn-outline-info" style="padding:2px 8px;font-size:12px">

					  <?php echo $cle['numFacture'].'/'.$cle['annee']?>
					  
					  </a>
					   <?php } ?>
					  </td>
					  <td><b>OP</b><?php echo $cle['codeAO']?></td>
                      
                      <td><b>C</b><?php echo $cle['codeProjet']?></td>
					   <td><?php echo $cle['mdo']?></td>
                     
					  <td><?php 
					  if($cle['codeAO']=='Ponct')
					 {echo $cle['titre'];}
					 else
					 {
					  echo $cle['intitule'];
					  }
					  ?></td>
					  <td><?php echo $cle['mantant']?></td>
					    <td><?php echo $cle['facture']?></td>
                      <td><?php echo $cle['envoye']?></td>
					  <td><?php echo $cle['recouvre']?></td>
					  <td><a href="Facture/Lien/<?php echo $cle['lien']?>" target="_blank">
					  <?php echo $cle['lien']?></a>
					  
					 
					    
					 
					 
					  <td><a href="?AfficherFacture&id_delete=<?php echo $cle['id']?>&facture=<?php echo $cle['numFacture']?>&Datefacture=<?php echo $cle['annee']?>"><img src="images/delete.jpg" width="25" height="25" ></a></td>
                     
                    </tr>
					<?php 
					   
					
					}// Fin Foreach
						
					
					}
					?>
					<?php if($_SESSION['user']=='Admin'){ ?>
                 <tr bgcolor="#A8B1C1"> <td> </td><td> </td><td> </td><td> </td>
				 <td><b style="font-size:16px"> Factures Impayés</b></td>
				 <td><b style="font-size:16px"> <?php echo $totImp ?></b></td>
				 <td> </td><td> </td><td> </td><td> </td><td> </td> </tr>
					<?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
            
          </div>

         