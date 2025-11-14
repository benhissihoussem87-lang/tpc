<?php
$designation_partenaire=$AO->getPartenairesMDO();
$dernier_ponct=$ponct->getDernierponctuel();
$nbsponct=$ponct->getponctuel();
$partenairesVisAvi=$ponct->PartenairesVis_a_vis();
//Pour AFficher Somme de BRD
if(isset($_GET['AO_Affiche']) and isset($_GET['AO_modifier']))
{
$res_opbrd=$AO->getBorderoAO($_GET['codeAO']);
@$pnbsopbrd=count($res_opbrd);
if($pnbsopbrd>0)
{
foreach($res_opbrd as $resbrd);
@$totalBRD=($resbrd['prix1']*$resbrd['qte1'])+($resbrd['prix2']*$resbrd['qte2'])+($resbrd['prix3']*$resbrd['qte3'])+($resbrd['prix4']*$resbrd['qte4'])+($resbrd['prix5']*$resbrd['qte5'])+($resbrd['prix6']*$resbrd['qte6'])+($resbrd['prix7']*$resbrd['qte7'])+($resbrd['prix8']*$resbrd['qte8'])+($resbrd['prix9']*$resbrd['qte9'])+($resbrd['prix10']*$resbrd['qte10'])+($resbrd['prix11']*$resbrd['qte11'])+($resbrd['prix12']*$resbrd['qte12'])+($resbrd['prix13']*$resbrd['qte13'])+($resbrd['prix14']*$resbrd['qte14'])+($resbrd['prix15']*$resbrd['qte15'])+($resbrd['prix16']*$resbrd['qte16'])+($resbrd['prix17']*$resbrd['qte17'])+($resbrd['prix18']*$resbrd['qte19'])+($resbrd['prix20']*$resbrd['qte20']);
$totalBRDs=$totalBRD*1.13;
}
}

//Fin SOMME BRED
/***Pour afficher num****/
$nb_ponct=count($dernier_ponct);

if($nb_ponct==0)
{$num='01';}
else
{
foreach($dernier_ponct as $pnct);
$num=$pnct['num']+01;
 //echo '<h1>'.$pnct['num'].'</h1>';
}
if($num<10)
{
$num='00'.$num;
}

//Code onctuel

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

$initp=date('d');
$anne = date('y');
$mois = date('m');
//$codep=$anne.$mois.$initp;
//$code=$codep;
$compte=0;
if(count($dernier_ponct))
{
foreach($dernier_ponct as $pncts){
	$codep=$pncts['code']+1;
/*if($pncts['code']==$codep)
{
 $codep=$codep+1;
}
else{
$compte=0;
$codep=$codep;
}*/
}
}

/**********Ponctuel********/
if(isset($_GET['AO_modifier']))
{
$detailsAO=$AO->DetailProjet($_GET['AO_modifier']);
foreach($detailsAO as $detA);

}
$nbsprojet=$projet->getProjets($_GET['codeAO']);
$maxCodeP=$AO->getMaxCodeP();
foreach($maxCodeP as $mxCodP);

$MCP = $mxCodP['MaxCodeP'];
//echo '<h1>'.$mxCodP['MaxCodeP'].'</h1>';
//echo '<h1>'.($MCP+1).'</h1>';
	//echo '<h1>'.$_GET['codeAO'].'</h1>';
