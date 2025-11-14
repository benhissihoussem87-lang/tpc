<?php
$nbsprojet=$projet->getProjets();
$nbs=$AO->getOffre();
$designation_partenaire=$AO->getPartenairesMDO();
$maxCode=$AO->getMaxCode();


foreach($maxCode as $mxCod);

$partenairesVisAvi=$ponct->PartenairesVis_a_vis();
//echo '<h1>'.$mxCod['MaxCode'].'</h1>';
//Ajout Appel Offre
if(isset($_POST['ok']))
{
	if($_POST['type']=='prive' or $_POST['type']=='ponctuel')
	{
	$type='PARTICULIER';
	$verifPartenaire=$partenaires->VerifExistePartenaire($_POST['mdo'],$type);
	}
	else if($_POST['type']=='marche_public' or $_POST['type']=='pub')
	{
	$type='MDO';
	$verifPartenaire=$partenaires->VerifExistePartenaire($_POST['mdo'],$type);
	}
	//echo '<h1>'.count($verifPartenaire).'</h1>';
	@$nbverifPartenaire=count($verifPartenaire);
	if($nbverifPartenaire==0)
	{
	if($_POST['type']=='prive' or $_POST['type']=='ponctuel')
	{
	 $partenaires->ajoutPartenaire('PARTICULIER',str_replace("'","\'",$_POST['mdo']),str_replace("'","\'",$_POST['mdo']),null,null,null,null,null,null,$_SESSION['user']);
	}
	else{
	 $partenaires->ajoutPartenaire('MDO',str_replace("'","\'",$_POST['mdo']),str_replace("'","\'",$_POST['mdo']),null,null,null,null,null,null,$_SESSION['user']);
	}
	 }

	$verifPartenaireVIS_A_vis=$partenaires->VerifExistePartenaireVis_A_VIS($_POST['vis_a_vis']);
	if(count($verifPartenaireVIS_A_vis)==0)
	{
	 $partenaires->ajoutPartenaire('vis_a_vis',str_replace("'","\'",$_POST['vis_a_vis']),str_replace("'","\'",$_POST['vis_a_vis']),null,null,null,null,null,null,$_SESSION['user']);
	}

	if($_POST['type']=='prive' or $_POST['type']=='ponctuel')
	{
	 $limite=$_POST['date_decharge'];
	  $visavis=$_POST['vis_a_vis'];
	}
	else
	{
	 $limite=$_POST['date_limite'];
	   $visavis=null;
	}
	 $op=$_POST['code'];
	 if($AO->ajout(str_replace("'","\'", $op),str_replace("'","\'",$_POST['type']),str_replace("'","\'",$_POST['etat']),str_replace("'","\'",$_POST['mdo']),str_replace("'","\'",$_POST['titre']),$limite,$_POST['date_decharge'],$_POST['cout'],$_POST['hono'],str_replace("'","\'",$_POST['intitule']),str_replace("'","\'",$_POST['pourcentage']),str_replace("'","\'",$_POST['nb_vis']),str_replace("'","\'",$_POST['rp_rd']),str_replace("'","\'",$_FILES['bordero']['name']),str_replace("'","\'",$_POST['observation']),$visavis))
	 {
	 @copy($_FILES['bordero']['tmp_name'],'Appel_offres/bordero/'.$_FILES['bordero']['name']);
	 //Ajout bordero
	 if(isset($_POST['bordero_type']))
	 {
	 if($_POST['bordero_type']=='consultation')
	 {
	 @$borderos->ajoutBordero(str_replace("'","\'",$_POST['mdo']),str_replace("'","\'",$_POST['code']),str_replace("'","\'",$_POST['bordero_type']),str_replace("'","\'",$_POST['article1']),$_POST['prix1'],str_replace("'","\'",$_POST['article2']),$_POST['prix2'],str_replace("'","\'",$_POST['article3']),$_POST['prix3'],str_replace("'","\'",$_POST['article4']),$_POST['prix4'],str_replace("'","\'",$_POST['article5']),$_POST['prix5'],str_replace("'","\'",$_POST['article6']),$_POST['prix6'],str_replace("'","\'",$_POST['article7']),$_POST['prix7'],str_replace("'","\'",$_POST['article8']),str_replace("'","\'",$_POST['article9']),str_replace("'","\'",$_POST['article10']),str_replace("'","\'",$_POST['article11']),str_replace("'","\'",$_POST['article12']),str_replace("'","\'",$_POST['article13']),str_replace("'","\'",$_POST['article14']),str_replace("'","\'",$_POST['article15']),str_replace("'","\'",$_POST['article16']),str_replace("'","\'",$_POST['article17']),str_replace("'","\'",$_POST['article18']),str_replace("'","\'",$_POST['article19']),str_replace("'","\'",$_POST['article20']),$_POST['qte1'],$_POST['qte2'],$_POST['qte3'],$_POST['qte4'],$_POST['qte5'],$_POST['qte6'],$_POST['qte7'],$_POST['qte8'],$_POST['qte9'],$_POST['qte10'],$_POST['qte11'],$_POST['qte12'],$_POST['qte13'],$_POST['qte14'],$_POST['qte15'],$_POST['qte16'],$_POST['qte17'],$_POST['qte18'],$_POST['qte19'],$_POST['qte20']);
	}
	else if($_POST['bordero_type']=='expertise')
	 {
		
	 @$borderos->ajoutBordero(str_replace("'","\'",$_POST['mdo']),str_replace("'","\'",$_POST['code']),str_replace("'","\'",$_POST['bordero_type']),str_replace("'","\'",$_POST['Expertise_article1']),$_POST['Expertise_prix1'],str_replace("'","\'",$_POST['Expertise_article2']),$_POST['Expertise_prix2'],str_replace("'","\'",$_POST['Expertise_article3']),$_POST['Expertise_prix3'],str_replace("'","\'",$_POST['Expertise_article4']),$_POST['Expertise_prix4'],str_replace("'","\'",$_POST['Expertise_article5']),$_POST['Expertise_prix5'],str_replace("'","\'",$_POST['Expertise_article6']),$_POST['Expertise_prix6'],str_replace("'","\'",$_POST['Expertise_article7']),$_POST['Expertise_prix7'],str_replace("'","\'",$_POST['article8']),str_replace("'","\'",$_POST['article9']),str_replace("'","\'",$_POST['article10']),str_replace("'","\'",$_POST['article11']),str_replace("'","\'",$_POST['article12']),str_replace("'","\'",$_POST['article13']),str_replace("'","\'",$_POST['article14']),str_replace("'","\'",$_POST['article15']),str_replace("'","\'",$_POST['article16']),str_replace("'","\'",$_POST['article17']),str_replace("'","\'",$_POST['article18']),str_replace("'","\'",$_POST['article19']),str_replace("'","\'",$_POST['article20']),$_POST['Expertise_qte1'],$_POST['Expertise_qte2'],$_POST['Expertise_qte3'],$_POST['Expertise_qte4'],$_POST['Expertise_qte5'],$_POST['Expertise_qte6'],$_POST['Expertise_qte7'],null,null,null,null,null,null,null,null,null,null,null,null,null);
	 
	 }
	 }
	 // echo 'OKO';
	echo "<script>document.location.href='sigma.php?AO_Affiche'</script>";

	 }
	 else
	 {
	 echo 'Erreur Ajout';
	  
	 }
}

