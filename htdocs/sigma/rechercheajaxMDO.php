<?php
if (isset($_GET['code'])){
	include 'classes/projets.class.php';
	$projet=new Projets();
	 $projetsAjax=$projet->getProjetsAjax();  
	 	 $projetsAjaxSP=$projet->getProjetsAjaxSP();  
	 ?>
	
	
<table  width=100%>

<tr>
<td width=50%>
<label for="phase">MDO</label>
<?php 
					
					$rowAjax=count($projetsAjax);
					
					
					if($rowAjax>0)
					{
					foreach($projetsAjax as $titreAjax);
					}?>
	 <input type="text" id="mdo" value="<?php echo $titreAjax['mdo']?>"  readonly style="padding:6px 0 6px 4px;float:left;;width:100%" name="mdo" class="form-control" >

</td>

<td width=50%>
<?php
					
					@$rowAjaxSP=count($projetsAjaxSP);
					
					
					if($rowAjaxSP>0)
					{?>
<label for="phase">Code SP</label>
 <select id="SP" style="padding:6px 0 6px 4px;float:left;width:100%" name="codeSP" class="form-control" >
					<?php
					foreach($projetsAjaxSP as $titreAjaxSP)
					{
					?>
					<option><?php echo $titreAjaxSP['code_sous_P']?></option>
					
					
					<?php  
					}
?>
</select>
<?php } ?>
 </td></tr>
 </table>
<?php					
}
else if (isset($_GET['projet'])){
	include 'classes/projets.class.php';
	$projet=new Projets();
	 $projetsAjax=$projet->getProjetsAjax();  
	 $rowAjax=count($projetsAjax);
					
					
					if($rowAjax>0)
					{
					foreach($projetsAjax as $titreAjax);
					}
	 ?>
	 <input type="text" id="mdo" value="<?php echo $titreAjax['mdo']?>"  readonly style="padding:6px 0 6px 4px" name="mdo" class="form-control" >
					
<?php
}
?>