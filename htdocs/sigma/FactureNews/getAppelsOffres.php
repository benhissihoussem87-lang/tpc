
<style>

 .table tr th{font-size:13px; text-align:center; font-weight:bold}
 .table tr td{font-size:12px;}
.statistique tr td{color:black; font-size:18px}
</style>
<?php
$projets=$projet->AfficherProjet();
$annes_offre=$AO->getAppelOffreStatistiqueAnne();
$types_offre=$AO->getAppelOffreStatistiqueTypeOffre();
$mois_offre=$AO->getAppelOffreStatistiqueMois();
$mdo_offre=$AO->getAppelOffreStatistiqueMDO();
if(isset($_GET['codeP']))
{
$arrive_ST=$arrive->getArrives_ST($_GET['codeP']);
$arrive_EL=$arrive->getArrives_EL($_GET['codeP']);
$arrive_SI=$arrive->getArrives_SI($_GET['codeP']);
$arrive_FL=$arrive->getArrives_FL($_GET['codeP']);
$arrive_Autre=$arrive->getArrives_Autre($_GET['codeP']);
$arrive_Autres=$arrive->getArrives_Autre($_GET['codeP']);

////////////sortie

$sortie_ST=$sortie->getArrives_ST($_GET['codeP']);
$sortie_EL=$sortie->getArrives_EL($_GET['codeP']);
$sortie_SI=$sortie->getArrives_SI($_GET['codeP']);
$sortie_FL=$sortie->getArrives_FL($_GET['codeP']);
$sortie_Autre=$sortie->getArrives_Autre($_GET['codeP']);
$sortie_Autres=$sortie->getArrives_Autre($_GET['codeP']);
}
if(isset($_GET['AO_delete']))
{

if($_GET['AO_etat']==2)
{
 echo "<script>alert('Merci de supprimer le projet ...')</script>";
 }
 else if($_GET['AO_etat']!=2) {
 if($AO->deleteAO($_GET['AO_delete']))

 {
echo "<script>document.location.href='sigma.php?AO_Affiche'</script>";

}
}

}

?>
<!--Modal Statistique Offre de Prix-->
  
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
  <form method="post">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Statistique</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
		<table width=100%>
		<tr>
		<td>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Année:</label>
			<select style="width:80px"class="form-control" name="annee" id="recipient-name">
			<?php 
			$an=count($annes_offre);
			if($an>0)
			{
			foreach($annes_offre as $cle_an)
			{
			 $lnan=$cle_an['code'];
			 //$annee=$lnan['0'].$lnan['1'];
			?>
			<option><?php echo $cle_an['code']?></option>
			<?php
			}
			}
			?>
			</select>
           
          </div>
		  </td>
		  <td>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Mois:</label>
            <select style="width:80px"class="form-control" name="mois" id="message-text">
			
			<?php 
			$moi=count($mois_offre);
			if($moi>0)
			{
			foreach($mois_offre as $cle_mois)
			{
			 //$lnan=$cle_mois['mois'];
			 //$annee=$lnan['0'].$lnan['1'];
			?>
			<option><?php echo $cle_mois['mois']?></option>
			<?php
			}
			}
			?>
			</select>
          </div>
		  </td>
		  
		  <td>
          <div class="form-group">
            <label for="message-mdo" class="col-form-label">MDO:</label>
            <select style="width:80px"class="form-control" name="mdo" id="message-mdo">
			
			<?php 
			$mdo=count($mdo_offre);
			if($mdo>0)
			{
			foreach($mdo_offre as $cle_mdo)
			{
			 //$lnan=$cle_mois['mois'];
			 //$annee=$lnan['0'].$lnan['1'];
			?>
			<option><?php echo $cle_mdo['designation']?></option>
			<?php
			}
			}
			?>
			</select>
          </div>
		  </td>
		  
		   <td>
          <div class="form-group">
            <label for="message-mdo" class="col-form-label">TYPE:</label>
            <select style="width:80px"class="form-control" name="type" id="message-mdo">
			
			<?php 
			$type=count($types_offre);
			if($type>0)
			{
			foreach($types_offre as $cle_type)
			{
			 //$lnan=$cle_mois['mois'];
			 //$annee=$lnan['0'].$lnan['1'];
			?>
			<option><?php echo $cle_type['type']?></option>
			<?php
			}
			}
			?>
			</select>
          </div>
		  </td>
		  <td >
		  <div class="form-group">
            <label for="message-mdo" class="col-form-label">Etat:</label>
			<input type="text"  name="etat" class="form-control" >
			</div>
		  </td>
		  </tr>
		  </table>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        <button type="submit" name="btn_statistique" class="btn btn-primary">Valider</button>
      </div>
    </div> 
	</form>
  </div>
