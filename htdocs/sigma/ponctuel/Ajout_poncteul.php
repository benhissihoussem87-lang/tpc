<?php
$nbsponct=$ponct->getponctuel();
$partenairesMdo=$ponct->Partenaires();
$partenairesVisAvi=$ponct->PartenairesVis_a_vis();
$dernier_ponct=$ponct->getDernierponctuel();

/***Pour afficher num****/
$nb_ponct=count($dernier_ponct);

if($nb_ponct==0)
{$num='01';
}
else
{
foreach($dernier_ponct as $pnct);
$codePP=$pnct['code']+01;
$num=$pnct['num']+01;
 //echo '<h1>'.$pnct['num'].'</h1>';
}
if($num<10)
{
$num='00'.$num;
}
//echo '<h1>'.$num.'</h1>';
/*******Fin Affichage Num********/
$designation_partenaire=$partenaires->getPartenairesMDO();

//Ajout Appel Offre
if(isset($_POST['ok']))
{
$verifPartenaire=$partenaires->VerifExistePartenaireParticulier($_POST['mdo']);
$verifPartenaireVIS_A_vis=$partenaires->VerifExistePartenaireVis_A_VIS($_POST['vis_a_vis']);
$VerifCodePonct=$ponct->VerifCodePonctuel($_POST['code']);
@$nbVerifCodePonct=count($VerifCodePonct);
//echo '<h1>'.count($verifPartenaire).'</h1>';
if(count($verifPartenaire)==0)
{
 $partenaires->ajoutPartenaire('PARTICULIER',str_replace("'","\'",$_POST['mdo']),str_replace("'","\'",$_POST['mdo']),null,null,null,null,null,null,$_SESSION['user']);
}

if(count($verifPartenaireVIS_A_vis)==0)
{
 $partenaires->ajoutPartenaire('vis_a_vis',str_replace("'","\'",$_POST['vis_a_vis']),str_replace("'","\'",$_POST['vis_a_vis']),null,null,null,null,null,null,$_SESSION['user']);
}
if($nbVerifCodePonct==0)
{
 if($ponct->ajout(str_replace("'","\'",$_POST['projet'])))
	
 {
$recP->ajoutRecPPonct($_POST['num'],$_POST['code'],$_POST['mdo'],str_replace("'","\'",$_POST['projet']),$_POST['vis_a_vis'],$_POST['honoraire']);
 //echo '<h1>OKKKKKK</h1>';
echo "<script>document.location.href='sigma.php?AfficherPonctuel'</script>";
 //header("location:sigma.php?AO_Ajout");
 }
 else
 {
 echo 'Erreur Ajout';
  
 }
}
else{?>
	 <p style="position:relative;top:-10px;text-align:centre;width:220px;margin:auto;font-size:28px"><b>Vérifier code</b></p>
<?php }
}

//Fin Ajout

//Pour la creation automatique de code ponctuel
$rowpnct=count($nbsponct);
//echo '<h1><u>'.$rowpnct.'</h1></u>';
if($rowpnct>0)
{
foreach($nbsponct as $clep);
//echo $cle['code'].'<br>';
$tabp=$clep['code'];
$lnp=strlen($tabp);
//
}

$initp=1;
if($initp<10)
{
$initp='0'.$initp;
}
$anne = date('y');
$mois = date('m');
$codep=$anne.$mois.$initp;
$code=$codep;
$compte=0;
if(count($dernier_ponct)>0)
{
foreach($dernier_ponct as $pncts);

$codep=$pncts['code']+1;

}


