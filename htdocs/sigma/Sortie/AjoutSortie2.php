<?php
$tab_projet=$projet->AfficherProjet();
$projets=$projet->AfficherProjets();
@$SP_projets=$projet->getSousProjets($_GET['code_projet']);
$spP=count($SP_projets);
$partenaire=$partenaires->getPartenaires();
if(isset($_POST['ok']))
{
if($_POST['ok']=='Ajouter')
{
//Pour l'ajout
 if($sortie->ajoutSortie(str_replace("'","\'",$_POST['projet'])))
 {
 @copy($_FILES['reference']['tmp_name'],'Sortie/references/'.$_FILES['reference']['name']);
 
 //echo "Sortie ajouté";
 
echo "<script>document.location.href='sigma.php?P_Affiche'</script>";

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

 if($sortie->ModifierSortie($_GET['id'],str_replace("'","\'",$_POST['projet'])))
 {
 @copy($_FILES['reference']['tmp_name'],'Sortie/references/'.$_FILES['reference']['name']);
 
 //echo "<script>alert('Sortie Modifié')</script>";
 
echo "<script>document.location.href='sigma.php?P_Affiche'</script>";

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
<form method="post" enctype="multipart/form-data">
<div class="container" style="position:relative; top:-50px">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header">
		
		<?php if(isset($_GET['lot'])){ echo 'Modifier/Supprimer '; }
      else {echo 'Ajout ';}?> Sortie<div style="width:300px; position:relative; left:150px;top:-20px">
	  <?php if(isset($_GET['SP'])){ echo 'Sous-Projet '.$_GET['SP']; } ?>
	  </div>
	  <!--Les botons-->
	  <?php if(isset($_GET['lot']))
					 {
					 ?>
					 <div style="width:500px; margin:auto">
            <input type="submit" value="Modifier" style="width:220px; float:left; margin:auto;position:relative; top:-30px;margin-bottom:-30px""  name="ok" class="btn btn-primary btn-block"/>
			<input type="submit" value="Supprimer" style="width:220px;float:right;  margin:auto;position:relative; top:-30px;margin-bottom:-30px""  name="ok" class="btn btn-primary btn-block"/>
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
          
            <table width=60% cellpadding=10  >
			<tr>
<td width=40%><label for="date">Date</label>
                  <div class="form-label-group">
				    
                    <input type="date" <?php if(isset($_GET['sortie'])){ ?> value="<?php echo $_GET['sortie']?>"<?php }else { ?> value="<?php echo date('Y-m-d')?>" <?php }?> id="date" style="padding:6px 0 6px 4px" name="date" class="form-control" >
					
					</td>
<td width=40%>

<label for="reference">Reférence</label>
					<input type="file" name="reference" id="reference" class="form-control"  >
					</td>
</tr>
<tr>
<td width=40%><label for="emis_par">Emis Par</label>
                  
				    
                   <input type="text" value="T.S" id="emis_par"      style="padding:6px 0 6px 4px" name="emis_par" class="form-control">
					
					
					
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

</tr>
<!----------------------->
<tr>

<td width=40%>
<label for="phase">Phase</label>
                  
				    
                    <select  id="phase"      style="padding:6px 0 6px 4px" name="phse" class="form-control" >
					<option selected>DAO</option>
					  <option>EXE</option>
					</select>
					
					
					</td>
					<td width=40%><label for="mission">Document</label>
                  
				    
                    <select id="mission" style="padding:6px 0 6px 4px" name="miss" class="form-control" >
					<option>AVIS_AR</option>
					<option>AVIS_SR</option>
					<option>RAPPORT</option>
					
					</select>
					</td>
</tr>
<!----------------------->
<tr>

<td width=40%>
<label for="code">Code Projet</label>
                 
				    <div id="cd_projetsAvant">
					<?php if(isset($_GET['code_projet'])){
					?>
					<input type="text" style="padding:6px 0 6px 4px" name="code" class="form-control" value="<?php echo $_GET['code_projet']?>" readonly>
					<?php }
					else
					{
					?><select     style="padding:6px 0 6px 4px" name="codesousprojet" class="form-control">
					<option  value="0">Choisir un code de projet</option>
					<?php if(isset($_GET['code_projet']))
					{
					?>
					<option selected ><?php echo $_GET['code_projet']?></option>
					
					<?php } ?>
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
					<td>
					<div >
		<label for="codes" >Code Sous-Projet</label>
		<?php if(isset($_GET['codeSP']))
		{?>
		
		<input type="text" name="codesousprojet" readOnly value="<?php echo $_GET['codeSP']?>" class="form-control">
		<?php }else { ?>
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
		</div>
					</td>
		</tr>
		<tr>
					<td width=100%  colspan="2">
					<label for="mdo">MDO</label>
					<?php if(isset($_GET['SP'])){
					?>
					  <input  value="<?php echo $_GET['mdo']?>"readonly	style="padding:6px 0 6px 4px" name="mdo" class="form-control"
					<?php }else {?>
                    <div id="mdoAvantAjax">
				   
				    <input list="mdo" <?php if(isset($_GET['mdo'])){ ?>value="<?php echo $_GET['mdo']?>"<?php }?> 	style="padding:6px 0 6px 4px" name="mdo" class="form-control" />
                    <datalist id="mdo">
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

</tr>
<!----------------------->
<tr>
<td width=100% colspan="2"><label for="projet">projet</label>
                  <div class="form-label-group" id="resultatAvant">
				    <?php if(isset($_GET['SP'])){
					?>
					  <input  value="<?php echo $_GET['projet']?>"readonly	style="padding:6px 0 6px 4px" name="projet" class="form-control"
					<?php }else {?>
                    <select id="projet" style="padding:6px 0 6px 4px" name="projet" class="form-control" >
					<?php if(isset($_GET['projet'])){ ?>
					<option selected ><?php echo $_GET['projet']?></option>
					<?php } ?>
					<?php 
					
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