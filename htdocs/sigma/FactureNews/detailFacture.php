

<?php
session_start();
include '../classes/Autres_Facture.class.php';

	$facture=new AutresFactures();
	
	$detail=$facture->getdetailFacture($_GET['id']);
	
foreach($detail as $det);
$Client=$facture->getClientMdoFacture($det['mdo']);
foreach($Client as $clt);
//Verification Type AO
$aoP=null;
if($_GET['AO']=='Ponct')
{
	$aoP='ponctuel';
}
else {
	// verification de type offre
$VerifTypeAO=$facture->VerifTypeAO($_GET['AO']);
foreach($VerifTypeAO as $tP);
//echo '<h1>Type : '.$tP['type'].'</h1>';
if($tP['type']=='ponctuel')
{
	$aoP=$tP['type'];
}

	
}

//Verification Type AO
$verifAO=$facture->VerifAO($aoP);
if(@count($verifAO)>0)
{
foreach($verifAO as $VF);

}
//Fin Verification
$factureDetail=$_GET['Facture'].'/'.$_GET['Annee'];
	$detailBrd=$facture->getdetailBrdFacture($_GET['AO'],$factureDetail);
	if(@count($detailBrd)>0)
{
	foreach($detailBrd as $detBRD);
	}
	//MDO Facture
		$MDOS=$facture->getMDOFacture($det['mdo']);
		if(@count($MDOS)>0)
		{
	foreach($MDOS as $mdoF);
	$client=$mdoF['client'];
	$adresse=$mdoF['Adresse'];
	$fax=$mdoF['fax'];
	}
	else{
	 $client="";
	 $adresse="";
	  $fax="";
	}
//BC Facture
		$BCs=$facture->getBCFacture($det['codeProjet']);
		if(@count($BCs)>0)
		{
		
	foreach($BCs as $bc);
	
	}
	else 
	{
	  $bc=null;
	}
	

?>
<table width=100% align=center >

<tr style="height:20px"><td valign=top style="border:solid 3px black"><img src="../images/logo.png" width=50 height=60 onclick="window.print()"></td>
<th valign=top colspan=2 style="border:solid 3px black;"><h2 style="padding-top:10px;font-size:18px">" SIGMA INSPECTEC " BUREAU D'INSPECTION TECHNIQUE CONTROLE ET EXPERTISE</h2></th>
</tr>

<tr><td></td><td></td><td>Tunis Le : <?php echo $det['envoye']?></td></tr>
<tr><td colspan=2 >Titre Projet: <?php echo $det['titre']?></td>

<th style="border:2px solid black;font-size:15px" width="250" rowspan=2>
<?php echo $clt['client'];?></th></tr>
<tr><td colspan=2>Bon de commande:  <?php echo $bc['BC']?> du <?php echo $bc['date_B_C']?></td>

<tr><td></td><th style="font-size:20px"><u>Facture N° : <?php echo $det['numFacture'].'/'.$_GET['Annee']?></u></th>
<td style="border:2px solid black;"><?php echo $adresse?></td></tr>
<tr><td></td><th   style="font-size:15px">M.F: 1817737 H/A/M/000</th>
<th style="border:2px solid black;font-size:15px">M.F:  <input type="text" > </th></tr>
<tr><td></td><th   style="font-size:15px">R.I.B : 32038788116175255154 </th><td></td></tr>
<tr><td> Messieurs,</td><th ></th><td></td></tr>
<tr><td colspan=3>Dans le cadre de notre convention nous avons l’honneur de vous adresser la présente facture pour paiement à la réception, sauf objection de votre part.</td></tr>


<tr>
<td colspan=4>
<table border=1 width=80% align=center>
<tr>
<th>N°</th><th>Désignantion</th><th>Qté</th><th >Prix.U</th><th>Prix.THTVA</th></tr>
<?php 
$tot=0;