?>
<form method="post" enctype="multipart/form-data" >
<div class="container" style="position:relative; top:-60px"  >
      <div class="card card-register mx-auto mt-5" >
        <div class="card-header">Ajouter <?php if(!isset($_GET['P'])){?>Ponctuel<?php } else { ?> <?php } ?>
		  <input type="submit" style="width:250px; margin:auto;position:relative; top:-30px;margin-bottom:-30px" id="ok" value="Ajouter" name="ok" class="btn btn-primary btn-block"/>
		  </div>
        <div class="card-body" style="position:relative; top:-10px;">
          <table width=80% >
		  <tr>
            <!---------*********************-->
			<td width=70% >
	   <table width=100%   cellpadding=4    >
	<tr >
	<td  align=center>
	<label for="codeAO">Num</label>
	
	</td>
					 
						<td >
						<input type="text"    id="numPonctuel" value="<?php echo $num?>" style="width:200px" name="num" class="form-control" >
						
					</td>
			<td width=50 align=center>
					<label for="codePonctuel">Code PP</label>
					</td>
					 
						<td width=50>
					  
						<input name="code"  id="codePonctuel" style="width:200px" class="form-control" value="<?php echo $codep?>">
						
				  </td>
				 
					
				  
				  </tr>
				  
				  <!------------------------->
				  <tr>
				   <td width=50 align=center>
					<label for="mdo">MDO</label>
					</td>
					 
						<td width=50>
						 <input list="mdo" style="width:200px" name="mdo" class="form-control" >
						<datalist id="mdo">
					  <?php 
					  foreach($partenairesMdo as $mdo){
					?>
					
					<option><?php echo $mdo['designation']?></option>
					<?php } ?>
					</datalist>
						
						 
				  </td>
				  <td width=50 align=center>
				  <div class="form-row">

					<label for="titre">Projet</label>
					  </td>
					 
						<td colspan=2>
						
						<textarea  id="titre" style="width:200px" name="projet" class="form-control"  ></textarea>
						
				  </div>
				  </td>
				  
				  
				  </tr>
				  <!-------------------------------->
				  <tr>
				  <td width=50 align=center>
				  
					<label for="etat" >vis-à-vis</label>
					  
					</td>
					<td>
					<input list="vis_a_vis"  style="width:200px" name="vis_a_vis"  class="form-control" > 
					<datalist id="vis_a_vis">
					  <?php 
					  foreach($partenairesVisAvi as $vis){
					?>
					
					<option ><?php echo $vis['designation']?></option>
					<?php } ?>
					</datalist>
					
				  </td>
				  
				  
		 <td width=50 align=center>
				  
					<label for="lo" >Lot</label>
					  
					</td>
					<td>
					<select name="lot" id="lot" style="width:200px" class="form-control" >
					<option>SI</option>
					<option>ST</option>
					<option>EL</option>
					<option>FL</option>
					<option>Autre</option>
					</select>
				  </td>
				  
				  </tr>
				  
				 
				  <!------------------------->
				  <tr>
				  <td width=50 align=center>
					
				   
					
					<label for="hono">Honoraire</label>
					   </td>
	<td>		
						
						<input type="text" id="hono" style="width:200px" name="honoraire" class="form-control"  >
						
				  </td>
				   <td width=50 align=center>
					
				   
					
					<label for="av">AV</label>
					   </td>
	<td>		
						
						<select id="av" style="width:200px" name="av" class="form-control"  >
						<option>0</option>
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
						
						</select>
						
				  </td>
				  
				  
				  </tr>
				  <!------------------------->
				 	  <tr>
					  <td width=50 align=center>
				  
					<label for="arr">ARR</label>
					  </td>
					  <td>
						<input type="date" value="<?php echo date('Y-m-d')?>" id="arr" style="width:200px" name="arr" class="form-control"  >
						
					  
				 
				  </td>
				  <td width=50 align=center>
					
				   
					
					<label for="mission">Mission</label>
					   </td>
	<td>		
						
						<select id="mission" style="width:200px" name="mission" class="form-control"  >
						<option>AVIS</option>
					<option>ATT</option>
					<option>Visite</option>
					<option>EXP</option>
					<option>Autre</option>
					</select>
						
				  </td>
				  
				  
				  </tr>
				  <!------------------------->
                     <tr>
					 <td width=50 align=center>
				  
					<label for="Date_AVIS">Date AVIS</label>
					  </td>
					  <td>
						<input type="date" id="Date_AVIS" style="width:200px" name="Date_AVIS" class="form-control"  >
						
					  
				 
				  </td>
				  <td width=50 align=center>
					
				   
					
					<label for="V_ESTIMEES">V.ESTIMEES</label>
					   </td>
	<td>		
						
						<input type="text" id="V_ESTIMEES" style="width:200px" name="V_ESTIMEES" class="form-control"  >
						
				  </td>
				 
				  
				  </tr>
				  <!---->
				 <tr>
				  <td width=50 align=center>
				  
					<label for="dem">DEM</label>
					  </td>
					  <td>
						<input type="date" id="dem" style="width:200px" name="dem" class="form-control"  >
						
					  
				 
				  </td>
				 <td align=center>
				  
					<label for="V_FAITES">V.FAITES</label>
					  </td>
					  <td colspan=3 >
						<input type="text" id="V_FAITES" style="width:200px" name="V_FAITES" class="form-control"  >
						
					  
				 
				  </td>
				  
				  </tr>
				  
				  <!------------------------->

				  
				  <!-------------->
				  
				  
	</table>
</td>

			  <!--**********************************************-->
			  </tr>
			  </table>
			  </div>
          
			
			
         
          
        </div>
      </div>
    </div> 
	</form>