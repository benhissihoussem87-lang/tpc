<?php
if(isset($_GET['sp']))
{
$param=$_GET['sp'];
$projets=$projet->AfficherProjetSP($param);
foreach($projets as $prj);
}
else if(isset($_POST['code_P']))
{
$param=$_POST['code_P'];
$projets=$projet->AfficherProjetSP($param);
foreach($projets as $prj);
}
$projetsAll=$projet->AfficherProjet();
if(isset($_POST['ok']))
{
if(!isset($_POST['etat']))
{
$etat=0;
}
else
{
$etat=$_POST['etat'];
}
 if($projet->AjoutSousProjet($_POST['code_P'],$_POST['code_sp'],$prj['mdo'],str_replace("'","\'",$prj['titre']),$etat,str_replace("'","\'",$_POST['titre_s']),$_POST['d_rp'],$_POST['d_rd'],$_POST['ddsp'],str_replace("'","\'",$_POST['observation'])))
{ 
if(isset($_GET['sp'])){
?>
 <script>document.location.href="sigma.php?SPAffiche&sp=<?php echo $_GET['sp'];?>"</script>
 <?php
}
else{
	?>
	<script>document.location.href="sigma.php?P_Affiche"</script>
<?php	
}
}
else print 'Erreur';

}

?>
<form method="post">

<div class="container" style="position:relative; top:-20px">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header">Ajouter Sous-Projet
		<input type="submit" value="Ajouter" name="ok" style="width:250px; margin:auto;position:relative; top:-20px" class="btn btn-primary btn-block"/>
		
		</div>
        <div class="card-body">
          
            <table width=100% cellpadding=10  >
<tr>

<td style="width:20px" width=20>
<table>
<tr>
<td>
<label for="codep">Code Projet</label>
                  <?php if(isset($_GET['sp']))
				  {
				  $codeSP=$_GET['sp'].'/';
				  ?>
				   <input type="text"   id="codep" style="padding:6px 0 6px 4px;width:100px" name="code_P" readonly value="<?php echo $_GET['sp']?>" class="form-control"  >
				  
				  <?php
				  }
				  else
				  {
				   $codeSP="";
				  ?>
				    
                    <input type="text" list="codeps"  id="codep" style="padding:6px 0 6px 4px;width:100px" name="code_P" class="form-control"  >
					<datalist id="codeps">
					 <?php foreach($projetsAll as $detprojet)
					 {
					 ?>
					 
					 <option><?php echo $detprojet['code_projet']?></option>
					 
					 <?php } ?>
					 
					
					</datalist>
					<?php } ?>
		</td>
		<td style="padding-left:45px">
					<div >
					<label for="codep">Code S.P</label>
					
					<input style="padding:6px 0 6px 4px;width:100px"  id="code_sp" value="<?php echo  $codeSP?>"class="form-control" type="text" name="code_sp">
					</div></td>
					<td ><p id="res_SP" style="color:red; position:relative; top:20px;"></p></td>
					</tr></table>
					</td>
					
					<td width=40% colspan=2><div id="res_sousProjet"></div></td>
					
</tr>
<!----------------------->
<tr>
<td width=40%>
      <table width=100% >
	     <tr>
		 <td width=45%>
			<label for="etat">Avancement Projet</label>
			</td>
			<td width=20>
                    <input type="radio" id="etat" value="0" style="width:20px" name="etat" class="form-control"  >
			</td>
			<td>0</td>
			<td width=20>
                    <input type="radio" id="etat" value="1" style="width:20px" name="etat" class="form-control"  >
			</td>
			<td>1</td>
			<td width=20>
                    <input type="radio" id="etat" value="2" style="width:20px" name="etat" class="form-control"  >
			</td>
			<td>2</td>
			<td width=20>
                    <input type="radio" id="etat" value="3" style="width:20px" name="etat" class="form-control"  >
			</td>
			<td>3</td>

        </tr>
      </table>		
					
</td>
					
		<td width=40% colspan=2>
		<label for="titre_s">Titre Sous-Projet </label>
                  
				    
                    <input type="text" id="titre_s"      style="padding:6px 0 6px 4px" name="titre_s" class="form-control"  ></td>
</tr>

<tr>
<td><label for="ddsp">Date Démarrage</label>
                  
				    
                    <input type="date" id="ddsp"      style="padding:6px 0 6px 4px" name="ddsp" class="form-control"  ></td>
<td><label for="d_rp">Date RP</label>
                  <div class="form-label-group">
				    
                    <input type="date" id="d_rp"      style="padding:6px 0 6px 4px" name="d_rp" class="form-control"  ></td>
	<td width=10%>
<label for="d_rd">Date RD</label>
                  <div class="form-label-group">
				    
                    <input type="date" id="d_rd"      style="padding:6px 0 6px 4px" name="d_rd" class="form-control"  >
</td>

</tr>
<!------------------------>
<tr>

</tr>
<!------------------------>
<tr>

<td>
<label for="observation">Observation</label>
                  <div class="form-label-group">
				    
                    <textarea id="observation" style="padding:6px 0 6px 4px" name="observation" class="form-control"  ></textarea>
</td>
</tr>

</table>
              
			  
			  <!--**********************************************-->
			  </div>
            
			
			
          
          
        </div>
      </div>
    </div></form>