if($detBRD['prix1']!=0 and $detBRD['prix1']!= ""){
	if($det['qte1']!=0){
	?>
<tr >
<td>1</td>
<td > <?php echo $detBRD['article1'];?></td>
<td> <?php echo $det['qte1'];?></td>
<td > <?php if($det['qte1']!=0){ echo $detBRD['prix1'];}?></td>
<td> <?php if($det['qte1']!=0){ echo $det['qte1']*$detBRD['prix1'];}?></td>
</tr>
	<?php } else if($_GET['Pourcentage']!=0){
	?>
<tr >
<td>1</td>
<td > <?php echo $detBRD['article1'];?></td>
<td> <?php echo $detBRD['qte1'];?></td>
<td > <?php if($detBRD['qte1']!=0){ echo $detBRD['prix1'];}?></td>
<td> <?php if($detBRD['qte1']!=0){ echo $detBRD['qte1']*$detBRD['prix1'];}?></td>
</tr>
<?php @$tot=$tot+($det['qte1']*$detBRD['prix1']); } }
if($detBRD['prix2']!=0 and $detBRD['prix2']!= ""){
	
if($det['qte2']!=0){

$tot=$tot+($det['qte2']*$detBRD['prix2']);
?>
<tr>
<td>2</td>
<td><?php if($det['qte2']!=0){ echo $detBRD['article2'];}?></td>
<td> <?php if($det['qte2']!=0){ echo $det['qte2'];}?></td>
<td> <?php if($det['qte2']!=0){ echo $detBRD['prix2'];}?></td>
<td> <?php if($det['qte2']!=0){ echo $det['qte2']*$detBRD['prix2'];}?></td>

</tr>

<?php } }
if($detBRD['prix3']!=0 and $detBRD['prix3']!= ""){
if($det['qte3']!=0 or $_GET['Pourcentage']!=0){
$tot=$tot+($det['qte3']*$detBRD['prix3']);
?>
<tr>
<td>3</td>
<td><?php echo $detBRD['article3'];?></td>
<td> <?php if($det['qte3']!=0){ echo $det['qte3'];}?></td>
<td> <?php if($det['qte3']!=0){ echo $detBRD['prix3'];}?></td>
<td> <?php if($det['qte3']!=0){ echo $det['qte3']*$detBRD['prix3'];}?></td>

</tr>
<?php } 
}if($detBRD['prix4']!=0  and $detBRD['prix4']!= ""){
if($det['qte4']!=0 or @$_GET['Pourcentage']!=0){
$tot=$tot+($det['qte4']*$detBRD['prix4']);
?>
<tr>
<td>4</td>
<td><?php if($det['qte4']!=0 or @$_GET['Pourcentage']!=0){ echo $detBRD['article4'];}?></td>
<td> <?php if(@$_GET['Pourcentage']!=0){ echo $_SESSION['qte4Brd'];} else if($det['qte4']!=0){echo $det['qte4'];}?></td>
<td> <?php if($det['qte4']!=0 or @$_GET['Pourcentage']!=0){ echo $detBRD['prix4'];}?></td>
<td> <?php if(@$_GET['Pourcentage']!=0){ echo $_SESSION['qte4Brd']*@$detBRD['prix4'];} else if($det['qte4']!=0)
{echo @$det['qte4']*@$detBRD['prix4'];}?></td>

</tr>
<?php } 
}if($detBRD['prix5']!=0 and $detBRD['prix5']!= ""){
if(@$det['qte5']!=0 or @$_GET['Pourcentage']!=0){
@$tot=$tot+($det['qte5']*$detBRD['prix5']);
?>
<tr>
<td>5</td>
<td><?php if($det['qte5']!=0 or @$_GET['Pourcentage']!=0){ echo $detBRD['article5'];}?></td>
<td> <?php if($_GET['Pourcentage']!=0){ echo $_SESSION['qte5Brd'];} else if($det['qte5']!=0){echo $det['qte5'];}?></td>
<td> <?php if($det['qte5']!=0 or $_GET['Pourcentage']!=0){ echo $detBRD['prix5'];}?></td>
<td> <?php if($_GET['Pourcentage']!=0){ echo $_SESSION['qte5Brd']*@$detBRD['prix5'];} else if($det['qte5']!=0)
{echo @$det['qte5']*@$detBRD['prix5'];}?></td>

</tr>
<?php } 

if($detBRD['prix6']!=0 and $detBRD['prix6']!= ""){
if(@$det['qte6']!=0 or @$_GET['Pourcentage']!=0){
@$tot=$tot+($det['qte6']*$detBRD['prix6']);
?>
<tr>
<td>6</td>
<td><?php if($det['qte6']!=0 or $_GET['Pourcentage']!=0){ echo $detBRD['article6'];}?></td>
<td> <?php if($_GET['Pourcentage']!=0){ echo $_SESSION['qte6Brd'];} else if($det['qte6']!=0){echo $det['qte6'];}?></td>
<td> <?php if($det['qte6']!=0 or $_GET['Pourcentage']!=0){ echo $detBRD['prix6'];}?></td>
<td> <?php if($_GET['Pourcentage']!=0){ echo $_SESSION['qte6Brd']*@$detBRD['prix6'];} else if($det['qte6']!=0)
{echo @$det['qte6']*@$detBRD['prix6'];}?></td>

</tr>
<?php } }
}if($detBRD['prix7']!=0 and $detBRD['prix7']!= ""){
if(@$det['qte7']!=0  or @$_GET['Pourcentage']!=0){
@$tot=$tot+($det['qte7']*$detBRD['prix7']);
?>
<tr>
<td>7</td>
<td><?php if($det['qte7']!=0 or $_GET['Pourcentage']!=0){ echo $detBRD['article7'];}?></td>
<td> <?php if($_GET['Pourcentage']!=0){ echo $_SESSION['qte7Brd'];} else if($det['qte7']!=0){echo $det['qte7'];}?></td>
<td> <?php if($det['qte7']!=0 or $_GET['Pourcentage']!=0){ echo $detBRD['prix7'];}?></td>
<td> <?php if($_GET['Pourcentage']!=0){ echo $_SESSION['qte7Brd']*@$detBRD['prix7'];} else if($det['qte7']!=0)
{echo @$det['qte7']*@$detBRD['prix7'];}?></td>

</tr>
<?php } }
if($_GET['Pourcentage']!=0){?>
<?php //<?php echo $_GET['montant']/1.13?>
<tr>
<td><b>Pourcentage</b></td><td><?php echo $_GET['designation']?></td><td><?php echo $_GET['Pourcentage']?>%</td>
<td ></td><td><?php echo $_SESSION['montantBrd'];?></td></tr>
<?php }

