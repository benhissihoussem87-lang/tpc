<?php
$nbsprojet=$projet->getProjets();
$factures=$facture->getFacture();
/***** Pour Récupérer le prix*********/
$infosFacture=$facture->getInfosFactureNews($_GET['id']);
foreach($infosFacture as $detailFact);
/*****Recouv Ponct********/
$infosRC=$facture->getInfosFactureRC($_GET['codeP']);
if(@count($infosRC)>0)
{
foreach($infosRC as $detailFactRC);
}
/*$prixFact=explode("<br />",$detailFact['prix']);
$articles=explode("<br />",$detailFact['articles']);
$qtes=explode("<br />",$detailFact['qte']);
$nbprix=sizeof($prixFact)-1;*/
//echo '<h1>'.$nbprix.'</h1>';
/*********Fin recupération**********/
$nbs=$AO->getOffre();
$nbsFacture=$facture->getdernierFacture();
$designation_partenaire=$partenaires->getPartenairesMDO();
if(count($nbsFacture)==0)
{
$numfacture=1;
}
else if(count($nbsFacture)!=0)
{
	
 foreach($nbsFacture as $fct);
 @$numfacture=$fct['numFacture']+1;
	
}
/********************/


if($_GET['codeAO']=='Ponct')
	 { 
	
	     $rech='00000';
		$verifFcaturesBrd=$borderos->VerifborderosPonct($rech);
		//var_dump($verifFcaturesBrd);
	 }
