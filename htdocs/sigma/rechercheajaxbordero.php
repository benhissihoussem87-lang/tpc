<script>

$(function(){


/******Gestion type borderaux***********/
 $("#consultation").hide();
 $("#expertise").hide();
$("#consultation_bordero").click(function(){
     $("#consultation").show();
	 var TotBRD=$("#totBRD").val();
	  var TotBRDs=(TotBRD*1.13).toFixed(3);
	   $("#BRDTot").val(TotBRDs);
   $("#expertise").hide();
   //$("#expertise").html("");
   //alert('okoko');

});

$("#expertise_bordero").click(function(){
 var TotBRDExpertise=$("#totBRDExpertise").val();
 var TotBRDExpertiseS=(TotBRDExpertise*1.13).toFixed(3);
	   $("#BRDTot").val(TotBRDExpertiseS);
     $("#consultation").hide();
	// $("#consultation").html("");
   $("#expertise").show();
  

});








/****************/
});


</script>
<table width=100% >

	<tr><td colspan=5>Bordero</td></tr>
	<tr><td>Type</td>
	<td>consultation</td><td><input type="radio" class="form-control" style="width:20px" name="bordero_type" id="consultation_bordero"  value="consultation"></td>
	<td>Expertise</td><td><input type="radio" class="form-control" style="width:20px" name="bordero_type" value="expertise" id="expertise_bordero"></td>
	</tr>
	 

	</table>
	<?php
	include 'classes/bordero.class.php';
	$brd=new Borderos();
	
	
	?>
