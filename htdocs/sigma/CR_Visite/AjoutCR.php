<?php
$tab_projet=$projet->AfficherProjet();
$projets=$projet->AfficherProjets();
if(isset($_GET['code_projet']))
{
$Sous_projets=$projet->getSousProjets($_GET['code_projet']);
}
else{
$Sous_projets=$projet->getSousProjets(null);
}
$partenaire=$partenaires->getPartenaires();
if(isset($_POST['ok']))
{
if($_POST['ok']=='Ajouter')
{
//Pour l'ajout
 if($cr->ajoutCR_visite(str_replace("'","\'",$_POST['projet']),$_POST['codesousprojet']))
 {
 @copy($_FILES['reference']['tmp_name'],'CR_Visite/references/'.$_FILES['reference']['name']);
 if(isset($_POST['codesousprojet']))
 {
if($_POST['codesousprojet']!=null)
{
  ?>
 <script>document.location.href="sigma.php?SPAffiche&sp=<?php echo $_GET['code_projet'];?>"</script>
 <?php
 }
 }
 else {
//echo "oko";
 
echo "<script>document.location.href='sigma.php?P_Affiche'</script>";
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

 if($cr->ModifierCR($_GET['id']))
 {
 @copy($_FILES['reference']['tmp_name'],'CR/references/'.$_FILES['reference']['name']);
 
 //echo "<script>alert('Sortie Modifié')</script>";
 
echo "<script>document.location.href='sigma.php?CR_Afficher'</script>";

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
		<?php if(isset($_GET['CR_Afficher']) and isset($_GET['id_modifier'])){ echo 'Modifier/Supprimer '; }
      else {echo 'Ajout ';}?> CR visite
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
			<input type="submit" value="Ajouter" style="width:250px; margin:auto;position:relative; top:-30px;margin-bottom:-30px""  name="ok" class="btn btn-primary btn-block"/>
			
			<?php } ?>
	  
	  
	  <!--Fin boutons-->
	  </div>
        <div class="card-body">
          
            <table width=100% cellpadding=10  >
			<tr>
<td width=40%><label for="date">Date</label>
                  <div class="form-label-group">
				    
                    <input type="date" <?php if(isset($_GET['datecrv'])){ ?> value="<?php echo $_GET['datecrv']?>"<?php }else { ?> value="<?php echo date('Y-m-d')?>"<?php }?>  id="date" style="padding:6px 0 6px 4px" name="date" class="form-control" >
					
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

<!----------------------->
<tr>

<td width=40%>

                 
				    <div id="cd_projetsAvant">
					<?php if(isset($_GET['codep']))
				   {
				   /********Code SP*********/
				   ?>
				   <div style="width:150px;float:left">
<label for="code" style="width:100px">Code Projet</label>
                 
				   
                    <input type="text" readonly id="codep" value="<?php echo $_GET['codep']?>" style="padding:6px 0 6px 4px;width:100px" name="code" class="form-control">
					
	</div>	
		
		<div style="width:150px;float:left;">
		<label for="codes" >Code Sous-Projet</label>
		<?php if(isset($_GET['codeSP']))
		{?>
		
		<input type="text" name="codesousprojet" readOnly value="<?php echo $_GET['codeSP']?>" class="form-control">
		<?php }else { ?>
		<select name="codesousprojet" class="form-control">
		<?php if($nbprojet>0){
		   foreach($projets as $vl)
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
				   <?php
				   /*******Fin SP***********/
				   }
				   else
				   {
				   ?>
				   <?php if(isset($_GET['code_projet']))
					{
					?>
					<table>
					<tr>
					<td>
					<input type="text" name="code" readonly="readonly" class="form-control" value="<?php echo $_GET['code_projet']?>"></td>
					<td valign=top>
					  <select     style="padding:6px 0 6px 4px" name="codesousprojet" class="form-control">
				
					
					<?php 
					$row=count($Sous_projets);
					if($row>0)
					{
					foreach($Sous_projets as $cd)
					{
					?>
					<option><?php echo $cd['code_sous_P']?></option>
					
					
					<?php } 
					} 
					else
					{
					?>
					<option>Pas de Sous projet ...</option>
					<?php } ?>
					</select>
					</td></tr></table>
                   
					</div>
					<div id="cd_projetsApres"></div>
					<?php }} ?>
					</td>
					
					<td width=40%>
					<label for="mdo">MDO</label>
                    <div id="mdoAvantAjax">
				   <?php if(isset($_GET['mdo']))
				   {
				   ?>
				   <input type="text" readonly value="<?php echo $_GET['mdo']?>" style="padding:6px 0 6px 4px"
				   name="mdo" class="form-control" />
				   <?php
				   }
				   else
				   {
				   ?>
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
<td width=40% colspan="2"><label for="projet">projet</label>
                  <div class="form-label-group" id="resultatAvant">
				    <?php if(isset($_GET['projet']))
				   {
				   ?>
				   <input type="text" readonly value="<?php echo $_GET['projet']?>" style="padding:6px 0 6px 4px" name="projet" class="form-control" />
				   <?php
				   }
				   else
				   {
				   ?>
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