$getProjetAO=$AO->getProjetAO($_GET['codeAO']);
@$nb=count($getProjetAO);
if($nb>0)
{
foreach($getProjetAO as $p);
}
$details=$AO->detailAO($_GET['AO_modifier']);
$detailsBRD=$AO->detailBrd($_GET['codeAO']);
//echo '<h1>'.count($details ).'</h1>';
foreach($details as $det);
foreach($detailsBRD as $res);
$id_brd=$res['id'];
//echo '<h1>'.$id_brd.'</h1>';
//Ajout Appel Offre
if(isset($_POST['ok']))
{
	/*****/
		 $lien=null;
		  if(empty($_FILES['bordero']['name']))
		  {
			  $lien=$det['bordero'];
		  }
		  else{
			 $lien=$_FILES['bordero']['name'];
		  }
		 
		 /**********/
	if($_POST['ok']=='Modifier')
	{
		/************ Controle MDO et Vis a vis***********/
		
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

	@$verifPartenaireVIS_A_vis=$partenaires->VerifExistePartenaireVis_A_VIS($_POST['vis_a_vis']);
	if(count(@$verifPartenaireVIS_A_vis)==0)
	{
	 $partenaires->ajoutPartenaire('vis_a_vis',str_replace("'","\'",$_POST['vis_a_vis']),str_replace("'","\'",$_POST['vis_a_vis']),null,null,null,null,null,null,$_SESSION['user']);
	}

	if($_POST['type']=='prive' or $_POST['type']=='ponctuel')
	{
	 $limite=null;
	  $visavis=$_POST['vis_a_vis'];
	}
	else
	{
	 $limite=$_POST['date_limite'];
	   $visavis=null;
	}
		
		
		/***********Fin control*******/
		// Modifier Offre
		if(isset($_POST['vis_a_vis']))
		{
		$vis_a_vis=$_POST['vis_a_vis'];}
		else
		{
		$vis_a_vis=null;
		}
		
		 if($AO->ModifierAO($_GET['AO_modifier'],str_replace("'","\'",$_POST['titre']),str_replace("'","\'",$_POST['intitule']),str_replace("'","\'",$vis_a_vis),$lien))
		 {
		if(isset($_POST['etat']))
		{
		 if($_POST['etat']=='2')
		 {
		 if($_POST['type']=='ponctuel' or $_POST['type']=='PUBLIC PONCTUEL' ){
			 
		 $PP=$codep;
		 $testOP=$AO->getAppelOffrePonctuel($_POST['code']);
		@$np=count($testOP);
		if($np==0) 
		{
	 @$AO->AjoutPonctuel($num,$PP,$_POST['code'],str_replace("'","\'",$_POST['mdo']),str_replace("'","\'",$_POST['titre']),str_replace("'","\'",$_POST['vis_a_vis']),str_replace("'","\'",$_POST['hono']),'0',str_replace("'","\'",$_POST['date_decharge']),$_POST['nb_vis']);
	 $recP->ajoutRecPPonct($num,$_POST['code'],$_POST['mdo'],str_replace("'","\'",$_POST['titre']),$_POST['vis_a_vis'],$_POST['hono']);
		}
	 }
	 else{
		 $AO->ModifierProjet($_GET['codeAO'],str_replace("'","\'",$_POST['titre']),str_replace("'","\'",$_POST['intitule']),$_POST['mdo']);
		 
		@$AO->ModifierArrive($p['code_projet'],str_replace("'","\'",$_POST['titre']));
		@$AO->ModifierSortie($p['code_projet'],str_replace("'","\'",$_POST['titre']));
		@ $AO->ModifierCRV($p['code_projet'],str_replace("'","\'",$_POST['titre']));
		}
		 }
		 }
	 //Borderaux
	 
	@ $borderos->ModifierBorderaux(str_replace("'","\'",$_POST['article1']),str_replace("'","\'",$_POST['article2']),str_replace("'","\'",$_POST['article3']),str_replace("'","\'",$_POST['article4']),str_replace("'","\'",$_POST['article5']),str_replace("'","\'",$_POST['article6']),str_replace("'","\'",$_POST['article7']),str_replace("'","\'",$_POST['article8']),str_replace("'","\'",$_POST['article9']),str_replace("'","\'",$_POST['article10']),str_replace("'","\'",$_POST['article11']),str_replace("'","\'",$_POST['article12']),str_replace("'","\'",$_POST['article13']),str_replace("'","\'",$_POST['article14']),str_replace("'","\'",$_POST['article15']),str_replace("'","\'",$_POST['article16']),str_replace("'","\'",$_POST['article17']),str_replace("'","\'",$_POST['article18']),str_replace("'","\'",$_POST['article19']),str_replace("'","\'",$_POST['article20']),$_POST['code'],$res['id']);
	 @copy($_FILES['bordero']['tmp_name'],'Appel_offres/bordero/'.$_FILES['bordero']['name']);
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

	$codep=date('y').$initp;

	}
	else
	{
	$codep=($MCP+1);

	}

	 /*********Fin Génération de code projet***********/
	 if(isset($_POST['etat']))
	 {
	 if($det['etat']!=2)
	 {
	 if($_POST['etat']==2 and $_POST['type']!='ponctuel' and $_POST['type']!='PUBLIC PONCTUEL' )
	 {


	  @$projet->ajoutProjet($_POST['code'],str_replace("'","\'",$_POST['type']),$_POST['mdo'],str_replace("'","\'",$_POST['titre']),$_POST['date_limite'],$_POST['date_decharge'],
	 $_POST['cout'],$_POST['hono'],str_replace("'","\'",$_POST['intitule']),$_POST['pourcentage'],$_POST['rp_rd'],$codep,'0');
	 }
	 }
	 }
	//echo 'ok';

	echo "<script>document.location.href='sigma.php?AO_Affiche'</script>";
	 }
	 else
	 {
	 echo 'Erreur Modification';
	  
	 }
}//Fin de Modifier
/*****Duplication de l'offre******/
else if($_POST['ok']=='Dupliquer')
{

$dernierOffre=$AO->getOffre();
foreach($dernierOffre as $d);
$codeOP_Duplication=($d['code']+1);
/*****Duplication******/
	if($_POST['type']=='prive' or $_POST['type']=='ponctuel')
	{
	$type='PARTICULIER';
	$verifPartenaire=$partenaires->VerifExistePartenaire($_POST['mdo'],$type);
	}
	else if($_POST['type']=='marche_public' or $_POST['type']=='PUBLIC PONCTUEL')
	{
	$type='MDO';
	$verifPartenaire=$partenaires->VerifExistePartenaire($_POST['mdo'],$type);
	}
	//echo '<h1>'.count($verifPartenaire).'</h1>';
	if(@count($verifPartenaire)==0)
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
	 $limite=null;
	  $visavis=$_POST['vis_a_vis'];
	}
	else
	{
	 $limite=$_POST['date_limite'];
	   $visavis=null;
	}
	 $op=$codeOP_Duplication;
	 $etat=1;
	 if(@$AO->ajout(str_replace("'","\'", $op),str_replace("'","\'",$_POST['type']),$etat,str_replace("'","\'",$_POST['mdo']),str_replace("'","\'",$_POST['titre']),$limite,$_POST['date_decharge'],$_POST['cout'],$_POST['hono'],str_replace("'","\'",$_POST['intitule']),str_replace("'","\'",$_POST['pourcentage']),str_replace("'","\'",$_POST['nb_vis']),str_replace("'","\'",$_POST['rp_rd']),str_replace("'","\'",$lien),str_replace("'","\'",$_POST['observation']),$visavis))
	 {
	 @copy($_FILES['bordero']['tmp_name'],'Appel_offres/bordero/'.$_FILES['bordero']['name']);
	 //Ajout bordero
	 if(isset($_POST['bordero_type']))
	 {
	 if($_POST['bordero_type']=='consultation')
	 {
	 @$borderos->ajoutBordero(str_replace("'","\'",$_POST['mdo']),str_replace("'","\'",$codeOP_Duplication),str_replace("'","\'",$_POST['bordero_type']),str_replace("'","\'",$_POST['article1']),$_POST['prix1'],str_replace("'","\'",$_POST['article2']),$_POST['prix2'],str_replace("'","\'",$_POST['article3']),$_POST['prix3'],str_replace("'","\'",$_POST['article4']),$_POST['prix4'],str_replace("'","\'",$_POST['article5']),$_POST['prix5'],str_replace("'","\'",$_POST['article6']),$_POST['prix6'],str_replace("'","\'",$_POST['article7']),$_POST['prix7'],str_replace("'","\'",$_POST['article8']),str_replace("'","\'",$_POST['article9']),str_replace("'","\'",$_POST['article10']),str_replace("'","\'",$_POST['article11']),str_replace("'","\'",$_POST['article12']),str_replace("'","\'",$_POST['article13']),str_replace("'","\'",$_POST['article14']),str_replace("'","\'",$_POST['article15']),str_replace("'","\'",$_POST['article16']),str_replace("'","\'",$_POST['article17']),str_replace("'","\'",$_POST['article18']),str_replace("'","\'",$_POST['article19']),str_replace("'","\'",$_POST['article20']),$_POST['qte1'],$_POST['qte2'],$_POST['qte3'],$_POST['qte4'],$_POST['qte5'],$_POST['qte6'],$_POST['qte7'],$_POST['qte8'],$_POST['qte9'],$_POST['qte10'],$_POST['qte11'],$_POST['qte12'],$_POST['qte13'],$_POST['qte14'],$_POST['qte15'],$_POST['qte16'],$_POST['qte17'],$_POST['qte18'],$_POST['qte19'],$_POST['qte20']);
	}
	else if($_POST['bordero_type']=='expertise')
	 {
		
	 @$borderos->ajoutBordero(str_replace("'","\'",$_POST['mdo']),str_replace("'","\'",$codeOP_Duplication),str_replace("'","\'",$_POST['bordero_type']),str_replace("'","\'",$_POST['Expertise_article1']),$_POST['Expertise_prix1'],str_replace("'","\'",$_POST['Expertise_article2']),$_POST['Expertise_prix2'],str_replace("'","\'",$_POST['Expertise_article3']),$_POST['Expertise_prix3'],str_replace("'","\'",$_POST['Expertise_article4']),$_POST['Expertise_prix4'],str_replace("'","\'",$_POST['Expertise_article5']),$_POST['Expertise_prix5'],str_replace("'","\'",$_POST['Expertise_article6']),$_POST['Expertise_prix6'],str_replace("'","\'",$_POST['Expertise_article7']),$_POST['Expertise_prix7'],str_replace("'","\'",$_POST['article8']),str_replace("'","\'",$_POST['article9']),str_replace("'","\'",$_POST['article10']),str_replace("'","\'",$_POST['article11']),str_replace("'","\'",$_POST['article12']),str_replace("'","\'",$_POST['article13']),str_replace("'","\'",$_POST['article14']),str_replace("'","\'",$_POST['article15']),str_replace("'","\'",$_POST['article16']),str_replace("'","\'",$_POST['article17']),str_replace("'","\'",$_POST['article18']),str_replace("'","\'",$_POST['article19']),str_replace("'","\'",$_POST['article20']),$_POST['Expertise_qte1'],$_POST['Expertise_qte2'],$_POST['Expertise_qte3'],$_POST['Expertise_qte4'],$_POST['Expertise_qte5'],$_POST['Expertise_qte6'],$_POST['Expertise_qte7'],null,null,null,null,null,null,null,null,null,null,null,null,null);
	 
	 }
	 }
	 //echo 'OKO';
	 echo "<script>document.location.href='sigma.php?AO_Affiche'</script>";

	 }
	 else
	 {
	 echo 'Erreur Ajout';
	  
	 }



