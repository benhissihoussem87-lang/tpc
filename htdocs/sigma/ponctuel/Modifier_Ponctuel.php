<?php
$details=$ponct->getDetailPonctuel($_GET['id_modifier']);
$partenairesVisAvi=$ponct->Partenaires();
$partenairesMdo=$ponct->Partenaires();
foreach($details as $det);

//Ajout Appel Offre
if(isset($_POST['ok']))

{
	@$VerifCodePonct=$ponct->VerifCodePonctuel($_POST['code']);
@$nbVerifCodePonct=count($VerifCodePonct);
	if($_POST['code']!=$det['code'])
	{
		
	   if($nbVerifCodePonct!=0)
     { 
       ?>
	   <p style="position:relative;top:-10px;text-align:centre;width:220px;margin:auto;font-size:28px"><b>Vérifier code</b></p>
	   <?php
	 }
	 else{
		 if($ponct->ModifierPonctuel($_GET['id_modifier'],str_replace("'","\'",$_POST['projet']),$_POST['code']))
			 {
				 
			echo "<script>document.location.href='sigma.php?AfficherPonctuel'</script>";
			 }
			 else
			 {
			 echo 'Erreur Modification';
			  
			 }
		 
	 }
	}
	else{
		
		 if($ponct->ModifierPonctuel($_GET['id_modifier'],str_replace("'","\'",$_POST['projet']),$_POST['code']))
			 {
				 
			echo "<script>document.location.href='sigma.php?AfficherPonctuel'</script>";
			 }
			 else
			 {
			 echo 'Erreur Modification';
			  
			 }
	}
	

 
}?>
	 
<?php




?>

