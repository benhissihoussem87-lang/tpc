<?php
$partenaire=$partenaires->getPartenairesMDO();
$tab_Ponct=$ponct->getponctuel();
$tab_Arrives=$arrive->getArrives();
	$architectes=$partenaires->PartenaireArchi();
$projet=$projet->AfficherProjet();

$details=$arrive->detailArrive($_GET['id_modifier']);
foreach($details as $det);

if(isset($_POST['ok']))
{
 if($arrive->ModifierArrive($_GET['id_modifier'],str_replace("'","\'",$_POST['projet'])))
 {
 
 //echo "'Arrive Modifié'";
 
echo "<script>document.location.href='sigma.php?Arrive_Afficher'</script>";

 }
 else
 {
 echo 'Erreur Modification';
  
 }
}

?>
<form method="post">
<div class="container" style="position:relative; top:-60px">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header" style="height:80px"><b style="font-size:20px;position:relative;top:0px;left:-00px">MODIFIER UN ARRIVEE</b></td>
		
		 <input type="submit" value="Modifier" style="width:250px; margin:auto;position:relative; top:-20px" name="ok" class="btn btn-primary btn-block"/>
		</div>
        <div class="card-body">
          
            <table width=75% style="position:relative;top:-20px" >
			<tr >
<td width=40%><label for="date">Date</label>
                  <div class="form-label-group">
				    
                    <input type="date" id="date" value="<?php echo $det['date']?>" style="padding:6px 0 6px 4px" name="date" class="form-control" >
					
					</td>
<td width=40%>
<label for="affaire">Affaire</label>
                  <input type="text" value="<?php echo $det['affaire']?>" id="affaire" style="padding:6px 0 6px 4px" name="affaire" class="form-control" >
					</td>
</tr>
<tr>
<td width=40%><label for="emis_par">Emis Par</label>
                  
				    
                    <input type="text" value="<?php echo $det['emis_par']?>" id="emis_par" style="padding:6px 0 6px 4px" name="emis_par" class="form-control" >
					
					</td>
					<td width=40%><label for="lot">Lot</label>
                  
				    
                    <select id="lot" style="padding:6px 0 6px 4px" name="lot" class="form-control" >
					 <?php if(isset($_GET['id_modifier']))
					 {
					 ?>
					  <option <?php if($det['lot']=='ST'){ ?> selected <?php } ?>>ST</option>
					  <option <?php if($det['lot']=='EL'){ ?> selected <?php } ?>>EL</option>
					  <option <?php if($det['lot']=='SI'){ ?> selected <?php } ?>>SI</option>
					  <option <?php if($det['lot']=='FL'){ ?> selected <?php } ?>>FL</option>
					  <option <?php if($det['lot']=='Autre'){ ?> selected <?php } ?> value="Autre">Autre...</option>
					  <?php 
					  }
					  else
					  {
					  ?>
					  <option >ST</option>
					  <option >EL</option>
					  <option >SI</option>
					  <option >FL</option>
					  <option  value="Autre">Autre...</option>
					  
					  <?php
					  }
					  ?>
					  
					  
					</select><br>
					<input type="text" name="autre" id="autres" class="form-control" placeholder="Autre Arrivé....">
					</td>

</tr>
<!----------------------->
<tr>

<td width=40%>
<label for="phase">Phase</label>
                  
				     <select  id="phase"style="padding:6px 0 6px 4px" name="phse" class="form-control" >
					<option <?php if($det['phse']=='DAO'){?>selected<?php } ?>>DAO</option>
					  <option <?php if($det['phse']=='EXE'){?>selected<?php } ?>>EXE</option>
					</select>
					</td>
					<td width=40%><label for="mission">Mission</label>
                  
				     <select  id="mission" style="padding:6px 0 6px 4px" name="miss" class="form-control" >
					<option <?php if($det['miss']=='Avis'){?>selected<?php } ?>>Avis</option>
					<option <?php if($det['miss']=='CRV'){?>selected<?php } ?>>CRV</option>
					<option <?php if($det['miss']=='Attestation'){?>selected<?php } ?>>Attestation</option>
					<option <?php if($det['miss']=='Rapport'){?>selected<?php } ?>>Rapport</option>
					</select>
					</td>
</tr>
<!----------------------->
<tr>

<td width=40% colspan=2>
<table width=100% >
<tr>
<?php if($det['code_sousprojet']!='ponct'){?>
<td width=50%>
<label for="code">Code Projet </label>
                 
				 <?php if($det['code']!=null){  ?>
                  <input type="text" readonly style="padding:6px 0 6px 4px" value="<?php echo $det['code']?>" name="code" class="form-control">
               <?php }else{
					?>			 
                    <select id="code"   style="padding:6px 0 6px 4px" name="code" class="form-control">
					<option selected><?php echo $det['code']?></option>
					<?php 
					$row=count($projet);
					if($row>0)
					{
					foreach($projet as $cd)
					{
					?>
					<option <?php if($cd['code_projet']==$det['code']){ ?>selected   <?php } ?>><?php echo $cd['code_projet']?></option>
					
					
					<?php } 
					} 
					else
					{
					?>
					<option>Pas de projet ...</option>
					<?php } ?>
					</select>
					<?php } ?>
					</td>
<?php }?>
<td width=25% >
<?php if($det['code_sousprojet']=='ponct'){?>
<label for="code">Code Ponctuel </label>
                 
				 <?php if($det['code']!=null){  ?>
                  <input type="text" readonly style="padding:6px 0 6px 4px" value="<?php echo $det['code']?>" name="code" class="form-control">
               <?php }else{
					?>			 
                    <select id="codeP"   style="padding:6px 0 6px 4px" name="codeP" class="form-control">
					<option selected><?php echo $det['code']?></option>
					<?php 
					$rowP=count($tab_Ponct);
					if($rowP>0)
					{
					foreach($tab_Ponct as $cdP)
					{
					?>
					<option><?php echo $cdP['code']?></option>
					
					
					<?php } 
					} 
					else
					{
					?>
					<option>Pas de projet ...</option>
					<?php } ?>
					</select>
<?php } } ?>
</td>
	 <?php if($det['code']!=null){  ?>
	<td width=25%>
	<?php if($det['code_sousprojet']!='ponct'){?>
<label for="code">Code SP </label>

    <?php  
	
	 

	?>         
				
                  <input type="text" readonly style="padding:6px 0 6px 4px" value="<?php echo $det['code_sousprojet']?>" name="codeSP" class="form-control">
				 <!-- <select name="codeSP" class="form-control">
						<?php /*if($projet->getSousProjetsModif()!=null){
						   foreach($projet->getSousProjetsModif() as $vlM)
						   {
							   
						   ?>
						   <option><?php echo $vlM['code_sous_P']?></option>
						   
						   <?php
						   }
						   }
		   */
		
		?>
		</select>-->
	<?php } ?>
					</td>
					<?php } ?>				
