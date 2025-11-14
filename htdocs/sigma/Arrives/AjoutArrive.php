<style>
#SP{position:relative;top:15px}
</style>
<?php
$tab_projet=$projet->AfficherProjets();
$tab_Ponct=$ponct->getponctuel();
$projets=$projet->AfficherProjets();
if(isset($_GET['code_projet']))
{
$SP_projets=$projet->getSousProjets($_GET['code_projet']); 
}
$partenaire=$partenaires->getAllPartenaires();
$partenairemdo=$partenaires->getAllPartenairesMDO();
if(isset($_POST['ok']))
{
if($_POST['ok']=='Modifier')
{
	if($arrive->ModifierArrive($_GET['id'],str_replace("'","\'",$_POST['projet'])))
	 {
	  if($_GET['redirect']=='p')
	  {
	echo "<script>document.location.href='sigma.php?P_Affiche'</script>";
	//echo 'ok';
	}
	else if($_GET['redirect']=='sp')
	{
	//echo 'ok';
	?>
	<script>document.location.href="sigma.php?SPAffiche&sp=<?php echo $_GET['code_projet'];?>"</script>
	<?php
	
	}
	else if($_GET['redirect']=='ponct')
    {echo "<script>document.location.href='sigma.php?AfficherPonctuel'</script>";}

	 }
}
else if($_POST['ok']=='Supprimer')
{
 if($arrive->deleteArrive($_GET['id']))
	 {
	echo "<script>document.location.href='sigma.php?P_Affiche'</script>";
	 }
}
else
{
	//echo '<h1> Projet : '.$_POST['code'].'</h1>';
	//echo '<h1>Ponctuel: '.$_POST['codeP'].'</h1>';
	$code=null;
	$codeSP=null;
	$projet=null;
	if(isset($_POST['code']))
	{
		$projet=str_replace("'","\'",$_POST['projet']);
	if($_POST['code']!='Projet')
	{
		$code=$_POST['code'];
		@$codeSP=$_POST['codeSP'];
     }
	}
else
  if(isset($_POST['codeP']))
	{
		$projet=str_replace("'","\'",$_POST['projetP']);
	if($_POST['codeP']!='Ponctuel')
	{$code=$_POST['codeP'];$codeSP='ponct';}
	}
 if($arrive->ajoutArrive($projet,$code,$codeSP))
 {
 //$partenaire->ajoutPartenaireArchitecte('ARCHITECTE',$_POST['architecte']);
 
 //echo "<script>alert('Arrive ajouté')</script>";
 //echo 'ok';
echo "<script>document.location.href='sigma.php?Arrive_Afficher'</script>";

 }
 else
 {
 echo 'Erreur Ajout';
  
 }
 }
}

?>
<form method="post">
<div class="container" style="position:relative; top:-50px">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header">
		<?php if(isset($_GET['lot'])){ echo 'Modifier/Supprimer '; }
      else {echo 'Ajout ';}?> Arrivée
		 
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
          
            <table width=80% cellpadding=6  style="position:relative;top:-30px">
			<tr >
<td width=40%><label for="date">Date</label>
                  <div class="form-label-group">
				    
                    <input type="date" 
					<?php if(isset($_GET['arrive'])){ ?>value="<?php echo $_GET['arrive']?>"<?php } else {?>  value="<?php echo date('Y-m-d')?>" <?php } ?>id="date" style="padding:6px 0 6px 4px" name="date" class="form-control" >
					
					</td>
<td width=40%>
<label for="affaire">Affaire</label>
                  <input type="text" <?php if(isset($_GET['arrive'])){ ?>value="<?php echo $_GET['affaire']?>"<?php } ?> id="affaire" style="padding:6px 0 6px 4px" name="affaire" class="form-control" >
					</td>
</tr>
<tr >
<td width=40% style="position:relative;top:-20px;">
<label for="emis_par">Emis Par</label>
                  
				    
                   <input list="emispar" id="emis_par" value="<?php if(isset($_GET['designation'])){ 
   				   echo $_GET['designation'];}?>"     style="padding:6px 0 6px 4px" name="emis_par" class="form-control">
				   <!--<datalist id="emispar">
					<?php 
					/*$rows=count($partenaire);
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
					<?php } */?>
					</datalist>-->
					
					</td>
					<td width=40% style="position:relative;top:-10px;">
					<label for="lot">Lot</label>
                  
				    
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
<tr>

<td width=40% style="position:relative;top:-30px;">
<label for="phase">Phase</label>
                  
				    <?php if(!isset($_GET['mission']))
					{
						?>
                    <select  id="phase"      style="padding:6px 0 6px 4px" name="phse" class="form-control" >
					<option selected>DAO</option>
					  <option>EXE</option>
					</select>
					<?php }	else{?>
					
					<select  id="phase"style="padding:6px 0 6px 4px" name="phse" class="form-control" >
					<option <?php if($_GET['phase']=='DAO'){?>selected<?php } ?>>DAO</option>
					  <option <?php if($_GET['phase']=='EXE'){?>selected<?php } ?>>EXE</option>
					</select>
					<?php }
					?>
					
					
					</td>
					<td width=40% style="position:relative;top:-30px;"><label for="mission">Mission</label>
                  
				    <?php if(isset($_GET['mission']))
					{?>
                    <select  id="mission" style="padding:6px 0 6px 4px" name="miss" class="form-control" >
					<option <?php if($_GET['mission']=='Avis'){?>selected<?php } ?> >Avis</option>
					<option <?php if($_GET['mission']=='CRV'){?>selected<?php } ?>>CRV</option>
					<option <?php if($_GET['mission']=='Attestation'){?>selected<?php } ?>>Attestation</option>
					<option <?php if($_GET['mission']=='Rapport'){?>selected<?php } ?>>Rapport</option>
					</select>
					<?php } else {?>
					<select  id="mission" style="padding:6px 0 6px 4px" name="miss" class="form-control" >
					<option>Avis</option>
					<option>CRV</option>
					<option>Attestation</option>
					<option>Rapport</option>
					</select>
					
					<?php }?>
					</td>
