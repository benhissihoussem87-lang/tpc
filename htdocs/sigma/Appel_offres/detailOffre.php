
<?php
  include '../classes/appel_offres.class.php';
    include '../classes/bordero.class.php';
	
	$offre=new offres();
	$detail=$offre->getdetailOffre($_GET['id']);
foreach($detail as $detop);

//boredraux
	
	$brd=new Borderos();
	$detailBrd=$brd->getdetailBorderau($detop['code']);
foreach($detailBrd as $det);
	
	//Fin 
//Client
$MDOS=$offre->getMDOOffre($detop['mdo']);
		if(count($MDOS)>0)
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

?>
<table width=100% align=center >

<tr style="height:20px"><td valign=top style="border:solid 3px black"><img src="../images/logo.png" width=50 height=60 onclick="window.print()"></td>
<th valign=top colspan=2 style="border:solid 3px black;"><h2 style="padding-top:10px;font-size:18px">
" TPC " Tunisia PolyControls</h2></th>
</tr>

<tr><td></td><td></td><td>Tunis Le : <?php echo $detop['date_decharge']?></td></tr>
<tr><td colspan=2 >Titre Projet: <?php echo $detop['titre']?></td>

<th style="border:2px solid black;font-size:15px" width="250" rowspan=2><?php echo $client?></th></tr>
<tr><td colspan=2></td>

<tr><td></td><th style="font-size:20px"><u>Offre N° : <?php echo $detop['code']?></u></th>
<td style="border:2px solid black;"><?php echo $adresse?></td></tr>
<tr><td></td><th   style="font-size:15px">M.F: <input type="text" ></th>
<td style="border:2px solid black;"><?php if($fax!=""){?>Fax: <?php echo $fax; }?> </td></tr>
<tr><td></td><th   style="font-size:15px"></th><td></td></tr>
<tr><td> Messieurs,</td><th ></th><td></td></tr>
<tr><td colspan=3>Dans le cadre de notre mission nous avons l’honneur de vous proposer notre meilleure offre de prix relatif au projet ci-dessus indiqué..</td></tr>


<tr>
<td colspan=4>
<table border=1 width=80% align=center>
<tr>
<th>N°</th><th>Désignantion</th><th>Qté</th><th >Prix.U</th><th>Prix.THTVA</th></tr>
<?php 
$tot=0;

