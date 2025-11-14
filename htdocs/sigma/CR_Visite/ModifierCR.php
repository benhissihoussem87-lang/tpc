<?php
$partenaire=$partenaires->getPartenairesMDO();
$projet=$projet->AfficherProjet();
$details=$cr->detailCR($_GET['id_modifier']);
foreach($details as $det);
if(isset($_POST['ok']))
{
/*****/
		 $lien=null;
		  if(empty($_FILES['reference']['name']))
		  {
			  $lien=$det['reference'];
		  }
		  else{
			 $lien=$_FILES['reference']['name'];
		  }
		 
		 /**********/
 if($cr->ModifierCR($_GET['id_modifier'],str_replace("'","\'",$_POST['projet']),$lien))
 {
 @copy($_FILES['reference']['tmp_name'],'CR_Visite/references/'.$_FILES['reference']['name']);
 
 if($_SESSION['user']=='utilisateur')
 {
echo "<script>document.location.href='sigma.php?CR_Afficher'</script>";
}
else if($_SESSION['user']=='Admin')
 {
 ?>
 <script>document.location.href="sigma.php?CR_Afficher&code_projet=<?php echo $_POST['code'];?>&projet=<?php echo $_POST['projet'];?>&mdo=<?php echo $_POST['mdo'];?>"</script>
 
 <?php
 }

 }
 else
 {
 echo 'Erreur Modification';
  
 }
}

?><form method="post" enctype="multipart/form-data">
<div class="container" style="position:relative; top:-20px">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header"><b style="font-size:20px;position:relative;top:0px;left:-00px">MODIFIER CR VISITE</b></td>
		 <div style="width:500px; margin:auto">
            <input type="submit" value="Modifier" style="width:220px; float:left; margin:auto;position:relative; top:-30px;margin-bottom:-30px""  name="ok" class="btn btn-primary btn-block"/>
			
			</div>
		
		</div>
        <div class="card-body">
          
            <table width=100% cellpadding=10  >
			<tr>
<td width=40%><label for="date">Date</label>
                  <div class="form-label-group">
				    <?php if(isset($_GET['datecrv']))
					{
					?>
					<input type="date" id="date" value="<?php echo $_GET['datecrv']?>"      style="padding:6px 0 6px 4px" name="date" class="form-control">
					<?php }else
					{
					?>
                    <input type="date" value="<?php echo $det['date_cr']?>" id="date" style="padding:6px 0 6px 4px" name="date" class="form-control" >
				<?php }
					?>
					</td>
<td width=40%>

<label for="reference">Reférence: </label>
                 <span style="position:relative;left:25px"><?php echo $det['reference']?></span >
					<input type="file" name="reference" id="reference" class="form-control"  >
					</td>