if($det['qte8']!=0){
$tot=$tot+($det['qte8']*$detBRD['prix8']);
?>
<tr>
<td>8</td>
<td><?php if($det['qte8']!=0){ echo $detBRD['article8'];}?></td>
<td> <?php if($det['qte8']!=0){ echo $det['qte8'];}?></td>
<td> <?php if($det['qte8']!=0){ echo $detBRD['prix8'];}?></td>
<td> <?php if($det['qte8']!=0){ echo $det['qte8']*$detBRD['prix8'];}?></td>

</tr>
<?php } 
if($det['qte9']!=0){
$tot=$tot+($det['qte9']*$detBRD['prix9']);
?>
<tr>
<td>9</td>
<td><?php if($det['qte9']!=0){ echo $detBRD['article9'];}?></td>
<td> <?php if($det['qte9']!=0){ echo $det['qte9'];}?></td>
<td> <?php if($det['qte9']!=0){ echo $detBRD['prix9'];}?></td>
<td> <?php if($det['qte9']!=0){ echo $det['qte9']*$detBRD['prix9'];}?></td>

</tr>
<?php } 
if($det['qte10']!=0){
$tot=$tot+($det['qte10']*$detBRD['prix10']);
?>
<tr>
<td>10</td>
<td><?php if($det['qte10']!=0){ echo $detBRD['article10'];}?></td>
<td> <?php if($det['qte10']!=0){ echo $det['qte10'];}?></td>
<td> <?php if($det['qte10']!=0){ echo $detBRD['prix10'];}?></td>
<td> <?php if($det['qte10']!=0){ echo $det['qte10']*$detBRD['prix10'];}?></td>

</tr>
<?php } 
if($det['qte11']!=0){
	$tot=$tot+($det['qte11']*$detBRD['prix11']);
?>
<tr>
<td>11</td>
<td><?php if($det['qte11']!=0){ echo $detBRD['article11'];}?></td>
<td> <?php if($det['qte11']!=0){ echo $det['qte11'];}?></td>
<td> <?php if($det['qte11']!=0){ echo $detBRD['prix11'];}?></td>
<td> <?php if($det['qte11']!=0){ echo $det['qte11']*$detBRD['prix11'];}?></td>

</tr>
<?php } 
if($det['qte12']!=0){
	$tot=$tot+($det['qte12']*$detBRD['prix12']);
?>
<tr>
<td>12</td>
<td><?php if($det['qte12']!=0){ echo $detBRD['article12'];}?></td>
<td> <?php if($det['qte12']!=0){ echo $det['qte12'];}?></td>
<td> <?php if($det['qte12']!=0){ echo $detBRD['prix12'];}?></td>
<td> <?php if($det['qte12']!=0){ echo $det['qte12']*$detBRD['prix12'];}?></td>

</tr>
<?php } 
if($det['qte13']!=0){
	$tot=$tot+($det['qte13']*$detBRD['prix13']);
?>
<tr>
<td>13</td>
<td><?php if($det['qte13']!=0){ echo $detBRD['article13'];}?></td>
<td> <?php if($det['qte13']!=0){ echo $det['qte13'];}?></td>
<td> <?php if($det['qte13']!=0){ echo $detBRD['prix13'];}?></td>
<td> <?php if($det['qte13']!=0){ echo $det['qte13']*$detBRD['prix13'];}?></td>

</tr>
<?php } 
if($det['qte14']!=0){
	$tot=$tot+($det['qte14']*$detBRD['prix14']);
?>
<tr>
<td>14</td>
<td><?php if($det['qte14']!=0){ echo $detBRD['article14'];}?></td>
<td> <?php if($det['qte14']!=0){ echo $det['qte14'];}?></td>
<td> <?php if($det['qte14']!=0){ echo $detBRD['prix14'];}?></td>
<td> <?php if($det['qte14']!=0){ echo $det['qte14']*$detBRD['prix14'];}?></td>

</tr>
<?php } 
if($det['qte15']!=0){
	$tot=$tot+($det['qte15']*$detBRD['prix15']);
?>
<tr>
<td>15</td>
<td><?php if($det['qte15']!=0){ echo $detBRD['article15'];}?></td>
<td> <?php if($det['qte15']!=0){ echo $det['qte15'];}?></td>
<td> <?php if($det['qte15']!=0){ echo $detBRD['prix15'];}?></td>
<td> <?php if($det['qte15']!=0){ echo $det['qte15']*$detBRD['prix15'];}?></td>

</tr>
<?php } 
if($det['qte16']!=0){
	$tot=$tot+($det['qte16']*$detBRD['prix16']);
?>
<tr>
<td>16</td>
<td><?php if($det['qte16']!=0){ echo $detBRD['article16'];}?></td>
<td> <?php if($det['qte16']!=0){ echo $det['qte16'];}?></td>
<td> <?php if($det['qte16']!=0){ echo $detBRD['prix16'];}?></td>
<td> <?php if($det['qte16']!=0){ echo $det['qte16']*$detBRD['prix16'];}?></td>

</tr>
<?php } 
if($det['qte17']!=0){
	$tot=$tot+($det['qte17']*$detBRD['prix17']);
?>
<tr>
<td>17</td>
<td><?php if($det['qte17']!=0){ echo $detBRD['article17'];}?></td>
<td> <?php if($det['qte17']!=0){ echo $det['qte17'];}?></td>
<td> <?php if($det['qte17']!=0){ echo $detBRD['prix17'];}?></td>
<td> <?php if($det['qte17']!=0){ echo $det['qte17']*$detBRD['prix17'];}?></td>

</tr>
<?php } 
if($det['qte18']!=0){
	$tot=$tot+($det['qte18']*$detBRD['prix18']);
?>
<tr>
<td>18</td>
<td><?php if($det['qte18']!=0){ echo $detBRD['article18'];}?></td>
<td> <?php if($det['qte18']!=0){ echo $det['qte18'];}?></td>
<td> <?php if($det['qte18']!=0){ echo $detBRD['prix18'];}?></td>
<td> <?php if($det['qte18']!=0){ echo $det['qte18']*$detBRD['prix18'];}?></td>

</tr>
<?php } 
if($det['qte19']!=0){
	$tot=$tot+($det['qte19']*$detBRD['prix19']);
?>
<tr>
<td>19</td>
<td><?php if($det['qte19']!=0){ echo $detBRD['article19'];}?></td>
<td> <?php if($det['qte19']!=0){ echo $det['qte19'];}?></td>
<td> <?php if($det['qte19']!=0){ echo $detBRD['prix19'];}?></td>
<td> <?php if($det['qte19']!=0){ echo $det['qte19']*$detBRD['prix19'];}?></td>

</tr>
<?php } 
if($det['qte20']!=0){
	$tot=$tot+($det['qte20']*$detBRD['prix20']);
?>
<tr>
<td>20</td>
<td><?php if($det['qte20']!=0){ echo $detBRD['article20'];}?></td>
<td> <?php if($det['qte20']!=0){ echo $det['qte20'];}?></td>
<td> <?php if($det['qte20']!=0){ echo $detBRD['prix20'];}?></td>
<td> <?php if($det['qte20']!=0){ echo $det['qte20']*$detBRD['prix20'];}?></td>

</tr>
<?php }
if (@$_GET['Pourcentage']==0)
{
if($_GET['Annee']<2023){$div=1.13; }
if($_GET['Annee']>=2023){$div=1.19;}

	$tot=@$_GET['montant']/$div;
}
else if (@$_GET['Pourcentage']!=0){$tot=(@$_GET['Pourcentage']/100)*($_SESSION['montantBrd']);}

