<?php
$nbsprojet=$projet->getProjets();
$prjs=$projet->getProjetsINfo($_GET['codeP']);
foreach($prjs as $p);
$factures=$facture->getFacture();
$nbs=$AO->getOffre();
if(!empty($AO->getTypeOffre($_GET['codeAO']))){
foreach($AO->getTypeOffre($_GET['codeAO']) as $TypeOffre);
}
$nbsFacture=$facture->getdernierFacture();
$nbsAutreFacture=$Autresfacture->getdernierFactureNew();
$designation_partenaire=$partenaires->getPartenairesMDO();
/**Facture**/
if(count($nbsFacture)==0)
{
$numfacture=1;
}
else
{
 foreach($nbsFacture as $fct);
 @$numfacture=($fct['numFacture']+1).'/'.date('Y');
}
/**Autre FActure*/
@$nbAutres=count($nbsAutreFacture);
if($nbAutres==0)
{
$numAutreFacture=1;
$numAutreFacture=$numAutreFacture.'/'.date('Y');
}
else
{
 foreach($nbsAutreFacture as $fAct);
 @$numAutreFacture=($fAct['numFacture']+1).'/'.date('Y');
}
//Ajout Facture
if(isset($_POST['ok']))
 {
if($_POST['facture']=='facture'){
	$numsF=explode("/",$_POST['numfacture']);$numF=$numsF[0];$anneeF=$numsF[1];	
		@$verifFacture=count($facture->VerifFacturesExistes($numF,$anneeF));
		if($verifFacture==0)
		{
		if($facture->AjoutFacture(str_replace("'","\'",$_POST['titre']),str_replace("'","\'",$_POST['intitule'])) )
		{
		@copy($_FILES['facture']['tmp_name'],'Facture/Lien/'.$_FILES['facture']['name']);
		//echo 'ok';
		echo "<script>document.location.href='sigma.php?AfficherFacturation'</script>";
		}
		else 
		echo '<h1>Erreur</h1>';
		}


		else{
		echo '<h1>Vérifier N° Facture</h1>';	
		}
}// verif dans table Facture

/**** Vérif Table Facture news*****/
else if($_POST['facture']=='Autrefacture'){
	echo '<h1>'.$_POST['numfactureAutreF'].'</h1>';
	$numsAutreF=explode("/",$_POST['numfactureAutreF']);$numAutreF=$numsAutreF[0];$anneeAutreF=$numsAutreF[1];	
@$verifFacture=count($Autresfacture->VerifAutreFacturesExistes($numAutreF,$anneeAutreF));
if($verifFacture==0)
{
if($Autresfacture->AjoutAutreFacture(str_replace("'","\'",$_POST['titre']),str_replace("'","\'",$_POST['intitule'])) )
{
@copy($_FILES['facture']['tmp_name'],'FactureNews/Lien/'.$_FILES['facture']['name']);
//echo '<h1>OKO</h1>';
echo "<script>document.location.href='sigma.php?AfficherAutres_Facture&FactureNews'</script>";
}
else 
echo '<h1>Erreur</h1>';
}


else{
echo '<h1>Vérifier N° Autre Facture</h1>';	
}
}// verif dans table Facture

 } // Fin Verif factures
//Fin Ajout

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

if(@$tabp['5']=='9' and @$tabp['4']=='9')
 {@$initp=($tabp['3']+1).'00';}
 else
 {
   if(@$tabp['5']=='9')
   {@$initp=$tabp['3'].($tabp['4']+1).'0';}
   else if(@$tabp['5']<9)
   {@$initp=$tabp['3'].$tabp['4'].($tabp['5']+1);}
 }
