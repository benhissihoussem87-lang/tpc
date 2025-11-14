<?php
$partenaire=$partenaires->getPartenairesMDO();
$dernierssous_projet=$projet->getDernierSousProjet($_GET['P']);
foreach($dernierssous_projet as $dernier);
$rowdernier=count($dernierssous_projet);

if(isset($_POST['ok']))
{
$codesoup=$_POST['codeP'].'/'.$_POST['code_sousp'];
 if($projet->AjoutSousProjet($_POST['codeP'],$codesoup,$_POST['mdo'],$_POST['titre'],$_POST['etat']))
 {
 
 //echo "<script>alert('Projet Modifié')</script>";
 
echo "<script>document.location.href='sigma.php?P_Affiche'</script>";
 }
 else
 {
 echo 'Erreur Modification';
  
 }
}



?>
<form method="post">
<div class="container" style="position:relative; top:-20px"  >
      <div class="card card-register mx-auto mt-5" >
        <div class="card-header">Ajout Sous Projet
		 <input type="submit" style="width:250px; margin:auto;position:relative; top:-20px" value="Ajouter" name="ok" class="btn btn-primary btn-block"/>
		</div>
        <div class="card-body">
          
            <!---------*********************-->
   <table width=100% cellpadding=10  >
<tr>
<td width=40%>
       <label for="codeprojet">Code Sous-Projet</label>
	   <input type="text" name="codeP" value="<?php echo $_GET['P']?>" readonly style="width:120px">
	   
                    <input type="text" name="code_sousp"    style="width:40px;position:relative; top:-40px;left:210px"  class="form-control"  >
					</td>
			   <td><div class="form-row">
                
               
				
				<label for="titre">Titre</label>
                  
				    
                    <input type="text" id="titre" style="padding:6px 0 6px 4px"
					  name="titre" class="form-control"  >
              </div></td>
			  </tr>
			  
			  <!------------------------->
			  <tr>
			  
					
					<td>
			  <div class="form-row">
                
                <table  width=70% >
				<tr>
				<td colspan=6>
				<label for="etat">Avancement Sous-Projet</label>
			</td>
			</tr>
			<tr>
			  
			<td width=20>
                    <input type="radio" id="etat" value="0" style="width:20px" name="etat" class="form-control"  >
			</td>
			<td>0</td>
			<td width=20>
                    <input type="radio" id="etat" value="1" style="width:20px" name="etat" class="form-control"  >
			</td>
			<td>1</td>
			<td width=20>
                    <input type="radio" id="etat" value="2" style="width:20px" name="etat" class="form-control"  >
			</td>
			<td>2</td>
			<td width=20>
                    <input type="radio" id="etat" value="3" style="width:20px" name="etat" class="form-control"  >
			</td>
			<td>3</td>

        </tr>
      </table>		
			  </td>
			  
			  </tr>
			  <!-------------------------------->
			  
			 
			  <!------------------------->
			  <tr>
			  
			  <td>
			    <label for="mdo">MDO</label>
                  
				   
                    
					  <input  readonly class="form-control" style="padding:6px 0 6px 4px" name="mdo" value="<?php echo $_GET['mdo']?>"/>
			  </td>
			  
			  </tr>
			 
			  
			  
			  
</table>
			  <!--**********************************************-->
			  </div>
           
			
			
          
          
        </div>
      </div>
    </div>
	
	</form>