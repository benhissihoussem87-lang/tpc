<?php
$tab_projet=$projet->AfficherProjet();
$projets=$projet->AfficherProjets();
$tab_Ponct=$ponct->getponctuel();
@$SP_projets=$projet->getSousProjets($_GET['code_projet']);
@$detailSortie=$sortie->detailSortie($_GET['idS']);
@$nbdetailSortie=count($detailSortie);
if($nbdetailSortie>0)
{foreach($detailSortie as $det);}
@$spP=count($SP_projets);
$partenaire=$partenaires->getPartenaires();
if(isset($_POST['ok']))
{
	/*****/
		 $lien=null;
		  if(empty($_FILES['reference']['name']))
		  {
			 @ $lien=$det['reference'];
		  }
		  else{
			 $lien=$_FILES['reference']['name'];
		  }
		 
		 /**********/
if($_POST['ok']=='Ajouter')
{
	
//Pour l'ajout
		$code=null;
			$codeSP=null;
	
			if(isset($_GET['redirect']))
			{
				if($_GET['redirect']=='SS' or $_GET['redirect']=='SRPonct')
				{
					 if(isset($_POST['codeP'])){
					$code=$_POST['codeP']=$_POST['codeP'];
					@$codeSP='ponct';
					 }
					 else if(isset($_GET['code_projet'])   ){
					$code=$_GET['code_projet'];@$codeSP='ponct';
					 }
				   else {
					  if(isset($_POST['code'])){
						$code=$_POST['code'];
					@$codeSP=$_POST['codeSP'];
					}
				
			    }
				  	
				}
				else if($_GET['redirect']=='PS')
				{
					$code=$_GET['code_projet'];@$codeSP=$_POST['codesousprojet'];
				}
			}
			
			
			$projet=null;
			if(isset($_POST['projet']))
			{
				$projet=str_replace("'","\'",$_POST['projet']);
			}
			else if(isset($_POST['projetP'])){
				$projet=str_replace("'","\'",$_POST['projetP']);
			}
 if($sortie->ajoutSortie($projet,$code,$codeSP))
 {
 @copy($_FILES['reference']['tmp_name'],'Sortie/references/'.$_FILES['reference']['name']);
 
// echo "Sortie ajouté";
  if($_GET['redirect']=='SS')
 {
//	 echo 'ok';
echo "<script>document.location.href='sigma.php?Sortie_Afficher'</script>";
}
else
 if(isset($_POST['codesousprojet']))
 {
if($_POST['codesousprojet']!=null)
{
  ?>
 <script>document.location.href="sigma.php?SPAffiche&sp=<?php echo $_GET['code_projet'];?>"</script>
 <?php
 }
 }
 else 
 {
 if(isset($_GET['redirect']))
 {
	 echo "<script>document.location.href='sigma.php?Sortie_Afficher&redirect=SS'</script>";
 }
 else {
// echo 'ok';
echo "<script>document.location.href='sigma.php?P_Affiche'</script>";
 }
}
 }
 
 else
 {
 echo 'Erreur Ajout';
  
 }
 
 }
 
 //Fin Ajout
 //Modifier 
 else if($_POST['ok']=='Modifier')
{

 if($sortie->ModifierSortie($_GET['idS'],str_replace("'","\'",$_POST['projet']),$lien))
 {
 @copy($_FILES['reference']['tmp_name'],'Sortie/references/'.$_FILES['reference']['name']);
 
 //echo "'Sortie Modifié'";
 if($_GET['redirect']=='SS')
 {
echo "<script>document.location.href='sigma.php?Sortie_Afficher'</script>";
}
else
 if($_GET['redirect']=='PS')
 {
echo "<script>document.location.href='sigma.php?SPAffiche&sp='".$_GET['code_projet']."''</script>";
}
else
 if($_GET['redirect']=='SRPonct')
 {
echo "<script>document.location.href='sigma.php?AfficherPonctuel'</script>";
}
 }
 
 else
 {
 echo 'Erreur Ajout';
  
 }
 
 }
 //Fin Modifier
 
 //Supprimer
  else if($_POST['ok']=='Supprimer')
{

 if($sortie->deleteSortie($_GET['id']))
 {
 
 
 //echo "<script>alert('Sortie Supprimé')</script>";
 
echo "<script>document.location.href='sigma.php?P_Affiche'</script>";

 }
 
 else
 {
 echo 'Erreur Suppression';
  
 }
 
 }
 
 
 //Fin Supprimer
}

