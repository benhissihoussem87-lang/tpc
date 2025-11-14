<?php
$detailPonctuel=$recP->getponctuel($_GET['Ponctuel']);
$details=$recP->detailRecouvrement($_GET['id_modifier']);
foreach($details as $det);
$Mdos=$recP->getMdo();
$factures=$recP->getFacture();
foreach($factures as $fact);
foreach($detailPonctuel as $detail);
//Ajout Appel Offre
if(isset($_POST['ok']))
{
if($recP->ajout())
 {

echo "<script>document.location.href='sigma.php?AfficherRECP'</script>";

 }
 else
 {
 echo 'Erreur Ajout';
  
 }
}
?>
<form method="post" enctype="multipart/form-data" >
<div class="container" style="position:relative; top:-60px"  >
      <div class="card card-register mx-auto mt-5" >
        <div class="card-header">Modifier Recouvrement Ponctuel
		  <input type="submit" style="width:250px; margin:auto;position:relative; top:-30px;margin-bottom:-30px" id="ok" value="Ok" name="ok" class="btn btn-primary btn-block"/>
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
					<label for="mdo">Code </label>
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
					 
						<td width=50>
					  
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
						
						<input type="text"  value="<?php echo $det['COMM']?>"id="COMM" style="padding:6px 0 6px 4px" name="comm" class="form-control"  >
						
				  </td>
				  <td width=50 align=center>
				  
					<label for="facture">Facture</label>
					  </td>
					  <td>
					  <table width=100% id="FactureRecouvrement">
					  <tr>
					  <input type="hidden" value="<?php echo $fact['numFacture']+1?>" id="codeFact">
					  <td valign=top width=30%>
					  <input type="text" value="<?php echo $det['FACTURE']?>" id="facture" style="width:160px" style="padding:6px 0 6px 4px" name="facture"  readOnly  class="form-control"  ></td>
					 <td width=30%><input type="radio"  name="btnfacture" class="form-control" value="oui" <?php if($det['FACTURE']!='non'){ echo 'checked';} ?>  >Oui</td>
					 <td width=30%> <input type="radio"  name="btnfacture" class="form-control" value="non" <?php if($det['FACTURE']=='non'){ echo 'checked';} ?>  >Non</td>
					 </tr>
					 </table>
				</td>
				  
				  </tr>
				  <!------------------------->
				 	  <tr>
				  <td width=50 align=center>
					
				   
					
					<label for="Ing">Ing</label>
					   </td>
	                    <td>	
               <select id="Ing" style="padding:6px 0 6px 4px" name="ing" class="form-control" >						
						<?php
						foreach($Mdos as $md){?>
						<option><?php echo $md['designation']?></option>
						
						<?php } ?>
						</select>
						
						
				  </td>
				  <td width=50 align=center>
				  
					<label for="Date_AVIS">Date Rec</label>
					  </td>
					  <td>
						<input type="date" value="<?php echo $det['date']?>" id="Date_AVIS" style="padding:6px 0 6px 4px" name="date" class="form-control"  >
						
					  
				 
				  </td>
				  
				  </tr>
				  <!------------------------->
                     <tr>
				  <td width=50 align=center >
					
				   
					
					<label for="V_ESTIMEES">Rec</label>
					   </td>
	<td colspan=3>		
						
						<input type="text" value="<?php echo $det['RECOUV']?>" id="V_ESTIMEES" style="padding:6px 0 6px 4px" name="recouv" class="form-control"  >
						
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