if($det['article1']!=""){?>
<tr >
<td>1</td>
<td > <?php if($det['qte1']!=0){ echo $det['article1'];}?></td>
<td> <?php if($det['qte1']!=0){ echo $det['qte1'];}?></td>
<td > <?php if($det['qte1']!=0){ echo $det['prix1'];}?></td>
<td> <?php if($det['qte1']!=0){ echo $det['qte1']*$det['prix1'];}?></td>
</tr>
<?php $tot=$tot+($det['qte1']*$det['prix1']); } 
if($det['article2']!=""){

$tot=$tot+($det['qte2']*$det['prix2']);
?>
<tr>
<td>2</td>
<td><?php if($det['qte2']!=0){ echo $det['article2'];}?></td>
<td> <?php if($det['qte2']!=0){ echo $det['qte2'];}?></td>
<td> <?php if($det['qte2']!=0){ echo $det['prix2'];}?></td>
<td> <?php if($det['qte2']!=0){ echo $det['qte2']*$det['prix2'];}?></td>

</tr>
<?php } 
if($det['article3']!=""){
$tot=$tot+($det['qte3']*$det['prix3']);
?>
<tr>
<td>3</td>
<td><?php if($det['qte3']!=0){ echo $det['article3'];}?></td>
<td> <?php if($det['qte3']!=0){ echo $det['qte3'];}?></td>
<td> <?php if($det['qte3']!=0){ echo $det['prix3'];}?></td>
<td> <?php if($det['qte3']!=0){ echo $det['qte3']*$det['prix3'];}?></td>

</tr>
<?php } 
if($det['article4']!=""){
$tot=$tot+($det['qte4']*$det['prix4']);
?>
<tr>
<td>4</td>
<td><?php if($det['qte4']!=0){ echo $det['article4'];}?></td>
<td> <?php if($det['qte4']!=0){ echo $det['qte4'];}?></td>
<td> <?php if($det['qte4']!=0){ echo $det['prix4'];}?></td>
<td> <?php if($det['qte4']!=0){ echo $det['qte4']*$det['prix4'];}?></td>

</tr>
<?php } 
if($det['article5']!=""){
$tot=$tot+($det['qte5']*$det['prix5']);
?>
<tr>
<td>5</td>
<td><?php if($det['qte5']!=0){ echo $det['article5'];}?></td>
<td> <?php if($det['qte5']!=0){ echo $det['qte5'];}?></td>
<td> <?php if($det['qte5']!=0){ echo $det['prix5'];}?></td>
<td> <?php if($det['qte5']!=0){ echo $det['qte5']*$det['prix5'];}?></td>

</tr>
<?php } 
if($det['article6']!=""){
$tot=$tot+($det['qte6']*$det['prix6']);
?>
<tr>
<td>6</td>
<td><?php if($det['qte6']!=0){ echo $det['article6'];}?></td>
<td> <?php if($det['qte6']!=0){ echo $det['qte6'];}?></td>
<td> <?php if($det['qte6']!=0){ echo $det['prix6'];}?></td>
<td> <?php if($det['qte6']!=0){ echo $det['qte6']*$det['prix6'];}?></td>

</tr>
<?php } 
if($det['article7']!=""){
$tot=$tot+($det['qte7']*$det['prix7']);
?>
<tr>
<td>7</td>
<td><?php if($det['qte7']!=0){ echo $det['article7'];}?></td>
<td> <?php if($det['qte7']!=0){ echo $det['qte7'];}?></td>
<td> <?php if($det['qte7']!=0){ echo $det['prix7'];}?></td>
<td> <?php if($det['qte7']!=0){ echo $det['qte7']*$det['prix7'];}?></td>

</tr>
<?php } 
if($det['article8']!=""){
$tot=$tot+($det['qte8']*$det['prix8']);
?>
<tr>
<td>8</td>
<td><?php if($det['qte8']!=0){ echo $det['article8'];}?></td>
<td> <?php if($det['qte8']!=0){ echo $det['qte8'];}?></td>
<td> <?php if($det['qte8']!=0){ echo $det['prix8'];}?></td>
<td> <?php if($det['qte8']!=0){ echo $det['qte8']*$det['prix8'];}?></td>

</tr>
<?php } 
if($det['article9']!=""){
$tot=$tot+($det['qte9']*$det['prix9']);
?>
<tr>
<td>9</td>
<td><?php if($det['qte9']!=0){ echo $det['article9'];}?></td>
<td> <?php if($det['qte9']!=0){ echo $det['qte9'];}?></td>
<td> <?php if($det['qte9']!=0){ echo $det['prix9'];}?></td>
<td> <?php if($det['qte9']!=0){ echo $det['qte9']*$det['prix9'];}?></td>

</tr>
<?php } 
if($det['article10']!=""){
$tot=$tot+($det['qte10']*$det['prix10']);
?>
<tr>
<td>10</td>
<td><?php if($det['qte10']!=0){ echo $det['article10'];}?></td>
<td> <?php if($det['qte10']!=0){ echo $det['qte10'];}?></td>
<td> <?php if($det['qte10']!=0){ echo $det['prix10'];}?></td>
<td> <?php if($det['qte10']!=0){ echo $det['qte10']*$det['prix10'];}?></td>

</tr>
<?php } 
if($det['article11']!=""){
?>
<tr>
<td>11</td>
<td><?php if($det['qte11']!=0){ echo $det['article11'];}?></td>
<td> <?php if($det['qte11']!=0){ echo $det['qte11'];}?></td>
<td> <?php if($det['qte11']!=0){ echo $det['prix11'];}?></td>
<td> <?php if($det['qte11']!=0){ echo $det['qte11']*$det['prix11'];}?></td>

</tr>
<?php } 
if($det['article12']!=""){
?>
<tr>
<td>12</td>
<td><?php if($det['qte12']!=0){ echo $det['article12'];}?></td>
<td> <?php if($det['qte12']!=0){ echo $det['qte12'];}?></td>
<td> <?php if($det['qte12']!=0){ echo $det['prix12'];}?></td>
<td> <?php if($det['qte12']!=0){ echo $det['qte12']*$det['prix12'];}?></td>

</tr>
<?php } 
if($det['article13']!=""){
?>
<tr>
<td>13</td>
<td><?php if($det['qte13']!=0){ echo $det['article13'];}?></td>
<td> <?php if($det['qte13']!=0){ echo $det['qte13'];}?></td>
<td> <?php if($det['qte13']!=0){ echo $det['prix13'];}?></td>
<td> <?php if($det['qte13']!=0){ echo $det['qte13']*$det['prix13'];}?></td>

</tr>
<?php } 
if($det['article14']!=""){
?>
<tr>
<td>14</td>
<td><?php if($det['qte14']!=0){ echo $det['article14'];}?></td>
<td> <?php if($det['qte14']!=0){ echo $det['qte14'];}?></td>
<td> <?php if($det['qte14']!=0){ echo $det['prix14'];}?></td>
<td> <?php if($det['qte14']!=0){ echo $det['qte14']*$det['prix14'];}?></td>

</tr>
<?php } 
if($det['article15']!=""){
?>
<tr>
<td>15</td>
<td><?php if($det['qte15']!=0){ echo $det['article15'];}?></td>
<td> <?php if($det['qte15']!=0){ echo $det['qte15'];}?></td>
<td> <?php if($det['qte15']!=0){ echo $det['prix15'];}?></td>
<td> <?php if($det['qte15']!=0){ echo $det['qte15']*$det['prix15'];}?></td>

</tr>
<?php } 
if($det['article16']!=""){
?>
<tr>
<td>16</td>
<td><?php if($det['qte16']!=0){ echo $det['article16'];}?></td>
<td> <?php if($det['qte16']!=0){ echo $det['qte16'];}?></td>
<td> <?php if($det['qte16']!=0){ echo $det['prix16'];}?></td>
<td> <?php if($det['qte16']!=0){ echo $det['qte16']*$det['prix16'];}?></td>

</tr>
<?php } 
if($det['article17']!=""){
?>
<tr>
<td>17</td>
<td><?php if($det['qte17']!=0){ echo $det['article17'];}?></td>
<td> <?php if($det['qte17']!=0){ echo $det['qte17'];}?></td>
<td> <?php if($det['qte17']!=0){ echo $det['prix17'];}?></td>
<td> <?php if($det['qte17']!=0){ echo $det['qte17']*$det['prix17'];}?></td>

</tr>
<?php } 
if($det['article18']!=""){
?>
<tr>
<td>18</td>
<td><?php if($det['qte18']!=0){ echo $det['article18'];}?></td>
<td> <?php if($det['qte18']!=0){ echo $det['qte18'];}?></td>
<td> <?php if($det['qte18']!=0){ echo $det['prix18'];}?></td>
<td> <?php if($det['qte18']!=0){ echo $det['qte18']*$det['prix18'];}?></td>

</tr>
<?php } 
if($det['article19']!=""){
?>
<tr>
<td>19</td>
<td><?php if($det['qte19']!=0){ echo $det['article19'];}?></td>
<td> <?php if($det['qte19']!=0){ echo $det['qte19'];}?></td>
<td> <?php if($det['qte19']!=0){ echo $det['prix19'];}?></td>
<td> <?php if($det['qte19']!=0){ echo $det['qte19']*$det['prix19'];}?></td>

</tr>
<?php } 
if($det['article20']!=""){
?>
<tr>
<td>20</td>
<td><?php if($det['qte20']!=0){ echo $det['article20'];}?></td>
<td> <?php if($det['qte20']!=0){ echo $det['qte20'];}?></td>
<td> <?php if($det['qte20']!=0){ echo $det['prix20'];}?></td>
<td> <?php if($det['qte20']!=0){ echo $det['qte20']*$det['prix20'];}?></td>

</tr>
<?php }