/****Fin duplication*****/
}/****Fin duplication de l'offre*******/
}



?>

<form method="post" enctype="multipart/form-data">
<div class="container" style="position:relative; top:-20px"  >
      <div class="card card-register mx-auto mt-5" >
        <div class="card-header">Modifier Appel Offre
		<input type="submit" style="width:250px; margin:auto;position:relative; top:-20px;" value="Modifier" name="ok" class="btn btn-primary btn-block"/>
		<input type="submit" style="width:250px; margin:auto;position:relative; top:-20px;float:right" value="Dupliquer" name="ok" class="btn btn-primary btn-block"/>
				<a href="Appel_offres/detailOffre.php?id=<?php echo $detA['id']?>" class="btn btn-primary btn-block" style="width:200px;position:relative; top:10px;">IMPRIMER</a>

		</div>
        <div class="card-body">
          <table width=100% >
		  <tr>
            <!---------*********************-->
			<td width=55%>
            <!---------*********************-->
   <table width=100% cellpadding=4  >
<tr>

</tr>
<tr>
<td ><label for="code">Code Offre: <b>OP</b></label></td>
<td >
<input type="text"   readonly id="codeAO" value="<?php echo $det['code']?>" style="padding:6px 0 6px 4px" name="code" class="form-control" >
</td>
<td>
				<label for="mdo" style="position:relative; top:0px">MDO</label>
                  </td>
          <td >
				   <?php
				   $design=null;
				   foreach($designation_partenaire as $designations){
					   if($det['mdo']==$designations['designation']){
						   $design=$designations['designation'];
					   }
						 } ?>
                   <input list="mdo"  id="mdobordero25" value="<?php echo $design?>" style="padding:6px 0 6px 4px" name="mdo" class="form-control" >
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
			  <?php if($_SESSION['user']!='utilisateur'){ ?>
			 <td width=15% rowspan=2>
			 
				
				
				<label for="etat" >Etat</label>
                  </td>
				 
                  <td rowspan=2>
				 <table  width=70%  >
				  <tr>
				  <?php 
				    
				  if($_GET['etatAO']!='2'){
				    
				  ?>
				  <td width=20>
				    <?php //echo $det['etat']?>
                    <input type="radio" <?php if($det['etat']=='0'){?>checked<?php } ?> name="etat" value="0" class="form-control" style="width:20px" > 
					 </td>
				  <td>
					<span style="font-size:18px">0</span>
					</td>
					<td width=20>
				    
                    <input type="radio"  <?php if($det['etat']=='1'){?> checked <?php  } ?>name="etat" value="1" class="form-control" style="width:20px" > 
					 </td>
				  <td>
					<span style="font-size:18px">1</span>
					</td>
					<?php } ?>
					<td width=20>
				    
                    <input type="radio" name="etat" <?php if($det['etat']=='2'){?>checked<?php } ?> value="2" class="form-control" style="width:20px" > 
					 </td>
				  <td>
					<span style="font-size:18px">2</span>
					</td>
					
					</tr>
					</table>
				
			  </td>
			  <?php } ?>
			 <td ><label for="type">Type</label> </td>
