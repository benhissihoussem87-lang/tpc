<?php


if(isset($_POST['ok']))
{
 if($partenaires->ajoutPartenaire($_POST['type'],str_replace("'","\'",$_POST['client']),str_replace("'","\'",$_POST['designation']),$_POST['date_decharge'],$_POST['Adresse'],$_POST['fax'],$_POST['tel'],$_POST['email'],$_POST['contact'],$_SESSION['user']))
 {
 
 //echo "<script>alert('Partenaire ajouté')</script>";
 
echo "<script>document.location.href='sigma.php?Partenaire_Afficher'</script>";

 }
 else
 {
 echo 'Erreur Ajout';
  
 }
}

?><form method="post">
<div class="container" style="position:relative; top:-20px">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header">Ajouter Un Partenaire
		<input type="submit" style="width:250px; margin:auto;position:relative; top:-20px" value="Ajouter" name="ok" class="btn btn-primary btn-block"/>
		
		</div>
        <div class="card-body">
          
            <table width=100% cellpadding=4  >
			<tr>
<td width=40%><label for="type">Type Partenaire</label>
                  
				    
                    <select  id="type" style="padding:6px 0 6px 4px" name="type" class="form-control" >
					 <option>MDO</option>
					  <option>IC.ST</option>
					   <option>IC.EL</option>
					    <option>IC.FL</option>
						 <option>IC.SI</option>
						  <option>ENTREPRISE</option>
						   <option>PARTICULIER</option>
						   <option>ARCHITECTE</option>
						    <option value="vis_a_vis">VIS A VIS</option> 
						    
					</select>
					
					</td>
<td width=40%>
<label for="designation">Désignation</label>
                  <div class="form-label-group">
				    
                    <input type="text" name="designation" style="padding:6px 0 6px 4px"id="designation"  name="designation" class="form-control"/>
					</td>
</tr>
<tr>
<td width=40%><label for="client">Nom du Partenaire</label>
                  
				    
                    <textarea id="client" style="padding:6px 0 6px 4px" name="client" class="form-control" ></textarea>
					
					</td>
					<td width=40%><label for="date_decharge">Date Offre Service</label>
                  <div class="form-label-group">
				    
                    <input type="date" id="date_decharge" style="padding:6px 0 6px 4px" name="date_decharge" class="form-control" ></td>

</tr>
<!----------------------->
<tr>

<td width=40%>
<label for="Adresse">Adresse</label>
                  
				    
                    <input type="text" id="Adresse"      style="padding:6px 0 6px 4px" name="Adresse" class="form-control" ></td>
					<td width=40%><label for="fax">Fax</label>
                  
				    
                    <input type="text" id="fax"      style="padding:6px 0 6px 4px" name="fax" class="form-control" >
					</td>
</tr>
<!----------------------->
<tr>

<td width=40%>
<label for="tel">Tél</label>
                  <div class="form-label-group">
				    
                    <input type="text" id="tel"      style="padding:6px 0 6px 4px" name="tel" class="form-control"></td>
					<td width=40%><label for="email">Email</label>
                  
				    
                    <input type="email" id="email"      style="padding:6px 0 6px 4px" name="email" class="form-control" ></td>

</tr>
<!----------------------->
<tr>
<td colspan=2><label for="contact">Contact</label>
                  <div class="form-label-group">
				    
                    <input type="text" id="contact"      style="padding:6px 0 6px 4px" name="contact" class="form-control" ></td>
</tr>
<!------------------------>


</table>
              
			  
			  <!--**********************************************-->
			  </div>
            
			
			
         
          
        </div>
      </div>
    </div>
	</form>