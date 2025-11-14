<?php
   $brd=new Borderos();
	$B_Facture=$_GET['numFacture'].'/'.$_GET['anneeFacture'];
	$rechBrdFacture=$brd->getborderosPonct($B_Facture); 
	$QtesFactures=$facture->getQtesFacturesPonctuel($_GET['numFacture'],$_GET['anneeFacture']); 
	if(!empty($rechBrdFacture))
	{
	 foreach($rechBrdFacture as $brdPonct);	
	}
	if(@count($QtesFactures)>0)
	{
	 foreach($QtesFactures as $cle);
	}
	else{
	 $QtesFactures=null;
	}
	$code='00000';
	if(@count($rechBrdFacture)>0)
	{
	//echo '<h1>'.count($rechBrdFacture).'</h1>';
	$borderoAjax=$rechBrdFacture;
	}
	else
	{
	 	$borderoAjax=$brd->getborderosPonct($code); 
	}
	 $rowAjax=count($borderoAjax);
	 if($rowAjax>0)
	 {
	 foreach($borderoAjax as $res);
	 ?>
	 <table width=100% >
	<tr><td colspan=5>Bordero</td></tr>
	<tr><td>Type</td>
	<td>consultation</td><td><input type="radio" class="form-control" style="width:20px" name="bordero_type" id="consultation_bordero" <?php if($res['type']=='consultation'){ ?> checked <?php } ?>  value="consultation"></td>
	<td>Expertise</td><td><input type="radio" <?php if($res['type']=='expertise'){ ?> checked <?php } ?> class="form-control" style="width:20px" name="bordero_type" value="expertise" id="expertise_bordero"></td>
	</tr>
	</table>
	<div id="expertise">
	<table >
	<tr><td>Art.1</td>
	<td ><textarea style="width:220px; height:100px" name="article1" placeholder="Nom" class="form-control" ><?php echo $res['article1']?></textarea></td>
			<td ><input  type="number" name="qte1"  value="<?php if($cle['qte1']!=null){ echo $cle['qte1'];} else {echo 0;}?>" class="form-control"  ></td>
		<td ><input  type="text" name="prix1" value="<?php echo $res['prix1']?>" placeholder="Prix" class="form-control" ></td>
	
	</tr>
	<tr><td>Art.2</td>
	<td ><textarea style="width:220px; height:100px" name="article2" placeholder="Nom" class="form-control" ><?php echo $res['article2']?></textarea></td>
		<td ><input  type="number" name="qte2"  value="<?php if($cle['qte2']!=null){ echo $cle['qte2'];} else {echo 0;}?>" class="form-control"  ></td>
		<td ><input type="text" name="prix2" placeholder="Prix" value="<?php echo $res['prix2']?>"class="form-control" ></td>
		
	</tr>
	</table>
	</div><!--Fin #expertise-->
	<div id="consultation">
	<table>
	<tr><td>Art.3</td>
	<td ><textarea style="width:220px; height:100px" name="article3" placeholder="Nom" class="form-control" ><?php echo $res['article3']?></textarea></td>
		<td ><input  type="number" name="qte3"  value="<?php if($cle['qte3']!=null){ echo $cle['qte3'];} else {echo 0;}?>" class="form-control"  ></td>
		<td ><input type="text" name="prix3" placeholder="Prix" value="<?php echo $res['prix3']?>" class="form-control" ></td>
		
		
	</tr>
	<tr><td>Art.4</td>
	<td ><textarea style="width:220px; height:100px" name="article4" placeholder="Nom" class="form-control" ><?php echo $res['article4']?></textarea></td>
		<td ><input  type="number" name="qte4"   value="<?php if($cle['qte4']!=null){ echo $cle['qte4'];} else {echo 0;}?>"  class="form-control"  ></td>
		<td ><input type="text" name="prix4" value="<?php echo $res['prix4']?>" placeholder="Prix" class="form-control" ></td>
		
	</tr>
	<tr><td>Art.5</td>
	<td ><textarea style="width:220px; height:100px" name="article5" placeholder="Nom" class="form-control" ><?php echo $res['article5']?></textarea></td>
		<td ><input  type="number" name="qte5"   value="<?php if($cle['qte5']!=null){ echo $cle['qte5'];} else {echo 0;}?>"  class="form-control"  ></td>
		<td ><input type="text" name="prix5" value="<?php echo $res['prix5']?>" placeholder="Prix" class="form-control" ></td>
		
	</tr>
	<tr><td>Art.6</td>
	<td ><textarea style="width:220px; height:100px" name="article6" placeholder="Nom" class="form-control" ><?php echo $res['article6']?></textarea></td>
		<td ><input  type="number" name="qte6"  value="<?php if($cle['qte6']!=null){ echo $cle['qte6'];} else {echo 0;}?>"  class="form-control"  ></td>
		<td ><input type="text"  name="prix6" value="<?php echo $res['prix6']?>"  placeholder="Prix" class="form-control" ></td>
		
	</tr>
	
	<tr><td>Art.7</td>
	<td ><textarea style="width:220px; height:100px" name="article7" placeholder="Nom" class="form-control" ><?php echo $res['article7']?></textarea></td>
		<td ><input  type="number" name="qte7"  value="<?php if($cle['qte7']!=null){ echo $cle['qte7'];} else {echo 0;}?>"  class="form-control"  ></td>
		<td ><input type="text"  name="prix7" value="<?php echo $res['prix7']?>" placeholder="Prix" class="form-control" ></td>
		
	</tr>
	 <?php 
	 @$montant=($brdPonct['prix1']*$cle['qte1'])+($brdPonct['prix2']*$cle['qte2'])+($brdPonct['prix3']*$cle['qte3'])+($brdPonct['prix4']*$cle['qte4'])+($brdPonct['prix5']*$cle['qte5'])+($brdPonct['prix6']*$cle['qte6'])+($brdPonct['prix7']*$cle['qte7']);	
	 ?>
	
	</table>
	 
	 
	 
	 
	 
	 <?php

	 }
	 
	
	 
	 
	 
	 
	
					
				