<?php
if (isset($_GET['code_sp'])){
	include 'classes/projets.class.php';
	$projet=new Projets();
	 $projetsAjax=$projet->RechercheAjaxSP();  
	 ?>
	
					<?php 
					
					$row=count($projetsAjax);
					
					if($row>0)
					{
					  echo '<b>Vérifier</b>';
					  
					}
					
					
					
}