<div id="consultation">
<?php

   /*****Traitement consultation*****/
	
	 $borderoAjax=$brd->getborderosAjax($_GET['mdo']); 
	 @$rowAjax=count($borderoAjax);
	 
	 if($rowAjax>0)
	 {
	
	 foreach($borderoAjax as $res);
	@$totalBRD=($res['prix1']*$res['qte1'])+($res['prix2']*$res['qte2'])+($res['prix3']*$res['qte3'])+($res['prix4']*$res['qte4'])+($res['prix5']*$res['qte5'])+($res['prix6']*$res['qte6'])+($res['prix7']*$res['qte7'])+($res['prix8']*$res['qte8'])+($res['prix9']*$res['qte9'])+($res['prix10']*$res['qte10'])+($res['prix11']*$res['qte11'])+($res['prix12']*$res['qte12'])+($res['prix13']*$res['qte13'])+($res['prix14']*$res['qte14'])+($res['prix15']*$res['qte15'])+($res['prix16']*$res['qte16'])+($res['prix17']*$res['qte17'])+($res['prix18']*$res['qte19'])+($res['prix20']*$res['qte20']);
	 ?>
	 <input type="hidden" id="totBRD" value="<?php echo $totalBRD?>">
	<table>
	<tr><td>Art.1</td>
	<td ><textarea style="width:250px; height:100px" name="article1" placeholder="Nom" class="form-control" ><?php echo $res['article1']?></textarea></td>
		<td ><input  type="number" name="qte1"  value="<?php echo $res['qte1']?>" class="form-control"  ></td>
		<td ><input  type="text" name="prix1"  placeholder="Prix" class="form-control"  value="<?php echo $res['prix1']?>" ></td>
		
	</tr>
	<tr><td>Art.2</td>
	<td ><textarea style="width:250px; height:100px" name="article2" placeholder="Nom" class="form-control" ><?php echo $res['article2']?></textarea></td>
		<td ><input  type="number" name="qte2"  value="<?php echo $res['qte2']?>" class="form-control"  ></td>
		<td ><input type="text" name="prix2" placeholder="Prix" class="form-control" value="<?php echo $res['prix2']?>"></td>
		
	</tr>
	<tr><td>Art.3</td>
	<td ><textarea style="width:250px; height:100px" name="article3" placeholder="Nom" class="form-control" ><?php echo $res['article3']?></textarea></td>
		<td ><input  type="number" name="qte3"  value="<?php echo $res['qte3']?>" class="form-control"  ></td>
		<td ><input type="text" name="prix3" placeholder="Prix" class="form-control" value="<?php echo $res['prix3']?>"></td>
		
		
	</tr>
	<tr><td>Art.4</td>
	<td ><textarea style="width:250px; height:100px" name="article4" placeholder="Nom" class="form-control" ><?php echo $res['article4']?></textarea></td>
		<td ><input  type="number" name="qte4"  value="<?php echo $res['qte4']?>" class="form-control"  ></td>
		<td ><input type="text" name="prix4" placeholder="Prix" class="form-control" value="<?php echo $res['prix4']?>" ></td>
		
	</tr>
	<tr><td>Art.5</td>
	<td ><textarea style="width:250px; height:100px" name="article5" placeholder="Nom" class="form-control" ><?php echo $res['article5']?></textarea></td>
		<td ><input  type="number" name="qte5"  value="<?php echo $res['qte5']?>" class="form-control"  ></td>
		<td ><input type="text" name="prix5" placeholder="Prix" class="form-control" value="<?php echo $res['prix5']?>" ></td>
		
	</tr>
	<tr><td>Art.6</td>
	<td ><textarea style="width:250px; height:100px" name="article6" placeholder="Nom" class="form-control" ><?php echo $res['article6']?></textarea></td>
		<td ><input  type="number" name="qte6"  value="<?php echo $res['qte6']?>" class="form-control"  ></td>
		<td ><input type="text"  name="prix6" placeholder="Prix" class="form-control" value="<?php echo $res['prix6']?>" ></td>
		
	</tr>
	
	<tr><td>Art.7</td>
	<td ><textarea style="width:250px; height:100px" name="article7" placeholder="Nom" class="form-control" ><?php echo $res['article7']?></textarea></td>
		<td ><input  type="number" name="qte7"  value="<?php echo $res['qte7']?>" class="form-control"  ></td>
		<td ><input type="text"  name="prix7" placeholder="Prix" class="form-control" value="<?php echo $res['prix7']?>"></td>
		
	</tr>
	<tr><td>Art.8</td>
	<td ><textarea style="width:250px; height:100px" name="article8" placeholder="Nom" class="form-control" ><?php echo $res['article8']?></textarea></td>
		<td ><input  type="number" name="qte8"  value="<?php echo $res['qte8']?>" class="form-control"  ></td>
		<td ><input type="text"  name="prix8" placeholder="Prix" class="form-control" value="<?php echo $res['prix8']?>"></td>
		
	</tr>
	<tr><td>Art.9</td>
	<td ><textarea style="width:250px; height:100px" name="article9" placeholder="Nom" class="form-control" ><?php echo $res['article9']?></textarea></td>
		<td ><input  type="number" name="qte9"  value="<?php echo $res['qte9']?>" class="form-control"  ></td>
		<td ><input type="text" name="prix9" placeholder="Prix" class="form-control" value="<?php echo $res['prix9']?>"></td>
		
	</tr>
	<tr><td>Art.10</td>
	<td ><textarea style="width:250px; height:100px" name="article10" placeholder="Nom" class="form-control" ><?php echo $res['article10']?></textarea></td>
		<td ><input  type="number" name="qte10" value="<?php echo $res['qte10']?>" class="form-control"  value="<?php echo $res['prix10']?>"></td>
		<td ><input type="text" name="prix10" placeholder="Prix" class="form-control" value="<?php echo $res['prix10']?>" ></td>
		
	</tr>
	
	<tr><td>Art.11</td>
	<td ><textarea style="width:250px; height:100px" name="article11" placeholder="Nom" class="form-control" ><?php echo $res['article11']?></textarea></td>
		<td ><input  type="number" name="qte11"  value="<?php echo $res['qte11']?>" class="form-control"  value="<?php echo $res['prix11']?>"></td>
		<td ><input type="text" name="prix11" placeholder="Prix" class="form-control" value="<?php echo $res['prix11']?>" ></td>
		
	</tr>
	<tr><td>Art.12</td>
	<td ><textarea style="width:250px; height:100px" name="article12" placeholder="Nom" class="form-control" ><?php echo $res['article12']?></textarea></td>
		<td ><input  type="number" name="qte12"  value="<?php echo $res['qte12']?>" class="form-control" value="<?php echo $res['prix12']?>" ></td>
		<td ><input type="text" name="prix12" placeholder="Prix" class="form-control" value="<?php echo $res['prix12']?>" ></td>
		
	</tr>
	<tr><td>Art.13</td>
	<td ><textarea style="width:250px; height:100px" name="article13" placeholder="Nom" class="form-control" ><?php echo $res['article13']?></textarea></td>
		<td ><input  type="number" name="qte13"  value="<?php echo $res['qte13']?>" class="form-control"  ></td>
		<td ><input type="text" name="prix13" placeholder="Prix" class="form-control" value="<?php echo $res['prix13']?>"></td>
		
	</tr>
	<tr><td>Art.14</td>
	<td ><textarea style="width:250px; height:100px" name="article14" placeholder="Nom" class="form-control" ><?php echo $res['article14']?></textarea></td>
			<td ><input  type="number" name="qte14"  value="<?php echo $res['qte14']?>" class="form-control"  ></td>
		<td ><input type="text"  name="prix14" placeholder="Prix" class="form-control" value="<?php echo $res['prix14']?>"></td>
	
	</tr>
	
	<tr><td>Art.15</td>
	<td ><textarea style="width:250px; height:100px" name="article15" placeholder="Nom" class="form-control" ><?php echo $res['article15']?></textarea></td>
		<td ><input  type="number" name="qte15"  value="<?php echo $res['qte15']?>" class="form-control"  ></td>
		<td ><input type="text"  name="prix15" placeholder="Prix" class="form-control" value="<?php echo $res['prix15']?>"></td>
		
	</tr>
	<tr><td>Art.16</td>
	<td ><textarea style="width:250px; height:100px" name="article16" placeholder="Nom" class="form-control" ><?php echo $res['article16']?></textarea></td>
	<td ><input  type="number" name="qte16" value="<?php echo $res['qte16']?>" class="form-control"  ></td>
		<td ><input type="text"  name="prix16" placeholder="Prix" class="form-control" value="<?php echo $res['prix16']?>"></td>
		
	</tr>
	<tr><td>Art.17</td>
	<td ><textarea style="width:250px; height:100px" name="article17" placeholder="Nom" class="form-control" ><?php echo $res['article17']?></textarea></td>
		<td ><input  type="number" name="qte17" value="<?php echo $res['qte17']?>" class="form-control"  ></td>
		<td ><input type="text" name="prix17" placeholder="Prix" class="form-control" value="<?php echo $res['prix17']?>" ></td>
		
	</tr>
	<tr><td>Art.18</td>
	<td ><textarea style="width:250px; height:100px" name="article18" placeholder="Nom" class="form-control" ><?php echo $res['article18']?></textarea></td>
		<td ><input  type="number" name="qte18"  value="<?php echo $res['qte18']?>" class="form-control"  ></td>
		<td ><input type="text" name="prix18" placeholder="Prix" class="form-control" value="<?php echo $res['prix18']?>"></td>
		
	</tr>
	
	<tr><td>Art.19</td>
	<td ><textarea style="width:250px; height:100px" name="article19" placeholder="Nom" class="form-control" ><?php echo $res['article19']?></textarea></td>
		<td ><input  type="number" name="qte19"  value="<?php echo $res['qte19']?>" class="form-control"  ></td>
		<td ><input type="text" name="prix19" placeholder="Prix" class="form-control" value="<?php echo $res['prix19']?>"></td>
		
	</tr>
	<tr><td>Art.20</td>
	<td ><textarea style="width:250px; height:100px" name="article20" placeholder="Nom" class="form-control" ><?php echo $res['article20']?></textarea></td>
		<td ><input  type="number" name="qte20"  value="<?php echo $res['qte20']?>" class="form-control"  ></td>
		<td ><input type="text" name="prix20" placeholder="Prix" class="form-control" value="<?php echo $res['prix20']?>"></td>
		
	</tr>
	</table>
	 
	 
	 
	 
	 
	 <?php

	 }
	 else if($rowAjax==0)
	 {
	 ?>
	 
	
	
	
	<table >
	<tr><td>Art.1</td>
	<td ><textarea style="width:250px; height:100px" name="article1" placeholder="Nom" class="form-control" ></textarea></td>
	<td ><input  type="number" name="qte1"  value="1" class="form-control"  ></td>
		<td ><input  type="text" name="prix1"  placeholder="Prix" class="form-control"  ></td>
		
	</tr>
	<tr><td>Art.2</td>
	<td ><textarea style="width:250px; height:100px" name="article2" placeholder="Nom" class="form-control" ></textarea></td>
			<td ><input  type="number" name="qte2"  value="1" class="form-control"  ></td>
		<td ><input type="text" name="prix2" placeholder="Prix" class="form-control" ></td>

	</tr>
	
	
	
	<tr><td>Art.3</td>
	<td ><textarea style="width:250px; height:100px" name="article3" placeholder="Nom" class="form-control" ></textarea></td>
	<td ><input  type="number" name="qte3"  value="1" class="form-control"  ></td>
		<td ><input type="text" name="prix3" placeholder="Prix" class="form-control" ></td>
		
		
	</tr>
	<tr><td>Art.4</td>
	<td ><textarea style="width:250px; height:100px" name="article4" placeholder="Nom" class="form-control" ></textarea></td>
	<td ><input  type="number" name="qte4"  value="1" class="form-control"  ></td>
		<td ><input type="text" name="prix4" placeholder="Prix" class="form-control" ></td>
		
	</tr>
	<tr><td>Art.5</td>
	<td ><textarea style="width:250px; height:100px" name="article5" placeholder="Nom" class="form-control" ></textarea></td>
	<td ><input  type="number" name="qte5"  value="1" class="form-control"  ></td>
		<td ><input type="text" name="prix5" placeholder="Prix" class="form-control" ></td>
		
	</tr>
	<tr><td>Art.6</td>
	<td ><textarea style="width:250px; height:100px" name="article6" placeholder="Nom" class="form-control" ></textarea></td>
		<td ><input  type="number" name="qte6"  value="1" class="form-control"  ></td>
		<td ><input type="text"  name="prix6" placeholder="Prix" class="form-control" ></td>
	
	</tr>
	
	<tr><td>Art.7</td>
	<td ><textarea style="width:250px; height:100px" name="article7" placeholder="Nom" class="form-control" ></textarea></td>
		<td ><input  type="number" name="qte7"  value="1" class="form-control"  ></td>
		<td ><input type="text"  name="prix7" placeholder="Prix" class="form-control" ></td>
		
	</tr>
	<tr><td>Art.8</td>
	<td ><textarea style="width:250px; height:100px" name="article8" placeholder="Nom" class="form-control" ></textarea></td>
	<td ><input  type="number" name="qte8"  value="1" class="form-control"  ></td>
		<td ><input type="text"  name="prix8" placeholder="Prix" class="form-control" ></td>
		
	</tr>
	<tr><td>Art.9</td>
	<td ><textarea style="width:250px; height:100px" name="article9" placeholder="Nom" class="form-control" ></textarea></td>
	<td ><input  type="number" name="qte9"  value="1" class="form-control"  ></td>
		<td ><input type="text" name="prix9" placeholder="Prix" class="form-control" ></td>
		
	</tr>
	<tr><td>Art.10</td>
	<td ><textarea style="width:250px; height:100px" name="article10" placeholder="Nom" class="form-control" ></textarea></td>
	<td ><input  type="number" name="qte10"  value="1" class="form-control"  ></td>
		<td ><input type="text" name="prix10" placeholder="Prix" class="form-control" ></td>
		
	</tr>
	
	<tr><td>Art.11</td>
	<td ><textarea style="width:250px; height:100px" name="article11" placeholder="Nom" class="form-control" ></textarea></td>
	<td ><input  type="number" name="qte11"  value="1" class="form-control"  ></td>
		<td ><input type="text" name="prix11" placeholder="Prix" class="form-control" ></td>
		
	</tr>
	<tr><td>Art.12</td>
	<td ><textarea style="width:250px; height:100px" name="article12" placeholder="Nom" class="form-control" ></textarea></td>
	<td ><input  type="number" name="qte12"  value="1" class="form-control"  ></td>
		<td ><input type="text" name="prix12" placeholder="Prix" class="form-control" ></td>
		
	</tr>
	<tr><td>Art.13</td>
	<td ><textarea style="width:250px; height:100px" name="article13" placeholder="Nom" class="form-control" ></textarea></td>
	<td ><input  type="number" name="qte13"  value="1" class="form-control"  ></td>
		<td ><input type="text" name="prix13" placeholder="Prix" class="form-control" ></td>
		
	</tr>
	<tr><td>Art.14</td>
	<td ><textarea style="width:250px; height:100px" name="article14" placeholder="Nom" class="form-control" ></textarea></td>
		<td ><input  type="number" name="qte14"  value="1" class="form-control"  ></td>
		<td ><input type="text"  name="prix14" placeholder="Prix" class="form-control" ></td>
	
	</tr>
	
	<tr><td>Art.15</td>
	<td ><textarea style="width:250px; height:100px" name="article15" placeholder="Nom" class="form-control" ></textarea></td>
		<td ><input  type="number" name="qte15"  value="1" class="form-control"  ></td>
		<td ><input type="text"  name="prix15" placeholder="Prix" class="form-control" ></td>
	
	</tr>
	<tr><td>Art.16</td>
	<td ><textarea style="width:250px; height:100px" name="article16" placeholder="Nom" class="form-control" ></textarea></td>
	<td ><input  type="number" name="qte16"  value="1" class="form-control"  ></td>
		<td ><input type="text"  name="prix16" placeholder="Prix" class="form-control" ></td>
		
	</tr>
	<tr><td>Art.17</td>
	<td ><textarea style="width:250px;" name="article17" placeholder="Nom" class="form-control" ></textarea></td>
	<td ><input  type="number" name="qte17"  value="1" class="form-control"  ></td>
		<td ><input type="text" name="prix17" placeholder="Prix" class="form-control" ></td>
		
	</tr>
	<tr><td>Art.18</td>
	<td ><textarea style="width:250px; height:100px" name="article18" placeholder="Nom" class="form-control" ></textarea></td>
	<td ><input  type="number" name="qte18"  value="1" class="form-control"  ></td>
		<td ><input type="text" name="prix18" placeholder="Prix" class="form-control" ></td>
		
	</tr>
	
	<tr><td>Art.19</td>
	<td ><textarea style="width:250px; height:100px" name="article19" placeholder="Nom" class="form-control" ></textarea></td>
	<td ><input  type="number" name="qte19"  value="1" class="form-control"  ></td>
		<td ><input type="text" name="prix19" placeholder="Prix" class="form-control" ></td>
		
	</tr>
	<tr><td>Art.20</td>
	<td ><textarea style="width:250px; height:100px" name="article20" placeholder="Nom" class="form-control" ></textarea></td>
	<td ><input  type="number" name="qte20"  value="1" class="form-control"  ></td>
		<td ><input type="text" name="prix20" placeholder="Prix" class="form-control" ></td>
		
	</tr>
	</table>
	 
	
	 
	 
	 <?php
	//}
	
	}
	?>
