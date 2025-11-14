<style>

 table tr th{font-size:13px; text-align:center; font-weight:bold}
 table tr td{font-size:11px;}

</style>
<?php

/*****************/
$tabsortie=$sortie->getSorties();
if(isset($_GET['id_delete']))
{
 if($sortie->deletesortie($_GET['id_delete']))
 {
  
 
echo "<script>document.location.href='sigma.php?Sortie_Afficher'</script>";
 }
}
?>
          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              <b style="font-size:20px;position:relative;top:00px;left:50px">LES SORTIES</b></td>
			 <a href="?Sortie_Ajout&redirect=SS" style="width:220px; ; margin:auto;position:relative; top:-30px;"   class="btn btn-primary btn-block" >Ajout</a>
			  </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      
                      <th>Date...</th>
					   <th>Code.P</th>
					   <th>Code SP</th>
					   <th>MDO</th>
					   <th>Titre_Projet</th>
					  <th>Lot</th>
                      <th>Emis par</th>
					 
                     
					 
                      <th>Phase</th>
                      <th>Document</th>
					<th>Mod</th>
					
					  <th>Sup</th>
					
                    </tr>
                  </thead>
                  
                  <tbody>
				  <?php 
				  $row=count($tabsortie);
				  if($row>0)
				  {
				  foreach($tabsortie as $cle)
				  {?>
                    <tr <?php  if($cle['user']=='utilisateur'){?> bgcolor="yellow"<?php } ?>>
                      <td><?php echo $cle['date_sortie']?></td>
					    <td>
						<?php if($cle['codesp']=='ponct')
						{
							echo '<b>PP</b>';
						}
						else {
							echo '<b>C</b>';
						}
						?>
						
						<?php echo $cle['code']?>
						</td>
					    <td><?php echo $cle['codesp']?></td> 
						<td><?php echo $cle['mdo']?></td>
						 <td>
					  <?php
					  $prs=$sortie->GetIntituleProjet($cle['code']);
					  /*if(@count($prs)>0)
					  {
                      foreach($prs as $p);
					  echo $p['intitule'];
					  }*/
					   echo $cle['projet'];
					  ?>
					  </td>
					  <td><?php echo $cle['lot_sortie']?></td>
                      
                      <td><?php echo @$cle['emis_par']?></td>
					  
                     
					 
					
                      <td><?php echo $cle['phse']?></td>
					  <td><a href="Sortie/references/<?php echo $cle['reference']?>" target="_blank"><?php echo $cle['reference']?></td>
					  
					 
					    <?php if($_SESSION['user']=='Admin'  or $_SESSION['user']=='Admin2' )
		               { ?>  
					 
					 <td align="center"><a href="?Sortie_Ajout&SRP&Sortie_Ajouter&code_projet=<?php echo $cle['code']?>&projet=<?php echo $cle['projet']?>&mdo=<?php echo $cle['mdo']?>&idS=<?php echo $cle['id']?>&sortie=<?php echo $cle['date_sortie']?>&CodeSP=<?php echo $cle['codesp']?>&redirect=SS"><img src="images/update.jpg" width="25" height="25"></a></td>
					  <td><a href="?Sortie_Afficher&id_delete=<?php echo $cle['id']?>"><img src="images/delete.jpg" width="25" height="25" ></a></td>
                     <?php } else if($_SESSION['user']=='utilisateur'){ 
					        if($cle['user']=='utilisateur')
						   {
					 ?>
					 
					  <td align="center"><a href="?Sortie_Ajout&SRP&Sortie_Ajouter&code_projet=<?php echo $cle['code']?>&projet=<?php echo $cle['projet']?>&mdo=<?php echo $cle['mdo']?>&idS=<?php echo $cle['id']?>&sortie=<?php echo $cle['date_sortie']?>&CodeSP=<?php echo $cle['codesp']?>&redirect=SS"><img src="images/update.jpg" width="25" height="25"></a></td>
					  <td><a href="?Sortie_Afficher&id_delete=<?php echo $cle['id']?>"><img src="images/delete.jpg" width="25" height="25" ></a></td>
					 
					 <?php }} ?>
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

         