</tr>
<tr>
<td width=40%><label for="emis_par">Emis Par</label>
                  
				    
                   <input type="text" value="<?php echo $det['emis_par']?>" id="emis_par"      style="padding:6px 0 6px 4px" name="emis_par" class="form-control">
					
					
					
					</td>
					<td width=40%><label for="lot">Lot</label>
                  
				    
                    <select id="lot" style="padding:6px 0 6px 4px" name="lot" class="form-control" >
					 <?php if(isset($_GET['CR_Afficher']) and isset($_GET['id_modifier']))
					 {
					 if($det['lot_cr']=='ST' or $det['lot_cr']=='EL' or $det['lot_cr']=='SI' or
                          $det['lot_cr']=='FL' or $det['lot_cr']=='Autre' )
						  {
					 ?>
					  <option <?php if($det['lot_cr']=='ST'){ ?> selected <?php } ?>>ST</option>
					  <option <?php if($det['lot_cr']=='EL'){ ?> selected <?php } ?>>EL</option>
					  <option <?php if($det['lot_cr']=='SI'){ ?> selected <?php } ?>>SI</option>
					  <option <?php if($det['lot_cr']=='FL'){ ?> selected <?php } ?>>FL</option>
					  <option <?php if($det['lot_cr']=='Autre'){ ?> selected <?php } ?> value="Autre">Autre...</option>
					  <?php 
					  }
					  else {
					  ?>
					  <option selected><?php echo $det['lot_cr']?></option>
					  
					  <?php
					  
					  }
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
<table width=100%>
<tr>
<td width=50%>
<label for="code">Code Projet</label>
                 
				    <div id="cd_projetsAvant">
					<?php if(isset($_GET['code_projet']))
					{
					?>
					<input type="text" id="code" value="<?php echo $_GET['code_projet']?>" readonly     style="padding:6px 0 6px 4px" name="code" class="form-control">
					<?php }else
					{
					?>
					
					
                    <select id="code"      style="padding:6px 0 6px 4px" name="code" class="form-control">
					
					<?php if(isset($_GET['id_modifier']))
					{
					?>
					<option  selected ><?php echo $_GET['code_projet']?></option>
					
					<?php } ?>
					<?php 
					$tab_projet=$cr->getCRS($_GET['code_projet']);
					$row=count($tab_projet);
					if($row>0)
					{
					foreach($tab_projet as $cd)
					{
					?>
					<option><?php echo $cd['code']?></option>
					
					
					<?php } 
					} 
					else
					{
					?>
					<option>Pas de projet ...</option>
					<?php } }?>
					</select>
					</div>
					<div id="cd_projetsApres"></div>
</td>
<td width=50%>
<label for="code"></label>
<input type="text" id="code" value="<?php echo $_GET['code_sp']?>" readonly  style="padding:6px 0 6px 4px;position:relative;top:5px" name="codesp" class="form-control"></td>
</tr>
</table>
					</td>
					
					<td width=40%>
					<label for="mdo">MDO</label>
					 <?php if(isset($_GET['mdo'])){ ?>
					<input type="text" readonly value="<?php echo $det['mdo']?>" id="mdo" style="padding:6px 0 6px 4px" name="mdo" class="form-control" >
					
					<?php } else { ?>
                    <div id="mdoAvantAjax">
				   
				    <select style="width: 100%; float: left;" onchange="this.nextElementSibling.value=this.value" id="mdo" style="padding:6px 0 6px 4px"  name="mdo" class="form-control">
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
					</select>
					  <input style="width: 96%; position:relative; top:-37px" class="form-control" style="padding:6px 0 6px 4px" value="<?php echo $det['mdo']?>"/>
					</div>
					<div id="mdoApreAjax">
					
					
					</div>
					<?php 
					} 
					?>
				  </td>

</tr>
<!----------------------->
<tr>
<td width=40% colspan="2"><label for="projet">projet</label>
                  <div class="form-label-group" id="resultatAvant">
				    <?php if(isset($_GET['projet'])){ ?>
					<input type="text" readonly value="<?php echo $det['projet']?>" id="projet" style="padding:6px 0 6px 4px" name="projet" class="form-control" >
					
					<?php } else { ?>
                    <select id="projet" style="padding:6px 0 6px 4px" name="projet" class="form-control" >
					
					
					<?php 
					
					$rows=count($projets);
					if($rows>0)
					{
					foreach($projets as $titre)
					{
					?>
					<option><?php echo $titre['titre']?></option>
					
					
					<?php } 
					} 
					else
					{
					?>
					<option>Pas de projet ...</option>
					<?php } }?>
					</select>
					
					</div>
					<!---Traitement AJAX--->
					<div class="form-label-group" id="resultatApre">
				     
                 
					</div>
					
					
					</td>
					
					
					
</tr>
<tr>
 <?php if($_SESSION['user']=='Admin')
					{ if($det['user']=='utilisateur'){
						?>
			
					  <td>
					 <table width=90%>
					 <!--<tr>
					 <th >
						Utilisateur</th><td><input type="radio" chehed style="width:120px" name="user" value="utilisateur" ></td></tr>
						 --><tr>
					 <th>Admin</th><td><input type="radio" name="user" style="width:120px" value="null" ></td></tr>
						</table>
				  </td>
				   <?php } } ?>

</tr>
<!------------------------>


</table>
              
			  
			  <!--**********************************************-->
			  </div>
			   
			
			
          
          
        </div>
      </div>
    </div>
	
</form>