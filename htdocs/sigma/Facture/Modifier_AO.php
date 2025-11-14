<?php
$designation_partenaire=$partenaires->getPartenairesMDO();
$nbsprojet=$projet->getProjets();
	

$details=$AO->detailAO($_GET['AO_modifier']);
foreach($details as $det);
//Ajout Appel Offre
if(isset($_POST['ok']))
{

 if($AO->ModifierAO($_GET['AO_modifier']))
 {
 //Borderaux
 
 $borderos->ModifierBorderaux($det['code']);
 copy($_FILES['bordero']['tmp_name'],'Appel_offres/bordero/'.$_FILES['bordero']['name']);
 	//Pour la creation automatique de code de projet
$rowp=count($nbsprojet);
if($rowp>0)
{
foreach($nbsprojet as $clep);
//echo $cle['code'].'<br>';
$tabp=$clep['code_projet'];
$lnp=strlen($tabp);
//
}

if($rowp==0)
{
$initp='001';

$codep='P'.date('y').$initp;

}
else
{

if($tabp['5']=='9' and $tabp['4']=='9')
 {$initp=($tabp['3']+1).'00';}
 else
 {
   if($tabp['5']=='9')
   {$initp=$tabp['3'].($tabp['4']+1).'0';}
   else if($tabp['5']<9)
   {$initp=$tabp['3'].$tabp['4'].($tabp['5']+1);}
 }
$P=$tabp['1'].$tabp['2'];
//echo '<h1>'.$P.'</h1>';
if($P<date('y'))
{
$codep=$P.$initp;
}
else
{
 $codep='P'.date('y').$initp;
}
}

 /*********Fin Génération de code projet***********/
 if($det['etat']!=2)
 {
 if($_POST['etat']==2  )
 {


  $projet->ajoutProjet($_POST['code'],str_replace("'","\'",$_POST['type']),str_replace("'","\'",$_POST['etat']),$_POST['mdo'],$_POST['titre'],$_POST['date_limite'],$_POST['date_decharge'],
 $_POST['cout'],$_POST['hono'],$_POST['intitule'],$_POST['pourcentage'],$_POST['rp_rd'],$codep);
 }
 }
echo "<script>document.location.href='sigma.php?AO_Affiche'</script>";
 }
 else
 {
 echo 'Erreur Modification';
  
 }
}



?>

<form method="post" enctype="multipart/form-data">
<div class="container" style="position:relative; top:-20px"  >
      <div class="card card-register mx-auto mt-5" >
        <div class="card-header">Modifier Appel Offre
		<input type="submit" style="width:250px; margin:auto;position:relative; top:-20px" value="Modifier" name="ok" class="btn btn-primary btn-block"/>
		
		</div>
        <div class="card-body">
          <table width=100% >
		  <tr>
            <!---------*********************-->
			<td width=65%>
            <!---------*********************-->
   <table width=100% cellpadding=4 >
<tr>
<td ><label for="code">Code Offre</label></td>
<td >
<input type="text"   readonly id="code" value="<?php echo $det['code']?>" style="padding:6px 0 6px 4px" name="code" class="form-control" >
</td>
<td ><label for="type">Type</label> </td>
<td ><select id="type" name="type" class="form-control" placeholder="Last name"  >
					<option value="marche_public">MARCHE PUB</option>
					<option value="pub">PUB</option>
					<option value="prive">PRIVE</option>
					</select>
             </td>
			  </tr>
			  
			  <!------------------------->

			 <tr> <td width=15% rowspan=2>
			 
				
				
				<label for="etat" >Etat</label>
                  </td>
                  <td rowspan=2>
				 <table  width=70%  >
				  <tr>
				  <td width=20>
				    
                    <input type="radio"<?php if($det['etat']=='0'){?>checked<?php } ?> name="etat" value="0" class="form-control" style="width:20px" > 
					 </td>
				  <td>
					<span style="font-size:18px">0</span>
					</td>
					<td width=20>
				    
                    <input type="radio" <?php if($det['etat']=='1'){?>checked<?php } ?> name="etat" value="1" class="form-control" style="width:20px" > 
					 </td>
				  <td>
					<span style="font-size:18px">1</span>
					</td>
					<td width=20>
				    
                    <input type="radio" name="etat" <?php if($det['etat']=='2'){?>checked<?php } ?> value="2" class="form-control" style="width:20px" > 
					 </td>
				  <td>
					<span style="font-size:18px">2</span>
					</td>
					</tr>
					</table>
				
			  </td>
			  <td>
				<label for="mdo" style="position:relative; top:-30px">MDO</label>
                  </td>
          <td >
				   
                   <!-- <input     name="mdo" class="form-control" >-->
                      <select style="width: 100%; float: left;" onchange="this.nextElementSibling.value=this.value" id="mdo" style="padding:6px 0 6px 4px"  name="mdo" class="form-control">
							<?php foreach($designation_partenaire as $designation){
					?>
					<option ><?php echo $designation['designation']?></option>
					
					<?php } ?>
						</select>
