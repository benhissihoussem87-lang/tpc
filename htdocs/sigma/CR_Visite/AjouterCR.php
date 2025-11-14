<?php
$tab_projet=$projet->AfficherProjets();
$projets=$projet->AfficherProjets();
if(isset($_GET['code_projet']))
{
$SP_projets=$projet->getSousProjets($_GET['code_projet']); 
}
$partenaire=$partenaires->getAllPartenaires();
$partenairemdo=$partenaires->getAllPartenairesMDO();
if(isset($_POST['ok']))
{
if($_POST['ok']=='Ajouter')
{
//Pour l'ajout

 if($cr->ajoutCR_visite(str_replace("'","\'",$_POST['projet']),@$_POST['codeSP']))
 {
 @copy($_FILES['reference']['tmp_name'],'CR_Visite/references/'.$_FILES['reference']['name']);

//echo "oko";
 
echo "<script>document.location.href='sigma.php?CR_Afficher'</script>";

 }
 
 else
 {
 echo 'Erreur Ajout';
  
 }
 
 }
}
?>
<form method="post"  enctype="multipart/form-data">
<div class="container" style="position:relative; top:-50px">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header">
		<?php if(isset($_GET['lot'])){ echo 'Modifier/Supprimer '; }
      else {echo 'Ajout ';}?>  CR visite
		 
		 <?php if(isset($_GET['lot']))
					 {
					 $arrive=$_GET['arrive'];
					 $affaire=$_GET['affaire'];
					 ?>
					 <div style="width:500px; margin:auto">
            <input type="submit" value="Modifier" style="width:220px; float:left; margin:auto;position:relative; top:-30px;margin-bottom:-30px"  name="ok" class="btn btn-primary btn-block"/>
			<input type="submit" value="Supprimer" style="width:220px;float:right;  margin:auto;position:relative; top:-30px;margin-bottom:-30px"  name="ok" class="btn btn-primary btn-block"/>
			</div>
			<?php }
			else
			{
			$arrive=null;
			$affaire=null;
			?>
			<input type="submit" value="Ajouter" style="width:250px; margin:auto;position:relative; top:-30px;margin-bottom:-30px"  name="ok" class="btn btn-primary btn-block"/>
			
			<?php } ?>
		</div>
        <div class="card-body">
          
            <table width=60% cellpadding=6   >
			<tr>
<td width=40%><label for="date">Date</label>
                  <div class="form-label-group">
				    
                    <input type="date" 
					<?php if(isset($_GET['arrive'])){ ?>value="<?php echo $_GET['arrive']?>"<?php } else {?>  value="<?php echo date('Y-m-d')?>" <?php } ?>id="date" style="padding:6px 0 6px 4px" name="date" class="form-control" >
					
					</td>
<td width=40%>
<label for="affaire">Reférence</label>
             <input type="file" name="reference" id="reference" class="form-control"  >
					</td>
</tr>
<tr>
<td width=40%><label for="emis_par">Emis Par</label>
                  
				    
                   <input list="emispar" id="emis_par"      style="padding:6px 0 6px 4px" name="emis_par" class="form-control">
				   <datalist id="emispar">
					<?php 
					$rows=count($partenaire);
					if($rows>0)
					{
					foreach($partenaire as $part)
					{
					?>
					<option <?php if(isset($_GET['designation']))
					{if($_GET['designation']==$part['designation']){?> selected  <?php }}?>>
					<?php echo $part['designation']?></option>
					
					
					<?php } 
					} 
					else
					{
					?>
					<option>Pas de client ...</option>
					<?php } ?>
					</datalist>
					
					</td>
					<td width=40%><label for="lot">Lot</label>
                  
				    
                    <select id="lot" style="padding:6px 0 6px 4px" name="lot" class="form-control" >
					 <?php if(isset($_GET['arrive'])){ ?> <option selected>
					  <?php echo $_GET['lot']?></option><?php } ?>
					  <option>ST</option>
					  <option>EL</option>
					  <option>SI</option>
					  <option>FL</option>
					  <option value="Autre">Autre...</option>
					  
					</select><br>
					<input type="text" name="autre" id="autres" class="form-control" placeholder="Autre Arrivé....">
					</td>

</tr>
<!----------------------->

<!----------------------->
<tr>

<td width=20%>
<label for="code">Code Projet</label>
                 
				    <div id="cd_projetsAvant">
					<?php if(isset($_GET['code_projet'])){ ?>
					 <input type="text" readonly style="padding:6px 0 6px 4px" value="<?php echo $_GET['code_projet']?>" name="code" class="form-control">
					<?php }
					 else		{	
					 ?>
					
                    <select id="code"       style="padding:6px 0 6px 4px" name="code" class="form-control">
					
				<?php if(isset($_GET['arrive'])){ ?>
				<option selected ><?php echo $_GET['code_projet']?></option>
				<?php }?>
					
					<option selected value="">Choisir un code de projet</option>
					<?php 
					
					$row=count($tab_projet);
					if($row>0)
					{
					foreach($tab_projet as $cd)
					{
					?>
					<option><?php echo $cd['code_projet']?></option>
					
					
					<?php } 
					} 
					else
					{
					?>
					<option>Pas de projet ...</option>
					<?php } ?>
					</select>
					</div>
					<div id="cd_projetsApres"></div>
					<?php } ?>
					</td>
<!--Ajax sous Projet-->
<td>

					
              
					<div id="SPApreAjax">
					
					
					</div>
					

<!--Fin SP-->
					
					
					</td>

</tr>
<tr>
					<td width=100% colspan=2> <p style="background:green"><span style="float:left;width:50%">MDO</span><span style="float:right;width:50%;padding-left:20px">Code SP</span></p>
					<?php if(isset($_GET['code_projet'])){ ?>
					 <input type="text" readonly style="padding:6px 0 6px 4px" value="<?php echo $_GET['mdo']?>" name="mdo" class="form-control">
					<?php }
					 else		{	
					 ?>
                   <div id="mdoAvantAjax">
				   
				    <input list="mdo" <?php if(isset($_GET['mdo'])){ ?>value="<?php echo $_GET['mdo']?>"<?php } ?>   style="padding:6px 0 6px 4px" name="mdo" class="form-control" />
                    <datalist id="mdo">
					<?php 
					$rows=count($partenairemdo);
					if($rows>0)
					{
					foreach($partenairemdo as $MDO)
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
					<?php } ?>	</td>
</tr>
<!----------------------->
<tr>
<td width=100% colspan=2 ><label for="projet">projet</label>
                  <div class="form-label-group" id="resultatAvant">
				    <?php if(isset($_GET['code_projet'])){ ?>
					 <input type="text" readonly style="padding:6px 0 6px 4px" value="<?php echo $_GET['projet']?>" name="projet" class="form-control">
					<?php }
					 else		{	
					 ?>
                    <select id="projet" style="padding:6px 0 6px 4px" name="projet" class="form-control" >
					<option selected value="">Choisir un projet</option>
					<?php if(isset($_GET['projet'])){ ?>
					<option selected ><?php echo $_GET['projet']?></option>
					<?php }
					 
					
					$rows=count($projets);
					if($rows>0)
					{
					foreach($projets as $titre)
					{
					?>
					<option><?php echo $titre['intitule']?></option>
					
					
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
					<?php } ?>
					</td>
					</tr>
					
<!------------------------>


</table>
              
			  
			  <!--**********************************************-->
			  </div>
           
			
			
          
          
        </div>
      </div>
    </div>
	</form>