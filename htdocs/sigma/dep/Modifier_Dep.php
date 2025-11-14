<?php
$details_dep=$dep->getDetaildep($_GET['dep_modifier']);
foreach($details_dep as $det);
//Ajout Appel Offre
if(isset($_POST['ok']))
{

 if($dep->Modifierdep($_GET['dep_modifier']))
 {
	 
echo "<script>document.location.href='sigma.php?AfficherDep'</script>";
 }
 else
 {
 echo 'Erreur Modification';
  
 }
}



?>
<form method="post" enctype="multipart/form-data" >
<div class="container" style="position:relative; top:-60px"  >
      <div class="card card-register mx-auto mt-5" >
        <div class="card-header">Modifier Dep
		  <input type="submit" style="width:250px; margin:auto;position:relative; top:-30px;margin-bottom:-30px" id="ok" value="Modifier" name="ok" class="btn btn-primary btn-block"/>
		  </div>
        <div class="card-body" style="position:relative; top:-10px;">
          <table width=100% >
		  <tr>
            <!---------*********************-->
			<td width=70% >
	   <table width=100%   cellpadding=4   >
	<tr >
	<td width=30% align=center><label for="date">Date</label>	</td>
	<td>
	<input type="date" value="<?php echo $det['DATE']?>" style="padding:6px 0 6px 4px" name="DATE" class="form-control" >
	</td>
	</tr>
	<tr>
    <td width=30% align=center><label for="RESTE_TS_SAL_FRAIS">MONTANT</label>	</td>
	<td>
	<input type="text" value="<?php echo $det['Montant']?>" style="padding:6px 0 6px 4px" name="montant" class="form-control" >
	</td>
	</tr>
	<tr>
    <td width=30% align=center><label for="RAISON">RAISON</label>	</td>
	<td>
	<select style="padding:6px 0 6px 4px" name="RAISON" class="form-control" >
	<option <?php if($det['RAISON']=='Alimentation Caisse'){?>selected <?php }?>>Alimentation Caisse</option>
	<option <?php if($det['RAISON']=='Salaire'){?>selected <?php }?>>Salaire</option>
	<option <?php if($det['RAISON']=='Frais'){?>selected <?php }?>>Frais</option>
	
	</select>
	</td>
	</tr>	
	<tr>
    <td width=30% align=center><label for="num_CHQ">Num CHQ</label>	</td>
	<td>
	<input type="text" value="<?php echo $det['num_CHQ']?>" style="padding:6px 0 6px 4px" name="num_CHQ" class="form-control" >
	</td>
	</tr>	
	<tr>
    <td width=30% align=center><label for="BENEFICIARE">BENEFICIARE</label>	</td>
	<td>
	<input type="text" value="<?php echo $det['Beneficiare']?>" style="padding:6px 0 6px 4px" name="BENEFICIARE" class="form-control" >
	</td>
	</tr>
	<?php if($_SESSION['user']=='Admin')
					{ if($det['typeuser']=='utilisateur'){
						?>
   <tr>
    <td width=30% align=center><label for="ETAT_DE_CAISSE">User</label>	</td>
	<td>
	Admin<input type="radio" name="user" style="width:120px" value="null" >
	</td>
	</tr>
	<?php } } ?>
	<!--<tr>
    <td width=30% align=center><label for="CHEQUES">CHEQUES</label>	</td>
	<td>
	<input type="text" style="padding:6px 0 6px 4px" name="CHEQUES" class="form-control" >
	</td>
	</tr>
		-->
	</table>
</td>

			  <!--**********************************************-->
			  </tr>
			  </table>
			  </div>
          
			
			
         
          
        </div>
      </div>
    </div> 
	</form>