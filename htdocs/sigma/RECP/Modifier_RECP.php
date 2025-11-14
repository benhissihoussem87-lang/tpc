<?php
@$facture=$_GET['Facture'];
/***Vérification si Facture ou Autre Facture***/
$typeFacture=null;
$mot ='Autre';
if($facture!=null){
		if(strpos($_GET['Facture'], $mot) !== false){
	    	$ln=strlen($_GET['Facture']);
       			
			$facture = substr($_GET['Facture'], 0,$ln-5);
			//echo '<h1> LN '.$facture.'</h1>';
		$typeFacture="Autre";
			}
			else {
				$typeFacture="Facture";
			}
}
else {
	$typeFacture="tous";
}
//echo '<h1>'.$typeFacture.'</h1>';
/***Fin Vérification si Facture ou Autre Facture***/							
$detailPonctuel=$recP->getponctuel($_GET['Projet']);
foreach($detailPonctuel as $detail);
$detailRECP=$recP->getRecP_Projet($_GET['idRecP'],$detail['num']);
foreach($detailRECP as $detailRCP);
$Mdos=$recP->getMdo();
$factures=$recP->getFacture();
$Autrefactures=$recP->getAutreFacture();
$maxFacture=0;$maxDateFacture=0;


if(count($factures)>0)
{
foreach($factures as $fact)
{
	
	$maxFacture=$fact['numFacture'];$maxDateFacture=$fact['annee'];
}
}
$maxAutreFacture=0;$maxDateAutreFacture=0;

if(count($Autrefactures)>0)
{
foreach($Autrefactures as $factA)
{
	
  $maxAutreFacture=$factA['numFacture'];
  $maxDateAutreFacture=$factA['annee'];
}
}
// Facture News

//echo 'Max Fcature '.$maxFacture;

//Ajout Appel Offre
if(isset($_POST['ok']))
{
	//echo '<h1> Autre F '.$_POST['Autrefacture'].'</h1>';
	//echo '<h1>  F '.$_POST['facture'].'</h1>';
	if(isset($_GET['Facture']))
	{ 
       if($_GET['Facture']!=null)
	   {$factures=explode("/",$_GET['Facture']);}
	   else {
			$factures=null;
		}
	}
	
	else {
		$factures=null;
	}
		
			$numFacture=$factures[0];$annee=$factures[1];
			//echo '<h1>Num '.$numFacture.'</h1>';
			if($_SESSION['user']=='Admin2'){
				if(!empty($_POST['Autrefacture']) or !empty($_POST['facture']))
				{
					// POur Facture 
					 if($_POST['facture']=='non')
					 {
						 //suppression Facture de table Facture
						 if($recP->deletefacturesRecP($_GET['idRecP'],$numFacture))
						 {echo "<script>document.location.href='sigma.php?AfficherRECP'</script>";}
					 }
					 else {
						 if($recP->ModifierRecP($_GET['idRecP'],$_POST['comm'],$_POST['ing'],$_POST['recouv'],$_POST['date']))
						 {echo "<script>document.location.href='sigma.php?AfficherRECP'</script>";}
					 }
				 
				}
			}
			else if($_SESSION['user']=='Admin'){
				// POur Facture 
			if(!empty($_POST['facture']))
				{
					
					 if($_POST['facture']=='non')
					 {
						 //suppression Facture de table Facture
						 if($recP->deletefacturesRecP($_GET['idRecP'],$numFacture))
						 {
							 echo "<script>document.location.href='sigma.php?AfficherRECP'</script>";
							 }
					 }
					 else {
						 if($recP->ModifierRecP($_GET['idRecP'],$_POST['comm'],$_POST['ing'],$_POST['recouv'],$_POST['date']))
						 {
							
							 echo "<script>document.location.href='sigma.php?AfficherRECP'</script>";
					       }
					 }
				 
				}
				
			// POur Autre Facture 
			 if(!empty($_POST['Autrefacture']))
				{
					
					 if($_POST['Autrefacture']=='non')
					 {
						 //suppression Facture de table Facture
						 if($recP->deleteAutrefacturesRecP($_GET['idRecP'],$numFacture))
						 {
							 echo "<script>document.location.href='sigma.php?AfficherRECP'</script>";
							 }
					 }
					 else {
						 if($recP->ModifierRecP($_GET['idRecP'],$_POST['comm'],$_POST['ing'],$_POST['recouv'],$_POST['date']))
						 {
							 echo "<script>document.location.href='sigma.php?AfficherRECP'</script>";
					       }
					 }
				 
				}
			
			}
}


