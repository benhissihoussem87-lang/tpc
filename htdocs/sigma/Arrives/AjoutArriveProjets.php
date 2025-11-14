
<?php
$tab_projet=$projet->AfficherProjets();
$projets=$projet->getSousProjets($_GET['code_projet']);
@$nbprojet=count($projets);

$partenaire=$partenaires->getAllPartenaires();
if(isset($_POST['ok']))
{
	
	$codeSP=null;

	if(isset($_GET['ARP']))
	{
		
		@$codeSP=$_POST['codesousprojet'];
     }
	
else if(isset($_GET['ARPonctuel']))
  {$codeSP='ponct';}

 if($arrive->ajoutArriveSousProjet(str_replace("'","\'",$_POST['projet']),$_POST['code'],$codeSP))
 {
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
 if(isset($_GET['ARPonctuel']))
 {
	 echo "<script>document.location.href='sigma.php?AfficherPonctuel'</script>";
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
            <input type="submit" value="Modifier" style="width:220px; float:left; margin:auto;position:relative; top:-30px;margin-bottom:-30px""  name="ok" class="btn btn-primary btn-block"/>
			<input type="submit" value="Supprimer" style="width:220px;float:right;  margin:auto;position:relative; top:-30px;margin-bottom:-30px""  name="ok" class="btn btn-primary btn-block"/>
			</div>
			<?php }
			else
			{
			$arrive=null;
			$affaire=null;
			?>
			<input type="submit" value="Ajouter" style="width:250px; margin:auto;position:relative; top:-30px;margin-bottom:-30px""  name="ok" class="btn btn-primary btn-block"/>
			
			<?php } ?>
		</div>
        <div class="card-body">
          
            <table width=100% cellpadding=6  >
			<tr>
<td width=40% colspan=2><label for="date">Date</label>
                  <div class="form-label-group">
				    
                    <input type="date" value="<?php echo date('Y-m-d')?>" id="date" style="padding:6px 0 6px 4px" name="date" class="form-control" >
					
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

<td width=40%>
<label for="phase">Phase</label>
                  
				    
                    <select  id="phase"      style="padding:6px 0 6px 4px" name="phse" class="form-control" >
					<option selected>DAO</option>
					  <option>EXE</option>
					</select>
					
					
					</td>
					<td width=40%><label for="mission">Mission</label>
                  
				    <select  id="mission" style="padding:6px 0 6px 4px" name="miss" class="form-control" >
					<option selected>Avis</option>
					<option>CRV</option>
					<option>Attestation</option>
					<option>Rapport</option>
					</select>
					</td>
</tr>
<!----------------------->
<tr>

<td width=40%>
<div style="width:150px;float:left">
<label for="code" style="width:150px">
<?php if(isset($_GET['ARPonctuel'])){ echo 'Code Ponctuel';} else { echo 'Code Projet';}?>
</label>
 <input type="text" readonly id="codep" value="<?php echo $_GET['code_projet']?>" style="padding:6px 0 6px 4px;width:100px" name="code" class="form-control">
					
	</div>	
		<?php
           if($nbprojet>0){
		if(isset($_GET['ARP'])){?>
		<div style="width:150px;float:left;">
		<label for="codes" >Code Sous-Projet</label>
		<?php if(isset($_GET['codeSP']))
		{?>
		
		<input type="text" name="codesousprojet" readOnly value="<?php echo $_GET['codeSP']?>" class="form-control">
		<?php }else { ?>
		<select name="codesousprojet" class="form-control">
		<?php 
		   foreach($projets as $vl)
		   {
		   ?>
		   <option><?php echo $vl['code_sous_P']?></option>
		   
		   <?php
		   }
		   
		   
		
		?>
		</select>
		<?php } } ?>
		</div>
		<?php } ?>
					</td>
					<td width=40%>
					<table width=100%><tr>
					<td width=50%><label for="mdo">MDO</label>
                   
				   
				    <input type="text" readonly value="<?php echo $_GET['mdo']?> "  style="padding:6px 0 6px 4px" name="mdo" class="form-control" />
                    
					</td>
					<td width=50%><label for="architecte">Architecte</label>
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
					</tr></table>
					</td>

</tr>
<!----------------------->
<tr>
<td width=80% colspan=2><label for="projet">Titre Projet</label>
                  <div class="form-label-group" id="resultatAvant">
				    
                    <input type="text" value="<?php echo $_GET['projet']?>" readonly style="padding:6px 0 6px 4px" name="projet" class="form-control" >
					
					
					
					</div>
					
					<!--------Fin traitement AJAX------->
					
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