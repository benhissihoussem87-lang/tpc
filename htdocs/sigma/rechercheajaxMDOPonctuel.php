
<?php
if (isset($_GET['ponct'])){
	include 'classes/bordero.class.php';
	$brd=new Borderos();
	$code='00000';
	 $borderoAjax=$brd->getborderosAjaxPonctuel($code); 
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

	<table >
	<tr><td>Art.1</td>
	<td ><textarea style="width:260px; height:100px" name="article1" placeholder="Nom" class="form-control" ><?php echo $res['article1']?></textarea></td>
	
		<td ><input  type="number" style="width:60px;" name="qte1"  value="1" class="form-control"  ></td>
			<td ><input  type="text" style="width:80px;" name="prix1"  placeholder="Prix" class="form-control" ></td>
	</tr>
	<tr><td>Art.2</td>
	<td ><textarea style="width:260px; height:100px" name="article2" placeholder="Nom" class="form-control" ><?php echo $res['article2']?></textarea></td>
		<td ><input  type="number" name="qte2"  value="1" class="form-control"  ></td>
		<td ><input type="text" name="prix2" placeholder="Prix" class="form-control" ></td>
		
	</tr>
	</table>
	
	<div id="consultation">
	<table>
	<tr><td>Art.3</td>
	<td ><textarea style="width:260px; height:100px" name="article3" placeholder="Nom" class="form-control" ><?php echo $res['article3']?></textarea></td>
		<td ><input  type="number" name="qte3"  value="1" class="form-control"  ></td>
		<td ><input type="text" name="prix3" placeholder="Prix" class="form-control" ></td>
		
		
	</tr>
	<tr><td>Art.4</td>
	<td ><textarea style="width:260px; height:100px" name="article4" placeholder="Nom" class="form-control" ><?php echo $res['article4']?></textarea></td>
		<td ><input  type="number" name="qte4"  value="1" class="form-control"  ></td>
		<td ><input type="text" name="prix4" placeholder="Prix" class="form-control" ></td>
		
	</tr>
	<tr><td>Art.5</td>
	<td ><textarea style="width:260px; height:100px" name="article5" placeholder="Nom" class="form-control" ><?php echo $res['article5']?></textarea></td>
		<td ><input  type="number" name="qte5"  value="1" class="form-control"  ></td>
		<td ><input type="text" name="prix5" placeholder="Prix" class="form-control" ></td>
		
	</tr>
	<tr><td>Art.6</td>
	<td ><textarea style="width:260px; height:100px" name="article6" placeholder="Nom" class="form-control" ><?php echo $res['article6']?></textarea></td>
		<td ><input  type="number" name="qte6"  value="1" class="form-control"  ></td>
		<td ><input type="text"  name="prix6" placeholder="Prix" class="form-control" ></td>
		
	</tr>
	
	<tr><td>Art.7</td>
	<td ><textarea style="width:260px; height:100px" name="article7" placeholder="Nom" class="form-control" ><?php echo $res['article7']?></textarea></td>
		<td ><input  type="number" name="qte7"  value="1" class="form-control"  ></td>
		<td ><input type="text"  name="prix7" placeholder="Prix" class="form-control" ></td>
		
	</tr>
	
	
	</table>
	 
	 
	 
	 
	 
	 <?php

	 }
	 else if($rowAjax==0)
	 {
	 ?>
	 
	 <table width=100% >
	<tr><td colspan=5>Bordero</td></tr>
	<tr><td>Type</td>
	<td>consultation</td><td><input type="radio" class="form-control" style="width:20px" name="bordero_type" id="consultation_bordero" value="consultation"></td>
	<td>Expertise</td><td><input type="radio" class="form-control" style="width:20px" name="bordero_type" value="expertise" id="expertise_bordero"></td>
	</tr>
	</table>
	<div id="expertise">
	<table >
	<tr><td>Art.1</td>
	<td ><textarea style="width:260px; height:100px" name="article1" placeholder="Nom" class="form-control" ></textarea></td>
		<td ><input  type="text" name="prix1"  placeholder="Prix" class="form-control" ></td>
		<td ><input  type="number" name="qte1"  value="1" class="form-control"  ></td>
	</tr>
	<tr><td>Art.2</td>
	<td ><textarea style="width:260px; height:100px" name="article2" placeholder="Nom" class="form-control" ></textarea></td>
		<td ><input type="text" name="prix2" placeholder="Prix" class="form-control" ></td>
		<td ><input  type="number" name="qte2"  value="1" class="form-control"  ></td>
	</tr>
	</table>
	</div><!--Fin #expertise-->
	<div id="consultation">
	<table>
	<tr><td>Art.3</td>
	<td ><textarea style="width:260px; height:100px" name="article3" placeholder="Nom" class="form-control" ></textarea></td>
		<td ><input type="text" name="prix3" placeholder="Prix" class="form-control" ></td>
		<td ><input  type="number" name="qte3"  value="1" class="form-control"  ></td>
		
	</tr>
	<tr><td>Art.4</td>
	<td ><textarea style="width:260px; height:100px" name="article4" placeholder="Nom" class="form-control" ></textarea></td>
		<td ><input type="text" name="prix4" placeholder="Prix" class="form-control" ></td>
		<td ><input  type="number" name="qte4"  value="1" class="form-control"  ></td>
	</tr>
	<tr><td>Art.5</td>
	<td ><textarea style="width:260px; height:100px" name="article5" placeholder="Nom" class="form-control" ></textarea></td>
		<td ><input type="text" name="prix5" placeholder="Prix" class="form-control" ></td>
		<td ><input  type="number" name="qte5"  value="1" class="form-control"  ></td>
	</tr>
	<tr><td>Art.6</td>
	<td ><textarea style="width:260px; height:100px" name="article6" placeholder="Nom" class="form-control" ></textarea></td>
		<td ><input type="text"  name="prix6" placeholder="Prix" class="form-control" ></td>
		<td ><input  type="number" name="qte6"  value="1" class="form-control"  ></td>
	</tr>
	
	<tr><td>Art.7</td>
	<td ><textarea style="width:260px; height:100px" name="article7" placeholder="Nom" class="form-control" ></textarea></td>
		<td ><input type="text"  name="prix7" placeholder="Prix" class="form-control" ></td>
		<td ><input  type="number" name="qte7"  value="1" class="form-control"  ></td>
	</tr>
	<tr><td>Art.8</td>
	<td ><textarea style="width:260px; height:100px" name="article8" placeholder="Nom" class="form-control" ></textarea></td>
		<td ><input type="text"  name="prix8" placeholder="Prix" class="form-control" ></td>
		<td ><input  type="number" name="qte8"  value="1" class="form-control"  ></td>
	</tr>
	<tr><td>Art.9</td>
	<td ><textarea style="width:260px; height:100px" name="article9" placeholder="Nom" class="form-control" ></textarea></td>
		<td ><input type="text" name="prix9" placeholder="Prix" class="form-control" ></td>
		<td ><input  type="number" name="qte9"  value="1" class="form-control"  ></td>
	</tr>
	<tr><td>Art.10</td>
	<td ><textarea style="width:260px; height:100px" name="article10" placeholder="Nom" class="form-control" ></textarea></td>
		<td ><input type="text" name="prix10" placeholder="Prix" class="form-control" ></td>
		<td ><input  type="number" name="qte10"  value="1" class="form-control"  ></td>
	</tr>
	
	<tr><td>Art.11</td>
	<td ><textarea style="width:260px; height:100px" name="article11" placeholder="Nom" class="form-control" ></textarea></td>
		<td ><input type="text" name="prix11" placeholder="Prix" class="form-control" ></td>
		<td ><input  type="number" name="qte11"  value="1" class="form-control"  ></td>
	</tr>
	<tr><td>Art.12</td>
	<td ><textarea style="width:260px; height:100px" name="article12" placeholder="Nom" class="form-control" ></textarea></td>
		<td ><input type="text" name="prix12" placeholder="Prix" class="form-control" ></td>
		<td ><input  type="number" name="qte12"  value="1" class="form-control"  ></td>
	</tr>
	<tr><td>Art.13</td>
	<td ><textarea style="width:260px; height:100px" name="article13" placeholder="Nom" class="form-control" ></textarea></td>
		<td ><input type="text" name="prix13" placeholder="Prix" class="form-control" ></td>
		<td ><input  type="number" name="qte13"  value="1" class="form-control"  ></td>
	</tr>
	<tr><td>Art.14</td>
	<td ><textarea style="width:260px; height:100px" name="article14" placeholder="Nom" class="form-control" ></textarea></td>
		<td ><input type="text"  name="prix14" placeholder="Prix" class="form-control" ></td>
		<td ><input  type="number" name="qte14"  value="1" class="form-control"  ></td>
	</tr>
	
	<tr><td>Art.15</td>
	<td ><textarea style="width:260px; height:100px" name="article15" placeholder="Nom" class="form-control" ></textarea></td>
		<td ><input type="text"  name="prix15" placeholder="Prix" class="form-control" ></td>
		<td ><input  type="number" name="qte15"  value="1" class="form-control"  ></td>
	</tr>
	<tr><td>Art.16</td>
	<td ><textarea style="width:260px; height:100px" name="article16" placeholder="Nom" class="form-control" ></textarea></td>
		<td ><input type="text"  name="prix16" placeholder="Prix" class="form-control" ></td>
		<td ><input  type="number" name="qte16"  value="1" class="form-control"  ></td>
	</tr>
	<tr><td>Art.17</td>
	<td ><textarea style="width:260px;" name="article17" placeholder="Nom" class="form-control" ></textarea></td>
		<td ><input type="text" name="prix17" placeholder="Prix" class="form-control" ></td>
		<td ><input  type="number" name="qte17"  value="1" class="form-control"  ></td>
	</tr>
	<tr><td>Art.18</td>
	<td ><textarea style="width:260px; height:100px" name="article18" placeholder="Nom" class="form-control" ></textarea></td>
		<td ><input type="text" name="prix18" placeholder="Prix" class="form-control" ></td>
		<td ><input  type="number" name="qte18"  value="1" class="form-control"  ></td>
	</tr>
	
	<tr><td>Art.19</td>
	<td ><textarea style="width:260px; height:100px" name="article19" placeholder="Nom" class="form-control" ></textarea></td>
		<td ><input type="text" name="prix19" placeholder="Prix" class="form-control" ></td>
		<td ><input  type="number" name="qte19"  value="1" class="form-control"  ></td>
	</tr>
	<tr><td>Art.20</td>
	<td ><textarea style="width:260px; height:100px" name="article20" placeholder="Nom" class="form-control" ></textarea></td>
		<td ><input type="text" name="prix20" placeholder="Prix" class="form-control" ></td>
		<td ><input  type="number" name="qte20"  value="1" class="form-control"  ></td>
	</tr>
	</table>
	 
	 
	 
	 
	 <?php
	}
	
	}
	
	 
	 
	 
	 
	
					
				