<form method="post" enctype="multipart/form-data" >
<div class="container" style="position:relative; top:-60px"  >
      <div class="card card-register mx-auto mt-5" >
        <div class="card-header">MOdifier Ponctuel
		  <input type="submit" style="width:250px; margin:auto;position:relative; top:-30px;margin-bottom:-30px" id="ok" value="Modifier" name="ok" class="btn btn-primary btn-block"/>
		  </div>
        <div class="card-body" style="position:relative; top:-10px;">
          <table width=100% >
		  <tr>
            <!---------*********************-->
			<td width=70% >
	   <table width=100%   cellpadding=4   >
	<tr >
	<td width=50 align=center>
	<label for="codeAO">Num</label>
	
	</td>
					 
						<td width=50>
						<input type="text"  readOnly  id="numPonctuel" value="<?php echo $det['num']?>" style="padding:6px 0 6px 4px" name="num" class="form-control" >
						
					</td>
			<td width=50 align=center>
					<label for="mdo">Code </label>
					</td>
					 
						<td width=50>
					  
						<input name="code" readOnly id="codePonctuel" style="padding:6px 0 6px 4px" class="form-control" value="<?php echo $det['code']?>">
						
				  </td>
				 
					
				  
				  </tr>
				  
				  <!------------------------->
				  <tr>
				   <td width=50 align=center>
					<label for="mdo">MDO</label>
					</td>
					 
						<td width=30%>
					  
						 <input list="mdo"  value="<?php echo $det['mdo']?>" name="mdo" class="form-control" >
						<datalist id="mdo">
					  <?php 
					  foreach($partenairesMdo as $mdo){
					?>
					
					<option><?php echo $mdo['designation']?></option>
					<?php } ?>
					</datalist>
						
						 
				  </td>
				  <td width=50 align=right>
				  <div class="form-row" >

					<label for="titre" style="position:relative;left:50px" >Projet</label>
					  </td>
					 
						<td colspan=2>
						
						<textarea  id="titre" style="padding:4px 0 4px 4px" name="projet" class="form-control"  ><?php echo $det['projet']?></textarea>
						
				  </div>
				  </td>
				  
				  
				  </tr>
				  <!-------------------------------->
				  <tr>
				  <td width=50 align=center>
				  
					<label for="etat" >vis-à-vis</label>
					  
					</td>
					<td width=30%>
					<input list="vis_a_vis" value="<?php echo $det['vis_a_vis']?>"  name="vis_a_vis"  class="form-control" > 
					<datalist id="vis_a_vis">
					  <?php 
					  foreach($partenairesVisAvi as $vis){
					?>
					
					<option ><?php echo $vis['designation']?></option>
					<?php } ?>
					</datalist>
				  </td>
				  
				  
		 <td width=50 align=center>
				  <label for="lo" >Honoraire</label>
					  
					</td>
					<td>
					<input name="honoraire" value="<?php echo $det['honoraire']?>" id="lot" style="padding:6px 0 6px 4px" class="form-control" >
					
				  </td>
				  
				  </tr>
				  
				 
				  <!------------------------->
				  <tr>
				  <td width=50 align=center>
					
				   
					
					<label for="av">AV</label>
					   </td>
	<td>		
						
						<input type="text" value="<?php echo $det['av']?>" id="av" style="padding:6px 0 6px 4px" name="av" class="form-control"  >
						
				  </td>
				  <td width=50 align=center>
				  
					<label for="arr">ARR</label>
					  </td>
					  <td>
						<input type="date" value="<?php echo $det['arr']?>" id="arr" style="padding:6px 0 6px 4px" name="arr" class="form-control"  >
						
					  
				 
				  </td>
				  
				  </tr>
				  <!------------------------->
				 	  <tr>
				  <td width=50 align=center>
					
				   
					
					<label for="mission">Mission</label>
					   </td>
	<td>		
						<select id="mission" style="width:200px" name="mission" class="form-control"  >
						<option <?php if($det['mission']=='AVIS'){?>selected<?php }?>>AVIS</option>
					<option <?php if($det['mission']=='ATT'){?>selected<?php }?>>ATT</option>
					<option <?php if($det['mission']=='Visite'){?>selected<?php }?>>Visite</option>
					<option <?php if($det['mission']=='EXP'){?>selected<?php }?>>EXP</option>
					<option <?php if($det['mission']=='Autre'){?>selected<?php }?>>Autre</option>
					</select>
						
				  </td>
				  <td width=50 align=center>
				  
					<label for="Date_AVIS">Date AVIS</label>
					  </td>
					  <td>
						<input type="date" value="<?php echo $det['date']?>" id="Date_AVIS" style="padding:6px 0 6px 4px" name="Date_AVIS" class="form-control"  >
						
					  
				 
				  </td>
				  
				  </tr>
				  <!------------------------->
                     <tr>
				  <td width=50 align=center>
					
				   
					
					<label for="V_ESTIMEES">V.ESTIMEES</label>
					   </td>
	<td>		
						
						<input type="text" value="<?php echo $det['v_estime']?>" id="V_ESTIMEES" style="padding:6px 0 6px 4px" name="V_ESTIMEES" class="form-control"  >
						
				  </td>
				  <td width=50 align=center>
				  
					<label for="dem">DEM</label>
					  </td>
					  <td>
						<input type="date" value="<?php echo $det['dem']?>" id="dem" style="padding:6px 0 6px 4px" name="dem" class="form-control"  >
						
					  
				 
				  </td>
				  
				  </tr>
				  <!---->
				 <tr>
				 <td align=center>
				  
					<label for="V_FAITES">V.FAITES</label>
					  </td>
					  <td >
						<input type="text" value="<?php echo $det['v_fait']?>" id="V_FAITES" style="padding:6px 0 6px 4px" name="V_FAITES" class="form-control"  >
						
					  
				 
				  </td>
				   <td align=center>
				  <label for="lo" >Lot</label>
					  
					</td>
					<td>
					
					
					<select name="lot" id="lot" style="width:200px" class="form-control" >
					<option <?php if($det['lot']=='SI'){?>selected<?php }?>>SI</option>
					<option <?php if($det['lot']=='ST'){?>selected<?php }?>>ST</option>
					<option <?php if($det['lot']=='EL'){?>selected<?php }?>>EL</option>
					<option <?php if($det['lot']=='FL'){?>selected<?php }?>>FL</option>
					<option <?php if($det['lot']=='Autre'){?>selected<?php }?>>Autre</option>
					</select>
				  </tr>
				  
				  <!------------------------->

				  
				  <!-------------->
				  
				  
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