<td ><select id="types" name="type" class="form-control" style="width:200px"  >
                <?php if($_GET['typeAO']!='ponctuel' and $_GET['typeAO']!='prive'){?>
					<option value="marche_public" <?php if($detA['type']=='marche_public'){?> selected<?php } ?> >MARCHE PUB</option>
					<option value="PUBLIC PONCTUEL" <?php if($detA['type']=='PUBLIC PONCTUEL'){?> selected<?php } ?>>PUBLIC PONCTUEL</option>
					<?php } else {?>
					<option value="prive" <?php if($detA['type']=='prive'){?> selected<?php } ?>>PRIVE</option>
					<option value="ponctuel" <?php if($detA['type']=='ponctuel'){?> selected<?php } ?>>PONCTUEL</option>
					<?php } ?>
					</select>
             </td>
			  </tr>
			  <tr>
			  <td>
			  <!-------------------------------->
			  <tr>
     <td ><label for="titre">Titre</label></td>
                 <td colspan=3>
                  <textarea  id="titre"  name="titre" class="form-control" style="padding:0"><?php echo $det['titre']?></textarea>
				 
				
				  
					<input type="text"  value="<?php echo $det['intitule']?>" class="form-control" name="intitule" id="intitule">
              </td>
			  
			  </tr>
			  
			 
			  <!------------------------->
			  <?php if($_GET['typeAO']!='prive' and $_GET['typeAO']!='ponctuel')
			  {?>
			  <tr>
			  <td><label for="date_limite">Date limite</label></td>
			  <td><input type="date" value="<?php echo $det['date_limite']?>" id="date_limite" style="padding:6px 0 6px 4px" name="date_limite" class="form-control"  ></td>
			  </tr>
			  <?php } ?>
			  <!-------------------------------->
			  <tr>
			  <td>
			  <label for="date_decharge">
			    <?php if($_GET['typeAO']!='prive' and $_GET['typeAO']!='ponctuel')
			  {?>
			  Date Décharge
			  
			  <?php } else{?>
			  Date de l'offre
			  <?php } ?>
			  
			  </label>
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
				  <label for="bordero"><b>Bordero</b> </label>
					
						</td>
					  <td>  
					<?php echo $det['bordero']?>
						<input type="file" id="bordero" style="padding:6px 0 6px 4px" name="bordero" class="form-control"  >
				  </td>
				   
				 
				 
				  <?php if($_GET['typeAO']=='ponctuel' or $_GET['typeAO']=='prive' ){?>
				   <td width=50 align=center id="">
				  <label for="designer">Vis à Vis</label>
					  </td>
					  <td id="">
					 <?php
				   $vs=null;
				   foreach($partenairesVisAvi as $vss){
					   if($det['vis_a_vis']==$vss['designation']){
						   $vs=$vss['designation'];
					   }
						 } ?>
					<input list="vis_a_vis" id="mdoborderoVIS" value="<?php echo $vs; ?>" style="padding:6px 0 6px 4px" name="vis_a_vis" class="form-control" >
						 <datalist id="vis_a_vis">
						<?php  foreach($partenairesVisAvi as $vis){
						?>
						<option><?php echo $vis['designation'];?>
						
						<?php } ?>
						
						</datalist>
						</td>
						<?php } ?>
						
						
			  </tr>
			  <tr>
			  <td width=50 align=center>
				  <label for="observation">Total BRD</label>
					  </td>
					  <td>
						
						<input type="text" readonly id="BRDTot" value="<?php echo $totalBRDs?>"class="form-control" >
				  </td>
				   <?php if($_SESSION['user']=='Admin')
					{ if($det['Typeuser']=='utilisateur'){
						?>
				   <td width=50 align=center>
				  <label for="bordero" ><b>USER</b></label>
					
						</td>
					  <td>
					 <table width=90%>
					 <!--<tr>
					 <th >
						Utilisateur</th><td><input type="radio" chehed style="width:120px" name="user" value="utilisateur" ></td></tr>
						 --><tr>
					 <th>
						Admin</th><td><input type="radio" name="user" style="width:120px" value="null" ></td></tr>
						</table>
				  </td>
				   <?php } } ?>
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
<td valign=top width=55% >
<div id="res_bordero" style="height:500px;overflow:scroll">
     <table width=100% >
	<tr><td colspan=5>Bordero</td></tr>
	<tr><td>Type</td>
	<td>consultation</td><td><input type="radio" class="form-control" style="width:20px" name="bordero_type" id="consultation_bordero" <?php if($res['type']=='consultation'){ ?> checked <?php } ?>  value="consultation"></td>
	<td>Expertise</td><td><input type="radio" <?php if($res['type']=='expertise'){ ?> checked <?php } ?> class="form-control" style="width:20px" name="bordero_type" value="expertise" id="expertise_bordero"></td>
	</tr>
	</table>
	<?php if($res['type']=='expertise' )
	{?>
	<div id="expertise">
	<table>
	<tr><td>Art.1</td>
	<td  ><textarea style="width:300px; height:100px" name="article1" placeholder="Nom" class="form-control"><?php echo $res['article1']?></textarea></td>
	<td ><input  type="number" name="qte1" style="width:60px"  value="<?php echo $res['qte1']?>" class="form-control"  ></td>
		<td ><input  type="text" name="prix1" style="width:60px"  value="<?php echo $res['prix1']?>"  placeholder="Prix" class="form-control" ></td>
		
	</tr>
	<tr><td>Art.2</td>
	<td  ><textarea style="width:300px; height:100px" name="article2" placeholder="Nom" class="form-control" ><?php echo $res['article2']?></textarea></td>
	<td ><input  type="number" style="width:60px" name="qte2"  value="<?php echo $res['qte2']?>" class="form-control"  ></td>
		<td  ><input type="text" style="width:60px" value="<?php echo $res['prix2']?>" name="prix2" placeholder="Prix" class="form-control" ></td>
			</tr>
	<tr><td>Art.3</td>
	<td  ><textarea style="width:300px; height:100px"  name="article3" placeholder="Nom" class="form-control" ><?php echo $res['article3']?></textarea></td>
	<td ><input  type="number" style="width:60px" name="qte3"  value="<?php echo $res['qte3']?>" class="form-control"  ></td>
		<td  ><input type="text" style="width:60px" value="<?php echo $res['prix3']?>" name="prix3" placeholder="Prix" class="form-control" ></td>
		
	</tr>
	<tr><td>Art.4</td>
	<td  ><textarea style="width:300px; height:100px"  name="article4" placeholder="Nom" class="form-control" ><?php echo $res['article4']?></textarea></td>
	<td ><input  type="number" style="width:60px" name="qte4"  value="<?php echo $res['qte4']?>" class="form-control"  ></td>
		<td  ><input type="text" style="width:60px" value="<?php echo $res['prix4']?>" name="prix4" placeholder="Prix" class="form-control" ></td>
		
	</tr>
	<tr><td>Art.5</td>
	<td  ><textarea style="width:300px; height:100px"  name="article5" placeholder="Nom" class="form-control" ><?php echo $res['article5']?></textarea></td>
	<td ><input  type="number" style="width:60px" name="qte5"  value="<?php echo $res['qte5']?>" class="form-control"  ></td>
		<td  ><input type="text" style="width:60px" value="<?php echo $res['prix5']?>" name="prix5" placeholder="Prix" class="form-control" ></td>
		
	</tr>
	<tr><td>Art.6</td>
	<td  ><textarea style="width:300px; height:100px"  name="article6" placeholder="Nom" class="form-control" ><?php echo $res['article6']?></textarea></td>
	<td ><input  type="number" style="width:60px" name="qte6"  value="<?php echo $res['qte6']?>" class="form-control"  ></td>
		<td  ><input type="text" style="width:60px" value="<?php echo $res['prix6']?>"  name="prix6" placeholder="Prix" class="form-control" ></td>
		
	</tr>
	
	<tr><td>Art.7</td>
	<td  ><textarea style="width:300px; height:100px" name="article7" placeholder="Nom" class="form-control" ><?php echo $res['article7']?></textarea></td>
	<td ><input  type="number" style="width:60px" name="qte7"  value="<?php echo $res['qte7']?>" class="form-control"  ></td>
		<td  ><input type="text" style="width:60px" value="<?php echo $res['prix7']?>" name="prix7" placeholder="Prix" class="form-control" ></td>
		
	</tr>
	</table>
	</div><!--Fin #expertise-->
	<?php } ?>
	<?php if($res['type']=='consultation' )
	{?>
	<div id="consultation">
	<table>
	<tr><td>Art.1</td>
	<td  ><textarea style="width:300px; height:100px" name="article1" placeholder="Nom" class="form-control"><?php echo $res['article1']?></textarea></td>
	<td ><input  type="number" name="qte1" style="width:60px"  value="<?php echo $res['qte1']?>" class="form-control"  ></td>
		<td ><input  type="text" name="prix1" style="width:60px"  value="<?php echo $res['prix1']?>"  placeholder="Prix" class="form-control" ></td>
		
	</tr>
	<tr><td>Art.2</td>
	<td  ><textarea style="width:300px; height:100px" name="article2" placeholder="Nom" class="form-control" ><?php echo $res['article2']?></textarea></td>
	<td ><input  type="number" style="width:60px" name="qte2"  value="<?php echo $res['qte2']?>" class="form-control"  ></td>
		<td  ><input type="text" style="width:60px" value="<?php echo $res['prix2']?>" name="prix2" placeholder="Prix" class="form-control" ></td>
		
	</tr>
	<tr><td>Art.3</td>
	<td  ><textarea style="width:300px; height:100px"  name="article3" placeholder="Nom" class="form-control" ><?php echo $res['article3']?></textarea></td>
	<td ><input  type="number" style="width:60px" name="qte3"  value="<?php echo $res['qte3']?>" class="form-control"  ></td>
		<td  ><input type="text" style="width:60px" value="<?php echo $res['prix3']?>" name="prix3" placeholder="Prix" class="form-control" ></td>
		
	</tr>
	<tr><td>Art.4</td>
	<td  ><textarea style="width:300px; height:100px"  name="article4" placeholder="Nom" class="form-control" ><?php echo $res['article4']?></textarea></td>
	<td ><input  type="number" style="width:60px" name="qte4"  value="<?php echo $res['qte4']?>" class="form-control"  ></td>
		<td  ><input type="text" style="width:60px" value="<?php echo $res['prix4']?>" name="prix4" placeholder="Prix" class="form-control" ></td>
		
	</tr>
	<tr><td>Art.5</td>
	<td  ><textarea style="width:300px; height:100px"  name="article5" placeholder="Nom" class="form-control" ><?php echo $res['article5']?></textarea></td>
	<td ><input  type="number" style="width:60px" name="qte5"  value="<?php echo $res['qte5']?>" class="form-control"  ></td>
		<td  ><input type="text" style="width:60px" value="<?php echo $res['prix5']?>" name="prix5" placeholder="Prix" class="form-control" ></td>
		
	</tr>
	<tr><td>Art.6</td>
	<td  ><textarea style="width:300px; height:100px"  name="article6" placeholder="Nom" class="form-control" ><?php echo $res['article6']?></textarea></td>
	<td ><input  type="number" style="width:60px" name="qte6"  value="<?php echo $res['qte6']?>" class="form-control"  ></td>
		<td  ><input type="text" style="width:60px" value="<?php echo $res['prix6']?>"  name="prix6" placeholder="Prix" class="form-control" ></td>
		
	</tr>
	
	<tr><td>Art.7</td>
	<td  ><textarea style="width:300px; height:100px" name="article7" placeholder="Nom" class="form-control" ><?php echo $res['article7']?></textarea></td>
	<td ><input  type="number" style="width:60px" name="qte7"  value="<?php echo $res['qte7']?>" class="form-control"  ></td>
		<td  ><input type="text" style="width:60px" value="<?php echo $res['prix7']?>" name="prix7" placeholder="Prix" class="form-control" ></td>
		
	</tr>
	<?php if($_GET['typeAO']!='ponctuel' and $_GET['typeAO']!='prive' )
	{?>
	<tr><td>Art.8</td>
	<td  ><textarea style="width:300px; height:100px"  name="article8" placeholder="Nom" class="form-control" ><?php echo $res['article8']?></textarea></td>
	<td ><input  type="number" style="width:60px" name="qte8"  value="<?php echo $res['qte8']?>" class="form-control"  ></td>
		<td  ><input type="text" style="width:60px" value="<?php echo $res['prix8']?>" name="prix8" placeholder="Prix" class="form-control" ></td>
		
	</tr>
	<tr><td>Art.9</td>
	<td  ><textarea style="width:300px; height:100px"   name="article9" placeholder="Nom" class="form-control" ><?php echo $res['article9']?></textarea></td>
	<td ><input  type="number" style="width:60px" name="qte9"  value="<?php echo $res['qte9']?>" class="form-control"  ></td>
		<td  ><input type="text" style="width:60px" value="<?php echo $res['prix9']?>" name="prix9" placeholder="Prix" class="form-control" ></td>
		
	</tr>
	<tr><td>Art.10</td>
	<td  ><textarea style="width:300px; height:100px"  name="article10" placeholder="Nom" class="form-control" ><?php echo $res['article10']?></textarea></td>
	<td ><input  type="number" style="width:60px" name="qte10"  value="<?php echo $res['qte10']?>" class="form-control"  ></td>
		<td  ><input type="text" style="width:60px" value="<?php echo $res['prix10']?>" name="prix10" placeholder="Prix" class="form-control" ></td>
		
	</tr>
	
	<tr><td>Art.11</td>
	<td  ><textarea style="width:300px; height:100px"  name="article11" placeholder="Nom" class="form-control" ><?php echo $res['article11']?></textarea></td>
	<td ><input  type="number" style="width:60px" name="qte11"  value="<?php echo $res['qte11']?>" class="form-control"  ></td>
		<td  ><input type="text" style="width:60px" value="<?php echo $res['prix11']?>" name="prix11" placeholder="Prix" class="form-control" ></td>
		
	</tr>
	<tr><td>Art.12</td>
	<td  ><textarea style="width:300px; height:100px"  name="article12" placeholder="Nom" class="form-control" ><?php echo $res['article12']?></textarea></td>
	<td ><input  type="number" style="width:60px" name="qte12"  value="<?php echo $res['qte12']?>" class="form-control"  ></td>
		<td  ><input type="text" style="width:60px" value="<?php echo $res['prix12']?>" name="prix12" placeholder="Prix" class="form-control" ></td>
		
	</tr>
	<tr><td>Art.13</td>
	<td  ><textarea style="width:300px; height:100px" value="<?php echo $res['article13']?>" name="article13" placeholder="Nom" class="form-control" ><?php echo $res['article13']?></textarea></td>
	<td ><input  type="number" style="width:60px" name="qte13"  value="<?php echo $res['qte13']?>" class="form-control"  ></td>
		<td  ><input type="text" style="width:60px" value="<?php echo $res['prix13']?>" name="prix13" placeholder="Prix" class="form-control" ></td>
		
	</tr>
	<tr><td>Art.14</td>
	<td  ><textarea style="width:300px; height:100px" name="article14" placeholder="Nom" class="form-control" ><?php echo $res['article14']?></textarea></td>
	<td ><input  type="number" style="width:60px" name="qte14"  value="<?php echo $res['qte14']?>" class="form-control"  ></td>
		<td  ><input type="text" style="width:60px" value="<?php echo $res['prix14']?>"  name="prix14" placeholder="Prix" class="form-control" ></td>
		
	</tr>
	
	<tr><td>Art.15</td>
	<td  ><textarea style="width:300px; height:100px" name="article15" placeholder="Nom" class="form-control" ><?php echo $res['article15']?></textarea></td>
	<td ><input  type="number" style="width:60px" name="qte15"  value="<?php echo $res['qte15']?>" class="form-control"  ></td>
		<td  ><input type="text" style="width:60px" value="<?php echo $res['prix15']?>"  name="prix15" placeholder="Prix" class="form-control" ></td>
		
	</tr>
	<tr><td>Art.16</td>
	<td  ><textarea style="width:300px; height:100px"  name="article16" placeholder="Nom" class="form-control" ><?php echo $res['article16']?></textarea></td>
	<td ><input  type="number" style="width:60px" name="qte16"  value="<?php echo $res['qte16']?>" class="form-control"  ></td>
		<td  ><input type="text" style="width:60px" value="<?php echo $res['prix16']?>" name="prix16" placeholder="Prix" class="form-control" ></td>
		
	</tr>
	<tr><td>Art.17</td>
	<td  ><textarea style="width:300px; height:100px"  name="article17" placeholder="Nom" class="form-control" ><?php echo $res['article17']?></textarea></td>
	<td ><input  type="number" style="width:60px" name="qte17"  value="<?php echo $res['qte17']?>" class="form-control"  ></td>
		<td  ><input type="text" style="width:60px" value="<?php echo $res['prix17']?>" name="prix17" placeholder="Prix" class="form-control" ></td>
		
	</tr>
	<tr><td>Art.18</td>
	<td  ><textarea style="width:300px; height:100px" name="article18" placeholder="Nom" class="form-control" ><?php echo $res['article18']?></textarea></td>
	<td ><input  type="number" name="qte18"  value="<?php echo $res['qte18']?>" class="form-control"  ></td>
		<td  ><input type="text" value="<?php echo $res['prix18']?>" name="prix18" placeholder="Prix" class="form-control" ></td>
		
	</tr>
	
	<tr><td>Art.19</td>
	<td  ><textarea style="width:300px; height:100px"   name="article19" placeholder="Nom" class="form-control" ><?php echo $res['article19']?></textarea></td>
	<td ><input  type="number" style="width:60px" name="qte19"  value="<?php echo $res['qte19']?>" class="form-control"  ></td>
		<td  ><input type="text" style="width:60px" value="<?php echo $res['prix19']?>" name="prix19" placeholder="Prix" class="form-control" ></td>
		
	</tr>
	<tr><td>Art.20</td>
	<td  ><textarea style="width:300px; height:100px"  name="article20" placeholder="Nom" class="form-control" ><?php echo $res['article20']?></textarea></td>
	<td ><input  type="number" style="width:60px" name="qte20"  value="<?php echo $res['qte20']?>" class="form-control"  ></td>
		<td  ><input type="text" style="width:60px" value="<?php echo $res['prix20']?>" name="prix20" placeholder="Prix" class="form-control" ></td>
		
	</tr>
	<?php } ?>
	</table>
	</div> 
	<?php } ?>
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