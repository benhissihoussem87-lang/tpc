<style>

 table tr th{font-size:13px; text-align:center; font-weight:bold}
 table tr td{font-size:11px;}

</style>
<?php
$cheques=$ch->getcheques();
$encours=$ch->getchequesEtatEncour();
if(isset($_GET['id_delete']))
{
 if($ch->deletecheques($_GET['id_delete']))
 {
  //echo "<script>alert('Partenaire Supprimé')</script>";
 
echo "<script>document.location.href='sigma.php?AfficherCH'</script>";
 }
}
?>
          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
             <b style="font-size:20px;position:relative;top:0px;left:-00px">LES CHEQUES</b></td>
			 <table width=50% align="center">
			 <tr>
			 <th> <a href="?ch_Ajout&STB" style="width:220px; ; margin:auto;position:relative; top:-30px;"   class="btn btn-primary btn-block" >CHQ STB</a></th>
			
			 </tr>
			 </table>
			  
			
			  
			  </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Num</th>
                      <th>Ordre de</th>
					  <th>Date sortie</th>
                      <th>Montant</th>
                      <th>Date echeance</th>
                      <th>Etat</th>
                      <th>Date Payement</th>
					  <th>Soldes</th>
					 
					  <th>Modifier</th>
					  <th>Supprimer</th>
                    </tr>
                  </thead>
                  
                  <tbody>
				  <?php 
				  $row=count($cheques);
				  if($row>0)
				  {
				  foreach($cheques as $cle)
				  { if($cle['autre']=='STB'){?>
				   <?php
  				   if($_SESSION['user']=='Admin'){?>
                    <tr  <?php  if($cle['typeuser']=='utilisateur'){?> bgcolor="yellow"<?php } ?>>
                      <td><?php echo $cle['num']?></td>
                      <td><?php echo $cle['ordre_de']?></td>
					  <td><?php echo $cle['date_sortie']?></td>
                      <td><?php echo $cle['montant']?></td>
                      <td><?php echo $cle['date_echeance']?></td>
                      <td><?php echo $cle['etat']?></td>
					  <td><?php echo $cle['date_payement']?></td>
					  <td><?php echo $cle['soldes']?></td>
					 
					  <td align="center"><a href="?ModifierCH&id_modifier=<?php echo $cle['id']?>"><img src="images/update.jpg" width="25" height="25"></a></td>
					  <td><a href="?AfficherCH&id_delete=<?php echo $cle['id']?>"><img src="images/delete.jpg" width="25" height="25"></a></td>
                     
                    </tr>
					<?php }if($_SESSION['user']=='utilisateur'){
					                if($cle['typeuser']=='utilisateur')
												{
					               ?>
								    <tr >
                      <td><?php echo $cle['num']?></td>
                      <td><?php echo $cle['ordre_de']?></td>
					  <td><?php echo $cle['date_sortie']?></td>
                      <td><?php echo $cle['montant']?></td>
                      <td><?php echo $cle['date_echeance']?></td>
                      <td><?php echo $cle['etat']?></td>
					  <td><?php echo $cle['date_payement']?></td>
					  <td><?php echo $cle['soldes']?></td>
					 
					  <td align="center"><a href="?ModifierCH&id_modifier=<?php echo $cle['id']?>"><img src="images/update.jpg" width="25" height="25"></a></td>
					  <td><a href="?AfficherCH&id_delete=<?php echo $cle['id']?>"><img src="images/delete.jpg" width="25" height="25"></a></td>
                     
                    </tr>
					<?php 
					}
					}
					}
				  }}
					?>
                
				   
				
                  </tbody>
				    <?php
  				   if($_SESSION['user']=='Admin'){?>
				  <tr bgcolor="#A8B1C1">
				   
					
					<td><b style="font-size:16px">Num</b></td>
                    <td><b style="font-size:16px"></b></td>
					<td></td>
					<td><b style="font-size:16px">Montant</b></td>
					<td><b style="font-size:16px">Date echeance</b></td>
					<td></td><td></td><td></td><td></td><td></td>
				   </tr>
				  <?php
				
				  $rowch=count($encours);
				  if($rowch>0)
				  {
				  foreach($encours as $clech)
				  { if($clech['autre']=='STB'){?>
				   <tr bgcolor="#A8B1C1" >
				   
					
					<td><span style="font-size:14px"><?php echo $clech['num']?></span></td>
                    <td></td>
					<td></td>
					<td><span style="font-size:14px"><?php echo $clech['montant']?></span></td>
					<td><span style="font-size:14px"><?php echo $clech['date_echeance']?></span></b></td>
					<td></td><td></td><td></td><td></td><td></td>
				   </tr>
				  
				  
				   <?php }} }} ?>
                </table>
              </div>
            </div>
            
          </div>

         