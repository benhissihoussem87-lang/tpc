<?php
if (isset($_GET['projet'])){
	include 'classes/projets.class.php';
	$projet=new Projets();
	 $codesprojetsAjax=$projet->getInfosProjets($_GET['projet']);  
	 ?>
	 <select id="code" style="padding:6px 0 6px 4px" name="code" class="form-control" >
					<?php 
					
					$rowAjax=count($codesprojetsAjax);
					
					
					if($rowAjax>0)
					{
					foreach($codesprojetsAjax as $titreAjax)
					{
					?>
					<option><?php echo $titreAjax['code_projet']?></option>
					
					
					<?php } 
					}
?>
</select>

<?php					
					
				

	
	}