?>
<form method="post"  enctype="multipart/form-data">
<div class="container" style="position:relative; top:-50px">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header">
		
		<?php if(isset($_GET['idS'])){ echo 'Modifier/Supprimer '; }
      else {echo 'Ajout ';}?> Sortie<div style="width:300px; position:relative; left:150px;top:-20px">
	  <?php if(isset($_GET['SP'])){ echo 'Sous-Projet '.$_GET['SP']; } ?>
	  </div>
	  <!--Les botons-->
	  <?php if(isset($_GET['idS']))
					 {
					 ?>
					 <div style="width:500px; margin:auto">
            <input type="submit" value="Modifier" style="width:220px; float:left; margin:auto;position:relative; top:-30px;margin-bottom:-30px""  name="ok" class="btn btn-primary btn-block"/>
			<!--<input type="submit" value="Supprimer" style="width:220px;float:right;  margin:auto;position:relative; top:-30px;margin-bottom:-30px""  name="ok" class="btn btn-primary btn-block"/>-->
			</div>
			<?php }
			else
			{
			?>
			<input type="submit" value="Ajouter" style="width:250px; margin:auto;position:relative; top:-30px;margin-bottom:-30px"  name="ok" class="btn btn-primary btn-block"/>
			
			<?php } ?>
	  
	  
	  <!--Fin boutons-->
	  </div>
        <div class="card-body">
          
            <table width=80%    >
			<tr>
<td width=40%><label for="date">Date</label>
                  <div class="form-label-group">
				    
                    <input type="date" <?php if(isset($_GET['idS'])){ ?> value="<?php echo $_GET['sortie']?>"<?php }else { ?> value="<?php echo date('Y-m-d')?>" <?php }?> id="date" style="padding:6px 0 6px 4px" name="date" class="form-control" >
					
					</td>
<td width=40%>

<label for="reference"><b>Reférence</b> : <?php echo @$det['reference']?> </label>

					<input type="file" name="reference" id="reference" class="form-control"  >
					</td>
</tr>
<tr>
<td width=40%><label for="emis_par">Emis Par</label>
                  
				    
                   <input type="text" <?php if(isset($_GET['idS'])){ ?> value="<?php echo $det['emis_par']?>"<?php } else {?> value="T.S" <?php } ?> id="emis_par"      style="padding:6px 0 6px 4px" name="emis_par" class="form-control">
					
					
					
					</td>
					<td width=40%><label for="lot">Lot</label>
                  
				    
                    <select id="lot" style="padding:6px 0 6px 4px" name="lot" class="form-control" >
					 <?php if(isset($_GET['lot']))
					 {
					 ?>
					  <option <?php if($_GET['lot']=='ST'){ ?> selected <?php } ?>>ST</option>
					  <option <?php if($_GET['lot']=='EL'){ ?> selected <?php } ?>>EL</option>
					  <option <?php if($_GET['lot']=='SI'){ ?> selected <?php } ?>>SI</option>
					  <option <?php if($_GET['lot']=='FL'){ ?> selected <?php } ?>>FL</option>
					  <option <?php if($_GET['lot']=='Autre'){ ?> selected <?php } ?> value="Autre">Autre...</option>
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

</tr><!----------------------->
<tr>

<td width=40%>
<label for="phase">Phase</label>
                  
				     <?php if(isset($_GET['idS']))
					 {?>
				 
				  <select  id="phase"      style="padding:6px 0 6px 4px" name="phse" class="form-control" >
					<option <?php if($det['phse']=='DAO'){?>selected<?php } ?>>DAO</option>
					  <option <?php if($det['phse']=='EXE'){?>selected<?php } ?>>EXE</option>
					</select>
				 
					 <?php } else{
					 ?>
                    <select  id="phase"      style="padding:6px 0 6px 4px" name="phse" class="form-control" >
					<option selected>DAO</option>
					  <option>EXE</option>
					</select>
					<?php } 
					 ?>
					
					</td>
					<td width=40%><label for="mission">Document</label>
                  
				     <?php if(!isset($_GET['idS']))
					 { ?>
                    <select id="mission" style="padding:6px 0 6px 4px" name="miss" class="form-control" >
					<option>AVIS_AR</option>
					<option>AVIS_SR</option>
					<option>RAPPORT</option>
					<option>ATTESTATION</option>
					<option>PLAN APP</option>
					
					</select>
					 <?php } else {?>
					  <select id="mission" style="padding:6px 0 6px 4px" name="miss" class="form-control" >
					<option <?php if($det['miss']=='AVIS_AR'){?>selected<?php } ?>>AVIS_AR</option>
					<option <?php if($det['miss']=='AVIS_SR'){?>selected<?php } ?>>AVIS_SR</option>
					<option <?php if($det['miss']=='RAPPORT'){?>selected<?php } ?>>RAPPORT</option>
					<option <?php if($det['miss']=='ATTESTATION'){?>selected<?php } ?>>ATTESTATION</option>
					<option <?php if($det['miss']=='PLAN APP'){?>selected<?php } ?>>PLAN APP</option>
					
					</select>
					 
					 
					 
					 <?php }?>
					</td>
</tr>
<!----------------------->
<tr>
<?php if(!isset($_GET['SRPonct'])){ ?>
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
					<?php }
						?>
					</td>
<?php } ?>

	<td width=40% style="position:relative;top:0px;" >
	<?php if(isset($_GET['SRPonct']) or isset($_GET['Sortie_Ajout'])){ ?>
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
	<?php } } ?>
		</td>


