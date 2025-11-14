<style>

 table tr th{font-size:13px; text-align:center; font-weight:bold}
 table tr td{font-size:11px;}

</style>
<?php
$tabarrive=$arrive->getArrives();
$mdoArrive=$AO->AfficherMDOoffre();
/********Recherche MDO Offre***********/

if(isset($_POST['btnrechercheMDO']))
{ 
		if($_POST['rechercheMDO']=='All')
		{
		$tabarrive=$arrive->getArrives();
		}
		else{
		
		
		$tabarrive=$arrive->AfficherArrivesMDO($_POST['rechercheMDO']);
		}
		
		$_SESSION['mdoArrive']=$_POST['rechercheMDO'];
		
}//Fin isset($_POST['btnrechercheMDO']
else if(isset($_SESSION['mdoArrive']))
			{
					  if($_SESSION['mdoArrive']=='All')
					  {
					 $tabarrive=$arrive->getArrives();
					  }
					  else{
					@$tabarrive=$arrive->AfficherArrivesMDO($_SESSION['mdoArrive']);
					}
			}

	else	{ 
		 $tabarrive=$arrive->getArrives();
		}



/*******Fin Recherche MDO Offre**********/
if(isset($_GET['id_delete']))
{
 if($arrive->deleteArrive($_GET['id_delete']))
 {
 
 
echo "<script>document.location.href='sigma.php?Arrive_Afficher'</script>";
 }
}
?>
          <!-- DataTables Example -->
          <div class="card mb-3">
		  <table width=100%>
		  <tr><td width=40%>
            <div class="card-header">
			
              <i class="fas fa-table"></i>
              <b style="font-size:20px;position:relative;top:-20px;left:-00px;float:left">LES ARRIVES</b>
			  <a href="?Add&Arrive_Ajout" style="width:220px;position:relative;top:-20px;left:100px;float:left"  class="btn btn-primary btn-block" >Ajout</a>
			  </div>
			  </td>
			  
			     <td width=50%>
			  <!--debut Recherche-->
			  <form method="post" style="width:220px;position:relative;top:0px;margin-bottom:30px" >
				 <input type="submit" name="btnrechercheMDO" value="Recherche MDO" class="btn btn-primary btn-block" >
				 <select class="form-control" name="rechercheMDO">
				 <?php if(isset($_SESSION['mdoArrive'])){?>
				      <option selected><?php echo $_SESSION['mdoArrive']?></option>
				 <?php } ?>
				 
				  <option>All</option>
				  <?php if(count($mdoArrive)>0){


                     foreach($mdoArrive as $md){
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
                      
                      <th>Date...</th>
					  <th >Code.P</th>
					  <th>Code.SP</th>
					  <th>MDO</th>
					  <th>Titre_Projet</th>
                      <th>Lot</th>
					   <th>Emis Par</th>
					    <th>Affaire</th>
						<th>Phase</th>
                      <th>Mission</th>
					  
					  <th>Architect</th>
					  <th>Mod</th>
					  <th>Sup</th>
                    </tr>
                  </thead>
                  
                  <tbody>
				  <?php 
				  $row=count($tabarrive);
				  if($row>0)
				  {
				  foreach($tabarrive as $cle)
				  {?>
                    <tr <?php  if($cle['typeuser']=='utilisateur'){?> bgcolor="yellow"<?php } ?>>
                      
                      <td><?php echo $cle['date']?></td>
					    <td>
						<?php if($cle['code_sousprojet']=='ponct')
						{
							echo '<b>PP</b>';
						}
						else {
							echo '<b>C</b>';
						}
						?>
						
						<?php echo $cle['code']?></td>
					   <td><?php echo $cle['code_sousprojet']?></td>
					  <td><?php echo $cle['mdo']?></td>
					    <td>
						
						<?php
						/*
                               $IntituleProjet=$arrive->getIntituleProjet($cle['code']);
							   if($IntituleProjet!=''){
							   foreach($IntituleProjet as $tab);*/
                      
						echo $cle['projet'];
					  //}
						?>
						
						
						</td>
					   <td><?php echo $cle['lot']?></td>
                      <td><?php echo $cle['emis_par']?></td>
					  <td><?php echo $cle['affaire']?></td>
					  <td><?php echo $cle['phse']?></td>
                     <td><?php echo $cle['miss']?></td>
					
					  <td><?php echo $cle['architecte']?></td>
					   <?php if($_SESSION['user']=='utilisateur'){
					                if($cle['typeuser']=='utilisateur')
												{
					               ?>
					  <td align="center"><a href="?Arrive_Afficher&id_modifier=<?php echo $cle['id']?>"><img src="images/update.jpg" width="25" height="25"></a></td>
					  <td><a href="?Arrive_Afficher&id_delete=<?php echo $cle['id']?>"><img src="images/delete.jpg" width="25" height="25" ></a></td>
                     <?php }
					  else {?>
					  <td><b style="font-size:15px">Admin</b></td>
					 <td><b style="font-size:15px">Admin</b></td>
					 <?php }
					   }
					   else if($_SESSION['user']=='Admin'  or $_SESSION['user']=='Admin2' ){
					?>
					 <td align="center"><a href="?Arrive_Afficher&id_modifier=<?php echo $cle['id']?>"><img src="images/update.jpg" width="25" height="25"></a></td>
					  <td><a href="?Arrive_Afficher&id_delete=<?php echo $cle['id']?>"><img src="images/delete.jpg" width="25" height="25" ></a></td>
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

         