<?php
if (isset($_GET['codeP'])){
	include 'classes/ponctuel.class.php';
	$ponct=new ponctuels();
	 $ponctuelAjax=$ponct->getPonctuelsAjax(); 
					
					$rowAjax=count($ponctuelAjax);
					if($rowAjax>0)
					{
					foreach($ponctuelAjax as $titreAjax);
					}					
	 ?>
	 <input type="text" readonly value="<?php echo $titreAjax['projet']?>" id="projetP" style="padding:6px 0 6px 4px" name="projetP" class="form-control" >
					
					

<?php					
					
				

	
	}