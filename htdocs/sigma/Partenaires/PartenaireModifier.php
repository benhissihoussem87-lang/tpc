<?php

$details=$partenaires->detailPartenaire($_GET['id_modifier']);
foreach($details as $det);
if(isset($_POST['ok']))
{
 if($partenaires->ModidifierPartenaire($_GET['id_modifier'],str_replace("'","\'",$_POST['client']),str_replace("'","\'",$_POST['designation']),$_POST['date_decharge'],$_POST['Adresse'],$_POST['fax'],$_POST['tel'],$_POST['email'],$_POST['contact'],$_POST['type'],$_SESSION['user']))
 {
 
 //echo "<script>alert('Partenaire Modifier')</script>";
 //echo 'oko';
echo "<script>document.location.href='sigma.php?Partenaire_Afficher'</script>";

 }
 else
 {
 echo 'Erreur Ajout';
  
 }
}

?>
<form method="post">
<div class="container" style="position:relative; top:-20px">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header">Ajouter Un Partenaire
		 <input type="submit" style="width:250px; margin:auto;position:relative; top:-20px" value="Modifier" name="ok" class="btn btn-primary btn-block"/>
		</div>
        <div class="card-body">
          
            <table width=100% cellpadding=10  >
<tr>
<td width=40%><label for="type">Type Partenaire</label>
                  
				    
                    <select  id="type" style="padding:6px 0 6px 4px" name="type" class="form-control" >
					 <option <?php if($det['type']=='mdo'){ ?> selected <?php } ?>>MDO</option>
					  <option <?php if($det['type']=='IC.ST'){ ?> selected <?php } ?>>IC.ST</option>
					   <option <?php if($det['type']=='IC.EL'){ ?> selected <?php } ?>>IC.EL</option>
					    <option <?php if($det['type']=='IC.FL'){ ?> selected <?php } ?>>IC.FL</option>
						 <option <?php if($det['type']=='IC.SI'){ ?> selected <?php } ?>>IC.SI</option>
						  <option <?php if($det['type']=='ENTREPRISE'){ ?> selected <?php } ?>>ENTREPRISE</option>
						   <option <?php if($det['type']=='PARTICULIER'){ ?> selected <?php } ?>>PARTICULIER</option >
						   <option <?php if($det['type']=='architecte'){ ?> selected <?php } ?>>ARCHITECTE</option>
					</select>
					</td>
<td width=40%>
<label for="designation">Désignation</label>
                  <div class="form-label-group">
				    
<textarea name="designation" id="designation"  name="designation" class="form-control"><?php echo $det['designation']?></textarea>
					</td>

</tr>
<!----------------------->
<tr>
<td width=40%><label for="client">client</label>
                  
				    
                    <input type="text" value="<?php echo $det['client']?>" id="client" style="padding:6px 0 6px 4px" name="client" class="form-control" >
					
					</td>

<td width=40%><label for="date_decharge">Date décharge</label>
                  <div class="form-label-group">
				    
                    <input type="date" value="<?php echo $det['date_decharge']?>" id="date_decharge" style="padding:6px 0 6px 4px" name="date_decharge" class="form-control" ></td>

</tr>
<!----------------------->
<tr>
<td width=40%>
<label for="Adresse">Adresse</label>
                  
				    
                    <input type="text" id="Adresse" value="<?php echo $det['Adresse']?>"     style="padding:6px 0 6px 4px" name="Adresse" class="form-control" ></td>
<td width=40%><label for="fax">Fax</label>
                  
				    
                    <input type="text" id="fax" value="<?php echo $det['fax']?>"     style="padding:6px 0 6px 4px" name="fax" class="form-control" >
					</td>

</tr>
<!----------------------->
<tr>
<td width=40%>
<label for="tel">Tél</label>
                  <div class="form-label-group">
				    
                    <input type="text" id="tel" value="<?php echo $det['tel']?>"     style="padding:6px 0 6px 4px" name="tel" class="form-control"></td>
<td width=40%><label for="email">Email</label>
                  
				    
                    <input type="email" id="email" value="<?php echo $det['email']?>"     style="padding:6px 0 6px 4px" name="email" class="form-control" ></td>

</tr>
<tr>
<td><label for="contact">Contact</label>
                  <div class="form-label-group">
				    
                    <input type="text" id="contact" value="<?php echo $det['contact']?>"      style="padding:6px 0 6px 4px" name="contact" class="form-control" ></td>

<?php if($_SESSION['user']=='Admin')
					{ if($det['typeuser']=='utilisateur'){
						?>
				   <td width=50 align=center>
				    <table width=90%>
					 <tr>
					 <th >
						USER</th><th>Admin<input type="radio"  name="user" style="width:120px" value="null" ></th>
						</tr>
						
						</table>
				 
					
				  </td>
				  <?php } } ?>
</tr>
<!------------------------>


</table>
              
			  
			  <!--**********************************************-->
			  </div>
           
			
			
         
          
        </div>
      </div>
    </div> 
	</form>