<!--Ajax sous Projet-->

   <?php 
   @$nbsdetailSortie=count($detailSortie);
    if($nbsdetailSortie>0)
{
   
     if($_SESSION['user']=='Admin')
					{ if($det['user']=='utilisateur'){
						?>
				  
					  <td>
					 
					 
						<b style="font-size:20px">Admin</b><input type="radio" name="user" style="width:100px;height:25px" value="null" >
						
				  </td>
				   <?php } } }?>

</tr>
<tr>
					<td width=50% > 
					<?php if(isset($_GET['code_projet'])){ ?>
					<label for="code" style="width">MDO</label><br>
					 <input type="text" readonly style="padding:6px 0 6px 4px;float:left;width:50%" value="<?php echo $_GET['mdo']?>" name="mdo" class="form-control">
					 <?php }if(isset($_GET['CodeSP'])){?>
					  <input type="text" readonly style="padding:6px 0 6px 4px;float:left;width:50%" value="<?php echo $_GET['CodeSP'];?>" class="form-control">
					<?php }  
					
						?>
						
					<?php 
					
					 if(!isset($_GET['code_projet']))		{	
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
					<?php if(!isset($_GET['SRPonct'])){?>
					<td>
					<?php if(@$_GET['redirect']!='SS' ){
						  ?>
					<label for="code" style="width">Code SP</label><br>
					<select name="codesousprojet" class="form-control">
		<?php if($spP>0){
		   foreach($SP_projets as $vl)
		   {
		   ?>
		   <option><?php echo $vl['code_sous_P']?></option>
		   
		   <?php
		   }
		   }
		   
		
		?>
		</select>
					<?php } ?>
		</td>
					<?php } ?>
</tr>
<!----------------------->
<?php if(!isset($_GET['SRPonct'])){?>
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
<?php } else {?>
	<tr>				
<td width=100% colspan=2 style="position:relative;top:00px;"><label for="projet">Titre projet Ponctuel</label>
                  <div class="form-label-group" id="resultatPonctAvant">
				    <?php if(isset($_GET['code_projet'])){ ?>
					 <input type="text" readonly style="padding:6px 0 6px 4px" value="<?php echo $_GET['projet']?>" name="projetP" class="form-control">
					<?php }
					 else		{	
					 ?>
                    <select id="projetP" style="padding:6px 0 6px 4px" name="projetP" class="form-control" >
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

</tr>
<?php } ?>					
<!------------------------>


</table>
              
			  
			  <!--**********************************************-->
			  </div>
           
			
			
          
          
        </div>
      </div>
    </div>
	</form>