/////// TVA  -->

if($_GET['Annee']<2023){$tva=13;$Vtimbre='0.600'; }
if($_GET['Annee']>=2023){$tva=19;$Vtimbre='1.000';}
$coutTva=($tva/100);

 ?>
<tr><th><th colspan=3 align=right>Total Général HTVA </th><th colspan=2><?php echo $tot?></th></tr>
<tr><th></th> <th colspan=3 align=right>TVA(<?=$tva?>%) </th><th colspan=2><?php echo $tot*$coutTva?></th></tr>
<?php if((@$tP['type']=='ponctuel') or(@$tP['type']=='prive') or ($_GET['AO']=='Ponct') ){
$timbre=$Vtimbre;
?>
<tr><th></th> <th colspan=3 align=right>Droit de Timbre </th><th colspan=2><?=$Vtimbre?></th></tr>
<?php } 
else $timbre="";

?>
<tr><th></th> <th colspan=3 align=right>Total Général TTC </th><th colspan=2><?php @$totale=$timbre+($tot*$coutTva)+$tot;echo number_format($totale, 3, '.', '')?></th></tr>

<?php 
include 'conversion.php';
$res=explode('.', $totale);
//echo $res[2];

?>
</table>
</td>

</tr>
<tr height=60><td colspan=3>Arrêter la présente facture à la somme de : <b style="text-transform:uppercase"><?php echo asLetters($totale)?> <input type="text" style="width:30px;border:none;font-weight:bold" >  <?php echo 'millimes';?></b></td></tr>
<tr height=60><td colspan=3>Demeurant à votre  entière disposition pour tous  renseignements complémentaires,  nous vous prions de croire, Messieurs, l’expression de notre parfaite considération </td></tr>
<tr height=30><td></td><td></td><th align=center  style="position:relative;top:0px;"> "SIGMA INSPECTEC"</span></th></tr>


</table>
<table  width=100% align="center" height=20 style="border:solid 3px black;position:relative;top:100px;">
<th valign=top colspan=2  >
<p style="margin-bottom:-20px;font-size:18px">Siège social: 05 Rue BenGhazi. Bureau 4.5  4 ème étage - lafayette.</p>
<p style="margin-bottom:-10px;font-size:18px">Tél: 36 131 731 / 58 831 544 / 24 131 544.</p>
<p style="font-size:18px;position:relative;top:-10px"> E-mail: tunisia.polycontrols.tpc@gmail.com</p>
</th>
</table>