/**********************/
//Ajout Facture
if(isset($_POST['ok']))
 {
	 if($_POST['ok']=='Modifier')
	 {
		 /*****/
		 $lien=null;
		  if(empty($_FILES['facture']['name']))
		  {
			  $lien=$detailFact['lien'];
		  }
		  else{
			 $lien=$_FILES['facture']['name'];
		  }
		 
		 /**********/
		$factures=explode('/',$_POST['numfacture']);
	    $ancienNumFacture=$_GET['numFacture'].'/'.$_GET['anneeFacture'];
    @$verifFacture=count($Autresfacture->VerifAutreFacturesExistes($factures[0],$factures[1]));
if($verifFacture==0)
{
	 if($_GET['codeAO']=='Ponct')
	 { $NumFacture=$_GET['numFacture'].'/'.$_GET['anneeFacture'];
	     $verifFcaturesBrd=$borderos->VerifborderosPonct($NumFacture);
		 echo '<h1> BRD FActure '.count($verifFcaturesBrd).'</h1>';
		 if(count($verifFcaturesBrd)>0)
		 {
		  $borderos->ModifierBorderauxFacture(str_replace("'","\'",$_POST['mdo']),str_replace("'","\'",$_POST['numfacture']),str_replace("'","\'",$_POST['bordero_type']),str_replace("'","\'",$_POST['article1']),$_POST['prix1'],str_replace("'","\'",$_POST['article2']),$_POST['prix2'],str_replace("'","\'",$_POST['article3']),$_POST['prix3'],str_replace("'","\'",$_POST['article4']),$_POST['prix4'],str_replace("'","\'",$_POST['article5']),$_POST['prix5'],str_replace("'","\'",$_POST['article6']),$_POST['prix6'],str_replace("'","\'",$_POST['article7']),$_POST['prix7'],$_GET['numFacture'],'AutreF');
		 }
		 else
		 {
         $borderos->ajoutBorderoFacture(str_replace("'","\'",$_POST['mdo']),str_replace("'","\'",$_POST['numfacture']),str_replace("'","\'",$_POST['bordero_type']),str_replace("'","\'",$_POST['article1']),$_POST['prix1'],str_replace("'","\'",$_POST['article2']),$_POST['prix2'],str_replace("'","\'",$_POST['article3']),$_POST['prix3'],str_replace("'","\'",$_POST['article4']),$_POST['prix4'],str_replace("'","\'",$_POST['article5']),$_POST['prix5'],str_replace("'","\'",$_POST['article6']),$_POST['prix6'],str_replace("'","\'",$_POST['article7']),$_POST['prix7'],'AutreF');
             }
	 }
	if(@$Autresfacture->ModifierAutreFacture($_GET['id'],$factures[0],$factures[1],$_POST['dateFacture'],$_POST['dateRecouvrement'],$_POST['dateEnvoi'],$_POST['qte1'],$_POST['qte2'],$_POST['qte3'],$_POST['qte4'],$_POST['qte5'],$_POST['qte6'],$_POST['qte7'],$_POST['qte8'],$_POST['qte9'],$_POST['qte10'],$_POST['qte11'],$_POST['qte12'],$_POST['qte13'],$_POST['qte14'],$_POST['qte15'],$_POST['qte16'],$_POST['qte17'],$_POST['qte18'],$_POST['qte19'],$_POST['qte20'],$lien) )
	{	 
	@copy($_FILES['facture']['tmp_name'],'FactureNews/Lien/'.$_FILES['facture']['name']);
	  if($_GET['Param']=='facture')
	  {

	echo "<script>document.location.href='sigma.php?AfficherAutres_Facture&FactureNews'</script>";
	}
	if($_GET['Param']=='facturation')
	  {
	echo "<script>document.location.href='sigma.php?AfficherFacturation'</script>";
	}
	}//Fin if
	else 
	echo '<h1>Erreur</h1>';
	 } // si la modification est effectué
else if($ancienNumFacture==$_POST['numfacture']){
	if($_GET['codeAO']=='Ponct')
	 { 
	    // echo '<h1> Num Facture'.$ancienNumFacture.'</h1>';
	     @$verifFcaturesBrdE=$borderos->VerifborderosPonct($ancienNumFacture);
		 // echo '<h1> BRD FActure 222 '.count($verifFcaturesBrdE).'</h1>';
		 if(@count($verifFcaturesBrdE)>0)
		 {
		  $borderos->ModifierBorderauxFacture(str_replace("'","\'",$_POST['mdo']),str_replace("'","\'",$_POST['numfacture']),str_replace("'","\'",$_POST['bordero_type']),str_replace("'","\'",$_POST['article1']),$_POST['prix1'],str_replace("'","\'",$_POST['article2']),$_POST['prix2'],str_replace("'","\'",$_POST['article3']),$_POST['prix3'],str_replace("'","\'",$_POST['article4']),$_POST['prix4'],str_replace("'","\'",$_POST['article5']),$_POST['prix5'],str_replace("'","\'",$_POST['article6']),$_POST['prix6'],str_replace("'","\'",$_POST['article7']),$_POST['prix7'],$_GET['numFacture'],'AutreF');
		 }
		 else
		 {
         $borderos->ajoutBorderoFacture(str_replace("'","\'",$_POST['mdo']),str_replace("'","\'",$_POST['numfacture']),str_replace("'","\'",$_POST['bordero_type']),str_replace("'","\'",$_POST['article1']),$_POST['prix1'],str_replace("'","\'",$_POST['article2']),$_POST['prix2'],str_replace("'","\'",$_POST['article3']),$_POST['prix3'],str_replace("'","\'",$_POST['article4']),$_POST['prix4'],str_replace("'","\'",$_POST['article5']),$_POST['prix5'],str_replace("'","\'",$_POST['article6']),$_POST['prix6'],str_replace("'","\'",$_POST['article7']),$_POST['prix7'],'AutreF');
             }
	 }
	if(@$Autresfacture->ModifierAutreFacture($_GET['id'],$factures[0],$factures[1],$_POST['dateFacture'],$_POST['dateRecouvrement'],$_POST['dateEnvoi'],$_POST['qte1'],$_POST['qte2'],$_POST['qte3'],$_POST['qte4'],$_POST['qte5'],$_POST['qte6'],$_POST['qte7'],$_POST['qte8'],$_POST['qte9'],$_POST['qte10'],$_POST['qte11'],$_POST['qte12'],$_POST['qte13'],$_POST['qte14'],$_POST['qte15'],$_POST['qte16'],$_POST['qte17'],$_POST['qte18'],$_POST['qte19'],$_POST['qte20'],$lien) )
	{	 
	@copy($_FILES['facture']['tmp_name'],'FactureNews/Lien/'.$_FILES['facture']['name']);
	  if($_GET['Param']=='facture')
	  {
	echo "<script>document.location.href='sigma.php?AfficherAutres_Facture&FactureNews'</script>";
	}
	if($_GET['Param']=='facturation')
	  {
		  
	echo "<script>document.location.href='sigma.php?AfficherFacturation'</script>";
	
	}//Fin if
	
	 } // si la modification est effectué
	
}
else{
	echo '<h1>Vérifier N° Facture</h1>';	
}
   } //fin if isset $_POST
	 else if($_POST['ok']=='Supprimer')
	 {
		 $numFacture=$_GET['numFacture'].'/'.$_GET['anneeFacture'];
		if($Autresfacture->deleteAutrefactures($_GET['id']) )
		{
			$borderos->deleteBorderoFacture($numFacture,'AutreF');
		//echo '<h1>Facture Ajouté avec Succée</h1>';
		echo "<script>document.location.href='sigma.php?AfficherAutres_Facture&FactureNews'</script>";
		}
		else 
		echo '<h1>Erreur</h1>'; 
	 }
}
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
 {$initp=($tabp['3']+1).'00';}
 else
 {
   if(@$tabp['5']=='9')
   {$initp=$tabp['3'].($tabp['4']+1).'0';}
   else if(@$tabp['5']<9)
   {@$initp=$tabp['3'].$tabp['4'].($tabp['5']+1);}
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

/**********Facture News*************/
if(isset($_POST['newFacture']))
{
	
	$newFacture=$facture->getdernierFactureNew();
	if($newFacture==null)
	{$num=1;}
	else{
	foreach($newFacture as $ftD);
	$num=($ftD['id']+1);
	}
	//suppression de facture
	$facture->deletefactures($_GET['id']);
	$codeOP=$_GET['numFacture'].'/'.$_GET['anneeFacture'];
	$facture->deleteBorderoFacture($codeOP);
	// Déplacement vers table facture news
	$annee=date('Y');
	$numfacture=$num.'/'.$annee;
	if($facture->deplacerFacture(str_replace("'","\'",$_POST['titre']),str_replace("'","\'",$_POST['intitule']),$num,$annee) )
			{
			// Ajout de bordero de facture news
			$borderos->ajoutBorderoFactureAutre(str_replace("'","\'",$_POST['mdo']),$numfacture,str_replace("'","\'",$_POST['bordero_type']),str_replace("'","\'",$_POST['article1']),$_POST['prix1'],str_replace("'","\'",$_POST['article2']),$_POST['prix2'],str_replace("'","\'",$_POST['article3']),$_POST['prix3'],str_replace("'","\'",$_POST['article4']),$_POST['prix4'],str_replace("'","\'",$_POST['article5']),$_POST['prix5'],str_replace("'","\'",$_POST['article6']),$_POST['prix6'],str_replace("'","\'",$_POST['article7']),$_POST['prix7']);
			// Fin Ajout bordero Facture news
			@copy($_FILES['facture']['tmp_name'],'Facture/Lien/'.$_FILES['facture']['name']);
			echo "<script>document.location.href='sigma.php?AfficherFacturation'</script>";
			}
			else 
			echo '<h1>Erreur</h1>';
	
	
	}
	//echo '<h1>'.$num.'</h1>';
// Fin isset($_POST['newFacture']))

?>
<form method="post" enctype="multipart/form-data" >
<div class="container" style="position:relative; top:-60px"  >
      <div class="card card-register mx-auto mt-5" >
        <div class="card-header">Modifier Autre <?php if(!isset($_GET['P'])){?> Facture<?php } else { ?> Projet<?php } ?>
		<a href="FactureNews/detailFacture.php?id=<?php echo $_GET['id']?>&AO=<?php echo $_GET['codeAO']?>&Facture=<?php echo $_GET['numFacture']?>&Annee=<?php echo $_GET['anneeFacture']?>&montant=<?php echo $detailFact['mantant']?>&Pourcentage=<?php echo $detailFact['pourcentage']?>&designation=<?php echo $detailFact['designation']?>" class="btn btn-primary btn-block" style="width:200px;position:relative; top:10px;">IMPRIMER</a>
		  <input type="submit" style="width:200px; margin:auto;position:relative; top:-30px;margin-bottom:-30px;left:-100px" id="ok" value="Modifier" name="ok" class="btn btn-primary btn-block"/>
		    <input type="submit" style="width:200px; margin:auto;position:relative; top:-40px;margin-bottom:-30px;left:170px" id="ok" value="Supprimer" name="ok" class="btn btn-primary btn-block"/>
			
		  </div>
        <div class="card-body" style="position:relative; top:-10px;">
          <table width=100%  >
		  <tr>
            <!---------*********************-->
			<td width=50%>
	   <table width=20% style="width:200px;position:relative;left:-25px"  cellpadding=4  >
	<tr >
	<td  width=30% align=center colspan=2>
	<table>
	<tr>
	<td><label for="codeAO">Code Offre</label></td>
						<td ><input type="text"  readOnly   id="codeAO" value="<?php echo $_GET['codeAO']?>" style="padding:6px 0 6px 4px" name="code" class="form-control" ></td>
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
						<?php @$numFacture=$_GET['numFacture'].'/'.$detailFact['annee'];?>
					  <input  style="padding:6px 0 6px 4px" value="<?php echo $numFacture ?>"   name="numfacture"  class="form-control" >
						 
				  </td>
					</tr>
				  <tr>
				  <td >
					<label for="mdo">MDO</label>
					</td>
					 
						<td width=50 >
					  <input  style="padding:6px 0 6px 4px;width:200px" value="<?php echo $_GET['mdo']?>" readonly name="mdo" class="form-control" >
						 
				  </td>
					</tr>
					</table>
					</td>
				  
				  </tr>
				  
				  <!------------------------->
				  <tr>
				  <td width=50 align=center>
				  <div class="form-row">

					<label for="titre">Titre</label>
					  </td>
					 
						<td colspan=3>
						
						<textarea  id="titre" style="padding:4px 0 4px 4px" name="titre" class="form-control" readonly><?php echo $_GET['titre']?></textarea>
						<input type="text" value="<?php echo $_GET['intitule']?>" readonly   class="form-control" name="intitule" id="intitule">
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
						
						<input type="radio" name="etat" <?php if($_GET['etat']==1){?> checked <?php } ?> 	  value="1" class="form-control" style="width:20px" > 
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
					
				   
					
					<label for="etatfacture">Date Facture </label><br>
					
						
						<input type="date" name="dateFacture" style="width:180px" value="<?php echo $_GET['Facture']?>" id="dateFacture" style="padding:6px 0 6px 4px;width:120px"  class="form-control"  >
						
				  </td>
				  <td width=50 align=center>
					
				   
					
					<label for="dateFacture">Date Envoi </label><br>
					 
						<input type="date" name="dateEnvoi" style="width:180px" value="<?php echo $_GET['envoye']?>" id="dateFacture" style="padding:6px 0 6px 4px;width:120px"  class="form-control"  >
						
				</td>
				<td>
<label for="dateFacture">Date Recouvrement </label>				  
						
						<input type="date" style="width:180px" value="<?php echo $_GET['recouvre']?>" name="dateRecouvrement" id="dateFacture" style="padding:6px 0 6px 4px;width:120px"  class="form-control"  >
						
						
				  </td>
				  
				  </tr>
				  <!------------------------->
				 <?php 
				 if(@count($infosRC)>0)
                    { ?>
				   <tr>
				 
				  <td width=50 align=center colspan=2>
				  <label for="facture">Mantant REC.P</label>
					
						</td>
					  <td colspan=2>
					  <p><input type="text" name="mantant" readOnly class="form-control" value="<?php echo $detailFactRC['RECOUV'].' Dt'?>"></p>
						
				  </td>
				  
				  </tr>
				  <?php } ?>
				  	   <tr>
				 
				  <td width=50 align=center colspan=2>
				  <label for="facture">Mantant BRD</label>
					
						</td>
					  <td colspan=2>
					  <p><input type="text" name="mantant" readOnly class="form-control" value="<?php echo $detailFact['mantant'].' Dt'?>"></p>
						
				  </td>
				  
				  </tr>
				 
				 
				  <tr>
				 
				  <td width=50 align=center colspan=2>
				  <label for="facture">Lien Facture</label>
					
						</td>
					  <td colspan=2>
					  <p><?php echo $detailFact['lien']?></p>
						<input type="file" id="facture" style="padding:6px 0 6px 4px" name="facture" class="form-control"  >
				  </td>
				  
				  </tr>
				  
				  <!-------------->
				  <tr>
				
				  <td width=50 align=center colspan=2>
				  <label for="observation">Observation</label>
					  </td>
					  <td colspan=2>
						
						<textarea id="observation" style="padding:6px 0 6px 4px" name="observation" class="form-control"  ><?php echo $detailFact['observation']?></textarea>
				  </td></tr>
				  
	</table>
</td>
<?php if(isset($_GET['codeAO']))
{
if($_GET['codeAO']=='Ponct')
{
$code='00000';
$brds=$borderos->getborderosAO($code);
}
else {
$brds=$borderos->getborderosAO($_GET['codeAO']);
}
$Facts=$borderos->getAutreFactureAO($_GET['id'],$_GET['codeAO']);

?>
<td valign=top width=50%  >
    
    <div id="res_bordero" style="height:500px;overflow:scroll;position:relative;width:420px;">
	<table border=1   class="table table-bordered" id="factureCreation"  cellspacing="0">
			<?php 
			$montant=0;
			if($_GET['codeAO']=='Ponct')
				{
                 include 'borderauxPonct.php';
				}
				?>
			<?php 
			if($_GET['codeAO']!='Ponct')
			{
				@$lnbrds=count($brds);
				@$lnbFct=count($Facts);
				
				if($lnbrds>0)
				{
				
				foreach($brds as $cle);
				foreach($Facts as $cleF);
				//echo '<h1> F '.$cleF['qte1'].'_F2'.$cleF['qte2'].'</h1>';
				?>
				<tr>
				 <th width=50% colspan="2"  >
				<span style="font-size:12px">Type Bordereaux : </span>
				</th>
				<th width=50% colspan="2"><span style="font-size:12px;float:left">
				<?php echo $cle['type']?></span></th>
				</tr>
				<tr>
				<th width=10%><span style="font-size:12px">Art.</span></th>
				<th width=60%><span style="font-size:12px">Désignation</span></th>
				<th width=5%><span style="font-size:12px">Qte</span></th>
				
				<th><span style="font-size:12px">Prix</span></th>
				</tr>
				
			<tr>
			
			<?php 
			if($cle['prix1']!=null)
			{
				 $montant=$montant+($cle['prix1']*$cle['qte1']);
			?>
			<tr>
			
			<td style="margin:0;padding:0;font-size:12px;height:50px" align=center>
			<span style="position:relative;top:10px;">Art.1</span></td>
			<td style="margin:0;padding:0;font-size:12px;height:50px" valign=top>
			<textarea type="text" name="article1" style="border:none;float:left;height:100px;width:100%;top:-10px;padding-top:10px;" readonly>
			<?php echo $cle['article1']?>
			</textarea>
			</td>
			
			<td style="margin:0;padding:10px 0 0 0;height:50px;">
			<input type="number" name="qte1" min="0" value="<?php echo $detailFact['qte1']?>" style="width:40px;float:left;margin-right:5px">
			 </td>
			</td>
			<td  align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix1" 
			value="<?php echo $cle['prix1']?>"></td>
			<!--<td style="margin:0;padding:10px 0 0 0;height:50px;">
			<input type="number" name="qte1" value="<?php //echo $cleF['qte1']?>" style="width:40px;float:left;margin-right:5px">
			 </td>-->
			
			
			</tr> 
			
			<?php
                     }
					 else {
					 ?>
					 <input type="hidden" name="qte1" value="0">
					 <?php
					 }
					 if($cle['prix2']!=null)
			{
				 $montant=$montant+($cle['prix2']*$cle['qte2']);
				
			?>
			<tr>
			
			<td style="margin:0;padding:0;font-size:12px;height:50px" align=center>
			<span style="position:relative;top:10px;">Art.2</span></td>
			<td style="margin:0;padding:0;font-size:12px;height:50px" valign=top>
			<textarea type="text" name="article2" style="border:none;float:left;height:100px;width:100%;top:-10px;padding-top:10px;" readonly><?php echo $cle['article2']?>
			</textarea>
			</td>
			<td style="margin:0;padding:10px 0 0 0;height:50px;">
			<input type="number" name="qte2" min="0" value="<?php echo $detailFact['qte2']?>" style="width:40px;float:left;margin-right:5px">
			 </td>
			<td  align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix2" 
			value="<?php echo $cle['prix2']?>"></td>
			<!--<td style="margin:0;padding:10px 0 0 0;height:50px">
			<input type="text" name="qte2" value="<?php //echo $cleF['qte2']?>">
			</td>-->
			
			
			</tr> 
			
			<?php
                     }
					 else {
					 ?>
					 <input type="hidden" name="qte2" value="0">
					 <?php
					 }
					  if($cle['prix3']!=null)
			{
				$montant=$montant+($cle['prix3']*$cle['qte3']);
			?>
			<tr>
			
			<td style="margin:0;padding:0;font-size:12px;height:50px" align=center>
			<span style="position:relative;top:10px;">Art.3</span></td>
			<td style="margin:0;padding:0;font-size:12px;height:50px" valign=top>
			<textarea type="text" name="article3" style="border:none;float:left;height:100px;width:100%;top:-10px;padding-top:10px;" readonly><?php echo $cle['article2']?>
			</textarea>
			</td>
			<td style="margin:0;padding:10px 0 0 0;height:50px;">
			<input type="number" name="qte3" min="0" value="<?php echo $detailFact['qte3']?>" style="width:40px;float:left;margin-right:5px">
			 </td>
			<td  align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix3" 
			value="<?php echo $cle['prix3']?>"></td>
			<!--<td style="margin:0;padding:10px 0 0 0;height:50px">
			<input type="text" name="qte2" value="<?php //echo $cleF['qte2']?>">
			</td>-->
			
			
			</tr> 
			<?php
                     }
					 else {
					 ?>
					 <input type="hidden" name="qte3" value="0">
					 <?php
					 }
					  if($cle['prix4']!=null)
			{
				$montant=$montant+($cle['prix4']*$cle['qte4']);
			?>
			<tr>
			
			<td style="margin:0;padding:0;font-size:12px;height:50px" align=center>
			<span style="position:relative;top:10px;">Art.4</span></td>
			<td style="margin:0;padding:0;font-size:12px;height:50px" valign=top>
			<textarea type="text" name="article4" style="border:none;float:left;height:100px;width:100%;top:-10px;padding-top:10px;" readonly><?php echo $cle['article2']?>
			</textarea>
			</td>
			<td style="margin:0;padding:10px 0 0 0;height:50px;">
			<input type="number" name="qte4"  min="0" value="<?php echo $detailFact['qte4']?>" style="width:40px;float:left;margin-right:5px">
			 </td>
			<td  align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix4" 
			value="<?php echo $cle['prix4']?>"></td>
			<!--<td style="margin:0;padding:10px 0 0 0;height:50px">
			<input type="text" name="qte2" value="<?php //echo $cleF['qte2']?>">
			</td>-->
			
			
			</tr> 
			
			<?php
                     }
					 else {
					 ?>
					 <input type="hidden" name="qte4" value="0">
					 <?php
					 }
					  if($cle['prix5']!=null)
			{
				$montant=$montant+($cle['prix5']*$cle['qte5']);
			?>
			<tr>
			
			<td style="margin:0;padding:0;font-size:12px;height:50px" align=center>
			<span style="position:relative;top:10px;">Art.5</span></td>
			<td style="margin:0;padding:0;font-size:12px;height:50px" valign=top>
			<textarea type="text" name="article5" style="border:none;float:left;height:100px;width:100%;top:-10px;padding-top:10px;" readonly><?php echo $cle['article2']?>
			</textarea>
			</td>
			<td style="margin:0;padding:10px 0 0 0;height:50px;">
			<input type="number" name="qte5"  min="0" value="<?php echo $detailFact['qte5']?>" style="width:40px;float:left;margin-right:5px">
			 </td>
			<td  align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix5" 
			value="<?php echo $cle['prix5']?>"></td>
			<!--<td style="margin:0;padding:10px 0 0 0;height:50px">
			<input type="text" name="qte2" value="<?php //echo $cleF['qte2']?>">
			</td>-->
			
			
			</tr> 
			
			
		<?php
                     }

                else {
					 ?>
					 <input type="hidden" name="qte5" value="0">
					 <?php
					 }
						  if($cle['prix6']!=null)
			{$montant=$montant+($cle['prix6']*$cle['qte6']);
			
			?>
			<tr>
			
			<td style="margin:0;padding:0;font-size:12px;height:50px" align=center>
			<span style="position:relative;top:10px;">Art.6</span></td>
			<td style="margin:0;padding:0;font-size:12px;height:50px" valign=top>
			<textarea type="text" name="article6" style="border:none;float:left;height:100px;width:100%;top:-10px;padding-top:10px;" readonly><?php echo $cle['article2']?>
			</textarea>
			</td>
			<td style="margin:0;padding:10px 0 0 0;height:50px;">
			<input type="number" name="qte6"  min="0" value="<?php echo $detailFact['qte6']?>" style="width:40px;float:left;margin-right:5px">
			 </td>
			<td  align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix6" 
			value="<?php echo $cle['prix6']?>"></td>
			<!--<td style="margin:0;padding:10px 0 0 0;height:50px">
			<input type="text" name="qte2" value="<?php //echo $cleF['qte2']?>">
			</td>-->
			
			
			</tr> 
			
			
		<?php
                     }

                else {
					 ?>
					 <input type="hidden" name="qte6" value="0">
					 <?php
					 }
					 
							  if($cle['prix7']!=null)
			{
				$montant=$montant+($cle['prix7']*$cle['qte7']);
			?>
			<tr>
			
			<td style="margin:0;padding:0;font-size:12px;height:50px" align=center>
			<span style="position:relative;top:10px;">Art.7</span></td>
			<td style="margin:0;padding:0;font-size:12px;height:50px" valign=top>
			<textarea type="text" name="article7" style="border:none;float:left;height:100px;width:100%;top:-10px;padding-top:10px;" readonly><?php echo $cle['article2']?>
			</textarea>
			</td>
			<td style="margin:0;padding:10px 0 0 0;height:50px;">
			<input type="number" name="qte7"  min="0" value="<?php echo $detailFact['qte7']?>" style="width:40px;float:left;margin-right:5px">
			 </td>
			<td  align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix7" 
			value="<?php echo $cle['prix7']?>"></td>
			<!--<td style="margin:0;padding:10px 0 0 0;height:50px">
			<input type="text" name="qte2" value="<?php //echo $cleF['qte2']?>">
			</td>-->
			
			
			</tr> 
			
			
		<?php
                     }

                else {
					 ?>
					 <input type="hidden" name="qte7" value="0">
					 <?php
					 }
					 
						  if($cle['prix8']!=null)
			{
			?>
			<tr>
			
			<td style="margin:0;padding:0;font-size:12px;height:50px" align=center>
			<span style="position:relative;top:10px;">Art.8</span></td>
			<td style="margin:0;padding:0;font-size:12px;height:50px" valign=top>
			<textarea type="text" name="article8" style="border:none;float:left;height:100px;width:100%;top:-10px;padding-top:10px;" readonly><?php echo $cle['article8']?>
			</textarea>
			</td>
			<td style="margin:0;padding:10px 0 0 0;height:50px;">
			<input type="number" name="qte8"  min="0" value="<?php echo $detailFact['qte8']?>" style="width:40px;float:left;margin-right:5px">
			 </td>
			<td  align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix8" value="<?php echo $cle['prix8']?>">
			</td>
			
			
			
			</tr> 
			
			
		<?php
                     }

                else {
					 ?>
					 <input type="hidden" name="qte8" value="0">
					 <?php
					 }
					 
							  if($cle['prix9']!=null)
			{
			?>
			<tr>
			
			<td style="margin:0;padding:0;font-size:12px;height:50px" align=center>
			<span style="position:relative;top:10px;">Art.9</span></td>
			<td style="margin:0;padding:0;font-size:12px;height:50px" valign=top>
			<textarea type="text" name="article9" style="border:none;float:left;height:100px;width:100%;top:-10px;padding-top:10px;" readonly><?php echo $cle['article9']?>
			</textarea>
			</td>
			<td style="margin:0;padding:10px 0 0 0;height:50px;">
			<input type="number" name="qte9"  min="0" value="<?php echo $detailFact['qte9']?>" style="width:40px;float:left;margin-right:5px">
			 </td>
			<td  align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix9" value="<?php echo $cle['prix9']?>">
			</td>
			
			
			
			</tr> 
			
			
		<?php
                     }

                else {
					 ?>
					 <input type="hidden" name="qte9" value="0">
					 <?php
					 }
					 
							  if($cle['prix10']!=null)
			{
			?>
			<tr>
			
			<td style="margin:0;padding:0;font-size:12px;height:50px" align=center>
			<span style="position:relative;top:10px;">Art.10</span></td>
			<td style="margin:0;padding:0;font-size:12px;height:50px" valign=top>
			<textarea type="text" name="article10" style="border:none;float:left;height:100px;width:100%;top:-10px;padding-top:10px;" readonly><?php echo $cle['article10']?>
			</textarea>
			</td>
			<td style="margin:0;padding:10px 0 0 0;height:50px;">
			<input type="number" name="qte10"  min="0" value="<?php echo $detailFact['qte10']?>" style="width:40px;float:left;margin-right:5px">
			 </td>
			<td  align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix10" value="<?php echo $cle['prix10']?>">
			</td>
			
			
			
			</tr> 
			
			
		<?php
                     }

                else {
					 ?>
					 <input type="hidden" name="qte10" value="0">
					 <?php
					 }		 
					 
							  if($cle['prix11']!=null)
			{
			?>
		<tr>
			
			<td style="margin:0;padding:0;font-size:12px;height:50px" align=center>
			<span style="position:relative;top:10px;">Art.11</span></td>
			<td style="margin:0;padding:0;font-size:12px;height:50px" valign=top>
			<textarea type="text" name="article11" style="border:none;float:left;height:100px;width:100%;top:-10px;padding-top:10px;" readonly><?php echo $cle['article11']?>
			</textarea>
			</td>
			<td style="margin:0;padding:10px 0 0 0;height:50px;">
			<input type="number" name="qte11"  min="0" value="<?php echo $detailFact['qte11']?>" style="width:40px;float:left;margin-right:5px">
			 </td>
			<td  align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix11" value="<?php echo $cle['prix11']?>">
			</td>
</tr> 
			
			
		<?php
                     }

                else {
					 ?>
					 <input type="hidden" name="qte11" value="0">
					 <?php
					 }		 
							  if($cle['prix12']!=null)
			{
			?>
			<tr>
			
			<td style="margin:0;padding:0;font-size:12px;height:50px" align=center>
			<span style="position:relative;top:10px;">Art.12</span></td>
			<td style="margin:0;padding:0;font-size:12px;height:50px" valign=top>
			<textarea type="text" name="article12" style="border:none;float:left;height:100px;width:100%;top:-10px;padding-top:10px;" readonly><?php echo $cle['article12']?>
			</textarea>
			</td>
			<td style="margin:0;padding:10px 0 0 0;height:50px;">
			<input type="number" name="qte12"  min="0" value="<?php echo $detailFact['qte12']?>" style="width:40px;float:left;margin-right:5px">
			 </td>
			<td  align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix12" value="<?php echo $cle['prix12']?>">
			</td>
			
			
			
			</tr> 
			
			
		<?php
                     }

                else {
					 ?>
					 <input type="hidden" name="qte12" value="0">
					 <?php
					 }
							  if($cle['prix13']!=null)
			{
			?>
		<tr>
			
			<td style="margin:0;padding:0;font-size:12px;height:50px" align=center>
			<span style="position:relative;top:10px;">Art.13</span></td>
			<td style="margin:0;padding:0;font-size:12px;height:50px" valign=top>
			<textarea type="text" name="article13" style="border:none;float:left;height:100px;width:100%;top:-10px;padding-top:10px;" readonly><?php echo $cle['article13']?>
			</textarea>
			</td>
			<td style="margin:0;padding:10px 0 0 0;height:50px;">
			<input type="number" name="qte13"  min="0" value="<?php echo $detailFact['qte13']?>" style="width:40px;float:left;margin-right:5px">
			 </td>
			<td  align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix13" value="<?php echo $cle['prix13']?>">
			</td>
			
			
			
			</tr> 
			
			
		<?php
                     }

                else {
					 ?>
					 <input type="hidden" name="qte13" value="0">
					 <?php
					 }
							  if($cle['prix14']!=null)
			{
			?>
			<tr>
			
			<td style="margin:0;padding:0;font-size:12px;height:50px" align=center>
			<span style="position:relative;top:10px;">Art.14</span></td>
			<td style="margin:0;padding:0;font-size:12px;height:50px" valign=top>
			<textarea type="text" name="article14" style="border:none;float:left;height:50px;width:100%;top:-10px;padding-top:10px;" readonly><?php echo $cle['article14']?>
			</textarea>
			</td>
			<td style="margin:0;padding:10px 0 0 0;height:50px;">
			<input type="number" name="qte14"  min="0" value="<?php echo $detailFact['qte14']?>" style="width:40px;float:left;margin-right:5px">
			 </td>
			<td  align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix14" 
			value="<?php echo $cle['prix14']?>"></td>
			</tr> 
			
			
		<?php
                     }

                else {
					 ?>
					 <input type="hidden" name="qte14" value="0">
					 <?php
					 }
							  if($cle['prix15']!=null)
			{
			?>
			<tr>
			
			<td style="margin:0;padding:0;font-size:12px;height:50px" align=center>
			<span style="position:relative;top:10px;">Art.15</span></td>
			<td style="margin:0;padding:0;font-size:12px;height:50px" valign=top>
			<textarea type="text" name="article15" style="border:none;float:left;height:50px;width:100%;top:-10px;padding-top:10px;" readonly><?php echo $cle['article15']?>
			</textarea>
			</td>
			<td style="margin:0;padding:10px 0 0 0;height:50px;">
			<input type="number" name="qte15"  min="0" value="<?php echo $detailFact['qte15']?>" style="width:40px;float:left;margin-right:5px">
			 </td>
			<td  align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix15" 
			value="<?php echo $cle['prix15']?>"></td>
			</tr> 
			
			
		<?php
                     }

                else {
					 ?>
					 <input type="hidden" name="qte15" value="0">
					 <?php
					 }
						  if($cle['prix16']!=null)
			{
			?>
			<tr>
			
			<td style="margin:0;padding:0;font-size:12px;height:50px" align=center>
			<span style="position:relative;top:10px;">Art.16</span></td>
			<td style="margin:0;padding:0;font-size:12px;height:50px" valign=top>
			<textarea type="text" name="article16" style="border:none;float:left;height:50px;width:100%;top:-10px;padding-top:10px;" readonly><?php echo $cle['article16']?>
			</textarea>
			</td>
			<td style="margin:0;padding:10px 0 0 0;height:50px;">
			<input type="number" name="qte16"  min="0" value="<?php echo $detailFact['qte16']?>" style="width:40px;float:left;margin-right:5px">
			 </td>
			<td  align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix16" 
			value="<?php echo $cle['prix16']?>"></td>
			</tr> 
			
			
		<?php
                     }

                else {
					 ?>
					 <input type="hidden" name="qte16" value="0">
					 <?php
					 }			 
							  if($cle['prix17']!=null)
			{
			?>
			<tr>
			
			<td style="margin:0;padding:0;font-size:12px;height:50px" align=center>
			<span style="position:relative;top:10px;">Art.17</span></td>
			<td style="margin:0;padding:0;font-size:12px;height:50px" valign=top>
			<textarea type="text" name="article17" style="border:none;float:left;height:50px;width:100%;top:-10px;padding-top:10px;" readonly><?php echo $cle['article17']?>
			</textarea>
			</td>
			<td style="margin:0;padding:10px 0 0 0;height:50px;">
			<input type="number" name="qte17"  min="0" value="<?php echo $detailFact['qte17']?>" style="width:40px;float:left;margin-right:5px">
			 </td>
			<td  align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix17" 
			value="<?php echo $cle['prix17']?>"></td>
			</tr> 
			
			
		<?php
                     }

                else {
					 ?>
					 <input type="hidden" name="qte17" value="0">
					 <?php
					 }		 
							  if($cle['prix18']!=null)
			{
			?>
			<tr>
			
			<td style="margin:0;padding:0;font-size:12px;height:50px" align=center>
			<span style="position:relative;top:10px;">Art.18</span></td>
			<td style="margin:0;padding:0;font-size:12px;height:50px" valign=top>
			<textarea type="text" name="article18" style="border:none;float:left;height:50px;width:100%;top:-10px;padding-top:10px;" readonly><?php echo $cle['article18']?>
			</textarea>
			</td>
			<td style="margin:0;padding:10px 0 0 0;height:50px;">
			<input type="number" name="qte18"  min="0" value="<?php echo $detailFact['qte18']?>" style="width:40px;float:left;margin-right:5px">
			 </td>
			<td  align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix18" 
			value="<?php echo $cle['prix18']?>"></td>
			</tr> 
			
			
		<?php
                     }

                else {
					 ?>
					 <input type="hidden" name="qte18" value="0">
					 <?php
					 }		 
						  if($cle['prix8']!=null)
			{
			?>
			<tr>
			
			<td style="margin:0;padding:0;font-size:12px;height:50px" align=center>
			<span style="position:relative;top:10px;">Art.19</span></td>
			<td style="margin:0;padding:0;font-size:12px;height:50px" valign=top>
			<textarea type="text" name="article19" style="border:none;float:left;height:50px;width:100%;top:-10px;padding-top:10px;" readonly><?php echo $cle['article19']?>
			</textarea>
			</td>
			<td style="margin:0;padding:10px 0 0 0;height:50px;">
			<input type="number" name="qte19"  min="0" value="<?php echo $detailFact['qte19']?>" style="width:40px;float:left;margin-right:5px" >
			 </td>
			<td  align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix19" 
			value="<?php echo $cle['prix19']?>"></td>
			</tr> 
			
			
		<?php
                     }

                else {
					 ?>
					 <input type="hidden" name="qte19" value="0">
					 <?php
					 }
					 
         				  if($cle['prix20']!=null)
			{
			?>
			<tr>
			
			<td style="margin:0;padding:0;font-size:12px;height:50px" align=center>
			<span style="position:relative;top:10px;">Art.20</span></td>
			<td style="margin:0;padding:0;font-size:12px;height:50px" valign=top>
			<textarea type="text" name="article20" style="border:none;float:left;height:50px;width:100%;top:-10px;padding-top:10px;" readonly><?php echo $cle['article20']?>
			</textarea>
			</td>
			<td style="margin:0;padding:10px 0 0 0;height:50px;">
			<input type="number" name="qte20"  min="0" value="<?php echo $detailFact['qte20']?>" style="width:40px;float:left;margin-right:5px">
			 </td>
			<td  align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix20" 
			value="<?php echo $cle['prix20']?>"></td>
			</tr> 
			
			
		<?php
                     }

                else {
					 ?>
					 <input type="hidden" name="qte20" value="0">
					 <?php
					 }			


			
			
			}
			}
			?>
			</table>
			
			
			</tr>
			
			
			</table>	
			
			</tr>
			
			
			</table>	
			<!----------Traitement Facture----------->
			<table>
			<tr><td></td><td><input type="hidden" id="total" name="total"></td></tr>
			<tr><td></td><td><input type="hidden" id="tot" name="qtes"></td></tr>
	        <tr><td></td><td><input type="hidden" id="articles" name="articles"></td></tr>
			<tr><td></td><td><input type="hidden" id="prixs" name="prixs"></td></tr>
	</div>
	<?php if( @$TypeOffre['type']!='marche_public' or $_GET['codeAO']=='Ponct' ){?>
	<table style="width:400px;float:right;position:relative;top:-20px" >
	<tr><td></td><td><b>Designation</b></td><td><b>%</b></td><td><b>Montant BRD</b></td><td><b>Montant Facture</b></td></tr>
			<tr>
			<td>Art:</td><td width=40%><textarea name="designation"  ><?php echo $detailFact['designation']?></textarea></td>
			<td width=10%><input type="text" id="pourcentage" value="<?php echo $detailFact['pourcentage']?>" name="pourcentage" style="width:100%"></td>
			<?php $montantF=0;
			   if($detailFact['pourcentage']!=null)
			   {
				   $montantF=$detailFact['mantant']/1.13;
			   }
			   else 
			   {$montantF="";}
		   ?>
			<td width=20%>
			<input type="text" readOnly id="prixsPourcentage" value="<?php echo $montant;?>" name="prixsPourcentage" ></td>
			<td width=20%><input type="text" id="montant" name="montantFacturePourcentage" value="<?php echo $montantF;?>"   readOnly></td>
			</tr>
			</table>
	<?php }
     $_SESSION['montantBrd']=$montant;
	 $_SESSION['qte1Brd']=$cle['qte1'];
	 $_SESSION['qte2Brd']=$cle['qte2'];
	 $_SESSION['qte3Brd']=$cle['qte3'];
	 $_SESSION['qte4Brd']=$cle['qte4'];
	 $_SESSION['qte5Brd']=$cle['qte5'];
	 $_SESSION['qte6Brd']=$cle['qte6'];
	 $_SESSION['qte7Brd']=$cle['qte7'];

	?>
	
	

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