@$P=$tabp['1'].$tabp['2'];
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
if($date_dechargeJ<10)
{
	$date_dechargeJ='0'.$date_dechargeJ;
}
$date_decharge=date($date_dechargeJ.'/'.'m/Y');
//echo '<h1>'.$date_decharge.'</h1>';
?>
<form method="post" enctype="multipart/form-data" >
<div class="container" style="position:relative; top:-60px"  >
      <div class="card card-register mx-auto mt-5" >
        <div class="card-header">Ajouter <?php if(!isset($_GET['P'])){?> Facture<?php } else { ?> Projet<?php } ?>
		<table width=100% align=center >
		<tr>
		 <td>
		  <input type="radio" value="facture" name="facture" checked style="width:30px;height:30px"><b style="position:relative;top:-10px;left:10px;font-size:18px">Facture</b></td>
		 <td> <input type="radio" value="Autrefacture" name="facture" style="width:30px;height:30px"><b style="position:relative;top:-10px;left:10px;font-size:18px">Autre Facture</b></td>
		  <td><input type="submit" style="width:250px; margin:auto;position:relative; top:-30px;margin-bottom:-30px" id="ok" value="Ajouter" name="ok" class="btn btn-primary btn-block"/></td>
		 
		 </table>
		  </div>
        <div class="card-body" style="position:relative; top:-10px;">
          <table width=100%  >
		  <tr>
            <!---------*********************-->
			<td width=50%>
	   <table width=20% style="width:200px;position:relative;left:-20px"  cellpadding=3  >
	<tr >
	<td  width=30% align=center colspan=3>
	<table><tr><td><label for="codeAO">Code Offre</label></td>
						<td colspan=1><input type="text"  readOnly   id="codeAO" value="<?php echo $_GET['codeAO']?>" style="padding:6px 0 6px 4px" name="code" class="form-control" ></td>
						</tr>
			<tr><td colspan=1>
		   <label for="codeprojet" >Code Projet</label>
		   </td>
		   <td colspan=1>
						<input type="text" name="code_projet"  readonly  value="<?php echo $_GET['codeP'] ?>" id="codeprojet" style="padding:6px 0 6px 4px" name="code_AO" class="form-control"  >
						
						
					</td>
					</tr></table>
			</td>
				  <td width=65% align=center >
				  <table>
				  <tr>
				  <td>
					<label for="mdo">N° Facture</label>
					</td>
					 
						<td width=50 >
					  <input  style="padding:6px 0 6px 4px" value="<?php echo $numfacture ?>"   name="numfacture" id="numFacture"  class="form-control" >
					  <br>
					   <input  style="padding:6px 0 6px 4px" value="<?php echo $numAutreFacture ?>"   name="numfactureAutreF" id="numAutreFacture"  class="form-control" >
						 
				  </td>
				  	<td width=100% >
					<table width=100%>
					<tr><th width=50%> <span style="width:180px;height:25px" >PRIX.en.HTVA: </th>
					<td ><input type="radio" name="tva" value="1.13" style="display:none"    ></td>
					</tr></table>
					</td>
					</tr>
				  <tr>
				  <td >
					<label for="mdo">MDO</label>
					</td>
					 
						<td width=50 >
					  <input  style="padding:6px 0 6px 4px;width:200px" value="<?php echo $p['mdo']?>" readonly name="mdo" class="form-control" >
						 
				  </td>
					</tr>
					</table>
					</td>
				  
				  </tr>
				  
				  <!------------------------->
				  <tr >
				  <td width=20 align=center>
				  <div class="form-row">

					<label for="titre">Titre</label>
					  </td>
					 
						<td colspan=3>
						
						<textarea  id="titre" style="padding:4px 0 4px 4px" name="titre" class="form-control" readonly><?php echo $p['titre']?></textarea>
						<input type="text" value="<?php echo $p['intitule']?>" readonly   class="form-control" name="intitule" id="intitule">
				  </div>
				  </td>
				  
				  
				  </tr>
				  <!-------------------------------->
				  <tr>
				  <td width=50 align=center>
				  
					<label for="etat" >Avancement Projet</label>
					  
					</td>
					<td colspan=2>
					<table  width=70%>
					<tr>
					
					  </tr>
					  <tr>
					  <td width=20>
						
						<input type="radio" name="etat" value="0"<?php if($_GET['etat']==0){?> checked <?php } ?>  class="form-control" style="width:20px" > 
						 </td>
					  <td>
						<span style="font-size:18px">0</span>
						</td>
						<td width=20>
						
						<input type="radio" name="etat" <?php if($_GET['etat']==1){?> checked <?php } ?> 	  value="0" class="form-control" style="width:20px" > 
						 </td>
					  <td>
						<span style="font-size:18px">1</span>
						</td>
						
						<td width=20>
						
						<input type="radio" name="etat"  <?php if($_GET['etat']==2){?> checked <?php } ?>  value="2" class="form-control" style="width:20px" > 
						 </td>
					  <td>
						<span style="font-size:18px" >2</span>
						</td>
						
							
							<td width=20>
						
						<input type="radio" name="etat" <?php if($_GET['etat']==3){?> checked <?php } ?>   value="3" class="form-control" style="width:20px" > 
						 </td>
					  <td>
						<span style="font-size:18px" >3</span>
						</td>
						
					  
						</tr>
						</table>
				
				  </td>
				  
				  
		 
				  </tr>
				  
				 
				  <!------------------------->
				  <tr>
				  <td width=50 align=center >
					
				   
					
					<label for="etatfacture">Date Facture </label>
					   </td>
	<td>		
						
						<input type="date" value="<?php echo date('Y-m-'.$date_dechargeJ)?>" name="dateFacture" id="dateFacture" style="padding:6px 0 6px 4px;width:150px"  class="form-control"  >
						
				  </td>
				  <td width=50 align=center>
					
				   
					
					<label for="dateFacture">Date Envoi </label>
					   </td>
	<td>		
						
						<input type="date" name="dateEnvoi" value="<?php echo date('Y-m-'.$date_dechargeJ)?>" id="dateFacture" style="padding:6px 0 6px 4px;width:150px"  class="form-control"  >
						
						
				  </td>
				  <td style="position:relative;left:-200px;top:-20px">	
                    <label for="dateFacture">Date Recouvrement </label>				  
						
						<input type="date" name="dateRecouvrement" id="dateFacture" style="padding:6px 0 6px 4px;width:150px"  class="form-control"  >
						
						
				  </td>
				  
				  </tr>
				  <!------------------------->
				 
				  <tr>
				 
				  <td width=50 align=center colspan=2>
				  <label for="facture">Lien Facture</label>
					
						</td>
					  <td colspan=2>
						<input type="file" id="facture" style="padding:6px 0 6px 4px" name="facture" class="form-control"  >
				  </td>
				  
				  </tr>
				  
				  <!-------------->
				  <tr>
				
				  <td width=50 align=center colspan=2>
				  <label for="observation">Observation</label>
					  </td>
					  <td colspan=2>
						
						<textarea id="observation" style="padding:6px 0 6px 4px" name="observation" class="form-control"  ></textarea>
				  </td></tr>
				  
	</table>