</tr>
<!----------------------->
<tr>
<?php if(!isset($_GET['ARPonctuel'])){?>
<td width=40% style="position:relative;top:-30px;" >
<label for="code" >Code Projet</label>
                 
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
					
					<option selected value="Projet">Choisir un code de projet</option>
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
<?php }?>
		<?php if(!isset($_GET['ARPModif']))	{?>
<td width=40% style="position:relative;top:-30px;" >
<label for="code" >Code Ponctuel</label>
 <div id="cd_ponctuelsAvant">
					<?php if(isset($_GET['code_projet'])){ ?>
					 <input type="text" readonly style="padding:6px 0 6px 4px" value="<?php echo $_GET['code_projet']?>" name="code" class="form-control">
					<?php }
					 else		{	
					 ?>
					
                    <select id="codeP"       style="padding:6px 0 6px 4px" name="codeP" class="form-control">
					
				<?php if(isset($_GET['arrive'])){ ?>
				<option selected ><?php echo $_GET['code_projet']?></option>
				<?php }?>
					
					<option selected value="Ponctuel">Choisir un code Ponctuel</option>
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
					</div>
					<div id="cd_ponctuelsApres">
					
					</div>
					<?php } ?>
		</td>
		<?php }?>
		<?php if(isset($_GET['code_projet'])){ ?>
<td width=40% style="position:relative;top:-30px;">
<?php if(@count($SP_projets)>0){?>
<label for="code">Code Sous-Projet</label>

					<select name="codeSP" class="form-control">
						<?php 
						   foreach($SP_projets as $vl)
						   {
						   ?>
						   <option><?php echo $vl['code_sous_P']?></option>
						   
						   <?php
						   }
						  
		   
		
		?>
		</select>
<?php }?>			 
</td>		<?php } ?>
</tr>
<tr>
					<td width=20% style="position:relative;top:-30px;" >
				<?php if(isset($_GET['Add'])){?>
					<p style="background:green"><span style="float:left;width:50%"></span><span style="float:right;width:50%;padding-left:20px;position:relative;top:15px">Code SP</span></p>
				<?php }?>
					<?php if(isset($_GET['code_projet'])){ ?>
					
					 <input type="text" readonly style="padding:6px 0 6px 4px" value="<?php echo $_GET['mdo']?>" name="mdo" class="form-control">
					<?php }
					 else		{	
					 ?>
                   <div id="mdoAvantAjax">
				   	<label for="code">MDO</label>
				    <input list="mdo" readOnly <?php if(isset($_GET['mdo'])){ ?>value="<?php echo $_GET['mdo']?>"<?php } ?>   style="padding:6px 0 6px 4px" name="mdo" class="form-control" />
                    <datalist id="mdo" readOnly >
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
					<?php } ?>
					</td>
					<td width=20% style="position:relative;top:-30px;"><label for="architecte">Architecte</label>
                  <div class="form-label-group">
				    <input list="architecte" style="padding:6px 0 6px 4px" name="architecte" class="form-control">
                    <datalist id="architecte"  >
					<?php 
					$rows=count($partenaire);
					if($rows>0)
					{
					foreach($partenaire as $part)
					{
					?>
					<option><?php echo $part['designation']?></option>
					
					
					<?php } 
					} 
					
					?>
					</datalist>
					</td>

</tr>
<!----------------------->
<tr>
<?php if(!isset($_GET['ARPonctuel'])){?>
<td width=100% colspan=2 style="position:relative;top:-30px;"><label for="projet">projet</label>
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
<?php }?>
					</tr>
					<tr>
				<?php if(!isset($_GET['ARPModif']))	{?>	
<td width=100% colspan=2 style="position:relative;top:-30px;"><label for="projet">Titre projet Ponctuel</label>
                  <div class="form-label-group" id="resultatPonctAvant">
				    <?php if(isset($_GET['code_projet'])){ ?>
					 <input type="text" readonly style="padding:6px 0 6px 4px" value="<?php echo $_GET['projet']?>" name="projetP" class="form-control">
					<?php }
					 else		{	
					 ?>
                    <select id="projetP" style="padding:6px 0 6px 4px" name="projet" class="form-control" >
					<option selected value="">Choisir un projet</option>
					<?php if(isset($_GET['projetP'])){ ?>
					<option selected ><?php echo $_GET['projetP']?></option>
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
					<div class="form-label-group" id="resultatPonctApre">
				     
                 
					</div>
					<!--------Fin traitement AJAX------->
					<?php } ?>
					</td>
					
				<?php }?>			
</tr>
<!------------------------>


</table>
              
			  
			  <!--**********************************************-->
			  </div>
           
			
			
          
          
        </div>
      </div>
    </div>
	</form>