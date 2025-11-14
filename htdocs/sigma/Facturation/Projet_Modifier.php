<?php
$partenaire=$partenaires->getPartenairesMDO();

	
$details=$projet->detailProjet($_GET['P_modifier']);
$designation_partenaire=$partenaires->getPartenaires();
foreach($details as $det);
//Ajout Appel Offre
if(isset($_POST['ok']))
{
 if($projet->ModifierProjet($_GET['P_modifier']))
 {
 @copy($_FILES['bc']['tmp_name'],'Projets/bc/'.$_FILES['bc']['name']);
 
 //echo "<script>alert('Projet Modifié')</script>";
 
echo "<script>document.location.href='sigma.php?P_Affiche'</script>";
 }
 else
 {
 echo 'Erreur Modification';
  
 }
}



?>
<form method="post" enctype="multipart/form-data">
<div class="container" style="position:relative; top:-20px"  >
      <div class="card card-register mx-auto mt-5" >
        <div class="card-header">Modifier Projet
		 <input type="submit" style="width:250px; margin:auto;position:relative; top:-20px" value="Modifier" name="ok" class="btn btn-primary btn-block"/>
		</div>
        <div class="card-body">
          
            <!---------*********************-->
   <table width=100% cellpadding=4  >
<tr>
<td width=40% style="position:relative; top:-20px">
       <label for="codeprojet">Code Projet</label>
                    <input type="text" name="code_projet"  readonly  value="<?php echo $det['code_projet'] ?>" id="codeprojet" style="padding:6px 0 6px 4px" name="code_AO" class="form-control"  >
					</td>
					<td style="position:relative; top:-20px">
			    <label for="mdo">MDO</label>
                  
					  <input readonly name="mdo"  class="form-control" style="padding:6px 0 6px 4px"
					  value="<?php echo $det['mdo']?>"/>
			  </td>
			   
			  </tr>
			  
			  <!------------------------->
			  <tr >
			 
					<td style="position:relative; top:-20px" rowspan=2><div class="form-row">
                
               
				
				<label for="titre">Titre</label>
                  
				    <textarea readonly  id="titre" style="padding:4px 0 4px 4px" name="titre" class="form-control"  >
					<?php echo $det['titre'] ?>
					</textarea>
						<input type="text" value="<?php echo $det['intitule'] ?>"  readonly class="form-control" name="intitule" id="intitule">
                   
					 
              </div></td>
			  
			  	<td style="padding-left:20px;position:relative; top:-10px;margin-bottom:-50px" colspan=2>
			  <div class="form-row">
                
                <table  width=70% >
				<tr>
				<td colspan=6>
				<label for="etat">Avancement Projet</label>
			</td>
			</tr>
			<tr>
			  
			<td width=20>
                    <input type="radio" id="etat" <?php if($det['etat_p']==0){ echo 'checked';}?>					value="0" style="width:20px" name="etat_p" class="form-control"  >
			</td>
			<td>0</td>
			<td width=20>
                    <input type="radio" id="etat" <?php if($det['etat_p']==1){ echo 'checked';}?> value="1" style="width:20px" name="etat_p" class="form-control"  >
			</td>
			<td>1</td>
			<td width=20>
                    <input type="radio" id="etat" value="2" <?php if($det['etat_p']==2){ echo 'checked';}?> style="width:20px" name="etat_p" class="form-control"  >
			</td>
			<td>2</td>
			<td width=20>
                    <input type="radio" id="etat" value="3" <?php if($det['etat_p']==3){ echo 'checked';}?>style="width:20px" name="etat_p" class="form-control"  >
			</td>
			<td>3</td>

        </tr>
      </table>		
			  </td>
			  </tr>
			  <!-------------------------------->
			  
			  
			  <tr>
			  <td width=10%><label for="designer">Date Reception BC</label>
					 
						<input type="date" id="designer" style="padding:6px 0 6px 4px" name="date_receptionBC" class="form-control"  >
						</td>
			  <td width=10%><label for="designer">Date BC</label>
					 
						<input type="date" id="designer" style="padding:6px 0 6px 4px" name="date_BC" class="form-control"  >
						</td>
			  
			  </tr>
			  <tr>
			  <td >
			  <label for="designer">Bon de Commande</label>
					 <p><?php echo $det['BC'] ?></p>
						<input type="file" id="designer" style="padding:6px 0 6px 4px" name="bc" class="form-control"  >
						</td>
						<td><div class="form-row">
                
               
				
				<label for="dem">Date Démarrage</label>
                  
				    
                    <input type="date" id="dem" value="<?php echo $det['dem'] ?>" name="dem" class="form-control"  >
					
              </div></td>
			  
			  </tr>
			 
			  <!------------------------->
			  <tr>
			  <td >
			  <label for="observation">Observation</label>
                  
				    
                    <textarea id="observation" style="padding:6px 0 6px 4px" name="observation" class="form-control"  ><?php echo $det['observation'] ?></textarea>
			  </td>
			  
			  <td><div class="form-row">
                
               
				
				<label for="rp">Date RP</label>
                  
				    
                    <input type="date" value="<?php echo $det['rp'] ?>"  id="rp" style="padding:6px 0 6px 4px" name="rp" class="form-control"  >
					
                  
              </div></td>
			   <td>
			 <div class="form-row">
                
               
				
				<label for="rd">Date RD</label>
                  
				    
                    <input type="date" value="<?php echo $det['rd'] ?>"  id="rd" style="padding:6px 0 6px 4px" name="rd" class="form-control"  >
					
                  
              </div>
			 
			 </td>
			  
			  </tr>
			  <!------------------------->
			 
			  <!------------------------->
			  
			  
			  <!------------------------->
			  
			  <!------------------------->
			
			  
			  <!-------------->
			  
			  
			  
</table>
			  <!--**********************************************-->
			  </div>
           
			
			
          
          
        </div>
      </div>
    </div>
	
	</form>