<input style="width: 90%; position:relative; top:-37px" class="form-control" style="padding:6px 0 6px 4px" value="<?php echo $det['mdo']?>"/>
<hr>
					 
					
              </td>
			  </tr>
			  <tr>
			  <td><label for="date_limite">Date limite</label></td>
			  <td><input type="date" value="<?php echo $det['date_limite']?>" id="date_limite" style="padding:6px 0 6px 4px" name="date_limite" class="form-control"  ></td>
			  </tr>
			  <!-------------------------------->
			  <tr>
     <td ><label for="titre">Titre</label></td>
                 <td colspan=3>
                  <textarea type="text" value="<?php echo $det['intitule']?>"  id="titre" style="padding:6px 0 6px 4px" name="titre" class="form-control">
				  <?php echo $det['titre']?>
				  </textarea>
				  
					<input type="text"  value="<?php echo $det['intitule']?>" class="form-control" name="intitule" id="intitule">
              </td>
			  
			  </tr>
			  
			 
			  <!------------------------->
			  <tr>
			  <td>
			  
				<label for="date_decharge">Date Décharge</label>
                  </td>
				  <td>
                    <input type="date" value="<?php echo $det['date_decharge']?>" id="date_decharge" style="padding:6px 0 6px 4px" name="date_decharge" class="form-control"  >
				</td>
			  <td>
				<label for="cout">Cout</label>
				</td>
				  <td>
               <input type="text" value="<?php echo $det['cout']?>" id="cout" style="padding:6px 0 6px 4px" name="cout" class="form-control">
              </td>
			  </tr>
			  <!------------------------->
			  <tr>
			  <td>
			  <label for="hono">Honoraire</label>
                  </td>
				  <td>
				   <input type="text" value="<?php echo $det['hono']?>" id="hono" style="padding:6px 0 6px 4px" name="hono" class="form-control"  >
             
			  </td>
			 
			  <td><label for="pourcentage">Pourcentage</label>
                  </td>
				  <td>
				    
                    <input type="text" value="<?php echo $det['pourcentage']?>" readonly id="pourcentage" style="padding:6px 0 6px 4px" name="pourcentage" class="form-control"  ></td>
			  </tr>
			  <!------------------------->
			  
			  <!------------------------->
			  <tr>
			  <td>
			  <label for="nb_vis">Nombre VS</label>
                  </td>
				  <td>
				    <input type="number" value="<?php echo $det['nb_vis']?>" min="0" id="nb_vis" style="padding:6px 0 6px 4px" name="nb_vis" class="form-control"  >
			  </td>
			  <td><label for="rp_rd">RP/RD</label>
                  </td>
				  <td>
				    
                    <input type="text" id="rp_rd" value="<?php echo $det['rp_rd']?>" style="padding:6px 0 6px 4px" name="rp_rd" class="form-control"  >
					</td>
			  </tr>
			  
			  <!------------------------->
			  <tr>
			  
			  <td width=50 align=center>
				  <label for="bordero">Bordero</label>
					
						</td>
					  <td>
					  <?php echo $det['bordero']?>
						<input type="file" id="bordero" style="padding:6px 0 6px 4px" name="bordero" class="form-control"  >
				  </td>
			  </tr>
			  
			  <!-------------->
			  <tr></tr>
			  
