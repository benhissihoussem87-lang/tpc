<?php
if (isset($_GET['code'])){
	include 'classes/projets.class.php';
	$projet=new Projets();
	 $projetsAjax=$projet->getProjetsAjax();  
	 $rowAjax=count($projetsAjax);
					
					
					if($rowAjax>0)
					{
					foreach($projetsAjax as $titreAjax);
					}
	 ?>
	 <input type="text" readonly value="<?php echo $titreAjax['titre']?>" id="projet" style="padding:6px 0 6px 4px" name="projet" class="form-control" >
					

<?php					
					
				

	
	}