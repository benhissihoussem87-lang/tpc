<?php
if (isset($_GET['code'])){
	include 'classes/projets.class.php';
	$projet=new Projets();
	 $projetsAjax=$projet->getSOUSProjetsAjax();  
	 ?>
	
					<?php 
					
					$rowAjax=count($projetsAjax);
					
					foreach($projetsAjax as $titreAjax)
					?>
					<table width=100%>
					<tr><td><label for="codep">MDO:</label><input type="text" value="<?php echo $titreAjax['mdo']?>" id="mdo" style="padding:6px 0 6px 4px;width:150px" name="mdo" class="form-control" ></td></tr>
					<tr><td width=100% ><label for="codep">Titre Projet: </label>
					<textarea id="titre" style="padding:6px 0 6px 4px;width:700px" name="titre" class="form-control" ><?php echo $titreAjax['titre']?></textarea></td></tr>
					</table>
					
					
					
					<?php 
					
}