</div>
<!--Traitement Expertise-->
<div id="expertise">
<?php

	
	 $borderoAjaxExpertise=$brd->getborderosAjaxExpertise($_GET['mdo']); 
	 $rowAjaxExpertise=count($borderoAjaxExpertise);
	 if($rowAjaxExpertise>0)
	{
	 foreach($borderoAjaxExpertise as $resExpertise);
	 $totalBRDExpertise=($resExpertise['prix1']*$resExpertise['qte1'])+($resExpertise['prix2']*$resExpertise['qte2'])+($resExpertise['prix3']*$resExpertise['qte3'])+($resExpertise['prix4']*$resExpertise['qte4'])+($resExpertise['prix5']*$resExpertise['qte5'])+($resExpertise['prix6']*$resExpertise['qte6'])+($resExpertise['prix7']*$resExpertise['qte7']);
	
	 ?>
	 <input type="hidden" id="totBRDExpertise" value="<?php echo $totalBRDExpertise?>">
	
	<table >
	<tr><td>Art.1</td>
	<td ><textarea style="width:250px; height:100px" name="Expertise_article1" placeholder="Nom" class="form-control" ><?php echo $resExpertise['article1']?></textarea></td>
	<td ><input  type="number" name="Expertise_qte1"  value="<?php echo $resExpertise['qte1']?>" class="form-control"  ></td>
		<td ><input  type="text" name="Expertise_prix1" value="<?php echo $resExpertise['prix1']?>"  placeholder="Prix" class="form-control" ></td>
		
	</tr>
	<tr><td>Art.2</td>
	<td ><textarea style="width:250px; height:100px" name="Expertise_article2" placeholder="Nom" class="form-control" ><?php echo $resExpertise['article2']?></textarea></td>
	<td ><input  type="number" name="Expertise_qte2"  value="<?php echo $resExpertise['qte2']?>" class="form-control"  ></td>
		<td ><input type="text" name="Expertise_prix2" value="<?php echo $resExpertise['prix2']?>" placeholder="Prix" class="form-control" ></td>
		
	</tr>
	<tr><td>Art.3</td>
	<td ><textarea style="width:250px; height:100px" name="Expertise_article3" placeholder="Nom" class="form-control" ><?php echo $resExpertise['article3']?></textarea></td>
	<td ><input  type="number" name="Expertise_qte3"  value="<?php echo $resExpertise['qte3']?>" class="form-control"  ></td>
		<td ><input type="text" name="Expertise_prix3" placeholder="Prix" class="form-control" value="<?php echo $resExpertise['prix3']?>" ></td>
		
		
	</tr>
	<tr><td>Art.4</td>
	<td ><textarea style="width:250px; height:100px" name="Expertise_article4" placeholder="Nom" class="form-control" ><?php echo $resExpertise['article4']?></textarea></td>
		<td ><input  type="number" name="Expertise_qte4" value="<?php echo $resExpertise['qte4']?>" class="form-control"  ></td>
		<td ><input type="text" name="Expertise_prix4" placeholder="Prix" class="form-control" value="<?php echo $resExpertise['prix4']?>"></td>
	
	</tr>
	<tr><td>Art.5</td>
	<td ><textarea style="width:250px; height:100px" name="Expertise_article5" placeholder="Nom" class="form-control" ><?php echo $resExpertise['article5']?></textarea></td>
	<td ><input  type="number" name="Expertise_qte5"  value="<?php echo $resExpertise['qte5']?>" class="form-control"  ></td>
		<td ><input type="text" name="Expertise_prix5" placeholder="Prix" class="form-control" value="<?php echo $resExpertise['prix5']?>" ></td>
		
	</tr>
	<tr><td>Art.6</td>
	<td ><textarea style="width:250px; height:100px" name="Expertise_article6" placeholder="Nom" class="form-control" ><?php echo $resExpertise['article6']?></textarea></td>
	<td ><input  type="number" name="Expertise_qte6"  value="<?php echo $resExpertise['qte6']?>" class="form-control"  ></td>
		<td ><input type="text"  name="Expertise_prix6" placeholder="Prix" class="form-control" value="<?php echo $resExpertise['prix6']?>" ></td>
		
	</tr>
	
	<tr><td>Art.7</td>
	<td ><textarea style="width:250px; height:100px" name="Expertise_article7" placeholder="Nom" class="form-control" ><?php echo $resExpertise['article7']?></textarea></td>
	<td ><input  type="number" name="Expertise_qte7"  value="<?php echo $resExpertise['qte7']?>" class="form-control"  ></td>
		<td ><input type="text"  name="Expertise_prix7" placeholder="Prix" class="form-control" value="<?php echo $resExpertise['prix7']?>"></td>
		
	</tr>
	</table>
	<?php } else if($rowAjaxExpertise==0){?>
	<table >
	<tr><td>Art.1</td>
	<td ><textarea style="width:250px; height:100px" name="Expertise_article1" placeholder="Nom" class="form-control" ></textarea></td>
	<td ><input  type="number" name="Expertise_qte1"  value="1" class="form-control"  ></td>
		<td ><input  type="text" name="Expertise_prix1"  placeholder="Prix" class="form-control" ></td>
		
	</tr>
	<tr><td>Art.2</td>
	<td ><textarea style="width:250px; height:100px" name="Expertise_article2" placeholder="Nom" class="form-control" ></textarea></td>
		<td ><input  type="number" name="Expertise_qte2"  value="1" class="form-control"  ></td>
	<td ><input type="text" name="Expertise_prix2" placeholder="Prix" class="form-control" ></td>

		
		
	</tr>
	<tr><td>Art.3</td>
	<td ><textarea style="width:250px; height:100px" name="Expertise_article3" placeholder="Nom" class="form-control" ></textarea></td>
	<td ><input  type="number" name="Expertise_qte3"  value="1" class="form-control"  ></td>
		<td ><input type="text" name="Expertise_prix3" placeholder="Prix" class="form-control" ></td>
		
		
	</tr>
	<tr><td>Art.4</td>
	<td ><textarea style="width:250px; height:100px" name="Expertise_article4" placeholder="Nom" class="form-control" ></textarea></td>
	<td ><input  type="number" name="Expertise_qte4"  value="1" class="form-control"  ></td>
		<td ><input type="text" name="Expertise_prix4" placeholder="Prix" class="form-control" ></td>
		
	</tr>
	<tr><td>Art.5</td>
	<td ><textarea style="width:250px; height:100px" name="Expertise_article5" placeholder="Nom" class="form-control" ></textarea></td>
	<td ><input  type="number" name="Expertise_qte5"  value="1" class="form-control"  ></td>
		<td ><input type="text" name="Expertise_prix5" placeholder="Prix" class="form-control" ></td>
		
	</tr>
	<tr><td>Art.6</td>
	<td ><textarea style="width:250px; height:100px" name="Expertise_article6" placeholder="Nom" class="form-control" ></textarea></td>
	<td ><input  type="number" name="Expertise_qte6"  value="1" class="form-control"  ></td>
		<td ><input type="text"  name="Expertise_prix6" placeholder="Prix" class="form-control" ></td>
		
	</tr>
	
	<tr><td>Art.7</td>
	<td ><textarea style="width:250px; height:100px" name="Expertise_article7" placeholder="Nom" class="form-control" ></textarea></td>
	<td ><input  type="number" name="Expertise_qte7"  value="1" class="form-control"  ></td>
		<td ><input type="text"  name="Expertise_prix7" placeholder="Prix" class="form-control" ></td>
		
	</tr>
	</table>
	
	<!--Fin #expertise-->
	
	  
	 <?php
	
	
	}
	?>
	 </div>
	 
	 
	
					
				