//Fin Ajout

//Pour la creation automatique de code de projet
if(!empty($nbsprojet)){@$rowp=count($nbsprojet);}
else {$rowp=0;}
if($rowp>0)
{
foreach($nbsprojet as $clep);
//echo $cle['code'].'<br>';
@$tabp=$clep['code_projet'];
//echo ' code P ' .$tabp;
$lnp=strlen($tabp);
//
}

if($rowp==0)
{
$initp='001';

$codep='C'.date('y').$initp;

}
else
{

if(@$tabp['5']=='9' and @$tabp['4']=='9')
 {$initp=($tabp['3']+1).'00';}
 else
 {
   if(@$tabp['5']=='9')
   {@$initp=$tabp['3'].(@$tabp['4']+1).'0';}
   else if(@$tabp['5']<9)
   {@$initp=$tabp['3'].$tabp['4'].(@$tabp['5']+1);}
 }
$P=$tabp['1'].$tabp['2'];
//echo '<h1>'.$P.'</h1>';
if($P<date('y'))
{
$codep=$P.$initp;
}
else
{
 $codep='C'.date('y').$initp;
}
}
//Fin code Projet
$row=count($nbs);
if($row>0)
{
foreach($nbs as $cle);
//echo $cle['code'].'<br>';
$tab=$cle['code'];
$ln=strlen($tab);
//echo '<h1>'.$ln.'</h1>';
}


