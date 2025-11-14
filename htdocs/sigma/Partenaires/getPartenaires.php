<style>

 table tr th{font-size:13px; text-align:center; font-weight:bold}
 table tr td{font-size:11px;}

</style>
<?php
$tabpartenaires=$partenaires->AfficherPartenaires();
if(isset($_GET['id_delete']))
{
 if($partenaires->deletePartenaire($_GET['id_delete']))
 {
  //echo "<script>alert('Partenaire Supprimé')</script>";
 
echo "<script>document.location.href='sigma.php?Partenaire_Afficher'</script>";
 }
}
?>
          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              <b style="font-size:20px;position:relative;top:0px;left:-00px">NOS PARTENAIRES</b></td>
			   <a href="?Partenaire_Ajout" style="width:220px; ; margin:auto;position:relative; top:-30px;"   class="btn btn-primary btn-block" >Ajout</a>
			  
			  </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Client</th>
                      <th>Désignation</th>
					  <th>Type</th>
                      <th>Date décharge</th>
                      <th>Adresse</th>
                      <th>Fax</th>
                      <th>Tél</th>
					  <th>Email</th>
					  <th>Contact</th>
					  <th>Modifier</th>
					  <th>Supprimer</th>
                    </tr>
                  </thead>
                  
                  <tbody>
				  <?php 
				  $row=count($tabpartenaires);
				  if($row>0)
				  {
				  foreach($tabpartenaires as $cle)
				  {?>
                    <tr <?php  if($cle['typeuser']=='utilisateur'){?> bgcolor="yellow"<?php } ?>>
                      <td><?php echo $cle['client']?></td>
                      <td><?php echo $cle['designation']?></td>
					  <td><?php echo $cle['type']?></td>
                      <td><?php echo $cle['date_decharge']?></td>
                      <td><?php echo $cle['Adresse']?></td>
                      <td><?php echo $cle['fax']?></td>
					  <td><?php echo $cle['tel']?></td>
					  <td><?php echo $cle['email']?></td>
					  <td><?php echo $cle['contact']?></td>
					   <?php if($_SESSION['user']=='utilisateur'){
					                if($cle['typeuser']=='utilisateur')
												{
					               ?>
					  <td align="center"><a href="?Partenaire_Afficher&id_modifier=<?php echo $cle['id']?>"><img src="images/update.jpg" width="25" height="25"></a></td>
					  <td><a href="?Partenaire_Afficher&id_delete=<?php echo $cle['id']?>"><img src="images/delete.jpg" width="25" height="25"></a></td>
                      <?php }
					  else {?>
					  <td><b style="font-size:15px">Admin</b></td>
					 <td><b style="font-size:15px">Admin</b></td>
					 <?php }
					   }
					   else if($_SESSION['user']=='Admin' or $_SESSION['user']=='Admin2'){
					?>
					 <td align="center"><a href="?Partenaire_Afficher&id_modifier=<?php echo $cle['id']?>"><img src="images/update.jpg" width="25" height="25"></a></td>
					  <td><a href="?Partenaire_Afficher&id_delete=<?php echo $cle['id']?>"><img src="images/delete.jpg" width="25" height="25"></a></td>
					
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

         