// Supprimer Recouvrement
if(isset($_POST['supprimer']))
{
	$recP->deleterec_p($_GET['idRecP']);

$recP->deleteAutreFactureRec($_GET['Projet']); 

 $recP->deleteFactureRec($_GET['Projet']);
 $recP->deleteBorderauxRecP($_GET['Facture']);
		
	echo "<script>document.location.href='sigma.php?AfficherRECP'</script>";
	
	 
}
?>

<form method="post" enctype="multipart/form-data" >
<div class="container" style="position:relative; top:-60px"  >
      <div class="card card-register mx-auto mt-5" >
        <div class="card-header">Modifier Recouvrement Ponctuel
		  <input type="submit" style="width:250px; margin:auto;position:relative;left:-100px; top:-30px;margin-bottom:-30px" id="ok" value="Modifier" name="ok" class="btn btn-primary btn-block"/>
		   <input type="submit" style="width:250px; margin:auto;position:relative;left:200px;  top:-35px;margin-bottom:-30px" id="ok" value="Supprimer" name="supprimer" class="btn btn-primary btn-block"/>
		  </div>
		  
		  
		 
		 
        <div class="card-body" style="position:relative; top:-10px;">
          <table width=80% >
		  <tr>
            <!---------*********************-->
			<td width=70% >
	   <table width=100%   cellpadding=4   >
	<tr >
	<td width=50 align=center>
	<label for="codeAO">Num</label>
	
	</td>
					 
						<td width=50>
						<input type="text"  readOnly   id="num" value="<?php echo $detail['num']?>" style="padding:6px 0 6px 4px" name="num" class="form-control" >
						
					</td>
			<td width=50 align=center>
					<label for="mdo">Code Projet</label>
					</td>
					 
						<td width=50>
					  
						<input name="code" readOnly id="code" style="padding:6px 0 6px 4px" class="form-control" value="<?php echo $detail['code']?>">
						
				  </td>
				 
					
				  
				  </tr>
				  
				  <!------------------------->
				  <tr>
				   <td width=50 align=center>
					<label for="mdo">MDO</label>
					</td>
					 
						<td width=35%>
					  
						<input value="<?php echo $detail['mdo'] ?>" readonly type="text"id="mdo" style="padding:6px 0 6px 4px" name="mdo" class="form-control" >
						 
				  </td>
				  <td width=50 align=center>
				  <div class="form-row">

					<label for="titre">Projet</label>
					  </td>
					 
						<td colspan=2>
						
						<textarea  id="titre" readonly style="padding:4px 0 4px 4px" name="projet" class="form-control"  ><?php echo $detail['projet'] ?></textarea>
						
				  </div>
				  </td>
				  
				  
				  </tr>
				  <!-------------------------------->
				  <tr>
				  <td width=50 align=center>
				  
					<label for="etat" >vis-à-vis</label>
					  
					</td>
					<td>
					<input name="vis_a_vis" readonly value="<?php echo $detail['vis_a_vis'] ?>" id="vis_a_vis" style="padding:6px 0 6px 4px" class="form-control" >
				  </td>
				  
				  
		 <td width=50 align=center>
				  
					<label for="lo" >Honoraire</label>
					  
					</td>
					<td>
					<input name="honoraire" value="<?php echo $detail['honoraire'] ?>" readonly  id="lot" style="padding:6px 0 6px 4px" class="form-control" >
				  </td>
				  
				  </tr>
				  
				 
				  <!------------------------->
				  <tr>
				  <td width=50 align=center>
					
				   
					
					<label for="COMM">COMM/Miss</label>
					   </td>
	<td>		
						
						<input type="text" id="COMM" style="padding:6px 0 6px 4px" value="<?php echo $detailRCP['COMM']?>" name="comm" class="form-control"  >
						
				  </td>
				   <?php if($typeFacture!="Autre" or $typeFacture=="tous"){?>
				  <td width=50 align=center>
				  
					<label for="facture">Facture</label>
					  </td>
					  <td>
					  <table width=100%  id="FactureRecouvrement">
					  <tr>
					  <?php 
					  $codeFacture=null;
					  if($facture==null)
					  {$codeFacture=($maxFacture+1).'/'.$maxDateFacture;}
				      else  {$codeFacture=$facture;}
					  
					  ?>
					  <input type="hidden" value="<?php echo $codeFacture;?>" id="codeFact">
					  <td valign=top width=30%><input type="text" id="facture" style="width:160px" style="padding:6px 0 6px 4px" name="facture"     class="form-control" value="<?php echo $facture?> " readonly  ></td>
					 <td width=30%><input type="radio"  name="btnfacture" class="form-control" value="oui" <?php if($facture!=null) {echo 'checked' ;}  ?>  >Oui</td>
					 <td width=30%> <input type="radio"  name="btnfacture" class="form-control" value="non"  >Non</td>
					 </tr>
					 </table>
				</td>
				   <?php } ?>
				
				  
				  </tr>
				  <?php if($typeFacture=="Autre" or $typeFacture=="tous"){?>
				  <tr>
				  <td colspan=2></td>
				    <td width=50 align=center>
				  
					<label for="facture">Autre Facture</label>
					  </td>
				  <td colspan=2>
					  <table width=100% id="AutreFactureRecouvrementS">
					  <tr>
					   <?php 
					  $codeFacture=null;
					  if($facture==null)
					  {$codeFacture=($maxAutreFacture+1).'/'.$maxDateAutreFacture;}
				      else  {$codeFacture=$facture;}
					  
					  ?>
					  <input type="hidden" value="<?php echo $codeFacture; ?>" id="codeAutreFact">
					  <td valign=top width=30%><input type="text" id="Autrefacture" readonly value="<?php echo $facture?>"style="width:160px" style="padding:6px 0 6px 4px" name="Autrefacture"    class="form-control"  ></td>
					 <td width=30%><input type="radio"  name="btnfacture" class="form-control" value="ouiAutre" <?php if($facture!=null) {echo 'checked' ;}  ?>   >Oui</td>
					 <td width=30%> <input type="radio"  name="btnfacture" class="form-control" value="non"  >Non</td>
					 </tr>
					 </table>
				</td>
				  
				  </tr><?php } ?>
				  <!------------------------->
				 	  <tr>
				  <td width=50 align=center>
					
				   
					
					<label for="Ing">Ing</label>
					   </td>
	                    <td>	
               <input type="text" id="Ing" style="padding:6px 0 6px 4px" name="ing"  value="<?php echo $detailRCP['ing']?>"  class="form-control" >	
                   
						
						
				  </td>
				  <td width=50 align=center>
				  
					<label for="Date_AVIS">Date Rec</label>
					  </td>
					  <td>
						<input type="date" id="Date_AVIS" value="<?php echo $detailRCP['date']?>"  style="padding:6px 0 6px 4px" name="date" class="form-control"  >
						
					  
				 
				  </td>
				  
				  </tr>
				  <!------------------------->
                     <tr>
				  <td width=50 align=center >
					
				   
					
					<label for="V_ESTIMEES">Rec</label>
					   </td>
	<td colspan=3>		
						
						<input type="text" value="<?php echo $detailRCP['RECOUV'] ?>" id="V_ESTIMEES" style="padding:6px 0 6px 4px" name="recouv" class="form-control"  >
						
				  </td>
				  
				  
				  </tr>
				  <!---->
				 
				  
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