/////// TVA  -->

if($detop['code']<23000){$tva=13;$Vtimbre='0.600'; }
if($detop['code']>=23000){$tva=19;$Vtimbre='1.000';}
$coutTva=($tva/100);
 ?>
<tr><th><th colspan=3 align=right>Total Général HTVA </th><th colspan=2><?php echo $tot?></th></tr>
<tr><th></th> <th colspan=3 align=right>TVA(<?=$tva?>%) </th><th colspan=2><?=$coutTva*$tot?></th></tr>
<tr><th></th> <th colspan=3 align=right>Total Général TTC </th><th colspan=2><?php @$totale=($tot*$coutTva)+$tot;echo number_format($totale, 3, '.', '')?></th></tr>

<?php 


if(($detop['type']=='ponctuel') or($detop['type']=='prive') ){
$timbre=$Vtimbre;
?>
<?php } 
else $timbre="";

?>

<?php 
include 'conversion.php';
$res=explode('.', $tot);
//echo $res[2];

?>
</table>
</td>

</tr>
<tr height=60><td colspan=3>Arrêter le présent Offre à la somme de : <b style="text-transform:uppercase"><?php echo asLetters($tot)?> Dinars ET <input type="text" style="width:30px;border:none;font-weight:bold" >  <?php echo 'millimes (en HTVA)';?></b></td></tr>
<tr height=60><td colspan=3>Demeurant à votre  entière disposition pour tous  renseignements complémentaires,  nous vous prions de croire, Messieurs, l’expression de notre parfaite considération </td></tr>
<tr height=30><td></td><td></td><th align=center  style="position:relative;top:0px;"> SIGNATURE ET CACHET<br><span style="width:20px;margin:auto"></span></th></tr>


</table>
<table  width=100% height=20 style="border:solid 3px black;position:relative;top:32px;">
<th valign=top colspan=2  >
<p style="margin-bottom:-20px;font-size:18px">Siège social: 05 Rue BenGhazi. Bureau 4.5  4 ème étage - lafayette.</p>
<p style="margin-bottom:-10px;font-size:18px">Tél: 36 131 731 / 58 831 544 / 24 131 544.</p>
<p style="font-size:18px;position:relative;top:-10px"> E-mail: tunisia.polycontrols.tpc@gmail.com</p>
</th>
</table>