</table>
</td>
<?php if(isset($_GET['AO_Affiche']) and isset($_GET['AO_modifier']))
{
$res_op=$AO->getBorderoAO($_GET['codeAO']);
$pnbsop=count($res_op);
if($pnbsop>0)
{
foreach($res_op as $res);
?>
<td valign=top width=35% >
<div id="res_bordero" style="height:500px;overflow:scroll">
     <table width=100% >
	<tr><td colspan=5>Bordero</td></tr>
	<tr><td>Type</td>
	<td>consultation</td><td><input type="radio" class="form-control" style="width:20px" name="bordero_type" id="consultation_bordero" <?php if($res['type']=='consultation'){ ?> checked <?php } ?>  value="consultation"></td>
	<td>Expertise</td><td><input type="radio" <?php if($res['type']=='expertise'){ ?> checked <?php } ?> class="form-control" style="width:20px" name="bordero_type" value="expertise" id="expertise_bordero"></td>
	</tr>
	</table>
	<div id="expertise">
	<table>
	<tr><td>Article1</td>
	<td colspan=3><input type="text" value="<?php echo $res['article1']?>" name="article1" placeholder="Nom" class="form-control" ></td>
		<td ><input  type="text" name="prix1" value="<?php echo $res['prix1']?>"  placeholder="Prix" class="form-control" ></td>
	</tr>
	<tr><td>Article2</td>
	<td colspan=2><input type="text" value="<?php echo $res['article2']?>" name="article2" placeholder="Nom" class="form-control" ></td>
		<td colspan=2><input type="text" value="<?php echo $res['prix2']?>" name="prix2" placeholder="Prix" class="form-control" ></td>
	</tr>
	</table>
	</div><!--Fin #expertise-->
	<div id="consultation">
	<table>
	<tr><td>Article3</td>
	<td colspan=2><input type="text" value="<?php echo $res['article3']?>" name="article3" placeholder="Nom" class="form-control" ></td>
		<td colspan=2><input type="text" value="<?php echo $res['prix3']?>" name="prix3" placeholder="Prix" class="form-control" ></td>
	</tr>
	<tr><td>Article4</td>
	<td colspan=2><input type="text" value="<?php echo $res['article4']?>" name="article4" placeholder="Nom" class="form-control" ></td>
		<td colspan=2><input type="text" value="<?php echo $res['prix4']?>" name="prix4" placeholder="Prix" class="form-control" ></td>
	</tr>
	<tr><td>Article5</td>
	<td colspan=2><input type="text" value="<?php echo $res['article5']?>" name="article5" placeholder="Nom" class="form-control" ></td>
		<td colspan=2><input type="text" value="<?php echo $res['prix5']?>" name="prix5" placeholder="Prix" class="form-control" ></td>
	</tr>
	<tr><td>Article6</td>
	<td colspan=2><input type="text" value="<?php echo $res['article6']?>" name="article6" placeholder="Nom" class="form-control" ></td>
		<td colspan=2><input type="text" value="<?php echo $res['prix6']?>"  name="prix6" placeholder="Prix" class="form-control" ></td>
	</tr>
	
	<tr><td>Article7</td>
	<td colspan=2><input type="text" value="<?php echo $res['article7']?>" name="article7" placeholder="Nom" class="form-control" ></td>
		<td colspan=2><input type="text" value="<?php echo $res['prix7']?>" name="prix7" placeholder="Prix" class="form-control" ></td>
	</tr>
	<tr><td>Article8</td>
	<td colspan=2><input type="text" value="<?php echo $res['article8']?>" name="article8" placeholder="Nom" class="form-control" ></td>
		<td colspan=2><input type="text" value="<?php echo $res['prix8']?>" name="prix8" placeholder="Prix" class="form-control" ></td>
	</tr>
	<tr><td>Article9</td>
	<td colspan=2><input type="text" value="<?php echo $res['article9']?>"  name="article9" placeholder="Nom" class="form-control" ></td>
		<td colspan=2><input type="text" value="<?php echo $res['prix9']?>" name="prix9" placeholder="Prix" class="form-control" ></td>
	</tr>
	<tr><td>Article10</td>
	<td colspan=2><input type="text" value="<?php echo $res['article10']?>" name="article10" placeholder="Nom" class="form-control" ></td>
		<td colspan=2><input type="text" value="<?php echo $res['prix10']?>" name="prix10" placeholder="Prix" class="form-control" ></td>
	</tr>
	
	<tr><td>Article11</td>
	<td colspan=2><input type="text" value="<?php echo $res['article11']?>" name="article11" placeholder="Nom" class="form-control" ></td>
		<td colspan=2><input type="text" value="<?php echo $res['prix11']?>" name="prix11" placeholder="Prix" class="form-control" ></td>
	</tr>
	<tr><td>Article12</td>
	<td colspan=2><input type="text" value="<?php echo $res['article12']?>" name="article12" placeholder="Nom" class="form-control" ></td>
		<td colspan=2><input type="text" value="<?php echo $res['prix12']?>" name="prix12" placeholder="Prix" class="form-control" ></td>
	</tr>
	<tr><td>Article13</td>
	<td colspan=2><input type="text" value="<?php echo $res['article13']?>" name="article13" placeholder="Nom" class="form-control" ></td>
		<td colspan=2><input type="text" value="<?php echo $res['prix13']?>" name="prix13" placeholder="Prix" class="form-control" ></td>
	</tr>
	<tr><td>Article14</td>
	<td colspan=2><input type="text" value="<?php echo $res['article14']?>" name="article14" placeholder="Nom" class="form-control" ></td>
		<td colspan=2><input type="text" value="<?php echo $res['prix14']?>"  name="prix14" placeholder="Prix" class="form-control" ></td>
	</tr>
	
	<tr><td>Article15</td>
	<td colspan=2><input type="text" value="<?php echo $res['article15']?>" name="article15" placeholder="Nom" class="form-control" ></td>
		<td colspan=2><input type="text" value="<?php echo $res['prix15']?>"  name="prix15" placeholder="Prix" class="form-control" ></td>
	</tr>
	<tr><td>Article16</td>
	<td colspan=2><input type="text" value="<?php echo $res['article16']?>" name="article16" placeholder="Nom" class="form-control" ></td>
		<td colspan=2><input type="text" value="<?php echo $res['prix16']?>" name="prix16" placeholder="Prix" class="form-control" ></td>
	</tr>
	<tr><td>Article17</td>
	<td colspan=2><input type="text" value="<?php echo $res['article17']?>"  name="article17" placeholder="Nom" class="form-control" ></td>
		<td colspan=2><input type="text" value="<?php echo $res['prix17']?>" name="prix17" placeholder="Prix" class="form-control" ></td>
	</tr>
	<tr><td>Article18</td>
	<td colspan=2><input type="text" value="<?php echo $res['article18']?>" name="article18" placeholder="Nom" class="form-control" ></td>
		<td colspan=2><input type="text" value="<?php echo $res['prix18']?>" name="prix18" placeholder="Prix" class="form-control" ></td>
	</tr>
	
	<tr><td>Article19</td>
	<td colspan=2><input type="text" value="<?php echo $res['article19']?>"  name="article19" placeholder="Nom" class="form-control" ></td>
		<td colspan=2><input type="text" value="<?php echo $res['prix19']?>" name="prix19" placeholder="Prix" class="form-control" ></td>
	</tr>
	<tr><td>Article20</td>
	<td colspan=2><input type="text" value="<?php echo $res['article20']?>" name="article20" placeholder="Nom" class="form-control" ></td>
		<td colspan=2><input type="text" value="<?php echo $res['prix20']?>" name="prix20" placeholder="Prix" class="form-control" ></td>
	</tr>
	</table>
	</div> 
	</div><!--Fin #consultation-->
	
<?php } ?>
</td>
<?php } ?>
			  <!--**********************************************-->
			  </tr>
			  </table>
			  </div>
            
			
			
          
          
        </div>
      </div>
    </div>
	</form>