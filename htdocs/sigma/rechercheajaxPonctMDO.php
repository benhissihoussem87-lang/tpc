<?php

if(isset($_GET['codeP'])){

	include 'classes/ponctuel.class.php';
	$ponct=new ponctuels();
	 $ponctAjax=$ponct->getMDOPONCTAjax();  
	 	// $projetsAjaxSP=$projet->getProjetsAjaxSP();  
		$rowAjax=count($ponctAjax);
					
					
					if($rowAjax>0)
					{
					foreach($ponctAjax as $titreAjax);}
	 ?>
	
	
<table  width=100%>

<tr>
<td width=50%>
<label for="phase">MDO</label>
	 <input type="text" value="<?php echo $titreAjax['mdo']?>" readonly id="mdo" style="padding:6px 0 6px 4px;float:left;;width:100%" name="mdo" class="form-control" >
					
</td>

<!-- <td width=50%>
 <select id="SP" style="padding:6px 0 6px 4px;float:left;width:100%" name="codeSP" class="form-control" >
					<?php 
					/*
					$rowAjaxSP=count($projetsAjaxSP);
					
					
					if($rowAjaxSP>0)
					{
					foreach($projetsAjaxSP as $titreAjaxSP)
					{
					?>
					<option><?php echo $titreAjaxSP['code_sous_P']?></option>
					
					
					<?php } 
					}*/
?>
</select>
 </td> --></tr>
 </table>
<?php					
}
else if (isset($_GET['projetP'])){
	include 'classes/projets.class.php';
	$projet=new Projets();
	 $projetsAjax=$projet->getProjetsAjax();  
	 ?>
	 <select id="mdo" style="padding:6px 0 6px 4px" name="mdo" class="form-control" >
					<?php 
					
					$rowAjax=count($projetsAjax);
					
					
					if($rowAjax>0)
					{
					foreach($projetsAjax as $titreAjax)
					{
					?>
					<option><?php echo $titreAjax['mdo']?></option>
					
					
					<?php } 
					}
?>
</select>
<?php
}
?>