</td>
<?php if(isset($_GET['codeAO']))
{
$brds=$borderos->getborderosAO($_GET['codeAO']);
$facturesQtes=$facture->getQtes($_GET['codeAO']);
$facturesAutresQtes=$facture->getQtesFNews($_GET['codeAO']);

?>
<td valign=top width=70%  >
    
    <div id="res_bordero" style="height:500px;overflow:scroll;position:relative;left:-180px;width:400px">
	<table border=1   class="table table-bordered" id="factureCreation"  cellspacing="0" >
			
			<?php 
			
				@$lnbrds=count($brds);
				if($lnbrds>0)
				{
				foreach($brds as $cle);
				?>
				<tr ><th >
				<span style="font-size:12px">Type BRD</span></th>
				<th colspan=4 width=60 >
				<span style="font-size:12px;float:left"><?php echo $cle['type']?></span>
				</th>
				
				</tr>
					<tr >
					<th style="width:20px;padding:0;margin:0"><span style="font-size:12px">Articles</span></th>
				
				<th style="width:400px;padding:0;margin:0"><span style="font-size:12px">Designantion</span></th>
				<th><span style="font-size:12px">Res Qte Brd</span></th>
				<th><span style="font-size:12px">Prix</span></th>
				<th><span style="font-size:12px">Qte Facture</span></th>
				</tr>
			<tr>
			
			<?php 
			$montant=0;
			if($cle['prix1']!=null)
			{
				
				$sqte1=0;
				if(!empty($facturesQtes)){
					
				foreach($facturesQtes as $q){
					@$sqte1=$sqte1+$q['qte1'];
				}
				}
				if(!empty($facturesAutresQtes)){
				foreach($facturesAutresQtes as $qA){
					@$sqte1=$sqte1+$qA['qte1'];
				}
				}
				$res1=0;
				if(($cle['qte1']-$sqte1)<0)
				{$res1=0;}
			     else {$res1=$cle['qte1']-$sqte1;}
			 $montant=$montant+($cle['prix1']*$cle['qte1']);	
			?>
			<tr>
			
			<td style="margin:0;padding:0;font-size:12px;height:50px" align=center>
			<span style="position:relative;top:10px;">Art.1</span></td>
			<td style="margin:0;padding:0;font-size:12px;height:80px" valign=top>
			<textarea type="text" name="article1" style="border:none;float:left;height:50px;width:100%;top:-10px;padding-top:10px;height:100px" readonly><?php echo $cle['article1']?>
			</textarea>
			</td>
			<td style="font-size:12px;padding:10px 0 0 0;" align=center>
			<input style="border:none;width:40px;" readonly type="text" value="<?php echo $cle['qte1']-$sqte1;?>"></td>
			<td style="font-size:12px;padding:10px 0 0 0;" align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix1" 
			value="<?php echo $cle['prix1']?>"></td>
			<td style="margin:0;padding:10px 0 0 0;height:50px;">
			<input type="number" name="qte1" value="0" min="0" max="<?php echo $res1?>" style="width:40px;float:left;margin-right:5px">
			 </td>
			</tr> 
			
			<?php
                     }
					 
					 if($cle['prix2']!=null)
			{
				$montant=$montant+($cle['prix2']*$cle['qte2']);	
				$sqte2=0;
				if(!empty($facturesQtes)){
				foreach($facturesQtes as $q){
					$sqte2=$sqte2+$q['qte2'];
				}
				}
				if(!empty($facturesAutresQtes)){
				foreach($facturesAutresQtes as $qA){
					@$sqte2=$sqte2+$qA['qte2'];
				}
				}
			?>
			<tr>
			
			<td style="margin:0;padding:0;font-size:12px;height:50px" align=center>
			<span style="position:relative;top:10px;">Art.2</span></td>
			<td style="margin:0;padding:0;font-size:12px;height:80px" valign=top>
			<textarea type="text" name="article2" style="border:none;float:left;height:50px;width:100%;top:-10px;padding-top:10px;" readonly><?php echo $cle['article2']?>
			</textarea>
			</td>
			
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text" value="<?php echo $cle['qte2']-$sqte2?>"></td>
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix2" 
			value="<?php echo $cle['prix2']?>"></td>
			<td style="margin:0;padding:10px 0 0 0;height:50px">
			<input type="number" name="qte2" value="0" min="0" max="<?php echo $cle['qte2']-$sqte2?>" style="width:40px;float:left;margin-right:5px">
			</td>
			</tr> 
			
			<?php
                     }
					 
					  if($cle['prix3']!=null)
			{
			$montant=$montant+($cle['prix3']*$cle['qte3']);	
			$sqte3=0;
				if(!empty($facturesQtes)){
				foreach($facturesQtes as $q){
					$sqte3=$sqte3+$q['qte3'];
				}
				}
				if(!empty($facturesAutresQtes)){
				foreach($facturesAutresQtes as $qA){
					@$sqte3=$sqte3+$qA['qte3'];
				}
				}
			?>
			<tr>
			
			<td style="margin:0;padding:0;font-size:12px;height:50px" align=center>
			<span style="position:relative;top:10px;">Art.3</span></td>
			<td style="margin:0;padding:0;font-size:12px;height:80px" valign=top>
			<textarea type="text" name="article3" style="border:none;float:left;height:50px;width:100%;top:-10px;padding-top:10px;" readonly><?php echo $cle['article3']?>
			</textarea>
			</td>
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text"  
			value="<?php echo $cle['qte3']-$sqte3?>"></td>
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix3" 
			value="<?php echo $cle['prix3']?>"></td>
			<td style="margin:0;padding:10px 0 0 0;height:50px">
			<input type="number" name="qte3" value="0" min="0" max="<?php echo $cle['qte3']-$sqte3?>" style="width:40px;float:left;margin-right:5px">
			</td>
			</tr> 
			
			<?php
                     }
					  if($cle['prix4']!=null)
			{
				$montant=$montant+($cle['prix4']*$cle['qte4']);	
				$sqte4=0;
				if(!empty($facturesQtes)){
				foreach($facturesQtes as $q){
					$sqte4=$sqte4+$q['qte4'];
				}
				}
				if(!empty($facturesAutresQtes)){
				foreach($facturesAutresQtes as $qA){
					@$sqte4=$sqte4+$qA['qte4'];
				}
				}
			?>
			<tr>
			
			<td style="margin:0;padding:0;font-size:12px;height:50px" align=center>
			<span style="position:relative;top:10px;">Art.4</span></td>
			<td style="margin:0;padding:0;font-size:12px;height:80px" valign=top>
			<textarea type="text" name="article4" style="border:none;float:left;height:50px;width:100%;top:-10px;padding-top:10px;" readonly><?php echo $cle['article4']?>
			</textarea>
			</td>
			
			
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text"  
			value="<?php echo $cle['qte4']-$sqte4?>"></td>
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix4" 
			value="<?php echo $cle['prix4']?>"></td>
			<td style="margin:0;padding:10px 0 0 0;height:50px">
			<input type="number" name="qte4" min="0" max="<?php echo $cle['qte4']-$sqte4?>" value="0" style="width:40px;float:left;margin-right:5px">
			</td>
			</tr> 
			
			<?php
                     }
					  if($cle['prix5']!=null)
			{
				$montant=$montant+($cle['prix5']*$cle['qte5']);	
				$sqte5=0;
				if(!empty($facturesQtes)){
				foreach($facturesQtes as $q){
					$sqte5=$sqte5+$q['qte5'];
				}
				}
				if(!empty($facturesAutresQtes)){
				foreach($facturesAutresQtes as $qA){
					@$sqte5=$sqte5+$qA['qte5'];
				}
				}
			?>
			<tr>
			
			<td style="margin:0;padding:0;font-size:12px;height:50px" align=center>
			<span style="position:relative;top:10px;">Art.5</span></td>
			<td style="margin:0;padding:0;font-size:12px;height:80px" valign=top>
			<textarea type="text" name="article5" style="border:none;float:left;height:50px;width:100%;top:-10px;padding-top:10px;" readonly><?php echo $cle['article5']?>
			</textarea>
			</td>
			
			
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text" 
			value="<?php echo $cle['qte5']-$sqte5?>"></td>
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix5" 
			value="<?php echo $cle['prix5']?>"></td>
			<td style="margin:0;padding:10px 0 0 0;height:50px">
			<input type="number" min="0" max="<?php echo $cle['qte5']-$sqte5?>" name="qte5" value="0" style="width:40px;float:left;margin-right:5px">
			</td>
			</tr> 
			
			<?php
                     }
					  if($cle['prix6']!=null)
			{$montant=$montant+($cle['prix6']*$cle['qte6']);	
				$sqte6=0;
				if(!empty($facturesQtes)){
				foreach($facturesQtes as $q){
					$sqte6=$sqte6+$q['qte6'];
				}
				}
				if(!empty($facturesAutresQtes)){
				foreach($facturesAutresQtes as $qA){
					@$sqte6=$sqte6+$qA['qte6'];
				}
				}
			?>
			<tr>
			
			<td style="margin:0;padding:0;font-size:12px;height:50px" align=center>
			<span style="position:relative;top:10px;">Art.6</span></td>
			<td style="margin:0;padding:0;font-size:12px;height:80px" valign=top>
			<textarea type="text" name="article6" style="border:none;float:left;height:50px;width:100%;top:-10px;padding-top:10px;" readonly><?php echo $cle['article6']?>
			</textarea>
			</td>
			
			
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text"  
			value="<?php echo $cle['qte6']-$sqte6?>"></td>
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix6" 
			value="<?php echo $cle['prix6']?>"></td>
			<td style="margin:0;padding:10px 0 0 0;height:50px">
			<input type="number" name="qte6" min="0" max="<?php echo $cle['qte6']-$sqte6?>" value="0" style="width:40px;float:left;margin-right:5px">
			</td>
			</tr> 
			<?php
                     }
					  if($cle['prix7']!=null)
			{
				$montant=$montant+($cle['prix7']*$cle['qte7']);	
				$sqte7=0;
				if(!empty($facturesQtes)){
				foreach($facturesQtes as $q){
					$sqte7=$sqte7+$q['qte7'];
				}
				}
				if(!empty($facturesAutresQtes)){
				foreach($facturesAutresQtes as $qA){
					@$sqte7=$sqte7+$qA['qte7'];
				}
				}
			?>
			<tr>
			
			<td style="margin:0;padding:0;font-size:12px;height:50px" align=center>
			<span style="position:relative;top:10px;">Art.7</span></td>
			<td style="margin:0;padding:0;font-size:12px;height:80px" valign=top>
			<textarea type="text" name="article7" style="border:none;float:left;height:50px;width:100%;top:-10px;padding-top:10px;" readonly><?php echo $cle['article7']?>
			</textarea>
			</td>
			
			
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text"
			value="<?php echo $cle['qte7']-$sqte7?>"></td>
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix7" 
			value="<?php echo $cle['prix7']?>"></td>
			<td style="margin:0;padding:10px 0 0 0;height:50px">
			<input type="number" min="0" max="<?php echo $cle['qte7']-$sqte7?>" name="qte7" value="0" style="width:40px;float:left;margin-right:5px">
			</td>
			</tr> 
			
			<?php
                     }
					  if($cle['prix8']!=null){
						  $sqte8=0;
				if(!empty($facturesQtes)){
				foreach($facturesQtes as $q){
					$sqte8=$sqte8+$q['qte8'];
				}
				}
				if(!empty($facturesAutresQtes)){
				foreach($facturesAutresQtes as $qA){
					@$sqte8=$sqte8+$qA['qte8'];
				}
				}
						  ?>
					 <tr>
			
			<td style="margin:0;padding:0;font-size:12px;height:50px" align=center>
			<span style="position:relative;top:10px;">Art.8</span></td>
			<td style="margin:0;padding:0;font-size:12px;height:80px" valign=top>
			<textarea type="text" name="article8" style="border:none;float:left;height:50px;width:100%;top:-10px;padding-top:10px;" readonly><?php echo $cle['article8']?>
			</textarea>
			</td>
			
			
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text" 
			value="<?php echo $cle['qte8']-$sqte8?>"></td>
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix8" 
			value="<?php echo $cle['prix8']?>"></td>
			<td style="margin:0;padding:10px 0 0 0;height:50px">
			<input type="number" name="qte8" min="0" max="<?php echo $cle['qte8']-$sqte8?>" value="0" style="width:40px;float:left;margin-right:5px">
			</td>
			</tr> 
					  
					  <?php
                     }
					 if($cle['prix9']!=null){
						 $sqte9=0;
				if(!empty($facturesQtes)){
				foreach($facturesQtes as $q){
					$sqte9=$sqte9+$q['qte9'];
				}
				}
				if(!empty($facturesAutresQtes)){
				foreach($facturesAutresQtes as $qA){
					@$sqte9=$sqte9+$qA['qte9'];
				}
				}
						 ?>
					 
				<tr>
			
			<td style="margin:0;padding:0;font-size:12px;height:50px" align=center>
			<span style="position:relative;top:10px;">Art.9</span></td>
			<td style="margin:0;padding:0;font-size:12px;height:80px" valign=top>
			<textarea type="text" name="article9" style="border:none;float:left;height:50px;width:100%;top:-10px;padding-top:10px;" readonly><?php echo $cle['article9']?>
			</textarea>
			</td>
			
			
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text"  
			value="<?php echo $cle['qte9']-$sqte9?>"></td>
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix9" 
			value="<?php echo $cle['prix9']?>"></td>
			<td style="margin:0;padding:10px 0 0 0;height:50px">
			<input type="number" name="qte9" value="0" min="0" max="<?php echo $cle['qte9']-$sqte9?>" style="width:40px;float:left;margin-right:5px">
			</td>
			</tr> 
					 
					 <?php
                     }
					 else {
					 ?>
					 <input type="hidden" name="qte9" value="0">
					 <?php
					 }
					 if($cle['prix10']!=null){
						 $sqte10=0;
				if(!empty($facturesQtes)){
				foreach($facturesQtes as $q){
					$sqte10=$sqte10+$q['qte10'];
				}
				}
				if(!empty($facturesAutresQtes)){
				foreach($facturesAutresQtes as $qA){
					@$sqte10=$sqte10+$qA['qte10'];
				}
				}
						 ?>
					 
					<tr>
			
			<td style="margin:0;padding:0;font-size:12px;height:50px" align=center>
			<span style="position:relative;top:10px;">Art.10</span></td>
			<td style="margin:0;padding:0;font-size:12px;height:80px" valign=top>
			<textarea type="text" name="article10" style="border:none;float:left;height:50px;width:100%;top:-10px;padding-top:10px;" readonly><?php echo $cle['article10']?>
			</textarea>
			</td>
			
			
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text"  
			value="<?php echo $cle['qte10']-$sqte10?>"></td>
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix10" 
			value="<?php echo $cle['prix10']?>"></td>
			<td style="margin:0;padding:10px 0 0 0;height:50px">
			<input type="number" name="qte10" min="0" max="<?php echo $cle['qte10']-$sqte10?>" value="0" style="width:40px;float:left;margin-right:5px">
			</td>
			</tr> 
					 
					 <?php
                     }
					  else {
					 ?>
					 <input type="hidden" name="qte10" value="0">
					 <?php
					 }
					 if($cle['prix11']!=null){
						 $sqte11=0;
				if(!empty($facturesQtes)){
				foreach($facturesQtes as $q){
					$sqte11=$sqte11+$q['qte11'];
				}
				}
				if(!empty($facturesAutresQtes)){
				foreach($facturesAutresQtes as $qA){
					@$sqte11=$sqte11+$qA['qte11'];
				}
				}
						 ?>
                 				 
					<tr>
			
			<td style="margin:0;padding:0;font-size:12px;height:50px" align=center>
			<span style="position:relative;top:10px;">Art.11</span></td>
			<td style="margin:0;padding:0;font-size:12px;height:50px" valign=top>
			<textarea type="text" name="article11" style="border:none;float:left;height:50px;width:100%;top:-10px;padding-top:10px;" readonly><?php echo $cle['article11']?>
			</textarea>
			</td>
			
			
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text"  
			value="<?php echo $cle['qte11']-$sqte11?>"></td>
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix11" 
			value="<?php echo $cle['prix11']?>"></td>
			<td style="margin:0;padding:10px 0 0 0;height:50px">
			<input type="number" name="qte11" min="0" max="<?php echo $cle['qte11']-$sqte11?>" value="0" style="width:40px;float:left;margin-right:5px">
			</td>
			</tr>

					 <?php
                     }
					  else {
					 ?>
					 <input type="hidden" name="qte11" value="0">
					 <?php
					 }
					 if($cle['prix12']!=null){
						 $sqte12=0;
				if(!empty($facturesQtes)){
				foreach($facturesQtes as $q){
					$sqte12=$sqte12+$q['qte12'];
				}
				}
				if(!empty($facturesAutresQtes)){
				foreach($facturesAutresQtes as $qA){
					@$sqte12=$sqte12+$qA['qte12'];
				}
				}
						 ?>
										 
					<tr>
			
			<td style="margin:0;padding:0;font-size:12px;height:50px" align=center>
			<span style="position:relative;top:10px;">Art.12</span></td>
			<td style="margin:0;padding:0;font-size:12px;height:50px" valign=top>
			<textarea type="text" name="article12" style="border:none;float:left;height:50px;width:100%;top:-10px;padding-top:10px;" readonly><?php echo $cle['article12']?>
			</textarea>
			</td>
			
			
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text"  
			value="<?php echo $cle['qte12']-$sqte12?>"></td>
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix12" 
			value="<?php echo $cle['prix12']?>"></td>
			<td style="margin:0;padding:10px 0 0 0;height:50px">
			<input type="number" name="qte12" min="0" max="<?php echo $cle['qte12']-$sqte12?>" value="0" style="width:40px;float:left;margin-right:5px">
			</td>
			</tr>

					 <?php
                     }
					  else {
					 ?>
					 <input type="hidden" name="qte12" value="0">
					 <?php
					 }
					 if($cle['prix13']!=null){
						 $sqte13=0;
				if(!empty($facturesQtes)){
				foreach($facturesQtes as $q){
					$sqte13=$sqte13+$q['qte13'];
				}
				}
				if(!empty($facturesAutresQtes)){
				foreach($facturesAutresQtes as $qA){
					@$sqte13=$sqte13+$qA['qte13'];
				}
				}
						 ?>
					 
									 
					<tr>
			
			<td style="margin:0;padding:0;font-size:12px;height:50px" align=center>
			<span style="position:relative;top:10px;">Art.13</span></td>
			<td style="margin:0;padding:0;font-size:12px;height:50px" valign=top>
			<textarea type="text" name="article13" style="border:none;float:left;height:50px;width:100%;top:-10px;padding-top:10px;" readonly><?php echo $cle['article13']?>
			</textarea>
			</td>
			
			
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text"  
			value="<?php echo $cle['qte13']-$sqte13?>"></td>
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix13" 
			value="<?php echo $cle['prix13']?>"></td>
			<td style="margin:0;padding:10px 0 0 0;height:50px">
			<input type="number" name="qte13" value="0"  min="0" max="<?php echo $cle['qte13']-$sqte13?>" style="width:40px;float:left;margin-right:5px">
			</td>
			</tr>
					 
					 <?php
                     }
					  else {
					 ?>
					 <input type="hidden" name="qte13" value="0">
					 <?php
					 }
					 if($cle['prix14']!=null){
						 $sqte14=0;
				if(!empty($facturesQtes)){
				foreach($facturesQtes as $q){
					$sqte14=$sqte14+$q['qte14'];
				}
				}
				if(!empty($facturesAutresQtes)){
				foreach($facturesAutresQtes as $qA){
					@$sqte14=$sqte14+$qA['qte14'];
				}
				}
						 ?>
					 
					 				 
					<tr>
			
			<td style="margin:0;padding:0;font-size:12px;height:50px" align=center>
			<span style="position:relative;top:10px;">Art.14</span></td>
			<td style="margin:0;padding:0;font-size:12px;height:50px" valign=top>
			<textarea type="text" name="article14" style="border:none;float:left;height:50px;width:100%;top:-10px;padding-top:10px;" readonly><?php echo $cle['article14']?>
			</textarea>
			</td>
			
			
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text"  
			value="<?php echo $cle['qte14']-$sqte14?>"></td>
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix14" 
			value="<?php echo $cle['prix14']?>"></td>
			<td style="margin:0;padding:10px 0 0 0;height:50px">
			<input type="number" name="qte14" value="0" min="0" max="<?php echo $cle['qte14']-$sqte14?>" style="width:40px;float:left;margin-right:5px">
			</td>
			</tr>
					 
					 <?php
                     }
					  else {
					 ?>
					 <input type="hidden" name="qte14" value="0">
					 <?php
					 }
					 if($cle['prix15']!=null){
						 $sqte15=0;
				if(!empty($facturesQtes)){
				foreach($facturesQtes as $q){
					$sqte15=$sqte15+$q['qte15'];
				}
				}
				if(!empty($facturesAutresQtes)){
				foreach($facturesAutresQtes as $qA){
					@$sqte15=$sqte15+$qA['qte15'];
				}
				}
						 ?>
					 
					 				 
					<tr>
			
			<td style="margin:0;padding:0;font-size:12px;height:50px" align=center>
			<span style="position:relative;top:10px;">Art.15</span></td>
			<td style="margin:0;padding:0;font-size:12px;height:50px" valign=top>
			<textarea type="text" name="article15" style="border:none;float:left;height:50px;width:100%;top:-10px;padding-top:10px;" readonly><?php echo $cle['article15']?>
			</textarea>
			</td>
			
			
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text"  
			value="<?php echo $cle['qte15']-$sqte15?>"></td>
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix15" 
			value="<?php echo $cle['prix15']?>"></td>
			<td style="margin:0;padding:10px 0 0 0;height:50px">
			<input type="number" name="qte15"  min="0" max="<?php echo $cle['qte15']-$sqte15?>"value="0" style="width:40px;float:left;margin-right:5px">
			</td>
			</tr>
					 <?php
                     }
					  else {
					 ?>
					 <input type="hidden" name="qte15" value="0">
					 <?php
					 }
					 if($cle['prix16']!=null){
						 $sqte16=0;
				if(!empty($facturesQtes)){
				foreach($facturesQtes as $q){
					$sqte16=$sqte16+$q['qte16'];
				}
				}
				if(!empty($facturesAutresQtes)){
				foreach($facturesAutresQtes as $qA){
					@$sqte16=$sqte16+$qA['qte16'];
				}
				}
						 ?>
					 
					 				 
					<tr>
			
			<td style="margin:0;padding:0;font-size:12px;height:50px" align=center>
			<span style="position:relative;top:10px;">Art.16</span></td>
			<td style="margin:0;padding:0;font-size:12px;height:50px" valign=top>
			<textarea type="text" name="article16" style="border:none;float:left;height:50px;width:100%;top:-10px;padding-top:10px;" readonly><?php echo $cle['article16']?>
			</textarea>
			</td>
			
			
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text"  
			value="<?php echo $cle['qte16']-$sqte16?>"></td>
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix16" 
			value="<?php echo $cle['prix16']?>"></td>
			<td style="margin:0;padding:10px 0 0 0;height:50px">
			<input type="number" name="qte16" min="0" max="<?php echo $cle['qte16']-$sqte16?>" value="0" style="width:40px;float:left;margin-right:5px">
			</td>
			</tr>
					 <?php
                     }
					  else {
					 ?>
					 <input type="hidden" name="qte16" value="0">
					 <?php
					 }
			if($cle['prix17']!=null){
				$sqte17=0;
				if(!empty($facturesQtes)){
				foreach($facturesQtes as $q){
					$sqte17=$sqte17+$q['qte17'];
				}
				}
				if(!empty($facturesAutresQtes)){
				foreach($facturesAutresQtes as $qA){
					@$sqte17=$sqte17+$qA['qte17'];
				}
				}
				?>

							 
					<tr>
			
			<td style="margin:0;padding:0;font-size:12px;height:50px" align=center>
			<span style="position:relative;top:10px;">Art.17</span></td>
			<td style="margin:0;padding:0;font-size:12px;height:50px" valign=top>
			<textarea type="text" name="article17" style="border:none;float:left;height:50px;width:100%;top:-10px;padding-top:10px;" readonly><?php echo $cle['article17']?>
			</textarea>
			</td>
			
			
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text"  
			value="<?php echo $cle['qte17']-$sqte17?>"></td>
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix17" 
			value="<?php echo $cle['prix17']?>"></td>
			<td style="margin:0;padding:10px 0 0 0;height:50px">
			<input type="number" name="qte17" min="0" max="<?php echo $cle['qte17']-$sqte17?>" value="0" style="width:40px;float:left;margin-right:5px">
			</td>
			</tr>
			<?php
                     }
					  else {
					 ?>
					 <input type="hidden" name="qte17" value="0">
					 <?php
					 }
		if($cle['prix18']!=null){
			$sqte18=0;
				if(!empty($facturesQtes)){
				foreach($facturesQtes as $q){
					$sqte18=$sqte18+$q['qte18'];
				}
				}
				if(!empty($facturesAutresQtes)){
				foreach($facturesAutresQtes as $qA){
					@$sqte18=$sqte18+$qA['qte18'];
				}
				}
			?>
				
								 
					<tr>
			
			<td style="margin:0;padding:0;font-size:12px;height:50px" align=center>
			<span style="position:relative;top:10px;">Art.18</span></td>
			<td style="margin:0;padding:0;font-size:12px;height:50px" valign=top>
			<textarea type="text" name="article18" style="border:none;float:left;height:50px;width:100%;top:-10px;padding-top:10px;" readonly><?php echo $cle['article18']?>
			</textarea>
			</td>
			
			
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text"  
			value="<?php echo $cle['qte18']-$sqte18?>"></td>
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix18" 
			value="<?php echo $cle['prix18']?>"></td>
			<td style="margin:0;padding:10px 0 0 0;height:50px">
			<input type="number" name="qte18" min="0" max="<?php echo $cle['qte18']-$sqte18?>" value="0" style="width:40px;float:left;margin-right:5px">
			</td>
			</tr>

		<?php
                     }
					  else {
					 ?>
					 <input type="hidden" name="qte18" value="0">
					 <?php
					 }
		if($cle['prix19']!=null){
			$sqte19=0;
				if(!empty($facturesQtes)){
				foreach($facturesQtes as $q){
					$sqte19=$sqte1+$q['qte19'];
				}
				}
				if(!empty($facturesAutresQtes)){
				foreach($facturesAutresQtes as $qA){
					@$sqte19=$sqte19+$qA['qte19'];
				}
				}
			?>
		
						 
					<tr>
			
			<td style="margin:0;padding:0;font-size:12px;height:50px" align=center>
			<span style="position:relative;top:10px;">Art.19</span></td>
			<td style="margin:0;padding:0;font-size:12px;height:50px" valign=top>
			<textarea type="text" name="article19" style="border:none;float:left;height:50px;width:100%;top:-10px;padding-top:10px;" readonly><?php echo $cle['article19']?>
			</textarea>
			</td>
			
			
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text"  
			value="<?php echo $cle['qte19']-$sqte19?>"></td>
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix19" 
			value="<?php echo $cle['prix19']?>"></td>
			<td style="margin:0;padding:10px 0 0 0;height:50px">
			<input type="number" name="qte19" min="0" max="<?php echo $cle['qte19']-$sqte19?>" value="0" style="width:40px;float:left;margin-right:5px">
			</td>
			</tr>
		
		
		<?php
                     }
					  else {
					 ?>
					 <input type="hidden" name="qte19" value="0">
					 <?php
					 }
		if($cle['prix20']!=null){
			$sqte20=0;
				if(!empty($facturesQtes)){
				foreach($facturesQtes as $q){
					$sqte20=$sqte20+$q['qte20'];
				}
				}
				if(!empty($facturesAutresQtes)){
				foreach($facturesAutresQtes as $qA){
					@$sqte20=$sqte20+$qA['qte20'];
				}
				}
				?>
		
						 
					<tr>
			
			<td style="margin:0;padding:0;font-size:12px;height:50px" align=center>
			<span style="position:relative;top:10px;">Art.20</span></td>
			<td style="margin:0;padding:0;font-size:12px;height:50px" valign=top>
			<textarea type="text" name="article20" style="border:none;float:left;height:50px;width:100%;top:-10px;padding-top:10px;" readonly><?php echo $cle['article20']?>
			</textarea>
			</td>
			
			
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text"  
			value="<?php echo $cle['qte20']-$sqte20?>"></td>
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix20" 
			value="<?php echo $cle['prix20']?>"></td>
			<td style="margin:0;padding:10px 0 0 0;height:50px">
			<input type="number" name="qte20" min="0" max="<?php echo $cle['qte20']-$sqte20?>" value="0" style="width:40px;float:left;margin-right:5px">
			</td>
			</tr>
			
		
		<?php
                     }
					  else {
					 ?>
					 <input type="hidden" name="qte20" value="0">
					 <?php
					 }


			
			} 
			  else
			  {echo "<p>Pas de bordero pour l'appel d'offre".$_GET['codeAO']."</p>";}
			?>
			</table>
			
			</td>
			
			</tr>
			
			
			</table>	
			<!----------Traitement Facture----------->
			<table>
			<tr><td></td><td><input type="hidden" id="total" name="total"></td></tr>
			<tr><td></td><td><input type="hidden" id="tot" name="qtes"></td></tr>
	        <tr><td></td><td><input type="hidden" id="articles" name="articles"></td></tr>
			<tr><td></td><td><input type="hidden" id="prixs" name="prixs"></td></tr>
	</div>
	<?php if( $TypeOffre['type']!='marche_public'){?>
	<table style="width:400px;float:right">
	<tr><td></td><td><b>Designation</b></td><td><b>%</b></td><td><b>Montant BRD</b></td><td><b>Montant Facture</b></td></tr>
			<tr>
			<td>Art:</td><td width=40%><textarea name="designation"  ></textarea></td>
			<td width=10%><input type="text" id="pourcentage" name="pourcentage" style="width:100%"></td>
			
			<td width=20%>
			<input type="text" readOnly id="prixsPourcentage" value="<?php echo $montant?>" name="prixsPourcentage" ></td>
			<td width=20%><input type="text" id="montant" name="montantFacturePourcentage" readOnly></td>
			</tr>
			</table>
	<?php } ?>
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