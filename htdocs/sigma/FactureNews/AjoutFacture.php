<?php
$nbsprojet=$projet->getProjets();
$factures=$facture->getFacture();
$nbs=$AO->getOffre();
$nbsFacture=$facture->getdernierFacture();
$designation_partenaire=$partenaires->getPartenairesMDO();
if(count($nbsFacture)==0)
{
$numfacture=1;
}
else
{
 foreach($nbsFacture as $fct);
 @$numfacture=($fct['numFacture']+1).'/'.date('Y');
}

//Ajout Facture
if(isset($_POST['ok']))
 {
$nums=explode("/",$_POST['numfacture']);$num=$nums[0];$annee=$nums[1];	
@$verifFacture=count($facture->VerifFacturesExistes($num,$annee));
if($verifFacture==0)
{
if($facture->AjoutFacture(str_replace("'","\'",$_POST['titre']),str_replace("'","\'",$_POST['intitule'])) )
{
@copy($_FILES['facture']['tmp_name'],'Facture/Lien/'.$_FILES['facture']['name']);
echo "<script>document.location.href='sigma.php?AfficherFacturation'</script>";
}
else 
echo '<h1>Erreur</h1>';
}
else{
echo '<h1>Vérifier N° Facture</h1>';	
}
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
$date_decharge=date($date_dechargeJ.'/'.'m/Y');
?>
<form method="post" enctype="multipart/form-data" >
<div class="container" style="position:relative; top:-60px"  >
      <div class="card card-register mx-auto mt-5" >
        <div class="card-header">Ajouter <?php if(!isset($_GET['P'])){?> Facture<?php } else { ?> Projet<?php } ?>
		  <input type="submit" style="width:250px; margin:auto;position:relative; top:-30px;margin-bottom:-30px" id="ok" value="Ajouter" name="ok" class="btn btn-primary btn-block"/>
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
					  <input  style="padding:6px 0 6px 4px" value="<?php echo $numfacture ?>"   name="numfacture"  class="form-control" >
						 
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
					  <input  style="padding:6px 0 6px 4px;width:200px" value="<?php echo $_GET['mdo']?>" readonly name="mdo" class="form-control" >
						 
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
?>
<td valign=top width=70%  >
    
    <div id="res_bordero" style="height:500px;overflow:scroll;position:relative;left:-180px;width:400px">
	<table border=1   class="table table-bordered" id="factureCreation"  cellspacing="0" >
			
			<?php 
			
				$lnbrds=count($brds);
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
				<th><span style="font-size:12px">Qte Brd</span></th>
				<th><span style="font-size:12px">Prix</span></th>
				<th><span style="font-size:12px">Qte Facture</span></th>
				</tr>
			<tr>
			
			<?php 
			if($cle['prix1']!=null)
			{
			?>
			<tr>
			
			<td style="margin:0;padding:0;font-size:12px;height:50px" align=center>
			<span style="position:relative;top:10px;">Art.1</span></td>
			<td style="margin:0;padding:0;font-size:12px;height:80px" valign=top>
			<textarea type="text" name="article1" style="border:none;float:left;height:50px;width:100%;top:-10px;padding-top:10px;height:100px" readonly><?php echo $cle['article1']?>
			</textarea>
			</td>
			<td style="font-size:12px;padding:10px 0 0 0;" align=center>
			<input style="border:none;width:40px;" readonly type="text" value="<?php echo $cle['qte1']?>"></td>
			<td style="font-size:12px;padding:10px 0 0 0;" align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix1" 
			value="<?php echo $cle['prix1']?>"></td>
			<td style="margin:0;padding:10px 0 0 0;height:50px;">
			<input type="number" name="qte1" value="0" style="width:40px;float:left;margin-right:5px">
			 </td>
			</tr> 
			
			<?php
                     }
					 
					 if($cle['prix2']!=null)
			{
			?>
			<tr>
			
			<td style="margin:0;padding:0;font-size:12px;height:50px" align=center>
			<span style="position:relative;top:10px;">Art.2</span></td>
			<td style="margin:0;padding:0;font-size:12px;height:80px" valign=top>
			<textarea type="text" name="article2" style="border:none;float:left;height:50px;width:100%;top:-10px;padding-top:10px;" readonly><?php echo $cle['article2']?>
			</textarea>
			</td>
			
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text" value="<?php echo $cle['qte2']?>"></td>
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix2" 
			value="<?php echo $cle['prix2']?>"></td>
			<td style="margin:0;padding:10px 0 0 0;height:50px">
			<input type="number" name="qte2" value="0" style="width:40px;float:left;margin-right:5px">
			</td>
			</tr> 
			
			<?php
                     }
					 
					  if($cle['prix3']!=null)
			{
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
			value="<?php echo $cle['qte3']?>"></td>
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix3" 
			value="<?php echo $cle['prix3']?>"></td>
			<td style="margin:0;padding:10px 0 0 0;height:50px">
			<input type="number" name="qte3" value="0" style="width:40px;float:left;margin-right:5px">
			</td>
			</tr> 
			
			<?php
                     }
					  if($cle['prix4']!=null)
			{
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
			value="<?php echo $cle['qte4']?>"></td>
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix4" 
			value="<?php echo $cle['prix4']?>"></td>
			<td style="margin:0;padding:10px 0 0 0;height:50px">
			<input type="number" name="qte4" value="0" style="width:40px;float:left;margin-right:5px">
			</td>
			</tr> 
			
			<?php
                     }
					  if($cle['prix5']!=null)
			{
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
			value="<?php echo $cle['qte5']?>"></td>
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix5" 
			value="<?php echo $cle['prix5']?>"></td>
			<td style="margin:0;padding:10px 0 0 0;height:50px">
			<input type="number" name="qte5" value="0" style="width:40px;float:left;margin-right:5px">
			</td>
			</tr> 
			
			<?php
                     }
					  if($cle['prix6']!=null)
			{
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
			value="<?php echo $cle['qte6']?>"></td>
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix6" 
			value="<?php echo $cle['prix6']?>"></td>
			<td style="margin:0;padding:10px 0 0 0;height:50px">
			<input type="number" name="qte6" value="0" style="width:40px;float:left;margin-right:5px">
			</td>
			</tr> 
			<?php
                     }
					  if($cle['prix7']!=null)
			{
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
			value="<?php echo $cle['qte7']?>"></td>
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix7" 
			value="<?php echo $cle['prix7']?>"></td>
			<td style="margin:0;padding:10px 0 0 0;height:50px">
			<input type="number" name="qte7" value="0" style="width:40px;float:left;margin-right:5px">
			</td>
			</tr> 
			
			<?php
                     }
					  if($cle['prix8']!=null){?>
					 <tr>
			
			<td style="margin:0;padding:0;font-size:12px;height:50px" align=center>
			<span style="position:relative;top:10px;">Art.8</span></td>
			<td style="margin:0;padding:0;font-size:12px;height:80px" valign=top>
			<textarea type="text" name="article8" style="border:none;float:left;height:50px;width:100%;top:-10px;padding-top:10px;" readonly><?php echo $cle['article8']?>
			</textarea>
			</td>
			
			
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text" 
			value="<?php echo $cle['qte8']?>"></td>
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix8" 
			value="<?php echo $cle['prix8']?>"></td>
			<td style="margin:0;padding:10px 0 0 0;height:50px">
			<input type="number" name="qte8" value="0" style="width:40px;float:left;margin-right:5px">
			</td>
			</tr> 
					  
					  <?php
                     }
					 if($cle['prix9']!=null){?>
					 
				<tr>
			
			<td style="margin:0;padding:0;font-size:12px;height:50px" align=center>
			<span style="position:relative;top:10px;">Art.9</span></td>
			<td style="margin:0;padding:0;font-size:12px;height:80px" valign=top>
			<textarea type="text" name="article9" style="border:none;float:left;height:50px;width:100%;top:-10px;padding-top:10px;" readonly><?php echo $cle['article9']?>
			</textarea>
			</td>
			
			
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text"  
			value="<?php echo $cle['qte9']?>"></td>
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix9" 
			value="<?php echo $cle['prix9']?>"></td>
			<td style="margin:0;padding:10px 0 0 0;height:50px">
			<input type="number" name="qte9" value="0" style="width:40px;float:left;margin-right:5px">
			</td>
			</tr> 
					 
					 <?php
                     }
					 else {
					 ?>
					 <input type="hidden" name="qte9" value="0">
					 <?php
					 }
					 if($cle['prix10']!=null){?>
					 
					<tr>
			
			<td style="margin:0;padding:0;font-size:12px;height:50px" align=center>
			<span style="position:relative;top:10px;">Art.10</span></td>
			<td style="margin:0;padding:0;font-size:12px;height:80px" valign=top>
			<textarea type="text" name="article10" style="border:none;float:left;height:50px;width:100%;top:-10px;padding-top:10px;" readonly><?php echo $cle['article10']?>
			</textarea>
			</td>
			
			
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text"  
			value="<?php echo $cle['qte10']?>"></td>
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix10" 
			value="<?php echo $cle['prix10']?>"></td>
			<td style="margin:0;padding:10px 0 0 0;height:50px">
			<input type="number" name="qte10" value="0" style="width:40px;float:left;margin-right:5px">
			</td>
			</tr> 
					 
					 <?php
                     }
					  else {
					 ?>
					 <input type="hidden" name="qte10" value="0">
					 <?php
					 }
					 if($cle['prix11']!=null){?>
                 				 
					<tr>
			
			<td style="margin:0;padding:0;font-size:12px;height:50px" align=center>
			<span style="position:relative;top:10px;">Art.11</span></td>
			<td style="margin:0;padding:0;font-size:12px;height:50px" valign=top>
			<textarea type="text" name="article11" style="border:none;float:left;height:50px;width:100%;top:-10px;padding-top:10px;" readonly><?php echo $cle['article11']?>
			</textarea>
			</td>
			
			
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text"  
			value="<?php echo $cle['qte11']?>"></td>
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix11" 
			value="<?php echo $cle['prix11']?>"></td>
			<td style="margin:0;padding:10px 0 0 0;height:50px">
			<input type="number" name="qte11" value="0" style="width:40px;float:left;margin-right:5px">
			</td>
			</tr>

					 <?php
                     }
					  else {
					 ?>
					 <input type="hidden" name="qte11" value="0">
					 <?php
					 }
					 if($cle['prix12']!=null){?>
										 
					<tr>
			
			<td style="margin:0;padding:0;font-size:12px;height:50px" align=center>
			<span style="position:relative;top:10px;">Art.12</span></td>
			<td style="margin:0;padding:0;font-size:12px;height:50px" valign=top>
			<textarea type="text" name="article12" style="border:none;float:left;height:50px;width:100%;top:-10px;padding-top:10px;" readonly><?php echo $cle['article12']?>
			</textarea>
			</td>
			
			
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text"  
			value="<?php echo $cle['qte12']?>"></td>
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix12" 
			value="<?php echo $cle['prix12']?>"></td>
			<td style="margin:0;padding:10px 0 0 0;height:50px">
			<input type="number" name="qte12" value="0" style="width:40px;float:left;margin-right:5px">
			</td>
			</tr>

					 <?php
                     }
					  else {
					 ?>
					 <input type="hidden" name="qte12" value="0">
					 <?php
					 }
					 if($cle['prix13']!=null){?>
					 
									 
					<tr>
			
			<td style="margin:0;padding:0;font-size:12px;height:50px" align=center>
			<span style="position:relative;top:10px;">Art.13</span></td>
			<td style="margin:0;padding:0;font-size:12px;height:50px" valign=top>
			<textarea type="text" name="article13" style="border:none;float:left;height:50px;width:100%;top:-10px;padding-top:10px;" readonly><?php echo $cle['article13']?>
			</textarea>
			</td>
			
			
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text"  
			value="<?php echo $cle['qte13']?>"></td>
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix13" 
			value="<?php echo $cle['prix13']?>"></td>
			<td style="margin:0;padding:10px 0 0 0;height:50px">
			<input type="number" name="qte13" value="0" style="width:40px;float:left;margin-right:5px">
			</td>
			</tr>
					 
					 <?php
                     }
					  else {
					 ?>
					 <input type="hidden" name="qte13" value="0">
					 <?php
					 }
					 if($cle['prix14']!=null){?>
					 
					 				 
					<tr>
			
			<td style="margin:0;padding:0;font-size:12px;height:50px" align=center>
			<span style="position:relative;top:10px;">Art.14</span></td>
			<td style="margin:0;padding:0;font-size:12px;height:50px" valign=top>
			<textarea type="text" name="article14" style="border:none;float:left;height:50px;width:100%;top:-10px;padding-top:10px;" readonly><?php echo $cle['article14']?>
			</textarea>
			</td>
			
			
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text"  
			value="<?php echo $cle['qte14']?>"></td>
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix14" 
			value="<?php echo $cle['prix14']?>"></td>
			<td style="margin:0;padding:10px 0 0 0;height:50px">
			<input type="number" name="qte14" value="0" style="width:40px;float:left;margin-right:5px">
			</td>
			</tr>
					 
					 <?php
                     }
					  else {
					 ?>
					 <input type="hidden" name="qte14" value="0">
					 <?php
					 }
					 if($cle['prix15']!=null){?>
					 
					 				 
					<tr>
			
			<td style="margin:0;padding:0;font-size:12px;height:50px" align=center>
			<span style="position:relative;top:10px;">Art.15</span></td>
			<td style="margin:0;padding:0;font-size:12px;height:50px" valign=top>
			<textarea type="text" name="article15" style="border:none;float:left;height:50px;width:100%;top:-10px;padding-top:10px;" readonly><?php echo $cle['article15']?>
			</textarea>
			</td>
			
			
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text"  
			value="<?php echo $cle['qte15']?>"></td>
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix15" 
			value="<?php echo $cle['prix15']?>"></td>
			<td style="margin:0;padding:10px 0 0 0;height:50px">
			<input type="number" name="qte15" value="0" style="width:40px;float:left;margin-right:5px">
			</td>
			</tr>
					 <?php
                     }
					  else {
					 ?>
					 <input type="hidden" name="qte15" value="0">
					 <?php
					 }
					 if($cle['prix16']!=null){?>
					 
					 				 
					<tr>
			
			<td style="margin:0;padding:0;font-size:12px;height:50px" align=center>
			<span style="position:relative;top:10px;">Art.16</span></td>
			<td style="margin:0;padding:0;font-size:12px;height:50px" valign=top>
			<textarea type="text" name="article16" style="border:none;float:left;height:50px;width:100%;top:-10px;padding-top:10px;" readonly><?php echo $cle['article16']?>
			</textarea>
			</td>
			
			
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text"  
			value="<?php echo $cle['qte16']?>"></td>
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix16" 
			value="<?php echo $cle['prix16']?>"></td>
			<td style="margin:0;padding:10px 0 0 0;height:50px">
			<input type="number" name="qte16" value="0" style="width:40px;float:left;margin-right:5px">
			</td>
			</tr>
					 <?php
                     }
					  else {
					 ?>
					 <input type="hidden" name="qte16" value="0">
					 <?php
					 }
			if($cle['prix17']!=null){?>

							 
					<tr>
			
			<td style="margin:0;padding:0;font-size:12px;height:50px" align=center>
			<span style="position:relative;top:10px;">Art.17</span></td>
			<td style="margin:0;padding:0;font-size:12px;height:50px" valign=top>
			<textarea type="text" name="article10" style="border:none;float:left;height:50px;width:100%;top:-10px;padding-top:10px;" readonly><?php echo $cle['article17']?>
			</textarea>
			</td>
			
			
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text"  
			value="<?php echo $cle['qte17']?>"></td>
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix17" 
			value="<?php echo $cle['prix17']?>"></td>
			<td style="margin:0;padding:10px 0 0 0;height:50px">
			<input type="number" name="qte17" value="0" style="width:40px;float:left;margin-right:5px">
			</td>
			</tr>
			<?php
                     }
					  else {
					 ?>
					 <input type="hidden" name="qte17" value="0">
					 <?php
					 }
		if($cle['prix18']!=null){?>
				
								 
					<tr>
			
			<td style="margin:0;padding:0;font-size:12px;height:50px" align=center>
			<span style="position:relative;top:10px;">Art.18</span></td>
			<td style="margin:0;padding:0;font-size:12px;height:50px" valign=top>
			<textarea type="text" name="article18" style="border:none;float:left;height:50px;width:100%;top:-10px;padding-top:10px;" readonly><?php echo $cle['article18']?>
			</textarea>
			</td>
			
			
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text"  
			value="<?php echo $cle['qte18']?>"></td>
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix18" 
			value="<?php echo $cle['prix18']?>"></td>
			<td style="margin:0;padding:10px 0 0 0;height:50px">
			<input type="number" name="qte18" value="0" style="width:40px;float:left;margin-right:5px">
			</td>
			</tr>

		<?php
                     }
					  else {
					 ?>
					 <input type="hidden" name="qte18" value="0">
					 <?php
					 }
		if($cle['prix19']!=null){?>
		
						 
					<tr>
			
			<td style="margin:0;padding:0;font-size:12px;height:50px" align=center>
			<span style="position:relative;top:10px;">Art.19</span></td>
			<td style="margin:0;padding:0;font-size:12px;height:50px" valign=top>
			<textarea type="text" name="article19" style="border:none;float:left;height:50px;width:100%;top:-10px;padding-top:10px;" readonly><?php echo $cle['article19']?>
			</textarea>
			</td>
			
			
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text"  
			value="<?php echo $cle['qte19']?>"></td>
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix19" 
			value="<?php echo $cle['prix19']?>"></td>
			<td style="margin:0;padding:10px 0 0 0;height:50px">
			<input type="number" name="qte19" value="0" style="width:40px;float:left;margin-right:5px">
			</td>
			</tr>
		
		
		<?php
                     }
					  else {
					 ?>
					 <input type="hidden" name="qte19" value="0">
					 <?php
					 }
		if($cle['prix20']!=null){?>
		
						 
					<tr>
			
			<td style="margin:0;padding:0;font-size:12px;height:50px" align=center>
			<span style="position:relative;top:10px;">Art.20</span></td>
			<td style="margin:0;padding:0;font-size:12px;height:50px" valign=top>
			<textarea type="text" name="article20" style="border:none;float:left;height:50px;width:100%;top:-10px;padding-top:10px;" readonly><?php echo $cle['article20']?>
			</textarea>
			</td>
			
			
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text"  
			value="<?php echo $cle['qte20']?>"></td>
			<td style="font-size:12px;padding:10px 0 0 0;width:40px;height:50px" align=center>
			<input style="border:none;width:40px;" readonly type="text" name="prix20" 
			value="<?php echo $cle['prix20']?>"></td>
			<td style="margin:0;padding:10px 0 0 0;height:50px">
			<input type="number" name="qte20" value="0" style="width:40px;float:left;margin-right:5px">
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