</div>

 
  <!--Fin Modal statiqtique-->
          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Offre de Prix
			  <table style="position:relative;left:120px; top:-30px"  width=90%>
			  <tr>
			  <td><a href="?AO_Ajout" style="width:220px; ; margin:auto;position:relative; top:0px;"   class="btn btn-primary btn-block" >Ajout</a></td>
			  <td>
			   <a href=""  style="width:220px; ; margin:auto;position:relative; top:0px;"  name="ok" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Statistique</a>
			   </td>
			   <td>
			  
						
			  </td>
			  <td>
			  <form method="post">
			  <table>
			  <tr>
			  <td>
			  <select name="etat">
			  <option>Etat</option>
			  <option>0</option>
			  <option>1</option>
			  <option>2</option>
			  
			  </select>
			  </td>
			  <td>
			  <?php if(isset($_POST['btn_etat'])){echo $_POST['etat'];}?>
			  </td>
			  <td><input type="submit" name="btn_etat" value="Ok"></td>
			  </tr>
			  </table>
			  </form>
			  
			  </td>
			  </tr></table>
			  <!--/************Fin resultat statistique****************/-->
			  </div>
            <div class="card-body">
              <div class="table-responsive">
			    <?php
				
			  if(!isset($_GET['codeAO']))
                 {
				 if(isset($_POST['btn_etat']))
				{
				 if($_POST['etat']!='etat')
				 {
				  $offres=$AO->getOffreEtat($_POST['etat']);
				  }
				  else
				  {
				    $offres=$AO->getAppelOffre();
				  }
				}
				 else{
				 @$offres=$AO->getAppelOffre();
				 }
				 
				 ?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th >Code OP</th>
					   <th>Code P</th>
					  <th>MDO</th>
					  <th>Titre</th>
					    <th>Etat</th>
                      <th>Type</th>
                      <th>Hono</th>
					   <th>%</th>
					    <th>Date Limite</th>
                      <th>Vis.</th>
                      
					  <th>Mod/Supp</th>
                      
                    </tr>
                  </thead>
                  
                  <tbody>
				  <?php 
				  $nb=count($offres);
				  if($nb>0){
				  foreach($offres as $cle)
				  {?>
                    <tr>
                      <td><a href="?AO_Affiche&codeAO=<?php echo $cle['code']?>"><?php echo $cle['code']?></a></td> 
					   <td>
					    <?php
                        $projetsOP=$projet->getProjetsOP($cle['code']);
					  $nb_projets=count($projetsOP);
					  if($nb_projets>0)
					  {
					  foreach($projetsOP as $POP)
					  {
					  
					  echo $POP['code_projet'].'<br>';
					  
					   }
					   }
					   ?>
					   </td> 
					  <td><?php echo $cle['mdo']?></td>
					  <td><span style="width:140px;float:left;position:relative;left:-10px;"><?php echo $cle['intitule']?>
					  <span></td>
					  <td><span style="width:20px; float:left;position:relative;left:-10px;">
					  <?php echo $cle['etat']?>
					  </span></td>
                      <td><?php echo $cle['type']?></td>
                      <td><?php echo $cle['hono']?></td>
					  <td><?php
                          $nb=strlen($cle['pourcentage']);
						  //echo $nb.'<br>';
						  if($nb>4)
						  {
						  echo '%';
						  }
						  else
						  {
					  echo $cle['pourcentage'];
					  }
					  
					  
					  ?></td>
					   <td><?php echo $cle['date_limite']?></td>
					  
					  <td><span style="width:30px; float:left;position:relative;left:-10px;"><?php echo $cle['nb_vis']?>
					  </span>
					  </td>
                     
                   
					  <td align="left"><a href="?AO_Affiche&codeAO=<?php echo $cle['code']?>&AO_modifier=<?php echo $cle['id']?>"><img src="images/update.jpg" width="25" height="25"></a>
					  <a href="?AO_Affiche&AO_delete=<?php echo $cle['id']?>&AO_etat=<?php echo $cle['etat']?>"><img src="images/delete.jpg" width="25" height="25"></a></td>
                     
                    </tr>
					<?php 
					}
					}
					?>
                
                  </tbody>
                </table>
				<!--/*********Resultat statistique********/--->
			  
			  <?php
						if(isset($_POST['btn_statistique']))
						{
							$resstatistique=$AO->ResultatStatistique($_POST['annee'],$_POST['mois'],$_POST['mdo'],$_POST['etat'],$_POST['type']);
							$row=count($resstatistique);
							?>
							<table width=100% border=1 style="border-radius:4px" class="table table-bordered" class="statistique">
							<tr>
							<th>Année</th><th>Mois</th><th>MDO</th><th>Etat</th><th>Type</th>
							</tr>
							<tr>
							<th >20<?php echo $_POST['annee']?></th>
							 <th><?php echo $_POST['mois']?></th>
							<th><?php echo $_POST['mdo']?></th>
							<th><?php echo $_POST['etat']?></th>
							<th><?php echo $_POST['type']?></th>
							</tr>
							<tr bgcolor=#5EB6DD>
							<th rowspan=2>Resultat:</th>
							<th colspan=2>Nombre des Offres:</th>
							<th width=25% colspan=2><?php echo $row?></th></tr>
							
							<?php
							 $honos=array();
							 if($row>0)
							 {
							 foreach($resstatistique as $cle)
							 {
							 array_push($honos,$cle['hono']);
							     
							 }
							 }
							 ?>
							 <tr bgcolor=#5EB6DD>
							 <th colspan=2>Honoraire:</th>
							 <th  width=25% colspan=2>
							 <?php echo array_sum($honos)?></th></tr>
							 </table>
							<?php 
						}



						?>
						<!--Fin Résultat statistique-->
				<?php 
					}
					else if(isset($_GET['codeAO']))
					{
					
					 $ofres=$AO->getInfosDetailAO($_GET['codeAO']);
				  foreach($ofres as $cdAO){
				  ?>
		  <table  width="100%" style="position:relative; top:50px;">
		  <tr>
		  <td  style="height:45px;width:30%" >
		  <table border=2 width=60%  bgcolor=green style="width:100%;" class="table table-bordered" id="dataTable"  cellspacing="-5">
		  <th width=30% >Code Offre de Prix</th><td><?php echo $cdAO['code']?></td>
		  <th width=30%>MDO</td><td width=30%><?php echo $cdAO['mdo']?></td>
		  </tr>
		 
		  <tr><th>Titre</th><td colspan=4><?php echo $cdAO['intitule']?></td>
		   </tr>
		    <tr>
			<th>Type</td><td><?php echo $cdAO['type']?></td>
			<th>Etat</td><td><?php echo $cdAO['etat']?></td>
			
			</tr>
			<tr>
			<th>Date limite</td><td><?php echo $cdAO['date_limite']?></td>
			 <th>Date décharge</td><td><?php echo $cdAO['date_decharge']?></td>
			 
			 </tr>
			 
		  <tr>
		  <th>Cout</td><td><?php echo $cdAO['cout']?></td>
		  <th>Honoraire</td><td><?php echo $cdAO['hono']?></td>
		  </tr>
		  
		      <tr><th>Nombre de Visite</td><td><?php echo $cdAO['nb_vis']?></td>
			  <th>RP-RD</td><td><?php echo $cdAO['rp_rd']?></td>
			  </tr>
			  <tr>
		  <th>Pourcentage</td><td><?php 
                          $nbs=strlen($cdAO['pourcentage']);
						  if($nbs>4)
						  {
						  echo '%';
						  }
						  else
						  {
					  echo $cdAO['pourcentage'];
					  }
					  
					  
					  ?></td>
					  <th>Fichier de Bordereau</th><td><a href="Appel_offres/bordero/<?php echo $cdAO['bordero']?>">Bordero<?php echo $_GET['codeAO']?></a></td>
		  </tr>
			       <tr><th>Observation</td><td colspan=3><?php echo $cdAO['observation']?></td></tr>
			</table>
			<?php }

                
			?>
			</td>
			<!--bordero-->
			
			<td width=35% valign=top align=right style="position:relative; top:5px" >
			
			<table border=1   class="table table-bordered" id="dataTable"  cellspacing="0">
			
			<?php 
			$brds=$borderos->getborderoOP($_GET['codeAO']);
				$lnbrds=count($brds);
				if($lnbrds>0)
				{
				foreach($brds as $cle);
				?>
				<tr><th colspan=2 width=60%>Type Bordero</th><th colspan=2 width=5%><?php echo $cle['type']?></th></th></tr>
				
			<tr>
			
			<?php 
			if($cle['prix1']!=null)
			{
			?>
			<tr>
			
			<td width=10%>Article 1</td><td><?php echo $cle['article1']?></td>
			<td>Prix</td><td><?php echo $cle['prix1']?></td>
			</tr> 
			
			<?php
                     }
					 
					 if($cle['prix2']!=null)
			{
			?>
			<tr>
			
			<td width=10%>Article 2</td><td><?php echo $cle['article2']?></td>
			<td>Prix</td><td><?php echo $cle['prix2']?></td>
			</tr> 
			
			<?php
                     }
					 
					  if($cle['prix3']!=null)
			{
			?>
			<tr>
			
			<td width=10%>Article 3</td><td><?php echo $cle['article3']?></td>
			<td>Prix</td><td><?php echo $cle['prix3']?></td>
			</tr> 
			
			<?php
                     }
					  if($cle['prix4']!=null)
			{
			?>
			<tr>
			
			<td width=10%>Article 4</td><td><?php echo $cle['article4']?></td>
			<td>Prix</td><td><?php echo $cle['prix4']?></td>
			</tr> 
			
			<?php
                     }
					  if($cle['prix5']!=null)
			{
			?>
			<tr>
			
			<td width=10%>Article 5</td><td><?php echo $cle['article5']?></td>
			<td>Prix</td><td><?php echo $cle['prix5']?></td>
			</tr> 
			
			<?php
                     }
					  if($cle['prix6']!=null)
			{
			?>
			<tr>
			
			<td width=10%>Article 6</td><td><?php echo $cle['article6']?></td>
			<td>Prix</td><td><?php echo $cle['prix6']?></td>
			</tr> 
			
			<?php
                     }
					  if($cle['prix7']!=null)
			{
			?>
			<tr>
			
			<td width=10%>Article 7</td><td><?php echo $cle['article7']?></td>
			<td>Prix</td><td><?php echo $cle['prix7']?></td>
			</tr> 
			
			<?php
                     }
					  if($cle['prix8']!=null){?><tr>
					  <td width=10%>Article 8</td><td><?php echo $cle['article8']?></td>
			<td>Prix</td><td><?php echo $cle['prix8']?></td>
			</tr> <?php
                     }
					 if($cle['prix9']!=null){?><tr>
					  <td width=10%>Article 9</td><td><?php echo $cle['article9']?></td>
			<td>Prix</td><td><?php echo $cle['prix9']?></td>
			</tr> <?php
                     }
					 if($cle['prix10']!=null){?><tr>
					  <td width=10%>Article 10</td><td><?php echo $cle['article10']?></td>
			<td>Prix</td><td><?php echo $cle['prix10']?></td>
			</tr> <?php
                     }
					 if($cle['prix11']!=null){?><tr>
					  <td width=10%>Article 11</td><td><?php echo $cle['article11']?></td>
			<td>Prix</td><td><?php echo $cle['prix11']?></td>
			</tr> <?php
                     }
					 if($cle['prix12']!=null){?><tr>
					  <td width=10%>Article 12</td><td><?php echo $cle['article12']?></td>
			<td>Prix</td><td><?php echo $cle['prix12']?></td>
			</tr> <?php
                     }
					 if($cle['prix13']!=null){?><tr>
					  <td width=10%>Article 13</td><td><?php echo $cle['article13']?></td>
			<td>Prix</td><td><?php echo $cle['prix13']?></td>
			</tr> <?php
                     }
					 if($cle['prix14']!=null){?><tr>
					  <td width=10%>Article 14</td><td><?php echo $cle['article14']?></td>
			<td>Prix</td><td><?php echo $cle['prix14']?></td>
			</tr> <?php
                     }
					 if($cle['prix15']!=null){?><tr>
					  <td width=10%>Article 15</td><td><?php echo $cle['article15']?></td>
			<td>Prix</td><td><?php echo $cle['prix15']?></td>
			</tr> <?php
                     }
					 if($cle['prix16']!=null){?><tr>
					  <td width=10%>Article 16</td><td><?php echo $cle['article16']?></td>
			<td>Prix</td><td><?php echo $cle['prix16']?></td>
			</tr> <?php
                     }
			if($cle['prix17']!=null){?><tr>
					  <td width=10%>>Article 17</td><td><?php echo $cle['article17']?></td>
			<td>Prix</td><td><?php echo $cle['prix17']?></td>
			</tr> <?php
                     }
		if($cle['prix18']!=null){?><tr>
					  <td width=10%>>Article 18</td><td><?php echo $cle['article18']?></td>
			<td>Prix</td><td><?php echo $cle['prix18']?></td>
			</tr> <?php
                     }
		if($cle['prix19']!=null){?><tr>
					  <td width=10%>Article 19</td><td><?php echo $cle['article19']?></td>
			<td>Prix</td><td><?php echo $cle['prix19']?></td>
			</tr> <?php
                     }
		if($cle['prix20']!=null){?><tr>
					  <td width=10%>Article 20</td><td><?php echo $cle['article20']?></td>
			<td>Prix</td><td><?php echo $cle['prix20']?></td>
			</tr> <?php
                     }


			
			} 
			  else
			  {echo "<p>Pas de bordero pour l'appel d'offre".$_GET['codeAO']."</p>";}
			?>
			</table>
			</td>
			
			</tr>
			
			
			</table>		
<?php 

					
					}
					
					//Fin detail Code Offre de prix
					/*******Debut detail Projet******/
					
					else if(isset($_GET['codeP'])){
		  $projets=$projet->getInfosProjet($_GET['codeP']);
		  foreach($projets as $code){
		  ?>
		  <table border=1 class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
		  <tr><th>Code Projet</td><td><?php echo $code['code_projet']?></td></tr>
		  <tr><th>Titre</td><td><?php echo $code['titre']?></td></tr>
		  <tr><th>Etat</td><td><?php echo $code['etat_p']?></td></tr>
		  <tr><th>MDO</td><td><?php echo $code['mdo']?></td></tr>
		  <tr>
		    <th>
			<table border=1 width=100% >
			<tr><th colspan=2>Documents Arrivés</th></tr>
		  <tr><th>ST</td><td><?php 
		  $row_st=count($arrive_ST);
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
		  $row_el=count($arrive_EL);
		  if($row_el>0)
		  {
		       foreach($arrive_EL as $el)
					{
					echo $el['date'].'<br>';
					}
					
			}		
					
					?></td></tr>
		  <tr><th>SI</td><td><?php 
		  $row_si=count($arrive_SI);
		  if($row_el>0)
		  {
		       foreach($arrive_SI as $si)
					{
					echo $si['date'].'<br>';
					}
					
			}		
					
					?></td></tr>
		  <tr><th>FL</td><td><?php 
		  $row_fl=count($arrive_FL);
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
		  $row_autres=count($arrive_Autres);
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
		  $row_autre=count($arrive_Autre);
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
			<tr><th colspan=2>Documents Sorties</th></tr>
		  <tr><th>ST</td><td><?php 
		  $rows_st=count($sortie_ST);
		  if($rows_st>0)
		  {
		  foreach($sortie_ST as $st_sortie)
					{
					?>
					<a href="Sortie/references/<?php echo $st_sortie['reference']?>">
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
		  $rows_el=count($sortie_EL);
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
		  $rows_si=count($sortie_SI);
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
		  $rows_fl=count($sortie_FL);
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
		  $rows_autres=count($sortie_Autres);
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
		  $rows_autre=count($sortie_Autre);
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
		  <!--------------Fin sortie----------------->
		  </tr>
		  </table>
		  <?php } 
		  } 
					?>
              </div>
            </div>
            
          </div>

         