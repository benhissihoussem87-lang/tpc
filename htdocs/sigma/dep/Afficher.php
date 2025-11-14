<style>

 table tr th{font-size:13px; text-align:center; font-weight:bold}
 table tr td{font-size:11px;}

</style>
<?php
if($_SESSION['user']=='utilisateur')
{
   $deps=$dep->getdepsUtilisateur();
}
else
{
$deps=$dep->getdeps();
$depsMaxDate=$dep->getTotaldeps();

}

//$dep=$dep->getdep();
if(isset($_GET['delete_dep']))

{
 if($dep->deletedep($_GET['delete_dep']))
 {
 echo "<script>document.location.href='sigma.php?AfficherDep'</script>";
 }
}
?>
          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
             <table style="position:relative;left:120px; top:-30px"  width=90%>
			  <tr>
			   <td>  <b style="font-size:20px;position:relative;top:00px;left:-70px">Depenses</b></td>
			  <td><a href="?dep_Ajout" style="width:220px; ; margin:auto;position:relative;top:30px;left:-150px;z-index:1000"   class="btn btn-primary btn-block" >Ajout</a></td>
			  
			  <td>

			  </table>
			  </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      
                      <th>DATE</th>
                      <th>Montant</th>
                     <th>Raison</th>
					  
					    <th>Benéficiare</th>
						<?php if($_SESSION['user']=='Admin')
						{?>
						
						
						<th>Alimentation</th>
						
						<th>Journal-Caisse</th>
						<th>Permenant</th>
						<?php } ?>
					   <th >Action</th>
                    </tr>
                  </thead>
                  
                  <tbody>
				  <?php 
				   $caisse=0;
				    $j=0;
				   $alimentation=0;
				   $journal_caisse=0;
				  $row=count($deps);
				  if($row>0)
				  {
					  
				  foreach($dep as $cledep);
				  /******/
					
						
                  foreach($depsMaxDate as $cleV);
				 
					 //echo 'date '.$cleV['Maxdate'] .' '.$cleV['journal_caisse'].'<br>';
					  
				 
				
				/********/
				  foreach($deps as $cle)
				  {
					  // array_push($perm, $cle['Montant']);
				   //Traitement de caisse
				   
				    $caisse=0;
					 $alimentation=0;
				  
				   
				   
				   //Fin raitement caisse
				   
				    //Traitement de Alimentation
				   if($cle['RAISON']=='Alimentation Caisse' )
				   {
					  
					   $alimentation=$cle['Montant'];
					  
				   }
				   else 
				   {
				    $alimentation=0;
				   }
				   
				   
				   //Fin raitement Alimentation
				   
				   
				     $journal_caisse=0;
				  ?>
                    <tr  <?php  if($cle['typeuser']=='utilisateur'){?> bgcolor="yellow"<?php } ?>>
                    <td><?php echo $cle['DATE']?></td>
					   <td>
					   <?php
                   /* if($cle['num_CHQ']==0)
					   {
					   echo $cle['Beneficiare'];
					   
					   }
					   else{*/echo $cle['Montant'];//}
					   ?>
					   </td>
            			<td><?php  echo $cle['RAISON']?></td>	
	                    				
                      
					    <td><?php echo $cle['Beneficiare']?></td>
						<?php if($_SESSION['user']=='Admin')
						{?>
						 
						  <td><?php echo $alimentation?></td>
							  <td>
							  <?php
							    echo $cle['journal_caisse'];
							  ?>
							  </td>
							   <td>
							  <?php
                               if($cle['RAISON']=='Alimentation Caisse')
							   {
								   $total=$cle['Montant']+$journal_caisse;
								   $dep->ModifierJournalCaisse($cle['id'],$total);
							  echo $total;
							   }
							   else if($cle['RAISON']=='Frais')
							   {
								   $total=$journal_caisse-$cle['Montant'];
							  echo $total;
							   }
							   else if($cle['RAISON']=='Salaire')
							   {
								   $total=$journal_caisse-$cle['Montant'];
							  echo $total;
							  
							   }
							  ?>
							  </td>
							  <?php }?>
					 <?php if($_SESSION['user']=='utilisateur'){
					                if($cle['typeuser']=='utilisateur')
												{
					               ?>
					
					 <td><a href="?AfficherDep&delete_dep=<?php echo $cle['id']?>"><img src="images/delete.jpg" width="25" height="25"></a>
                 <a href="?ModifierDep&dep_modifier=<?php echo $cle['id']?>">
				 <img src="images/update.jpg" width="25" height="25"></a></td>
                      <?php }
					  else {?>
					  <td><b style="font-size:15px">Admin</b></td>
					
					 <?php }
					   }
					   else if($_SESSION['user']=='Admin'){
					?>
					<td><a href="?AfficherDep&delete_dep=<?php echo $cle['id']?>"><img src="images/delete.jpg" width="25" height="25"></a>
                 <a href="?ModifierDep&dep_modifier=<?php echo $cle['id']?>">
				 <img src="images/update.jpg" width="25" height="25"></a></td>
					
					<?php } ?>
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

         