</tr>
</table>
	</td></tr>
	<tr>
					
					<td width=40%>
					
					<label for="mdo" style="padding-left:0px;margin-right:150px">MDO</label>
					
					<?php if($det['code']==""){?><label for="mdo" style="padding-left:0px">Code SP</label><?php } ?>
					 <?php if($det['code']!=null){  ?>
                 <input type="text" readonly style="padding:6px 0 6px 4px" value="<?php echo $det['mdo']?>" name="mdo" class="form-control">
               <?php }else{?>			
                  <?php if(isset($_GET['code_projet'])){ ?>
					 <input type="text" readonly style="padding:6px 0 6px 4px" value="<?php echo $det['mdo']?>" name="mdo" class="form-control">
					<?php }
					 else		{	
					 ?>
                   <div id="mdoAvantAjax">
				   
				    <input list="mdo" <?php if(isset($_GET['id_modifier'])){ ?>value="<?php echo $det['mdo']?>"<?php } ?>   style="padding:6px 0 6px 4px" name="mdo" class="form-control" />
                    <datalist id="mdo">
					<?php 
					$rows=count($architectes);
					if($rows>0)
					{
					foreach($partenaire as $part)
					{
					?>
					<option><?php echo $part['designation']?></option>
					
					
					<?php } 
					} 
					else
					{
					?>
					<option>Pas de projet ...</option>
					<?php } ?>
					</datalist>
					</div>
					<div id="mdoApreAjax">
					
					
					</div>
					<?php } }?>
				  
					</td>
					
						<td width=50% ><label for="architecte">Architecte</label>
                  <div class="form-label-group">
				    <select name="architecte" class="form-control">
					<?php if($det['architecte']=="")
					{
					?>
					<option></option>
					<?php } else {?>
					<option><?php echo $det['architecte']?></option>
				
                    <?php 
					}
					$rowsArchi=count($architectes);
					
					if($rowsArchi>0)
					{
					?>
					
					<?php
					foreach($architectes as $part)
					{
					?>
					<option><?php echo $part['designation']?></option>
					
					
					<?php } 
					
					}
					?>
					</select>
					
					</td>

</tr>
<!----------------------->

<tr>
<?php if($det['code_sousprojet']!='ponct'){?>
<td width=100% colspan=2 ><label for="projet">projet</label>
                 
				  <?php if($det['code']!=null){  ?>
                 <input type="text" readonly style="padding:6px 0 6px 4px" value="<?php echo $det['projet']?>" name="projet" class="form-control">
               <?php }else{?>	
				 <div class="form-label-group" id="resultatAvant">
				    <?php if(isset($_GET['code_projet'])){ ?>
					 <input type="text" readonly style="padding:6px 0 6px 4px" value="<?php echo $_GET['projet']?>" name="projet" class="form-control">
					<?php }
					 else		{	
					 ?>
                    <select id="projet" style="padding:6px 0 6px 4px" name="projet" class="form-control" >
					
					<?php if(isset($_GET['id_modifier'])){ ?>
					<option selected ><?php echo $det['projet']?></option>
					<?php }
					 
					
					$rows=count($projet);
					if($rows>0)
					{
					foreach($projet as $titre)
					{
					?>
					<option><?php echo $titre['titre']?></option>
					
					
					<?php } 
					} 
					else
					{
					?>
					<option>Pas de projet ...</option>
					<?php } ?>
					</select>
					
					</div>
					<!---Traitement AJAX--->
					<div class="form-label-group" id="resultatApre">
				     
                 
					</div>
					<!--------Fin traitement AJAX------->
					<?php } } ?>
</td>
<?php } else {?>
				 <!---Fin Projet--->
									
<td width=100% colspan=2 style="position:relative;top:0px;">
<?php if($det['code_sousprojet']=='ponct'){?>
<label for="projet">Titre projet Ponctuel</label>
                  <div class="form-label-group" id="resultatPonctAvant">
				   
					 <input type="text" readonly style="padding:6px 0 6px 4px" value="<?php echo $det['projet']?>" name="projetP" class="form-control">
					
					
<?php  } ?>
					</td>	
<?php }?>					
<tr>
<?php if($_SESSION['user']=='Admin')
					{ if($det['typeuser']=='utilisateur'){
						?>
				 
					  <td>
					
						<b style="font-size:20px">Admin</b><input type="radio" name="user" style="width:100px;height:25px" value="null" >
						
				  </td>
				  <?php } } ?>

</tr>
<!------------------------>


</table>
              
			  
			  <!--**********************************************-->
			  </div>
           
			
			
          </form>
          
        </div>
      </div>
    </div>