if($row==0)
{
$init='001';

$code=date('y').$init;

}
else
{
 if($tab['4']=='9' and $tab['3']=='9')
 {$init=($tab['2']+1).'00';}
 else
 {
   if($tab['4']=='9')
   {$init=$tab['2'].($tab['3']+1).'0';}
   else if($tab['4']<'9')
   {$init=$tab['2'].$tab['3'].($tab['4']+1);}
 }
$A=$tab['0'].$tab['1'];
if($A<date('y'))
{
$code=$A.$init;
}
else
{
 $code=date('y').$init;
 }
 
}
$date_dechargeJ=date('d')+1;
$date_decharge=date($date_dechargeJ.'/'.'m/Y');
/*value="<?php //echo date('Y-m-'.$date_dechargeJ)"?>*/
?>
<form method="post" enctype="multipart/form-data" >
<div class="container" style="position:relative; top:-60px"  >
      <div class="card card-register mx-auto mt-5" >
        <div class="card-header">Ajouter <?php if(!isset($_GET['P'])){?> Offre de Prix<?php } else { ?> Projet<?php } ?>
		  <input type="submit" style="width:250px; margin:auto;position:relative; top:-30px;margin-bottom:-30px" id="ok" value="Ajouter" name="ok" class="btn btn-primary btn-block"/>
		  </div>
        <div class="card-body" style="position:relative; top:-10px;">
          <table width=100% >
		  <tr>
            <!---------*********************-->
			<td width=10%>
	   <table width=50% style="width:100px"   cellpadding=4   >
	<tr >
	<td width=50 align=center>
	<label for="codeAO">Code de l'Offre: <b>OP</b></label>
	<?php if(isset($_GET['C']))
				{
				?>			
				<br>
		   <label for="codeprojet" >Code Projet</label>
		<?php } ?>
	</td>
					 
						<td width=50>
						<input type="text"  readOnly   id="codeAO" value="<?php echo ($mxCod['MaxCode']+1); ?>" style="padding:6px 0 6px 4px" name="code" class="form-control" >
						<?php if(isset($_GET['C']))
				{
				?>			
				
		   <br>
						<input type="text" name="code_projet"  readonly  value="<?php echo $codep ?>" id="codeprojet" style="padding:6px 0 6px 4px" name="code_AO" class="form-control"  >
						
						<?php
						}
						?>
					</td>
				  <td width=50 align=center>
					<label for="mdo">MDO</label>
					</td>
					 
						<td width=50>
					  
						<input list="mdo" id="mdobordero" style="padding:6px 0 6px 4px" name="mdo" class="form-control" >
						 <datalist id="mdo">
						<?php foreach($designation_partenaire as $designation){
						?>
						<option><?php echo $designation['designation']?>
						
						<?php } ?>
						
						</datalist>
						
				  </td>
					
				  
				  </tr>
				  
				  <!------------------------->
				  <tr>
				  <td width=50 align=center>
				  <div class="form-row">

					<label for="titre">Titre</label>
					  </td>
					 
						<td colspan=4>
						
						<textarea  id="titre" style="padding:4px 0 4px 4px" name="titre" class="form-control"  ></textarea>
						<input type="text"  class="form-control" name="intitule" id="intitule">
				  </div>
				  </td>
				  
				  
				  </tr>
				  <!-------------------------------->
				  <tr>
				   <?php if($_SESSION['user']!='utilisateur'){ ?>
				  <td width=50 align=center>
				  
					<label for="etat" >Etat</label>
					  
					</td>
					<td>
					<table  width=70%>
					<tr>
					
					  </tr>
					  <tr>
					  <td width=20>
						
						<input type="radio" name="etat" value="0" disabled class="form-control" style="width:20px" > 
						 </td>
					  <td>
						<span style="font-size:18px">0</span>
						</td>
						<td width=20>
						
						<input type="radio" name="etat" 	<?php if(!isset($_GET['P'])){?> checked<?php } else {?> disabled<?php } ?>  value="1" class="form-control" style="width:20px" > 
						 </td>
					  <td>
						<span style="font-size:18px">1</span>
						</td>
						<?php if(isset($_GET['P']))	{?>
						<td width=20>
						
						<input type="radio" name="etat" checked  value="2" class="form-control" style="width:20px" > 
						 </td>
					  <td>
						<span style="font-size:18px" >2</span>
						</td>
						<?php }
							else 
							{
							?>
							
							<td width=20>
						
						<input type="radio" name="etat" disabled  value="2" class="form-control" style="width:20px" > 
						 </td>
					  <td>
						<span style="font-size:18px" >2</span>
						</td>
						<?php
	}					
						?>
						</tr>
						</table>
				
				  </td>
				  <?php }else { ?>
				  <input type="hidden" name="etat" value='1'>
				  <?php } ?>
				  
				  
		 <td width=50 align=center>
								<label for="type">Type</label>
				</td>
	<td>			
						<select id="type" name="type" class="form-control" placeholder="Last name"  >
						<option value="marche_public">MARCHE PUB</option>
						<option value="public ponctuel">PUBLIC PONCTUEL</option>
						<option value="prive">PRIVE</option>
						<option value="ponctuel">PONCTUEL</option>
						</select>
				 
		 
		 </td>
				  
				  </tr>
				  
				 
				  <!------------------------->
				  <tr >
				  <td width=50 align=center>
					
				   
					
					<label for="date_limit" id="date_limites">Date limite</label>
					   </td>
	<td id="date_limit">		
						
						<input type="date"  style="padding:6px 0 6px 4px" name="date_limite" class="form-control"  >
						
				  </td>
				  <td width=50 align=center>
				  
					<label for="date_decharg" id="date_offre">Date Décharge</label>
					  </td>
					  <td>
						<input type="date"  id="date_decharg" value="<?php echo date('Y-m-'.$date_dechargeJ)?>"  style="padding:6px 0 6px 4px" name="date_decharge" class="form-control"  >
						
					  
				 
				  </td>
				  
				  </tr>
				  <!------------------------->
				  <tr>
				  <td width=50 align=center>
					<label for="cout">Cout (MD)</label>
					</td>
					  <td>
				 <input type="text" autocomplete="off" id="cout" style="padding:6px 0 6px 4px" name="cout" class="form-control">
				  </td>
				  <td width=50 align=center>
				 
					<label for="hono">Honoraire(dt)</label>
					  
						</td>
					  <td>
						<input type="text" autocomplete="off" id="hono" style="padding:6px 0 6px 4px" name="hono" class="form-control"  >
				  
				  </td>
				  
				  </tr>
				  <!------------------------->
				  <tr>
				  
				  
				  <td width=50 align=center>
				  <label for="pourcentage">Pourcentage</label>
					  </td>
					  <td>
						
						<input type="text" readonly id="pourcentage" style="padding:6px 0 6px 4px" name="pourcentage" class="form-control"  >
						</td>
				 <td width=50 align=center>
				  <label for="nb_vis">Nombre VS</label>
					  </td>
					  <td>
						
						<input type="number" min="0" id="nb_vis" style="padding:6px 0 6px 4px" name="nb_vis" class="form-control"  >
				  </td>
				  </tr>
				  
				  <!---->
				  <tr>
				  
				  
				  
				  <!--<td width=50 align=center>
				  <label for="honovisite">Honoraire Visite</label>
					  </td>
					  <td>
						
						<input type="text" id="honovisite" style="padding:6px 0 6px 4px" name="honovisite" class="form-control"  >
				  </td>
				  -->
				  </tr>
				  
				  <!------------------------->
				  <tr>
				  <td width=50 align=center><label for="rp_rd">RP/RD</label>
					  
						</td>
					  <td>
						<select id="rp_rd" style="padding:6px 0 6px 4px" name="rp_rd" class="form-control">
						<option selected="selected">Inclus</option>
						<option>Non Inclus</option>
						</select>
						</td>
				  <td width=50 align=center>
				  <label for="bordero">Bordero</label>
					
						</td>
					  <td>
						<input type="file" id="bordero" style="padding:6px 0 6px 4px" name="bordero" class="form-control"  >
				  </td>
				  
				  </tr>
				  
				  <!-------------->
				  <tr>
				 <!-- -->
				  <td width=50 align=center>
				  <label for="observation">Observation</label>
					  </td>
					  <td>
						
						<textarea id="observation" style="padding:6px 0 6px 4px" name="observation" class="form-control"  ></textarea>
				  </td>
				  
				  <div >
				  
				  <td width=50 align=center id="test_visavis">
				  <label for="designer">Vis à Vis</label>
					  </td>
					  <td id="test_vis">
						<input list="vis_a_vis"  style="width:200px" name="vis_a_vis"  class="form-control" > 
					<datalist id="vis_a_vis">
					  <?php 
					  foreach($partenairesVisAvi as $vis){
					?>
					
					<option ><?php echo $vis['designation']?></option>
					<?php } ?>
					</datalist>
						</td>
				  </div>
				  
				  </tr>
				  <tr> <td width=50 align=center>
				  <label for="observation">Total BRD</label>
					  </td>
					  <td>
						
						<input type="text" id="BRDTot" readonly class="form-control" >
				  </td></tr>
				  
	</table>
</td>
<?php if(!isset($_GET['P']))
{
?>
<td valign=top width=35%  >
    
    <div id="res_bordero" style="height:500px;overflow:scroll">
	
	
	</div>
	
	</div><!--Fin #consultation-->
	

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