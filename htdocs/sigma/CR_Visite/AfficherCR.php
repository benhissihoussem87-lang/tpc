<style>

 table tr th{font-size:13px; text-align:center; font-weight:bold}
 table tr td{font-size:11px;}

</style>
<?php
if(isset($_GET['code_projet']))
{
$tabcr=$cr->getCRS($_GET['code_projet']);
}
else if(isset($_GET['SPprojet']))
{
$tabcr=$cr->getCRSP($_GET['SPprojet']);
}
else
{
$tabcr=$cr->getCRSALL();
}
if(isset($_GET['id_delete']))
{
 if($cr->deleteCR($_GET['id_delete']))
 {
  
 
echo "<script>document.location.href='sigma.php?CR_Afficher'</script>";
 }
}
?>
          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              <b style="font-size:20px;position:relative;top:0px;left:-00px">LES C.R.VISITES</b>
			 
			  </td>
			  <?php  if($_SESSION['user']=='Admin' or $_SESSION['user']=='utilisateur' or $_SESSION['user']=='Admin2')
					  {
					  ?>
			  <?php if(isset($_GET['code_projet'])){ ?>
			    <a href="?CR_Ajout&code_projet=<?php echo $_GET['code_projet']?>&projet=<?php echo $_GET['projet']?>&mdo=<?php echo $_GET['mdo']?>&crv" style="width:220px; ; margin:auto;position:relative; top:-30px;"   class="btn btn-primary btn-block" >Ajout</a>
			 <?php }else{ ?>
<a href="?CR_Ajouter" style="width:220px; ; margin:auto;position:relative; top:-30px;"   class="btn btn-primary btn-block" >Ajout</a>
              <?php } ?>
			  <?php } ?>
			 </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      
                      <th>Date...</th>
					  <th>Code</th>
					  <th>Code SP</th>
					  <th>MDO</th>
                      <th>Titre_Projet</th>
					  <th>Lot</th>
                      <th>Emis par</th>
					<th>Reference</th> 
					  
					  <th>Mod</th>
					 
					
					  <th>Sup</th>
                    </tr>
                  </thead>
                  
                  <tbody>
				  <?php 
				  $row=count($tabcr);
				  if($row>0)
				  {
				  foreach($tabcr as $cle)
				  {?>
				  
                    <tr  <?php if($cle['user']=='utilisateur' ){?> bgcolor="yellow"<?php } ?>>
                      <td><?php echo $cle['date_cr']?></td>
					   <td><b>C</b><?php echo $cle['code']?></td>
					  <td><?php echo $cle['codesp']?></td>
					   <td><?php echo $cle['mdo']?></td>
					  <td>
					  <?php 
					  $prs=$cr->GetIntituleProjet($cle['code']);
					  if(@count($prs)>0)
					  {
                      foreach($prs as $p);
					  echo $p['intitule'];
					  }
					  ?>
					  
					  </td>
					  <td><?php echo $cle['lot_cr']?></td>
                      
                      <td><?php echo $cle['emis_par']?></td>
					  
                     
					  
					 
					  <td><a href="CR_Visite/references/<?php echo $cle['reference']?>" target="_blank">
					  <?php echo $cle['reference']?></a>
					  </td>
                      
					  
					 
					    
					 <?php if($_SESSION['user']=='Admin'  or $_SESSION['user']=='Admin2' )
									{ ?>  
					  <td align="center"><a href="?CR_Afficher&projet=<?php echo $cle['projet']?>&id_modifier=<?php echo $cle['id']?>&datecrv=<?php echo $cle['date_cr']?>&code_projet=<?php echo $cle['code']?>&code_sp=<?php echo $cle['codesp']?>&mdo=<?php echo $cle['mdo']?>">
					  <img src="images/update.jpg" width="25" height="25">
					  </a></td>
					  <td><a href="?CR_Afficher&id_delete=<?php echo $cle['id']?>"><img src="images/delete.jpg" width="25" height="25"></a></td>
                     <?php } ?>
					  <?php if($_SESSION['user']=='utilisateur'){
					       if($cle['user']=='utilisateur')
						   {
					  ?>
					   <td align="center"><a href="?CR_Afficher&projet=<?php echo $cle['projet']?>&id_modifier=<?php echo $cle['id']?>&datecrv=<?php echo $cle['date_cr']?>&code_projet=<?php echo $cle['code']?>&code_sp=<?php echo $cle['codesp']?>&mdo=<?php echo $cle['mdo']?>">
					  <img src="images/update.jpg" width="25" height="25">
					  </a></td>
					    <td><a href="?CR_Afficher&id_delete=<?php echo $cle['id']?>"><img src="images/delete.jpg" width="25" height="25"></a></td>
					  
					  <?php }else { ?>
					  <td><b style="font-size:15px">Admin</b></td>
					  <td><b style="font-size:15px">Admin</b></td>
					  <?php } } ?> 
					   
					  
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

         